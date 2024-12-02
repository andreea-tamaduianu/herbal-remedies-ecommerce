@php
$hot_deals = App\Models\Product::where('hot_deals',1)->where('discount_price','!=',NULL)->orderBy('id','DESC')->limit(3)->get();
@endphp

<div class="sidebar-widget hot-deals wow fadeInUp outer-bottom-xs">
  <h3 class="section-title">@if(session()->get('language') == 'romanian') Reducerile momentului @else Hot deals @endif</h3>
  <div class="owl-carousel sidebar-carousel custom-carousel owl-theme outer-top-ss">



    @foreach($hot_deals as $product)
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
             
              <div class="tag sale"><span>sale</span></div>
              
             
            
            </div>



          </div>

          <!-- /.product-image -->

          <div class="product-info ">
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

            @endif


            <!-- /.product-price -->

          </div>
          <!-- /.product-info -->

          <!-- /.cart -->
        </div>
        <!-- /.product -->
        <div class="cart clearfix animate-effect">
          <div class="action">
            <div class="add-cart-button btn-group">
              <button class="btn btn-primary icon" type="button" title="Add to cart" data-toggle="modal" data-target="#exampleModal" id="{{ $product->id }}" onclick="productView(this.id)"> <i class="fa fa-shopping-cart"></i> Add to cart </button>


            </div>
          </div>
          <!-- /.action -->
        </div>

      </div>
      <!-- /.products -->
    </div>
    <!-- /.item -->
    @endforeach





  </div>
  <!-- /.sidebar-widget -->
</div>













