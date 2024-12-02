@extends('frontend.main_master')
@section('content')

@section('title')
{{ $product->product_name_en }} Product Details
@endsection
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<style>
    .checked {
        color: orange;
    }
</style>


<!-- ===== ======== HEADER : END ============================================== -->
<div class="breadcrumb">
    <div class="container">
        &nbsp;
        <!-- <div class="breadcrumb-inner">
            <ul class="list-inline">
                <li><a href="#">Home</a></li>
                <li class='active'></li>
                <li class='active'>{{ $product->subcategory->subcategory_name_en }}</li>
              
                <li class='active'>{{$product->product_name_en}}</li>

            </ul>
        </div> -->
        <!-- /.breadcrumb-inner -->

        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
            <li class="breadcrumb-item active"><a href="{{ url('/') }}">Home</a></li>
                <li class="breadcrumb-item active"><a href="#">{{ $product->category->category_name_en  }}</a></li>
                <li class="breadcrumb-item active"><a href="#">{{ $product->subcategory->subcategory_name_en  }}</a></li>
                <li class="breadcrumb-item active"><a href="#">{{ $product->subsubcategory->subsubcategory_name_en  }}</a></li>
                <li class="breadcrumb-item" aria-current="page">{{$product->product_name_en}}</li>
            </ol>
        </nav>
    </div><!-- /.container -->
