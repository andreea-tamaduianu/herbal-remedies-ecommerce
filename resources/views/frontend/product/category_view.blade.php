@extends('frontend.main_master')
@section('content')
@section('title')
Subcategory wise products
@endsection

<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> -->



<div class="breadcrumb">
  <div class="container">
    &nbsp;
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
      <li class="breadcrumb-item active"><a href="{{ url('/') }}">Home</a></li>
       
        <li class="breadcrumb-item active"><a href="#">{{ $breadcat-category_name_en  }}</a></li>
      

      </ol>
    </nav>
  </div>
  <!-- /.container -->
</div>
<!-- /.breadcrumb -->
<div class="body-content outer-top-xs">
  <div class='container'>
    <div class='row'>
      <div class='col-md-3 sidebar'>





        <div class="sidebar-module-container">
          <div class="sidebar-filter">
            <!-- ============================================== SIDEBAR CATEGORY ============================================== -->

            <!-- /.sidebar-widget -->
            <!-- ============================================== SIDEBAR CATEGORY : END ============================================== -->
            @include('frontend.common.filters')
            <!-- ============================================== PRICE SILDER============================================== -->
            
            <!-- /.sidebar-widget -->
            <!-- ============================================== PRICE SILDER : END ============================================== -->
            <!-- ============================================== MANUFACTURES============================================== -->

            <!-- /.sidebar-widget -->
            <!-- ============================================== COLOR: END ============================================== -->
           

            <!-- == ====== PRODUCT TAGS ==== ======= -->
            @include('frontend.common.product_tags')
            <!-- /.sidebar-widget -->
            <!-- == ====== END PRODUCT TAGS ==== ======= -->



          </div>
          <!-- /.sidebar-filter -->
        </div>
        <!-- /.sidebar-module-container -->
      </div>
      <!-- /.sidebar -->
      <div class='col-md-9'>



        <!-- == ==== SECTION – HERO === ====== -->



        <span class="badge badge-danger" style="background: #808080">{{ count($products) }} products found</span>

        <div class="clearfix filters-container m-t-10">
          <div class="row">
            <div class="col col-sm-6 col-md-2">
              <div class="filter-tabs">
                <ul id="filter-tabs" class="nav nav-tabs nav-tab-box nav-tab-fa-icon">
                  <li class="active"> <a data-toggle="tab" href="#grid-container"><i class="icon fa fa-th-large"></i>Grid</a> </li>
                  <li><a data-toggle="tab" href="#list-container"><i class="icon fa fa-th-list"></i>List</a></li>
                </ul>
              </div>
              <!-- /.filter-tabs -->
            </div>
            <!-- /.col -->
            <form name="sortProducts" id="sortProducts" class="form-horizontal span6">
              <input type="hidden" name="url" id="url" value="{{ $slug }}">
              <input type='hidden' name='sort_products_by' value='product_latest'>
              <div class="control-group">
                <label class="control-label align">Sort by </label>
                <select name="sort" id="sort">
                  <option value="">Select</option>
                  <option value="product_latest" @if(isset($_GET['sort']) && $_GET['sort']=="product_latest" ) selected="" @endif>Latest Products</option>
                  <option value="product_name_a_z" @if(isset($_GET['sort']) && $_GET['sort']=="product_name_a_z" ) selected="" @endif>Product name A - Z</option>
                  <option value="product_name_z_a" @if(isset($_GET['sort']) && $_GET['sort']=="product_name_z_a" ) selected="" @endif>Product name Z - A</option>
                  <option value="price_lowest" @if(isset($_GET['sort']) && $_GET['sort']=="price_lowest" ) selected="" @endif>Lowest Price first</option>
                  <option value="price_highest" @if(isset($_GET['sort']) && $_GET['sort']=="price_highest" ) selected="" @endif>Highest Price first</option>
                </select>
              </div>
            </form>
            <!-- /.col -->
            <div class="col col-sm-6 col-md-4 text-right">

              <!-- /.pagination-container -->
            </div>
            <!-- /.col -->
          </div>
          <!-- /.row -->
        </div>

        <!--    //////////////////// START Product Grid View  ////////////// -->

        <div class="search-result-container ">
          <div id="myTabContent" class="tab-content category-list">
            <div class="tab-pane active " id="grid-container">
              <div class="category-product">
                <div class="row" id="grid_view_product">


                  @include('frontend.product.grid_view_product')


                </div>
                <!-- /.row -->
              </div>
              <!-- /.category-product -->

            </div>
            <!-- /.tab-pane -->

            <!--            //////////////////// END Product Grid View  ////////////// -->




            <!--            //////////////////// Product List View Start ////////////// -->



            <div class="tab-pane " id="list-container">
              <div class="category-product" id="list_view_product">


                @include('frontend.product.list_view_product')



                <!--            //////////////////// Product List View END ////////////// -->



              </div>
              <!-- /.category-product -->
            </div>
            <!-- /.tab-pane #list-container -->
          </div>
          <!-- /.tab-content -->
          @if(isset($_GET['sort']) && !empty($_GET['sort']))
          {{ $products->appends(['sort' => $_GET['sort']])->links('vendor.pagination.custom') }}
          @else
          {{ $products->links('vendor.pagination.custom') }}
          @endif

        </div>
        <!-- /.search-result-container -->

      </div>
      <!-- /.col -->

     
    </div>
    <!-- /.row -->
    &nbsp;
    @include('frontend.body.brands')
  </div>
  <!-- /.container -->

</div>
<!-- /.body-content -->





<script>
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });

  $("#sort").on('change', function() {

    this.form.submit();
  });
</script>




@endsection