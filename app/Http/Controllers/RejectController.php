<?php

namespace App\Http\Controllers;

use App\Models\Reject;
use Illuminate\Http\Request;

class RejectController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            "contact" => "required|string|max:500"
        ]);

        $request["contact"] = str_replace("-", "",$request->contact);

        Reject::updateOrCreate([
            "contact" => $request->contact
        ], [
            "contact" => $request->contact
        ]);
    }
}
