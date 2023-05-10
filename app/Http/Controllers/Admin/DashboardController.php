<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Card;
use Auth;

class DashboardController extends Controller
{

    public function dashboard(){
        if (Auth::check()) {
            $totaluser = User::where('role','user')->count();
            $totalcard = Card::count();           
            return view("Admin.dashboard",compact('totaluser','totalcard'));
        }
        return redirect("login")->with(
            "failed",
            "You are not allowed to access"
        );
    }
}
