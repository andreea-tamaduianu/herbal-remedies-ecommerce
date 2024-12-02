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
                        <h3 class="box-title">Contact list</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="table-responsive">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        
                                        <th>Address</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        
                                        <th>Action</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($contacts as $item)
                                    <tr>
                                       
                                        <td width="40%"> {{ $item->address }}</td>
                                        <td width="15%">{{ $item->email }}</td>
                                        <td width="15%"> {{ $item->phone }} </td>
                                        
                                        
                                        <td width="30%">
                                            <a href="{{ route('contact.edit',$item->id) }}" class="btn btn-info" title="Edit"><i class="fa fa-pencil"></i> </a>
                                            <a href="{{ route('contact.delete',$item->id) }}" class="btn btn-danger" title="Delete" id="delete">
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


            <!--   ------------ Add Category Page -------- -->


            <div class="col-4">

                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Add contact </h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="table-responsive">


                            <form method="post" action="{{ route('contact.store') }}" enctype="multipart/form-data">
                                @csrf

                                <div class="form-group">
                                    <h5>Email <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="text" name="email" class="form-control" required>
                                        @error('email')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group">
                                    <h5>Phone <span class="text-danger">*</span></h5>
                                    <div class="controls"> 
                                        <input type="text" name="phone" class="form-control" required>
                                        @error('phone')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group">
                                    <h5>Address <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <textarea type="text" name="address" class="form-control" required rows="3"></textarea>
                                        @error('address')
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