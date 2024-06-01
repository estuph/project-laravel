<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Variant;
use Illuminate\Http\Request;

class VariantController extends Controller
{
    public function index()
    {
        $variants = Variant::with('product')->paginate(10);
        return view('variants.index', compact('variants'));
    }

    public function create()
    {
        $products = Product::all();
        return view('variants.create', compact('products'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'name' => 'required|string|max:255',
            'stock' => 'required|integer',
            'stock' => 'required|integer',
        ]);

        Variant::create($request->all());
        return redirect()->route('variants.index')->with('success', 'Variant created successfully.');
    }

    public function show($id)
    {
        $variant = Variant::with('product')->findOrFail($id);
        return view('variants.show', compact('variant'));
    }

    public function edit(Variant $variant)
    {
        $products = Product::all();
        return view('variants.edit', compact('variant', 'products'));
    }

    public function update(Request $request, Variant $variant)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
        ]);

        $variant->update($request->all());
        return redirect()->route('variants.index')->with('success', 'Variant updated successfully.');
    }

    public function destroy(Variant $variant)
    {
        $variant->delete();
        return redirect()->route('variants.index')->with('success', 'Variant deleted successfully.');
    }
}
