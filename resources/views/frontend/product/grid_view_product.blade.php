@foreach($products as $product)
                    <div class="col-sm-6 col-md-4 wow fadeInUp">
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
                                @if(session()->get('language') == 'romanian') {{ $product->product_name_ro }} @else {{ $product->product_name_en }} @endif</a></h3>
                            <div class="rating-reviews m-t-10">



                              @if($average == 0)
                              @if(session()->get('language') == 'romanian') Niciun rating @else No rating yet @endif
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