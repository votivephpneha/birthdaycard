<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Blog;
use File;


class BlogController extends Controller
{
 /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $data['bloglist'] = Blog::orderby('id','DESC')->get();
      return  view('Admin.blog_management.blog_list')->with($data);
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    return view('Admin.blog_management.create_blog');
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
            // "price" => "required",
            "blog_title" => "required",
            "blog_image" => "required",
            "blog_status" => "required",
            "blog_content" => "required",
            "blog_thumb_image" => 'required',
        ]);


        if ($request->hasFile("blog_image")) {
            $image = $request->file("blog_image");
            $imageName = time() . "." . $image->extension();
            $image->move(public_path("upload/blogs"), $imageName);
        }

        if ($request->hasFile("blog_thumb_image")) {
            $thumbimage = $request->file("blog_thumb_image");
            $thumbimageName =  Str::random(6) . time() . '.' . $thumbimage->getClientOriginalExtension();
            $thumbimage->move(public_path("upload/blogs"), $thumbimageName);
        }

        $blog = new Blog();
        $blog->blog_title = $request->blog_title;
        $blog->blog_description = $request->blog_content;
        $blog->status = $request->blog_status;
        $blog->blog_image = $imageName;  
        $blog->blog_thumb_image = $thumbimageName;      
        $blogValue = $blog->save();
 
        if($blogValue ){
            return redirect("admin/blog-list")->with(
                "success",
                "Blog has been added successfully."
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
        $blogdata =  Blog::find($id);
        
        return view('Admin.blog_management.edit_blog',compact('blogdata'));
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
            "blog_title" => "required",
            // "blog_image" => "required",
            "blog_status" => "required",
            "blog_content" => "required",
        ]);

        $blogfind = Blog::find($id);
        if (empty($blogfind)) {
            return back()->with("failed", "Data not found");
        } else {
            
            if ($request->hasFile("blog_image")) {
                $image = $request->file("blog_image");
                $imageName = time() . "." . $image->extension();
                $image->move(public_path("/upload/blogs"), $imageName);
            } else {
                $imageName = $blogfind->blog_image;
            }
                
            if ($request->hasFile("blog_thumb_image")) {
                $bthumimage = $request->file("blog_thumb_image");
                $bthumbimageName =  Str::random(6) .time().'.'.$bthumimage->getClientOriginalExtension();
                $bthumimage->move(public_path("/upload/blogs"), $bthumbimageName);
            } else {
                $bthumbimageName = $blogfind->blog_thumb_image;
            }
            // dd($bthumbimageName);
            // $cardfind->price = $request->price ;
            $blogfind->blog_title = $request->blog_title ;
            $blogfind->blog_description = $request->blog_content;
            $blogfind->status = $request->blog_status;
            $blogfind->blog_image = $imageName;   
            $blogfind->blog_thumb_image = $bthumbimageName;  
            $blogfindvalue = $blogfind->save();
            if($blogfindvalue ){
                return redirect("admin/blog-list")->with(
                    "success",
                    "Blog has been updated successfully."
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
        $bloglist = blog::find($request->id);
        $blogimage = $bloglist->blog_image;
        $blogthumb = $bloglist->blog_thumb_image;
        $deleblogimage_path = public_path('upload/blogs/'.$blogimage);
        $delethblogimage_path = public_path('upload/blogs/'.$blogthumb);
        if(File::exists( $deleblogimage_path) && File::exists($delethblogimage_path) ) {
            File::delete($deleblogimage_path );
            File::delete($delethblogimage_path );
        }
         $result = $bloglist->delete();
         if ($result) {
            return json_encode(array('status' => 'success','msg' => 'Blog has been deleted successfully!'));
         }else {
            return json_encode(array('status' => 'error','msg' => 'Some internal issue occured.'));
         }
    }


    // active inactive status change
    public function Blog_status_change(Request $request)
	{
        $blog_id = $request->blog_id; 
        $newstatus = $request->status;

        if($newstatus == 'Active'){
            $newstatus = 1 ;
        }else{
            $newstatus = 0 ;
        }
        Blog::where('id', $blog_id)
        ->update(['status' => $newstatus
                 ]
                );
       return response()->json('Blog status changed successfully.');
	}

}
