@extends('frontend.main_master')
@section('content')



<div class="body-content">
    <div class="container">
        <div class="row">
            @include('frontend.common.user_sidebar')

            <div class="col-md-5">
                <div class="card">
                    <div class="card-header">
                        <h4>Shipping Details</h4>
                    </div>
                    <hr>
                    <div class="card-body" style="background: #E9EBEC;">
                        <table class="table">
                            <tr>
                                <th> Shipping name: </th>
                                <th> {{ $order->name }} </th>
                            </tr>

                            <tr>
                                <th> Shipping phone: </th>
                                <th> {{ $order->phone }} </th>
                            </tr>

                            <tr>
                                <th> Shipping email: </th>
                                <th> {{ $order->email }} </th>
                            </tr>

                            <tr>
                                <th> Country: </th>
                                <th> {{ $order->division->division_name }} </th>
                            </tr>

                            <tr>
                                <th> County: </th>
                                <th> {{ $order->district->district_name }} </th>
                            </tr>

                            <tr>
                                <th> City: </th>
                                <th>{{ $order->state->state_name }} </th>
                            </tr>

                            <tr>
                                <th> Zip code: </th>
                                <th> {{ $order->post_code }} </th>
                            </tr>
                            <tr>
                                <th> Address: </th>
                                <th> {{ $order->address }} </th>
                            </tr>

                            <tr>
                                <th> Order date: </th>
                                <th> {{Carbon\Carbon::parse($order->created_at)->toFormattedDateString()}} </th>
                            </tr>
                           
                            <tr>
                                <th> Delivered date: </th>
                                <th> {{Carbon\Carbon::parse($order->delivered_date)->toFormattedDateString()}} </th>
                            </tr>

                            @if($order->courier_name!=NULL)
                            <tr>
                                <th> Courier name: </th>
                                <th>{{ $order->courier_name }} </th>
                            </tr>
                            @endif

                            @if($order->tracking_number!=NULL)
                            <tr>
                                <th> Tracking number: </th>
                                <th>{{ $order->tracking_number }} </th>
                            </tr>
                            @endif

                        </table>


                    </div>

                </div>

            </div> <!-- // end col md -5 -->



            <div class="col-md-5">
                <div class="card">
                    <div class="card-header">
                        <h4>Order details
                            @if($order->status == 'pending' || $order->status == 'confirmed')<span style="float:right"> <a class="btn btn-primary" data-toggle="modal" data-target="#cancelModal">Cancel order</a></span>
                            <!-- Button trigger modal -->
                            @endif

                            @if($order->status == 'delivered')<span style="float:right"> <a class="btn btn-primary" data-toggle="modal" data-target="#returnModal">Return order</a></span>
                            <!-- Button trigger modal -->
                            @endif
                        </h4>




                    </div>
                    <hr>
                    <div class="card-body" style="background: #E9EBEC;">
                        <table class="table">
                            <tr>
                                <th> Invoice: </th>
                                <th class="text-danger"> {{ $order->invoice_no }} </th>
                            </tr>
                            @if($order->transaction_id!=NULL)
                            <tr>
                                <th> Transaction ID: </th>
                                <th> {{ $order->transaction_id }} </th>
                            </tr>
                            @endif
                            <tr>
                                <th> Name: </th>
                                <th> {{ $order->user->name }} </th>
                            </tr>

                            <tr>
                                <th> Phone: </th>
                                <th> {{ $order->user->phone }} </th>
                            </tr>

                            <tr>
                                <th> Payment method:</th>
                                <th> {{ $order->payment_method }} </th>
                            </tr>
                            @if($order->coupon_name!=NULL)
                            <tr>
                                <th> Coupon name: </th>
                                <th>{{ $order->coupon_name }} ( {{$order->coupon_discount}}% ) </th>
                            </tr>
                            <tr>
                                <th> Discount: </th>
                                <th>${{ $order->amount*$order->coupon_discount/100 }} </th>
                            </tr>
                            @endif
                            <tr>
                                <th> Order total: </th>
                                <th>${{ $order->amount }} </th>
                            </tr>

                            <tr>
                                <th> Status: </th>
                                <th>
                                    @if($order->status == 'pending')
                                    <span class="badge badge-pill badge-warning" style="background: #800080;"> Pending </span>
                                    @elseif($order->status == 'confirmed')
                                    <span class="badge badge-pill badge-warning" style="background: #0000FF;"> Confirmed </span>

                                    @elseif($order->status == 'processing')
                                    <span class="badge badge-pill badge-warning" style="background: #FFA500;"> Processing </span>

                                    @elseif($order->status == 'picked')
                                    <span class="badge badge-pill badge-warning" style="background: #808000;"> Picked </span>

                                    @elseif($order->status == 'shipped')
                                    <span class="badge badge-pill badge-warning" style="background: #808080;"> Shipped </span>

                                    @elseif($order->status == 'delivered')
                                    <span class="badge badge-pill badge-warning" style="background: #008000;"> Delivered </span>

                                    
                                    @else
                                    <span class="badge badge-pill badge-warning" style="background: #FF0000;"> Cancelled </span>

                                    @endif
                                </th>
                            </tr>

                            @if($order->cancellation_reason!=NULL)
                            <tr>
                                <th> Cancellation reason:  </th>
                                <th>{{ $order->cancellation_reason }} </th>
                            </tr>
                            @endif

                        </table>


                    </div>

                </div>

            </div> <!-- // 2ND end col md -5 -->


            <div class="row">



                <div class="col-md-12">
                    <h4>Order products
                    </h4>
                    <div class="table-responsive">
                        <table class="table">
                            <tbody>

                                <tr style="background: #e2e2e2;">
                                    <td class="col-md-1">
                                        <label for=""> Image</label>
                                    </td>

                                    <td class="col-md-3">
                                        <label for=""> Product name </label>
                                    </td>

                                    <td class="col-md-2">
                                        <label for=""> Product code</label>
                                    </td>




                                    <td class="col-md-1">
                                        <label for=""> Size </label>
                                    </td>

                                    <td class="col-md-1">
                                        <label for=""> Quantity </label>
                                    </td>

                                    <td class="col-md-3">
                                        <label for=""> Price </label>
                                    </td>
                                    <td class="col-md-2">
                                        <label for=""> Discount </label>
                                    </td>

                                    <td class="col-md-1">
                                        <label for=""> Total </label>
                                    </td>

                                    <td class="col-md-1">
                                        <label for=""> Item status </label>
                                    </td>

                                </tr>


                                @foreach($orderItem as $item)
                                <tr>
                                    <td class="col-md-1">
                                        <label for=""><img src="{{ asset($item->product->product_thumbnail) }}" height="50px;" width="50px;"> </label>
                                    </td>

                                    <td class="col-md-3">
                                        <label for=""> {{ $item->product->product_name_en }}</label>
                                    </td>


                                    <td class="col-md-2">
                                        <label for=""> {{ $item->product->product_code }}</label>
                                    </td>



                                    <td class="col-md-1">
                                        <label for=""> {{ $item->size }}</label>
                                    </td>

                                    <td class="col-md-1">
                                        <label for=""> {{ $item->qty }}</label>
                                    </td>

                                    <td class="col-md-3">
                                        <label for=""> ${{ $item->price }} ( ${{ $item->price}} x {{$item->qty}} ) </label>
                                    </td>
                                    <td class="col-md-3">
                                        <label for=""> ${{ $item->price*$item->qty*$order->coupon_discount/100}}</label>
                                    </td>
                                    <td class="col-md-3">
                                        <label for=""> ${{ $item->price*(1-$order->coupon_discount/100) * $item->qty }}</label>
                                    </td>

                                    <td class="col-md-3">
                                    @if($item->item_status == 'return rejected')
                                    <span class="badge badge-pill badge-warning" style="background:red;">{{ $item->item_status }} </span>
                                    @elseif($item->item_status == 'return initiated')  
                                    <span class="badge badge-pill badge-warning" style="background:blue;">{{ $item->item_status }} </span>
                                    @else
                                    <span class="badge badge-pill badge-warning" style="background:green;">{{ $item->item_status }} </span>
                                    @endif
                                    </td>





                                </tr>
                                @endforeach





                            </tbody>

                        </table>

                    </div>


                </div> <!-- / end col md 8 -->

            </div> <!-- // END ORDER ITEM ROW -->

           
            <br><br>




        </div> <!-- // end row -->

    </div>

