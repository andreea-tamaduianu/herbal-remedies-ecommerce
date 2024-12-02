<footer id="footer" class="footer color-bg">
  <div class="footer-bottom">
    <div class="container">
      <div class="row">
        <div class="col-xs-12 col-sm-6 col-md-3">
          <div class="module-heading">
            <h4 class="module-title">Contact Us</h4>
          </div>
          <!-- /.module-heading -->

          @php
          $setting = App\Models\SiteSetting::find(1);
          @endphp

          <div class="module-body">
            <ul class="toggle-footer" style="">
              <li class="media">
                <div class="pull-left"> <span class="icon fa-stack fa-lg"> <i class="fa fa-map-marker fa-stack-1x fa-inverse"></i> </span> </div>
                <div class="media-body">
                  <p>{{ $setting->company_name }}, {{ $setting->company_address }}</p>
                </div>
              </li>
              <li class="media">
                <div class="pull-left"> <span class="icon fa-stack fa-lg"> <i class="fa fa-mobile fa-stack-1x fa-inverse"></i> </span> </div>
                <div class="media-body">
                  <p>{{ $setting->phone_one }}<br>
                    {{ $setting->phone_two }}
                  </p>
                </div>
              </li>
              <li class="media">
                <div class="pull-left"> <span class="icon fa-stack fa-lg"> <i class="fa fa-envelope fa-stack-1x fa-inverse"></i> </span> </div>
                <div class="media-body"> <span><a href="#">{{ $setting->email }}</a></span> </div>
              </li>
            </ul>
          </div>
          <!-- /.module-body -->
        </div>
        <!-- /.col -->

        <div class="col-xs-12 col-sm-6 col-md-3">
          <div class="module-heading">
            <h4 class="module-title">Customer Service</h4>
          </div>
          <!-- /.module-heading -->

          <div class="module-body">
            <ul class='list-unstyled'>
              @auth
              <li class="first"><a href="{{route('dashboard')}}" title="My account">My Account</a></li>
              <li><a href="{{route('my.orders')}}" title="Order history">Order History</a></li>

              @else
              <li class="first"><a href="{{route('login')}}" title="My account">My Account</a></li>
              <li><a href="{{route('login')}}" title="Order history">Order History</a></li>

              @endauth

              <li class="last"><a href="{{route('faq')}}" title="FAQ">FAQ</a></li>

            </ul>
          </div>
          <!-- /.module-body -->
        </div>
        <!-- /.col -->

        <div class="col-xs-12 col-sm-6 col-md-3">
          <div class="module-heading">
            <h4 class="module-title">Our Company</h4>
          </div>
          <!-- /.module-heading -->

          <div class="module-body">
            <ul class='list-unstyled'>
              <li class="first"><a href="{{route('about_us')}}" title="About us">About us</a></li>

              <li class="last"><a href="{{route('terms_and_conditions')}}" title="Terms & Conditions">Terms & Conditions</a></li>
            </ul>
          </div>
          <!-- /.module-body -->
        </div>
        <!-- /.col -->

        <div class="col-xs-12 col-sm-6 col-md-3">
          <div class="module-heading">
            <h4 class="module-title">Why Choose Us</h4>
          </div>
          <!-- /.module-heading -->

          <div class="module-body">
            <ul class='list-unstyled'>

              <li class="first"><a href="{{route('home.blog')}}" title="Blog">Blog</a></li>

              <li class=" last"><a href="{{route('contact_us')}}" title="Contact us">Contact Us</a></li>
            </ul>
          </div>
          <!-- /.module-body -->
        </div>
      </div>
    </div>
  </div>
  <div class="copyright-bar">
    <div class="container">
      <div class="col-xs-12 col-sm-6 no-padding social">
        <ul class="link">
          <li class="fb pull-left"><a target="_blank" rel="nofollow" href="{{ $setting->facebook }}" title="Facebook"></a></li>

          <li class="tw pull-left"><a target="_blank" rel="nofollow" href="{{ $setting->twitter }}" title="Twitter"></a></li>



          <li class="linkedin pull-left"><a target="_blank" rel="nofollow" href="{{ $setting->linkedin }}" title="Linkedin"></a></li>

          <li class="youtube pull-left"><a target="_blank" rel="nofollow" href="{{ $setting->youtube }}" title="Youtube"></a></li>
        </ul>
      </div>
      <div class="col-xs-12 col-sm-6 no-padding">
        <div class="clearfix payment-methods">
          <ul>
            <li><img src="{{ asset('frontend/assets/images/payments/1.png')}}" alt=""></li>
            <li><img src="{{ asset('frontend/assets/images/payments/2.png')}}" alt=""></li>
            <li><img src="{{ asset('frontend/assets/images/payments/3.png')}}" alt=""></li>
            <li><img src="{{ asset('frontend/assets/images/payments/4.png')}}" alt=""></li>
            <li><img src="{{ asset('frontend/assets/images/payments/6.png')}}" alt=""></li>
          </ul>
        </div>
        <!-- /.payment-methods -->
      </div>
    </div>
  </div>
</footer>


<!--Start of Tawk.to Script-->
<script type="text/javascript">
  var Tawk_API = Tawk_API || {},
    Tawk_LoadStart = new Date();
  (function() {
    var s1 = document.createElement("script"),
      s0 = document.getElementsByTagName("script")[0];
    s1.async = true;
    s1.src = 'https://embed.tawk.to/622105d01ffac05b1d7cd0f8/1ft8fte5g';
    s1.charset = 'UTF-8';
    s1.setAttribute('crossorigin', '*');
    s0.parentNode.insertBefore(s1, s0);
  })();
</script>
<!--End of Tawk.to Script-->