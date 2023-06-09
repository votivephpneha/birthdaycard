<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Brithday store-@yield('title')</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="icon" href="{{asset('public/images/newicon.ico')}}" type="image/ico" />
  
  <link href="https://fonts.googleapis.com/css2?family=Kalam:wght@300;400;700&family=Source+Sans+Pro:wght@200;300;400;600;700&display=swap" rel="stylesheet">

  <link href="{{ url('public/assets/vendor/animate.css/animate.min.css') }}" rel="stylesheet">
  <link href="{{ url('public/assets/vendor/aos/aos.css') }}" rel="stylesheet">
  <link href="{{ url('public/assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
  <link href="{{ url('public/assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
  <link href="{{ url('public/assets/vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
  <link href="{{ url('public/assets/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
  <link href="{{ url('public/assets/vendor/remixicon/remixicon.css') }}" rel="stylesheet">
  <link href="{{ url('public/assets/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">

  <link href="{{ url('public/assets/css/style.css') }}" rel="stylesheet">
  <!-- <link href="{{ url('public/assets/css/example.css') }}" rel="stylesheet"> -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">
  <style>
    .error{
      color:red;
    }
  /*  .user_registration{
      width:500px;
      margin: auto;
      margin-top: 120px;
    }*/
    .user_profile_div{
      margin-top: 200px;
    }
    .card_page{
      margin-top: 160px;
	  margin-bottom: 50px;
    }
    .card_image img{
      width:100%;
    }
    .alert.alert-danger{
      flex-direction: row-reverse;
      display: flex;
      align-items: center;
      justify-content: space-between;
    }
  </style>
  @yield('current_page_css')
  
</head>

<body>
   <!-- Modal -->
  <div id="email_popup" class="modal fade" role="dialog" style="opacity: 1;background:transparent;">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-md-8 email_modal_body">
              <div class="heading">Wait</div>
              <div class="subheading">Subscribe to our newsletter and receive our free kit</div>
            </div>
            <div class="col-md-4 email_popup_image">
              <img src="https://birthdaystoreuk.co.uk/public/upload/cards/1682676800.jpg" style="width:100%">
            </div>
            <div class="newsletter_form">
              <form method="post" action="{{ url('send_newsletter') }}">
                @csrf
                <input type="text" name="email_field" class="email_field" placeholder="Enter your email address" required>
                <input type="submit" class="subs-btn" name="email_btn" value="Get Your Free Kit">
              </form>
            </div>
          </div>
        </div>
        
      </div>

    </div>
  </div>
  <!-- Navbar Header -->
  @include('Front.layout.header')


  @yield('content')

  <!-- /.Footer -->
  @include('Front.layout.footer')


  <!-- Vendor JS Files -->

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <script src="{{ url('public/assets/vendor/aos/aos.js') }}"></script>
  <script src="{{ url('public/assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ url('public/assets/vendor/glightbox/js/glightbox.min.js') }}"></script>
  <script src="{{ url('public/assets/vendor/isotope-layout/isotope.pkgd.min.js') }}"></script>
  <script src="{{ url('public/assets/vendor/swiper/swiper-bundle.min.js') }}"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>

  <!-- Template Main JS File -->
  <script src="{{ url('public/assets/js/main.js') }}"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js"></script>
  <script type="text/javascript" src="{{ url('public/assets/js/jquery.ihavecookies.js') }}"></script>


<script type="text/javascript">
  
  
    jQuery(function ($) {
        // init the state from the input
        $(".image-checkbox").each(function () {
            if ($(this).find('input[type="checkbox"]').first().attr("checked")) {
                $(this).addClass('image-checkbox-checked');
            }
            else {
                $(this).removeClass('image-checkbox-checked');
            }
        });

        // sync the state to the input
        $(".image-checkbox").on("click", function (e) {
            if ($(this).hasClass('image-checkbox-checked')) {
                $(this).removeClass('image-checkbox-checked');
                $(this).find('input[type="checkbox"]').first().removeAttr("checked");
            }
            else {
                $(this).addClass('image-checkbox-checked');
                $(this).find('input[type="checkbox"]').first().attr("checked", "checked");
            }

            e.preventDefault();
        });
    });

