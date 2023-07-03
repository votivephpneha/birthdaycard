<?php

use Illuminate\Support\Facades\Route;
// use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
// use App\Http\Controllers\UserController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\CardController;
use App\Http\Controllers\Admin\MessageController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\SubCategoryController;
use App\Http\Controllers\Admin\CardSizeController;
use App\Http\Controllers\Admin\AdminPagesController;
use App\Http\Controllers\Front\CustomerController;
use App\Http\Controllers\Front\HomeController;
use App\Http\Controllers\Admin\CustomTextController;
use App\Http\Controllers\Front\FrontCardController;
use App\Http\Controllers\Admin\FavouriteCardsController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\VoucherCodeController;
use App\Http\Controllers\Admin\GiftController;
use App\Http\Controllers\Admin\PaymentController;
use App\Http\Controllers\Admin\ContactusController;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\EditorImagesController;
use App\Http\Controllers\Front\StaticPageController;
use App\Http\Controllers\Front\OrdertrackingController;
use App\Http\Controllers\Front\StripePaymentController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/config-cache', function () {
	$exitCode = Artisan::call('config:cache');
	$exitCode = Artisan::call('config:clear');
	$exitCode = Artisan::call('route:clear');
	$exitCode = Artisan::call('view:clear');
	return '<h1>config cache cleared</h1>';
});

Route::get('/cache', function () {
	Artisan::call('config:cache');
	Artisan::call('config:clear');
	Artisan::call('route:clear');
});

//Front Module
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/birthday-cards', [FrontCardController::class, 'index'])->name('birthday-cards');
Route::post('/birthday-favourites', [FrontCardController::class, 'addFavourites'])->name('addFavourites');
Route::post('/post_sizes', [FrontCardController::class, 'post_sizes'])->name('post_sizes');
Route::get('/video_upload_page/{cart_id}', [FrontCardController::class, 'video_upload_page'])->name('video_upload_page');
Route::post('/post_video', [FrontCardController::class, 'post_video'])->name('post_video');
Route::get('/show_video/{cart_id}', [FrontCardController::class, 'show_video'])->name('show_video');
Route::get('/show_video_image/{cart_id}', [FrontCardController::class, 'show_video_image'])->name('show_video_image');
Route::post('/delete_video', [FrontCardController::class, 'delete_video'])->name('delete_video');
Route::get('/card_editor/{cart_id}/{card_type}', [FrontCardController::class, 'card_editor'])->name('card_editor');
Route::post('/post_card', [FrontCardController::class, 'post_card'])->name('post_card');
Route::get('/cart_continue', [FrontCardController::class, 'cart_continue'])->name('cart_continue');

