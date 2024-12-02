@extends('frontend.main_master')
@section('content')
<!-- @php
$user = DB::table('users')->where('id',Auth::user()->id)->first();
@endphp -->

<div class="body-content">
    <div class="container">
        <div class="row">

            @include('frontend.common.user_sidebar')

            <div class="col-md-2">

            </div> <!-- // end col md 2 -->


            <div class="col-md-6">
                <div class="card">
                    <h3 class="text-center"><span class="text-danger">Change password</span><strong> </strong> </h3>

                    <div class="card-body">



                        <form method="post" action="{{ route('user.update.password') }}">
                            @csrf


                            <div class="form-group">
                                <label class="info-title" for="exampleInputEmail1">Current password <span> </span></label>
                                <input type="password" id="current_password" name="oldpassword" class="form-control">
                                @error('oldpassword')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label class="info-title" for="exampleInputEmail1">New password <span> </span></label>
                                <input type="password" id="password" name="password" class="form-control">
                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>


                            <div class="form-group">
                                <label class="info-title" for="exampleInputEmail1">Confirm password <span> </span></label>
                                <input type="password" id="password_confirmation" name="password_confirmation" class="form-control">
                                @error('password_confirmation')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>



                            <div class="form-group">
                                <button type="submit" class="btn btn-danger">Save</button>
                            </div>



                        </form>
                    </div>



                </div>

            </div> <!-- // end col md 6 -->

        </div> <!-- // end row -->

    </div>

</div>


@endsection