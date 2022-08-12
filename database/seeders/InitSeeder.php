<?php

namespace Database\Seeders;

use App\Models\Allergy;
use App\Models\Basic;
use App\Models\Cart;
use App\Models\Category;
use App\Models\Company;
use App\Models\Coupon;
use App\Models\DeliveryAmount;
use App\Models\DeliveryDate;
use App\Models\DeliveryDuration;
use App\Models\Event;
use App\Models\Faq;
use App\Models\Holidate;
use App\Models\Holiday;
use App\Models\Information;
use App\Models\Material;
use App\Models\Notice;
use App\Models\PayMethod;
use App\Models\Product;
use App\Models\Qna;
use App\Models\RequestCategory;
use App\Models\RequestStyle;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Inertia\Testing\Concerns\Has;
use Symfony\Component\Console\Question\Question;

class InitSeeder extends Seeder
{
    protected $user;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->user = User::create([
            "ids" => "ssa4141",
            "name" => "신형준",
            "contact" => "01030217486",
            "password" => Hash::make("ssa4141"),
            "accept" => 1
        ]);
    }
}
