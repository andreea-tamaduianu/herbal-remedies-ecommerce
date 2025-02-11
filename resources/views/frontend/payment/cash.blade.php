@extends('frontend.main_master')
@section('content')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

@section('title')
Cash On Delivery
@endsection




<div class="breadcrumb">
    <div class="container">
        <div class="breadcrumb-inner">
            <ul class="list-inline list-unstyled">
            <li><a href="{{ url('/') }}">Home</a></li>
                <li class='active'>Cash on delivery</li>
            </ul>
        </div><!-- /.breadcrumb-inner -->
    </div><!-- /.container -->
</div><!-- /.breadcrumb -->




<div class="body-content">
    <div class="container">
        <div class="checkout-box ">
            <div class="row">





            <div class="col-md-6">
                    <!-- checkout-progress-sidebar -->
                    <div class="checkout-progress-sidebar ">
                        <div class="panel-group">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="unicase-checkout-title">Order summary </h4>
                                </div>
                                <div class="">
                                    <ul class="nav nav-checkout-progress list-unstyled">



                                        <li>
                                            @if(Session::has('coupon'))

                                            <strong>Subtotal: </strong> ${{ $subtotal_amount}}
                                            <hr>

                                            <strong>Of which taxes: </strong> ${{ $tax_amount }}
                                            <hr>
                                            <strong>Shipping taxes: </strong> $0
                                            <hr>
                                            <strong>Total without discount: </strong> ${{ $cartTotal }}
                                            <hr>

                                            <strong>Coupon name : </strong> {{ session()->get('coupon')['coupon_name'] }}
                                            (  - {{ session()->get('coupon')['coupon_discount'] }} % )
                                            <hr>

                                            <strong>Discount : </strong>  - ${{ session()->get('coupon')['discount_amount'] }}
                                            <hr>

                                            <strong>Grand total : </strong> ${{ session()->get('coupon')['total_amount'] }}
                                            <hr>


                                            @else

                                            <strong>Subtotal: </strong> ${{ $subtotal_amount }}
                                            <hr>
                                            <strong>Of which taxes: </strong> ${{ $tax_amount }}
                                            <hr>
                                            <strong>Shipping taxes: </strong> $0
                                            <hr>

                                            <strong>Grand total : </strong> ${{ $cartTotal }}
                                            <hr>


                                            @endif

                                        </li>



                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- checkout-progress-sidebar -->
                </div> <!--  // end col md 6 -->







                <div class="col-md-6">
                    <!-- checkout-progress-sidebar -->
                    <div class="checkout-progress-sidebar ">
                        <div class="panel-group">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="unicase-checkout-title">Select Payment Method</h4>
                                </div>

                                <form action="{{ route('cash.order') }}" method="post" id="payment-form">
                                    @csrf
                                    <div class="form-row">

                                        <img src="{{ asset('frontend/assets/images/payments/cash.png') }}">

                                        <label for="card-element">

                                            <input type="hidden" name="name" value="{{ $data['shipping_name'] }}">
                                            <input type="hidden" name="email" value="{{ $data['shipping_email'] }}">
                                            <input type="hidden" name="phone" value="{{ $data['shipping_phone'] }}">
                                            <input type="hidden" name="post_code" value="{{ $data['post_code'] }}">
                                            <input type="hidden" name="division_id" value="{{ $data['division_id'] }}">
                                            <input type="hidden" name="district_id" value="{{ $data['district_id'] }}">
                                            <input type="hidden" name="state_id" value="{{ $data['state_id'] }}">
                                            <input type="hidden" name="notes" value="{{ $data['notes'] }}">
                                            <input type="hidden" name="address" value="{{ $data['address'] }}">

                                        </label>




                                    </div>
                                    <br>
                                    <button class="btn btn-primary">Submit Payment</button>
                                </form>



                            </div>
                        </div>
                    </div>
                    <!-- checkout-progress-sidebar -->
                </div><!--  // end col md 6 -->







                </form>
            </div><!-- /.row -->
        </div><!-- /.checkout-box -->
        <!-- === ===== BRANDS CAROUSEL ==== ======== -->








        <!-- ===== == BRANDS CAROUSEL : END === === -->
    </div><!-- /.container -->
</div><!-- /.body-content -->








@endsection