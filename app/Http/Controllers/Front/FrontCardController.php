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

		$data['cards_data'] = DB::table('cards')->select('*')->where('status','Active')->get();
		
		
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
		

		$db_card_size = DB::table('card_sizes')->where('id',$c_size)->get()->first();
		
        $card_size_qty = $db_card_size->card_size_qty;
		$db_card_id = DB::table('cart_table')->where('card_id',$card_id)->where('sizes',$c_size)->get()->first();
		if(empty($db_card_id)){
			 $db_qty = 0;
		}else{
			 $db_qty = $db_card_id->qty;
		}
		
        $total_qty = $qty_box + $db_qty;
        
		
        if($card_size_qty >= $total_qty){
            
        	if(!empty($db_card_id)){
        		$new_card_qty = $db_qty+$qty_box;
				$favourite_cards = DB::table('cart_table')->where('card_id',$card_id)->update(['qty'=>$new_card_qty,'created_at'=>date('Y-m-d H:i:s')]);
				return redirect('video_upload_page/'.$card_id.'/'.$c_size);
			}else{

				$favourite_cards = DB::table('cart_table')->insert(['card_id'=>$card_id,'sizes'=>$c_size,'qty'=>$qty_box,'status'=>'0','created_at'=>date('Y-m-d H:i:s')]);
				return redirect('video_upload_page/'.$card_id.'/'.$c_size);
			}
        }else{
        	
        	session::flash('error', 'Card quantity is not available');
        	return redirect()->route('birthday-cards');

        }
		
		//return redirect()->route('birthday-cards');
	}

	public function video_upload_page(Request $request){
		$card_id = $request->card_id;
		$data['db_card_data'] = DB::table('cards')->where('id',$card_id)->get()->first();
		$data['c_size_id'] = $request->card_size_id;

		return view('Front/video_page')->with($data);
	}

	public function post_video(Request $request){
		$card_id = $request->card_id;
		$card_size_id = $request->card_size_id;
		$qr_img_val = $request->qr_img_val;
		$file = $request->file('add_video_file');
		if($file){
	        $destinationPath = base_path() .'/public/upload/videos';
	        $file->move($destinationPath,$file->getClientOriginalName());

	        $favourite_cards = DB::table('cart_table')->where('card_id',$card_id)->where('sizes',$card_size_id)->update(['video'=>$file->getClientOriginalName(),'qr_image_link'=>$qr_img_val, 'created_at'=>date('Y-m-d H:i:s')]);
	        return redirect('show_video/'.$card_id.'/'.$card_size_id);
    	}else{
    		session::flash('error', 'Please upload the video');
    		return redirect('video_upload_page/'.$card_id.'/'.$card_size_id);
    	}
	}

	public function show_video(Request $request){
		$card_id = $request->card_id;
		$card_size_id = $request->card_size_id;
		$data['card_size_id'] = $card_size_id;
		$data['db_card_data'] = DB::table('cart_table')->where('card_id',$card_id)->where('sizes',$card_size_id)->get()->first();
		return view('Front/show_video')->with($data);
	}

	public function delete_video(Request $request){
		$card_id = $request->card_id;
		$card_size_id = $request->card_size_id;
		$favourite_cards = DB::table('cart_table')->where('card_id',$card_id)->where('sizes',$card_size_id)->update(['video'=>"",'qr_image_link'=>"", 'created_at'=>date('Y-m-d H:i:s')]);

		return redirect('video_upload_page/'.$card_id.'/'.$card_size_id);
	}

	public function card_editor(Request $request){
		$card_id = $request->card_id;
		$card_size_id = $request->card_size_id;
		$data['db_card_data'] = DB::table('cards')->where('id',$request->card_id)->get()->first();
		$data['db_card_size_data'] = DB::table('cart_table')->where('card_id',$request->card_id)->where('sizes',$card_size_id)->get()->first();
		return view('Front/card_editor')->with($data);
	}
}