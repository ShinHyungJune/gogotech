<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCalculateColumnToLettersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('letters', function (Blueprint $table) {
            $table->integer("count_calculate")->default(0); // 수집횟수
            $table->boolean("stop_calculate")->default(false)->index(); // 수집금지
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('letters', function (Blueprint $table) {
            $table->dropColumn("count_calculate");
            $table->dropColumn("stop_calculate");
        });
    }
}
