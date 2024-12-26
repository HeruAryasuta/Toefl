<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
    * Show the dashboard.
    *
    * @return \Illuminate\View\View
    */
   public function index()
   {
       return view('dashboard');  // Mengarahkan ke view 'dashboard.blade.php'
   }
}
