<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnKitStockIdToPatientTests extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('patient_tests', function (Blueprint $table) {
            $table->integer('kit_stock_id');
            $table->string('status');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('patient_tests', function (Blueprint $table) {
            $table->dropColumn('kit_stock_id');
            $table->dropColumn('status');
        });
    }
}
