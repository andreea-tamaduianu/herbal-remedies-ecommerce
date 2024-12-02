@extends('frontend.main_master')
@section('content')

<div class="body-content">
    <div class="container">
        <div class="row">
            @include('frontend.common.user_sidebar')

            <div class="col-md-1">
            </div>

            <div class="col-md-8">

                <div class="table-responsive">
                    <table class="table table-bordered">
                        <tbody>

                            <tr style="background: #e2e2e2;">
                                <td >
                                    <label for=""> Date</label>
                                </td>

                                <td >
                                    <label for=""> Total</label>
                                </td>

                                <td >
                                    <label for=""> Payment method</label>
                                </td>


                                <td >
                                    <label for=""> Invoice</label>
                                </td>

                                <td >
                                    <label for=""> Order</label>
                                </td>

                                <td >
                                    <label for=""> Action </label>
                                </td>

                            </tr>


                            @foreach($orders as $order)
                            <tr>
                                <td >
                                    <label for=""> {{ Carbon\Carbon::parse($order->created_at)->toFormattedDateString()}}</label>
                                </td>

                                <td >
                                    <label for=""> ${{ $order->amount }}</label>
                                </td>


                                <td >
                                    <label for=""> {{ $order->payment_method }}</label>
                                </td>

                                <td >
                                    <label for=""> {{ $order->invoice_no }}</label>
                                </td>

                                <td >
                                    <label for="">

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
                                    </label>
                                </td>

                                <td >
                                    <a href="{{ url('user/order-details/'.$order->id ) }}" class="btn btn-sm btn-primary"><i class="fa fa-eye"></i> View</a>
                                    @if($order->status == 'delivered')
                                    <a target="_blank" href="{{ url('user/invoice-download/'.$order->id ) }}" class="btn btn-sm btn-danger" style="margin-top: 5px;"><i class="fa fa-download" style="color: white;"></i> Invoice </a>
                                    @endif
                                </td>

                            </tr>
                            @endforeach





                        </tbody>

                    </table>

                </div>





            </div> <!-- / end col md 8 -->





        </div> <!-- // end row -->

    </div>

</div>


@endsection