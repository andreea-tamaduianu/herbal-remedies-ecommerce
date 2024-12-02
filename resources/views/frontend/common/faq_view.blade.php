@extends('frontend.main_master')
@section('content')
@section('title')
Frequently asked questions
@endsection

<div class="breadcrumb">
    <div class="container">
        <div class="breadcrumb-inner">
            <ul class="list-inline list-unstyled">
            <li><a href="{{ url('/') }}">Home</a></li>
                <li class='active'>FAQ</li>
            </ul>
        </div><!-- /.breadcrumb-inner -->
    </div><!-- /.container -->
</div><!-- /.breadcrumb -->

<div class="body-content">
    <div class="container">
        <div class="checkout-box faq-page">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="heading-title">Frequently Asked Questions</h2>
                    <span class="title-tag">Last Updated on May 02, 2022</span>
                    <div class="panel-group checkout-steps" id="accordion">
                        <!-- checkout-step-01  -->
                        <div class="panel panel-default checkout-step-01">

                            <!-- panel-heading -->
                            <div class="panel-heading">
                                <h4 class="unicase-checkout-title">
                                    <a data-toggle="collapse" class="" data-parent="#accordion" href="#collapseOne">
                                        <span>1</span>How do I buy?
                                    </a>
                                </h4>
                            </div>
                            <!-- panel-heading -->

                            <div id="collapseOne" class="panel-collapse collapse in">

                                <!-- panel-body  -->
                                <div class="panel-body">
                                    Select the desired products and add them to the cart, then follow these steps:<br>

                                    <b>Step 1. Shopping cart</b> <br>
                                    You will be redirected to the shopping cart page, where you can view the selected products and / or update their quantity. When you want to complete the order, select one of the 2 options: "Login" and "Registration". If you have already registered you can go further by accessing "Complete the order".<br>

                                    <b>Step 2. Enter your details</b><br>
                                    You log in or if you do not have a user account, you register on the site. To place an order, you'll have to fill in the delivery details: name, delivery address, telephone and e-mail address.<br>

                                    <b>Step 3. Delivery and payment methods</b><br>
                                    There are several payment methods: cash on delivery or using a credit card through Stripe.<br>

                                    <b>Step 4. Confirm the order</b><br>
                                    After completing the order you will receive an email confirmation of the order registration. You can view the proforma invoice by accessing the "Order Details" button as soon as the order is delivered.<br>
                                </div>
                                <!-- panel-body  -->

                            </div><!-- row -->
                        </div>
                        <!-- checkout-step-01  -->
                        <!-- checkout-step-02  -->
                        <div class="panel panel-default checkout-step-02">
                            <div class="panel-heading">
                                <h4 class="unicase-checkout-title">
                                    <a data-toggle="collapse" class="collapsed" data-parent="#accordion" href="#collapseTwo">
                                        <span>2</span>How do I pay?
                                    </a>
                                </h4>
                            </div>
                            <div id="collapseTwo" class="panel-collapse collapse">
                                <div class="panel-body">
                                    Payment is made by cash on delivery (payment upon receipt of the package) or by card payment.
                                </div>
                            </div>
                        </div>
                        <!-- checkout-step-02  -->

                        <!-- checkout-step-03  -->
                        <div class="panel panel-default checkout-step-03">
                            <div class="panel-heading">
                                <h4 class="unicase-checkout-title">
                                    <a data-toggle="collapse" class="collapsed" data-parent="#accordion" href="#collapseThree">
                                        <span>3</span>What are the delivery methods?
                                    </a>
                                </h4>
                            </div>
                            <div id="collapseThree" class="panel-collapse collapse">
                                <div class="panel-body">
                                    The ordered products are delivered by courier, from Monday to Friday, between 9:00 and 18:00.
                                </div>
                            </div>
                        </div>
                        <!-- checkout-step-03  -->

                        <!-- checkout-step-04  -->
                        <div class="panel panel-default checkout-step-04">
                            <div class="panel-heading">
                                <h4 class="unicase-checkout-title">
                                    <a data-toggle="collapse" class="collapsed" data-parent="#accordion" href="#collapseFour">
                                        <span>4</span>What are the delivery charges?
                                    </a>
                                </h4>
                            </div>
                            <div id="collapseFour" class="panel-collapse collapse">
                                <div class="panel-body">
                                    There are no shipping fees.
                                </div>
                            </div>
                        </div>
                        <!-- checkout-step-04  -->

                        <!-- checkout-step-05  -->
                        <div class="panel panel-default checkout-step-05">
                            <div class="panel-heading">
                                <h4 class="unicase-checkout-title">
                                    <a data-toggle="collapse" class="collapsed" data-parent="#accordion" href="#collapseFive">
                                        <span>5</span>Is there a minimum order limit?
                                    </a>
                                </h4>
                            </div>
                            <div id="collapseFive" class="panel-collapse collapse">
                                <div class="panel-body">
                                    We do not impose a minimum order limit.
                                </div>
                            </div>
                        </div>
                        <!-- checkout-step-05  -->

                        <!-- checkout-step-06  -->
                        <div class="panel panel-default checkout-step-06">
                            <div class="panel-heading">
                                <h4 class="unicase-checkout-title">
                                    <a data-toggle="collapse" class="collapsed" data-parent="#accordion" href="#collapseSix">
                                        <span>6</span>When do I receive the order?
                                    </a>
                                </h4>
                            </div>
                            <div id="collapseSix" class="panel-collapse collapse">
                                <div class="panel-body">
                                    Your orders will be delivered in maximum 48 hours since you have placed your order.
                                </div>
                            </div>
                        </div>
                        <!-- checkout-step-06  -->

                        <!-- checkout-step-07  -->
                        <div class="panel panel-default checkout-step-07">
                            <div class="panel-heading">
                                <h4 class="unicase-checkout-title">
                                    <a data-toggle="collapse" class="collapsed" data-parent="#accordion" href="#collapseSeven">
                                        <span>7</span>Can I return the products I have bought?
                                    </a>
                                </h4>
                            </div>
                            <div id="collapseSeven" class="panel-collapse collapse">
                                <div class="panel-body">
                                    The consumer has the right to notify the trader in writing that he renounces the purchase, without penalties and without invoking a reason, within 14 working days from receiving the product. If you want to return the products you have the following obligations:<br>
                                    - to return the product purchased in the original packaging, undamaged, sealed, at your expense. We receive returns only by express courier or by any "door to door" service. Your return must reach the address: Garoafelor Street 3, Bucharest.<br>
                                    - to return the purchased product in working condition, undamaged, in the condition in which it was delivered to you.<br>
                                    For further details please contact us.<br>
                                </div>
                            </div>
                        </div>
                        <!-- checkout-step-07  -->



                        <!-- checkout-step-09  -->
                        <div class="panel panel-default checkout-step-08">
                            <div class="panel-heading">
                                <h4 class="unicase-checkout-title">
                                    <a data-toggle="collapse" class="collapsed" data-parent="#accordion" href="#collapseNine">
                                        <span>8</span>I forgot my account password. How do I proceed?
                                    </a>
                                </h4>
                            </div>
                            <div id="collapseNine" class="panel-collapse collapse">
                                <div class="panel-body">
                                    If you do not remember your account password, please use the "Forgot your password?" available when you access the "My Account" button.
                                </div>
                            </div>
                        </div>
                        <!-- checkout-step-09  -->

                    </div><!-- /.checkout-steps -->
                </div>
            </div><!-- /.row -->
        </div><!-- /.checkout-box -->
        @include('frontend.body.brands')
    </div><!-- /.container -->
</div><!-- /.body-content -->
<!-- For demo purposes – can be removed on production -->


<!-- For demo purposes – can be removed on production : End -->

<!-- JavaScripts placed at the end of the document so the pages load faster -->


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