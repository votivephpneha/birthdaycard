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
      $data['editorImagelist'] = EditorImages::orderby('id','DESC')->where('file_type','image')->get();
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
        $editorimage->file_type = 'image';   
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
            $editimagefind->file_type = 'image';
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


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function ShowVideolist()
    {
      $data['videoList'] = EditorImages::orderby('id','DESC')->where('file_type','video')->get();
      return  view('Admin.demo_video.demo_video_list')->with($data);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function CreateDemovideo()
    {
     return view('Admin.demo_video.create_demo_video');
    }


      /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function StoreDemoVideo(Request $request)
    {
        $request->validate([       
            "video" => "required",
            "video_status" => "required",            
        ]);

        if ($request->hasFile("video")) {
            $video = $request->file("video");
            $videoName =  Str::random(6) . time() . '.' . $video->getClientOriginalExtension();
            $video->move(public_path("upload/editorImages"), $videoName);
        }

        $demovideo = new EditorImages();
        $demovideo->editor_image = $videoName;
        $demovideo->status = $request->video_status;   
        $demovideo->file_type = 'video';   
        $demovideoValue = $demovideo->save();
 
        if($demovideoValue ){
            return redirect("admin/demo-video-list")->with(
                "success",
                "Card demo video has been added successfully."
            );
        }else{
           return back()->with("failed", "OOPs! Some internal issue occured.");         
        }
    }

    // active inactive status change
    public function demo_video_Status_change(Request $request)
    {
        $video_id = $request->video_id; 
        $newstatus = $request->status;
         
        if($newstatus == 'Active'){
            $newstatus = 1 ;
        }else{
            $newstatus = 0 ;
        }
        EditorImages::where('id', $video_id)
        ->update(['status' => $newstatus
                ]
                );
    return response()->json('Demo video status changed successfully.');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function DeleteVideo(Request $request)
    {        
        $demovideo = EditorImages::find($request->id);
        $deletevideo = $demovideo->editor_image;
        $deletevideo_path = public_path('upload/editorImages/'.$deletevideo);
      
        if(File::exists( $deletevideo_path) ) {
            File::delete($deletevideo_path );
        }
         $result = $demovideo->delete();
         if ($result) {
            return json_encode(array('status' => 'success','msg' => 'Demo video has been deleted successfully!'));
         }else {
            return json_encode(array('status' => 'error','msg' => 'Some internal issue occured.'));
         }
    }

     /**
     * Display the specified resource.
     *
     * @param  \App\Models\Card  $card
     * @return \Illuminate\Http\Response
     */
    public function editDemoVideo($id)
    {
        $videodata =  EditorImages::find($id);        
        return view('Admin.demo_video.edit_demo_video',compact('videodata'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Card  $card
     * @return \Illuminate\Http\Response
     */
    public function updateDemoVideo(Request $request, $id)
    {
        $request->validate([
            "video_status" => "required",
        ]);

        $demovideofind = EditorImages::find($id);
        if (empty($demovideofind)) {
            return back()->with("failed", "Data not found");
        } else {
            
            if ($request->hasFile("video")) {
                $editvideo= $request->file("video");
                $editvideoName =  Str::random(6) .time().'.'.$editvideo->getClientOriginalExtension();
                $editvideo->move(public_path("/upload/editorImages"), $editvideoName);
                
            } else {
                $editvideoName = $demovideofind->editor_image;
            }

            $demovideofind->editor_image = $editvideoName ;
            $demovideofind->status = $request->video_status;
            $demovideofind->file_type = 'video';
            $demovideofindvalue = $demovideofind->save();
            if($demovideofindvalue ){
                return redirect("admin/demo-video-list")->with(
                    "success",
                    "Demo video has been updated successfully."
                );
            }else{
                return back()->with("failed", "OOPs! Some internal issue occured.");  
            }
            
        }
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function VideoImageList()
    {
      $data['videoImagelist'] = EditorImages::orderby('id','DESC')->where('file_type','video_image')->get();
      return  view('Admin.video_image.video_image_list')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createVideoImage()
    {
     return view('Admin.video_image.create_video_image');
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeVideoImage(Request $request)
    {
        $request->validate([       
            "video_image" => "required",
            "video_image_status" => "required",            
        ]);

        if ($request->hasFile("video_image")) {
            $videoimage = $request->file("video_image");
            $videoimageName =  Str::random(6) . time() . '.' . $videoimage->getClientOriginalExtension();
            $videoimage->move(public_path("upload/editorImages"), $videoimageName);
        }

        $videoimage = new EditorImages();
        $videoimage->editor_image = $videoimageName;
        $videoimage->status = $request->video_image_status;   
        $videoimage->file_type = 'video_image';   
        $videoImageValue = $videoimage->save();
 
        if($videoImageValue ){
            return redirect("admin/video-image-list")->with(
                "success",
                "Video Image has been added successfully."
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
    public function editVideoImage($id)
    {
        $videoimagedata =  EditorImages::find($id);        
        return view('Admin.video_image.edit_video_image',compact('videoimagedata'));
    }


     /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Card  $card
     * @return \Illuminate\Http\Response
     */
    public function updateVideoImage(Request $request, $id)
    {
        $request->validate([
            "video_image_status" => "required",
        ]);

        $editvideoimagefind = EditorImages::find($id);
        if (empty($editvideoimagefind)) {
            return back()->with("failed", "Data not found");
        } else {
            
            if ($request->hasFile("video_image")) {
                $editvideoimage = $request->file("video_image");
                $editvideoimageName =  Str::random(6) .time().'.'.$editvideoimage->getClientOriginalExtension();
                $editvideoimage->move(public_path("/upload/editorImages"), $editvideoimageName);
                
            } else {
                $editvideoimageName = $editvideoimagefind->editor_image;
            }

            $editvideoimagefind->editor_image = $editvideoimageName ;
            $editvideoimagefind->status = $request->video_image_status;
            $editvideoimagefind->file_type = 'video_image';
            $editvideoimagefindvalue = $editvideoimagefind->save();
            if($editvideoimagefindvalue ){
                return redirect("admin/video-image-list")->with(
                    "success",
                    "video image has been updated successfully."
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
    public function DeleteVideoImage(Request $request)
    {        
        $videoimagelist = EditorImages::find($request->id);
        $deletevideoimage = $videoimagelist->editor_image;
        $deletevideoimage_path = public_path('upload/editorImages/'.$deletevideoimage);
      
        if(File::exists( $deletevideoimage_path) ) {
            File::delete($deletevideoimage_path );
        }
         $result = $videoimagelist->delete();
         if ($result) {
            return json_encode(array('status' => 'success','msg' => 'Video Image has been deleted successfully!'));
         }else {
            return json_encode(array('status' => 'error','msg' => 'Some internal issue occured.'));
         }
    }


    // active inactive status change
    public function video_image_Status_change(Request $request)
	{
        $video_image_id = $request->edit_image_id; 
        $newstatus = $request->status;

        if($newstatus == 'Active'){
            $newstatus = 1 ;
        }else{
            $newstatus = 0 ;
        }
        EditorImages::where('id', $video_image_id)
        ->update(['status' => $newstatus
                 ]
                );
       return response()->json('Video Image status changed successfully.');
	}



}