</script>


  
<script>
  $(function() {
  // Initialize form validation on the registration form.
  // It has the name attribute "registration"
  $("form[name='registration']").validate({
    // Specify validation rules
    rules: {
      // The key name on the left side is the name attribute
      // of an input field. Validation rules are defined
      // on the right side
      fname: "required",
      lname: "required",
      email: {
        required: true,
        // Specify that email should be validated
        // by the built-in "email" rule
        email: true
      },
      password: {
        required: true,
        minlength: 5
      }
    },
    // Specify validation error messages
    messages: {
      fname: "Please enter your firstname",
      lname: "Please enter your lastname",
      password: {
        required: "Please provide a password",
        minlength: "Your password must be at least 5 characters long"
      },
      email: "Please enter a valid email address"
    },
    // Make sure the form is submitted to the destination defined
    // in the "action" attribute of the form when valid
    submitHandler: function(form) {
      form.submit();
    }
  });
});
$(function() {
  // Initialize form validation on the registration form.
  // It has the name attribute "registration"
  $("form[name='loginUser']").validate({
    // Specify validation rules
    rules: {
      // The key name on the left side is the name attribute
      // of an input field. Validation rules are defined
      // on the right side
      fname: "required",
      lname: "required",
      email: {
        required: true,
        // Specify that email should be validated
        // by the built-in "email" rule
        email: true
      },
      password: {
        required: true,
        minlength: 5
      }
    },
    // Specify validation error messages
    messages: {
      fname: "Please enter your firstname",
      lname: "Please enter your lastname",
      password: {
        required: "Please provide a password",
        minlength: "Your password must be at least 5 characters long"
      },
      email: "Please enter a valid email address"
    },
    // Make sure the form is submitted to the destination defined
    // in the "action" attribute of the form when valid
    submitHandler: function(form) {
      form.submit();
    }
  });
 }); 
  $(function() {
  // Initialize form validation on the registration form.
  // It has the name attribute "registration"
  $("form[name='change_password']").validate({
    // Specify validation rules
    rules: {
      // The key name on the left side is the name attribute
      // of an input field. Validation rules are defined
      // on the right side
      old_password: "required",
      new_password: {
        required: true,
        minlength: 5
      },
      confirm_password:{
        required:true,
        equalTo:'#new_password'
      },
    },
    // Specify validation error messages
    messages: {
      old_password: "Please provide a old password",
      
      new_password: {
        required: "Please provide a new password",
        minlength: "Your password must be at least 5 characters long"
      },
      confirm_password: {
        required: "Please provide a Confirm Password",
        equalTo: "The new password and confirm password does not match"
      }
    },
    // Make sure the form is submitted to the destination defined
    // in the "action" attribute of the form when valid
    submitHandler: function(form) {
      form.submit();
    }
  });
});
 $(function() {
  // Initialize form validation on the registration form.
  // It has the name attribute "registration"
  $("form[name='resetPassword']").validate({
    // Specify validation rules
    rules: {
      // The key name on the left side is the name attribute
      // of an input field. Validation rules are defined
      // on the right side
      new_password: {
        required: true,
        minlength: 5
      },
      confirm_password:{
        required:true,
        equalTo:'#new_password'
      },
    },
    // Specify validation error messages
    messages: {
      new_password: {
        required: "Please provide a new password",
        minlength: "Your password must be at least 5 characters long"
      },
      confirm_password: {
        required: "Please provide a Confirm Password",
        equalTo: "The new password and confirm password does not match"
      }
    },
    // Make sure the form is submitted to the destination defined
    // in the "action" attribute of the form when valid
    submitHandler: function(form) {
      form.submit();
    }
  });
});  
$(function() {
  // Initialize form validation on the registration form.
  // It has the name attribute "registration"
  $("form[name='contact_form']").validate({
    // Specify validation rules
    rules: {
      // The key name on the left side is the name attribute
      // of an input field. Validation rules are defined
      // on the right side
      fname: "required",
      email: {
        required: true,
        // Specify that email should be validated
        // by the built-in "email" rule
        email: true
      },
      phone_no: "required",
      subject: "required",
      message: "required",
      
    },
    // Specify validation error messages
    messages: {
      fname: "Please enter your name",
      phone_no: "Please enter your phone number",
      subject: "Please enter the subject",
      email: {
        required: "Please enter the email address",
        email: "Please enter a valid email address"
      },
      message: "Please enter the message",
    },
    // Make sure the form is submitted to the destination defined
    // in the "action" attribute of the form when valid
    submitHandler: function(form) {
      form.submit();
    }
  });
});
  $(function() {
  // Initialize form validation on the registration form.
  // It has the name attribute "registration"
  $("form[name='checkout_form']").validate({
    // Specify validation rules
    rules: {
      // The key name on the left side is the name attribute
      // of an input field. Validation rules are defined
      // on the right side
      fname: "required",
      lname: "required",
      door_no: "required",
      address: "required",
      city: "required",
      post_code: "required",
      phone_no: "required",
      email_address: "required",
      fname_rc: "required",
      lname_rc: "required",
      door_no_rc: "required",
      address_rc: "required",
      city_rc: "required",
      post_code_rc: "required",
      phone_no_rc: "required",
      email_address_rc: "required"
      
    },
    // Specify validation error messages
    messages: {
      fname: "Please provide a first name",
      lname: "Please provide a last name",
      door_no: "Please provide the Door No",
      address: "Please provide address",
      city: "Please provide city",
      post_code: "Please provide a postal code",
      phone_no: "Please provide a phone no",
      email_address: "Please provide a email address",
      fname_rc: "Please provide a first name",
      lname_rc: "Please provide a last name",
      door_no_rc: "Please provide the Door No",
      address_rc: "Please provide address",
      city_rc: "Please provide city",
      post_code_rc: "Please provide a postal code",
      phone_no_rc: "Please provide a phone no",
      email_address_rc: "Please provide a email address"
      
      
    },
    // Make sure the form is submitted to the destination defined
    // in the "action" attribute of the form when valid
    submitHandler: function(form) {
      form.submit();
      
    }
  });
});
  $(function() {
  // Initialize form validation on the registration form.
  // It has the name attribute "registration"
  $("form[name='trackorder_form']").validate({
    // Specify validation rules
    rules: {
      // The key name on the left side is the name attribute
      // of an input field. Validation rules are defined
      // on the right side
      order_no: "required",
      email_phone: "required"
      
    },
    // Specify validation error messages
    messages: {
      order_no: "Please provide the order number",
      email_phone: "Please provide the email or phone number"
      
      
    },
    // Make sure the form is submitted to the destination defined
    // in the "action" attribute of the form when valid
    submitHandler: function(form) {
      console.log("form",form);
      var order_no = $("#order_no").val();
      var email_phone = $("#email_phone").val();

      $.ajax({
        type: "POST",
        url: "{{ url('trackorder_submit') }}",
        data: {order_no:order_no,email_phone:email_phone,_token:"{{ csrf_token() }}"},
        cache: false,
        success: function(data){
          console.log("data",data);
          $(".order_track_data").html(data);
        }
      });
    }
  });
});
$(function() {
  // Initialize form validation on the registration form.
  // It has the name attribute "registration"
  $("form[name='payment_form']").validate({
    // Specify validation rules
    rules: {
      // The key name on the left side is the name attribute
      // of an input field. Validation rules are defined
      // on the right side
      card_name: "required",
      card_no: "required",
      cvv: "required",
      expiration_month: "required",
      expiration_year: "required",
      
    },
    // Specify validation error messages
    messages: {
      card_name: "Please provide the Card Name",
      card_no: "Please provide the Card Number",
      cvv: "Please provide the CVV",
      expiration_month: "Please provide the Expiration Month",
      expiration_year: "Please provide the Expiration Year",
      
      
    },
    // Make sure the form is submitted to the destination defined
    // in the "action" attribute of the form when valid
    submitHandler: function(form) {
      form.submit();
      localStorage.removeItem("cart_id_array");
      
    }
    });
});    
$(function() {
  // Initialize form validation on the registration form.
  // It has the name attribute "registration"
  $("form[name='otp_verification_form']").validate({
    // Specify validation rules
    rules: {
      // The key name on the left side is the name attribute
      // of an input field. Validation rules are defined
      // on the right side
      otp: "required"
      
      
    },
    // Specify validation error messages
    messages: {
      otp: "OTP is required",
      
      
      
    },
    // Make sure the form is submitted to the destination defined
    // in the "action" attribute of the form when valid
    submitHandler: function(form) {
      form.submit();
    }
  });
});    
//  $(function() {
//   // Initialize form validation on the registration form.
//   // It has the name attribute "registration"
//   $("form[name='post_sizes_form']").validate();
// });
$(".close").click(function(){
  $(".alert-success").hide();
  $(".alert-danger").hide();
});

