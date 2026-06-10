<?php

namespace App\Http\Controllers\Perusahaan;

use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        return view('perusahaan.dashboard');
    }
}