</div>




<!-- Cancel Modal -->
<div class="modal fade" id="cancelModal" tabindex="-1" role="dialog" aria-labelledby="cancelModalLabel" aria-hidden="true">
    <form method="post" action="{{route('cancel.order',$order_id)}}">
        @csrf
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="cancelModalLabel">Reason for order cancellation</h5>

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <select name="cancellation_reason" id="cancelReason" required="">
                        <option value="">Select Reason</option>
                        <option value="Order created by mistake">Order created by mistake</option>
                        <option value="Shipping cost is too high">Shipping cost is too high</option>
                        <option value="Order takes too long to arrive">Order takes too long to arrive</option>
                        <option value="Found cheaper somewhere else">Found cheaper somewhere else</option>

                    </select>
                    @error('cancellation_reason')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Cancel order</button>
                </div>
            </div>
        </div>
    </form>
</div>

<!-- Return Modal -->
 <div class="modal fade" id="returnModal" tabindex="-1" role="dialog" aria-labelledby="returnModalLabel" aria-hidden="true">
    <form method="post" action="{{route('return.order',$order_id)}}">
        @csrf
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="returnModalLabel">Reason for return</h4>

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                <h5>Choose product <span class="text-danger">*</span></h5>
                    <select name="product_info" id="returnProduct" required="">
                        <option value="">Select Product</option>
                        @foreach($orderItem as $item)
                        @if($item->item_status=='return initiated')
                        @else
                        <option value="{{$item->product->product_code}}-{{$item->product->product_name_en}}">{{$item->product->product_code}}-{{$item->product->product_name_en}}</option>
                        @endif
                        @endforeach

                    </select>
                    @error('product_info')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="modal-body">
                <h5>Choose reason <span class="text-danger">*</span></h5>
                    <select name="return_reason" id="returnReason" required="">
                        <option value="">Select Reason</option>
                        <option value="Quality is not adequate">Quality is not adequate</option>
                        <option value="Product is damaged, but shipping box is OK">Product is damaged, but shipping box is OK</option>
                        <option value="Item arrived too late">Item arrived too late</option>
                        <option value="Wrong item was sent">Wrong item was sent</option>

                    </select>
                    @error('return_reason')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="modal-body">
                <h5>Add comment </h5>
                    <textarea name="comment" placeholder="Comments" rows="5" cols="40"></textarea>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Return product</button>
                </div>
            </div>
        </div>
    </form>
</div> 


@endsection