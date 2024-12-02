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
            <div class="col-12">
                <div class="box">
                    <div class="box-header with-border">
                        <h4 class="box-title">Mailbox</h4>
                        <p class="subtitle">Here is the list of mails</p>

                        <div class="box-controls">
                            <div class="lookup lookup-circle lookup-right">
                                <input type="text" name="s">
                            </div>
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="mailbox-controls">
                            <!-- Check all button -->
                            <button type="button" class="btn btn-sm checkbox-toggle btn-outline"><i class="ion ion-android-checkbox-outline-blank"></i>
                            </button>
                            <div class="btn-group">
                                <button type="button" class="btn btn-outline btn-sm"><i class="ion ion-trash-a"></i></button>
                                <button type="button" class="btn btn-outline btn-sm"><i class="ion ion-reply"></i></button>
                                <button type="button" class="btn btn-outline btn-sm"><i class="ion ion-share"></i></button>
                            </div>
                            <!-- /.btn-group -->
                            <div class="btn-group">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-outline btn-sm dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                        <i class="ion ion-flag margin-r-5"></i>
                                        <span class="caret"></span>
                                    </button>
                                    <div class="dropdown-menu" style="will-change: transform;">
                                        <a class="dropdown-item" href="#">Action</a>
                                        <a class="dropdown-item" href="#">Another action</a>
                                        <a class="dropdown-item" href="#">Something else here</a>
                                    </div>
                                </div>
                                <div class="btn-group">
                                    <button type="button" class="btn btn-outline btn-sm dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                        <i class="ion ion-folder margin-r-5"></i>
                                        <span class="caret"></span>
                                    </button>
                                    <div class="dropdown-menu" style="will-change: transform;">
                                        <a class="dropdown-item" href="#">Action</a>
                                        <a class="dropdown-item" href="#">Another action</a>
                                        <a class="dropdown-item" href="#">Something else here</a>
                                    </div>
                                </div>
                            </div>
                            <!-- /.btn-group -->
                            <button type="button" class="btn btn-outline btn-sm"><i class="fa fa-refresh"></i></button>
                            <div class="pull-right">

                                <div class="btn-group">
                                    <button type="button" class="btn btn-outline btn-sm"><i class="fa fa-chevron-left"></i></button>
                                    <button type="button" class="btn btn-outline btn-sm"><i class="fa fa-chevron-right"></i></button>
                                </div>
                                <!-- /.btn-group -->
                            </div>
                            <!-- /.pull-right -->
                        </div>
                        <div class="mailbox-messages">
                            <div class="table-responsive">
                                <table class="table no-border" id="example1">
                                    <tbody>
                                        @foreach($messages as $item)
                                        <tr>
                                            <td>
                                                <div class="icheckbox_flat-blue" aria-checked="false" aria-disabled="false" style="position: relative;"><input type="checkbox" style="position: absolute; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins></div>
                                            </td>
                                            <td class="mailbox-star"><a href="#"><i class="fa fa-star-o text-warning"></i></a></td>
                                            <td class="w-80"><a href="#"><img class="avatar" src="{{ asset('backend/images/avatar/avatar-2.png')}}" alt="..."></a></td>
                                            <td class="mailbox-name">{{$item->name}}</td>

                                            <td class="mailbox-subject"><a href="{{ url('mailbox/view/'.$item->id ) }}"><b>{{$item->subject}} - </b>{{Str::limit($item->body, 20 )}}</a>
                                            </td>


                                            <td class="mailbox-date">{{Carbon\Carbon::parse($item->created_at)->diffForHumans()}} </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.table -->
                        </div>
                        <!-- /.mail-box-messages -->
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /. box -->
            </div>
        </div>
    </section>
    <!-- /.right content -->

</div>
<!-- /.content-wrapper -->








@endsection