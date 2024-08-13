<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Variant;
use App\Models\Supplier;
use App\Models\Pembelian;
use Illuminate\Http\Request;

class PembelianController extends Controller
{
    public function index()
    {
        $pembelians = Pembelian::all();
        return view('pembelian.index', compact('pembelians'));
    }

    public function create(Request $request)
    {
        $suppliers = Supplier::all();
        $products = Product::all();
        $variants = collect(); // Koleksi kosong sebagai default
    
        if ($request->has('product_id')) {
            $variants = Variant::where('product_id', $request->input('product_id'))->get();
        }
    
        return view('pembelian.create', compact('suppliers', 'products', 'variants'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'supplier_id' => 'required|exists:suppliers,id',
            'product_id' => 'required|exists:products,id',
            'variant_id' => 'required|exists:variants,id',
            'quantity' => 'required|integer|min:1',
            'price' => 'required|numeric|min:0',
            'created_at' => 'required|date',
        ]);
    
        $pembelian = new Pembelian();
        $pembelian->supplier_id = $request->input('supplier_id');
        $pembelian->product_id = $request->input('product_id');
        $pembelian->variant_id = $request->input('variant_id');
        $pembelian->quantity = $request->input('quantity');
        $pembelian->price = $request->input('price');
        $pembelian->total = $pembelian->quantity * $pembelian->price;
        $pembelian->created_at = $request->input('created_at');
        $pembelian->save();
    
        // Tambah stok variant
        $variant = Variant::find($pembelian->variant_id);
        $variant->increaseStock($pembelian->quantity);
    
        return redirect()->route('pembelians.index')->with('success', 'Pembelian created successfully.');
    }

    public function show($id)
    {
        $pembelian = Pembelian::with('supplier', 'product')->findOrFail($id);
        return view('pembelian.show', compact('pembelian'));
    }

    public function edit(Pembelian $pembelian)
    {
        $products = Product::all();
        $variants = Variant::all();
        $suppliers = Supplier::all();
        return view('pembelian.edit', compact('pembelian', 'products', 'variants', 'suppliers'));
    }

    public function update(Request $request, Pembelian $pembelian)
    {
        $request->validate([
            'supplier_id' => 'required|exists:suppliers,id',
            'product_id' => 'required|exists:products,id',
            'variant_id' => 'required|exists:variants,id',
            'quantity' => 'required|integer|min:1',
            'price' => 'required|numeric|min:0'
        ]);
    
        // Restore old stock
        $oldQuantity = $pembelian->quantity;
        $variant = Variant::find($pembelian->variant_id);
        $variant->stock -= $oldQuantity;
        $variant->save();
    
        // Update pembelian
        $data = $request->all();
        $data['total'] = $data['quantity'] * $data['price'];
        $pembelian->update($data);
    
        // Update new stock
        $variant->stock += $data['quantity'];
        $variant->save();
    
        return redirect()->route('pembelians.index')->with('success', 'Pembelian updated successfully.');
    }

    public function destroy(Pembelian $pembelian)
    {
       
        $product = Product::find($pembelian->product_id);
        $product->save();

        $pembelian->delete();

        return redirect()->route('pembelians.index')
                         ->with('success', 'Pembelian deleted successfully.');
    }
}
