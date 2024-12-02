@extends('admin.admin_master')
@section('admin')


<!-- Content Wrapper. Contains page content -->

<div class="container-full">
    <!-- Content Header (Page header) -->


    <div class="content-header">
        <div class="d-flex align-items-center">
            <div class="mr-auto">
                <h3 class="page-title">Order details</h3>
                <div class="d-inline-block align-items-center">

                </div>
            </div>
        </div>
    </div>



    <!-- Main content -->
    <section class="content">
        <div class="row">


            <div class="col-md-6 col-12">
                <div class="box box-bordered border-primary">
                    <div class="box-header with-border">
                        <h4 class="box-title"><strong>Shipping Details</strong> </h4>
                    </div>


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
                            <th> Order date: </th>
                            <th> {{ $order->created_at->toDayDateTimeString() }} </th>
                        </tr>

                    </table>

                    <div class="box-header with-border">
                        <h4 class="box-title"><strong>Order status history</strong> </h4>
                    </div>

                    <table class="table">
                        @if($order->created_at!=NULL)
                        <tr>
                            <th> Pending: </th>
                            <th> {{ Carbon\Carbon::parse($order->created_at)->toDayDateTimeString() }} </th>
                        </tr>
                        @endif

                       

                        @if($order->cancel_date!=NULL)
                        <tr>
                            <th> Cancelled: </th>
                            <th> {{ Carbon\Carbon::parse($order->cancel_date)->toDayDateTimeString() }} </th>
                        </tr>
                        @endif

                        @if($order->confirmed_date!=NULL)
                        <tr>
                            <th> Confirmed: </th>
                            <th> {{ Carbon\Carbon::parse($order->confirmed_date)->toDayDateTimeString() }} </th>
                        </tr>
                        @endif

                        @if($order->processing_date!=NULL)
                        <tr>
                            <th> Processing: </th>
                            <th> {{ Carbon\Carbon::parse($order->processing_date)->toDayDateTimeString() }} </th>
                        </tr>
                        @endif

                        @if($order->picked_date!=NULL)
                        <tr>
                            <th> Picked: </th>
                            <th> {{ Carbon\Carbon::parse($order->picked_date)->toDayDateTimeString() }} </th>
                        </tr>
                        @endif

                        @if($order->shipped_date!=NULL)
                        <tr>
                            <th> Shipped: </th>
                            <th> {{ Carbon\Carbon::parse($order->shipped_date)->toDayDateTimeString() }} </th>
                        </tr>
                        @endif

                        @if($order->delivered_date!=NULL)
                        <tr>
                            <th> Delivered: </th>
                            <th> {{ Carbon\Carbon::parse($order->delivered_date)->toDayDateTimeString() }} </th>
                        </tr>
                        @endif

                        

                       

                    </table>

                </div>
            </div> <!--  // cod md -6 -->


            <div class="col-md-6 col-12">
                <div class="box box-bordered border-primary">
                    <div class="box-header with-border">
                        <h4 class="box-title"><strong>Order details</strong></h4>
                    </div>


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
                        <tr>
                            <th> Order total: </th>
                            <th>${{ $order->amount }} </th>
                        </tr>
                        @endif

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
                        <tr>
                            <th> Status: </th>
                            <th>
                                <span class="badge badge-pill badge-warning" style="background: #418DB9;">{{ $order->status }} </span>
                            </th>
                        </tr>

                        @if($order->status=="user cancelled")
                        <tr>
                            <th> Cancellation reason: </th>
                            <th>{{ $order->cancellation_reason }} </th>
                        </tr>
                        @endif

                        @if($order->status == 'picked')
                        <tr>
                            <form method="post" action="{{ route('update.shipping.information') }}">
                                @csrf
                                <input type="hidden" name="order_id" value="{{ $order->id }}">
                                <input type="hidden" name="order_email" value="{{ $order->email }}">
                                <th>
                                    <h5>Courier name <span class="text-danger">*</span></h5>
                                    <input type="text" name="courier_name" class="form-control" required="" value="{{$order->courier_name }}">


                                </th>
                                <th>
                                    <h5>Tracking number<span class="text-danger">*</span></h5>
                                    <input type="text" name="tracking_number" class="form-control" required="" value="{{$order->tracking_number }}">
                                </th>
                                <th> <input type="submit" class="btn btn-rounded btn-primary mb-5" value="Update"></th>
                            </form>

                        </tr>
                        @endif
                        <tr>
                            <th> </th>
                            <th>
                                @if($order->status == 'pending')
                                <a href="{{ route('pending.confirm',$order->id) }}" class="btn btn-block btn-success" id="confirm">Confirm order</a>
                                <a href="{{ route('cancelled',$order->id) }}" class="btn btn-block btn-danger" id="cancelled">Cancel order</a>

                                @elseif($order->status == 'confirmed')
                                <a href="{{ route('confirm.processing',$order->id) }}" class="btn btn-block btn-success" id="processing">Process order</a>

                                @elseif($order->status == 'processing')
                                <a href="{{ route('processing.picked',$order->id) }}" class="btn btn-block btn-success" id="picked">Pick order</a>

                                @elseif($order->status == 'picked')
                                @if($order->courier_name==NULL || $order->tracking_number==NULL)
                                <a href="{{ route('picked.shipped',$order->id) }}" class="btn btn-block btn-success" id="shipped" style="pointer-events:none;">Ship order</a>
                                @else
                                <a href="{{ route('picked.shipped',$order->id) }}" class="btn btn-block btn-success" id="shipped" >Ship order</a>
                                @endif

                                @elseif($order->status == 'shipped')                                
                                <a href="{{ route('shipped.delivered',$order->id) }}" class="btn btn-block btn-success" id="delivered" >Deliver order</a>
                              

                                @endif

                            </th>
                        </tr>



                    </table>



                </div>
            </div> <!--  // cod md -6 -->


            
            <div class="col-md-12 col-12">
                <div class="box box-bordered border-primary">
                    <div class="box-header with-border">
                        <h4 class="box-title"><strong>Order products</strong></h4>
                    </div>



                    <table class="table">
                        <tbody>

                            <tr>
                                <td width="10%">
                                    <label for=""> Image</label>
                                </td>

                                <td width="20%">
                                    <label for=""> Product name </label>
                                </td>

                                <td width="10%">
                                    <label for=""> Product code</label>
                                </td>




                                <td width="10%">
                                    <label for=""> Size </label>
                                </td>

                                <td width="10%">
                                    <label for=""> Quantity </label>
                                </td>

                                <td width="20%">
                                    <label for=""> Price </label>
                                </td>

                                <td width="20%">
                                    <label for=""> Item status </label>
                                </td>

                            </tr>


                            @foreach($orderItem as $item)
                            <tr>
                                <td width="10%">
                                    <label for=""><img src="{{ asset($item->product->product_thumbnail) }}" height="50px;" width="50px;"> </label>
                                </td>

                                <td width="20%">
                                    <label for=""> {{ $item->product->product_name_en }}</label>
                                </td>


                                <td width="10%">
                                    <label for=""> {{ $item->product->product_code }}</label>
                                </td>



                                <td width="10%">
                                    <label for=""> {{ $item->size }}</label>
                                </td>

                                <td width="10%">
                                    <label for=""> {{ $item->qty }}</label>
                                </td>

                                <td width="20%">
                                    <label for=""> ${{ $item->price }} ( ${{ $item->price}} x {{$item->qty}} ) </label>
                                </td>

                                <td width="10%">
                                    <label for=""> {{ $item->item_status }}</label>
                                </td>

                            </tr>
                            @endforeach





                        </tbody>

                    </table>











                </div>
            </div> <!--  // cod md -12 -->
















        </div>
        <!-- /. end row -->
    </section>
    <!-- /.content -->

</div>




@endsection