<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCertificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('certifications', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("user_id")->nullable();
            $table->foreign("user_id")->references("id")->on("users");
            $table->string("contact")->unique()->nullable(); // 연락처
            $table->string("name")->nullable(); // 이름
            $table->string("CI")->nullable(); // CI
            $table->string("DI")->nullable(); // DI
            $table->string("sex_code")->nullable(); // 성별코드
            $table->string("birth")->nullable(); // 생년월일
            $table->string("comm_id")->nullable(); // 통신사
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('certifications');
    }
}
