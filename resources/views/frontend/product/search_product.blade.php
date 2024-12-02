@extends('frontend.main_master')
@section('content')
@section('title')
Search results Page
@endsection


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>



<!-- /.breadcrumb -->
<div class="body-content outer-top-xs">
    <div class='container'>

       
        <div class='row'>
            <div class='col-md-3 sidebar'>

                <!-- ===== == TOP NAVIGATION ======= ==== -->

                <!-- = ==== TOP NAVIGATION : END === ===== -->




                <div class="sidebar-module-container">
                    <div class="sidebar-filter">
                        <!-- ============================================== SIDEBAR CATEGORY ============================================== -->

                        <!-- /.sidebar-widget -->
                        <!-- ============================================== SIDEBAR CATEGORY : END ============================================== -->
                        <div class="sidebar-widget wow fadeInUp">
                            <h3 class="section-title">shop by</h3>
                            <div class="widget-header">
                                <h4 class="widget-title">Category</h4>
                            </div>
                            <div class="sidebar-widget-body">
                                <div class="accordion">


                                    @foreach($categories as $category)
                                    <div class="accordion-group">
                                        <div class="accordion-heading"> <a href="#collapse{{ $category->id }}" data-toggle="collapse" class="accordion-toggle collapsed">
                                                @if(session()->get('language') == 'romanian') {{ $category->category_name_ro }} @else {{ $category->category_name_en }} @endif </a> </div>
                                        <!-- /.accordion-heading -->
                                        <div class="accordion-body collapse" id="collapse{{ $category->id }}" style="height: 0px;">
                                            <div class="accordion-inner">

                                                @php
                                                $subcategories = App\Models\Subcategory::where('category_id',$category->id)->orderBy('subcategory_name_en','ASC')->get();
                                                @endphp

                                                @foreach($subcategories as $subcategory)
                                                <ul>
                                                    <li><a href="{{ url('products/subcategory/'.$subcategory->subcategory_slug_en ) }}">
                                                            @if(session()->get('language') == 'romanian') {{ $subcategory->subcategory_name_ro }} @else {{ $subcategory->subcategory_name_en }} @endif</a></li>

                                                </ul>
                                                @endforeach


                                            </div>
                                            <!-- /.accordion-inner -->
                                        </div>
                                        <!-- /.accordion-body -->
                                    </div>
                                    <!-- /.accordion-group -->
                                    @endforeach











                                </div>
                                <!-- /.accordion -->
                            </div>
                            <!-- /.sidebar-widget-body -->
                        </div>
                        <!-- ============================================== PRICE SILDER============================================== -->

                        <!-- /.sidebar-widget -->
                        <!-- ============================================== PRICE SILDER : END ============================================== -->

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


                <h4><b>Products found </b><span class="badge badge-danger" style="background: #FF0000;"> {{ count($products) }} </span></h4>



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
                                <div class="row">
                                    @if(count($products)==0)
                                    No products match this search
                                    @else
                                    @include('frontend.product.grid_view_product')
                                    @endif


                                </div>
                                <!-- /.row -->
                            </div>
                            <!-- /.category-product -->

                        </div>
                        <!-- /.tab-pane -->

                        <!--            //////////////////// END Product Grid View  ////////////// -->




                        <!--            //////////////////// Product List View Start ////////////// -->



                        <div class="tab-pane " id="list-container">
                            <div class="category-product">



                                @include('frontend.product.list_view_product')



                                <!--            //////////////////// Product List View END ////////////// -->








                            </div>
                            <!-- /.category-product -->
                        </div>
                        <!-- /.tab-pane #list-container -->
                    </div>
                    <!-- /.tab-content -->
                    
                    <!-- /.filters-container -->

                </div>
                <!-- /.search-result-container -->

            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
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