</script>
<script type="text/javascript">
 function addFav(user_id,card_id){
  //alert(user_id);
  
  if($(".card_image .fav-"+card_id+" i").hasClass("fa-heart-o")){
    $(".card_image .fav-"+card_id).html("<i class='fa fa-heart'></i>");
  }else{
    if($(".card_image .fav-"+card_id+" i").hasClass("fa-heart")){
      $(".card_image .fav-"+card_id).html("<i class='fa fa-heart-o'></i>");
    }
  }
  //$(".card_image .fav-"+card_id).html("<i class='fa fa-heart'></i>");
 }
 $(document).ready(function(){
  $(".card_carousel").owlCarousel({
    items:1,
    
    nav:true,
    dots:true
  });

});
var sum = 0;
 $(".cart_price").each(function(i,val){
    var card_price = $.trim($(this).html()).replace("$","");
    sum = parseInt(sum) + parseInt(card_price);
    console.log("cart_price",$.trim($(this).html()).replace("$",""));

 });
 console.log("cart_price",sum.toFixed(2));
 $(".total_price").html("$"+sum.toFixed(2));

function qtyInc(event,cart_id,cart_price,size_qty){
  //alert(cart_id);
  

  if(event == 'plus'){

    
    $(".min-"+cart_id).removeAttr("disabled");
    var qty_value = $("#qty-"+cart_id).val();
    qty_value++;
    $("#qty-"+cart_id).val(qty_value);
    var price = qty_value * cart_price;
    $("#qty-"+cart_id).val();
    $(".cart_price-"+cart_id).text("$"+price.toFixed(2));
    var remaining_qty = size_qty - qty_value;
    //alert(remaining_qty);
    if(remaining_qty<1){
      $(".qty_td-"+cart_id+" .qty_not_available").show();
      $(".plus-"+cart_id).attr("disabled","disabled");
    }

    $.ajax({
      type: "post",
      url: "{{ url('/post_cart') }}",
      data: {cart_id:cart_id,price:price,qty:qty_value,_token:"{{ csrf_token() }}"},
      cache: false,
      success: function(data){
         //$("#resultarea").text(data);
      }
    });

    var price_sum = 0;
    
    $(".cart_price").each(function(i,val){
      var price = $.trim($(this).html().replace("$",""));
      
      price_sum = parseInt(price_sum) + parseInt(price);
    });
    console.log("price",price_sum);
    $(".total_price").html("$"+price_sum.toFixed(2));
    var cart_count = $(".cart_count").html();
    var cart_new_count = parseInt(cart_count)+1;
    $(".cart_count").html(cart_new_count);
  }

  if(event == 'minus'){
    var qty_value = $("#qty-"+cart_id).val();
    qty_value--;
    if(qty_value < 2){
      $(".min-"+cart_id).attr("disabled","disabled");
    }
    $("#qty-"+cart_id).val(qty_value);
    var price = qty_value * cart_price;

    $("#qty-"+cart_id).val();
    $(".cart_price-"+cart_id).text("$"+price.toFixed(2));

    var remaining_qty = size_qty - qty_value;
    //alert(remaining_qty);
    if(remaining_qty > 0){
      $(".qty_td-"+cart_id+" .qty_not_available").hide();
      $(".plus-"+cart_id).removeAttr("disabled");
    }

    $.ajax({
      type: "post",
      url: "{{ url('/post_cart') }}",
      data: {cart_id:cart_id,price:price,qty:qty_value,_token:"{{ csrf_token() }}"},
      cache: false,
      success: function(data){
         //$("#resultarea").text(data);
      }
    });

    

    var price_sum = 0;
    
    $(".cart_price").each(function(i,val){
      var price = $.trim($(this).html().replace("$",""));
      
      price_sum = parseInt(price_sum) + parseInt(price);
    });
    console.log("price",price_sum);
    $(".total_price").html("$"+price_sum.toFixed(2));

    var cart_count = $(".cart_count").html();
    var cart_new_count = parseInt(cart_count)-1;
    $(".cart_count").html(cart_new_count);
  }
}

