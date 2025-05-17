<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index() {
        //  $admin = Auth::guard('admin')->user();
        // echo 'Welcome ' . $admin->name . '<a  href="'. route('admin.logout') .'">Logout</a> </br>';
        return view('admin.dashboard', ['title' => 'CartList | Administration Panel']);
    }

    public function logout() {
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login');
    }
}