Route::get('/registration', [CustomerController::class, 'index'])->name('registration');
Route::post('/submitUser', [CustomerController::class, 'submitUser'])->name('submitUser');
Route::get('/loginUser', [CustomerController::class, 'loginUser'])->name('loginUser');
Route::post('/submitLoginUser', [CustomerController::class, 'submitLoginUser'])->name('submitLoginUser');
Route::get('/forget_password', [CustomerController::class, 'forget_password'])->name('forget_password');
Route::post('/postforget_password', [CustomerController::class, 'postforget_password'])->name('postforget_password');
Route::get('/reset_password/{token}', [CustomerController::class, 'reset_password'])->name('reset_password');
Route::post('/postreset_password', [CustomerController::class, 'postreset_password'])->name('postreset_password');
Route::get('/get_cards/', [FrontCardController::class, 'get_cards'])->name('get_cards');
Route::get('/searchModel/', [FrontCardController::class, 'searchModel'])->name('searchModel');
Route::post('/search_submit/', [FrontCardController::class, 'search_submit'])->name('search_submit');
Route::get('/contact-us/', [FrontCardController::class, 'contact_us'])->name('contact-us');
Route::post('/submitContact/', [FrontCardController::class, 'submitContact'])->name('submitContact');
Route::get('/privacy-policy/', [FrontCardController::class, 'about_us'])->name('about-us');
Route::get('/terms-service/', [StaticPageController::class, 'index'])->name('terms_service');
Route::get('/refund_policy/', [StaticPageController::class, 'refund_policy'])->name('refund_policy');
Route::get('/shipping_policy/', [StaticPageController::class, 'shipping_policy'])->name('shipping_policy');
Route::get('/user_favourites', [CustomerController::class, 'user_favourites'])->name('user_favourites');
Route::get('/order-track/', [OrdertrackingController::class, 'index'])->name('order-track');
Route::post('/trackorder_submit/', [OrdertrackingController::class, 'trackorder_submit'])->name('trackorder_submit');
Route::get('/blogs/', [HomeController::class, 'blogs'])->name('blogs');
Route::get('/blog_detail/{blog_id}', [HomeController::class, 'blog_detail'])->name('blog_detail');
Route::get('/gift_card/', [HomeController::class, 'gift_card'])->name('gift_card');
Route::post('/submit_gift/', [HomeController::class, 'submit_gift'])->name('submit_gift');
Route::get('/ex_gift_card/', [FrontCardController::class, 'express_gift_card'])->name('ex_gift_card');
Route::post('/submit_ex_gift_card', [FrontCardController::class, 'submit_ex_gift_card'])->name('submit_ex_gift_card');
Route::get('ex_payment_transaction/', [StripePaymentController::class, 'stripe'])->name('stripe');
Route::post('stripe', [StripePaymentController::class, 'stripePost'])->name('stripe.post');
Route::get('otp_verification/{order_id}', [StripePaymentController::class, 'otp_verification'])->name('otp_verification');
Route::post('otp_verify', [StripePaymentController::class, 'otp_verify'])->name('otp_verify');
Route::post('post_otp', [StripePaymentController::class, 'post_otp'])->name('post_otp');
Route::post('resend_otp', [StripePaymentController::class, 'resend_otp'])->name('resend_otp');
Route::get('get_gift_cart_data', [FrontCardController::class, 'get_gift_cart_data'])->name('get_gift_cart_data');
Route::group(['prefix' => 'user', 'middleware' => 'customer_auth:customer'], function () {
	Route::get('/userProfile', [CustomerController::class, 'userProfile'])->name('userProfile');
	Route::post('/postuserProfile', [CustomerController::class, 'postuserProfile'])->name('postuserProfile');
	Route::get('/user_ChangePassword', [CustomerController::class, 'user_ChangePassword'])->name('user_ChangePassword');
	Route::post('/postuser_ChangePassword', [CustomerController::class, 'postuser_ChangePassword'])->name('postuser_ChangePassword');
	Route::get('/user_order', [CustomerController::class, 'user_order'])->name('user_order');
	Route::get('/user_favourites', [CustomerController::class, 'user_favourites'])->name('user_favourites');
	Route::get('/order_detail/{order_id}', [CustomerController::class, 'order_detail'])->name('order_detail');
	Route::get('/favourites_delete', [CustomerController::class, 'favourites_delete'])->name('favourites_delete');
	Route::get('/front_logout', [CustomerController::class, 'front_logout'])->name('front_logout');
	Route::get('payment_transaction/', [StripePaymentController::class, 'stripe'])->name('stripe');
});
Route::get('/cart', [FrontCardController::class, 'cart_page'])->name('cart_page');
Route::get('/cart_data', [FrontCardController::class, 'cart_data'])->name('cart_data');
Route::get('/delete_cart_item', [FrontCardController::class, 'delete_cart_item'])->name('delete_cart_item');
Route::post('/post_cart', [FrontCardController::class, 'post_cart'])->name('post_cart');
Route::get('/cart_table', [FrontCardController::class, 'cart_table_show_data'])->name('cart_table');
Route::get('/check_gift_data', [FrontCardController::class, 'check_gift_data'])->name('check_gift_data');
Route::get('/ex_checkout_data', [FrontCardController::class, 'checkout_data'])->name('checkout_data');
Route::get('/express_checkout/', [FrontCardController::class, 'checkout'])->name('checkout');
Route::get('/get_state/', [FrontCardController::class, 'get_state'])->name('get_state');
Route::get('/get_city/', [FrontCardController::class, 'get_city'])->name('get_city');
Route::post('/ex_post_checkout', [FrontCardController::class, 'post_checkout'])->name('post_checkout');
Route::get('/ex_order_status/{order_id}', [FrontCardController::class, 'order_status'])->name('order_status');
Route::post('/insertSingleGift', [FrontCardController::class, 'insertSingleGift'])->name('insertSingleGift');
Route::post('/send_newsletter', [FrontCardController::class, 'send_newsletter'])->name('send_newsletter');
Route::get('/check_cart_count', [FrontCardController::class, 'check_cart_count'])->name('check_cart_count');
Route::post('/gift_basket', [FrontCardController::class, 'gift_basket'])->name('gift_basket');
Route::get('/delivery_address/{cart_id}', [HomeController::class, 'delivery_address'])->name('delivery_address');
Route::post('saveAddress', [HomeController::class, 'saveAddress'])->name('saveAddress');
Route::group(['prefix' => '', 'middleware' => 'customer_auth:customer'], function (){
	Route::get('/checkout_data', [FrontCardController::class, 'checkout_data'])->name('checkout_data');
	Route::get('/checkout/', [FrontCardController::class, 'checkout'])->name('checkout');
	
	Route::post('/post_checkout', [FrontCardController::class, 'post_checkout'])->name('post_checkout');
	Route::get('/order_status/{order_id}', [FrontCardController::class, 'order_status'])->name('order_status');
});	
//Admin Module

