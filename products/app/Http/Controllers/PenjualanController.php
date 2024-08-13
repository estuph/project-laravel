<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Variant;
use App\Models\Penjualan;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;

class PenjualanController extends Controller
{
    public function index(Request $request)
    {
        $penjualans = Penjualan::all();
        
        return view('penjualan.index', compact('penjualans'));
    }

    public function create(Request $request)
    {
        $products = Product::all();
        $variants = collect(); // Koleksi kosong sebagai default

        if ($request->has('product_id')) {
            $variants = Variant::where('product_id', $request->input('product_id'))->get();
        }

        return view('penjualan.create', compact('products', 'variants'));
    }

    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'product_id' => 'required|integer',
            'variant_id' => 'required|integer',
            'quantity' => 'required|integer',
            'price' => 'required|integer',
            'tanggal' => 'required|date',
        ]);

        // Membuat Penjualan baru
        $penjualan = new Penjualan();
        $penjualan->product_id = $request->input('product_id');
        $penjualan->variant_id = $request->input('variant_id');
        $penjualan->quantity = $request->input('quantity');
        $penjualan->price = $request->input('price');
        $penjualan->total = $penjualan->quantity * $penjualan->price;
        $penjualan->tanggal = $request->input('tanggal');
        $penjualan->save();

        // Kurangi stok produk
        $variant = Variant::find($penjualan->variant_id);
        $variant->decreaseStock($penjualan->quantity);

        return redirect()->route('penjualans.index')->with('success', 'Penjualan created successfully.');
        
    }

    public function show($id)
    {
        $penjualan = Penjualan::with(['product', 'variant'])->findOrFail($id);
        return view('penjualan.show', compact('penjualan'));
    }

    public function edit(Penjualan $penjualan)
    {
        $products = Product::all();
        $variants = Variant::all();
        return view('penjualan.edit', compact('penjualan', 'products', 'variants'));
    }

    public function update(Request $request, Penjualan $penjualan)
    {
        
    // Validasi input
    $request->validate([
        'product_id' => 'required|exists:products,id',
        'variant_id' => 'nullable|exists:variants,id',
        'tanggal' => 'required|date',
        'quantity' => 'required|integer',
        'price' => 'required|numeric'
    ]);

    // Simpan quantity lama sebelum update
    $oldQuantity = $penjualan->quantity;
    $oldVariantId = $penjualan->variant_id;

    // Update data penjualan
    $penjualan->product_id = $request->input('product_id');
    $penjualan->variant_id = $request->input('variant_id');
    $penjualan->quantity = $request->input('quantity');
    $penjualan->price = $request->input('price');
    $penjualan->total = $penjualan->quantity * $penjualan->price;
    $penjualan->tanggal = $request->input('tanggal');
    $penjualan->save();

    // Update stok produk
    if ($oldVariantId) {
        $oldVariant = Variant::find($oldVariantId);
        if ($oldVariant) {
            $oldVariant->increaseStock($oldQuantity);
        }
    }

    $newVariant = Variant::find($penjualan->variant_id);
    if ($newVariant) {
        $newVariant->decreaseStock($penjualan->quantity);
    }

    return redirect()->route('penjualans.index')->with('success', 'Penjualan updated successfully.');
    
    }

    public function destroy(Penjualan $penjualan)
    {
        $penjualan->delete();

        return redirect()->route('penjualans.index')
                         ->with('success', 'Penjualan deleted successfully.');
    }

    public function printByDate($date, Request $request)
    {
        $date = $request->input('tanggal');
    
        // Konversi tanggal ke format yang sesuai
        $formattedDate = Carbon::createFromFormat('Y-m-d', $date)->format('Y-m-d');
        
        $penjualans = Penjualan::whereDate('tanggal', $formattedDate)->get();
        
        $pdf = Pdf::loadView('penjualan.print_by_date', compact('penjualans', 'date'))
                ->setPaper('a4', 'portrait'); 
        
        return $pdf->stream('nota-penjualan-'.$date.'.pdf');
    }
  
}
