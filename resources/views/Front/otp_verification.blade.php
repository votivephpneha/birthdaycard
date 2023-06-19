@extends('Front.layout.layout')
@section('title', 'Home')

@section('current_page_css')
@endsection

@section('current_page_js')
@endsection

@section('content')
<style type="text/css">
    .payment_otp_page{
        margin-top:150px;
    }
</style> 
<section class="registration-page payment_otp_page">   
<div class="container payment_verfication_page">
    
    <!-- <h1>Laravel - Stripe Payment Gateway Integration Example <br/> ItSolutionStuff.com</h1> -->
    
    <div class="row">
        <div class="col-md-6 col-md-offset-3 m-auto">
            <div class="panel panel-default credit-card-box opt">
                <div class="panel-heading display-table" >
                        <h3 class="panel-title">OTP Verification</h3>
                </div>
                <div class="panel-body">
                    @if ($message = Session::get('error'))
                        <div class="alert alert-danger text-center">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                            <p>{{ $message }}</p>
                        </div>
                    @endif
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success text-center">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                            <p>{{ $message }}</p>
                        </div>
                    @endif
    				<form method="post" action="{{ url('post_otp') }}" class="require-validation" data-cc-on-file="false"
                            data-stripe-publishable-key="{{ env('STRIPE_KEY') }}"
                            id="payment-form">
                        @csrf
    					<div class="form-group mb-3">
    						<label for="for_otp">OTP</label>
    						<input name="order_id" value="{{ $order_id }}" type='hidden'>
                            <input type='text' name="otp" class="form-control">
                            <input type='hidden' name="card_name" class="form-control" value="{{ $card_name }}">
                            <input type='hidden' name="card_number" class="form-control card-number" value="{{ $card_no }}">
                            <input type='hidden' name="cvv" class="form-control card-cvc" value="{{ $cvv }}">
                            <input type='hidden' name="expiration_month" class="form-control card-expiry-month" value="{{ $expiration_month }}">
                            <input type='hidden' name="expiration_year" class="form-control card-expiry-year" value="{{ $expiration_year }}">
                            <input type='hidden' name="email" class="form-control email" value="{{ $email }}">
    					</div>
    				<center>	<input type="submit" name="otp_btn" class="btn btn-primary otp-btn" value="Submit"></center>
    				</form>
                </div>
            </div>        
        </div>
    </div>
        
</div>
    
</section>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>       
<script type="text/javascript" src="https://js.stripe.com/v2/"></script>
 
<script type="text/javascript">
  
$(function() {
  
    /*------------------------------------------
    --------------------------------------------
    Stripe Payment Code
    --------------------------------------------
    --------------------------------------------*/
    
    var $form = $(".require-validation");
     
    $('form.require-validation').bind('submit', function(e) {
        var $form = $(".require-validation"),
        inputSelector = ['input[type=email]', 'input[type=password]',
                         'input[type=text]', 'input[type=file]',
                         'textarea'].join(', '),
        $inputs = $form.find('.required').find(inputSelector),
        $errorMessage = $form.find('div.error'),
        valid = true;
        $errorMessage.addClass('hide');
    
        $('.has-error').removeClass('has-error');
        $inputs.each(function(i, el) {
          var $input = $(el);
          if ($input.val() === '') {
            $input.parent().addClass('has-error');
            $errorMessage.removeClass('hide');
            e.preventDefault();
          }
        });
     
        if (!$form.data('cc-on-file')) {
          e.preventDefault();
          Stripe.setPublishableKey($form.data('stripe-publishable-key'));
          Stripe.createToken({
            number: $('.card-number').val(),
            cvc: $('.card-cvc').val(),
            exp_month: $('.card-expiry-month').val(),
            exp_year: $('.card-expiry-year').val()
          }, stripeResponseHandler);
        }
    
    });
      
    /*------------------------------------------
    --------------------------------------------
    Stripe Response Handler
    --------------------------------------------
    --------------------------------------------*/
    function stripeResponseHandler(status, response) {
        if (response.error) {
            $('.error')
                .removeClass('hide')
                .find('.alert')
                .text(response.error.message);
        } else {
            /* token contains id, last4, and card type */
            var token = response['id'];
                 
            $form.find('input[type=text]').empty();
            $form.append("<input type='hidden' name='stripeToken' value='" + token + "'/>");
            $form.get(0).submit();
        }
    }
     
});
</script>
@endsection