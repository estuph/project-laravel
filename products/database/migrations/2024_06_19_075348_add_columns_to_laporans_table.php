<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('laporans', function (Blueprint $table) {
            $table->date('tanggal')->after('id');
            $table->integer('penjualan')->after('tanggal');
            $table->integer('pembelian')->after('penjualan');
            $table->integer('pengeluaran')->after('pembelian');
            $table->integer('pendapatan')->after('pengeluaran');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('laporans', function (Blueprint $table) {
            $table->dropColumn('tanggal');
            $table->dropColumn('penjualan');
            $table->dropColumn('pembelian');
            $table->dropColumn('pengeluaran');
            $table->dropColumn('pendapatan');
        });
    }
};
