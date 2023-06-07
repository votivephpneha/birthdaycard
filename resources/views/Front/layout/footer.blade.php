 <?php
  $home_data = DB::table("home_page")->where("id","5")->get()->first();
 ?>
 <footer id="footer">
   <div class="footer-top">
     <div class="container">
       <div class="row">

         <div class="col-lg-3 col-md-6 ">
           <a href="#" class="logo-foter"><img src="{{ url('public/assets/img/logo.png') }}" class="mb-2"> </a>

           <div class="footer-newsletter">
             <h5 class="fowl">Follow Us</h5>
             <a href="#"><img src="{{ url('public/upload/home_images') }}/{{ $home_data->footer_social_image_1 }}" class="mb-2"> </a>
             <a href="#"><img src="{{ url('public/upload/home_images') }}/{{ $home_data->footer_social_image_2 }}" class="mb-2"> </a>
             <a href="#"><img src="{{ url('public/upload/home_images') }}/{{ $home_data->footer_social_image_3 }}" class="mb-2"> </a>
             <a href="#"><img src="{{ url('public/upload/home_images') }}/{{ $home_data->footer_social_image_4 }}" class="mb-2 tikto-sic"> </a>
           </div>
           <div class="mt-3 payment-icon">
             <h5 class="fowl mb-1">We Accept </h5>
             <a href="#"><img src="{{ url('public/upload/home_images') }}/{{ $home_data->footer_pcard_image_1 }}"></a>
             <a href="#"><img src="{{ url('public/upload/home_images') }}/{{ $home_data->footer_pcard_image_2 }}"></a>
             <a href="#"><img src="{{ url('public/upload/home_images') }}/{{ $home_data->footer_pcard_image_3 }}"></a>
             <a href="#"><img src="{{ url('public/upload/home_images') }}/{{ $home_data->footer_pcard_image_4 }}"></a>
             <a href="#"><img src="{{ url('public/upload/home_images') }}/{{ $home_data->footer_pcard_image_5 }}"></a>
             <a href="#"><img src="{{ url('public/upload/home_images') }}/{{ $home_data->footer_pcard_image_6 }}"></a>
             <a href="#"> <img src="{{ url('public/upload/home_images') }}/{{ $home_data->footer_pcard_image_7 }}" class=""></a>
             <a href="#"> <img src="{{ url('public/upload/home_images') }}/{{ $home_data->footer_pcard_image_8 }}" class=""></a>

           </div>
         </div>

         <div class="col-lg-3 col-md-6 footer-links-addres">
           <h4>Contact Us</h4>

           <ul>
             <li> <a href="#"><img src="{{ url('public/upload/home_images') }}/{{ $home_data->footer_contimage_1 }}">{{ $home_data->footer_conttext_1 }}</a></li>
             <li> <a href="tel:0123456789"><img src="{{ url('public/upload/home_images') }}/{{ $home_data->footer_contimage_2 }}">{{ $home_data->footer_conttext_2 }}</a></li>
             <li> <a href="mailto:info@gmail.com"><img src="{{ url('public/upload/home_images') }}/{{ $home_data->footer_contimage_3 }}">Email <label style="
    text-decoration: underline;cursor: pointer;">{{ $home_data->footer_conttext_3 }}</label></a></li>

           </ul>
         </div>


         <div class="col-lg-3 col-md-6 footer-links">
           <h4>Quick Links</h4>

           <ul>
             <li> <a href="{{url('/')}}"> Home</a></li>
             <li> <a href="{{url('privacy-policy')}}">Privacy Policy</a></li>
             <li> <a href="{{route('birthday-cards')}}">Birthday Cards</a></li>
             <li> <a href="{{url('terms-service')}}">Terms of service</a></li>
             <li> <a href="{{url('gift_card')}}">Gifts</a></li>
            </ul>
         </div>

         <div class="col-lg-3 col-md-6 footer-links">
           <h4>Account</h4>
           <ul>
             <li>
                @if(!Auth::check())
                <a href="{{ url('/loginUser') }}"> Sign In</a>
                @else
                <a href="{{ url('user/userProfile') }}"> Profile</a>
                @endif
             </li>
             <li> <a href="{{route('cart_page')}}">View Cart</a></li>
             <li> <a href="@if(Auth::guard('customer')->user()){{route('user_favourites')}} @else{{url('user_favourites')}}@endif">My Wishlist</a></li>
             <li> <a href="{{ url('order-track') }}">Track My Order</a></li>
             <li> <a href="{{ url('refund_policy') }}">Refund Policy</a></li>
             <li> <a href="{{ url('shipping_policy') }}">Shipping Policy</a></li>
             <li> <a href="{{ url('contact-us') }}">Help Ticket</a></li>

           </ul>
         </div>



       </div>
     </div>
   </div>

   <div class="brith-foter">
     <div class="copyright" style="font-size: 12px;">
       © 2023<strong> <span>Brithday store.</span></strong>
     </div>

   </div>
 </footer> <!-- End Footer