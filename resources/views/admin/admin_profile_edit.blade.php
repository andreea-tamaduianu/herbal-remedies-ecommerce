@extends('admin.admin_master')
@section('admin')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<div class="container-full">

    <section class="content">

        <!-- Basic Forms -->
        <div class="box">
            <div class="box-header with-border">
                <h4 class="box-title">Edit admin profile </h4>

            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div class="row">
                    <div class="col">
                        <form method="post" action="{{ route('admin.profile.update') }}" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="id" value="{{ $editData->id }}">
                            <input type="hidden" name="old_image" value="{{ $editData->profile_photo_path }}">
                            <div class="row">
                                <div class="col-12">

                                    <div class="row">
                                        <div class="col-md-6">

                                            <div class="form-group">
                                                <h5>Admin user name <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="text" name="name" class="form-control" required="" value="{{ $editData->name }}">
                                                </div>
                                            </div>

                                        </div> <!-- end cold md 6 -->



                                        <div class="col-md-6">

                                            <div class="form-group">
                                                <h5>Admin email <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="email" name="email" class="form-control" required="" value="{{ $editData->email }}">
                                                </div>
                                            </div>

                                        </div> <!-- end cold md 6 -->

                                    </div> <!-- end row 	 -->


                                    <div class="row">

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <h5>Profile image <span class="text-danger"></span></h5>
                                                <div class="controls">
                                                    <input type="file" name="profile_photo_path" class="form-control"  id="image">
                                                </div>
                                            </div>
                                        </div><!-- end cold md 6 -->

                                        <div class="col-md-6">
                                            <img id="showImage" src="{{ asset($editData->profile_photo_path) }}" style="width: 100px; height: 100px;">

                                        </div><!-- end cold md 6 -->




                                    </div><!-- end row 	 -->








                                    <div class="text-xs-right">
                                        <input type="submit" class="btn btn-rounded btn-primary mb-5" value="Save">
                                    </div>
                        </form>

                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->

    </section>



</div>


<script type="text/javascript">
    $(document).ready(function() {
        $('#image').change(function(e) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#showImage').attr('src', e.target.result);
            }
            reader.readAsDataURL(e.target.files['0']);
        });
    });
</script>


@endsection