Route::get('/admin', [AuthController::class, 'index'])->name('login');
Route::post('/login', [AuthController::class, 'adminLogin'])->name('login.post');
// apply midddleware
Route::group(['prefix' => 'admin', 'middleware' => 'auth:adm'], function () {

	Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');
	Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
	Route::get('/changepassword', [AuthController::class, 'ChangePassword'])->name('chagepassword');
	Route::post('/changepassword', [AuthController::class, 'ChangePasswordSubmit'])->name('chagepassword.post');
	Route::get('/changeprofile', [AuthController::class, 'ChangeProfile'])->name('change-profile');
	Route::post('/changeprofile', [AuthController::class, 'ChangeProfileStore'])->name('change-profile-post');

	// customer management routes
	Route::get('/userlist', [UserController::class, 'Userlist'])->name('userlist');
	Route::get('/get-userlist', [UserController::class, 'GetUsers'])->name('get-userlist');
	Route::get('/add-customer', [UserController::class, 'AddCustomer'])->name('add-customer');
	Route::post('/add-customer', [UserController::class, 'AddCustomerPost'])->name('add-customer.post');
	Route::get('/edit-customer/{id}', [UserController::class, 'EditUser'])->name('edit-customer');
	Route::post('/edit-customer/{id}', [UserController::class, 'UpdateCustomer'])->name('edit-customer-post');
	Route::post('/delete-customer', [UserController::class, 'deleteCustomer'])->name('delete-customer-post');
	Route::post('/user-status-change',[UserController::class,'User_status_change'])->name('user.status.change');


	// card management routes
	Route::get('/cardlist', [CardController::class, 'index'])->name('cardlist');
	Route::get('/create-card', [CardController::class, 'create'])->name('create.card');
	Route::post('/create-card', [CardController::class, 'store'])->name('create.card.post');
	Route::get('/getcardlist', [CardController::class, 'getCardlist'])->name('get.cardlist');
	Route::get('/editcard/{id}', [CardController::class, 'edit'])->name('edit.card');
	Route::post('/editcard/{id}', [CardController::class, 'update'])->name('edit.card.post');
	Route::post('/delete-card', [CardController::class, 'destroy'])->name('delete.card.post');
	Route::get('/viewcard/{id}', [CardController::class, 'show'])->name('view.card');
	Route::get('/delete_card_images/{id}', [CardController::class, 'card_gallery_delete'])->name('delete-card-images');
	Route::post('/status-change12', [CardController::class, 'Status_change'])->name('status.change');
	Route::post('/getsubcatlist', [CardController::class, 'getsubcatlist'])->name('get.subcatlist');

	//message management routes
	Route::get('/textmessagelist', [MessageController::class, 'index'])->name('messagelist');
	Route::get('/create-message', [MessageController::class, 'create'])->name('create.message');
	Route::post('/create-message', [MessageController::class, 'store'])->name('create.message.post');
	Route::get('/getmessagelist', [MessageController::class, 'getTextmessagelist'])->name('get.messagelist');
	Route::get('/edittextmessage/{id}', [MessageController::class, 'edit'])->name('edit.message');
	Route::post('/edittextmessage/{id}', [MessageController::class, 'update'])->name('edit.message.post');
	Route::post('/delete-message', [MessageController::class, 'destroy'])->name('delete.message.post');
	Route::post('/mess-status-change',[MessageController::class,'Mess_status_change'])->name('mess.status.change');



	//text font management routes
	Route::get('/textfontlist', [CustomTextController::class, 'textfontlist'])->name('textfontlist');
	Route::get('/create-text-font', [CustomTextController::class, 'createtextfont'])->name('create.textfont');
	Route::post('/create-text-font', [CustomTextController::class, 'storetextfont'])->name('create.textfont.post');
	Route::get('/gettextfontlist', [CustomTextController::class, 'getTextfontlist'])->name('get.textfontlist');
	Route::get('/edittextfont/{id}', [CustomTextController::class, 'edittextfont'])->name('edit.textfont');
	Route::post('/edittextfont/{id}', [CustomTextController::class, 'updatetextfont'])->name('edit.textfont.post');
	Route::post('/delete-text-font', [CustomTextController::class, 'destroytextfont'])->name('delete.textfont.post');

	//text size management routes
	Route::get('/textsizelist', [CustomTextController::class, 'textsizelist'])->name('textsizelist');
	Route::get('/create-text-size', [CustomTextController::class, 'createtextsize'])->name('create.textsize');
	Route::post('/create-text-size', [CustomTextController::class, 'storetextsize'])->name('create.textsize.post');
	Route::get('/gettextsizelist', [CustomTextController::class, 'getTextsizelist'])->name('get.textsizelist');
	Route::get('/edittextsize/{id}', [CustomTextController::class, 'edittextsize'])->name('edit.textsize');
	Route::post('/edittextsize/{id}', [CustomTextController::class, 'updatetextsize'])->name('edit.textsize.post');
	Route::post('/delete-text-size', [CustomTextController::class, 'destroytextsize'])->name('delete.textsize.post');

	//text color management routes
	Route::get('/textcolorlist', [CustomTextController::class, 'textcolorlist'])->name('textcolorlist');
	Route::get('/create-text-color', [CustomTextController::class, 'createtextcolor'])->name('create.textcolor');
	Route::post('/create-text-color', [CustomTextController::class, 'storetextcolor'])->name('create.textcolor.post');
	Route::get('/gettextcolorlist', [CustomTextController::class, 'getTextcolorlist'])->name('get.textcolorlist');
	Route::get('/edittextcolor/{id}', [CustomTextController::class, 'edittextcolor'])->name('edit.textcolor');
	Route::post('/edittextcolor/{id}', [CustomTextController::class, 'updatetextcolor'])->name('edit.textcolor.post');
	Route::post('/delete-text-color', [CustomTextController::class, 'destroytextcolor'])->name('delete.textcolor.post');


	// card category management
	Route::get('/cardcategorylist', [CategoryController::class, 'index'])->name('categorylist');
	Route::get('/create-category', [CategoryController::class, 'create'])->name('create.category');
	Route::post('/create-category', [CategoryController::class, 'store'])->name('create.category.post');
	Route::get('/getcategorylist', [CategoryController::class, 'getCategorylist'])->name('get.categorylist');
	Route::get('/edit-card-category/{id}', [CategoryController::class, 'show'])->name('edit.category');
	Route::post('/edit-card-category/{id}', [CategoryController::class, 'edit'])->name('edit.category.post');
	Route::post('/delete-category', [CategoryController::class, 'destroy'])->name('delete.category.post');

	//card size management
	Route::get('/card-size-list', [CardSizeController::class, 'index'])->name('cardsizelist');
	Route::get('/create-card_size', [CardSizeController::class, 'create'])->name('create.card.size');
	Route::post('/create-card_size', [CardSizeController::class, 'store'])->name('create.card.size.post');
	Route::get('/getcardsizelist', [CardSizeController::class, 'getCardSizelist'])->name('get.cardsizelist');
	Route::post('/delete-card-size', [CardSizeController::class, 'destroy'])->name('delete.card.size.post');
	Route::get('/edit-card-size/{id}', [CardSizeController::class, 'edit'])->name('edit.card.size');
    Route::post('/edit-card-size/{id}', [CardSizeController::class, 'update'])->name('edit.card.size.post');

	// Content management Routes
	Route::get('/content-pagelist', [AdminPagesController::class, 'index'])->name('content-pagelist');
	Route::get('/create-new-page', [AdminPagesController::class, 'create'])->name('create.new.page');
	Route::post('/create-new-page', [AdminPagesController::class, 'store'])->name('create.new.page.post');
	Route::get('/getpagelist', [AdminPagesController::class, 'getPagelist'])->name('get.pagelist');
	Route::get('/edit-page/{id}', [AdminPagesController::class, 'edit'])->name('edit.page');
	Route::post('/edit-page/{id}', [AdminPagesController::class, 'update'])->name('edit.page.post');
	Route::post('/delete-page', [AdminPagesController::class, 'destroy'])->name('delete.page.post');
	Route::post('/content-page-status-change',[AdminPagesController::class,'contentp_status_change'])->name('content.page.status.change');
	Route::get('/home-content-list', [AdminPagesController::class, 'homepagelist'])->name('home.page.list');
	Route::get('/create-section-page', [AdminPagesController::class, 'CreateHomePage'])->name('create.home.page');
	Route::post('/create-section-page', [AdminPagesController::class, 'StoreSecData'])->name('create.sec.page.post');
    Route::post('/section-status-change',[AdminPagesController::class,'sectionpage_status_change'])->name('sectionpage.status.change');
	Route::post('/delete-section', [AdminPagesController::class, 'DeleteSection'])->name('delete.secpage.post');
	Route::get('/edit-home-content/{id}', [AdminPagesController::class, 'editSectionPage'])->name('edit.secpage.page');
	Route::post('/edit-home-content/{id}', [AdminPagesController::class, 'UpdateSection'])->name('edit.secpage.page.post');
	Route::get('/first-slider-list', [AdminPagesController::class, 'HomesliderFirstList'])->name('home.first.slider.list');
	Route::get('/create-first-slider', [AdminPagesController::class, 'CreateHomesliderFirst'])->name('create.home.first.slider');
	Route::post('/create-first-slider', [AdminPagesController::class, 'CreateHomesliderFirstPost'])->name('create.home.first.slider.post');
	Route::post('/first-slide-status-change',[AdminPagesController::class,'FirstSlideStatuschange'])->name('first.slide.status.change');
	Route::post('/delete-first-slide', [AdminPagesController::class, 'DeleteFirstSlide'])->name('delete.first.slide.post');
	Route::get('/edit-first-slider/{id}', [AdminPagesController::class, 'EditHomesliderFirst'])->name('edit.home.first.slider');
    Route::post('/edit-first-slider/{id}', [AdminPagesController::class, 'UpdateHomesliderFirst'])->name('edit.home.first.slider.post');
	Route::get('/second-slider-list', [AdminPagesController::class, 'HomesliderSecondList'])->name('home.sec.slider.list');
	Route::get('/create-second-slider', [AdminPagesController::class, 'CreateHomeSecFirst'])->name('create.home.sec.slider');
    Route::post('/create-second-slider', [AdminPagesController::class, 'CreateHomesliderSecondPost'])->name('create.home.sec.slider.post');
    Route::post('/second-slide-status-change',[AdminPagesController::class,'SecondSlideStatuschange'])->name('second.slide.status.change');
	Route::post('/delete-second-slide', [AdminPagesController::class, 'DeleteSecondSlide'])->name('delete.sec.slide.post');
	Route::get('/edit-second-slider/{id}', [AdminPagesController::class, 'EditHomeslidersec'])->name('edit.home.sec.slider');
	Route::post('/edit-second-slider/{id}', [AdminPagesController::class, 'UpdateHomesliderSecond'])->name('edit.home.sec.slider.post');
	Route::get('/delete_home_video/{id}', [AdminPagesController::class, 'home_video_delete'])->name('delete-home-video');


	// card sub category management routes
	Route::get('/cardsubcategorylist/{subcatid}', [SubCategoryController::class, 'index'])->name('subcategorylist');
	Route::get('/create-sub-category/{subcatid}', [SubCategoryController::class, 'create'])->name('create.sub.category');
	Route::post('/create-sub-category/{subcatid}', [SubCategoryController::class, 'store'])->name('create.sub.category.post');
	Route::get('/getsubcategorylist/{subcatid}', [SubCategoryController::class, 'getSubCategorylist'])->name('get.subcategorylist');
	Route::get('/edit-card-subcategory/{id}', [SubCategoryController::class, 'edit'])->name('edit.sub.category');
    Route::post('/edit-card-subcategory/{id}', [SubCategoryController::class, 'update'])->name('edit.sub.category.post');
	Route::post('/delete-sub-category', [SubCategoryController::class, 'destroy'])->name('delete.sub.category.post');

	//Fourite Cards Routes
	Route::get('/favourite-card-list', [FavouriteCardsController::class, 'index'])->name('favorite-card-list');
	Route::get('/getfavouritecardlist', [FavouriteCardsController::class, 'getfavouritecardist'])->name('get.favouritecardlist');
	Route::post('/delete-favourite-card', [FavouriteCardsController::class, 'destroy'])->name('delete.fav.card.post');

	// Booking Management routes
	Route::get('/order-list', [OrderController::class, 'index'])->name('order-list');
	Route::get('/getOrderlist', [OrderController::class, 'getOrderList'])->name('get.orderlist');
	Route::get('/order-details/{id}', [OrderController::class, 'show'])->name('order-detail');
	Route::post('/orderstatuschange',[OrderController::class,'OrderstatusChange'])->name('order.status.change');
    Route::get('/getText', [OrderController::class, 'getText'])->name('getText');
	Route::get('/getAddress', [OrderController::class, 'getAddress'])->name('getAddress');

	//Voucher Code routes
	Route::get('/voucher-code-list', [VoucherCodeController::class, 'index'])->name('vouchercodelist');
	Route::get('/getvouchercodelist', [VoucherCodeController::class, 'GetVoucherCodeList'])->name('get.vouchercodelist');
	Route::get('/create-voucher-code', [VoucherCodeController::class, 'create'])->name('create.voucher.code');
    Route::post('/create-voucher-code', [VoucherCodeController::class, 'store'])->name('create.voucher.code.post');
	Route::get('/edit-voucher-code/{id}', [VoucherCodeController::class, 'edit'])->name('edit.voucher.code');
	Route::post('/edit-voucher-code/{id}', [VoucherCodeController::class, 'update'])->name('edit.voucher.code.post');
	Route::post('/delete-voucher-code', [VoucherCodeController::class, 'destroy'])->name('delete.voucher.code');
	Route::post('/voucher-code-status-change',[VoucherCodeController::class,'VoucherStatusChange'])->name('voucher.code.status.change');

	//payment history routes
	Route::get('/payment-list', [PaymentController::class, 'index'])->name('paymentlist');
	Route::get('/getpaymenttranslist', [PaymentController::class, 'GetPaymentTranslist'])->name('get.paymentranstlist');
    Route::get('/view-payment-detail/{id}', [PaymentController::class, 'show'])->name('view.payment.detail');
	Route::get('/view-payment-invoice/{id}', [PaymentController::class, 'Payment_Invoice'])->name('view.payment.invoice');

	// contact us routes
	Route::get('/contactuslist', [ContactusController::class, 'index'])->name('contactuslist');
	Route::post('/delete-contactus', [ContactusController::class, 'destroy'])->name('delete.contactus.post');
	Route::post('/contactus-status-change',[ContactusController::class,'Contactus_status_change'])->name('contactus.status.change');

	//Blog Management routes
	Route::get('/blog-list', [BlogController::class, 'index'])->name('bloglist');
	Route::get('/create-blog', [BlogController::class, 'create'])->name('create.blog');
    Route::post('/create-blog', [BlogController::class, 'store'])->name('create.blog.post');
	Route::get('/edit-blog/{id}', [BlogController::class, 'edit'])->name('edit.blog');
	Route::post('/edit-blog/{id}', [BlogController::class, 'update'])->name('edit.blog.post');
	Route::post('/delete-blog', [BlogController::class, 'destroy'])->name('delete.blog');
	Route::post('/blog-status-change',[BlogController::class,'Blog_status_change'])->name('blog.status.change');

	//Gift management routes
	Route::get('/giftlist', [GiftController::class, 'index'])->name('giftlist');
	Route::get('/create-gift', [GiftController::class, 'create'])->name('create.gift');
	Route::post('/create-gift', [GiftController::class, 'store'])->name('create.gift.post');
	Route::get('/getcardlist', [CardController::class, 'getCardlist'])->name('get.cardlist');
	Route::get('/editgift/{id}', [GiftController::class, 'edit'])->name('edit.gift');
	Route::post('/editgift/{id}', [GiftController::class, 'update'])->name('edit.gift.post');
	Route::post('/delete-gift', [GiftController::class, 'destroy'])->name('delete.gift.post');
	Route::get('/view-gift/{id}', [GiftController::class, 'show'])->name('view.gift');
	Route::post('/gift-status-change', [GiftController::class, 'Gift_Status_change'])->name('gift.status.change');
	Route::get('/delete_gift_images/{id}', [GiftController::class, 'gift_gallery_delete'])->name('delete-gift-images');

	//Editor Images routes
	Route::get('/editor-image-list', [EditorImagesController::class, 'index'])->name('editorimagelist');
	Route::get('/create-editor-image', [EditorImagesController::class, 'create'])->name('create.editor.image');
	Route::post('/create-editor-image', [EditorImagesController::class, 'store'])->name('create.editor.image.post');
	Route::get('/edit-editor-image/{id}', [EditorImagesController::class, 'edit'])->name('edit.editor.image');
	Route::post('edit-editor-image/{id}', [EditorImagesController::class, 'update'])->name('edit.editor.image.post');
	Route::post('/delete-editor-image', [EditorImagesController::class, 'destroy'])->name('delete.editor.image.post');
	Route::post('/editor-image-status-change', [EditorImagesController::class, 'editor_image_Status_change'])->name('editor.image.status.change');

	// Demo Video routes
	Route::get('/demo-video-list', [EditorImagesController::class, 'ShowVideolist'])->name('demovideolist');
	Route::get('/create-demo-video', [EditorImagesController::class, 'CreateDemovideo'])->name('create.demo.video');
	Route::post('/create-demo-video', [EditorImagesController::class, 'StoreDemoVideo'])->name('create.demo.video.post');
	Route::post('/demo-video-status-change', [EditorImagesController::class, 'demo_video_Status_change'])->name('demo.video.status.change');
	Route::post('/delete-demo-video', [EditorImagesController::class, 'DeleteVideo'])->name('delete.demo.video.post');
	Route::get('/edit-demo-video/{id}', [EditorImagesController::class, 'editDemoVideo'])->name('edit.demo.video');
	Route::post('edit-demo-video/{id}', [EditorImagesController::class, 'updateDemoVideo'])->name('edit.demo.video.post');

	//Video Images routes
	Route::get('/video-image-list', [EditorImagesController::class, 'VideoImageList'])->name('videoimagelist');
	Route::get('/create-video-image', [EditorImagesController::class, 'createVideoImage'])->name('create.video.image');
	Route::post('/create-video-image', [EditorImagesController::class, 'storeVideoImage'])->name('create.video.image.post');
	Route::get('/edit-video-image/{id}', [EditorImagesController::class, 'editVideoImage'])->name('edit.video.image');
	Route::post('edit-video-image/{id}', [EditorImagesController::class, 'updateVideoImage'])->name('edit.video.image.post');
	Route::post('/delete-video-image', [EditorImagesController::class, 'DeleteVideoImage'])->name('delete.video.image.post');
	Route::post('/video-image-status-change', [EditorImagesController::class, 'video_image_Status_change'])->name('video.image.status.change');

});
