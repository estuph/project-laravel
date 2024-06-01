<?php

namespace App\Http\Controllers;

use App\Models\Pembelian;
use App\Models\Penjualan;
use App\Models\Pengeluaran;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;

class LaporanController extends Controller
{
    
    public function index()
    {
        return view('laporan.index');
    }


    public function generateReport (Request $request)
    {
        $tanggal_awal = $request->input('tanggal_awal');
        $tanggal_akhir = $request->input('tanggal_akhir');

        // Generate all dates between the start and end date
        $startDate = Carbon::parse($tanggal_awal);
        $endDate = Carbon::parse($tanggal_akhir);
        $dates = [];

        while ($startDate->lte($endDate)) {
            $dates[] = $startDate->toDateString();
            $startDate->addDay();
        }

        // Fetch transactions
        $penjualans = Penjualan::whereBetween('created_at', [$tanggal_awal, $tanggal_akhir])->get();
        $pembelians = Pembelian::whereBetween('created_at', [$tanggal_awal, $tanggal_akhir])->get();
        $pengeluarans = Pengeluaran::whereBetween('created_at', [$tanggal_awal, $tanggal_akhir])->get();

        // Group transactions by date
        $groupedPenjualans = $penjualans->groupBy(function($date) {
            return Carbon::parse($date->created_at)->format('Y-m-d');
        });

        $groupedPembelians = $pembelians->groupBy(function($date) {
            return Carbon::parse($date->created_at)->format('Y-m-d');
        });

        $groupedPengeluarans = $pengeluarans->groupBy(function($date) {
            return Carbon::parse($date->created_at)->format('Y-m-d');
        });

        $reportData = [];
        foreach ($dates as $date) {
            $totalPenjualan = $groupedPenjualans->has($date) ? $groupedPenjualans[$date]->sum('total') : 0;
            $totalPembelian = $groupedPembelians->has($date) ? $groupedPembelians[$date]->sum('total') : 0;
            $totalPengeluaran = $groupedPengeluarans->has($date) ? $groupedPengeluarans[$date]->sum('jumlah') : 0;
            $pendapatan = $totalPenjualan - $totalPembelian - $totalPengeluaran;

            $reportData[] = [
                'date' => $date,
                'penjualan' => $totalPenjualan,
                'pembelian' => $totalPembelian,
                'pengeluaran' => $totalPengeluaran,
                'pendapatan' => $pendapatan,
            ];
        }

        $totalPendapatan = array_sum(array_column($reportData, 'pendapatan'));

        return view('laporan.result', compact('reportData', 'totalPendapatan', 'tanggal_awal', 'tanggal_akhir'));
    }


    public function printReport(Request $request)
    {
        $tanggal_awal = $request->input('tanggal_awal');
        $tanggal_akhir = $request->input('tanggal_akhir');

        // Logika yang sama untuk menghasilkan laporan bulanan
        $startDate = Carbon::parse($tanggal_awal);
        $endDate = Carbon::parse($tanggal_akhir);
        $dates = [];

        while ($startDate->lte($endDate)) {
            $dates[] = $startDate->toDateString();
            $startDate->addDay();
        }

        $penjualans = Penjualan::whereBetween('created_at', [$tanggal_awal, $tanggal_akhir])->get();
        $pembelians = Pembelian::whereBetween('created_at', [$tanggal_awal, $tanggal_akhir])->get();
        $pengeluarans = Pengeluaran::whereBetween('created_at', [$tanggal_awal, $tanggal_akhir])->get();

        $groupedPenjualans = $penjualans->groupBy(function($date) {
            return Carbon::parse($date->created_at)->format('Y-m-d');
        });

        $groupedPembelians = $pembelians->groupBy(function($date) {
            return Carbon::parse($date->created_at)->format('Y-m-d');
        });

        $groupedPengeluarans = $pengeluarans->groupBy(function($date) {
            return Carbon::parse($date->created_at)->format('Y-m-d');
        });

        $reportData = [];
        foreach ($dates as $date) {
            $totalPenjualan = $groupedPenjualans->has($date) ? $groupedPenjualans[$date]->sum('total') : 0;
            $totalPembelian = $groupedPembelians->has($date) ? $groupedPembelians[$date]->sum('total') : 0;
            $totalPengeluaran = $groupedPengeluarans->has($date) ? $groupedPengeluarans[$date]->sum('jumlah') : 0;
            $pendapatan = $totalPenjualan - $totalPembelian - $totalPengeluaran;

            $reportData[] = [
                'date' => $date,
                'penjualan' => $totalPenjualan,
                'pembelian' => $totalPembelian,
                'pengeluaran' => $totalPengeluaran,
                'pendapatan' => $pendapatan,
            ];
        }

        $totalPendapatan = array_sum(array_column($reportData, 'pendapatan'));

        $pdf = PDF::loadView('laporan.print', compact('reportData', 'totalPendapatan', 'tanggal_awal', 'tanggal_akhir'));
        return $pdf->stream('laporan_bulanan.pdf');
    }
    

   
    
}
