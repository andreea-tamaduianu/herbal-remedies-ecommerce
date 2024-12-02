@extends('admin.admin_master')
@section('admin')


<!-- Content Wrapper. Contains page content -->

<div class="container-full">
    <!-- Content Header (Page header) -->


    <!-- Main content -->
    <section class="content">
        <div class="row">





            <!--   ------------ Add Category Page -------- -->


            <div class="col-12">

                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Edit currency </h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="table-responsive">


                            <form method="post" action="{{ route('currency.update',$currency->id) }}" enctype="multipart/form-data">
                            @csrf
                                <input type="hidden" name="id" value="{{ $currency->id }}">
                               


                                <div class="form-group">
                                    <h5>Currency code <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="text" name="currency_code" class="form-control" required value="{{$currency->currency_code}}">
                                        @error('currency_code')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>


                                <div class="form-group">
                                    <h5>Exchange rate <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="text" name="exchange_rate" class="form-control" required value="{{$currency->exchange_rate}}">
                                        @error('exchange_rate')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="text-xs-right">
                                    <input type="submit" class="btn btn-rounded btn-primary mb-5" value="Save">
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