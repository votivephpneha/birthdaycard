<?php

namespace App\Http\Controllers;
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\EditorImages;
use File;

class EditorImagesController extends Controller
{
   /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $data['editorImagelist'] = EditorImages::orderby('id','DESC')->get();
      return  view('Admin.editor_images.editor_image_list')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
     return view('Admin.editor_images.create_editor_image');
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
            "editor_image" => "required",
            "editor_image_status" => "required",            
        ]);

        if ($request->hasFile("editor_image")) {
            $image = $request->file("editor_image");
            $imageName =  Str::random(6) . time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path("upload/editorImages"), $imageName);
        }

        $editorimage = new EditorImages();
        $editorimage->editor_image = $imageName;
        $editorimage->status = $request->editor_image_status;   
        $editorImageValue = $editorimage->save();
 
        if($editorImageValue ){
            return redirect("admin/editor-image-list")->with(
                "success",
                "Editor Image has been added successfully."
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
    public function edit($id)
    {
        $editorimagedata =  EditorImages::find($id);        
        return view('Admin.editor_images.edit_editor_image',compact('editorimagedata'));
    }


     /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Card  $card
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            "editor_image_status" => "required",
        ]);

        $editimagefind = EditorImages::find($id);
        if (empty($editimagefind)) {
            return back()->with("failed", "Data not found");
        } else {
            
            if ($request->hasFile("editor_image")) {
                $editimage = $request->file("editor_image");
                $editimageName =  Str::random(6) .time().'.'.$editimage->getClientOriginalExtension();
                $editimage->move(public_path("/upload/editorImages"), $editimageName);
                
            } else {
                $editimageName = $editimagefind->editor_image;
            }

            $editimagefind->editor_image = $editimageName ;
            $editimagefind->status = $request->editor_image_status;
            $editimagefindvalue = $editimagefind->save();
            if($editimagefindvalue ){
                return redirect("admin/editor-image-list")->with(
                    "success",
                    "Editor image has been updated successfully."
                );
            }else{
                return back()->with("failed", "OOPs! Some internal issue occured.");  
            }
            
        }
    }

     /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {        
        $editorimagelist = EditorImages::find($request->id);
        $deleteimage = $editorimagelist->editor_image;
        $deleteimage_path = public_path('upload/editorImages/'.$deleteimage);
      
        if(File::exists( $deleteimage_path) ) {
            File::delete($deleteimage_path );
        }
         $result = $editorimagelist->delete();
         if ($result) {
            return json_encode(array('status' => 'success','msg' => 'Editor Image has been deleted successfully!'));
         }else {
            return json_encode(array('status' => 'error','msg' => 'Some internal issue occured.'));
         }
    }


    // active inactive status change
    public function editor_image_Status_change(Request $request)
	{
        $edit_image_id = $request->edit_image_id; 
        $newstatus = $request->status;

        if($newstatus == 'Active'){
            $newstatus = 1 ;
        }else{
            $newstatus = 0 ;
        }
        EditorImages::where('id', $edit_image_id)
        ->update(['status' => $newstatus
                 ]
                );
       return response()->json('Editor Image status changed successfully.');
	}

}
