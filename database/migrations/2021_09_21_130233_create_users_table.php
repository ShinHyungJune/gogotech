<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger("admin_id")->nullable(); // 추천인 id
            $table->foreign("admin_id")->references("id")->on("admins");
            $table->string("admin_ids")->nullable();

            $table->string("ids")->unique(); // 아이디
            $table->string("name")->nullable(); // 이름
            $table->string("contact")->nullable(); // 연락처
            $table->string("email")->nullable();

            $table->integer("point")->default(0); // 적립금

            $table->boolean("accept")->default(false); // 접속허용어부

            $table->double("price_sms")->default(50);
            $table->double("price_lms")->default(50);
            $table->double("price_mms")->default(100);

            $table->timestamp('verified_at')->nullable();
            $table->string('password')->nullable();
            $table->string("social_id")->nullable();
            $table->string("social_platform")->nullable();
            $table->unique(["social_id", "social_platform"]);

            $table->boolean("agree_spam")->default(true);
            $table->boolean("agree_service")->default(true);
            $table->boolean("agree_privacy")->default(true);

            $table->text("reason_leave_out")->nullable(); // 탈퇴사유

            $table->string("account")->nullable(); // 환급계좌 계좌번호
            $table->string("bank")->nullable(); // 환급계좌 은행명
            $table->string("owner")->nullable(); // 환급계좌 예금주
            $table->text("memo")->nullable();
            $table->string("agent")->default(\App\Enums\Agent::NPRO);

            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
