<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLettersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('letters', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("user_id");
            $table->foreign("user_id")->references("id")->on("users");
            $table->string("title"); // 제목
            $table->string("type"); // 문자유형(SMS, LMS 등)
            $table->text("description"); // 내용
            $table->date("pushed_at"); // 발송예약일자
            $table->double("price"); // 건당가격
            $table->double("total_price")->nullable(); // 총 가격

            $table->unsignedBigInteger("count_reject")->default(0); // 수신거부수
            $table->unsignedBigInteger("count")->nullable(); // 총 발송건수
            $table->unsignedBigInteger("count_success")->nullable(0); // 성공건수
            $table->unsignedBigInteger("count_fail")->nullable(0); // 실패건수
            $table->boolean("finished")->default(false); //
            $table->string("agent")->nullable(); // 발송에이전트(핑크코브라, 엔프로 등)
            $table->boolean("test")->default(false);
            $table->boolean("refunded")->default(0)->index(); // 환불여부

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
        Schema::dropIfExists('letters');
    }
}
