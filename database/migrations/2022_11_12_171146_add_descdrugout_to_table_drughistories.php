<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDescdrugoutToTableDrughistories extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('drughistories', function (Blueprint $table) {
            $table->unsignedBigInteger('cowhealth_id')->after('keluar')->nullable();
            $table->foreign('cowhealth_id')->references('id')->on('cow_health_histories');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('drughistories', function (Blueprint $table) {
            //
        });
    }
}
