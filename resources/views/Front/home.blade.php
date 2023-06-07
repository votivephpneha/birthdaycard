@extends('Front.layout.layout')
@section('title', 'Home')

@section('current_page_css')
@endsection

@section('current_page_js')
@endsection

@section('content')
  <!-- ======= Hero Section ======= -->

  <section class="gift">
    <div class="container">
      <div class="row">
        <div class="col-md-12 giftb">

        <h5>{{ $home_data->section_1_heading }}</h5>
        <div class="favii-git col-md-7 m-auto">
  <p>{{ $home_data->section_1_desc }}</p>

</div>
        </div>

    </div>
  </section>


<section class="bg-pink">
<div class="container-fluid p-0">
  <div class="carousel-item-active main-banner">
<img src="{{ url('public/upload/home_images') }}/{{ $home_data->section_1_banner_img }}">
 <div class="mt-auto card-btn">
            <a href="{{ url('birthday-cards') }}" class="btn-get-started-white mr-5 ">{{ $home_data->section_1_btn_text1 }}</a>
             <a href="{{ url('birthday-cards') }}" class="btn-get-started">{{ $home_data->section_1_btn_text2 }}</a>
           </div>

  </div>
</div>

</section>


  <!-- <section class="bg-pink">
    <div class="container-fluid">
  <div class="carousel-item-active main-banner" style="background-image: url('{{ url('public/upload/home_images') }}/{{ $home_data->section_1_banner_img }}')">
       
 <div class="mt-auto card-btn">
            <a href="{{ url('birthday-cards') }}" class="btn-get-started-white mr-5 ">{{ $home_data->section_1_btn_text1 }}</a>
             <a href="{{ url('birthday-cards') }}" class="btn-get-started">{{ $home_data->section_1_btn_text2 }}</a>
           </div>
      </div>
        </div>
  </section> --><!-- End Hero -->


<section class="giftb mtax">
    <div class="container">
      <div class="row">
        <div class="col-md-3 col-lg-3 col-6 col-sm-6 d-md-flex align-items-md-stretch">
          <div class="rating-box">
         <img src="{{ url('public/upload/home_images') }}/{{ $home_data->section_2_image_1 }}">
       </div>
       </div>
        <div class="col-md-3 col-lg-3 col-6 col-sm-6">
           <div class="rating-box">
         <img src="{{ url('public/upload/home_images') }}/{{ $home_data->section_2_image_2 }}">
       </div>
       </div>
        <div class="col-md-3 col-lg-3 col-6 col-sm-6">
           <div class="rating-box heig-mends">
         <img src="{{ url('public/upload/home_images') }}/{{ $home_data->section_2_image_3 }}">
       </div>
       </div>
        <div class="col-md-3 col-lg-3 col-6 col-sm-6">
           <div class="rating-box heig-mends">
         <img src="{{ url('public/upload/home_images') }}/{{ $home_data->section_2_image_4 }}">
       </div>
       </div>

    </div>
  </section>


 <section class="giftb">
    <div class="container">
      <div class="row">
        <div class="col-md-12">

        <h5>{{ $home_data->section_3_heading }}</h5>
        <div class="favii-git col-md-7 m-auto">
  <p>{{ $home_data->section_3_desc }}</p>

</div>
        </div>

    </div>
  </section>



 <section id="why-us" class="why-us section-bg">
      <div class="container-fluid" data-aos="fade-up">

        <div class="row">

          <div class="col-lg-8 m-auto align-items-stretch video-box" style="background-image: url({{ url('public/upload/home_images') }}/{{ $home_data->section_3_image }}); display: flex;
    justify-content: center;" data-aos="zoom-in" data-aos-delay="100">
          
            <a href="#" class="venobox play-btn mb-4" data-vbtype="video" data-autoplay="true">
             <i class='bx bx-play-circle'></i>
             </a>
          </div>


          <div class="col-md-12 text-center mt-4">  <a href="{{ url('birthday-cards') }}" class="view-allbotm">{{ $home_data->section_3_btn_text }} </a></div>
        </div>
      </div>
    </section>


<section id="gridbar" class="grdi-zi mt-5">
      <div class="row p-0 m-0">
<div class="col-md-6">
 <div class="text-grid">
  <div class="favorit-grid">
  <h4>{{ $home_data->section_4_heading_1 }}</h4>
  <p>{{ $home_data->section_4_desc_1 }}</p>
</div>

 </div>
</div>

<div class="col-md-6 p-0">
  <div class="imge-brid">
<img src="{{ url('public/upload/home_images') }}/{{ $home_data->section_4_image_1 }}">
</div>
</div>
</div>
<div class="row p-0 m-0 grid-respoms">
<div class="col-md-6 p-0">
  <div class="imge-brid">
<img src="{{ url('public/upload/home_images') }}/{{ $home_data->section_4_image_2 }}">

</div>
</div>

<div class="col-md-6">
 <div class="text-grid">
  <div class="favorit-grid">
  <h4>{{ $home_data->section_4_heading_2 }}</h4>
  <p>{{ $home_data->section_4_desc_2 }}</p>
</div>

 </div>
</div>
</div>
<div class="row p-0 m-0">
<div class="col-md-6">
 <div class="text-grid">
  <div class="favorit-grid">
  <h4>{{ $home_data->section_4_heading_3 }}</h4>
  <p>{{ $home_data->section_4_desc_3 }}</p>
</div>

 </div>
</div>

<div class="col-md-6 p-0">
  <div class="imge-brid">
