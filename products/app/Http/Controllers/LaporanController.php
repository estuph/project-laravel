<?php

namespace App\Http\Controllers;

// use Log;
use App\Models\Laporan;
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
        // menentukan rentang tanggal
        $tanggal_awal = $request->input('tanggal_awal');
        $tanggal_akhir = $request->input('tanggal_akhir');

        // membuat daftar semua tanggal antara tanggal_awal dan tanggal_akhir
        $startDate = Carbon::parse($tanggal_awal);
        $endDate = Carbon::parse($tanggal_akhir);
        $dates = [];

        while ($startDate->lte($endDate)) {
            $dates[] = $startDate->toDateString();
            $startDate->addDay();
        }

        // mengambil data transaksi yang terjadi dalam rentang tanggal yang telah ditentukan
        $penjualans = Penjualan::whereBetween('tanggal', [$tanggal_awal, $tanggal_akhir])->get();
        $pembelians = Pembelian::whereBetween('created_at', [$tanggal_awal, $tanggal_akhir])->get();
        $pengeluarans = Pengeluaran::whereBetween('tanggal', [$tanggal_awal, $tanggal_akhir])->get();

        // transaksi dikelompokkan berdasarkan tanggalnya
        $groupedPenjualans = $penjualans->groupBy(function($date) {
            return Carbon::parse($date->tanggal)->format('Y-m-d');
        });

        $groupedPembelians = $pembelians->groupBy(function($date) {
            return Carbon::parse($date->created_at)->format('Y-m-d');
        });

        $groupedPengeluarans = $pengeluarans->groupBy(function($date) {
            return Carbon::parse($date->tanggal)->format('Y-m-d');
        });

        // menghitung pendapatan untuk setiap tanggal
        $reportData = [];
        foreach ($dates as $date) {
            $totalPenjualan = $groupedPenjualans->has($date) ? $groupedPenjualans[$date]->sum('total') : 0;
            $totalPembelian = $groupedPembelians->has($date) ? $groupedPembelians[$date]->sum('total') : 0;
            $totalPengeluaran = $groupedPengeluarans->has($date) ? $groupedPengeluarans[$date]->sum('jumlah') : 0;
            $pendapatan = $totalPenjualan - $totalPembelian - $totalPengeluaran;

            $reportData[] = [
                'tanggal' => $date,
                'penjualan' => $totalPenjualan,
                'pembelian' => $totalPembelian,
                'pengeluaran' => $totalPengeluaran,
                'pendapatan' => $pendapatan,
            ];

            // Simpan data ke database
            $laporan = Laporan::create([
                'tanggal' => $date,
                'penjualan' => $totalPenjualan,
                'pembelian' => $totalPembelian,
                'pengeluaran' => $totalPengeluaran,
                'pendapatan' => $pendapatan
            ]);

            // Pengecekan apakah data berhasil disimpan
            if (!$laporan) {
                return redirect()->back()->with('error', 'Gagal menyimpan data untuk tanggal: ' . $date);
            }
        }

        $totalPendapatan = array_sum(array_column($reportData, 'pendapatan'));

        // Menyimpan Data di Session 
        $request->session()->put('reportData', $reportData);
        $request->session()->put('totalPendapatan', $totalPendapatan);
        $request->session()->put('tanggal_awal', $tanggal_awal);
        $request->session()->put('tanggal_akhir', $tanggal_akhir);

        
        return redirect()->route('laporan.result');
    }


    public function result(Request $request)
    {
        $reportData = $request->session()->get('reportData');
        $totalPendapatan = $request->session()->get('totalPendapatan');
        $tanggal_awal = $request->session()->get('tanggal_awal');
        $tanggal_akhir = $request->session()->get('tanggal_akhir');

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