var cart_id_array = localStorage.getItem("cart_id_array");
  var arry_json = JSON.parse(cart_id_array);

  
  $.each(arry_json,function(i,val){
      console.log("val",val);

    $.ajax({
      type: "GET",
      url: "{{ url('cart_table') }}",
      data: {cart_id:val},
      cache: false,
      success: function(data){
        
        
      }
    });

    $.ajax({
      type: "GET",
      url: "{{ url('get_gift_cart_data') }}",
      data: {cart_id:val},
      cache: false,
      success: function(data){
        var gift_data = JSON.parse(data);
        console.log("get_gift_cart_data",gift_data.card_id);
        $(".express_gift_id").each(function(i,val){
          var gift_card_id = $(this).val();
          if(gift_data.card_id == gift_card_id){
            //$("#html-"+gift_card_id).attr("checked","");
            //$(".image-checkbox-"+gift_card_id).addClass("image-checkbox-checked");
            //$(".submit_btn-"+gift_card_id).addClass("active-gift");
            //$(".submit_btn-"+gift_card_id).attr("disabled","");
          }
        });
      }
    });
    
  });

  // $(".user_logout").click(function(){
  //   localStorage.removeItem("cart_id_array");
  // });

  function clickSize(size_value,card_size_price){
    //alert(size_value);
    $(".card_size_price").val(card_size_price);
  }

  function remove_fav(favourite_card_id){
    $.ajax({
      type: "GET",
      url: "{{ url('user/favourites_delete') }}",
      data: {favourite_card_id:favourite_card_id},
      cache: false,
      success: function(data){
        window.location.href = "{{ url('user/user_favourites') }}";
        
      }
    });
  }

  var cart_id_array = localStorage.getItem("cart_id_array");
  $(".cart_id_array").val(cart_id_array);
  var arry_json = JSON.parse(cart_id_array);


  
  if(!cart_id_array || arry_json.length<1){
    $(".cart_count").html(0);
    $(".pay-now-brn").click(function(){
      $(".payment-error").html('<div class="alert alert-danger text-center"><a href="#" class="close" data-dismiss="alert" aria-label="close">×</a><p>Please add the item in the cart</p></div>');
    });
  }else{
    
      $.ajax({
      type: "GET",
      url: "{{ url('check_cart_count') }}",
      data: {cart_ids:cart_id_array},
      cache: false,
      success: function(data){
        console.log("cart_data",data);
        $(".cart_count").html(data);
        
      }
    });
  }
  

  
  var sum = 0;
  $.each(arry_json,function(i,val){
      

    
    if(window.location.pathname == "/express_checkout" || window.location.pathname == "/ex_payment_transaction"){
      $.ajax({
        type: "GET",
        url: "{{ url('ex_checkout_data') }}",
        data: {cart_id:val},
        cache: false,
        success: function(data){
          console.log("cart_data",data);
          $(".checkout_table_data").prepend(data);
          var card_price = $.trim($(".total_card_price-"+val).html()).replace("$","");
          
          sum = parseInt(sum) + parseInt(card_price);

          console.log("cart_price2",sum);

          $(".pay_now_price").html("$"+sum.toFixed(2));
          $(".order_total_price").val(sum.toFixed(2));
        }
      });
    }else{
      $.ajax({
        type: "GET",
        url: "{{ url('checkout_data') }}",
        data: {cart_id:val},
        cache: false,
        success: function(data){
          
          $(".checkout_table_data").prepend(data);
          var card_price = $.trim($(".total_card_price-"+val).html()).replace("$","");
          
          sum = parseInt(sum) + parseInt(card_price);

          console.log("cart_price2",sum);

          $(".pay_now_price").html("$"+sum.toFixed(2));
          $(".order_total_price").val(sum.toFixed(2));
        }
      });
    }
    
    
  });

  function changeCountry(){
    var country_id = $("#country").val();
    //alert(country_id);
    $.ajax({
      type: "GET",
      url: "{{ url('get_state') }}",
      data: {country_id:country_id},
      cache: false,
      success: function(data){
        //console.log("data",data);
        
          $("#state").html(data);
        
        
      }
    });
  }

  function changeState(){
    var state_id = $("#state").val();
    //alert(country_id);
    $.ajax({
      type: "GET",
      url: "{{ url('get_city') }}",
      data: {state_id:state_id},
      cache: false,
      success: function(data){
        //console.log("data",data);
        
          $("#city").html(data);
        
        
      }
    });
  }

  function searchProduct(){
    var search = $(".search").val();
    //alert(search);
    $.ajax({
      type: "GET",
      url: "{{ url('get_cards') }}",
      data: {search_words:search},
      cache: false,
      success: function(data){
        //console.log("data",data);
        
          //$("#city").html(data);
        
        
      }
    });
  }
