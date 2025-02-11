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
                    <table class="table">
                        <tbody>

                            <tr style="background: #e2e2e2;">
                                <td class="col-md-1">
                                    <label for=""> Date</label>
                                </td>

                                <td class="col-md-3">
                                    <label for=""> Total</label>
                                </td>

                                <td class="col-md-3">
                                    <label for=""> Payment method</label>
                                </td>


                                <td class="col-md-2">
                                    <label for=""> Invoice</label>
                                </td>

                                <td class="col-md-2">
                                    <label for=""> Order status</label>
                                </td>

                                <td class="col-md-1">
                                    <label for=""> Action </label>
                                </td>

                            </tr>


                            @forelse($orders as $order)
                            <tr>
                                <td class="col-md-1">
                                    <label for=""> {{ Carbon\Carbon::parse($order->created_at)->toFormattedDateString()}}</label>
                                </td>

                                <td class="col-md-3">
                                    <label for=""> ${{ $order->amount }}</label>
                                </td>


                                <td class="col-md-3">
                                    <label for=""> {{ $order->payment_method }}</label>
                                </td>

                                <td class="col-md-2">
                                    <label for=""> {{ $order->invoice_no }}</label>
                                </td>

                                <td class="col-md-2">
                                    <label for="">
                                        <span class="badge badge-pill badge-warning" style="background: #418DB9;">{{ $order->status }} </span>

                                    </label>
                                </td>

                                <td class="col-md-1">
                                    <a href="{{ url('user/order-details/'.$order->id ) }}" class="btn btn-sm btn-primary"><i class="fa fa-eye"></i> View</a>

                                    <a target="_blank" href="{{ url('user/invoice-download/'.$order->id ) }}" class="btn btn-sm btn-danger" style="margin-top: 5px;"><i class="fa fa-download" style="color: white;"></i> Invoice </a>

                                </td>

                            </tr>

                            @empty
                            <h2 class="text-danger">No cancelled orders found</h2>

                            @endforelse





                        </tbody>

                    </table>

                </div>





            </div> <!-- / end col md 8 -->





        </div> <!-- // end row -->

    </div>

</div>


@endsection