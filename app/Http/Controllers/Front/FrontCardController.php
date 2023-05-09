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

class FrontCardController extends Controller{

	public function index(){

		$data['cards_data'] = DB::table('cards')->select('*')->get();
		
		
		return view("Front/cards")->with($data);
	}

	public function addFavourites(Request $request){
		if($request->favorite_id == 1){
			
			$favourite_cards = DB::table('favourite_cards')->where(['user_id'=>$request->user_id,'card_id'=>$request->card_id])->delete();
			session::flash('error', 'Card has been removed in the favourites');
			return redirect()->route('birthday-cards');
		}else{
			$user = Auth::user();
			if($user){
				$favourite_cards = DB::table('favourite_cards')->insert(['user_id'=>$request->user_id,'card_id'=>$request->card_id,'created_at'=>date('Y-m-d H:i:s')]);
				session::flash('success', 'Card has been added in the favourites');
				return redirect()->route('birthday-cards');
			}else{
				return redirect()->route('loginUser');
			}
			
		}
		
	}

	public function post_sizes(Request $request){
		$card_id = $request->card_id;
		$c_size = $request->c_size;
		$qty_box = $request->qty_box;
		$card_qty = $request->card_qty;

		$db_card_id = DB::table('cart_table')->where('card_id',$card_id)->get()->first();
		if(empty($db_card_id)){
			 $db_qty = 0;
		}else{
			 $db_qty = $db_card_id->qty;
		}
       
		//echo $remaining_qty = $card_qty - $db_qty;
        if($card_qty > $db_qty){

        	if(!empty($db_card_id)){
        		$new_card_qty = $db_qty+$qty_box;
				$favourite_cards = DB::table('cart_table')->where('card_id',$card_id)->update(['qty'=>$new_card_qty,'created_at'=>date('Y-m-d H:i:s')]);
			}else{

				$favourite_cards = DB::table('cart_table')->insert(['card_id'=>$card_id,'sizes'=>$c_size,'qty'=>$qty_box,'created_at'=>date('Y-m-d H:i:s')]);
			}
        }else{
        	echo 'Card quantity is not available';
        }
		
		//return redirect()->route('birthday-cards');
	}
}