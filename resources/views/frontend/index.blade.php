@extends('frontend.main_master')

@section('content')

@section('title')
Herbal Remedies Homepage
@endsection



<div class="body-content outer-top-xs" id="top-banner-and-menu">
  <div class="container">
    <div class="row">
      <!-- ============================================== SIDEBAR ============================================== -->
      <div class="col-xs-12 col-sm-12 col-md-3 sidebar">

        <!-- === == TOP NAVIGATION == ==== -->
        @include('frontend.common.vertical_menu')
        <!-- ===== ==== TOP NAVIGATION : END ==== ===== -->

        <!-- ============================================== HOT DEALS ============================================== -->
        @include('frontend.common.hot_deals')
        <!-- ============================================== HOT DEALS: END ============================================== -->


        <!-- ===== ===== PRODUCT TAGS ==== ====== -->
        @include('frontend.common.product_tags')
        <!-- ==== ===== PRODUCT TAGS : END ======= ==== -->

        <!-- ============================================== NEWSLETTER ============================================== -->
        <div class="sidebar-widget newsletter wow fadeInUp outer-bottom-small">
          <h3 class="section-title">Newsletter</h3>
          <div class="sidebar-widget-body outer-top-xs">
            <p>Sign up for our newsletter!</p>
            <form method="post" action="{{route('add.subscriber')}}">
              @csrf
              <div class="form-group">
                <label class="sr-only" for="exampleInputEmail1">Email address</label>
                <input type="email" class="form-control" id="subscriber_email" name="subscriber_email" required pattern="[^@]+@[^@]+\.[a-zA-Z]{2,6}">
              </div>
              <button class="btn btn-primary">Subscribe</button>
            </form>
          </div>
          <!-- /.sidebar-widget-body -->
        </div>
        <!-- /.sidebar-widget -->
        <!-- ============================================== NEWSLETTER: END ============================================== -->

        <!----------- Testimonials------------->

        
        <!-- == ========== Testimonials: END ======== ========= -->


      </div>
      <!-- /.sidemenu-holder -->
      <!-- ============================================== SIDEBAR : END ============================================== -->

      <!-- ============================================== CONTENT ============================================== -->
      <div class="col-xs-12 col-sm-12 col-md-9 homebanner-holder">
        <!-- === ========= SECTION – HERO ==== ======= -->

        <div id="hero">
          <div id="owl-main" class="owl-carousel owl-inner-nav owl-ui-sm">

            @foreach($sliders as $slider)
                        
            <a @if($slider->link!=NULL) href="{{ url($slider->link) }}" @else href="javascript:void(0)" @endif>
            <div class="item" style="background-image: url({{ asset($slider->slider_image) }});">
              <div class="container-fluid">
             
                <div class="caption bg-color vertical-center text-left">

                  <div class="big-text fadeInDown-1">{{ $slider->title }} </div>
                  <div class="excerpt fadeInDown-2 hidden-xs"> <span>{{ $slider->description }}</span> </div>
                  <!-- <div class="button-holder fadeInDown-3"> <a href="index.php?page=single-product" class="btn-lg btn btn-uppercase btn-primary shop-now-button">Shop Now</a> </div> -->
                </div>
                <!-- /.caption -->
               
              </div>
              <!-- /.container-fluid -->
              </div>
              </a>
           
            @endforeach


          </div>
          <!-- /.owl-carousel -->
        </div>


        <!-- ========================================= SECTION – HERO : END ========================================= -->

        <!-- ============================================== INFO BOXES ============================================== -->
        <div class="info-boxes wow fadeInUp">
          <div class="info-boxes-inner">
            <div class="row">
              <div class="col-md-6 col-sm-4 col-lg-4">
                <div class="info-box">
                  <div class="row">
                    <div class="col-xs-12">
                      <h4 class="info-box-heading green">money back</h4>
                    </div>
                  </div>
                  <h6 class="text">30 Days Money Back Guaranteed</h6>
                </div>
              </div>
              <!-- .col -->

              <div class="hidden-md col-sm-4 col-lg-4">
                <div class="info-box">
                  <div class="row">
                    <div class="col-xs-12">
                      <h4 class="info-box-heading green">free shipping</h4>
                    </div>
                  </div>
                  <h6 class="text">Free Shipping for all orders</h6>
                </div>
              </div>
              <!-- .col -->

              <div class="col-md-6 col-sm-4 col-lg-4">
                <div class="info-box">
                  <div class="row">
                    <div class="col-xs-12">
                      <h4 class="info-box-heading green">Fast delivery</h4>
                    </div>
                  </div>
                  <h6 class="text"> Delivery in 48 hours </h6>
                </div>
              </div>
              <!-- .col -->
            </div>
            <!-- /.row -->
          </div>
          <!-- /.info-boxes-inner -->

        </div>
        <!-- /.info-boxes -->
        <!-- ============================================== INFO BOXES : END ============================================== -->
        <!-- = ===== SCROLL TABS =============== ========== -->

        <div id="product-tabs-slider" class="scroll-tabs outer-top-vs wow fadeInUp">
          <div class="more-info-tab clearfix ">
            <h3 class="new-product-title pull-left">@if(session()->get('language') == 'romanian') Cele mai noi produse @else New arrivals @endif</a></li>
            </h3>
            <ul class="nav nav-tabs nav-tab-line pull-right" id="new-products-1">
              <li class="active"><a data-transition-type="backSlide" href="#all" data-toggle="tab">
                  @if(session()->get('language') == 'romanian') Toate @else All @endif</a></li>

              @foreach($categories as $category)
              <li><a data-transition-type="backSlide" href="#category{{ $category->id }}" data-toggle="tab"> @if(session()->get('language') == 'romanian') {{ $category->category_name_ro }} @else {{ $category->category_name_en }} @endif</a></li>
              @endforeach
              <!-- <li><a data-transition-type="backSlide" href="#laptop" data-toggle="tab">Electronics</a></li>
              <li><a data-transition-type="backSlide" href="#apple" data-toggle="tab">Shoes</a></li> -->
            </ul>
            <!-- /.nav-tabs -->
          </div>
          <div class="tab-content outer-top-xs">



            <div class="tab-pane in active" id="all">
              <div class="product-slider">
                <div class="owl-carousel home-owl-carousel custom-carousel owl-theme" data-item="4">

                  @foreach($products as $product)
                  <div class="item item-carousel">
                    <div class="products">
                      <div class="product">
                        <div class="product-image">
                          <div class="image"> <a href="{{ url('product/details/'.$product->id ) }}"><img src="{{ asset($product->product_thumbnail) }}" alt=""></a> </div>
                          <!-- /.image -->

                          @php
                          $amount = $product->selling_price - $product->discount_price;
                          $discount = ($amount/$product->selling_price) * 100;
                          $average = App\Models\Review::where('product_id',$product->id)->where('status',1)->avg('rating');
                          @endphp

                          <div>
                            @if ($product->new_arrival == 1)
                            <div class="tag new"><span>new</span></div>
                            @elseif($product->discount_price != NULL)
                            <div class="tag hot">-<span>{{ round($discount) }}%</span></div>
                            @endif
                          </div>


                         
                        </div>

                        <!-- /.product-image -->

                        <div class="product-info ">
                          <h3 class="name"><a href="{{ url('product/details/'.$product->id) }}">
                              @if(session()->get('language') == 'romanian') {{ $product->product_name_ro }} @else {{ $product->product_name_en }} @endif
                            </a></h3>
                          <div class="rating-reviews m-t-10">



                            @if($average == 0)
                            @if(session()->get('language') == 'romanian') Niciun rating @else  No rating yet @endif
                            @elseif($average == 1) <span class="fa fa-star"></span>
                            <span class="fa fa-star-o"></span>
                            <span class="fa fa-star-o"></span>
                            <span class="fa fa-star-o"></span>
                            <span class="fa fa-star-o"></span>
                            @elseif($average < 2) <span class="fa fa-star"></span>
                              <span class="fa fa-star-half-o"></span>
                              <span class="fa fa-star-o"></span>
                              <span class="fa fa-star-o"></span>
                              <span class="fa fa-star-o"></span>
                              @elseif($average == 2 ) <span class="fa fa-star "></span>
                              <span class="fa fa-star "></span>
                              <span class="fa fa-star-o"></span>
                              <span class="fa fa-star-o"></span>
                              <span class="fa fa-star-o"></span>
                              @elseif($average < 3) <span class="fa fa-star "></span>
                                <span class="fa fa-star "></span>
                                <span class="fa fa-star-half-o"></span>
                                <span class="fa fa-star-o"></span>
                                <span class="fa fa-star-o"></span>
                                @elseif($average == 3) <span class="fa fa-star "></span>
                                <span class="fa fa-star "></span>
                                <span class="fa fa-star "></span>
                                <span class="fa fa-star-o"></span>
                                <span class="fa fa-star-o"></span>
                                @elseif($average < 4) <span class="fa fa-star "></span>
                                  <span class="fa fa-star "></span>
                                  <span class="fa fa-star "></span>
                                  <span class="fa fa-star-half-o"></span>
                                  <span class="fa fa-star-o"></span>
                                  @elseif($average == 4 ) <span class="fa fa-star "></span>
                                  <span class="fa fa-star "></span>
                                  <span class="fa fa-star "></span>
                                  <span class="fa fa-star "></span>
                                  <span class="fa fa-star-o"></span>
                                  @elseif( $average < 5) <span class="fa fa-star "></span>
                                    <span class="fa fa-star "></span>
                                    <span class="fa fa-star "></span>
                                    <span class="fa fa-star "></span>
                                    <span class="fa fa-star-half-o "></span>
                                    @elseif( $average == 5) <span class="fa fa-star "></span>
                                    <span class="fa fa-star "></span>
                                    <span class="fa fa-star "></span>
                                    <span class="fa fa-star "></span>
                                    <span class="fa fa-star"></span>
                                    @endif


                          </div><!-- /.rating-reviews -->

                          <div class="description"></div>

                          @if ($product->discount_price == NULL)
                          <div class="product-price"> <span class="price"> ${{ $product->selling_price }} </span> </div>
                          @else
                          <div class="product-price"> <span class="price-before-discount">${{$product->selling_price }}</span><span class="price"> ${{ $product->discount_price }} </span> </div>
                          <div class="text-danger"><span>(-{{ round($discount) }}%)</span></div>
                          @endif


                          <!-- /.product-price -->

                        </div>
                        <!-- /.product-info -->
                        <div class="cart clearfix animate-effect">
                          <div class="action">
                            <ul class="list-unstyled">
                              <li class="add-cart-button btn-group">


                                <button class="btn btn-primary icon" type="button" title="Quick view" data-toggle="modal" data-target="#exampleModal" id="{{ $product->id }}" onclick="productView(this.id)"> <i class="fa fa-eye"></i> </button>


                              </li>



                              <button class="btn btn-primary icon" type="button" title="Wishlist" id="{{ $product->id }}" onclick="addToWishList(this.id)"> <i class="fa fa-heart"></i> </button>

                            </ul>
                          </div>
                          <!-- /.action -->
                        </div>
                        <!-- /.cart -->
                      </div>
                      <!-- /.product -->

                    </div>
                    <!-- /.products -->
                  </div>
                  <!-- /.item -->
                  @endforeach
                  <!--  // end all optionproduct foreach  -->




                </div>
                <!-- /.home-owl-carousel -->
              </div>
              <!-- /.product-slider -->
            </div>
            <!-- /.tab-pane -->




            @foreach($categories as $category)
            <div class="tab-pane" id="category{{ $category->id }}">
              <div class="product-slider">
                <div class="owl-carousel home-owl-carousel custom-carousel owl-theme" data-item="4">

                  @php
                  $catwiseProduct = App\Models\Product::where('category_id',$category->id)->orderBy('id','DESC')->get();
                  @endphp


                  @forelse($catwiseProduct as $product)
                  <div class="item item-carousel">
                    <div class="products">
                      <div class="product">
                        <div class="product-image">
                          <div class="image"> <a href="{{ url('product/details/'.$product->id ) }}"><img src="{{ asset($product->product_thumbnail) }}" alt=""></a> </div>
                          <!-- /.image -->

                          @php
                          $amount = $product->selling_price - $product->discount_price;
                          $discount = ($amount/$product->selling_price) * 100;
                          $average = App\Models\Review::where('product_id',$product->id)->where('status',1)->avg('rating');
                          @endphp

                          <div>
                            @if ($product->new_arrival == 1)
                            <div class="tag new"><span>new</span></div>
                            @endif
                          </div>
                        </div>

                        <!-- /.product-image -->

                        <div class="product-info text-left">
                          <h3 class="name"><a href="{{ url('product/details/'.$product->id) }}">
                              @if(session()->get('language') == 'romanian') {{ $product->product_name_ro }} @else {{ $product->product_name_en }} @endif
                            </a></h3>
                          <div class="rating-reviews m-t-10">



                            @if($average == 0)
                            @if(session()->get('language') == 'romanian') Niciun rating @else  No rating yet @endif
                            @elseif($average == 1) <span class="fa fa-star"></span>
                            <span class="fa fa-star-o"></span>
                            <span class="fa fa-star-o"></span>
                            <span class="fa fa-star-o"></span>
                            <span class="fa fa-star-o"></span>
                            @elseif($average < 2) <span class="fa fa-star"></span>
                              <span class="fa fa-star-half-o"></span>
                              <span class="fa fa-star-o"></span>
                              <span class="fa fa-star-o"></span>
                              <span class="fa fa-star-o"></span>
                              @elseif($average == 2 ) <span class="fa fa-star "></span>
                              <span class="fa fa-star "></span>
                              <span class="fa fa-star-o"></span>
                              <span class="fa fa-star-o"></span>
                              <span class="fa fa-star-o"></span>
                              @elseif($average < 3) <span class="fa fa-star "></span>
                                <span class="fa fa-star "></span>
                                <span class="fa fa-star-half-o"></span>
                                <span class="fa fa-star-o"></span>
                                <span class="fa fa-star-o"></span>
                                @elseif($average == 3) <span class="fa fa-star "></span>
                                <span class="fa fa-star "></span>
                                <span class="fa fa-star "></span>
                                <span class="fa fa-star-o"></span>
                                <span class="fa fa-star-o"></span>
                                @elseif($average < 4) <span class="fa fa-star "></span>
                                  <span class="fa fa-star "></span>
                                  <span class="fa fa-star "></span>
                                  <span class="fa fa-star-half-o"></span>
                                  <span class="fa fa-star-o"></span>
                                  @elseif($average == 4 ) <span class="fa fa-star "></span>
                                  <span class="fa fa-star "></span>
                                  <span class="fa fa-star "></span>
                                  <span class="fa fa-star "></span>
                                  <span class="fa fa-star-o"></span>
                                  @elseif( $average < 5) <span class="fa fa-star "></span>
                                    <span class="fa fa-star "></span>
                                    <span class="fa fa-star "></span>
                                    <span class="fa fa-star "></span>
                                    <span class="fa fa-star-half-o "></span>
                                    @elseif( $average == 5) <span class="fa fa-star "></span>
                                    <span class="fa fa-star "></span>
                                    <span class="fa fa-star "></span>
                                    <span class="fa fa-star "></span>
                                    <span class="fa fa-star"></span>
                                    @endif


                          </div><!-- /.rating-reviews -->
                          <div class="description"></div>

                          @if ($product->discount_price == NULL)
                          <div class="product-price"> <span class="price"> ${{ $product->selling_price }} </span> </div>
                          @else
                          <div class="product-price"> <span class="price-before-discount">${{$product->selling_price }}</span><span class="price"> ${{ $product->discount_price }} </span> </div>
                          <div class="text-danger"><span>(-{{ round($discount) }}%)</span></div>
                          @endif


                          <!-- /.product-price -->

                        </div>
                        <!-- /.product-info -->
                        <div class="cart clearfix animate-effect">
                          <div class="action">
                            <ul class="list-unstyled">
                              <li class="add-cart-button btn-group">

                                <button class="btn btn-primary icon" type="button" title="Quick view" data-toggle="modal" data-target="#exampleModal" id="{{ $product->id }}" onclick="productView(this.id)"> <i class="fa fa-eye"></i> </button>


                              </li>



                              <button class="btn btn-primary icon" type="button" title="Wishlist" id="{{ $product->id }}" onclick="addToWishList(this.id)"> <i class="fa fa-heart"></i> </button>


                            </ul>
                          </div>
                          <!-- /.action -->
                        </div>
                        <!-- /.cart -->
                      </div>
                      <!-- /.product -->

                    </div>
                    <!-- /.products -->
                  </div>
                  <!-- /.item -->

                  @empty
                  <h5 class="text-danger">No products found</h5>

                  @endforelse
                  <!--  // end all optionproduct foreach  -->




                </div>
                <!-- /.home-owl-carousel -->
              </div>
              <!-- /.product-slider -->
            </div>
            <!-- /.tab-pane -->
            @endforeach
            <!-- end categor foreach -->





          </div>
          <!-- /.tab-content -->
        </div>
        <!-- /.scroll-tabs -->
        <!-- ============================================== SCROLL TABS : END ============================================== -->
        

        <!-- ============================================== WIDE PRODUCTS : END ============================================== -->
        <!-- == === FEATURED PRODUCTS == ==== -->

        <section class="section featured-product wow fadeInUp">
          <h3 class="section-title">@if(session()->get('language') == 'romanian') Produse recomandate @else Recommended products @endif</h3>
          <div class="owl-carousel home-owl-carousel custom-carousel owl-theme outer-top-xs">


            @foreach($featured as $product)
            <div class="item item-carousel">
              <div class="products">
                <div class="product">
                  <div class="product-image">
                    <div class="image">

                      <a href="{{ url('product/details/'.$product->id ) }}"><img src="{{ asset($product->product_thumbnail) }}" alt=""></a>
                    </div>
                    <!-- /.image -->

                    @php
                    $amount = $product->selling_price - $product->discount_price;
                    $discount = ($amount/$product->selling_price) * 100;
                    $average = App\Models\Review::where('product_id',$product->id)->where('status',1)->avg('rating');
                    @endphp

                    <div>
                    
                      <div class="tag hot"><span>hot</span></div>
                     
                    </div>
                  </div>

                  <!-- /.product-image -->

                  <div class="product-info text-left">
                    <h3 class="name"><a href="{{ url('product/details/'.$product->id ) }}">
                        @if(session()->get('language') == 'romanian') {{ $product->product_name_ro }} @else {{ $product->product_name_en }} @endif
                      </a></h3>
                    <div class="rating-reviews m-t-10">



                      @if($average == 0)
                      @if(session()->get('language') == 'romanian') Niciun rating @else  No rating yet @endif
                      @elseif($average == 1) <span class="fa fa-star"></span>
                      <span class="fa fa-star-o"></span>
                      <span class="fa fa-star-o"></span>
                      <span class="fa fa-star-o"></span>
                      <span class="fa fa-star-o"></span>
                      @elseif($average < 2) <span class="fa fa-star"></span>
                        <span class="fa fa-star-half-o"></span>
                        <span class="fa fa-star-o"></span>
                        <span class="fa fa-star-o"></span>
                        <span class="fa fa-star-o"></span>
                        @elseif($average == 2 ) <span class="fa fa-star "></span>
                        <span class="fa fa-star "></span>
                        <span class="fa fa-star-o"></span>
                        <span class="fa fa-star-o"></span>
                        <span class="fa fa-star-o"></span>
                        @elseif($average < 3) <span class="fa fa-star "></span>
                          <span class="fa fa-star "></span>
                          <span class="fa fa-star-half-o"></span>
                          <span class="fa fa-star-o"></span>
                          <span class="fa fa-star-o"></span>
                          @elseif($average == 3) <span class="fa fa-star "></span>
                          <span class="fa fa-star "></span>
                          <span class="fa fa-star "></span>
                          <span class="fa fa-star-o"></span>
                          <span class="fa fa-star-o"></span>
                          @elseif($average < 4) <span class="fa fa-star "></span>
                            <span class="fa fa-star "></span>
                            <span class="fa fa-star "></span>
                            <span class="fa fa-star-half-o"></span>
                            <span class="fa fa-star-o"></span>
                            @elseif($average == 4 ) <span class="fa fa-star "></span>
                            <span class="fa fa-star "></span>
                            <span class="fa fa-star "></span>
                            <span class="fa fa-star "></span>
                            <span class="fa fa-star-o"></span>
                            @elseif( $average < 5) <span class="fa fa-star "></span>
                              <span class="fa fa-star "></span>
                              <span class="fa fa-star "></span>
                              <span class="fa fa-star "></span>
                              <span class="fa fa-star-half-o "></span>
                              @elseif( $average == 5) <span class="fa fa-star "></span>
                              <span class="fa fa-star "></span>
                              <span class="fa fa-star "></span>
                              <span class="fa fa-star "></span>
                              <span class="fa fa-star"></span>
                              @endif


                    </div><!-- /.rating-reviews -->
                    <div class="description"></div>

                    @if ($product->discount_price == NULL)
                    <div class="product-price"> <span class="price"> ${{ $product->selling_price }} </span> </div>
                    @else
                    <div class="product-price"> <span class="price-before-discount">${{$product->selling_price }}</span><span class="price"> ${{ $product->discount_price }} </span> </div>
                    <div class="text-danger"><span>(-{{ round($discount) }}%)</span></div>
                    @endif


                    <!-- /.product-price -->

                  </div>
                  <!-- /.product-info -->
                  <div class="cart clearfix animate-effect">
                    <div class="action">
                      <ul class="list-unstyled">
                        <li class="add-cart-button btn-group">

                          <button class="btn btn-primary icon" type="button" title="Quick view" data-toggle="modal" data-target="#exampleModal" id="{{ $product->id }}" onclick="productView(this.id)"> <i class="fa fa-eye"></i> </button>


                        </li>



                        <button class="btn btn-primary icon" type="button" title="Wishlist" id="{{ $product->id }}" onclick="addToWishList(this.id)"> <i class="fa fa-heart"></i> </button>



                      </ul>
                    </div>
                    <!-- /.action -->
                  </div>
                  <!-- /.cart -->
                </div>
                <!-- /.product -->

              </div>
              <!-- /.products -->
            </div>
            <!-- /.item -->
            @endforeach


          </div>
          <!-- /.home-owl-carousel -->
        </section>
        <!-- /.section -->
        <!-- == ==== FEATURED PRODUCTS : END ==== === -->
        <!-- == === skip_product_0 PRODUCTS == ==== -->

        <section class="section featured-product wow fadeInUp">
          <h3 class="section-title">
            @if(session()->get('language') == 'romanian') {{ $skip_category_0->category_name_ro }} @else {{ $skip_category_0->category_name_en }} @endif
          </h3>
          <div class="owl-carousel home-owl-carousel custom-carousel owl-theme outer-top-xs">


            @foreach($skip_product_0 as $product)
            <div class="item item-carousel">
              <div class="products">
                <div class="product">
                  <div class="product-image">
                    <div class="image"> <a href="{{ url('product/details/'.$product->id ) }}"><img src="{{ asset($product->product_thumbnail) }}" alt=""></a> </div>
                    <!-- /.image -->

                    @php
                    $amount = $product->selling_price - $product->discount_price;
                    $discount = ($amount/$product->selling_price) * 100;
                    $average = App\Models\Review::where('product_id',$product->id)->where('status',1)->avg('rating');
                    @endphp

                    <div>
                      @if ($product->discount_price == NULL)

                      @else
                      <div class="tag hot">-<span>{{ round($discount) }}%</span></div>
                      @endif
                    </div>
                  </div>

                  <!-- /.product-image -->

                  <div class="product-info text-left">
                    <h3 class="name"><a href="{{ url('product/details/'.$product->id ) }}">
                        @if(session()->get('language') == 'romanian') {{ $product->product_name_ro }} @else {{ $product->product_name_en }} @endif
                      </a></h3>
                    <div class="rating-reviews m-t-10">



                      @if($average == 0)
                      @if(session()->get('language') == 'romanian') Niciun rating @else  No rating yet @endif
                      @elseif($average == 1) <span class="fa fa-star"></span>
                      <span class="fa fa-star-o"></span>
                      <span class="fa fa-star-o"></span>
                      <span class="fa fa-star-o"></span>
                      <span class="fa fa-star-o"></span>
                      @elseif($average < 2) <span class="fa fa-star"></span>
                        <span class="fa fa-star-half-o"></span>
                        <span class="fa fa-star-o"></span>
                        <span class="fa fa-star-o"></span>
                        <span class="fa fa-star-o"></span>
                        @elseif($average == 2 ) <span class="fa fa-star "></span>
                        <span class="fa fa-star "></span>
                        <span class="fa fa-star-o"></span>
                        <span class="fa fa-star-o"></span>
                        <span class="fa fa-star-o"></span>
                        @elseif($average < 3) <span class="fa fa-star "></span>
                          <span class="fa fa-star "></span>
                          <span class="fa fa-star-half-o"></span>
                          <span class="fa fa-star-o"></span>
                          <span class="fa fa-star-o"></span>
                          @elseif($average == 3) <span class="fa fa-star "></span>
                          <span class="fa fa-star "></span>
                          <span class="fa fa-star "></span>
                          <span class="fa fa-star-o"></span>
                          <span class="fa fa-star-o"></span>
                          @elseif($average < 4) <span class="fa fa-star "></span>
                            <span class="fa fa-star "></span>
                            <span class="fa fa-star "></span>
                            <span class="fa fa-star-half-o"></span>
                            <span class="fa fa-star-o"></span>
                            @elseif($average == 4 ) <span class="fa fa-star "></span>
                            <span class="fa fa-star "></span>
                            <span class="fa fa-star "></span>
                            <span class="fa fa-star "></span>
                            <span class="fa fa-star-o"></span>
                            @elseif( $average < 5) <span class="fa fa-star "></span>
                              <span class="fa fa-star "></span>
                              <span class="fa fa-star "></span>
                              <span class="fa fa-star "></span>
                              <span class="fa fa-star-half-o "></span>
                              @elseif( $average == 5) <span class="fa fa-star "></span>
                              <span class="fa fa-star "></span>
                              <span class="fa fa-star "></span>
                              <span class="fa fa-star "></span>
                              <span class="fa fa-star"></span>
                              @endif


                    </div><!-- /.rating-reviews -->
                    <div class="description"></div>

                    @if ($product->discount_price == NULL)
                    <div class="product-price"> <span class="price"> ${{ $product->selling_price }} </span> </div>
                    @else
                    <div class="product-price"><span class="price-before-discount">$ {{ $product->selling_price }}</span> <span class="price"> ${{ $product->discount_price }} </span> </div>
                    @endif


                    <!-- /.product-price -->

                  </div>
                  <!-- /.product-info -->
                  <div class="cart clearfix animate-effect">
                    <div class="action">
                      <ul class="list-unstyled">
                        <li class="add-cart-button btn-group">


                          <button class="btn btn-primary icon" type="button" title="Quick view" data-toggle="modal" data-target="#exampleModal" id="{{ $product->id }}" onclick="productView(this.id)"> <i class="fa fa-eye"></i> </button>


                        </li>



                        <button class="btn btn-primary icon" type="button" title="Wishlist" id="{{ $product->id }}" onclick="addToWishList(this.id)"> <i class="fa fa-heart"></i> </button>


                      </ul>
                    </div>
                    <!-- /.action -->
                  </div>
                  <!-- /.cart -->
                </div>
                <!-- /.product -->

              </div>
              <!-- /.products -->
            </div>
            <!-- /.item -->
            @endforeach


          </div>
          <!-- /.home-owl-carousel -->
        </section>
        <!-- /.section -->
        <!-- == ==== skip_product_0 PRODUCTS : END ==== === -->








        <!-- == === skip_product_1 PRODUCTS == ==== -->

        <section class="section featured-product wow fadeInUp">
          <h3 class="section-title">
            @if(session()->get('language') == 'romanian') {{ $skip_category_1->category_name_ro }} @else {{ $skip_category_1->category_name_en }} @endif
          </h3>
          <div class="owl-carousel home-owl-carousel custom-carousel owl-theme outer-top-xs">


            @foreach($skip_product_1 as $product)
            <div class="item item-carousel">
              <div class="products">
                <div class="product">
                  <div class="product-image">
                    <div class="image"> <a href="{{ url('product/details/'.$product->id ) }}"><img src="{{ asset($product->product_thumbnail) }}" alt=""></a> </div>
                    <!-- /.image -->

                    @php
                    $amount = $product->selling_price - $product->discount_price;
                    $discount = ($amount/$product->selling_price) * 100;
                    $average = App\Models\Review::where('product_id',$product->id)->where('status',1)->avg('rating');
                    @endphp

                    <div>
                      @if ($product->discount_price == NULL)

                      @else
                      <div class="tag hot">-<span>{{ round($discount) }}%</span></div>
                      @endif
                    </div>
                  </div>

                  <!-- /.product-image -->

                  <div class="product-info text-left">
                    <h3 class="name"><a href="{{ url('product/details/'.$product->id ) }}">
                        @if(session()->get('language') == 'romanian') {{ $product->product_name_ro }} @else {{ $product->product_name_en }} @endif
                      </a></h3>
                    <div class="rating-reviews m-t-10">



                      @if($average == 0)
                       @if(session()->get('language') == 'romanian') Niciun rating @else  No rating yet @endif
                      @elseif($average == 1) <span class="fa fa-star"></span>
                      <span class="fa fa-star-o"></span>
                      <span class="fa fa-star-o"></span>
                      <span class="fa fa-star-o"></span>
                      <span class="fa fa-star-o"></span>
                      @elseif($average < 2) <span class="fa fa-star"></span>
                        <span class="fa fa-star-half-o"></span>
                        <span class="fa fa-star-o"></span>
                        <span class="fa fa-star-o"></span>
                        <span class="fa fa-star-o"></span>
                        @elseif($average == 2 ) <span class="fa fa-star "></span>
                        <span class="fa fa-star "></span>
                        <span class="fa fa-star-o"></span>
                        <span class="fa fa-star-o"></span>
                        <span class="fa fa-star-o"></span>
                        @elseif($average < 3) <span class="fa fa-star "></span>
                          <span class="fa fa-star "></span>
                          <span class="fa fa-star-half-o"></span>
                          <span class="fa fa-star-o"></span>
                          <span class="fa fa-star-o"></span>
                          @elseif($average == 3) <span class="fa fa-star "></span>
                          <span class="fa fa-star "></span>
                          <span class="fa fa-star "></span>
                          <span class="fa fa-star-o"></span>
                          <span class="fa fa-star-o"></span>
                          @elseif($average < 4) <span class="fa fa-star "></span>
                            <span class="fa fa-star "></span>
                            <span class="fa fa-star "></span>
                            <span class="fa fa-star-half-o"></span>
                            <span class="fa fa-star-o"></span>
                            @elseif($average == 4 ) <span class="fa fa-star "></span>
                            <span class="fa fa-star "></span>
                            <span class="fa fa-star "></span>
                            <span class="fa fa-star "></span>
                            <span class="fa fa-star-o"></span>
                            @elseif( $average < 5) <span class="fa fa-star "></span>
                              <span class="fa fa-star "></span>
                              <span class="fa fa-star "></span>
                              <span class="fa fa-star "></span>
                              <span class="fa fa-star-half-o "></span>
                              @elseif( $average == 5) <span class="fa fa-star "></span>
                              <span class="fa fa-star "></span>
                              <span class="fa fa-star "></span>
                              <span class="fa fa-star "></span>
                              <span class="fa fa-star"></span>
                              @endif


                    </div><!-- /.rating-reviews -->
                    <div class="description"></div>

                    @if ($product->discount_price == NULL)
                    <div class="product-price"> <span class="price"> ${{ $product->selling_price }} </span> </div>
                    @else
                    <div class="product-price"> </span> <span class="price-before-discount">$ {{ $product->selling_price }}</span><span class="price"> ${{ $product->discount_price }} </div>
                    @endif


                    <!-- /.product-price -->

                  </div>
                  <!-- /.product-info -->
                  <div class="cart clearfix animate-effect">
                    <div class="action">
                      <ul class="list-unstyled">
                        <li class="add-cart-button btn-group">


                          <button class="btn btn-primary icon" type="button" title="Quick view" data-toggle="modal" data-target="#exampleModal" id="{{ $product->id }}" onclick="productView(this.id)"> <i class="fa fa-eye"></i> </button>


                        </li>



                        <button class="btn btn-primary icon" type="button" title="Wishlist" id="{{ $product->id }}" onclick="addToWishList(this.id)"> <i class="fa fa-heart"></i> </button>


                      </ul>
                    </div>
                    <!-- /.action -->
                  </div>
                  <!-- /.cart -->
                </div>
                <!-- /.product -->

              </div>
              <!-- /.products -->
            </div>
            <!-- /.item -->
            @endforeach


          </div>
          <!-- /.home-owl-carousel -->
        </section>
        <!-- /.section -->
        <!-- == ==== skip_product_1 PRODUCTS : END ==== === -->
        <!-- ============================================== WIDE PRODUCTS ============================================== -->
        
        <!-- /.wide-banners -->
        <!-- ============================================== WIDE PRODUCTS : END ============================================== -->

        <!-- == === skip_brand_product_1 PRODUCTS == ==== -->

        <section class="section featured-product wow fadeInUp">
          <h3 class="section-title">
            @if(session()->get('language') == 'romanian') {{ $skip_brand_1->brand_name_ro }} @else {{ $skip_brand_1->brand_name_en }} @endif
          </h3>
          <div class="owl-carousel home-owl-carousel custom-carousel owl-theme outer-top-xs">


            @foreach($skip_brand_product_1 as $product)
            <div class="item item-carousel">
              <div class="products">
                <div class="product">
                  <div class="product-image">
                    <div class="image"> <a href="{{ url('product/details/'.$product->id ) }}"><img src="{{ asset($product->product_thumbnail) }}" alt=""></a> </div>
                    <!-- /.image -->

                    @php
                    $amount = $product->selling_price - $product->discount_price;
                    $discount = ($amount/$product->selling_price) * 100;
                    $average = App\Models\Review::where('product_id',$product->id)->where('status',1)->avg('rating');
                    @endphp

                    <div>
                      @if ($product->discount_price == NULL)

                      @else
                      <div class="tag hot">-<span>{{ round($discount) }}%</span></div>
                      @endif
                    </div>
                  </div>

                  <!-- /.product-image -->

                  <div class="product-info text-left">
                    <h3 class="name"><a href="{{ url('product/details/'.$product->id ) }}">
                        @if(session()->get('language') == 'romanian') {{ $product->product_name_ro }} @else {{ $product->product_name_en }} @endif
                      </a></h3>
                    <div class="rating-reviews m-t-10">



                      @if($average == 0)
                      @if(session()->get('language') == 'romanian') Niciun rating @else  No rating yet @endif
                     
                      @elseif($average == 1) <span class="fa fa-star"></span>
                      <span class="fa fa-star-o"></span>
                      <span class="fa fa-star-o"></span>
                      <span class="fa fa-star-o"></span>
                      <span class="fa fa-star-o"></span>
                      @elseif($average < 2) <span class="fa fa-star"></span>
                        <span class="fa fa-star-half-o"></span>
                        <span class="fa fa-star-o"></span>
                        <span class="fa fa-star-o"></span>
                        <span class="fa fa-star-o"></span>
                        @elseif($average == 2 ) <span class="fa fa-star "></span>
                        <span class="fa fa-star "></span>
                        <span class="fa fa-star-o"></span>
                        <span class="fa fa-star-o"></span>
                        <span class="fa fa-star-o"></span>
                        @elseif($average < 3) <span class="fa fa-star "></span>
                          <span class="fa fa-star "></span>
                          <span class="fa fa-star-half-o"></span>
                          <span class="fa fa-star-o"></span>
                          <span class="fa fa-star-o"></span>
                          @elseif($average == 3) <span class="fa fa-star "></span>
                          <span class="fa fa-star "></span>
                          <span class="fa fa-star "></span>
                          <span class="fa fa-star-o"></span>
                          <span class="fa fa-star-o"></span>
                          @elseif($average < 4) <span class="fa fa-star "></span>
                            <span class="fa fa-star "></span>
                            <span class="fa fa-star "></span>
                            <span class="fa fa-star-half-o"></span>
                            <span class="fa fa-star-o"></span>
                            @elseif($average == 4 ) <span class="fa fa-star "></span>
                            <span class="fa fa-star "></span>
                            <span class="fa fa-star "></span>
                            <span class="fa fa-star "></span>
                            <span class="fa fa-star-o"></span>
                            @elseif( $average < 5) <span class="fa fa-star "></span>
                              <span class="fa fa-star "></span>
                              <span class="fa fa-star "></span>
                              <span class="fa fa-star "></span>
                              <span class="fa fa-star-half-o "></span>
                              @elseif( $average == 5) <span class="fa fa-star "></span>
                              <span class="fa fa-star "></span>
                              <span class="fa fa-star "></span>
                              <span class="fa fa-star "></span>
                              <span class="fa fa-star"></span>
                              @endif


                    </div><!-- /.rating-reviews -->
                    <div class="description"></div>

                    @if ($product->discount_price == NULL)
                    <div class="product-price"> <span class="price"> ${{ $product->selling_price }} </span> </div>
                    @else
                    <div class="product-price"> <span class="price-before-discount">$ {{ $product->selling_price }}</span><span class="price"> ${{ $product->discount_price }} </span> </div>
                    @endif


                    <!-- /.product-price -->

                  </div>
                  <!-- /.product-info -->
                  <div class="cart clearfix animate-effect">
                    <div class="action">
                      <ul class="list-unstyled">
                        <li class="add-cart-button btn-group">

                          <button class="btn btn-primary icon" type="button" title="Quick view" data-toggle="modal" data-target="#exampleModal" id="{{ $product->id }}" onclick="productView(this.id)"> <i class="fa fa-eye"></i> </button>


                        </li>



                        <button class="btn btn-primary icon" type="button" title="Wishlist" id="{{ $product->id }}" onclick="addToWishList(this.id)"> <i class="fa fa-heart"></i> </button>

                      </ul>
                    </div>
                    <!-- /.action -->
                  </div>
                  <!-- /.cart -->
                </div>
                <!-- /.product -->

              </div>
              <!-- /.products -->
            </div>
            <!-- /.item -->
            @endforeach


          </div>
          <!-- /.home-owl-carousel -->
        </section>
        <!-- /.section -->
        <!-- == ==== skip_brand_product_1 PRODUCTS : END ==== === -->



        <!-- ============================================== BLOG SLIDER ============================================== -->
        <section class="section latest-blog outer-bottom-vs wow fadeInUp">
          <h3 class="section-title">Latest from our blog</h3>
          <div class="blog-slider-container outer-top-xs">
            <div class="owl-carousel blog-slider custom-carousel">


              @foreach($blogpost as $blog)
              <div class="item">
                <div class="blog-post">
                  <div class="blog-post-image">
                    <div class="image"> <a href="{{ route('post.details',$blog->id) }}"><img src="{{ asset($blog->post_image) }}" alt=""></a> </div>
                  </div>
                  <!-- /.blog-post-image -->

                  <div class="blog-post-info text-left">
                    <h3 class="name"><a href="#">@if(session()->get('language') == 'romanian') {{ $blog->post_title_ro }} @else {{ $blog->post_title_en }} @endif</a></h3>


                    <span class="info">{{ Carbon\Carbon::parse($blog->created_at)->diffForHumans()  }}</span>

                    <p class="text">@if(session()->get('language') == 'romanian') {!! Str::limit($blog->post_details_ro, 100 ) !!} @else {!! Str::limit($blog->post_details_en, 100 ) !!} @endif</p>


                    <a href="{{ route('post.details',$blog->id) }}" class="lnk btn btn-primary">Read more</a>
                  </div>
                  <!-- /.blog-post-info -->

                </div>
                <!-- /.blog-post -->
              </div>
              <!-- /.item -->
              @endforeach


            </div>
            <!-- /.owl-carousel -->
          </div>
          <!-- /.blog-slider-container -->
        </section>
        <!-- /.section -->
        <!-- ============================================== BLOG SLIDER : END ============================================== -->


      </div>
      <!-- /.homebanner-holder -->
      <!-- ============================================== CONTENT : END ============================================== -->
    </div>
    <!-- /.row -->
    @include('frontend.body.brands')
    <!-- /.logo-slider -->
    <!-- ============================================== BRANDS CAROUSEL : END ============================================== -->
  </div>
  <!-- /.container -->
</div>
<!-- /#top-banner-and-menu -->
@endsection

