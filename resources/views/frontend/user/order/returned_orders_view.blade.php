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
                                    <label for=""> Return ID</label>
                                </td>

                                <td class="col-md-1">
                                    <label for=""> Order ID</label>
                                </td>

                                <td class="col-md-3">
                                    <label for=""> Product name</label>
                                </td>

                                <td class="col-md-1">
                                    <label for="">Return date </label>
                                </td>


                                <td class="col-md-3">
                                    <label for=""> Return reason</label>
                                </td>



                                <td class="col-md-1">
                                    <label for=""> Return Status</label>
                                </td>



                            </tr>


                            @forelse($return_requests as $item)

                            @php
                            $product_name = App\Models\Product::where('id', $item->product_id)->get('product_name_en')->first();
                            @endphp
                            <tr>
                                <td class="col-md-1">
                                    <label for=""> {{$item->id}}</label>
                                </td>

                                <td class="col-md-1">
                                    <label for=""> {{$item->order_id}}</label>
                                </td>


                                <td class="col-md-3">
                                    <label for=""> {{ $product_name->product_name_en }}</label>
                                </td>

                                <td class="col-md-1">
                                    <label for=""> {{ Carbon\Carbon::parse($item->created_at)->toFormattedDateString()}}</label>
                                </td>

                                <td class="col-md-3">
                                    <label for=""> {{ $item->return_reason }}</label>
                                </td>

                                <td class="col-md-1">
                                    <label for="">

                                        @if($item->return_status == 'pending')
                                        <span class="badge badge-pill bg-warning" style="background:gold;">Pending </span>
                                        @elseif($item->return_status == 'approved')
                                        <span class="badge badge-pill bg-success" style="background:green;">Approved </span>
                                        @else
                                        <span class="badge badge-pill bg-danger" style="background:red;">Rejected </span>
                                        @endif



                                    </label>
                                </td>



                            </tr>
                            @empty
                            <h2 class="text-danger">No returned orders found</h2>

                            @endforelse





                        </tbody>



                    </table>

                </div>





            </div> <!-- / end col md 8 -->





        </div> <!-- // end row -->

    </div>

</div>


@endsection