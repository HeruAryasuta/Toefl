<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BiodataController extends Controller
{
    public function index()
    {
        $users = Auth::user();
        return view('backend.dashboard-user.biodata', compact('users'));
    }
}
