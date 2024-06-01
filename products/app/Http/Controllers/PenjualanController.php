<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Variant;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Penjualan;
use Illuminate\Http\Request;

class PenjualanController extends Controller
{
    public function index()
    {
        $penjualans = Penjualan::with('product', 'variant')->paginate(10);
        return view('penjualan.index', compact('penjualans'));
        
    }

    public function create()
    {
        $products = Product::all();
        $variants = Variant::all();
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

        return redirect()->route('penjualans.index')->with('success', 'Penjualan berhasil ditambahkan.');
        
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

    return redirect()->route('penjualans.index')->with('success', 'Penjualan berhasil diupdate.');
    
    }

    public function destroy(Penjualan $penjualan)
    {
        $penjualan->delete();

        return redirect()->route('penjualans.index')
                         ->with('success', 'Penjualan berhasil dihapus.');
    }

    public function print($id)
    {
        $penjualan = Penjualan::findOrFail($id);

        $pdf = Pdf::loadView('penjualan.print', compact('penjualan'))
                  ->setPaper(0,0,609,440, 'potrait'); 
    
        return $pdf->stream('nota-penjualan.pdf');
    }

   
}