function myFunction(){
    
    // var search = $(".search").val();
    // alert(search);
    // $.ajax({
    //   type: "GET",
    //   url: "{{ url('get_cards') }}",
    //   data: {search_words:search},
    //   cache: false,
    //   success: function(data){
    //     //console.log("data",data);
        
    //       //$("#city").html(data);
        
        
    //   }
    // });
  }
   function searchProduct(){

    $(".search-drpdwn").show();
    var search = $(".search").val();
    //alert(search);
    $.ajax({
      type: "GET",
      url: "{{ url('get_cards') }}",
      data: {search_words:search},
      cache: false,
      success: function(data){
        //console.log("data",data);
        
        $(".search-drpdwn-products").html(data);
        
        
      }
    });
  }

  $(document).mouseup(function(e){
    var search_box = $(".search-drpdwn");

    // If the target of the click isn't the container
    if(!search_box.is(e.target) && search_box.has(e.target).length === 0){
        search_box.hide();
    }
  });
  
  $(document).ready (function () {  
    $('.order-details-div').after ('<div id="nav"></div>');  
    var rowsShown = 5;  
    var rowsTotal = $('#order-data tbody tr').length;  
    console.log("rowsTotal",rowsTotal);
    var numPages = rowsTotal/rowsShown;  
    for (i = 0;i < numPages;i++) {  
        var pageNum = i + 1;  
        $('#nav').append ('<a href="#" rel="'+i+'">'+pageNum+'</a> ');  
    }  
    $('#order-data tbody tr').hide();  
    $('#order-data tbody tr').slice (0, rowsShown).show();  
    $('#nav a:first').addClass('active');  
    $('#nav a').bind('click', function() {  
    $('#nav a').removeClass('active');  
      $(this).addClass('active');  
          var currPage = $(this).attr('rel');  
          var startItem = currPage * rowsShown;  
          var endItem = startItem + rowsShown;  
          $('#order-data tbody tr').css('opacity','0.0').hide().slice(startItem, endItem).  
          css('display','table-row').animate({opacity:1}, 300);  
      });  
    });   

    function searchModel(card_id){
       
       $.ajax({
        type: "GET",
        url: "{{ url('searchModel') }}",
        data: {card_id:card_id},
        cache: false,
        success: function(data){
          //console.log("data",data);
          
          $(".searchModal").html(data);
          $(".close").click(function(){
            $(".modal").hide();
          });
          $(".card_carousel").owlCarousel({
            items:1,
            
            nav:true,
            dots:true
          });

          
        }
      });
    }

    function giftSubmit(gift_card_id,gift_card_qty,gift_card_price){
      
      

      $.ajax({
        type: "POST",
        url: "{{ url('submit_gift') }}",
        data: {gift_card_id:gift_card_id,gift_card_qty:gift_card_qty,gift_card_price:gift_card_price,_token:"{{ csrf_token() }}"},
        cache: false,
        success: function(data){
          console.log("data",data);
          
          var cart_id_array = localStorage.getItem("cart_id_array");
          //console.log("cart_id_array",cart_id_array);
          if(cart_id_array){
            
            
            if(cart_id_array.indexOf(cart_id) === -1){
              var arry_json = JSON.parse(cart_id_array);
              arry_json.push(data);
              var new_local = JSON.stringify(arry_json);
              //console.log("cart_id_array",cart_id);
              localStorage.setItem("cart_id_array",new_local);
            }
            
            
          }else{
            var cart_id = $(".cart1_id").val();
          
            var cart_id_array = [];

            
            cart_id_array.push(data);
            var new_array = JSON.stringify(cart_id_array);
            console.log("cart_id_array",new_array);
            localStorage.setItem("cart_id_array",new_array);
          }

          window.location.href = "{{ url('birthday-cards') }}";  
        }

      });
      
      
    };

    function selectGift(card_id){
      $(".gift-radio").removeAttr("checked");
      $(".gift-radio-"+card_id).attr("checked","");
      $(".gift_card_id").val(card_id);
    }
    function selectGiftSingle(gift_id,order_id){
      $("#html-"+gift_id).attr("checked","");
      $(".image-checkbox-"+gift_id).addClass("image-checkbox-checked");
      $("#myModal-"+gift_id).hide();
      $(".modal-backdrop").hide();
      $(".submit_btn-"+gift_id).addClass("active-gift");
      
    }
    var options = {
        title: 'Accept Cookies & Privacy Policy?',
        message: 'There are no cookies used on this site, but if there were this message could be customised to provide more details. Click the <strong>accept</strong> button below to see the optional callback in action...',
        delay: 600,
        expires: 1,
        link: "{{ url('privacy-policy') }}",
        onAccept: function(){
            var myPreferences = $.fn.ihavecookies.cookie();
            console.log('Yay! The following preferences were saved...');
            console.log(myPreferences);
            var mouseX = 0;
            var mouseY = 0;
            var popupCounter = 0;
            document.addEventListener("mousemove", function(e) {
            mouseX = e.clientX;
            mouseY = e.clientY;
            //document.getElementById("coordinates").innerHTML = "<br />X: " + e.clientX + "px<br />Y: " + e.clientY + "px";
          });

          $(document).mouseleave(function () {
              if (mouseY < 100) {
                  if (popupCounter < 1) {
                      $("#email_popup").show();
                  }
                  popupCounter ++;
              }
          });
        },
        uncheckBoxes: true,
        acceptBtnLabel: 'Accept Cookies',
        moreInfoLabel: 'More information',
        cookieTypesTitle: 'Select which cookies you want to accept',
        fixedCookieTypeLabel: 'Essential',
        fixedCookieTypeDesc: 'These are essential for the website to work correctly.'
    }

    $(document).ready(function() {
        $('body').ihavecookies(options);

        if ($.fn.ihavecookies.preference('marketing') === true) {
            console.log('This should run because marketing is accepted.');
        }

        $('#ihavecookiesBtn').on('click', function(){
            $('body').ihavecookies(options, 'reinit');
        });
    });
    // window.addEventListener('beforeunload', function (e) { 
    //     e.preventDefault(); 
    //     e.returnValue = 'Okay Bye'; 
    //     $("#email_popup").show();
    // });
    $("#email_popup .modal-header .close").click(function(){
      $("#email_popup").hide();
    });
    function addBasket(gift_card_id,price){
      
        $.ajax({
          type: "POST",
          url: "{{ url('gift_basket') }}",
          data: {gift_card_id:gift_card_id,price:price,status:1,_token:"{{ csrf_token() }}"},
          cache: false,
          success: function(data){
            //console.log("data",data);

            if(data){

              var cart_id_array = localStorage.getItem("cart_id_array");
              var arry_json = JSON.parse(cart_id_array);
              
              arry_json.push(data)
              
              var new_array_json = JSON.stringify(arry_json);
              localStorage.setItem("cart_id_array",new_array_json);
              $(".add_basket_msg-"+gift_card_id).html("Gift has been added in the basket");
              $(".submit_btn-"+gift_card_id).addClass("active-gift");
              $(".submit_btn-"+gift_card_id).attr("disabled",true);
              var gift_modal = $('#myModal-'+gift_card_id).is(":visible");
              var cart_count = $(".cart_count").html();
              var cart_new_count = parseInt(cart_count)+1;
              $(".cart_count").html(cart_new_count);

             

            }

          }
        });
      
    
  }
  
  $("#dropdownMenuButton1").click(function(){
    window.location.href = "{{ url('/cart') }}";
  });
   function resendOTP(order_id,email){
    
    $.ajax({
      type: "POST",
      url: "{{ url('resend_otp') }}",
      data: {order_id:order_id,email:email,_token:"{{ csrf_token() }}"},
      cache: false,
      success: function(data){
        //console.log("data",data);

        if(data == 1){
          $(".otp_success").html('<div class="alert alert-success success-msg text-center"><a href="#" class="close" data-dismiss="alert" aria-label="close">×</a><p>OTP is sent on your email</p></div>');
          //window.location.href = "{{ url('otp_verification') }}/"+order_id;
        }
        
        
        
        
      }
    });
  }
  setTimeout(function() {
    $('.alert').fadeOut('slow');
  }, 5000);
</script>
  @yield('current_page_js')
</body>

</html>