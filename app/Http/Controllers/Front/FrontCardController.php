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

		$data['cards_data'] = DB::table('cards')->select('*')->where('gift_card',NULL)->where('status','Active')->get();
		
		
		return view("Front/cards")->with($data);
	}

	public function addFavourites(Request $request){
		if($request->favorite_id == 1){
			
			$favourite_cards = DB::table('favourite_cards')->where(['user_id'=>$request->user_id,'card_id'=>$request->card_id])->delete();
			if($request->gift_card == "gifts"){
				session::flash('error', 'Gift has been removed in the favourites');
				return redirect()->route('gift_card');
			}else{
				session::flash('success', 'Card has been removed in the favourites');
				return redirect()->route('birthday-cards');
			}
			
		}else{
			$user = Auth::guard("customer")->user();
			if($user){
				$favourite_cards = DB::table('favourite_cards')->insert(['user_id'=>$request->user_id,'card_id'=>$request->card_id,'created_at'=>date('Y-m-d H:i:s')]);
				if($request->gift_card == "gifts"){
					session::flash('success', 'Gift has been added in the favourites');
					return redirect()->route('gift_card');
				}else{
					session::flash('success', 'Card has been added in the favourites');
					return redirect()->route('birthday-cards');
				}
				
			}else{
				return redirect()->route('loginUser');
			}
			
		}
		
	}

	public function post_sizes(Request $request){
		$card_id = $request->card_id;
		$c_size = $request->c_size;
		
		$description = $request->description;
		$qty_box = "1";
		$card_size_price = $request->card_size_price;

		$price_after_qty = $qty_box * $card_size_price;
		
		if(Auth::user()){
			$user_id = Auth::user()->id;
		}else{
			$user_id = 0;
		}

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
            
        	$favourite_cards = DB::table('cart_table')->insertGetId(['card_id'=>$card_id,'sizes'=>$c_size,'user_id'=>$user_id,'qty'=>$qty_box,'price'=>$price_after_qty,'status'=>'0','created_at'=>date('Y-m-d H:i:s')]);
				//echo $favourite_cards;die;
				//Session::put('cart_id', $favourite_cards);
				return redirect('video_upload_page/'.$favourite_cards);
			
        }else{
        	
        	session::flash('error', 'Card quantity is not available');
        	return redirect()->route('birthday-cards');

        }
		
		//return redirect()->route('birthday-cards');
	}

	public function video_upload_page(Request $request){
		$cart_data = DB::table('cart_table')->where('cart_id',$request->cart_id)->get()->first();
		$card_id = $cart_data->card_id;
		$data['db_card_data'] = DB::table('cards')->where('id',$card_id)->get()->first();
		$data['c_size_id'] = $cart_data->sizes;
		$data['cart_id'] = $request->cart_id;

		$data['db_video_page_data'] = DB::table('card_editor_images')->where('file_type','video')->get()->first();
		$data['db_video_data'] = DB::table('videos')->where('cart_id',$request->cart_id)->get()->first();
        
		return view('Front/video_page')->with($data);
	}

	public function post_video(Request $request){
		$file_time = $request->file_time;
		$card_id = $request->card_id;
		$card_size_id = $request->card_size_id;
		$cart_id = $request->cart_id;
		$qr_img_val = $request->qr_img_val;
		$file = $request->file('add_video_file');
		
		$movieFileType=$file->getClientOriginalName();
		$file_type = explode(".",$movieFileType);
        $file_type1 = end($file_type);
		if($file){
	        $destinationPath = base_path() .'/public/upload/videos';
	        $file_name = $file_time.".".$file_type1;
	        $file->move($destinationPath,$file_name);

	        $data['video_data'] = DB::table('videos')->where('cart_id',$cart_id)->get()->first();

	        if($data['video_data']){
	        	 
	        	$favourite_cards = DB::table('videos')->where('cart_id',$cart_id)->update(['video_name'=>$file_name,'qr_image_link'=>$qr_img_val, 'created_at'=>date('Y-m-d H:i:s')]);

	        }else{
	        	$video_id = DB::table('videos')->insertGetId(['video_name'=>$file_name,'cart_id'=>$cart_id, 'qr_image_link'=>$qr_img_val, 'created_at'=>date('Y-m-d H:i:s')]);
	        	
	        	$favourite_cards = DB::table('cart_table')->where('cart_id',$cart_id)->update(['video_id'=>$video_id, 'created_at'=>date('Y-m-d H:i:s')]);

	        	
	        }

	        session::flash('success', 'QR code is generated for this video');

	 
	        
    	}else{
    		session::flash('error', 'Please upload the video');
    		return redirect('video_upload_page/'.$cart_id);
    	}
	}

	public function show_video(Request $request){
		$cart_data = DB::table('cart_table')->where('cart_id',$request->cart_id)->get()->first();
		$card_id = $cart_data->card_id;
		$card_size_id = $cart_data->sizes;
		$data['card_id'] = $card_id;
		$data['card_size_id'] = $card_size_id;
		$data['cart_id'] = $request->cart_id;
		$data['db_card_data'] = DB::table('videos')->where('cart_id',$data['cart_id'])->get()->first();
		//print_r($data['db_card_data']);die;
		return view('Front/show_video')->with($data);
	}

	public function show_video_image(Request $request){
		$cart_data = DB::table('cart_table')->where('cart_id',$request->cart_id)->get()->first();
		$card_id = $cart_data->card_id;
		$card_size_id = $cart_data->sizes;
		$data['card_id'] = $card_id;
		$data['card_size_id'] = $card_size_id;
		$data['cart_id'] = $request->cart_id;
		$data['db_video_page_data'] = DB::table('card_editor_images')->where('file_type','video_image')->get()->first();
		return view('Front/show_image')->with($data);
	}

	public function delete_video(Request $request){
		$card_id = $request->card_id;
		$card_size_id = $request->card_size_id;
		$cart_id = $request->cart_id;

		$favourite_cards = DB::table('videos')->where('cart_id',$cart_id)->delete();

		return redirect('video_upload_page/'.$card_id.'/'.$card_size_id);
	}

	public function card_editor(Request $request){
		$cart_data = DB::table('cart_table')->where('cart_id',$request->cart_id)->get()->first();
		$card_id = $cart_data->card_id;
		$card_size_id = $cart_data->sizes;
		$data['card_id'] = $card_id;
		$data['card_size_id'] = $card_size_id;
        
		$data['cart_id'] = $request->cart_id;
		//print_r($data['cart_id']->status);die;
		$data['db_card_data'] = DB::table('cards')->where('id',$card_id)->get()->first();
		$data['colors'] = DB::table('text_colors')->get();
		$data['fonts'] = DB::table('text_fonts')->get();
		$data['messages'] = DB::table('messages')->get();
		$data['editor_image'] = DB::table('card_editor_images')->where('file_type','image')->get()->first();
		$data['card_type'] = $request->card_type;
		// $data['db_text_data'] = DB::table('predesigned_text')->where('cart_id',$data['cart_id']->cart_id)->where('txt_id',1)->get()->first();
		// $data['db_text_data1'] = DB::table('predesigned_text')->where('cart_id',$data['cart_id']->cart_id)->where('txt_id',2)->get()->first();
		// $data['db_text_data2'] = DB::table('predesigned_text')->where('cart_id',$data['cart_id']->cart_id)->where('txt_id',3)->get()->first();

		return view('Front/card_editor')->with($data);
	}

	public function post_card(Request $request){
		$text_id = $request->text_id;
		$card_id = $request->card_id;
		$card_size_id = $request->card_size_id;
		$cart_id = $request->cart_id;
		
		$text_size_font1 = $request->text_size_font1;
		$text_color_font1 = $request->text_color_font1;
		$text_font1 = $request->text_font1;
		$text_align_hor_font1 = $request->text_align_hor_font1;
		$text_align_ver_font1 = $request->text_align_ver_font1;
		$text_font_font1 = $request->text_font_font1;
	
		$text_size_font2 = $request->text_size_font2;
		$text_color_font2 = $request->text_color_font2;
		$text_font2 = $request->text_font2;
		$text_align_hor_font2 = $request->text_align_hor_font2;
		$text_align_ver_font2 = $request->text_align_ver_font2;
		$text_font_font2 = $request->text_font_font2;
	
		

		$data['db_text_data'] = DB::table('predesigned_text')->where('cart_id',$cart_id)->get()->first();
		//print_r($data['db_text_data']);die;
		
		if($text_font1 && $text_font2){
			if(empty($data['db_text_data'])){
			
				$post_text1 = DB::table('predesigned_text')->insertGetId(['cart_id'=>$cart_id,'txt_id'=>1,'size'=>$text_size_font1,'color'=>$text_color_font1,'Text'=>$text_font1,'font'=>$text_font_font1,'horizontal_alignment'=>$text_align_hor_font1,'vertical_alignment'=>$text_align_ver_font1,'created_at'=>date('Y-m-d H:i:s')]);
			
			
				$post_text2 = DB::table('predesigned_text')->insertGetId(['cart_id'=>$cart_id,'txt_id'=>2,'size'=>$text_size_font2,'color'=>$text_color_font2,'Text'=>$text_font2,'font'=>$text_font_font2,'horizontal_alignment'=>$text_align_hor_font2,'vertical_alignment'=>$text_align_ver_font2,'created_at'=>date('Y-m-d H:i:s')]);
			

				$post_text = $post_text1.",".$post_text2;

				$update_cart_status = DB::table('cart_table')->where('cart_id',$cart_id)->where('sizes',$card_size_id)->update(['status'=>1,'predesigned_text_id'=>$post_text,'created_at'=>date('Y-m-d H:i:s')]);
				
			}else{
				
				$post_text = DB::table('predesigned_text')->where('cart_id',$cart_id)->where('txt_id',1)->update(['size'=>$text_size_font1,'color'=>$text_color_font1,'Text'=>$text_font1,'created_at'=>date('Y-m-d H:i:s')]);
			
			
				$post_text = DB::table('predesigned_text')->where('cart_id',$cart_id)->where('txt_id',2)->update(['size'=>$text_size_font2,'color'=>$text_color_font2,'Text'=>$text_font2,'created_at'=>date('Y-m-d H:i:s')]);
			
				
			}
			
			
		}
		$update_cart_status = DB::table('cart_table')->where('cart_id',$cart_id)->where('sizes',$card_size_id)->update(['status'=>1,'created_at'=>date('Y-m-d H:i:s')]);
		session::flash('success', 'The card has been added to the basket.');
	    return redirect('cart_continue');
	}

	public function cart_continue(){
		return view("Front/cart_continue");
	}

	public function cart_page(){
		
		return view("Front/cart");
	}

	public function cart_table_show_data(Request $request){
		$cart_id = $request->cart_id;
        
        $uesr_id = Auth::user()->id;
		$cart_update = DB::table('cart_table')->where('cart_id',$cart_id)->update(['user_id'=>$uesr_id,'created_at'=>date('Y-m-d H:i:s')]);
		
	}

	public function cart_data(Request $request){
		$cart_id = $request->cart_id;
		$data['cart_data'] = DB::table('cart_table')->where('cart_id',$cart_id)->where('status',1)->get();
		

		$card_id = $data['cart_data'][0]->card_id;
		$card_sizes = $data['cart_data'][0]->sizes;

		$data['card_size_data'] = DB::table('card_sizes')->where('id',$card_sizes)->where('card_id',$card_id)->get()->first();

		if(!empty($data['card_size_data'])){
        	$card_qty =  $data['card_size_data']->card_size_qty;
        	
			$remaining_qty = $card_qty - $data['cart_data'][0]->qty;
			$data['remaining_qty'] = $remaining_qty;
        }

		
		return view('Front/cart_data')->with($data);
		
	}

	public function post_cart(Request $request){
		$cart_id = $request->cart_id;
		
		$qty = $request->qty;
		$price = $request->price;

		$cart_update = DB::table('cart_table')->where('cart_id',$cart_id)->update(['qty'=>$qty,'price'=>$price,'created_at'=>date('Y-m-d H:i:s')]);

		
	}

	public function check_gift_data(Request $request){
		$cart_ids = $request->cart_ids;
		$cart_id_array = json_decode($cart_ids);
		//print_r(json_decode($cart_ids));
		$i = 0;
		foreach ($cart_id_array as $cart_id) {
			$cart_data = DB::table('cart_table')->where('cart_id',$cart_id)->get()->first();
			if($cart_data->card_type == "Gift"){
				$i++;
			}
		}
		$count_cart = count($cart_id_array);
		if($count_cart == $i){
			return true;
		}
	}

	public function get_cards(Request $request){
		
		if($request->search_words){
			$data['search_data'] = DB::table('cards')->where("card_title", 'like', '%'.$request->search_words.'%')->get();
			//print_r($search_data);
			if(count($data['search_data'])>0){
				foreach ($data['search_data'] as $search_data) {
					$data1['search_data'] = $search_data;
					echo view("Front/search_data")->with($data1);
				}
			}else{
				echo "No card found";
			}
		}else{
			echo "No card found";
		}
	}

	public function searchModel(Request $request){
		$card_id = $request->card_id;
		echo view('Front/search_modal',["card_id"=>$card_id]);
	}

	public function delete_cart_item(Request $request){
		$cart_id = $request->cart_id;

		$delete_cart_item = DB::table('cart_table')->where('cart_id',$cart_id)->delete();
        
		session::flash('success', 'Cart item remove successfully');

		//return redirect('cart');
	}

	public function checkout(Request $request){
		
		$data['countries'] = DB::table('countries')->get();
		
		return view("Front/checkout")->with($data);
	}

	public function get_state(Request $request){
		$country_id = $request->country_id;
		$data['states'] = DB::table('states')->where('country_id',$country_id)->get();

		foreach ($data['states'] as $states) {
			echo "<option value=".$states->id.">".$states->name."</option>";
		}
		
	}

	public function get_city(Request $request){
		$state_id = $request->state_id;
		$data['cities'] = DB::table('cities')->where('state_id',$state_id)->get();

		foreach ($data['cities'] as $cities) {
			echo "<option value=".$cities->id.">".$cities->name."</option>";
		}
		
	}

	public function post_checkout(Request $request){
		$cart_id_array = $request->cart_id_array;
		
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
		
		$order_notes = $request->order_notes;
		$order_total_price = $request->order_total_price;
		$order_notes = $request->order_notes;
		$order_total_price = $request->order_total_price;

		if(Auth::user()){
			$user_id = Auth::user()->id;
		}else{
			$user_data = DB::table('users')->where("email",$email_address)->get()->first();
			if($user_data){
				$user_id = $user_data->id;
			}else{
				$user_id = DB::table('users')->insertGetId(['fname'=>$fname,'lname'=>$lname, 'phone'=>$phone_no, 'email'=>$email_address, 'address'=>$address, 'created_at'=>date('Y-m-d H:i:s')]);
			}
			
		}

		$user_data = array('user_id'=>$user_id,'fname' =>$fname,'lname' =>$lname,'address' =>$address,'door_no' =>$door_no,'country' =>$country,'state' =>$state,'city' =>$city,'post_code' =>$post_code,'phone_no' =>$phone_no,'email_address' =>$email_address,'fname_rc' =>$fname_rc,'lname_rc' =>$lname_rc,'address_rc' =>$address_rc,'door_no_rc' =>$door_no_rc,'city_rc' =>$city_rc,'post_code_rc' =>$post_code_rc,'phone_no_rc' =>$phone_no_rc,'email_address_rc' =>$email_address_rc,'order_notes' =>$order_notes,'order_total_price' =>$order_total_price );
		session::put("user_data",$user_data);
		return redirect('ex_gift_card/');

	}

	public function order_status(Request $request){
		$order_id = $request->order_id;
		
		return view("Front/order_status",['order_id'=>$order_id]);
	}

	public function checkout_data(Request $request){

		$cart_id = $request->cart_id;
		$data['cart_data'] = DB::table('cart_table')->where('cart_id',$cart_id)->where('status',1)->get();

		
		return view('Front/checkout_data')->with($data);
	}

	public function check_cart_count(Request $request){
		$cart_id = $request->cart_ids;
		
		$cart_id_array = json_decode($cart_id);
		
		$sum = 0;
		foreach($cart_id_array as $cart_id) {
			$cart_data = DB::table('cart_table')->where('cart_id',$cart_id)->where('status',1)->get()->first();
			$sum = $sum + $cart_data->qty;
		}
		return $sum; 
		
	}

	public function search_submit(Request $request){

		if($request->search_words){
			$data['search_data'] = DB::table('cards')->where("card_title", 'like', '%'.$request->search_words.'%')->get();
			//print_r($data['search_data']);die;
			$data['request_data'] = $request->search_words;
		}else{
			$data['request_data'] = "";
			$data['search_data'] = array();
			$data['no_data'] = $request->search_words;
		}
		
		return view('Front/search')->with($data);
		
		
	}

	public function contact_us(){
		$data['contact_us'] = DB::table('pages')->where('page_title','Contact Us')->where('page_status',"1")->get()->first();
		return view('Front/contact')->with($data);
	}


	public function submitContact(Request $request){

		$users = DB::table('contact_us')->insert(['name'=>$request->fname,'email'=>$request->email,'message'=>$request->message,'subject'=>$request->subject,'status'=>'Active','created_at'=>date('Y-m-d H:i:s')]);
		$token = Str::random(64);
		
		Mail::send('Front.contact-us-email', ['token' => $token,'email'=>$request->email,'fname'=>$request->fname,'phone_no'=>$request->phone_no,'msg'=>$request->message], function($message) use($request){
            $message->to("turabi.ltd@gmail.com");
            $message->from($request->email,'BirthdayCards');
            $message->subject($request->subject);
        });

        session::flash('success', 'Thanks for contacting us. We will get back to you as soon as possible.');

        return redirect('contact-us');
	}

	// get about us page
	public function about_us(){	 
		$data['aboutdata'] = DB::table('pages')->where('id',1)->where('page_status',1)->first();
		return view('Front/about_us')->with($data);	
	}

	public function express_gift_card(Request $request){
		$data['gift_card'] = DB::table("cards")->where("gift_card","gift")->where("status","Active")->get();
		$data['order_id'] = $request->order_id;
		return view("Front/express_gift_card")->with($data);
	}

	public function submit_ex_gift_card(Request $request){

		$get_order_data = DB::table('order')->where("order_id",$request->order_id)->get()->first();

		$get_card_price = DB::table('cards')->where("id",$request->gift_id)->get()->first();
		
		

		$gift_ids = $request->gift_id;
		if(!empty($gift_ids)){
			if(Auth::user()){
             return redirect('payment_transaction/');
            }else{
             return redirect('ex_payment_transaction/');
            }
			
		}else{
			session::flash('error', 'Please select the gift');
			return redirect('ex_gift_card/');
		}


		
	}

	public function insertSingleGift(Request $request){
		$user_id = session::get("user_id");
		$insertGift = DB::table('order_details')->insert(['order_id'=>$request->order_id,'user_id'=>$user_id,'card_id'=>$request->gift_id,'qty'=>'1','card_price'=>'0.00','created_at'=>date('Y-m-d H:i:s')]);
		return $insertGift;
	}

	public function send_newsletter(Request $request){
		$token = Str::random(64);
		Mail::send('Front.newsletter_email', ['token' => $token,'email'=>$request->email_field], function($message) use($request){
                    $message->to($request->email_field);
                    $message->from('birthday@birthdaystoreuk.co.uk','BirthdayCards');
                    $message->subject('Newsletter Email');

        });
		session::flash('success', 'Thanks for subscribe us.');
		return redirect('/');
	}

	public function gift_basket(Request $request){
		
		$insertGift = DB::table('cart_table')->insertGetId(['card_id'=>$request->gift_card_id,'qty'=>'1','price'=>$request->price,'status'=>'1','created_at'=>date('Y-m-d H:i:s')]);
		return $insertGift;
	}

	public function get_gift_cart_data(Request $request){
		$get_cart_data = DB::table('cart_table')->where("cart_id",$request->cart_id)->get()->first();
		//print_r($get_cart_data);die;
		return json_encode($get_cart_data);die;
	}
}