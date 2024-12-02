@extends('frontend.main_master')
@section('content')
@section('title')
Contact Page
@endsection

<div class="breadcrumb">
    <div class="container">
        <div class="breadcrumb-inner">
            <ul class="list-inline list-unstyled">
            <li><a href="{{ url('/') }}">Home</a></li>
                <li class='active'>Contact</li>
            </ul>
        </div><!-- /.breadcrumb-inner -->
    </div><!-- /.container -->
</div><!-- /.breadcrumb -->

<div class="body-content">
    <div class="container">
        <div class="contact-page">
            <div class="row">
                <div class="col-md-12 contact-map outer-bottom-vs"><div class="mapouter">
                    <iframe src="https://maps.google.com/maps?q=strada%20nitu%20vasile&t=&z=13&ie=UTF8&iwloc=&output=embed" width="600" height="450" style="border:0"></iframe>
                </div>

                <div class="col-md-9 contact-form">
                    <form class="register-form" role="form" method="post" action="{{route('send.message')}}">
                        @csrf
                        <div class="col-md-12 contact-title">
                            <h4>Contact Form</h4>
                        </div>
                        <div class="col-md-4 ">

                            <div class="form-group">
                                <label class="info-title" for="exampleInputName">Your Name <span>*</span></label>
                                <input type="text" class="form-control unicase-form-control text-input" id="exampleInputName" name="name" placeholder="Name" required>
                            </div>

                        </div>
                        <div class="col-md-4">

                            <div class="form-group">
                                <label class="info-title" for="exampleInputEmail1">Email Address <span>*</span></label>
                                <input type="email" class="form-control unicase-form-control text-input" id="exampleInputEmail1" name="email" placeholder="Email" required>
                            </div>

                        </div>
                        <div class="col-md-4">

                            <div class="form-group">
                                <label class="info-title" for="exampleInputTitle">Subject <span>*</span></label>
                                <input type="text" class="form-control unicase-form-control text-input" id="exampleInputTitle" name="subject" placeholder="Title" required>
                            </div>

                        </div>
                        <div class="col-md-12">

                            <div class="form-group">
                                <label class="info-title" for="exampleInputComments">Your Comments <span>*</span></label>
                                <textarea class="form-control unicase-form-control" id="exampleInputComments" name="body" required></textarea>
                            </div>

                        </div>
                        <div class="col-md-12 outer-bottom-small m-t-20">
                            <button type="submit" class="btn-upper btn btn-primary checkout-page-button">Send Message</button>
                        </div>
                    </form>

                </div>
                <div class="col-md-3 contact-info">
                    @php
                    $setting = App\Models\SiteSetting::find(1);
                    @endphp
                    <div class="contact-title">
                        <h4>Information</h4>
                    </div>
                    <div class="clearfix address">
                        <span class="contact-i"><i class="fa fa-map-marker"></i></span>
                        <span class="contact-span">{{ $setting->company_address }}</span>
                    </div>
                    <div class="clearfix phone-no">
                        <span class="contact-i"><i class="fa fa-mobile"></i></span>
                        <span class="contact-span">{{ $setting->phone_one }}<br>{{ $setting->phone_two }}</span>
                    </div>
                    <div class="clearfix email">
                        <span class="contact-i"><i class="fa fa-envelope"></i></span>
                        <span class="contact-span"><a href="#">{{ $setting->email }}</a></span>
                    </div>
                </div>
            </div><!-- /.contact-page -->
        </div><!-- /.row -->
    </div>
</div>

<script src="switchstylesheet/switchstylesheet.js"></script>

<script>
    $(document).ready(function() {
        $(".changecolor").switchstylesheet({
            seperator: "color"
        });
        $('.show-theme-options').click(function() {
            $(this).parent().toggleClass('open');
            return false;
        });
    });

    $(window).bind("load", function() {
        $('.show-theme-options').delay(2000).trigger('click');
    });
</script>
<!-- For demo purposes – can be removed on production : End -->


@endsection