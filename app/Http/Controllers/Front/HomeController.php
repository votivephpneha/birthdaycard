<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use Illuminate\Http\Request;
use File;
use Session;
use Illuminate\Support\Str;
use App\Models\User;
use DB,Validator;
use Hash;
use Auth;

class HomeController extends Controller{

	public function index(){
		$data['home_data'] = DB::table("home_page")->where("id","5")->get()->first();
		$data['customer_slider'] = DB::table("home_first_slider")->get();
		$data['favourite_slider'] = DB::table("home_sec_slider")->get();
		return view('Front/home')->with($data);
	}

	public function blogs(){
		$data['blog_data'] = DB::table("blogs")->where("status","1")->get();

		return view('Front/blogs')->with($data);
	}

	public function blog_detail(Request $request){
		$data['blog_detail'] = DB::table("blogs")->where("id",$request->blog_id)->get()->first();

		return view('Front/blog_detail')->with($data);
	}

	public function gift_card(Request $request){
		$data['gift_card'] = DB::table("cards")->where("gift_card","gift")->where("status","Active")->get();
		return view('Front/gift')->with($data);
	}

	public function submit_gift(Request $request){
		$cart_id = DB::table('cart_table')->insertGetId(['card_id'=>$request->gift_card_id,'qty'=>'1','price'=>$request->gift_card_price,'card_type'=>'Gift','status'=>'1','created_at'=>date('Y-m-d H:i:s')]);
		session::flash('success', 'Gift has been added in the basket. Please add the at least one card with the gift');
		return $cart_id;
		//return redirect()->route('birthday-cards');
	}
}