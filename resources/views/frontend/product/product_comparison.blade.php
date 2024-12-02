@extends('frontend.main_master')
@section('content')

@section('title')
Product Comparison
@endsection
<div class="breadcrumb">
    <div class="container">
        <div class="breadcrumb-inner">
            <ul class="list-inline list-unstyled">
            <li><a href="{{ url('/') }}">Home</a></li>
                <li class='active'>Compare</li>
            </ul>
        </div><!-- /.breadcrumb-inner -->
    </div><!-- /.container -->
</div><!-- /.breadcrumb -->

<div class="body-content outer-top-xs">
    <div class="container">
        <div class="product-comparison">
            <div>
                <h1 class="page-title text-center heading-title">Product Comparison</h1>
                <div class="table-responsive">
                    <table class="table compare-table inner-top-vs">
                        <tr>
                            <th width="10%"><b>Product name</b></th>

                            @foreach($comparableProducts as $product)
                            <td width="10%">

                                <div class="product">
                                    <div class="product-image">
                                        <div class="image">
                                            <a href="{{ url('product/details/'.$product->id ) }}">
                                                <img src="{{ asset($product->product_thumbnail) }}" alt="">
                                            </a>
                                        </div>

                                        <div class="product-info text-left">
                                            <h3 class="name"><a href="{{ url('product/details/'.$product->id ) }}">{{$product->product_name_en}}</a></h3>
                                            <div class="action">

                                            <button class="btn btn-primary icon" type="button" title="Quick view" data-toggle="modal" data-target="#exampleModal" id="{{ $product->id }}" onclick="productView(this.id)">ADD TO CART</button>

                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </td>

                            @endforeach
                        </tr>

                        <tr>
                            <th width="5%"><b>Price</b></th>
                            @foreach($comparableProducts as $product)

                            @php
                            $amount = $product->selling_price - $product->discount_price;
                            $discount = ($amount/$product->selling_price) * 100;

                            @endphp
                            <td width="5%">
                                @if ($product->discount_price == NULL)
                                <div class="product-price"> <span class="price"> ${{ $product->selling_price }} </span> </div>
                                @else
                                <div class="product-price"> <span class="price-before-discount">${{$product->selling_price }}</span><span class="price"> ${{ $product->discount_price }} </span> </div>
                                <div class="text-danger"><span>(-{{ round($discount) }}%)</span></div>
                                @endif
                            </td>
                            @endforeach

                        </tr>

                        <tr>
                            <th width="15%"><b>Description</b></th>
                            @foreach($comparableProducts as $product)
                            <td width="15%">
                                <p class="text">{{$product->short_description_en}}</p>
                            </td>
                            @endforeach
                            
                        </tr>

                        

                        <tr>
                            <th width="5%"><b>Brand</b></th>
                            @foreach($comparableProducts as $product)
                            <td width="5%">
                                <p class="text">{{$product->brand->brand_name_en}}</p>
                            </td>
                            @endforeach
                            
                        </tr>

                        <tr>
                            <th width="5%"><b>Category</b></th>
                            @foreach($comparableProducts as $product)
                            <td width="5%">
                                <p class="text">{{$product->category->category_name_en}}</p>
                            </td>
                            @endforeach
                            
                        </tr>

                        <tr>
                            <th width="5%"><b>Subcategory</b></th>
                            @foreach($comparableProducts as $product)
                            <td width="5%">
                                <p class="text">{{$product->subcategory->subcategory_name_en}}</p>
                            </td>
                            @endforeach
                            
                        </tr>

                        <tr>
                            <th width="5%"><b>Subsubcategory</b></th>
                            @foreach($comparableProducts as $product)
                            <td width="5%">
                                <p class="text">{{$product->subsubcategory->subsubcategory_name_en}}</p>
                            </td>
                            @endforeach
                            
                        </tr>

                        <tr>
                            <th width="5%"><b>Product benefit</b></th>
                            @foreach($comparableProducts as $product)
                            <td width="5%">
                                <p class="text">{{$product->product_benefit_en}}</p>
                            </td>
                            @endforeach
                            
                        </tr>

                        <tr>
                            <th width="5%"><b>Product type</b></th>
                            @foreach($comparableProducts as $product)
                            <td width="5%">
                                <p class="text">{{$product->product_type_en}}</p>
                            </td>
                            @endforeach
                            
                        </tr>

                        <tr>
                            <th width="5%"><b>Mode of use</b></th>
                            @foreach($comparableProducts as $product)
                            <td width="5%">
                                <p class="text">{{$product->mode_of_use_en}}</p>
                            </td>
                            @endforeach
                            
                        </tr>

                        <tr>
                            <th width="5%"><b>Destinated to</b></th>
                            @foreach($comparableProducts as $product)
                            <td width="5%">
                                <p class="text">{{$product->destinated_to_en}}</p>
                            </td>
                            @endforeach
                            
                        </tr>

                        <tr>
                            <th width="5%"><b>Availability</b></th>
                            @foreach($comparableProducts as $product)
                            <td width="5%">
                            @if($product->product_qty>5)
                                        <div class="col-sm-9">
                                            <div class="in-stock">
                                                <span class="value">In stock</span>
                                            </div>
                                        </div>
                                        @elseif($product->product_qty >= 1 and $product->product_qty <= 5) 
                                        <div class="col-sm-9">
                                            <div class="in-stock">
                                                <span class="value">There are only {{$product->product_qty}} pieces left in stock!</span>
                                            </div>
                                        </div>
                                        @else
                                        <div class="col-sm-9">
                                            <div class="in-stock">
                                                <span class="value">Out of stock</span>
                                            </div>
                                        </div>
                                        @endif
                            </td>
                            @endforeach
                        </tr>

                        <tr>
                            <th width="5%"><b>Remove</b></th>
                            @foreach($comparableProducts as $product)
                            

                            <td width="5%" class='text-center'><a  href="{{ route('compare.delete',$product->id) }}" class="remove-icon" title="Delete"><i class="fa fa-times"></i> </a></td>
                            @endforeach
                       
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="switchstylesheet/switchstylesheet.js"></script>

<script>
    $(document).ready(function() {
        $(".changecolor").switchstylesheet({
            seperator: "color"
        });
        $('.show-theme-options').click(function() {
            $(this).parent().toggleClass('open');
            return false;
        });
    });

    $(window).bind("load", function() {
        $('.show-theme-options').delay(2000).trigger('click');
    });
</script>
<!-- For demo purposes – can be removed on production : End -->
@endsection