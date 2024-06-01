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
        Schema::table('pembelians', function (Blueprint $table) {
            // $table->foreignId('supplier_id')->constrained()->onDelete('cascade')->after('id');
            if (!Schema::hasColumn('pembelians', 'supplier_id')) {
                $table->foreignId('supplier_id')->constrained()->onDelete('cascade');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pembelians', function (Blueprint $table) {
            // $table->dropForeign(['supplier_id']);
            // $table->dropColumn('supplier_id');
            if (Schema::hasColumn('pembelians', 'supplier_id')) {
                $table->dropForeign(['supplier_id']);
                $table->dropColumn('supplier_id');
            }
        });
    }
};
