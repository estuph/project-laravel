<?php

namespace App\Models;

use App\Models\Product;
use App\Models\Supplier;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Variant extends Model
{
    use HasFactory;

    protected $fillable = 
    [
        'product_id', 
        'name', 
        'price', 
        'stock'
    ];

    
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    // Tambah stok
    public function increaseStock($quantity)
    {
        $this->stock += $quantity;
        $this->save();
    }

    // Kurangi stok
    public function decreaseStock($quantity)
    {
        $this->stock -= $quantity;
        $this->save();
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

    public function penjualans()
    {
        return $this->hasMany(Penjualan::class, 'variant_id', 'id');

    }
}
