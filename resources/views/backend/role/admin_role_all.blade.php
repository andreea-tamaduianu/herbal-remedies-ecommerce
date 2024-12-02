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
                        <h3 class="box-title">Admin user list </h3>
                        <a href="{{ route('add.admin') }}" class="btn btn-danger" style="float: right;">Add Admin user</a>

                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="table-responsive">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Image </th>
                                        <th>Name </th>
                                        <th>Email </th>
                                        <th>Access </th>
                                        <th>Action</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($adminuser as $item)
                                    <tr>
                                        <td> <img src="{{ asset($item->profile_photo_path) }}" style="width: 50px; height: 50px;"> </td>
                                        <td> {{ $item->name }} </td>
                                        <td> {{ $item->email  }} </td>

                                        <td>
                                            @if($item->brand == 1)
                                            <span class="badge btn-primary">Brands</span>
                                            @else
                                            @endif

                                            @if($item->category == 1)
                                            <span class="badge btn-secondary">Categories</span>
                                            @else
                                            @endif


                                            @if($item->product == 1)
                                            <span class="badge btn-success">Products</span>
                                            @else
                                            @endif


                                            @if($item->slider == 1)
                                            <span class="badge btn-danger">Slider</span>
                                            @else
                                            @endif


                                            @if($item->coupon == 1)
                                            <span class="badge btn-warning">Coupons</span>
                                            @else
                                            @endif


                                            @if($item->shipping == 1)
                                            <span class="badge btn-info">Shipping</span>
                                            @else
                                            @endif


                                            @if($item->blog == 1)
                                            <span class="badge btn-light">Blog</span>
                                            @else
                                            @endif


                                            @if($item->setting == 1)
                                            <span class="badge btn-dark">Settings</span>
                                            @else
                                            @endif


                                            @if($item->return_orders == 1)
                                            <span class="badge btn-primary">Returned orders</span>
                                            @else
                                            @endif


                                            @if($item->review == 1)
                                            <span class="badge btn-secondary">Reviews</span>
                                            @else
                                            @endif


                                            @if($item->orders == 1)
                                            <span class="badge btn-success">Orders</span>
                                            @else
                                            @endif

                                            @if($item->stock == 1)
                                            <span class="badge btn-danger">Stock</span>
                                            @else
                                            @endif

                                            @if($item->review == 1)
                                            <span class="badge btn-secondary">Reviews</span>
                                            @else
                                            @endif


                                            @if($item->newsletter == 1)
                                            <span class="badge btn-success">Newsletter</span>
                                            @else
                                            @endif

                                            @if($item->currency == 1)
                                            <span class="badge btn-danger">Currency</span>
                                            @else
                                            @endif

                                            @if($item->mailbox == 1)
                                            <span class="badge btn-warning">Mailbox</span>
                                            @else
                                            @endif

                                            @if($item->user == 1)
                                            <span class="badge btn-info">Users</span>
                                            @else
                                            @endif

                                            @if($item->admin_user_role == 1)
                                            <span class="badge btn-dark">Admin user role</span>
                                            @else
                                            @endif


                                        </td>


                                        <td width="25%">
                                            <a href="{{ route('edit.admin.user',$item->id) }}" class="btn btn-info" title="Edit Data"><i class="fa fa-pencil"></i> </a>

                                            <a href="{{ route('delete.admin.user',$item->id) }}" class="btn btn-danger" title="Delete" id="delete">
                                                <i class="fa fa-trash"></i></a>
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