<img src="{{ url('public/upload/home_images') }}/{{ $home_data->section_4_image_3 }}">
</div>
</div>
</div>
<div class="row p-0 m-0 grid-respoms">
<div class="col-md-6 p-0">
  <div class="imge-brid">
<img src="{{ url('public/upload/home_images') }}/{{ $home_data->section_4_image_4 }}">
</div>
</div>

<div class="col-md-6">
 <div class="text-grid">
  <div class="favorit-grid">
  <h4>{{ $home_data->section_4_heading_4 }}</h4>
  <p>{{ $home_data->section_4_desc_4 }}</p>
</div>

 </div>
</div>

</div>
  </section>


   <section class="giftb">
    <div class="container">
      <div class="row">
        <div class="col-md-12">

        <h5>{{ $home_data->section_5_heading }}</h5>
        <div class="favii-git col-md-7 m-auto">
  <p>{{ $home_data->section_5_desc_1 }}</p>

</div>
        </div>
<div class="col-md-6">
<div class="boey-box">
<img src="{{ url('public/upload/home_images') }}/{{ $home_data->section_5_image_2 }}">



</div>
</div>
<div class="col-md-6">
<div class="boey-box">
<img src="{{ url('public/upload/home_images') }}/{{ $home_data->section_5_image_1 }}">

</div>
</div>

<div class="col-md-12 text-center mt-4">  <a href="{{ url('birthday-cards') }}" class="view-allbotm">{{ $home_data->section_5_btntext }}</a></div>


    </div>
  </section>

  


   <section  id="testimonials" class="testimonials section-bg giftb">
    <div class="container">
      <div class="row">
        <div class="col-md-12">

        <h5>{{ $home_data->section_6_heading }}</h5>
        <div class="favii-git col-md-7 m-auto">
  <p>{{ $home_data->section_6_desc }}</p>

      </div>

      </div>
        </div>
         <div class="testimonials-slider lover-text swiper mt-4" data-aos="fade-up" data-aos-delay="100">
          <div class="swiper-wrapper">
            @foreach($customer_slider as $c_slide)
            <div class="swiper-slide">
              <div class="testimonial-wrap">
                <div class="testimonial-item">
                <div class="raitn-bar">
                  <span>&#9733;</span>
                   <span>&#9733;</span>
                    <span>&#9733;</span>
                     <span>&#9733;</span>
                      <span>&#9733;</span>
                

                </div>
                 <p>
                     {!! $c_slide->slider_first_desc_2 !!}
                   
                  </p>
                 </div>
              </div>
            </div><!-- End testimonial item -->
            @endforeach
            

            

          </div>
         <!--  <div class="swiper-pagination"></div> -->
           <div class="swiper-button-next"></div>
    <div class="swiper-button-prev"></div>
        </div>

</div>
</div>
</section>


<section  id="testimonials" class="testimonials section-bg giftb">
    <div class="container">
      <div class="row">
        <div class="col-md-12">

        <h5>{{ $home_data->section_7_heading }}</h5>
        <div class="favii-git col-md-7 m-auto">
  <p>{{ $home_data->section_7_desc }}</p>

      </div>
        </div>
         <div class="testimonials-slider lover-img swiper">
          <div class="swiper-wrapper">
            @foreach($favourite_slider as $f_slide)
            <div class="swiper-slide">
              <div class="testimonial-wrap">
                <div class="testimonial-item">
                  <img src="{{ url('public/upload/home_slideimage') }}/{{ $f_slide->slider_sec_img_1 }}" alt="">
                 </div>
              </div>
            </div><!-- End testimonial item -->
            @endforeach
            



          </div>
         <!--  <div class="swiper-pagination"></div> -->
    <div class="swiper-button-next"></div>
    <div class="swiper-button-prev"></div>
        </div>

  <div class="col-md-12 text-center mt-3"> 
   <a href="{{ url('birthday-cards') }}" class="view-allbotm"> Design Your Card </a></div>

</div>
</div>
</section>

<section class="section-bg">
    <div class="container">
      <div class="row">
        <div class="col-md-3">
          <div class="how-it-work">
            <div class="plane">
           <img src="{{ url('public/upload/home_images') }}/{{ $home_data->section_8_image_1 }}">
            </div>
            <div class="servi-text">
            <h5>{{ $home_data->section_8_heading_1 }}</h5>
            <p>{{ $home_data->section_8_desc_1 }}</p>
              </div>
          </div>
        </div>

          <div class="col-md-3">
         <div class="how-it-work">
            <div class="plane">
           <img src="{{ url('public/upload/home_images') }}/{{ $home_data->section_8_image_2 }}">
            </div>
            <div class="servi-text">
            <h5>{{ $home_data->section_8_heading_2 }}</h5>
            <p>{{ $home_data->section_8_desc_2 }}</p>
              </div>
          </div>
        </div>
          <div class="col-md-3">
          <div class="how-it-work">
            <div class="plane">
           <img src="{{ url('public/upload/home_images') }}/{{ $home_data->section_8_image_3 }}">
            </div>
            <div class="servi-text">
            <h5>{{ $home_data->section_8_heading_3 }}</h5>
            <p>{{ $home_data->section_8_desc_3 }}</p>
              </div>
          </div>
        </div>
          <div class="col-md-3">
          <div class="how-it-work">
            <div class="plane">
           <img src="{{ url('public/upload/home_images') }}/{{ $home_data->section_8_image_4 }}">
            </div>
            <div class="servi-text">
            <h5>{{ $home_data->section_8_heading_4 }}</h5>
            <p>{{ $home_data->section_8_desc_4 }}</p>
              </div>
          </div>
        </div>

      </div>
    </div>
  </section>
@endsection