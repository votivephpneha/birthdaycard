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

<!----mobile search--->
<div class="searching">
               <center>
                    <a href="javascript:void(0)" class="search-open">
                    <i class="fa fa-search"></i>
                </a>

                   
               </center>
               
                <div class="search-inline">
                    <form>
                        <input type="text" class="form-control" placeholder="Searching...">
                       <div class="srch-cust">
                        <button type="submit">
                            <i class="fa fa-search"></i>
                        </button>
                        <a href="javascript:void(0)" class="search-close">
                            <i class="fa fa-times"></i>
                        </a>
                      </div>
                    </form>
                </div>
            </div>

<!---mobile search---->

<!---cart mobile---->
<div class="dropdown cart-mobile">
  <button class="btn dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
   <i class="fa fa-shopping-cart" aria-hidden="true"></i>
  </button>
  <!-- <ul class="dropdown-menu dropdown-cart" aria-labelledby="dropdownMenuButton1">
     <li>
                  <span class="item">
                    <span class="item-left">
                        <img src="https://birthdaystoreuk.co.uk/public/upload/cards/1686044595.jpg" alt="" />
                        <span class="item-info">
                            <span>Item name</span>
                            <span>23$</span>
                        </span>
                    </span>
                    <span class="item-right">
                        <button class="btn btn-xs pull-right">x</button>
                    </span>
                </span>
              </li>

               <li>
                  <span class="item">
                    <span class="item-left">
                        <img src="https://birthdaystoreuk.co.uk/public/upload/cards/1686044595.jpg" alt="" />
                        <span class="item-info">
                            <span>Item name</span>
                            <span>23$</span>
                        </span>
                    </span>
                    <span class="item-right">
                        <button class="btn btn-xs pull-right">x</button>
                    </span>
                </span>
              </li>
  </ul> -->
</div>

<!---cart mobile---->


<script>
                 var sp = document.querySelector('.search-open');
            var searchbar = document.querySelector('.search-inline');
            var shclose = document.querySelector('.search-close');
            function changeClass() {
                searchbar.classList.add('search-visible');
            }
            function closesearch() {
                searchbar.classList.remove('search-visible');
            }
            sp.addEventListener('click', changeClass);
            shclose.addEventListener('click', closesearch);
                
            </script>

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
            <li><a href="{{ url('gift_card') }}">Gifts</a></li>
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
          <li><a class="nav-link " href="{{ url('cart') }}"><i class='bx bx-cart'></i><span class="cart_count">0</span></a></li>
          <li><a class="getstarted " href="{{ url('birthday-cards') }}"> Design Your Card</a></li>
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav><!-- .navbar -->
    </div>
  </div>
</header><!-- End Header -->
<div class="searchModal"></div>
