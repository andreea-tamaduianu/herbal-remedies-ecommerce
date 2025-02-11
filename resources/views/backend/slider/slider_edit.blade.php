@extends('admin.admin_master')
@section('admin')


<!-- Content Wrapper. Contains page content -->

<div class="container-full">
    <!-- Content Header (Page header) -->


    <!-- Main content -->
    <section class="content">
        <div class="row">






            <!--   ------------ Edit Slider Page -------- -->


            <div class="col-12">

                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Edit slider </h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="table-responsive">


                            <form method="post" action="{{ route('slider.update') }}" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="id" value="{{ $sliders->id }}">
                                <input type="hidden" name="old_image" value="{{ $sliders->slider_image }}">

                                <div class="form-group">
                                    <h5>Slider title <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="text" name="title" class="form-control" value="{{ $sliders->title }}">

                                    </div>
                                </div>


                                <div class="form-group">
                                    <h5>Slider description <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="text" name="description" class="form-control" value="{{ $sliders->description }}">

                                    </div>
                                </div>

                                <div class="form-group">
                                    <h5>Slider link <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="text" name="link" class="form-control" value="{{ $sliders->link }}">
                                       
                                    </div>
                                </div>



                                <div class="form-group">
                                    <h5>Slider image <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="file" name="slider_image" class="form-control">
                                        @error('slider_image')
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