<?php

namespace App\Models;

use App\Models\Variant;
use App\Models\Supplier;
use App\Models\Penjualan;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;

    protected $fillable = 
    [
        'name', 

    ];

    public function variants()
    {
        return $this->hasMany(Variant::class);
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

    public function penjualan()
    {
        return $this->hasMany(Penjualan::class);
    }
}
