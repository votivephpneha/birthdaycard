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

	public function delivery_address(Request $request){
		$data['cart_id'] = $request->cart_id;
		$data['cart_data'] = DB::table('cart_table')->where("cart_id",$request->cart_id)->get()->first();
		return view("Front/add_multi_address")->with($data);
	}

	public function saveAddress(Request $request){
		$fname = $request->fname;
		$lname = $request->lname;
		$address = $request->address;
		$door_no = $request->door_no;
		$country = $request->country;
		$state = $request->state;
		$city = $request->city;
		$post_code = $request->post_code;
		$phone_no = $request->phone_no;
		$email_address = $request->email_address;

		$fname_rc = $request->fname_rc;
		$lname_rc = $request->lname_rc;
		$address_rc = $request->address_rc;
		$door_no_rc = $request->door_no_rc;
		$city_rc = $request->city_rc;
		$post_code_rc = $request->post_code_rc;
		$phone_no_rc = $request->phone_no_rc;
		$email_address_rc = $request->email_address_rc;
		$insertAddress = DB::table('cart_table')->where("cart_id",$request->cart_id)->update(['fname' =>$fname,'lname' =>$lname,'address' =>$address,'door_number' =>$door_no,'city' =>$city,'postal_code' =>$post_code,'phone_no' =>$phone_no,'email' =>$email_address,'receiver_fname' =>$fname_rc,'receiver_lname' =>$lname_rc,'receiver_address' =>$address_rc,'receiver_door_number' =>$door_no_rc,'receiver_city' =>$city_rc,'receiver_postal_code' =>$post_code_rc,'receiver_phone_no' =>$phone_no_rc,'receiver_email' =>$email_address_rc,'created_at'=>date('Y-m-d H:i:s')]);
		//$insertAddress = DB::table('cart_table')->where("cart_id",$request->cart_id)->update(['door_no'=>$door_no,'delivered_address_receiver'=>$request->receiver_address,'created_at'=>date('Y-m-d H:i:s')]);
		
		if($insertAddress){
			session::flash('success', 'Delivered address has been added successfully');
			return redirect('/cart');
		}
	}
}