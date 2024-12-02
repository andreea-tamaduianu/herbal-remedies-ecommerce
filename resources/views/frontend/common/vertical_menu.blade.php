@php
$categories = App\Models\Category::orderBy('category_name_en','ASC')->where('category_status',1)->get();
@endphp


<div class="side-menu animate-dropdown outer-bottom-xs">
    <div class="head"><i class="icon fa fa-align-justify fa-fw"></i> Categories</div>
    <nav class="yamm megamenu-horizontal">
        <ul class="nav">


            @foreach($categories as $category)
            <li class="dropdown menu-item"> <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon {{ $category->category_icon }}" aria-hidden="true"></i>
                    @if(session()->get('language') == 'romanian') {{ $category->category_name_ro }} @else {{ $category->category_name_en }} @endif
                </a>
                <ul class="dropdown-menu mega-menu">
                    <li class="yamm-content">
                        <div class="row">

                            <!--   // Get SubCategory Table Data -->
                            @php
                            $subcategories = App\Models\Subcategory::where('category_id',$category->id)->where('subcategory_status',1)->orderBy('subcategory_name_en','ASC')->get();
                            @endphp

                            @foreach($subcategories as $subcategory)
                            <div class="col-sm-12 col-md-3">

                                <a href="{{ url('products/subcategory/'.$subcategory->subcategory_slug_en ) }}">
                                    <h2 class="title">
                                        @if(session()->get('language') == 'romanian') {{ $subcategory->subcategory_name_ro }} @else {{ $subcategory->subcategory_name_en }} @endif
                                    </h2>
                                </a>

                                <!--   // Get SubSubCategory Table Data -->
                                @php
                                $subsubcategories = App\Models\Subsubcategory::where('subcategory_id',$subcategory->id)->where('subsubcategory_status',1)->orderBy('subsubcategory_name_en','ASC')->get();
                                @endphp

                                @foreach($subsubcategories as $subsubcategory)
                                <ul class="links list-unstyled">
                                    <li><a href="{{ url('products/subsubcategory/'.$subsubcategory->subsubcategory_slug_en ) }}">
                                            @if(session()->get('language') == 'romanian') {{ $subsubcategory->subsubcategory_name_ro }} @else {{ $subsubcategory->subsubcategory_name_en }} @endif</a></li>

                                </ul>
                                @endforeach
                                <!-- // End SubSubCategory Foreach -->

                            </div>
                            <!-- /.col -->
                            @endforeach
                            <!-- End SubCategory Foreach -->

                        </div>
                        <!-- /.row -->
                    </li>
                    <!-- /.yamm-content -->
                </ul>
                <!-- /.dropdown-menu -->
            </li>
            <!-- /.menu-item -->
            @endforeach
            <!-- End Category Foreach -->






            

        </ul>
        <!-- /.nav -->
    </nav>
    <!-- /.megamenu-horizontal -->
</div>
<!-- /.side-menu -->