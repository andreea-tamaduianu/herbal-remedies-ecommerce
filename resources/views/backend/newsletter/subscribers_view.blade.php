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
                        <h3 class="box-title">Newsletter subscribers <span class="badge badge-pill badge-danger"> {{ count($subscribers) }} </span></h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="table-responsive">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Email </th>
                                        <th>Subscribed on</th>

                                        <th>Actions</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($subscribers as $subscriber)
                                    <tr>

                                        <td width="35%"> {{ $subscriber->email }}</td>
                                        <td width="35%">{{ Carbon\Carbon::parse($subscriber->created_at)->format('F j, Y, g:i a')}}</td>


                                        <td width="30%">

                                            
                                            @if($subscriber->status == 1)                                           
                                            <a href="{{ route('subscriber.inactive',$subscriber->id) }}"  title="Active"><i class="fa fa-toggle-on"></i> </a>
                                            @else
                                            <a href="{{ route('subscriber.active',$subscriber->id) }}"  title="Inactive"><i class="fa fa-toggle-off"></i> </a>
                                            @endif
                                            &nbsp;&nbsp;
                                            <a href="{{ route('subscriber.delete',$subscriber->id) }}"  title="Delete" id="delete">
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