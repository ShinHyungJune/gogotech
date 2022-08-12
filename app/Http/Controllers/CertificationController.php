<?php

namespace App\Http\Controllers;

use App\Models\Certification;
use Illuminate\Http\Request;

class CertificationController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            "contact" => "nullable|string|max:500",
            "name" => "nullable|string|max:500",
            "CI" => "nullable|string|max:500",
            "DI" => "nullable|string|max:500",
            "sex_code" => "nullable|string|max:500",
            "birth" => "nullable|string|max:500",
            "comm_id" => "nullable|string|max:500",
        ]);

        $certification = Certification::updateOrCreate([
            "contact" => $request->contact
        ], $request->all());

        return redirect("/register?certification_id=".$certification->id);
    }
}
