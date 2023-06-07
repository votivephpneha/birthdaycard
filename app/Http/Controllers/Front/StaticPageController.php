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
use Mail;

class StaticPageController extends Controller{

	public function index(){

		$data['static_data'] = DB::table('pages')->select('*')->where('page_title','Terms OF Service')->where('page_status','1')->get()->first();
		
		
		return view("Front/terms_service")->with($data);
	}

	public function refund_policy(){

		$data['static_data'] = DB::table('pages')->select('*')->where('page_title','Refund Policy')->where('page_status','1')->get()->first();
		
		
		return view("Front/refund_policy")->with($data);
	}

	public function shipping_policy(){

		$data['static_data'] = DB::table('pages')->select('*')->where('page_title','Shipping Policy')->where('page_status','1')->get()->first();
		
		
		return view("Front/shipping_policy")->with($data);
	}
}