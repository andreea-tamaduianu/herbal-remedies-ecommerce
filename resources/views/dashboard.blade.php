@extends('frontend.main_master')
@section('content')

<div class="body-content">
    <div class="container">
        <div class="row">



        @include('frontend.common.user_sidebar')


            <div class="col-md-6">
                <div class="card">
                    <h3 class="text-center"><span class="text-danger">Hi, </span><strong>{{ Auth::user()->name }}</strong>! Welcome to Herbal Remedies! </h3>

                </div>



            </div> <!-- // end col md 6 -->

        </div> <!-- // end row -->

    </div>

</div>


@endsection