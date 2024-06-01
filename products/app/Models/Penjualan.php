<?php

namespace App\Models;

use App\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Penjualan extends Model
{
    use HasFactory;

    protected $fillable = 
    [
        'product_id', 
        'variant_id', 
        'quantity', 
        'price',
        'total',
        'tanggal'
    ];

    protected $table = 'penjualans';
    
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function variant()
    {
        return $this->belongsTo(Variant::class);
    }

    public function laporan()
    {
        return $this->belongsTo(Laporan::class);
    }
        
}
