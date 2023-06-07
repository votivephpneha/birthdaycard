<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Card;
use Illuminate\Http\Request;
use DB;
use File;

class GiftController extends Controller
{
/**
 * Display a listing of the resource.
 *
 * @return \Illuminate\Http\Response
 */
public function index()
{
    $data['giftList'] = DB::table('cards')->where('gift_card','gift')->orderby('id', 'DESC')->get();
    return view('Admin.gift_management.gift_list')->with($data);
}

 /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {    
    return view('Admin.gift_management.create_gift');
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            "price" => "required",
            "title" => "required",
            "gift_image" => "required",
            "gift_status" => "required",            
        ]);

        if ($request->gift_status == 1) {
            $status = "Active";
        } else {
            $status = "Inactive";
        }

        if ($request->hasFile("gift_image")) {
            $giftimage = $request->file("gift_image");
            $giftimageName = time() . "." . $giftimage->extension();
            $giftimage->move(public_path("upload/cards"), $giftimageName);
        }

        $gift = new Card();
        $gift->price = $request->price;
        $gift->card_title = $request->title;
        $gift->description = null;
        $gift->status = $status;
        // $card->qty = $request->qty;
        $gift->card_image = $giftimageName;
        $gift->category_id = null;
        $gift->sub_category_id = null;
        $gift->card_back_image =  null;
        $gift->gift_card  =  'gift';
        // $gift->gift_title =  $request->title;
        // $gift->gift_image =  $giftimageName;        
        $giftValue = $gift->save();
 
        if($giftValue ){
            return redirect("admin/giftlist")->with(
                "success",
                "gift has been added successfully."
            );
        }else{
           return back()->with("failed", "OOPs! Some internal issue occured.");         
        }
       

    }

        /**
     * Display the specified resource.
     *
     * @param  \App\Models\Card  $card
     * @return \Illuminate\Http\Response
     */
    public function show(Card $card,$id)
    {
        $viewgiftdata =  Card::find($id);       
        return view('Admin.gift_management.view_gift',compact('viewgiftdata'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Card  $card
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $giftdata =  Card::find($id);
        return view('Admin.gift_management.edit_gift',compact('giftdata'));
    }

        /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Card  $card
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Card $card,$id)
    {
        $request->validate([
            "price" => "required",           
            "gift_status" => "required",
            "title" => "required",           
        ]);

        $giftfind = Card::find($id);
        if (empty($giftfind)) {
            return back()->with("failed", "Data not found");
        } else {
            if ($request->gift_status == 1) {
                $status = "Active";
            } else {
                $status = "Inactive";
            }

            if ($request->hasFile("gift_image")) {
                $gift_image = $request->file("gift_image");
                $gift_imageName = time() . "." . $gift_image->extension();
                $gift_image->move(public_path("/upload/cards"), $gift_imageName);
            } else {
                $gift_imageName = $giftfind->card_image;
            }
          
            $giftfind->price = $request->price ;
            $giftfind->card_title = $request->title ;
            $giftfind->description = null;
            $giftfind->status = $status;
            $giftfind->card_image = $gift_imageName;
            $giftfind->category_id = null;
            $giftfind->sub_category_id = null; 
            $giftfind->card_back_image =  null;
            $giftfind->gift_card =  'gift';

            $giftupdatevalue = $giftfind->save();

            
            
            if($giftupdatevalue ){
                return redirect("admin/giftlist")->with(
                    "success",
                    "Gift has been updated successfully."
                );
            }else{
                return back()->with("failed", "OOPs! Some internal issue occured.");  
            }
            
        }
    }

     /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Card  $card
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
       $giftlist = Card::find($request->id);       
       $gift_image_name =  $giftlist->gift_image;
       $gift_image_path = public_path('upload/cards/'.$gift_image_name);
       if(File::exists($gift_image_path)) {
         File::delete($gift_image_path);
       }
        $result = $giftlist->delete();
        // return response()->json('success');
        if ($result) {
            return json_encode(array('status' => 'success','msg' => 'Gift has been deleted successfully!'));
        } else {
            return json_encode(array('status' => 'error','msg' => 'Some internal issue occured.'));
        }
    }
    
    // gift status change
    public function Gift_Status_change(Request $request)
	{
        $gift_id = $request->gift_id; 
        $newstatus = $request->status;

        Card::where('id', $gift_id)
        ->update(['status' => $newstatus
                 ]
                );
       return response()->json('Gift status changed successfully.');
	}


}
