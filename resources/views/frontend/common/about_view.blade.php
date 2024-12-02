@extends('frontend.main_master')
@section('content')
@section('title')
About us
@endsection

<div class="breadcrumb">
    <div class="container">
        <div class="breadcrumb-inner">
            <ul class="list-inline list-unstyled">
            <li><a href="{{ url('/') }}">Home</a></li>
                <li class='active'>About us</li>
            </ul>
        </div><!-- /.breadcrumb-inner -->
    </div><!-- /.container -->
</div><!-- /.breadcrumb -->

<div class="body-content">
    <div class="container">
        <div class="terms-conditions-page">
            <div class="row">
                <div class="col-md-12 terms-conditions">
                    <h2 class="heading-title">About us</h2>
                    <div class="">
                        <div id="main" class="wrapper">


                            <div id="primary" class="site-content">
                                <div id="content" role="main">

                                    <div class="col-sm-12">
                                        <h3> <strong> Why choose us? </strong> </h3>
                                        <p style="text-align: justify;"> Because in a world where green has been rather gray and the treatments offered by allopathic medicine come with a lot of side effects, we have chosen to <strong> believe in the healing power of nature </strong> and the gifts it gives us. From here until the choice of the company name was a single step. </p>
                                        <p style="text-align: justify;"> We are a 100% Romanian company, with long experience on the natural products market and we offer a wide range of products: food supplements, natural cosmetics, essential oils, teas etc. </p>
                                        
                                        <h3 style=" text-align: justify; "> <strong> Mission: </strong> </h3>
                                        <p style=" text-align: justify; "> We are <strong> a source of information and education </strong> for our customers, a model for a healthy lifestyle, so we carefully select the staff of our stores, who are constantly up to date with the latest news in the field of natural health and anytime ready to answer your questions. We also take care to provide you with the best manufacturers and the widest variety of products to meet your requirements. </p>
                                        <p style="text-align: justify;"> Feedback from customers of our stores from Bucharest made us want this company to be present at a national level, in order to <strong> offer all Romanians the same quality services at unbeatable prices</strong>. Thus, since 2016 we are also present online. With the launch of the online store, we will try to be closer to our customers and on social networks, for an <strong> efficient and direct communication</strong>. <strong>We want to gather a community of open people around our brand </strong> who are interested in a healthy lifestyle. </p>
                                       
                                        <h3 style="text-align: justify;"> <strong> Values: </strong> </h3>
                                        <p style="text-align: justify;">
                                            <strong> We believe that nature offers us the most beautiful and profound lessons of life, so that the values ​​of our company are inspired by the philosophy of nature. </strong>
                                        </p>
                                        <p style="text-align: justify;"> <strong> Simplicity</strong>. We believe that natural means simple, we believe in the beauty and purity of simple things. </p>
                                        <p style="text-align: justify;"> <strong> Quality</strong>. It is the watchword when it comes to the products we offer to our customers. In an increasingly crowded market, that of natural products, I learned that quality is the key to selection. </p>
                                        <p style="text-align: justify;"> <strong> Courage</strong>. We are a 100% Romanian company, we started shyly but we had big dreams. With each dream come true, we were grateful and challenged. </p>
                                        <p style="text-align: justify;"> <strong> Flexibility.</strong> Our experience so far has taught us to be flexible, to listen to the suggestions and opinions of our customers, to adapt to the market without giving up the values ​​we are guided by, to trust the way we chose, even though the map often seems unknown. </p>
                                        <p style="text-align: justify;"> <strong> Harmony. </strong> We believe that a healthy life is not just about nutrition, but a balance between nutritious food, exercise and positive thinking, so the products you find in our stores address all the needs of the human body. </p>
                                        
                                        
                                        <p> <strong> <br> </strong> </p>
                                    </div>


                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div><!-- /.row -->
        </div><!-- /.sigin-in-->

    </div><!-- /.container -->
</div><!-- /.body-content -->


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