<?php

namespace App\Models;

use App\Models\Product;
use App\Models\Variant;
use App\Models\Supplier;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pembelian extends Model
{
    use HasFactory;

    protected $fillable = 
    [
        'supplier_id',
        'product_id',
        'variant_id',
        'quantity',
        'price',
        'total'
        
    ];

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }
    public function variant()
    {
        return $this->belongsTo(Variant::class);
    }
    
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    
    public function getTotalAttribute()
    {
        return $this->quantity * $this->price;
    }

}
