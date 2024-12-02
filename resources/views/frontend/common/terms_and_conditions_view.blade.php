@extends('frontend.main_master')
@section('content')
@section('title')
Terms & conditions
@endsection

<div class="breadcrumb">
    <div class="container">
        <div class="breadcrumb-inner">
            <ul class="list-inline list-unstyled">
            <li><a href="{{ url('/') }}">Home</a></li>
                <li class='active'>Terms & Conditions</li>
            </ul>
        </div><!-- /.breadcrumb-inner -->
    </div><!-- /.container -->
</div><!-- /.breadcrumb -->

<div class="body-content">
    <div class="container">
        <div class="terms-conditions-page">
            <div class="row">
                <div class="col-md-12 terms-conditions">
                    <h2 class="heading-title">Terms and Conditions</h2>
                    <div class="">
                        <div id="main" class="wrapper">


                            <div id="primary" class="site-content">
                                <div id="content" role="main">


                                    <article id="post-741" class="white-box post-741 page type-page status-publish has-post-thumbnail hentry">

                                        <div class="entry-content">

                                            <h4 class="wide-strip uc">Terms of Use</h4>



                                            <p>Access to the web site is subject to the user’s acceptance and agreement with the terms, conditions, notices and disclaimers contained herein. Use of, and/or access to, the web site constitutes agreement to the ‘Terms of Use’. We reserve the right to amend the Terms of Use at any time. Since users are bound by the Terms of Use, they should periodically refer to them in this document and elsewhere on the web site.</p>



                                            <h4 class="wide-strip uc">Orders and Cancellation Policy</h4>



                                            <p>We enable orders to be made online. When making an order, we will require personal information from users in order to identify users and process the payment for users order. Users may be required to provide contact information (such as name, email, phone number and postal address) and financial information (such as credit card number, expiration date and Stripe details).</p>



                                            <p>All credit card transactions are processed in real time using a secure third party payment gateway provider Stripe.</p>



                                            <h4 class="wide-strip uc">Return Policy </h4>



                                            <p>Our return policy provides credit for goods damaged in transit, goods with an expiration date of less than 6 months, goods sent in error and goods that are unfit for purpose.</p>



                                            <p>Before making a return, please notify the office. Notification should occur within 24 hours of delivery. A credit will be issued on all justifiable returns. For example, an unjustified return includes stock that has been damaged whilst in users possession and stock that has been damaged during return to us due to inadequate packing. Credit will not be extended in those circumstances.</p>



                                            <p>Returns should be made within 14 days either with courier or post. Proof of purchase is required on request. Please ensure all returns are packed appropriately so that they arrive in a saleable condition.</p>



                                            <p>Our return policy also provides refunds. Please call our office to inquire whether users are entitled to a refund. If a refund is approved, it will be credited to users credit card used for the initial purchase.</p>



                                            <h4 class="wide-strip uc">Delivery Policy </h4>



                                            <p>We process orders promptly, endeavouring to dispatch users goods within two working days. If stock is not available, or for any other reason the order will require a longer processing time, we will contact users to advise when it will be available and delivered.</p>





                                            <h4 class="wide-strip uc">Medical Information Disclaimer</h4>



                                            <p>We may provide health and medical advice through its website or by telephone or other communications. Any information provided regarding health and medical treatment is provided to assist users with users own research. We do not represent or warrant in any way that such information is accurate, complete or correct, and recommend users seek independent medical advice from a qualified practitioner.</p>




                                            <h4 class="wide-strip uc">Intellectual Property Rights Disclaimer </h4>



                                            <p>All materials, text, graphics, information, software and advertisements on the web site is protected by copyright laws. The contents of the web site is published in real-time, must not be copied, reproduced, modified, republished, uploaded to a third party, transmitted, posted or distributed in any way, electronically or otherwise, without our express authorisation.</p>



                                            <h4 class="wide-strip uc">User Licence Disclaimer</h4>



                                            <p>By posting any information or other material on the web site (including posting messages, uploading files, inputting data or engaging in any other form of communication), the user grants us a perpetual, royalty-free, non-exclusive, irrevocable, unrestricted, worldwide licence to do the following in respect of the information or material:</p>



                                            <ul>
                                                <li>Use, copy, sublicense, redistribute, adapt, transmit, publish and/or broadcast, publicly perform or display; and</li>
                                                <li>Sublicense to any third parties the unrestricted right to exercise any of the foregoing rights granted.</li>
                                            </ul>



                                            <p>The foregoing grant includes the right to exploit all proprietary rights in any such information or other material including but not limited to rights under copyright, trademark, service mark or patent laws under any jurisdiction worldwide.</p>



                                            <h4 class="wide-strip uc">E-Commerce Disclaimer</h4>



                                            <p>Our website may contain product price lists, as well as hyperlinks to other companies whose websites contain price information. The product price lists on our website or any associated web site are the responsibility of the relevant retailer and are accurate at the time of upload. They are subject to change without notice by the retailer. We are not liable for the prices or price changes, including where price changes have not been reflected on the associated sites. The use of associated sites is subject to our terms of use.</p>



                                            <h4 class="wide-strip uc">Modification and Termination of ‘Terms of Use’ Disclaimer</h4>



                                            <p>We reserve the right to update and make other changes at any times to this ‘Terms of Use’ statement, including the polices and disclaimers contained herein. If changes are made, we will post those changes to this ‘Terms of Use’ statement, the website homepage, and other places we deem appropriate, so that users are aware of what information we collect, how we use it, and under what circumstances, if any, we disclose it.</p>



                                            <p>The Terms of Use are effective until terminated. We may terminate this agreement and users’ access to the web site at any time without notice. In the event of termination, users are no longer authorised to access the web site, but all policies, disclaimers and limitations of liability set out in the Terms of Use will survive.</p>
                                        </div>

                                    </article>

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