</div><!-- /.breadcrumb -->
<div class="body-content outer-top-xs">
    <div class='container'>
        <div class='row single-product'>

            <div class='col-md-12'>
                <div class="detail-block">
                    <div class="row  wow fadeInUp">

                        <div class="col-xs-12 col-sm-6 col-md-5 gallery-holder">
                            <div class="product-item-holder size-big single-product-gallery small-gallery">

                                <div id="owl-single-product">
                                    <div class="single-product-gallery-item" id="slide0">

                                        <a data-lightbox="image-1" data-title="Gallery" href="{{ asset($product->product_thumbnail ) }} id=" slide0">
                                            <img class="img-responsive" alt="" src="{{ asset($product->product_thumbnail ) }} " data-echo="{{ asset($product->product_thumbnail) }} " />
                                        </a>
                                    </div>

                                    @foreach($multiImag as $img)
                                    <div class="single-product-gallery-item " id="slide{{ $img->id }}">
                                        <div class="easyzoom easyzoom--overlay easyzoom--with-thumbnails">
                                            <a data-lightbox="image-1" data-title="Gallery" href="{{ asset($img->photo_name ) }} ">
                                                <img class="img-responsive" alt="" src="{{ asset($img->photo_name ) }} " data-echo="{{ asset($img->photo_name ) }} " />
                                            </a>
                                        </div><!-- /.single-product-gallery-item -->
                                    </div>
                                    @endforeach


                                </div><!-- /.single-product-slider -->


                                <div class="single-product-gallery-thumbs gallery-thumbs">

                                    <div id="owl-single-product-thumbnails">
                                        <div class="item">
                                            <a class="horizontal-thumb active" data-target="#owl-single-product" data-slide="1" href="#slide0">
                                                <img class="img-responsive" width="85" alt="" src="{{ asset($product->product_thumbnail) }} " data-echo="{{ asset($product->product_thumbnail) }} " />
                                            </a>
                                        </div>
                                        @foreach($multiImag as $img)
                                        <div class="item">
                                            <a class="horizontal-thumb active" data-target="#owl-single-product" data-slide="1" href="#slide{{ $img->id }}">
                                                <img class="img-responsive" width="85" alt="" src="{{ asset($img->photo_name ) }} " data-echo="{{ asset($img->photo_name ) }} " />
                                            </a>
                                        </div>
                                        @endforeach




                                    </div><!-- /#owl-single-product-thumbnails -->



                                </div><!-- /.gallery-thumbs -->

                            </div><!-- /.single-product-gallery -->
                        </div><!-- /.gallery-holder -->

                        @php
                        $reviewcount = App\Models\Review::where('product_id',$product->id)->where('status',1)->latest()->get();
                        $average = App\Models\Review::where('product_id',$product->id)->where('status',1)->avg('rating');
                        @endphp


                        <div class='col-sm-6 col-md-7 product-info-block'>
                            <div class="product-info">


                                <h1 class="name" id="pname">
                                    @if(session()->get('language') == 'romanian') {{ $product->product_name_ro }} @else {{ $product->product_name_en }} @endif
                                </h1>

                                <div class="rating-reviews m-t-20">
                                    <div class="row">
                                        <div class="col-sm-3">

                                            @if($average == 0)
                                            @if(session()->get('language') == 'romanian') Niciun rating @else No rating yet @endif
                                            @elseif($average == 1) <span class="fa fa-star checked"></span>
                                            <span class="fa fa-star-o"></span>
                                            <span class="fa fa-star-o"></span>
                                            <span class="fa fa-star-o"></span>
                                            <span class="fa fa-star-o"></span>
                                            @elseif($average < 2) <span class="fa fa-star checked"></span>
                                                <span class="fa fa-star-half-o checked"></span>
                                                <span class="fa fa-star-o"></span>
                                                <span class="fa fa-star-o"></span>
                                                <span class="fa fa-star-o"></span>
                                                @elseif($average == 2 ) <span class="fa fa-star checked"></span>
                                                <span class="fa fa-star checked"></span>
                                                <span class="fa fa-star-o"></span>
                                                <span class="fa fa-star-o"></span>
                                                <span class="fa fa-star-o"></span>
                                                @elseif($average < 3) <span class="fa fa-star checked"></span>
                                                    <span class="fa fa-star checked"></span>
                                                    <span class="fa fa-star-half-o checked"></span>
                                                    <span class="fa fa-star-o"></span>
                                                    <span class="fa fa-star-o"></span>
                                                    @elseif($average == 3) <span class="fa fa-star checked"></span>
                                                    <span class="fa fa-star checked"></span>
                                                    <span class="fa fa-star checked"></span>
                                                    <span class="fa fa-star-o"></span>
                                                    <span class="fa fa-star-o"></span>
                                                    @elseif($average < 4) <span class="fa fa-star checked"></span>
                                                        <span class="fa fa-star checked"></span>
                                                        <span class="fa fa-star checked"></span>
                                                        <span class="fa fa-star-half-o checked"></span>
                                                        <span class="fa fa-star-o"></span>
                                                        @elseif($average == 4 ) <span class="fa fa-star checked"></span>
                                                        <span class="fa fa-star checked"></span>
                                                        <span class="fa fa-star checked"></span>
                                                        <span class="fa fa-star checked"></span>
                                                        <span class="fa fa-star-o"></span>
                                                        @elseif( $average < 5) <span class="fa fa-star checked"></span>
                                                            <span class="fa fa-star checked"></span>
                                                            <span class="fa fa-star checked"></span>
                                                            <span class="fa fa-star checked"></span>
                                                            <span class="fa fa-star-half-o checked"></span>
                                                            @elseif( $average == 5) <span class="fa fa-star checked"></span>
                                                            <span class="fa fa-star checked"></span>
                                                            <span class="fa fa-star checked"></span>
                                                            <span class="fa fa-star checked"></span>
                                                            <span class="fa fa-star checked"></span>
                                                            @endif


                                        </div>



                                        <div class="col-sm-8">
                                            <div class="reviews">
                                                <a href="#" class="lnk">({{ count($reviewcount) }} Reviews)</a>
                                            </div>
                                        </div>
                                    </div><!-- /.row -->
                                </div><!-- /.rating-reviews -->

                                <div class="stock-container info-container m-t-10">
                                    <div class="row">
                                        <div class="col-sm-2">
                                            <div class="stock-box">
                                                <span class="label">Availability :</span>
                                            </div>
                                        </div>
                                        @if($product->product_qty>5)
                                        <div class="col-sm-9">
                                            <div class="stock-box">
                                                <span class="value">In stock</span>
                                            </div>
                                        </div>
                                        @elseif($product->product_qty >= 1 and $product->product_qty <= 5) 
                                        <div class="col-sm-9">
                                            <div class="stock-box">
                                                <span class="value">There are only {{$product->product_qty}} pieces left in stock!</span>
                                            </div>
                                        </div>
                                        @else
                                        <div class="col-sm-9">
                                            <div class="stock-box">
                                                <span class="value">Out of stock</span>
                                            </div>
                                        </div>
                                        @endif
                                </div><!-- /.row -->
                            </div><!-- /.stock-container -->

                            <div class="description-container m-t-20">
                                @if(session()->get('language') == 'romanian') {{ $product->short_description_ro }} @else {{ $product->short_description_en }} @endif
                            </div><!-- /.description-container -->
                            @php
                            $selectedCurrency = App\Models\Currency::where('currency_code',session()->get('currency'))->first();

                            @endphp
                            <div class="price-container info-container m-t-20">
                                <div class="row">


                                    <div class="col-sm-6">
                                        <div class="price-box">
                                            @if ($product->discount_price == NULL)
                                            @if(session()->get('currency') == 'USD')
                                            <span class="price">${{ $product->selling_price }}</span>
                                            <span>(including tax)</span>
                                            @else
                                            <span class="price">{{ $product->selling_price * $selectedCurrency->exchange_rate }} {{ $selectedCurrency->currency_code}} </span>
                                            <span>(including tax)</span>
                                            @endif
                                            @else
                                            @if(session()->get('currency') == 'USD')
                                            <span class="price-strike">${{ $product->selling_price }}</span>
                                            <span class="price">${{ $product->discount_price }}</span>
                                            <span>(including tax)</span>
                                            @else
                                            <span class="price-strike">{{ $product->selling_price * $selectedCurrency->exchange_rate}} {{ $selectedCurrency->currency_code}}</span>
                                            <span class="price">{{ $product->discount_price * $selectedCurrency->exchange_rate}} {{ $selectedCurrency->currency_code}}</span>
                                            <span>(including tax)</span>


                                            @endif


                                            @endif

                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="favorite-button m-t-10">
                                            <button class="btn btn-primary" data-toggle="tooltip" data-placement="right" type="button" title="Wishlist" id="{{ $product->id }}" onclick="addToWishList(this.id)"> <i class="fa fa-heart"></i> </button>



                                            <a class="btn btn-primary" data-toggle="tooltip" data-placement="right" title="Add to compare" href="{{ route('compare.store',$product->id) }}">
                                                <i class="fa fa-signal"></i>
                                            </a>



                                        </div>
                                    </div>

                                </div><!-- /.row -->
                            </div><!-- /.price-container -->


                            <!--     /// Add Product Color And Product Size ///// -->

                            <div class="row">




                                <div class="col-sm-6">

                                    <div class="form-group">
                                        @if($product->product_size_en == null)

                                        @else

                                        <label class="info-title control-label">Size <span> </span></label>
                                        <select class="form-control unicase-form-control selectpicker" style="display: none;" id="size">
                                            <option selected="" disabled="" value="{{$product->product_size_en}}">{{$product->product_size_en}}</option>

                                        </select>

                                        @endif
                                    </div> <!-- // end form group -->


                                </div> <!-- // end col 6 -->

                            </div><!-- /.row -->



                            <!--     /// End Add Product Color And Product Size ///// -->








                            <div class="quantity-container info-container">
                                <div class="row">

                                    <div class="col-sm-2">
                                        <span class="label">Qty :</span>
                                    </div>

                                    <div class="col-sm-2">

                                        @if($product->product_qty>0)
                                        <input type="number" class="form-control" id="qty" value="1" min="1" max="{{$product->product_qty}}">
                                        @else
                                        <input type="number" class="form-control" id="qty" value="1" min="1" max="{{$product->product_qty}}" disabled>
                                        @endif
                                    </div>

                                    <input type="hidden" id="product_id" value="{{ $product->id }}" min="1">
                                    @if($product->product_qty>0)
                                    <div class="col-sm-7">
                                        <button type="submit" onclick="addToCart()" class="btn btn-primary"><i class="fa fa-shopping-cart inner-right-vs"></i> ADD TO CART</button>
                                    </div>
                                    @else
                                    <div class="col-sm-7">
                                        <button disabled class="btn btn-primary"><i class="fa fa-shopping-cart inner-right-vs"></i> ADD TO CART</button>
                                    </div>
                                    @endif


                                </div><!-- /.row -->
                            </div><!-- /.quantity-container -->



                            <!-- Go to www.addthis.com/dashboard to customize your tools -->
                            <div class="addthis_inline_share_toolbox_8tvu"></div>




                        </div><!-- /.product-info -->
                    </div><!-- /.col-sm-7 -->
                </div><!-- /.row -->
            </div>

            <div class="product-tabs inner-bottom-xs  wow fadeInUp">
                <div class="row">
                    <div class="col-sm-3">
                        <ul id="product-tabs" class="nav nav-tabs nav-tab-cell">
                            <li class="active"><a data-toggle="tab" href="#info">PRODUCT INFORMATION</a></li>
                            <li><a data-toggle="tab" href="#description">DESCRIPTION</a></li>
                            <li><a data-toggle="tab" href="#review">REVIEW</a></li>
                            <li><a data-toggle="tab" href="#shipping_details">SHIPPING DETAILS</a></li>

                        </ul><!-- /.nav-tabs #product-tabs -->
                    </div>
                    <div class="col-sm-9">

                        <div class="tab-content">

                            <div id="info" class="tab-pane in active">
                                <div class="product-tab">
                                    <table class="table table-bordered table-hover">

                                        <tbody>

                                            <tr>
                                                <th>Brand: </th>
                                                <td>{{ $product['brand']['brand_name_en'] }}</td>
                                            </tr>
                                            <tr>
                                                <th>Code:</th>
                                                <td>{{ $product['product_code'] }}</td>
                                            </tr>
                                            <!-- <tr>
                                                <th>Color:</th>
                                                <td>{{ $product['product_color_en'] }}</td>
                                            </tr> -->
                                            <tr>
                                                <th>Weight:</th>
                                                <td>{{ $product['product_weight'] }}</td>
                                            </tr>

                                            @if($product->product_type_en == null)

                                            @else
                                            <tr>
                                                <th>Product type:</th>
                                                <td>{{ $product['product_type_en'] }}</td>
                                            </tr>
                                            @endif

                                            @if($product->product_benefit_en == null)

                                            @else
                                            <tr>
                                                <th>Product benefit:</th>
                                                <td>{{ $product['product_benefit_en'] }}</td>
                                            </tr>
                                            @endif

                                            @if($product->mode_of_use_en == null)

                                            @else
                                            <tr>
                                                <th>Mode of use:</th>
                                                <td>{{ $product['mode_of_use_en'] }}</td>
                                            </tr>
                                            @endif

                                            @if($product->destinated_to_en == null)

                                            @else
                                            <tr>
                                                <th>Destinated to:</th>
                                                <td>{{ $product['destinated_to_en'] }}</td>
                                            </tr>
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div><!-- /.tab-pane -->

                            <div id="description" class="tab-pane">
                                <div class="product-tab">
                                    <p class="text">@if(session()->get('language') == 'romanian')
                                        {!! $product->long_description_ro !!} @else {!! $product->long_description_en !!} @endif</p>
                                    @if(!empty($product->product_video))

                                    <video controls width="640" height="480">
                                        <source src="{{ asset($product->product_video) }}" type="video/mp4">
                                    </video>

                                    @endif
                                </div>
                            </div><!-- /.tab-pane -->




                            <div id="review" class="tab-pane">
                                <div class="product-tab">

                                    <div class="product-reviews">
                                        <h4 class="title">Customer Reviews</h4>

                                        @php
                                        $reviews = App\Models\Review::where('product_id',$product->id)->latest()->limit(5)->get();
                                        @endphp

                                        <div class="reviews">

                                            @foreach($reviews as $item)
                                            @if($item->status == 0)

                                            @else

                                            <div class="review">

                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <img style="border-radius: 50%" src="{{ (!empty($item->user->profile_photo_path))? url('upload/user_images/'.$item->user->profile_photo_path):url('upload/no_image.jpg') }}" width="40px;" height="40px;"><b> {{ $item->user->name }}</b>


                                                        @if($item->rating == NULL)

                                                        @elseif($item->rating == 1)
                                                        <span class="fa fa-star checked"></span>
                                                        <span class="fa fa-star"></span>
                                                        <span class="fa fa-star"></span>
                                                        <span class="fa fa-star"></span>
                                                        <span class="fa fa-star"></span>
                                                        @elseif($item->rating == 2)
                                                        <span class="fa fa-star checked"></span>
                                                        <span class="fa fa-star checked"></span>
                                                        <span class="fa fa-star"></span>
                                                        <span class="fa fa-star"></span>
                                                        <span class="fa fa-star"></span>

                                                        @elseif($item->rating == 3)
                                                        <span class="fa fa-star checked"></span>
                                                        <span class="fa fa-star checked"></span>
                                                        <span class="fa fa-star checked"></span>
                                                        <span class="fa fa-star"></span>
                                                        <span class="fa fa-star"></span>

                                                        @elseif($item->rating == 4)
                                                        <span class="fa fa-star checked"></span>
                                                        <span class="fa fa-star checked"></span>
                                                        <span class="fa fa-star checked"></span>
                                                        <span class="fa fa-star checked"></span>
                                                        <span class="fa fa-star"></span>
                                                        @elseif($item->rating == 5)
                                                        <span class="fa fa-star checked"></span>
                                                        <span class="fa fa-star checked"></span>
                                                        <span class="fa fa-star checked"></span>
                                                        <span class="fa fa-star checked"></span>
                                                        <span class="fa fa-star checked"></span>

                                                        @endif



                                                    </div>

                                                    <div class="col-md-6">

                                                    </div>
                                                </div> <!-- // end row -->



                                                <div class="review-title"><span class="summary">{{ $item->summary }}</span><span class="date"><i class="fa fa-calendar"></i><span> {{ Carbon\Carbon::parse($item->created_at)->diffForHumans() }} </span></span></div>
                                                <div class="text">"{{ $item->comment }}"</div>
                                            </div>

                                            @endif
                                            @endforeach
                                        </div><!-- /.reviews -->


                                    </div><!-- /.product-reviews -->



                                    <div class="product-add-review">
                                        <h4 class="title">Write your own review</h4>
                                        <div class="review-table">

                                        </div><!-- /.review-table -->

                                        <div class="review-form">
                                            @guest
                                            <p> <b> For adding a product review you need to login first <a href="{{ route('login') }}">Login here</a> </b> </p>

                                            @else

                                            <div class="form-container">

                                                <form role="form" class="cnt-form" method="post" action="{{ route('review.store') }}">
                                                    @csrf

                                                    <input type="hidden" name="product_id" value="{{ $product->id }}">


                                                    <table class="table">
                                                        <thead>
                                                            <tr>
                                                                <th class="cell-label">&nbsp;</th>
                                                                <th>1 star</th>
                                                                <th>2 stars</th>
                                                                <th>3 stars</th>
                                                                <th>4 stars</th>
                                                                <th>5 stars</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td class="cell-label">Quality</td>
                                                                <td><input type="radio" name="quality" class="radio" value="1"></td>
                                                                <td><input type="radio" name="quality" class="radio" value="2"></td>
                                                                <td><input type="radio" name="quality" class="radio" value="3"></td>
                                                                <td><input type="radio" name="quality" class="radio" value="4"></td>
                                                                <td><input type="radio" name="quality" class="radio" value="5"></td>
                                                            </tr>

                                                        </tbody>
                                                    </table>




                                                    <div class="row">
                                                        <div class="col-sm-6">

                                                            <div class="form-group">
                                                                <label for="exampleInputSummary">Summary <span class="astk">*</span></label>
                                                                <input type="text" name="summary" class="form-control txt" id="exampleInputSummary" placeholder="">
                                                            </div><!-- /.form-group -->
                                                        </div>

                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="exampleInputReview">Review <span class="astk">*</span></label>
                                                                <textarea class="form-control txt txt-review" name="comment" id="exampleInputReview" rows="4" placeholder=""></textarea>
                                                            </div><!-- /.form-group -->
                                                        </div>
                                                    </div><!-- /.row -->

                                                    <div class="action text-right">
                                                        <button type="submit" class="btn btn-primary btn-upper">SUBMIT REVIEW</button>
                                                    </div><!-- /.action -->

                                                </form><!-- /.cnt-form -->
                                            </div><!-- /.form-container -->

                                            @endguest


                                        </div><!-- /.review-form -->

                                    </div><!-- /.product-add-review -->

                                </div><!-- /.product-tab -->
                            </div><!-- /.tab-pane -->

                            <div id="shipping_details" class="tab-pane">
                                <div class="product-tab">
                                    <p class="text">
                                        @if(session()->get('language') == 'romanian')
                                        <b>Livrare gratuita in doua zile lucratoare</b><br>
                                        Suntem mandri sa va oferim una dintre cele mai rapide mijloace de expediere de pe piață. Oferim, de asemenea, livrare gratuită pentru toate comenzile.<br>
                                        <br><br>
                                        <b>Politica de returnare in 30 de zile</b><br>
                                        Suntem dedicați satisfacției dvs. Dacă nu sunteți mulțumiți cu alegerea dvs., returnați produsul în starea inițială în termen de 30 de zile.<br>
                                        @else
                                        <b>Free delivery in two working days</b><br>
                                        We are proud to offer you one of the fastest shipping on the market. We also offer free delivery for all orders.<br>
                                        <br><br>
                                        <b>30 day return policy</b><br>
                                        We are dedicated to your satisfaction. If you are not satisfied with your choice, return the product to its original condition within 30 days.<br>
                                        @endif
                                    </p>

                                </div>
                            </div><!-- /.tab-pane -->



                        </div><!-- /.tab-content -->
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.product-tabs -->

            <!-- ===== ======= UPSELL PRODUCTS ==== ========== -->
            <section class="section featured-product wow fadeInUp">
                <h3 class="section-title">Related products</h3>
                <div class="owl-carousel home-owl-carousel upsell-product custom-carousel owl-theme outer-top-xs">



                    @foreach($relatedProduct as $product)

                    <div class="item item-carousel">
                        <div class="products">

                            <div class="product">
                                <div class="product-image">
                                    <div class="image">
                                        <a href="{{ url('product/details/'.$product->id ) }}"><img src="{{ asset($product->product_thumbnail) }}" alt=""></a>
                                    </div><!-- /.image -->

                                    <div class="tag sale"><span>sale</span></div>
                                </div><!-- /.product-image -->


                                <div class="product-info text-left">
                                    <h3 class="name"><a href="{{ url('product/details/'.$product->id) }}">
                                            @if(session()->get('language') == 'romanian') {{ $product->product_name_ro }} @else {{ $product->product_name_en }} @endif</a></h3>
                                    <div class="rating rateit-small"></div>
                                    <div class="description"></div>


                                    @if ($product->discount_price == NULL)
                                    <div class="product-price getAttrPrice">
                                        <span class="price">
                                            ${{ $product->selling_price }} </span>
                                    </div><!-- /.product-price -->
                                    @else

                                    <div class="product-price">
                                        <span class="price">
                                            <span class="price-before-discount">$ {{ $product->selling_price }}</span>
                                            ${{ $product->discount_price }} </span>

                                    </div><!-- /.product-price -->
                                    @endif




                                </div><!-- /.product-info -->
                                <div class="cart clearfix animate-effect">
                                    <div class="action">
                                        <ul class="list-unstyled">
                                            <li class="add-cart-button btn-group">
                                                <button class="btn btn-primary icon" type="button" title="Quick view" data-toggle="modal" data-target="#exampleModal" id="{{ $product->id }}" onclick="productView(this.id)"> <i class="fa fa-eye"></i> </button>
                                            </li>
                                            <button class="btn btn-primary icon" type="button" title="Wishlist" id="{{ $product->id }}" onclick="addToWishList(this.id)"> <i class="fa fa-heart"></i> </button>
                                        </ul>
                                    </div><!-- /.action -->
                                </div><!-- /.cart -->
                            </div><!-- /.product -->

                        </div><!-- /.products -->
                    </div><!-- /.item -->

                    @endforeach





                </div><!-- /.home-owl-carousel -->
            </section><!-- /.section -->
            <!-- ============================================== UPSELL PRODUCTS : END ============================================== -->

        </div><!-- /.col -->
        <div class="clearfix"></div>
    </div><!-- /.row -->

</div>






<!-- Go to www.addthis.com/dashboard to customize your tools -->
<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-5e4b85f98de5201f"></script>


<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $(".size").on('click', function() {
        alert('hey');
    });
</script>
@endsection