<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Laporan;
use App\Models\Product;
use App\Models\Variant;
use App\Models\Pembelian;
use App\Models\Penjualan;
use App\Models\Pengeluaran;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function adminIndex(Request $request)
    {
        $tanggal_awal = $request->input('tanggal_awal') ?: Carbon::now()->startOfMonth()->toDateString();
    $tanggal_akhir = $request->input('tanggal_akhir') ?: Carbon::now()->endOfMonth()->toDateString();

    $startDate = Carbon::parse($tanggal_awal);
    $endDate = Carbon::parse($tanggal_akhir);
    $dates = [];

    while ($startDate->lte($endDate)) {
        $dates[] = $startDate->toDateString();
        $startDate->addDay();
    }

    $penjualans = Penjualan::whereBetween('tanggal', [$tanggal_awal, $tanggal_akhir])->get();
    $pembelians = Pembelian::whereBetween('created_at', [$tanggal_awal, $tanggal_akhir])->get();
    $pengeluarans = Pengeluaran::whereBetween('tanggal', [$tanggal_awal, $tanggal_akhir])->get();

    $groupedPenjualans = $penjualans->groupBy(function($date) {
        return Carbon::parse($date->tanggal)->format('Y-m-d');
    });

    $groupedPembelians = $pembelians->groupBy(function($date) {
        return Carbon::parse($date->created_at)->format('Y-m-d');
    });

    $groupedPengeluarans = $pengeluarans->groupBy(function($date) {
        return Carbon::parse($date->tanggal)->format('Y-m-d');
    });

    $totalPendapatan = 0;
    foreach ($dates as $date) {
        $totalPenjualan = $groupedPenjualans->has($date) ? $groupedPenjualans[$date]->sum('total') : 0;
        $totalPembelian = $groupedPembelians->has($date) ? $groupedPembelians[$date]->sum('total') : 0;
        $totalPengeluaran = $groupedPengeluarans->has($date) ? $groupedPengeluarans[$date]->sum('jumlah') : 0;
        $totalPendapatan += $totalPenjualan - $totalPembelian - $totalPengeluaran;
    }

    $totalProducts = Product::count();
    $totalVariants = Variant::count();
    $totalUsers = User::count();

    return view('admin.dashboard', [
        'totalProducts' => $totalProducts,
        'totalVariants' => $totalVariants,
        'totalUsers' => $totalUsers,
        'totalPendapatan' => $totalPendapatan,
        'tanggal_awal' => $tanggal_awal,
        'tanggal_akhir' => $tanggal_akhir,
    ]);
      
   
    }

    public function kasirIndex()
    {
        return view('kasir.dashboard');
    }
}
