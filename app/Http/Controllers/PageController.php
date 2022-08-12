<?php

namespace App\Http\Controllers;

use App\Http\Resources\AllergyResource;
use App\Http\Resources\BannerResource;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\DietProductResource;
use App\Http\Resources\EventResource;
use App\Http\Resources\ProductResource;
use App\Http\Resources\UserResource;
use App\Models\Allergy;
use App\Models\Banner;
use App\Models\Category;
use App\Models\Event;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PageController extends Controller
{
    public function index(Request $request)
    {
        return Inertia::render("Index", [

        ]);
    }

    public function privacyPolicy()
    {
        return Inertia::render("Policies/PrivacyPolicy");
    }

    public function servicePolicy()
    {
        return Inertia::render("Policies/ServicePolicy");

    }

    public function spamPolicy()
    {
        return Inertia::render("Policies/SpamPolicy");

    }
}
