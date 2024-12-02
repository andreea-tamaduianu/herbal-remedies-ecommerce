@extends('admin.admin_master')
@section('admin')


<!-- Content Wrapper. Contains page content -->

<div class="container-full">
    <!-- Content Header (Page header) -->


    <!-- Main content -->
    <section class="content">
        <div class="row">



            <div class="col-12">

                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Pending product return requests</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="table-responsive">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Order ID </th>
                                        <th>User ID </th>
                                        <th>Product name </th>
                                        <th>Product code </th>
                                        <th>Return reason </th>

                                        <th>Comment </th>
                                        <th>Date </th>
                                        <th>Return Status </th>
                                        <th>Approve/Reject </th>


                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($return_requests as $item)

                                    @php
                                    $product_code = App\Models\Product::where('id', $item->product_id)->get('product_code')->first();
                                    $product_name = App\Models\Product::where('id', $item->product_id)->get('product_name_en')->first();
                                    @endphp
                                    <tr>
                                        <td width="2%"><a href="{{url('orders/pending/orders/details/'.$item->order_id)}}">{{$item->order_id}}</a> </td>
                                        <td width="2%"> {{ $item->user_id }} </td>
                                        <td width="20%"> {{ $product_name->product_name_en }} </td>

                                        <td width="5%"> {{ $product_code->product_code }} </td>
                                        <td width="10%"> {{ $item->return_reason }} </td>

                                        <td width="20%"> {{ $item->comment }} </td>
                                        <td> {{ Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $item->created_at)->format('d F Y') }} </td>
                                        <td>
                                            @if($item->return_status == 'pending')
                                            <span class="badge badge-pill badge-warning">Pending </span>
                                            @elseif($item->return_status == 'approved')
                                            <span class="badge badge-pill badge-success">Approved </span>
                                            @else
                                            <span class="badge badge-pill badge-danger">Rejected </span>
                                            @endif

                                        </td>
                                        <td width="25%">
                                            <form method="post" class="form-inline" action="{{url('return/admin/return-requests/update')}}">
                                                @csrf
                                                <div class="row">

                                                    <input type="hidden" name="return_id" value="{{$item->id}}" />
                                                    <select class="form-control" name="return_status">
                                                        <option @if($item->return_status=='approved') selected="" @endif value="approved">Approved</option>
                                                        <option @if($item->return_status=='rejected') selected="" @endif value="rejected">Rejected</option>
                                                        <option @if($item->return_status=='pending') selected="" @endif value="pending">Pending</option>
                                                    </select><br>
                                                    <input type="submit" name="" value="Update"  />
                                                </div>
                                            </form>
                                        </td>

                                    </tr>
                                    @endforeach
                                </tbody>

                            </table>
                        </div>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->


            </div>
            <!-- /.col -->






        </div>
        <!-- /.row -->
    </section>
    <!-- /.content -->

</div>




@endsection