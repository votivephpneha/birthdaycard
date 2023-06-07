<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Page;
use App\Models\HomePage;
use App\Models\HomeFirstSlide;
use App\Models\HomeSecSlide;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AdminPagesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['pageList'] = Page::orderby('id','DESC')->get();
       return view("Admin.admincpages.page_list")->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("Admin.admincpages.create_page_form");
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
            
            "title" => "required",
            "page_content" => "required",
            "slug" => "required",
            "sub_title" => "required",
            "page_status" =>"required",
        ]);

        $page_slug = $request->slug;

		$page_url = Str::slug($page_slug, '-');
        $page = new Page();
        $page->page_url =  $page_url;
        $page->page_title = $request->title;
        $page->page_content = $request->page_content;
        $page->sub_title = $request->sub_title;
        $page->page_status = $request->page_status;

        $res = $page->save();
        
        if($res){
        return redirect("admin/content-pagelist")->with('success','Page content has been added Successfully.');
        }else{
        return back()->with("failed", "OOPs! Some internal issue occured.");   
        }
     
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $pagedata = Page::find($id);
  
      return view("Admin.admincpages.edit_page_content",compact('pagedata'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            "title" => "required",
            "page_content" => "required",
            "slug" => "required",
            "sub_title" => "required",
            "page_status" =>"required",
        ]);

        $pagefind = Page::find($id);
        if (empty($pagefind)) {
            return back()->with("failed", "Data not found");
        }else{
            $page_slug = $request->slug;

            $page_url = Str::slug($page_slug, '-');
           
            $pagefind->page_url =  $page_url;
            $pagefind->page_title = $request->title;
            $pagefind->page_content = $request->page_content;
            $pagefind->sub_title = $request->sub_title;
            $pagefind->page_status = $request->page_status; 
            
            $res = $pagefind->save();
            
            if($res){
            return redirect("admin/content-pagelist")->with('success','Page content has been  updated successfully.');
            }else{
            return back()->with("failed", "OOPs! Some internal issue occured.");
            }
           
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $id = $request->id;
        $pages = Page::find($id);
        $result = $pages->delete();

        if ($result) {
            return json_encode(array('status' => 'success','msg' => 'Page has been deleted successfully!'));
         }else {
            return json_encode(array('status' => 'error','msg' => 'Some internal issue occured.'));
         }
    }

    //  get page list by ajax
    public function getPagelist(Request $request)
    {
        $totalFilteredRecord = $totalDataRecord = $draw_val = "";
        $columns_list = array(
        0 =>'id',
        1 =>'srno',
        2=> 'title',
        3=> 'status',                      
        4=> 'action'
        );
            
        $totalDataRecord = Page::count();
            
        $totalFilteredRecord = $totalDataRecord;
            
        $limit_val = $request->input('length');
        $start_val = $request->input('start');
        $order_val = $columns_list[$request->input('order.0.column')];
        $dir_val = $request->input('order.0.dir');
            
        if(empty($request->input('search.value')))
        {
        $page_data = Page::offset($start_val)
        ->limit($limit_val)
        ->orderBy('id', 'ASC')
        // ->orderBy($order_val,$dir_val)
        ->get();
        }
        else {
        $search_text = $request->input('search.value');

        $page_data = Page::select("id","page_title","page_status")
                            ->where(function ($query) use ($search_text) {
                                $query->where('id', 'LIKE',"%{$search_text}%")
                                ->orWhere('page_title', 'LIKE',"%{$search_text}%")
                                ->orWhere('page_status', 'LIKE',"%{$search_text}%");       
                            })
                            ->offset($start_val)
                            ->limit($limit_val)
                            ->orderBy('id', 'ASC')
                            // ->orderBy($order_val,$dir_val)
                            ->get();

        $totalFilteredRecord = $page_data->count();
        }
            
        $data_val = array();
        if(!empty($page_data))
        {
            $i = $start_val+1;

        foreach ($page_data as $value)
        {
        
        
            $nestedData['id'] = $value->id;
            $nestedData['srno'] = $i;
            $nestedData['title'] = $value->page_title;

            if($value->page_status == 1){
                $nestedData['status'] ='<div class="changediv'.$value->id.' status-change"><button type="button" class="btn btn-success change-status'.$value->id.'"  onClick="ContentpageStatusChange('.$value->id.')">Active</button></div>';
            }else{
                $nestedData['status'] ='<div class="changediv'.$value->id.' status-change"><button type="button" class="btn btn-danger change-status'.$value->id.'"  onClick="ContentpageStatusChange('.$value->id.')">Inactive</button></div>';
            } 

            $nestedData['action'] = '<button class="btn btn-dark p-2" >
            <a href="'.route('edit.page',[$value->id]) .' " class="text-white" style=" color: #FFFFFF;"><i class="fa fa-edit" ></i>Edit</button></a>
            <button class="btn  btn-dark p-2" >
            <a href="javascript:void(0);" onClick="delete_page('.$value->id.')" data-id="'.$value->id.'" class="text-white delete-page'.$value->id.'" style=" color: #FFFFFF;"><i class="fa fa-trash-o"></i> Delete </button></a>';
            
            $data_val[] = $nestedData;

            $i++;
                    
        }
        }
        $draw_val = $request->input('draw');
        $get_json_data = array(
        "draw"            => intval($draw_val),
        "recordsTotal"    => intval($totalDataRecord),
        "recordsFiltered" => intval($totalFilteredRecord),
        "data"            => $data_val
        );
            
        echo json_encode($get_json_data);  

    }

    // active inactive status change
    public function contentp_status_change(Request $request)
    {
        $page_id = $request->page_id; 
        $newstatus = $request->status;
        if($newstatus == 'Active'){
           $newstatus = 1 ;
        }else{
           $newstatus = 0 ;
        }
        Page::where('id', $page_id)
        ->update(['page_status' => $newstatus
                 ]
                );
       return response()->json('Page status changed successfully !');
    }


    public function homepagelist(){
    
      $data['secList'] = HomePage::orderby('id','DESC')->get();
     return view("Admin.home_page.home_section_list")->with($data);
    }

    public function CreateHomePage(){
     return view("Admin.home_page.create_section_page");
    }

    public function StoreSecData(Request $request){
        $request->validate([
            "sec_name" => "required",
            "sec_heading" => "required",
            "ban_img" => "required",
            "btntext1" => "required",
            "btntext2" =>"required",
            "sec_content" => "required",
            "sec_status" => "required",
        ]);
        
        $secdata = new HomePage();

        if ($request->hasFile("ban_img")) {
            $image = $request->file("ban_img");
            $imageName = time() . "." . $image->extension();
            $image->move(public_path("/upload/home_images"), $imageName);
        }

        $secdata->section_name = $request->sec_name;
        $secdata->section_heading = $request->sec_heading;
        $secdata->section_banner_img = $imageName;
        $secdata->section_btn_text1 = $request->btntext1;
        $secdata->section_btn_text2 = $request->btntext2;
        $secdata->section_desc = $request->sec_content;
        $secdata->sec_status = $request->sec_status;

        $res = $secdata->save();
        
        if($res ){
            return redirect("admin/section-page-list")->with(
                "success",
                "Section Data has been added successfully."
            );
        }else{
            return back()->with("failed", "OOPs! Some internal issue occured.");  
        }
    }

    // for home page
    public function UpdateSection(Request $request,$id){
        
        $request->validate([
            "sec_name" => "required",
            "sec_heading" => "required",
            "btntext1" => "required",
            "btntext2" =>"required",
            "sec_content" => "required",
            "sec_status" => "required",
        ]);
       
        $secfind = HomePage::find($id);

        
        if (empty($secfind)) {
            return back()->with("failed", "Data not found");
        } else {
         
        // for first section
        if ($request->hasFile("ban_img")) {
            $image = $request->file("ban_img");
            $imageName = Str::random(6) . time() . '.' .$image->getClientOriginalExtension();
            // $imageName = time() . "." . $image->extension();
            $image->move(public_path("/upload/home_images"), $imageName);
        }else{
            $imageName =  $secfind->section_1_banner_img;
        }
         // for second section
        if ($request->hasFile("fimage")) {
            $sec2image1 = $request->file("fimage");
            $sec2imageName1 = Str::random(6) . time() . '.' .$sec2image1->getClientOriginalExtension();
            // $sec2imageName1 = time() . "." . $sec2image1->extension();
            $sec2image1->move(public_path("/upload/home_images"), $sec2imageName1);
        }else{
            $sec2imageName1 =  $secfind->section_2_image_1;
        }

        if ($request->hasFile("simage")) {
            $sec2image2 = $request->file("simage");
            $sec2imageName2 = Str::random(6) . time() . '.' .$sec2image2->getClientOriginalExtension();
            // $sec2imageName2 = time() . "." . $sec2image2->extension();
            $sec2image2->move(public_path("/upload/home_images"), $sec2imageName2);
        }else{
            $sec2imageName2 =  $secfind->section_2_image_2;
        }

        if ($request->hasFile("timage")) {
            $sec2image3 = $request->file("timage");
            $sec2imageName3 = Str::random(6) . time() . '.' .$sec2image3->getClientOriginalExtension();
            // $sec2imageName3 = time() . "." . $sec2image3->extension();
            $sec2image3->move(public_path("/upload/home_images"), $sec2imageName3);
        }else{
            $sec2imageName3 =  $secfind->section_2_image_3;
        }

        if ($request->hasFile("fouimage")) {
            $sec2image4 = $request->file("fouimage");
            $sec2imageName4 = Str::random(6) . time() . '.' .$sec2image4->getClientOriginalExtension();
            // $sec2imageName4 = time() . "." . $sec2image4->extension();
            $sec2image4->move(public_path("/upload/home_images"), $sec2imageName4);
        }else{
            $sec2imageName4 =  $secfind->section_2_image_4;
        }
       
        // for third section
        if ($request->hasFile("sec_3_image")) {
            $sec3image = $request->file("sec_3_image");
            // $sec3imageName = time() . "." . $sec3image->extension();
            $sec3imageName = Str::random(6) . time() . '.' .$sec3image->getClientOriginalExtension();
            $sec3image->move(public_path("/upload/home_images"), $sec3imageName);
        }else{
            $sec3imageName =  $secfind->section_3_image;
        }


        // for fourth section
        if ($request->hasFile("sec_4_image_1")) {
            $sec4image1 = $request->file("sec_4_image_1");
            // $sec4imageName1 = time() . "." . $sec4image1->extension();
            $sec4imageName1 = Str::random(6) . time() . '.' .$sec4image1->getClientOriginalExtension();
            $sec4image1->move(public_path("/upload/home_images"), $sec4imageName1);
        }else{
            $sec4imageName1 =  $secfind->section_4_image_1;
        }

        if ($request->hasFile("sec_4_image_2")) {
            $sec4image2 = $request->file("sec_4_image_2");
            $sec4imageName2 = Str::random(6) . time() . '.' .$sec4image2->getClientOriginalExtension();
            // $sec4imageName2 = time() . "." . $sec4image2->extension();
            $sec4image2->move(public_path("/upload/home_images"), $sec4imageName2);
        }else{
            $sec4imageName2 =  $secfind->section_4_image_2;
        }

        if ($request->hasFile("sec_4_image_3")) {
            $sec4image3 = $request->file("sec_4_image_3");
            $sec4imageName3 = Str::random(6) . time() . '.' .$sec4image3->getClientOriginalExtension();
            // $sec4imageName3 = time() . "." . $sec4image3->extension();
            $sec4image3->move(public_path("/upload/home_images"), $sec4imageName3);
        }else{
            $sec4imageName3 =  $secfind->section_4_image_3;
        }

        if ($request->hasFile("sec_4_image_4")) {
            $sec4image4 = $request->file("sec_4_image_4");
            // $sec4imageName4 = time() . "." . $sec4image4->extension();
            $sec4imageName4 = Str::random(6) . time() . '.' .$sec4image4->getClientOriginalExtension();
            $sec4image4->move(public_path("/upload/home_images"), $sec4imageName4);
        }else{
            $sec4imageName4 =  $secfind->section_4_image_4;
        }

        //  for fifth section
        if ($request->hasFile("sec_5_image_1")) {
            $sec5image1 = $request->file("sec_5_image_1");
            // $sec4imageName4 = time() . "." . $sec4image4->extension();
            $sec5imageName1 = Str::random(6) . time() . '.' .$sec5image1->getClientOriginalExtension();
            $sec5image1->move(public_path("/upload/home_images"), $sec5imageName1);
        }else{
            $sec5imageName1 =  $secfind->section_5_image_1;
        }

        if ($request->hasFile("sec_5_image_2")) {
            $sec5image2 = $request->file("sec_5_image_2");
            // $sec4imageName4 = time() . "." . $sec4image4->extension();
            $sec5imageName2 = Str::random(6) . time() . '.' .$sec5image2->getClientOriginalExtension();
            $sec5image2->move(public_path("/upload/home_images"), $sec5imageName2);
        }else{
            $sec5imageName2 =  $secfind->section_5_image_2;
        }


        // for eighth section
        if ($request->hasFile("sec_8_image_1")) {
            $sec8image1 = $request->file("sec_8_image_1");
            // $sec4imageName4 = time() . "." . $sec4image4->extension();
            $sec8imageName1 = Str::random(6) . time() . '.' .$sec8image1->getClientOriginalExtension();
            $sec8image1->move(public_path("/upload/home_images"), $sec8imageName1);
        }else{
            $sec8imageName1 =  $secfind->section_8_image_1;
        }

        if ($request->hasFile("sec_8_image_2")) {
            $sec8image2 = $request->file("sec_8_image_2");
            // $sec4imageName4 = time() . "." . $sec4image4->extension();
            $sec8imageName2 = Str::random(6) . time() . '.' .$sec8image2->getClientOriginalExtension();
            $sec8image2->move(public_path("/upload/home_images"), $sec8imageName2);
        }else{
            $sec8imageName2 =  $secfind->section_8_image_2;
        }


        if ($request->hasFile("sec_8_image_3")) {
            $sec8image3 = $request->file("sec_8_image_3");
            // $sec4imageName4 = time() . "." . $sec4image4->extension();
            $sec8imageName3 = Str::random(6) . time() . '.' .$sec8image3->getClientOriginalExtension();
            $sec8image3->move(public_path("/upload/home_images"), $sec8imageName3);
        }else{
            $sec8imageName3 =  $secfind->section_8_image_3;
        }

        if ($request->hasFile("sec_8_image_4")) {
            $sec8image4 = $request->file("sec_8_image_4");
            // $sec4imageName4 = time() . "." . $sec4image4->extension();
            $sec8imageName4 = Str::random(6) . time() . '.' .$sec8image4->getClientOriginalExtension();
            $sec8image4->move(public_path("/upload/home_images"), $sec8imageName4);
        }else{
            $sec8imageName4 =  $secfind->section_8_image_4;
        }

        // for footer section
        if ($request->hasFile("foot_soc_img_1")) {
            $footsocialimage1 = $request->file("foot_soc_img_1");
            // $sec4imageName4 = time() . "." . $sec4image4->extension();
            $footsocailimageName1 = Str::random(6) . time() . '.' .$footsocialimage1->getClientOriginalExtension();
            $footsocialimage1->move(public_path("/upload/home_images"), $footsocailimageName1);
        }else{
            $footsocailimageName1 =  $secfind->footer_social_image_1;
        }

        if ($request->hasFile("foot_soc_img_2")) {
            $footsocialimage2 = $request->file("foot_soc_img_2");
            // $sec4imageName4 = time() . "." . $sec4image4->extension();
            $footsocailimageName2 = Str::random(6) . time() . '.' .$footsocialimage2->getClientOriginalExtension();
            $footsocialimage2->move(public_path("/upload/home_images"), $footsocailimageName2);
        }else{
            $footsocailimageName2 =  $secfind->footer_social_image_2;
        }
         
       
        if ($request->hasFile("foot_soc_img_3")) {
            $footsocialimage3 = $request->file("foot_soc_img_3");
            // $sec4imageName4 = time() . "." . $sec4image4->extension();
            $footsocailimageName3 = Str::random(6) . time() . '.' .$footsocialimage3->getClientOriginalExtension();        
            $footsocialimage3->move(public_path("/upload/home_images"), $footsocailimageName3);       
        }else{
            $footsocailimageName3 =  $secfind->footer_social_image_3;
        }
       

        if ($request->hasFile("foot_soc_img_4")) {
            $footsocialimage4 = $request->file("foot_soc_img_4");
            // $sec4imageName4 = time() . "." . $sec4image4->extension();
            $footsocailimageName4 = Str::random(6) . time() . '.' .$footsocialimage4->getClientOriginalExtension();        
            $footsocialimage4->move(public_path("/upload/home_images"), $footsocailimageName4);       
        }else{
            $footsocailimageName4 =  $secfind->footer_social_image_4;
        }
        

        // $request->hasFile("home_logo") ? 
        // $request->file("home_logo")->move("public/uploads/", $home_logo = time().strtolower(trim($request->file('home_logo')->getClientOriginalName()))) : '';
        
        // for footer card image
        if ($request->hasFile("foot_card_img_1")) {
            $footcardimage1 = $request->file("foot_card_img_1");
            // $sec4imageName4 = time() . "." . $sec4image4->extension();
            $footcardimageName1 = Str::random(6) . time() . '.' .$footcardimage1->getClientOriginalExtension();
            $footcardimage1->move(public_path("/upload/home_images"), $footcardimageName1);
        }else{
            $footcardimageName1 =  $secfind->footer_pcard_image_1;
        }

        if ($request->hasFile("foot_card_img_2")) {
            $footcardimage2 = $request->file("foot_card_img_2");
            // $sec4imageName4 = time() . "." . $sec4image4->extension();
            $footcardimageName2 = Str::random(6) . time() . '.' .$footcardimage2->getClientOriginalExtension();
            $footcardimage2->move(public_path("/upload/home_images"), $footcardimageName2);
        }else{
            $footcardimageName2 =  $secfind->footer_pcard_image_2;
        }

        if ($request->hasFile("foot_card_img_3")) {
            $footcardimage3 = $request->file("foot_card_img_3");
            // $sec4imageName4 = time() . "." . $sec4image4->extension();
            $footcardimageName3 = Str::random(6) . time() . '.' .$footcardimage3->getClientOriginalExtension();
            $footcardimage3->move(public_path("/upload/home_images"), $footcardimageName3);
        }else{
            $footcardimageName3 =  $secfind->footer_pcard_image_3;
        }


        if ($request->hasFile("foot_card_img_4")) {
            $footcardimage4 = $request->file("foot_card_img_4");
            // $sec4imageName4 = time() . "." . $sec4image4->extension();
            $footcardimageName4 = Str::random(6) . time() . '.' .$footcardimage4->getClientOriginalExtension();
            $footcardimage4->move(public_path("/upload/home_images"), $footcardimageName4);
        }else{
            $footcardimageName4 =  $secfind->footer_pcard_image_4;
        }

        if ($request->hasFile("foot_card_img_5")) {
            $footcardimage5 = $request->file("foot_card_img_5");
            // $sec4imageName4 = time() . "." . $sec4image4->extension();
            $footcardimageName5 = Str::random(6) . time() . '.' .$footcardimage5->getClientOriginalExtension();
            $footcardimage5->move(public_path("/upload/home_images"), $footcardimageName5);
        }else{
            $footcardimageName5 =  $secfind->footer_pcard_image_5;
        }

        if ($request->hasFile("foot_card_img_6")) {
            $footcardimage6 = $request->file("foot_card_img_6");
            // $sec4imageName4 = time() . "." . $sec4image4->extension();
            $footcardimageName6= Str::random(6) . time() . '.' .$footcardimage6->getClientOriginalExtension();
            $footcardimage6->move(public_path("/upload/home_images"), $footcardimageName6);
        }else{
            $footcardimageName6 =  $secfind->footer_pcard_image_6;
        }


        if ($request->hasFile("foot_card_img_7")) {
            $footcardimage7 = $request->file("foot_card_img_7");
            // $sec4imageName4 = time() . "." . $sec4image4->extension();
            $footcardimageName7= Str::random(6) . time() . '.' .$footcardimage7->getClientOriginalExtension();
            $footcardimage7->move(public_path("/upload/home_images"), $footcardimageName7);
        }else{
            $footcardimageName7 =  $secfind->footer_pcard_image_7;
        }


        if ($request->hasFile("foot_card_img_8")) {
            $footcardimage8 = $request->file("foot_card_img_8");
            // $sec4imageName4 = time() . "." . $sec4image4->extension();
            $footcardimageName8 = Str::random(6) . time() . '.' .$footcardimage8->getClientOriginalExtension();
            $footcardimage8->move(public_path("/upload/home_images"), $footcardimageName8);
        }else{
            $footcardimageName8 =  $secfind->footer_pcard_image_8;
        }


        //footer contact image 

        if ($request->hasFile("foot_contact_img_1")) {
            $footcontactimage1 = $request->file("foot_contact_img_1");
            // $sec4imageName4 = time() . "." . $sec4image4->extension();
            $footcontactimageName1= Str::random(6) . time() . '.' .$footcontactimage1->getClientOriginalExtension();
            $footcontactimage1->move(public_path("/upload/home_images"), $footcontactimageName1);
        }else{
            $footcontactimageName1 =  $secfind->footer_contimage_1;
        }

        if ($request->hasFile("foot_contact_img_2")) {
            $footcontactimage2 = $request->file("foot_contact_img_2");
            // $sec4imageName4 = time() . "." . $sec4image4->extension();
            $footcontactimageName2= Str::random(6) . time() . '.' .$footcontactimage2->getClientOriginalExtension();
            $footcontactimage2->move(public_path("/upload/home_images"), $footcontactimageName2);
        }else{
            $footcontactimageName2 =  $secfind->footer_contimage_2;
        }

        if ($request->hasFile("foot_contact_img_3")) {
            $footcontactimage3 = $request->file("foot_contact_img_3");
            // $sec4imageName4 = time() . "." . $sec4image4->extension();
            $footcontactimageName3= Str::random(6) . time() . '.' .$footcontactimage3->getClientOriginalExtension();
            $footcontactimage3->move(public_path("/upload/home_images"), $footcontactimageName3);
        }else{
            $footcontactimageName3 =  $secfind->footer_contimage_3;
        }

        $secfind->section_name = $request->sec_name;
        $secfind->section_1_heading = $request->sec_heading;
        $secfind->section_1_banner_img = $imageName;
        $secfind->section_1_btn_text1 = $request->btntext1;
        $secfind->section_1_btn_text2 = $request->btntext2;
        $secfind->section_1_desc = $request->sec_content;
        $secfind->section_2_image_1 = $sec2imageName1;
        $secfind->section_2_image_2 = $sec2imageName2;
        $secfind->section_2_image_3 = $sec2imageName3;
        $secfind->section_2_image_4 = $sec2imageName4;
        $secfind->section_3_image   = $sec3imageName;
        $secfind->section_3_heading = $request->sec_3_heading;
        $secfind->section_3_btn_text =$request->sec_3_btntext;
        $secfind->section_3_desc = $request->sec_3_content;
        $secfind->section_4_image_1 = $sec4imageName1;
        $secfind->section_4_image_2= $sec4imageName2;
        $secfind->section_4_image_3 = $sec4imageName3;
        $secfind->section_4_image_4 = $sec4imageName4;        
        $secfind->section_4_heading_1 = $request->sec_4_heading_1;
        $secfind->section_4_desc_1 = $request->sec_4_con_1;
        $secfind->section_4_heading_2 = $request->sec_4_heading_2;
        $secfind->section_4_desc_2 = $request->sec_4_con_2;
        $secfind->section_4_heading_3 = $request->sec_4_heading_3;
        $secfind->section_4_desc_3 = $request->sec_4_con_3;
        $secfind->section_4_heading_4 = $request->sec_4_heading_4;
        $secfind->section_4_desc_4 = $request->sec_4_con_4;
        $secfind->section_5_btntext = $request->sec_5_btntext;
        $secfind->section_5_desc_1 = $request->sec_5_con_1;
        $secfind->section_5_image_1 = $sec5imageName1;
        $secfind->section_5_image_2 = $sec5imageName2;
        $secfind->section_5_heading = $request->sec_5_heading;
        $secfind->section_8_image_1 = $sec8imageName1;
        $secfind->section_8_image_2 = $sec8imageName2;
        $secfind->section_8_image_3 = $sec8imageName3;
        $secfind->section_8_image_4 = $sec8imageName4;
        $secfind->section_8_heading_1 = $request->sec_8_heading_1;
        $secfind->section_8_heading_2 = $request->sec_8_heading_2;
        $secfind->section_8_heading_3 = $request->sec_8_heading_3;
        $secfind->section_8_heading_4 = $request->sec_8_heading_4;
        $secfind->section_8_desc_1 = $request->sec_8_con_1;
        $secfind->section_8_desc_2 = $request->sec_8_con_2;
        $secfind->section_8_desc_3 = $request->sec_8_con_3;
        $secfind->section_8_desc_4 = $request->sec_8_con_4;

        $secfind->footer_social_image_1 = $footsocailimageName1;
        $secfind->footer_social_image_2 = $footsocailimageName2;
        $secfind->footer_social_image_3 = $footsocailimageName3;
        $secfind->footer_social_image_4 = $footsocailimageName4;

        $secfind->footer_pcard_image_1 = $footcardimageName1;
        $secfind->footer_pcard_image_2 = $footcardimageName2;
        $secfind->footer_pcard_image_3 = $footcardimageName3;
        $secfind->footer_pcard_image_4 = $footcardimageName4;
        $secfind->footer_pcard_image_5 = $footcardimageName5;
        $secfind->footer_pcard_image_6 = $footcardimageName6;
        $secfind->footer_pcard_image_7 = $footcardimageName7;
        $secfind->footer_pcard_image_8 = $footcardimageName8;

        $secfind->footer_contimage_1 = $footcontactimageName1;
        $secfind->footer_contimage_2 = $footcontactimageName2;
        $secfind->footer_contimage_3 = $footcontactimageName3;
        $secfind->footer_conttext_1 = $request->foot_text1;
        $secfind->footer_conttext_2 = $request->foot_text2;
        $secfind->footer_conttext_3= $request->foot_text3;

        $secfind->section_6_heading= $request->six_sec_head;
        $secfind->section_6_desc= $request->six_sec_desc;
        $secfind->section_7_heading= $request->seven_sec_head;
        $secfind->section_7_desc= $request->seven_sec_desc;
        $secfind->section_7_btntext= $request->seven_btntext;
    
        $secfind->sec_status = $request->sec_status;

        $res = $secfind->save();
        
        if($res ){
            return redirect("admin/home-content-list")->with(
                "success",
                "Home Content has been updated successfully."
            );
        }else{
            return back()->with("failed", "OOPs! Some internal issue occured.");  
        }
     }
    }

    // active inactive status change
    public function sectionpage_status_change(Request $request)
    {
        $sec_id = $request->sec_id; 
        $newstatus = $request->status;
        if($newstatus == 'Active'){
           $newstatus = 1 ;
        }else{
           $newstatus = 0 ;
        }
        HomePage::where('id', $sec_id)
        ->update(['sec_status' => $newstatus
                 ]
                );
       return response()->json('Home Content status changed successfully !');
    }
    
    // for home page section
    public function DeleteSection(Request $request)
    {
        $id = $request->id;
        $secpage = HomePage::find($id);
        $result = $secpage->delete();

        if ($result) {
            return json_encode(array('status' => 'success','msg' => 'Home Content has been deleted successfully!'));
         }else {
            return json_encode(array('status' => 'error','msg' => 'Some internal issue occured.'));
         }
    }
    
    // first section for home
    public function editSectionPage($id){
    $secdata = HomePage::find($id);  
    return view("Admin.home_page.edit_section_page",compact('secdata'));
    }

    //for Home first slider data list
    public function HomesliderFirstList(){
    $data['fsidedata'] = HomeFirstSlide::orderby('id','DESC')->get();  
    return view("Admin.home_page.home_fslider_list")->with($data);
    }

    //for create Home first slider 
    public function  CreateHomesliderFirst(){   
    return view("Admin.home_page.create_first_slide_content");
    }

    //for create Home first slider 
    public function  CreateHomesliderFirstPost(Request $request){   
        $request->validate([
            // "page_name" => "required",
            // "slider_heading" => "required",
            // "slide_content_1" => "required",
            "slide_content_2" => "required",
            // "slide_content_3" =>"required",
            // "slide_content_4" => "required",
            // "slide_content_5" => "required",
            "slid_status" => "required",
        ]);

        $fslider = new HomeFirstSlide();

        // $fslider->slider_name = $request->page_name;
        // $fslider->slider_first_heading	 = $request->slider_heading;
        // $fslider->slider_first_desc_1 = $request->slide_content_1;
        $fslider->slider_first_desc_2 = $request->slide_content_2;
        // $fslider->slider_first_desc_3 = $request->slide_content_3;
        // $fslider->slider_first_desc_4 = $request->slide_content_4;
        // $fslider->slider_first_desc_5 = $request->slide_content_5;
        $fslider->slide_status = $request->slid_status;
        $res = $fslider->save();

        if($res ){
            return redirect("admin/first-slider-list")->with(
                "success",
                "First slider content has been added successfully."
            );
        }else{
            return back()->with("failed", "OOPs! Some internal issue occured.");  
        }

    }

    // active inactive status change for slider
    public function FirstSlideStatuschange(Request $request)
    {        
        $fslide_id = $request->fslide_id; 
        $newstatus = $request->status;
        if($newstatus == 'Active'){
           $newstatus = 1 ;
        }else{
           $newstatus = 0 ;
        }
        HomeFirstSlide::where('id', $fslide_id)
        ->update(['slide_status' => $newstatus
                 ]
                );
       return response()->json('Slider Status changed successfully !');
    }

    // delete for  first slider
    public function DeleteFirstSlide(Request $request)
    {
        $id = $request->id;
        $firstslide = HomeFirstSlide::find($id);
        $result = $firstslide->delete();

        if ($result) {
            return json_encode(array('status' => 'success','msg' => 'First slider content has been deleted successfully!'));
         }else {
            return json_encode(array('status' => 'error','msg' => 'Some internal issue occured.'));
         }
    }

    //for edit Home first slider 
    public function  EditHomesliderFirst($id){   
        $fslidedata = HomeFirstSlide::find($id);
        return view("Admin.home_page.edit_first_slide_content",compact('fslidedata'));
    }

    //for update content Home first slider 
    public function  UpdateHomesliderFirst(Request $request,$id){   
        $request->validate([
            // "page_name" => "required",
            // "slider_heading" => "required",
            // "slide_content_1" => "required",
            "slide_content_2" => "required",
            // "slide_content_3" =>"required",
            // "slide_content_4" => "required",
            // "slide_content_5" => "required",
            "slid_status" => "required",
        ]);

        $slidefind = HomeFirstSlide::find($id);
        if (empty($slidefind)) {
            return back()->with("failed", "Data not found");
        }else{

            // $slidefind->slider_name = $request->page_name;
            // $slidefind->slider_first_heading	 = $request->slider_heading;
            // $slidefind->slider_first_desc_1 = $request->slide_content_1;
            $slidefind->slider_first_desc_2 = $request->slide_content_2;
            // $slidefind->slider_first_desc_3 = $request->slide_content_3;
            // $slidefind->slider_first_desc_4 = $request->slide_content_4;
            // $slidefind->slider_first_desc_5 = $request->slide_content_5;
            $slidefind->slide_status = $request->slid_status;
            $res = $slidefind->save();

            if($res){
            return redirect("admin/first-slider-list")->with('success','First slider content has been  updated successfully.');
            }else{
            return back()->with("failed", "OOPs! Some internal issue occured.");
            }
           
        }
    }

    //for Home second slider data list
    public function HomesliderSecondList(){
        $data['secsidedata'] = HomeSecSlide::orderby('id','DESC')->get();  
        return view("Admin.home_page.home_secslider_list")->with($data);
    }

    //for create Home second slider 
    public function  CreateHomeSecFirst(){   
     return view("Admin.home_page.create_secslide_content");
    }

    //for create Home second slider 
    public function  CreateHomesliderSecondPost(Request $request){   
        $request->validate([
            // "page_name" => "required",
            // "slider_heading" => "required",
            // "slide_content" => "required",
            "sli_img_1" => "required",
            // "sli_img_2" =>"required",
            // "sli_img_3" => "required",
            // "sli_img_4" => "required",
            // "btn_text" => "required",
            "slid_status" => "required",
        ]);
         
        $slideimageName1 = '' ;
        // $slideimageName2 = '' ;
        // $slideimageName3 = '' ;
        // $slideimageName4 = '' ;
        // for second  slide
        if ($request->hasFile("sli_img_1")) {
            $slideimage1 = $request->file("sli_img_1");
            $slideimageName1 = Str::random(6) . time() . '.' .$slideimage1->getClientOriginalExtension();
            // $sec2imageName1 = time() . "." . $sec2image1->extension();
            $slideimage1->move(public_path("/upload/home_slideimage"), $slideimageName1);
        }

        // if ($request->hasFile("sli_img_2")) {
        //     $slideimage2 = $request->file("sli_img_2");
        //     $slideimageName2 = Str::random(6) . time() . '.' .$slideimage2->getClientOriginalExtension();
        //     // $sec2imageName1 = time() . "." . $sec2image1->extension();
        //     $slideimage2->move(public_path("/upload/home_slideimage"), $slideimageName2);
        // }


        // if ($request->hasFile("sli_img_3")) {
        //     $slideimage3 = $request->file("sli_img_3");
        //     $slideimageName3 = Str::random(6) . time() . '.' .$slideimage2->getClientOriginalExtension();
        //     // $sec2imageName1 = time() . "." . $sec2image1->extension();
        //     $slideimage3->move(public_path("/upload/home_slideimage"), $slideimageName3);
        // }


        // if ($request->hasFile("sli_img_4")) {
        //     $slideimage4 = $request->file("sli_img_4");
        //     $slideimageName4 = Str::random(6) . time() . '.' .$slideimage2->getClientOriginalExtension();
        //     // $sec2imageName1 = time() . "." . $sec2image1->extension();
        //     $slideimage4->move(public_path("/upload/home_slideimage"), $slideimageName4);
        // }

        $secslider = new HomeSecSlide();

        // $secslider->slider_name = $request->page_name;
        // $secslider->slider_sec_heading	 = $request->slider_heading;
        // $secslider->slider_sec_desc = $request->slide_content;
        $secslider->slider_sec_img_1 = $slideimageName1;
        // $secslider->slider_sec_img_2 =  $slideimageName2;
        // $secslider->slider_sec_img_3 = $slideimageName3;
        // $secslider->slider_sec_img_4 = $slideimageName4;
        // $secslider->slider_sec_btntext = $request->btn_text;
        $secslider->slider_status = $request->slid_status;
        $res = $secslider->save();

        if($res ){
            return redirect("admin/second-slider-list")->with(
                "success",
                "Second slider content has been added successfully."
            );
        }else{
            return back()->with("failed", "OOPs! Some internal issue occured.");  
        }

    }

    // active inactive status change for sec slider
    public function SecondSlideStatuschange(Request $request)
    {        
        $secslide_id = $request->secslide_id; 
        $newstatus = $request->status;
        if($newstatus == 'Active'){
           $newstatus = 1 ;
        }else{
           $newstatus = 0 ;
        }
        HomeSecSlide::where('id', $secslide_id)
        ->update(['slider_status' => $newstatus
                 ]
                );
       return response()->json('Slider Status changed successfully !');
    }

    // delete for  second slider
    public function DeleteSecondSlide(Request $request)
    {
        $id = $request->id;
        $secslide = HomeSecSlide::find($id);
        $result = $secslide->delete();

        if ($result) {
            return json_encode(array('status' => 'success','msg' => 'Second slider content has been deleted successfully!'));
         }else {
            return json_encode(array('status' => 'error','msg' => 'Some internal issue occured.'));
         }
    }

    //for edit Home sec slider 
    public function  EditHomeslidersec($id){   
        $secslidedata = HomeSecSlide::find($id);
        return view("Admin.home_page.edit_sec_slide_content",compact('secslidedata'));
    }


     //for update content Home first slider 
     public function  UpdateHomesliderSecond(Request $request,$id){   
        $request->validate([
            // "page_name" => "required",
            // "slider_heading" => "required",
            // "slide_content" => "required",
            // "btn_text" => "required",
            "slid_status" => "required",
        ]);

        $secslidefind = HomeSecSlide::find($id);
        if (empty($secslidefind)) {
            return back()->with("failed", "Data not found");
        }else{

            // for second  slide
        if ($request->hasFile("sli_img_1")) {
            $secslideimage1 = $request->file("sli_img_1");
            $secslideimageName1 = Str::random(6) . time() . '.' .$secslideimage1->getClientOriginalExtension();
            // $sec2imageName1 = time() . "." . $sec2image1->extension();
            $secslideimage1->move(public_path("/upload/home_slideimage"), $secslideimageName1);
        }else{
            $secslideimageName1 = $secslidefind->slider_sec_img_1;
        }

        // if ($request->hasFile("sli_img_2")) {
        //     $secslideimage2 = $request->file("sli_img_2");
        //     $secslideimageName2 = Str::random(6) . time() . '.' .$secslideimage2->getClientOriginalExtension();
        //     // $sec2imageName1 = time() . "." . $sec2image1->extension();
        //     $secslideimage2->move(public_path("/upload/home_slideimage"), $secslideimageName2);
        // }else{
        //     $secslideimageName2 = $secslidefind->slider_sec_img_2;
        // }


        // if ($request->hasFile("sli_img_3")) {
        //     $secslideimage3 = $request->file("sli_img_3");
        //     $secslideimageName3 = Str::random(6) . time() . '.' .$secslideimage2->getClientOriginalExtension();
        //     // $sec2imageName1 = time() . "." . $sec2image1->extension();
        //     $secslideimage3->move(public_path("/upload/home_slideimage"), $secslideimageName3);
        // }else{
        //     $secslideimageName3 = $secslidefind->slider_sec_img_3;
        // }


        // if ($request->hasFile("sli_img_4")) {
        //     $secslideimage4 = $request->file("sli_img_4");
        //     $secslideimageName4 = Str::random(6) . time() . '.' .$secslideimage2->getClientOriginalExtension();
        //     // $sec2imageName1 = time() . "." . $sec2image1->extension();
        //     $secslideimage4->move(public_path("/upload/home_slideimage"), $secslideimageName4);
        // }else{
        //     $secslideimageName4 = $secslidefind->slider_sec_img_4;
        // }

            // $secslidefind->slider_name = $request->page_name;
            // $secslidefind->slider_sec_heading	 = $request->slider_heading;
            // $secslidefind->slider_sec_desc = $request->slide_content;
            $secslidefind->slider_sec_img_1 = $secslideimageName1;
            // $secslidefind->slider_sec_img_2 =  $secslideimageName2;
            // $secslidefind->slider_sec_img_3 = $secslideimageName3;
            // $secslidefind->slider_sec_img_4 = $secslideimageName4;
            // $secslidefind->slider_sec_btntext = $request->btn_text;
            $secslidefind->slider_status = $request->slid_status;
            $res = $secslidefind->save();

            if($res){
            return redirect("admin/second-slider-list")->with('success','Second slider content has been  updated successfully.');
            }else{
            return back()->with("failed", "OOPs! Some internal issue occured.");
            }
           
        }
    }

    
    
}