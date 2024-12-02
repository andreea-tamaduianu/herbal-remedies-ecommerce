@extends('frontend.main_master')
@section('content')

@section('title')
My Cart Page
@endsection


@php
$cartTotal =Gloudemans\Shoppingcart\Facades\Cart::total();
@endphp


<div class="breadcrumb">
    <div class="container">
        <div class="breadcrumb-inner">
            <ul class="list-inline list-unstyled">
            <li><a href="{{ url('/') }}">Home</a></li>
                <li class='active'>Cart</li>
            </ul>
        </div><!-- /.breadcrumb-inner -->
    </div><!-- /.container -->
</div><!-- /.breadcrumb -->

<div class="body-content">
    <div class="container">
        <div class="row ">
            <div class="shopping-cart">
                <div class="shopping-cart-table ">
                    <div class="table-responsive">
                    @if ($cartTotal >0)
                        <table class="table">
                            <thead>
                                <tr>
                                    <th class="cart-romove item">Image</th>
                                    <th class="cart-description item">Name</th>
                                    <th class="cart-description item">Unit price</th>
                                   
                                    <th class="cart-edit item">Size</th>
                                    <th class="cart-qty item">Quantity</th>
                                    <th class="cart-sub-total item">Subtotal</th>
                                    <th class="cart-total last-item">Remove</th>
                                </tr>
                            </thead><!-- /thead -->
                            
                            <tbody id="cartPage">

                            </tbody>
                            
                           
                            
                            
                        </table>
                        @else
                        <div><strong>There are no products in your cart</strong> </div>
                        <br>
                        <div>
                            <button class="btn btn-primary checkout-page-button" type="button" onclick="location.href = '/';">Continue shopping</button>
                        </div>
                        @endif
                    </div>
                </div>





                <div class="col-md-4 col-sm-12 estimate-ship-tax">
                    @if(Session::has('coupon'))

                    @else

                    @if($cartTotal>0)
                    <table class="table" id="couponField">
                        <thead>
                            <tr>
                                <th>
                                    <span class="estimate-title">Discount code</span>
                                   
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <div class="form-group">
                                        <input type="text" class="form-control unicase-form-control text-input" placeholder="Your coupon" id="coupon_name">
                                    </div>
                                    <div class="clearfix pull-right">
                                        <button type="submit" class="btn-upper btn btn-primary" onclick="applyCoupon()">APPLY COUPON</button>
                                    </div>
                                </td>
                            </tr>
                        </tbody><!-- /tbody -->
                    </table><!-- /table -->
                    @else

                    @endif
                    @endif


                </div><!-- /.estimate-ship-tax -->


                <div class="col-md-4 col-sm-12 estimate-ship-tax">

                </div>






                @if($cartTotal>0)
                <div class="col-md-4 col-sm-12 cart-shopping-total">
                    <table class="table  table-sm" id="couponCalField">
                        
                    </table><!-- /table -->
                    
                                    <div class="cart-checkout-btn pull-right">
                                        <a href="{{route('checkout')}}" type="submit" class="btn btn-primary checkout-btn">PROCEED TO CHECKOUT</a>
                                    </div>
                               
                </div><!-- /.cart-shopping-total -->
                @else 
                @endif





            </div><!-- /.row -->
        </div><!-- /.sigin-in-->



        <br>
        @include('frontend.body.brands')
    </div>


    @endsection