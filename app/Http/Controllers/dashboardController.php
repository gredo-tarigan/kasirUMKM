<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class dashboardController extends Controller
{
    //
    public function index()
    {

        return view('dashboard.dashboard', [
            "title" => "Dashboard",
            "judul_konten" => "Tarigan Jack",
            "carbon_today" => Carbon::today(),
        ]);
    }
}
