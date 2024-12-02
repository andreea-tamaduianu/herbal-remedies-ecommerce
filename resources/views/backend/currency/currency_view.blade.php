@extends('admin.admin_master')
@section('admin')


<!-- Content Wrapper. Contains page content -->

<div class="container-full">
    <!-- Content Header (Page header) -->


    <!-- Main content -->
    <section class="content">
        <div class="row">



            <div class="col-8">

                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Currency list <span class="badge badge-pill badge-danger"> {{ count($currencies) }} </span></h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="table-responsive">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Code </th>
                                        <th>Exchange rate</th>
                                        
                                        <th>Actions</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($currencies as $item)
                                    <tr>
                                        <td>{{ $item->currency_code }}</td>
                                        <td>{{ $item->exchange_rate }}</td>
                                        
                                        <td>
                                        @if($item->status == 1)                                           
                                            <a href="{{ route('currency.inactive',$item->id) }}"  title="Active"><i class="fa fa-toggle-on"></i> </a>
                                            @else
                                            <a href="{{ route('currency.active',$item->id) }}"  title="Inactive"><i class="fa fa-toggle-off"></i> </a>
                                            @endif
                                            &nbsp;&nbsp;
                                            <a href="{{ route('currency.edit',$item->id) }}"  title="Edit"><i class="fa fa-pencil"></i> </a>
                                            &nbsp;&nbsp;
                                            <a href="{{ route('currency.delete',$item->id) }}"  title="Delete" id="delete">
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


            <!--   ------------ Add Brand Page -------- -->


            <div class="col-4">

                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Add currency </h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="table-responsive">


                            <form method="post" action="{{ route('currency.store') }}" enctype="multipart/form-data">
                                @csrf


                                <div class="form-group">
                                    <h5>Currency code <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="text" name="currency_code" class="form-control" required>
                                        @error('currency_code')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>


                                <div class="form-group">
                                    <h5>Exchange rate <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="text" name="exchange_rate" class="form-control" required>
                                        @error('exchange_rate')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>



                               

                                <div class="text-xs-right">
                                    <input type="submit" class="btn btn-rounded btn-primary mb-5" value="Add">
                                </div>
                            </form>





                        </div>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>




        </div>
        <!-- /.row -->
    </section>
    <!-- /.content -->

</div>




@endsection