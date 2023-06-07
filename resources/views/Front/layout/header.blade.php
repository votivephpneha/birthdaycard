<style type="text/css">
  .search-drpdwn-products a:hover {
    background: #ff0091 !important;
}
</style>
<header id="header" class="fixed-top">

  <div class="container d-flex-brith align-items-center justify-content-between mt-2 bord-top-b">
    <div class="logo-bar">
      <a href="{{ url('/') }}" class="logo"><img src="{{ url('public/assets/img/logo.png') }}" alt="" class="img-fluid"></a>
    </div>



    <div class="d-serch">
      <div id="custom-search-input">
        <div class="input-group col-md-12">
          <form method="post" action="{{ url('search_submit') }}">
            @csrf
            <input type="text" class="search" name="search_words" placeholder="search for product..." onkeyup="searchProduct()"/>
            <span class="input-group-btn">
              <button class="btn btn-danger" type="submit">
                <i class='bx bx-search'></i>
              </button>
            </span>
          </form>
		  <div class="search-drpdwn" style="display:none;">
			<div class="search-drpdwn-products">
				<!-- <a href="#"><span class="search-img-small"><img src="https://votiveinfo.in/Birthdaycards/public/upload/cards/1683869100.jpg" alt=""></span> <div class="search-content-wrapp">
					<div class="search-prd-title">
						<h4>Birthday Card For Mom</h4>
					</div>
					<div class="search-prd-price">
						<span>$20</span>
					</div>
				</div></a>
				<a href="#"><span class="search-img-small"><img src="https://votiveinfo.in/Birthdaycards/public/upload/cards/1683869100.jpg" alt=""></span> <div class="search-content-wrapp">
					<div class="search-prd-title">
						<h4>Birthday Card For Mom</h4>
					</div>
					<div class="search-prd-price">
						<span>$20</span>
					</div>
				</div></a>
				<a href="#"><span class="search-img-small"><img src="https://votiveinfo.in/Birthdaycards/public/upload/cards/1683869100.jpg" alt=""></span> <div class="search-content-wrapp">
					<div class="search-prd-title">
						<h4>Birthday Card For Mom</h4>
					</div>
					<div class="search-prd-price">
						<span>$20</span>
					</div>
				</div></a> -->
			</div>
		</div>
        </div>  
      </div>
      <nav id="navbar" class="navbar">

        <ul>
          <li class="dropdown dxc-none">
            <a href="#"><i class='bx bx-menu'></i></a>
            <ul class="">
              <li><a href="{{ url('birthday-cards') }}">BIRTHDAY CARDS</a></li>
              <li><a href="{{ url('gift_card') }}">Gifts</a></li>
              <li><a href="{{ url('blogs') }}">BLOG</a></li>
              <li><a href="{{ url('contact-us') }}">CONTACT US</a></li>
              
            </ul>
          </li>
          <div class="menu1">
            <li><a href="{{ url('birthday-cards') }}">BIRTHDAY CARDS</a></li>
            <li><a href="#">Gifts</a></li>
            <li><a href="{{ url('blogs') }}">BLOG</a></li>
            <li><a href="{{ url('contact-us') }}">CONTACT US</a></li>
          </div>

          <li class="">
             @if(!Auth::guard("customer")->user())
              <a class="nav-link" href="{{ url('/loginUser') }}"><i class='bx bx-user-circle'></i></a>
            @else
              <a class="nav-link" href="{{ url('user/userProfile') }}"><i class='bx bx-user-circle'></i></a>
            @endif
          </li>
          <li><a class="nav-link " href="{{ url('cart') }}"><i class='bx bx-cart'></i><span class="cart_count"></span></a></li>
          <li><a class="getstarted " href="{{ url('birthday-cards') }}"> Design Your Card</a></li>
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav><!-- .navbar -->
    </div>
  </div>
</header><!-- End Header -->
<div class="searchModal"></div>
