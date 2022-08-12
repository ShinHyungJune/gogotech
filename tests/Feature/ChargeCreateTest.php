<?php

namespace Tests\Feature;

use App\Models\Charge;
use App\Models\Pinco;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class ChargeCreateTest extends TestCase
{
    use RefreshDatabase;

    protected $user;

    protected $admin;

    protected $form;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();

        $this->actingAs($this->user);

        $this->form = [
            "price" => 10000,
            "name" => "name",
        ];
    }

    /** @test */
    function 사용자는_충전요청을_생성할_수_있다()
    {
        $this->post("/charges", $this->form);

        $this->assertCount(1, Charge::all());
    }

    /** @test */
    function 사용자는_충전내역을_조회할_수_있다()
    {
        $charges = Charge::factory()->count(10)->create();

        $this->get("/charges")->assertInertia(function($page) use($charges){
            $items = $page->toArray()["props"]["charges"]["data"];

            $this->assertCount(count($charges), $items);
        });

        /*
        Pinco::create([
            "TR_SENDDATE" => Carbon::now(),
            "TR_SENDSTAT" => "0",
            "TR_MSGTYPE" => "0",
            "TR_PHONE" => "01030217486",
            "TR_CALLBACK" => "01030217486",
            "TR_MSG" => "테스트 발송"
        ]);
        */

    }
}
