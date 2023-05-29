<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Contactus;
use Illuminate\Http\Request;

class ContactusController extends Controller
{
  /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $data['contactlist'] = Contactus::orderby('id','DESC')->get();
      return  view('Admin.contact_us.contact_us_list')->with($data);
    } 

     /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        
        $contactlist = Contactus::find($request->id);
         $result = $contactlist->delete();
         if ($result) {
            return json_encode(array('status' => 'success','msg' => 'Contact us has been deleted successfully!'));
         }else {
            return json_encode(array('status' => 'error','msg' => 'Some internal issue occured.'));
         }
    }


    // active inactive status change
    public function Contactus_status_change(Request $request)
	{
        $contact_id = $request->contact_id; 
        $newstatus = $request->status;
        if($newstatus == 'Active'){
         $newstatus = 1 ;
         }else{
               $newstatus = 0 ;
         }
        Contactus::where('id', $contact_id)
        ->update(['status' => $newstatus
                 ]
                );
       return response()->json('Contact us status changed successfully.');
	}
}
