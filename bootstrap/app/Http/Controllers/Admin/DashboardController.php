<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;

class DashboardController extends Controller
{

    public function dashboard(){
        if (Auth::check()) {
            return view("Admin.dashboard");
        }
        return redirect("login")->with(
            "failed",
            "You are not allowed to access"
        );
    }
}
