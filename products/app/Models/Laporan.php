<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Laporan extends Model
{
    use HasFactory;

    protected $fillable = 
    [
        'tanggal',
        'penjualan',
        'pembelian',
        'pengeluaran',
        'pendapatan'
    ];

    public function penjualans()
    {
        return $this->belongsTo(Penjualan::class);
    }

    public function pembelians()
    {
        return $this->belongsTo(Pembelian::class);
    }

    public function pengeluarans()
    {
        return $this->belongsTo(Pengeluaran::class);
    }
}
