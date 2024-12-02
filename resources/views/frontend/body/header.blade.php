<!-- ============================================== HEADER ============================================== -->

<header class="header-style-1">

  <!-- ============================================== TOP MENU ============================================== -->
  <div class="top-bar animate-dropdown">
    <div class="container">
      <div class="header-top-inner">
        <div class="cnt-account">
          <ul class="list-unstyled">
            @auth
            <li><a href="{{route('wishlist')}}"><i class="icon fa fa-heart"></i>@if(session()->get('language') == 'romanian') Favorite @else Wishlist @endif</a></li>

            @else
            <li><a href="{{route('login')}}"><i class="icon fa fa-lock"></i>@if(session()->get('language') == 'romanian') Favorite @else Wishlist @endif</a></li>

            @endauth

            <li><a href="{{route('mycart')}}"><i class="icon fa fa-shopping-cart"></i>@if(session()->get('language') == 'romanian') Cos @else Cart @endif</a></li>
            <li><a href="{{route('compare.view')}}"><i class="icon fa fa-signal"></i>@if(session()->get('language') == 'romanian') Compara produse @else Compare products @endif</a></li>
            <li><a href="{{route('checkout')}}"><i class="icon fa fa-check"></i>Checkout</a></li>
            @auth
            <li> <a href="" type="button" data-toggle="modal" data-target="#ordertraking"><i class="icon fa fa-truck"></i>@if(session()->get('language') == 'romanian') Monitorizarea comenzilor @else Order tracking @endif</a></li>
            @endauth

            @auth
            <li> <a href="{{route('dashboard')}}"><i class="icon fa fa-user"></i>@if(session()->get('language') == 'romanian') Contul meu @else My account @endif</a></li>

            @endauth


            @auth
            <li><a href="{{route('user.logout')}}"><i class="icon fa fa-lock"></i>@if(session()->get('language') == 'romanian') Delogare @else Logout @endif</a></li>
            @else
            <li><a href="{{route('login')}}"><i class="icon fa fa-lock"></i>@if(session()->get('language') == 'romanian') Logare/Inregistrare @else Login/Register @endif</a></li>
            @endauth



          </ul>
        </div>
        <!-- /.cnt-account -->
        @php
        $currencies = App\Models\Currency::where('status',1)->get();
        @endphp
        <div class="cnt-block">
          <ul class="list-unstyled list-inline">
            <li class="dropdown dropdown-small"> <a href="#" class="dropdown-toggle" data-hover="dropdown" data-toggle="dropdown"><span class="value">@if(session()->get('language') == 'romanian') Moneda @else Currency @endif </span><b class="caret"></b></a>
              <ul class="dropdown-menu">
                @foreach($currencies as $currency)
                <li><a href="{{ route('change.currency', $currency->currency_code) }}">{{$currency->currency_code}}</a></li>
                @endforeach

              </ul>
            </li>
            <li class="dropdown dropdown-small"> <a href="#" class="dropdown-toggle " data-hover="dropdown" data-toggle="dropdown"><span class="value">
                  @if(session()->get('language') == 'romanian') Limba @else Language @endif
                </span><b class="caret"></b></a>
              <ul class="dropdown-menu">

                @if(session()->get('language') == 'romanian')
                <li><a href="{{ route('language.english') }}">English</a></li>
                @else
                <li><a href="{{ route('language.romanian') }}">Romana</a></li>
                @endif

              </ul>
            </li>
          </ul>
          <!-- /.list-unstyled -->
        </div>
        <!-- /.cnt-cart -->
        <div class="clearfix"></div>
      </div>
      <!-- /.header-top-inner -->
    </div>
    <!-- /.container -->
  </div>
  <!-- /.header-top -->
  <!-- ============================================== TOP MENU : END ============================================== -->
  <div class="main-header">
    <div class="container">
      <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-3 logo-holder">

          @php
          $setting = App\Models\SiteSetting::find(1);
          @endphp


          <!-- ============================================================= LOGO ============================================================= -->
          <div class="logo"> <a href="{{ url('/') }}"> <img src="{{ asset($setting->logo) }}" alt="logo"> </a> </div>
          <!-- /.logo -->
          <!-- ============================================================= LOGO : END ============================================================= -->
        </div>
        <!-- /.logo-holder -->

        <div class="col-xs-12 col-sm-12 col-md-7 top-search-holder">
          <!-- /.contact-row -->
          <!-- ============================================================= SEARCH AREA ============================================================= -->
          <div class="search-area">
            <form method="GET" action="{{ route('product.search') }}">

              <div class="control-group">

                <input class="search-field" onfocus="search_result_show()" onblur="search_result_hide()" id="search" name="search" placeholder="Search here..." />
                <button class="search-button" type="submit"></button>
              </div>
            </form>
            <form id="labnol" method="GET" action="{{ route('product.search.voice') }}">
              <div class="speech">
                <input class="search-field" type="text" name="q" id="transcript" placeholder="Speak..." />
                <button type="button" class="voice-button" onclick="startDictation()"></button>
                
              </div>

            </form>
            <div id="searchProducts"></div>
          </div>
          <!-- /.search-area -->
          <!-- ============================================================= SEARCH AREA : END ============================================================= -->
        </div>
        <!-- /.top-search-holder -->

        <div class="col-xs-12 col-sm-12 col-md-2 animate-dropdown top-cart-row">
          <!-- ===== === SHOPPING CART DROPDOWN ===== == -->

          <div class="dropdown dropdown-cart"> <a href="#" class="dropdown-toggle lnk-cart" data-toggle="dropdown">
              <div class="items-cart-inner">
                <div class="basket"> <i class="glyphicon glyphicon-shopping-cart"></i> </div>
                <div class="basket-item-count"><span class="count" id="cartQty"> </span></div>
                <div class="total-price-basket"> <span class="lbl">cart -</span>
                  <span class="total-price"> <span class="sign">$</span>
                    <span class="value" id="cartSubTotal"></span> </span>
                </div>
              </div>
            </a>
            <ul class="dropdown-menu">
              <li>
                <!--   // Mini Cart Start with Ajax -->

                <div id="miniCart">

                </div>

                <!--   // End Mini Cart Start with Ajax -->


                <div class="clearfix cart-total">
                  <div class="pull-right"> <span class="text">Grand total:</span>
                    <span class="price">$</span>
                    <span class='price' id="cartSubTotal"></span>
                  </div>
                  <div class="clearfix"></div>
                  <a href="{{route('checkout')}}" class="btn btn-upper btn-primary btn-block m-t-20">Checkout</a>
                </div>
                <!-- /.cart-total-->

              </li>
            </ul>
            <!-- /.dropdown-menu-->
          </div>
          <!-- /.dropdown-cart -->

          <!-- == === SHOPPING CART DROPDOWN : END=== === -->
        </div>
      </div>
      <!-- /.top-cart-row -->
    </div>
    <!-- /.row -->

  </div>
  <!-- /.container -->

  </div>
  <!-- /.main-header -->

  <!-- ============================================== NAVBAR ============================================== -->
  <div class="header-nav animate-dropdown">
    <div class="container">
      <div class="yamm navbar navbar-default" role="navigation">
        <div class="navbar-header">
          <button data-target="#mc-horizontal-menu-collapse" data-toggle="collapse" class="navbar-toggle collapsed" type="button">
            <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
        </div>
        <div class="nav-bg-class">
          <div class="navbar-collapse collapse" id="mc-horizontal-menu-collapse">
            <div class="nav-outer">
              <ul class="nav navbar-nav">
                <li class="active">
                  <a href="/">@if(session()->get('language') == 'romanian') Acasa @else Home @endif</a>
                </li>



                <!--   // Get Category Table Data -->
                @php
                $categories = App\Models\Category::orderBy('category_name_en','ASC')->where('category_status',1)->get();
                @endphp


                @foreach($categories as $category)
                <li class="dropdown yamm mega-menu"> <a href="" data-hover="dropdown" class="dropdown-toggle" data-toggle="dropdown">
                    @if(session()->get('language') == 'romanian') {{ $category->category_name_ro }} @else {{ $category->category_name_en }} @endif
                  </a>
                  <ul class="dropdown-menu container">
                    <li>
                      <div class="yamm-content ">
                        <div class="row">

                          <!--   // Get SubCategory Table Data -->
                          @php
                          $subcategories = App\Models\Subcategory::where('category_id',$category->id)->where('subcategory_status',1)->orderBy('subcategory_name_en','ASC')->get();
                          @endphp

                          @foreach($subcategories as $subcategory)
                          <div class="col-xs-12 col-sm-6 col-md-2 col-menu">

                            <a href="{{ url('products/subcategory/'.$subcategory->subcategory_slug_en ) }}">
                              <h2 class="title">
                                @if(session()->get('language') == 'romanian') {{ $subcategory->subcategory_name_ro }} @else {{ $subcategory->subcategory_name_en }} @endif
                              </h2>
                            </a>


                            <!--   // Get SubSubCategory Table Data -->
                            @php
                            $subsubcategories = App\Models\Subsubcategory::where('subcategory_id',$subcategory->id)->where('subsubcategory_status',1)->orderBy('subsubcategory_name_en','ASC')->get();
                            @endphp

                            @foreach($subsubcategories as $subsubcategory)
                            <ul class="links">
                              <li><a href="{{ url('products/subsubcategory/'.$subsubcategory->subsubcategory_slug_en ) }}">
                                  @if(session()->get('language') == 'romanian') {{ $subsubcategory->subsubcategory_name_ro }} @else {{ $subsubcategory->subsubcategory_name_en }} @endif
                                </a></li>

                            </ul>
                            @endforeach
                            <!-- // End SubSubCategory Foreach -->

                          </div>
                          <!-- /.col -->
                          @endforeach
                          <!-- // End SubCategory Foreach -->


                          <div class="col-xs-12 col-sm-6 col-md-4 col-menu banner-image"> <img class="img-responsive" src="{{ asset($category->category_image) }}" alt=""> </div>
                          <!-- /.yamm-content -->
                        </div>
                      </div>
                    </li>
                  </ul>
                </li>
                @endforeach
                <!-- // End Category Foreach -->

                <li class="dropdown  navbar-right special-menu"> <a href="{{ route('home.blog') }}">Blog</a> </li>


              </ul>
              <!-- /.navbar-nav -->
              <div class="clearfix"></div>
            </div>
            <!-- /.nav-outer -->
          </div>
          <!-- /.navbar-collapse -->

        </div>
        <!-- /.nav-bg-class -->
      </div>
      <!-- /.navbar-default -->
    </div>
    <!-- /.container-class -->

  </div>
  <!-- /.header-nav -->
  <!-- ============================================== NAVBAR : END ============================================== -->

  <!-- Order Traking Modal -->
  <div class="modal fade" id="ordertraking" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Track your order </h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">

          <form method="post" action="{{ route('order.tracking') }}">
            @csrf
            <div class="modal-body">
              <label>Invoice code</label>
              <input type="text" name="code" required="" class="form-control" placeholder="Your order invoice number">
            </div>

            <button class="btn btn-danger" type="submit" style="margin-left: 17px;"> Track now </button>

          </form>


        </div>

      </div>
    </div>
  </div>

</header>
<!-- ============================================== HEADER : END ============================================== -->




<style>
  .search-area {
    position: relative;
  }

  #searchProducts {
    position: absolute;
    top: 100%;
    left: 0;
    width: 100%;
    background: #ffffff;
    z-index: 999;
    border-radius: 8px;
    margin-top: 5px;
  }

 



  
</style>


<script>
  function search_result_hide() {
    $("#searchProducts").slideUp();
  }

  function search_result_show() {
    $("#searchProducts").slideDown();
  }

  function startDictation() {
    if (window.hasOwnProperty('webkitSpeechRecognition')) {
      var recognition = new webkitSpeechRecognition();
      recognition.continuous = false;
      recognition.interimResults = false;
      recognition.lang = "en-US";
      recognition.start();
      recognition.onresult = function(e) {
        document.getElementById('transcript').value
                                 = e.results[0][0].transcript;
        recognition.stop();
        document.getElementById('labnol').submit();
      };
      recognition.onerror = function(e) {
        recognition.stop();
      }
    }
  }
</script>