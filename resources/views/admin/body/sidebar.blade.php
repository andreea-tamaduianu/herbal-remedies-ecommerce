<!-- Left side column. contains the logo and sidebar -->
@php
$prefix = Request::route()->getPrefix();
$route = Route::current()->getName();

@endphp


<aside class="main-sidebar">
  <!-- sidebar-->
  <section class="sidebar">

    <div class="user-profile">
      <div class="ulogo">
        <a href="{{ url('/admin/dashboard') }}">
          <!-- logo for regular state and mobile devices -->
          <div class="d-flex align-items-center justify-content-center">
            <img src="{{ asset('backend/images/logo-dark.png')}}" alt="">
            <h3><b>Herbal Remedies</b></h3>
          </div>
        </a>
      </div>
    </div>

    <!-- sidebar menu-->
    <ul class="sidebar-menu" data-widget="tree">

      <li class="{{ ($route == 'dashboard')? 'active':'' }}">
        <a href="{{ url('admin/dashboard') }}">
          <i data-feather="home"></i>
          <span>Dashboard</span>
        </a>
      </li>


      @php
      $brand = (auth()->guard('admin')->user()->brand == 1);
      $category = (auth()->guard('admin')->user()->category == 1);
      $product = (auth()->guard('admin')->user()->product == 1);
      $slider = (auth()->guard('admin')->user()->slider == 1);
      $coupons = (auth()->guard('admin')->user()->coupon == 1);
      $shipping = (auth()->guard('admin')->user()->shipping == 1);
      $blog = (auth()->guard('admin')->user()->blog == 1);
      $setting = (auth()->guard('admin')->user()->setting == 1);
      $returnorder = (auth()->guard('admin')->user()->return_orders == 1);
      $review = (auth()->guard('admin')->user()->review == 1);
      $orders = (auth()->guard('admin')->user()->orders == 1);
      $stock = (auth()->guard('admin')->user()->stock == 1);
      $reports = (auth()->guard('admin')->user()->report == 1);
      $newsletter = (auth()->guard('admin')->user()->newsletter == 1);
      $currency = (auth()->guard('admin')->user()->currency == 1);
      $mailbox = (auth()->guard('admin')->user()->mailbox == 1);
      $alluser = (auth()->guard('admin')->user()->user == 1);
      $adminuserrole = (auth()->guard('admin')->user()->admin_user_role == 1);
      @endphp

      @if($mailbox == true)
      <li class="treeview {{ ($prefix == '/mailbox')?'active':'' }}  ">
        <a href="#">
          <i data-feather="mail"></i>
          <span>Mailbox </span>
          <span class="pull-right-container">
            <i class="fa fa-angle-right pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li class="{{ ($route == 'messages.all')? 'active':'' }}"><a href="{{ route('messages.all') }}"><i class="ti-more"></i>Inbox</a></li>
        </ul>
      </li>
      @else
      @endif

      @if($brand == true)
      <li class="treeview {{ ($prefix == '/brand')?'active':'' }}">
        <a href="#">
          <i data-feather="globe"></i>
          <span>Brands</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-right pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li class="{{ ($route == 'all.brands')? 'active':'' }}"><a href="{{route('all.brands')}}"><i class="ti-more"></i>Manage brands</a></li>
        </ul>
      </li>
      @else
      @endif

      @if($category == true)
      <li class="treeview {{ ($prefix == '/category')?'active':'' }}">
        <a href="#">
          <i data-feather="grid"></i> <span>Categories</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-right pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li class="{{ ($route == 'all.categories')? 'active':'' }}"><a href="{{route('all.categories')}}"><i class="ti-more"></i>Manage categories</a></li>
          <li class="{{ ($route == 'all.subcategories')? 'active':'' }}"><a href="{{route('all.subcategories')}}"><i class="ti-more"></i>Manage subcategories</a></li>
          <li class="{{ ($route == 'all.subsubcategories')? 'active':'' }}"><a href="{{route('all.subsubcategories')}}"><i class="ti-more"></i>Manage sub-subcategories</a></li>
        </ul>
      </li>
      @else
      @endif
      
      @if($product == true)
      <li class="treeview {{ ($prefix == '/product')?'active':'' }}">
        <a href="#">
          <i class="fa fa-pagelines"></i>
          <span>Products</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-right pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li class="{{ ($route == 'product.add')? 'active':'' }}"><a href="{{route('product.add')}}"><i class="ti-more"></i>Add product</a></li>
          <li class="{{ ($route == 'all.products')? 'active':'' }}"><a href="{{route('all.products')}}"><i class="ti-more"></i>Manage products</a></li>
        </ul>
      </li>
      @else
      @endif

      
      @if($orders == true)
      <li class="treeview {{ ($prefix == '/orders')?'active':'' }}  ">
        <a href="#">
          <i data-feather="file-text"></i>
          <span>Orders </span>
          <span class="pull-right-container">
            <i class="fa fa-angle-right pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li class="{{ ($route == 'pending-orders')? 'active':'' }}"><a href="{{ route('pending-orders') }}"><i class="ti-more"></i>Pending Orders</a></li>
          <li class="{{ ($route == 'confirmed-orders')? 'active':'' }}"><a href="{{ route('confirmed-orders') }}"><i class="ti-more"></i>Confirmed Orders</a></li>
          <li class="{{ ($route == 'processing-orders')? 'active':'' }}"><a href="{{ route('processing-orders') }}"><i class="ti-more"></i>Processing Orders</a></li>
          <li class="{{ ($route == 'picked-orders')? 'active':'' }}"><a href="{{ route('picked-orders') }}"><i class="ti-more"></i> Picked Orders</a></li>
          <li class="{{ ($route == 'shipped-orders')? 'active':'' }}"><a href="{{ route('shipped-orders') }}"><i class="ti-more"></i> Shipped Orders</a></li>
          <li class="{{ ($route == 'delivered-orders')? 'active':'' }}"><a href="{{ route('delivered-orders') }}"><i class="ti-more"></i> Delivered Orders</a></li>
          <li class="{{ ($route == 'cancel-orders')? 'active':'' }}"><a href="{{ route('cancel-orders') }}"><i class="ti-more"></i> Cancelled Orders</a></li>
        </ul>
      </li>
      @else
      @endif

      @if($returnorder == true)
      <li class="treeview {{ ($prefix == '/return')?'active':'' }}  ">
        <a href="#">
          <i data-feather="corner-down-left"></i>
          <span>Return requests</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-right pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li class="{{ ($route == 'return.request')? 'active':'' }}"><a href="{{ route('return.request') }}"><i class="ti-more"></i>Pending return requests</a></li>
          <li class="{{ ($route == 'all.request')? 'active':'' }}"><a href="{{ route('all.request') }}"><i class="ti-more"></i>All return requests</a></li>
        </ul>
      </li>
      @else
      @endif
      

      @if($slider == true)
      <li class="treeview {{ ($prefix == '/slider')?'active':'' }}">
        <a href="#">
        <i class="fa fa-picture-o"></i>
          <span>Slider</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-right pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li class="{{ ($route == 'slider.manage')? 'active':'' }}"><a href="{{route('slider.manage')}}"><i class="ti-more"></i>Manage slider</a></li>
        </ul>
      </li>
      @else
      @endif

      @if($coupons == true)
      <li class="treeview {{ ($prefix == '/coupon')?'active':'' }}">
        <a href="#">
          <i data-feather="credit-card"></i>
          <span>Coupons</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-right pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li class="{{ ($route == 'coupon.manage')? 'active':'' }}"><a href="{{route('coupon.manage')}}"><i class="ti-more"></i>Manage coupons</a></li>
        </ul>
      </li>
      @else
      @endif

      @if($currency == true)
      <li class="treeview {{ ($prefix == '/currency')?'active':'' }}">
        <a href="#">
        <i class="fa fa-usd"></i>
          <span>Currencies</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-right pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li class="{{ ($route == 'currency.manage')? 'active':'' }}"><a href="{{route('currency.manage')}}"><i class="ti-more"></i>Manage currencies</a></li>
        </ul>
      </li>
      @else
      @endif

      @if($shipping == true)
      <li class="treeview {{ ($prefix == '/shipping')?'active':'' }}">
        <a href="#">
          <i data-feather="compass"></i>
          <span>Shipping</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-right pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li class="{{ ($route == 'division.manage')? 'active':'' }}"><a href="{{route('division.manage')}}"><i class="ti-more"></i>Manage shipping countries</a></li>
          <li class="{{ ($route == 'district.manage')? 'active':'' }}"><a href="{{route('district.manage')}}"><i class="ti-more"></i>Manage shipping counties</a></li>
          <li class="{{ ($route == 'state.manage')? 'active':'' }}"><a href="{{route('state.manage')}}"><i class="ti-more"></i>Manage shipping cities</a></li>
        </ul>
      </li>
      @else
      @endif

      @if($blog == true)
      <li class="treeview {{ ($prefix == '/blog')?'active':'' }}  ">
        <a href="#">
        <i class="fa fa-rss"></i>
          <span>Blog</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-right pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li class="{{ ($route == 'blogcategory.all')? 'active':'' }}"><a href="{{ route('blogcategory.all') }}"><i class="ti-more"></i>Manage blog categories</a></li>
          <li class="{{ ($route == 'post.list')? 'active':'' }}"><a href="{{ route('post.list') }}"><i class="ti-more"></i>Manage blog posts</a></li>
          <li class="{{ ($route == 'post.add')? 'active':'' }}"><a href="{{ route('post.add') }}"><i class="ti-more"></i>Add blog post</a></li>
        </ul>
      </li>
      @else
      @endif


     

      @if($review == true)
      <li class="treeview {{ ($prefix == '/review')?'active':'' }}  ">
        <a href="#">
          <i data-feather="check-square"></i>
          <span>Reviews</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-right pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li class="{{ ($route == 'pending.review')? 'active':'' }}"><a href="{{ route('pending.review') }}"><i class="ti-more"></i>Pending reviews</a></li>
          <li class="{{ ($route == 'publish.review')? 'active':'' }}"><a href="{{ route('publish.review') }}"><i class="ti-more"></i>Published reviews</a></li>
        </ul>
      </li>
      @else
      @endif
      
      @if($newsletter == true)
      <li class="treeview {{ ($prefix == '/newsletter')?'active':'' }}  ">
        <a href="#">
        <i class="fa fa-envelope"></i>
          <span>Newsletter</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-right pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li class="{{ ($route == 'newsletter.subscribers')? 'active':'' }}"><a href="{{ route('newsletter.subscribers') }}"><i class="ti-more"></i>Subscribers</a></li>
          
        </ul>
      </li>
      @else
      @endif

      @if($reports == true)
      <li class="treeview {{ ($prefix == '/reports')?'active':'' }}  ">
        <a href="#">
          <i data-feather="pie-chart"></i>
          <span>Reports </span>
          <span class="pull-right-container">
            <i class="fa fa-angle-right pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li class="{{ ($route == 'all-reports')? 'active':'' }}"><a href="{{ route('all-reports') }}"><i class="ti-more"></i>All Reports</a></li>
          <li class="{{ ($route == 'all-graphs')? 'active':'' }}"><a href="{{ route('all-graphs') }}"><i class="ti-more"></i>All Charts</a></li>
        </ul>
      </li>
      @else
      @endif

      @if($alluser == true)
      <li class="treeview {{ ($prefix == '/alluser')?'active':'' }}  ">
        <a href="#">
          <i data-feather="users"></i>
          <span>Users </span>
          <span class="pull-right-container">
            <i class="fa fa-angle-right pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li class="{{ ($route == 'all-users')? 'active':'' }}"><a href="{{ route('all-users') }}"><i class="ti-more"></i>All Users</a></li>
        </ul>
      </li>
      @else
      @endif



      @if($adminuserrole == true)
      <li class="treeview {{ ($prefix == '/admin-user-role')?'active':'' }}  ">
        <a href="#">
          <i data-feather="user-plus"></i>
          <span>Admin user role </span>
          <span class="pull-right-container">
            <i class="fa fa-angle-right pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li class="{{ ($route == 'all.admin.user')? 'active':'' }}"><a href="{{ route('all.admin.user') }}"><i class="ti-more"></i>All Admin users </a></li>
        </ul>
      </li>
      @else
      @endif

      @if($setting == true)
      <li class="treeview {{ ($prefix == '/setting')?'active':'' }}  ">
        <a href="#">
          <i data-feather="settings"></i>
          <span>Manage site</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-right pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li class="{{ ($route == 'site.setting')? 'active':'' }}"><a href="{{ route('site.setting') }}"><i class="ti-more"></i>Site settings</a></li>
          <li class="{{ ($route == 'seo.setting')? 'active':'' }}"><a href="{{ route('seo.setting') }}"><i class="ti-more"></i>SEO settings</a></li>
        </ul>
      </li>
      @else
      @endif






      <div class="sidebar-footer">
        <!-- item-->
        <a href="javascript:void(0)" class="link" data-toggle="tooltip" title="" data-original-title="Settings" aria-describedby="tooltip92529"><i class="ti-settings"></i></a>
        <!-- item-->
        <a href="{{ url('mailbox/all') }}" class="link" data-toggle="tooltip" title="" data-original-title="Email"><i class="ti-email"></i></a>
        <!-- item-->
        <a href="{{ route('admin.logout') }}" class="link" data-toggle="tooltip" title="" data-original-title="Logout"><i class="ti-lock"></i></a>
      </div>
</aside>