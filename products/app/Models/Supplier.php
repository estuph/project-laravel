<?php

namespace App\Models;

use App\Models\Product;
use App\Models\Pembelian;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Supplier extends Model
{
    use HasFactory;

    protected $fillable = 
    [
        'name', 
        'contact_info'
    ];

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function pembelians()
    {
        return $this->hasMany(Pembelian::class);
    }
}
