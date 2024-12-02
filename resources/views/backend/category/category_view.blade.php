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
                        <h3 class="box-title">Category list <span class="badge badge-pill badge-danger"> {{ count($category) }} </span></h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="table-responsive">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Icon </th>
                                        <th>Category En</th>
                                        <th>Category Ro </th>
                                        <th>Discount</th>
                                        <th>Image</th>
                                        <th>Action</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($category as $item)
                                    <tr>
                                        <td width="5%"> <span><i class="{{ $item->category_icon }}"></i></span> </td>
                                        <td width="20%"> {{ $item->category_name_en }}</td>
                                        <td width="20%">{{ $item->category_name_ro }}</td>
                                        <td width="5%"> 
                                        @if($item->category_discount!=NULL)
                                        {{ $item->category_discount }}
                                        @else
                                        -
                                        @endif
                                        </td>
                                        <td width="15%"><img src="{{ asset($item->category_image) }}" style="width: 70px; height: 40px;"> </td>
                                        
                                        <td width="30%">
                                            <a href="{{ route('category.edit',$item->id) }}" class="btn btn-info" title="Edit"><i class="fa fa-pencil"></i> </a>
                                            <a href="{{ route('category.delete',$item->id) }}" class="btn btn-danger" title="Delete" id="delete">
                                                <i class="fa fa-trash"></i></a>
                                            @if($item->category_status == 1)
                                            <a href="{{ route('category.inactive',$item->id) }}" class="btn btn-danger" title="Inactive Now"><i class="fa fa-arrow-down"></i> </a>
                                            @else
                                            <a href="{{ route('category.active',$item->id) }}" class="btn btn-success" title="Active Now"><i class="fa fa-arrow-up"></i> </a>
                                            @endif
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


            <!--   ------------ Add Category Page -------- -->


            <div class="col-4">

                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Add category </h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="table-responsive">


                            <form method="post" action="{{ route('category.store') }}" enctype="multipart/form-data">
                                @csrf


                                <div class="form-group">
                                    <h5>Category English <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="text" name="category_name_en" class="form-control">
                                        @error('category_name_en')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>


                                <div class="form-group">
                                    <h5>Category Romanian <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="text" name="category_name_ro" class="form-control">
                                        @error('category_name_ro')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group">
                                    <h5>Category discount <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="text" name="category_discount" class="form-control">
                                        @error('category_discount')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>


                                <div class="form-group">
                                    <h5>Category icon <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="text" name="category_icon" class="form-control">
                                        @error('category_icon')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group">
                                    <h5>Category image <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="file" name="category_image" class="form-control">
                                        @error('category_image')
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