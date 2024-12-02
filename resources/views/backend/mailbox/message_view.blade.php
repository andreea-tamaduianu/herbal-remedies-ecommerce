@extends('admin.admin_master')
@section('admin')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="{{ asset('../assets/vendor_plugins/iCheck/icheck.js') }}"></script>

<script src="{{ asset('backend/js/pages/mailbox.js') }}"></script>
<script src="{{ asset('../assets/vendor_components/apexcharts-bundle/dist/apexcharts.js') }}"></script>
<script src="{{ asset('../assets/vendor_components/ckeditor/ckeditor.js') }}"></script>

<!-- Content Wrapper. Contains page content -->
<div class="container-full">

    <!-- left content -->


    <!-- right content -->
    <section class="content">

        <div class="row">
            <div class="box">
                <div class="box-body">
                    <div class="mailbox-controls with-border clearfix mt-15">
                        <div class="float-left">
                            <button type="button" class="btn btn-outline btn-sm" data-toggle="tooltip" title="" data-original-title="Print" disabled>
                                <i class="fa fa-print"></i></button>
                        </div>
                        <div class="float-right">
                            <div class="btn-group">
                                <button type="button" class="btn btn-outline btn-sm" data-toggle="tooltip" data-container="body" title="" data-original-title="Delete" disabled>
                                    <i class="fa fa-trash-o"></i></button>
                                <button type="button" class="btn btn-outline btn-sm" data-toggle="tooltip" data-container="body" title="" data-original-title="Reply" disabled>
                                    <i class="fa fa-reply"></i></button>
                                <button type="button" class="btn btn-outline btn-sm" data-toggle="tooltip" data-container="body" title="" data-original-title="Forward" disabled>
                                    <i class="fa fa-share"></i></button>
                            </div>
                        </div>
                        <!-- /.btn-group -->

                    </div>
                    <!-- /.mailbox-controls -->
                    <div class="mailbox-read-info">
                        <h3>{{$message->subject}}</h3>
                    </div>
                    <div class="mailbox-read-info bb-0 clearfix">
                        <div class="float-left mr-5"><a href="#"><img src="{{ asset('backend/images/avatar/avatar-2.png')}}" alt="user" width="40" class="rounded-circle"></a></div>
                        <h5 class="no-margin"> {{$message->name}}<br>
                            <small>From: {{$message->email}}</small>
                            <span class="mailbox-read-time pull-right">{{ Carbon\Carbon::parse($message->created_at)->format('F j, Y, g:i a')}}</span>
                        </h5>
                    </div>
                    <!-- /.mailbox-read-info -->
                    <div class="mailbox-read-message">
                        <p>{{$message->body}}</p>
                    </div>
                    <!-- /.mailbox-read-message -->
                </div>
                <!-- /.box-body -->

                <div class="box-footer">
                    <div class="pull-right">
                        <button type="button" class="btn btn-rounded btn-success" ><i class="fa fa-reply"></i> Reply</button>
                        <button type="button" class="btn btn-rounded btn-info"><i class="fa fa-share"></i> Forward</button>
                    </div>
                    <button type="button" class="btn btn-rounded btn-danger"><i class="fa fa-trash-o"></i> Delete</button>
                    <button type="button" class="btn btn-rounded btn-warning"><i class="fa fa-print"></i> Print</button>
                </div>
                <!-- /.box-footer -->
            </div>
        </div>
        <!-- /. box -->

    </section>
    <!-- /.right content -->
</div>
<!-- /.content-wrapper -->



<!-- /.control-sidebar -->


</div>
<!-- ./wrapper -->



@endsection