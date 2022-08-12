<?php

namespace Tests\Feature;

use App\Models\Charge;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LetterCreateTest extends TestCase
{
    use RefreshDatabase;

    protected $user;

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

    function 사용자는_문자를_발송할_수_있다()
    {

    }
}
