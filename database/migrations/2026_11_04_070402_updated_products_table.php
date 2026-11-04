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
        Schema::table('products', function (Blueprint $table) {
            //
            if (Schema::hasColumn('products', 'stock')) {
                $table->dropColumn('stock');
            }
            $table->string('slug')->nullable()->after('name');
            $table->integer('art_carton_price')->nullable()->after('price');
            $table->integer('art_paper_price')->nullable()->after('art_carton_price');
            $table->integer('hvs_price')->nullable()->after('art_paper_price');
            $table->integer('doff_price')->nullable()->after('hvs_price');
            $table->integer('glossy_price')->nullable()->after('doff_price');
            $table->integer('cutting_price')->nullable()->after('glossy_price');

            $table->text('brief_description')->nullable()->after('cutting_price');
            $table->text('description')->nullable()->after('brief_description');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            //
        });
    }
};
