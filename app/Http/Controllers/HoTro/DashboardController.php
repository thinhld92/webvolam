<?php

namespace App\Http\Controllers\HoTro;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = auth()->user();
        
        return view('hotro.dashboard', compact(
            'user',
        ));
    }

    
}
