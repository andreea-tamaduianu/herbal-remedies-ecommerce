 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>


 <form>{{ csrf_field() }}
     @if(!empty($url))
     <input name="url" value="{{ $url }}" type="hidden">
     @endif
     

     <div class="sidebar-widget wow fadeInUp">
     <h3 class="section-title">@if(session()->get('language') == 'romanian') Filtreaza dupa @else Shop by @endif</h3>
         <div class="widget-header">
             <h4 class="widget-title">@if(session()->get('language') == 'romanian') Categorie @else Category @endif</h4>
         </div>
         @php
         $categories_en =App\Models\Category::groupBy('category_name_en')->select('category_name_en')->where('category_status', 1)->get();
         $categories_ro =App\Models\Category::groupBy('category_name_ro')->select('category_name_ro')->where('category_status', 1)->get();

         @endphp
         <div class="sidebar-widget-body">
             <ul class="list">
                 @if(session()->get('language') == 'romanian')

                 @foreach($categories_ro as $category)


                 <input class="category" style="margin-top: -3px;" onchange="javascript:this.form.submit();" type="checkbox" name="categoryFilter[]" id="{{ $category->category_name_ro }}" value="{{ $category->category_name_ro }}" @if(isset($selected_category)) @if (in_array($category->category_name_ro, $selected_category)) checked="checked" @endif @endif>&nbsp;&nbsp;{{ $category->category_name_ro }}<br>
                 @endforeach

                 @else

                 @foreach($categories_en as $category)


                 <input class="category" style="margin-top: -3px;" onchange="javascript:this.form.submit();" type="checkbox" name="categoryFilter[]" id="{{ $category->category_name_en }}" value="{{ $category->category_name_en }}" @if(isset($selected_category)) @if (in_array($category->category_name_en, $selected_category)) checked="checked" @endif @endif>&nbsp;&nbsp;{{ $category->category_name_en}}<br>

                 @endforeach
                 @endif
             </ul>
             <!--<a href="#" class="lnk btn btn-primary">Show Now</a>-->
         </div>
         <!-- /.sidebar-widget-body -->
     </div>

     <div class="sidebar-widget wow fadeInUp">
         <div class="widget-header">
             <h4 class="widget-title">@if(session()->get('language') == 'romanian') Subcategorie @else Subcategory @endif</h4>
         </div>
         @php
         $subcategories_en =App\Models\Subcategory::groupBy('subcategory_name_en')->select('subcategory_name_en')->where('subcategory_status', 1)->get();
         $subcategories_ro =App\Models\Subcategory::groupBy('subcategory_name_ro')->select('subcategory_name_ro')->where('subcategory_status', 1)->get();

         @endphp
         <div class="sidebar-widget-body">
             <ul class="list">
                 @if(session()->get('language') == 'romanian')

                 @foreach($subcategories_ro as $subcategory)


                 <input class="subcategory" style="margin-top: -3px;" onchange="javascript:this.form.submit();" type="checkbox" name="subcategoryFilter[]" id="{{ $subcategory->subcategory_name_ro }}" value="{{ $subcategory->subcategory_name_ro }}" @if(isset($selected_subcategory)) @if (in_array($subcategory->subcategory_name_ro, $selected_subcategory)) checked="checked" @endif @endif>&nbsp;&nbsp;{{ $subcategory->subcategory_name_ro }}<br>
                 @endforeach

                 @else

                 @foreach($subcategories_en as $subcategory)


                 <input class="subcategory" style="margin-top: -3px;" onchange="javascript:this.form.submit();" type="checkbox" name="subcategoryFilter[]" id="{{ $subcategory->subcategory_name_en }}" value="{{ $subcategory->subcategory_name_en }}" @if(isset($selected_subcategory)) @if (in_array($subcategory->subcategory_name_en, $selected_subcategory)) checked="checked" @endif @endif>&nbsp;&nbsp;{{ $subcategory->subcategory_name_en}}<br>

                 @endforeach
                 @endif
             </ul>
             <!--<a href="#" class="lnk btn btn-primary">Show Now</a>-->
         </div>
         <!-- /.sidebar-widget-body -->
     </div>

     <div class="sidebar-widget wow fadeInUp">
         <div class="widget-header">
             <h4 class="widget-title">@if(session()->get('language') == 'romanian') Subsubcategorie @else Subsubcategory @endif</h4>
         </div>
         @php
         $subsubcategories_en =App\Models\Subsubcategory::groupBy('subsubcategory_name_en')->select('subsubcategory_name_en')->where('subsubcategory_status', 1)->get();
         $subsubcategories_ro =App\Models\Subsubcategory::groupBy('subsubcategory_name_ro')->select('subsubcategory_name_ro')->where('subsubcategory_status', 1)->get();

         @endphp
         <div class="sidebar-widget-body">
             <ul class="list">
                 @if(session()->get('language') == 'romanian')

                 @foreach($subsubcategories_ro as $subsubcategory)


                 <input class="subsubcategory" style="margin-top: -3px;" onchange="javascript:this.form.submit();" type="checkbox" name="subsubcategoryFilter[]" id="{{ $subsubcategory->subsubcategory_name_ro }}" value="{{ $subsubcategory->subsubcategory_name_ro }}" @if(isset($selected_subsubcategory)) @if (in_array($subsubcategory->subsubcategory_name_ro, $selected_subsubcategory)) checked="checked" @endif @endif>&nbsp;&nbsp;{{ $subsubcategory->subsubcategory_name_ro }}<br>
                 @endforeach

                 @else

                 @foreach($subsubcategories_en as $subsubcategory)


                 <input class="subsubcategory" style="margin-top: -3px;" onchange="javascript:this.form.submit();" type="checkbox" name="subsubcategoryFilter[]" id="{{ $subsubcategory->subsubcategory_name_en }}" value="{{ $subsubcategory->subsubcategory_name_en }}" @if(isset($selected_subsubcategory)) @if (in_array($subsubcategory->subsubcategory_name_en, $selected_subsubcategory)) checked="checked" @endif @endif>&nbsp;&nbsp;{{ $subsubcategory->subsubcategory_name_en}}<br>

                 @endforeach
                 @endif
             </ul>
             <!--<a href="#" class="lnk btn btn-primary">Show Now</a>-->
         </div>
         <!-- /.sidebar-widget-body -->
     </div>
     <!-- ============================================== PRICE SILDER============================================== -->
     
     <!-- /.sidebar-widget -->
     <!-- ============================================== PRICE SILDER : END ============================================== -->
     <!-- ============================================== MANUFACTURES============================================== -->
     <div class="sidebar-widget wow fadeInUp">
         <div class="widget-header">
             <h4 class="widget-title">@if(session()->get('language') == 'romanian') Brand @else Brand @endif</h4>
         </div>
         @php
         $brands_en =App\Models\Brand::groupBy('brand_name_en')->select('brand_name_en')->get();
         $brands_ro =App\Models\Brand::groupBy('brand_name_ro')->select('brand_name_ro')->get();

         @endphp
         <div class="sidebar-widget-body">
             <ul class="list">
                 @if(session()->get('language') == 'romanian')

                 @foreach($brands_ro as $brand)


                 <input class="brand" style="margin-top: -3px;" onchange="javascript:this.form.submit();" type="checkbox" name="brandFilter[]" id="{{ $brand->brand_name_ro }}" value="{{ $brand->brand_name_ro }}" @if(isset($selected_brand)) @if (in_array($brand->brand_name_ro, $selected_brand)) checked="checked" @endif @endif>&nbsp;&nbsp;{{ $brand->brand_name_ro }}<br>
                 @endforeach

                 @else

                 @foreach($brands_en as $brand)


                 <input class="brand" style="margin-top: -3px;" onchange="javascript:this.form.submit();" type="checkbox" name="brandFilter[]" id="{{ $brand->brand_name_en }}" value="{{ $brand->brand_name_en }}" @if(isset($selected_brand)) @if (in_array($brand->brand_name_en, $selected_brand)) checked="checked" @endif @endif>&nbsp;&nbsp;{{ $brand->brand_name_en}}<br>

                 @endforeach
                 @endif
             </ul>
             <!--<a href="#" class="lnk btn btn-primary">Show Now</a>-->
         </div>
         <!-- /.sidebar-widget-body -->
     </div>
     <!-- /.sidebar-widget -->
     <!-- ============================================== MANUFACTURES: END ============================================== -->
     <!-- ============================================== COLOR============================================== -->
     <div class="sidebar-widget wow fadeInUp">
         <div class="widget-header">
             <h4 class="widget-title">@if(session()->get('language') == 'romanian') Beneficiu @else Product benefit @endif</h4>
         </div>
         @php
         $products =App\Models\Product::where('status',1)->get();
         $product_benefits_en=array();
         $product_benefits_ro=array();
         foreach($products as $product){
         if( $product->product_benefit_en!=NULL && $product->product_benefit_ro!=NULL){
         $results_en = array_unique(explode(',', $product->product_benefit_en));
         $results_ro = array_unique(explode(',', $product->product_benefit_ro));

         foreach($results_en as $result){
         array_push($product_benefits_en, $result);
         }

         foreach($results_ro as $result){
         array_push($product_benefits_ro, $result);
         }
        
         }
       
         
         $product_benefits_en = array_unique($product_benefits_en);
         $product_benefits_ro = array_unique($product_benefits_ro);
         }
        
         @endphp
         <div class="sidebar-widget-body">
             <ul class="list">
                 @if(session()->get('language') == 'romanian')

                 @foreach($product_benefits_ro as $benefit)


                 <input class="benefit" style="margin-top: -3px;" onchange="javascript:this.form.submit();" type="checkbox" name="benefitFilter[]" id="{{ $benefit}}" value="{{ $benefit }}" @if(isset($selected_benefit)) @if (in_array($benefit, $selected_benefit)) checked="checked" @endif @endif>&nbsp;&nbsp;{{ $benefit }}<br>
                 @endforeach

                 @else

                 @foreach($product_benefits_en as $benefit)

                 <input class="benefit" style="margin-top: -3px;" onchange="javascript:this.form.submit();" type="checkbox" name="benefitFilter[]" id="{{ $benefit }}" value="{{ $benefit }}" @if(isset($selected_benefit)) @if (in_array($benefit, $selected_benefit)) checked="checked" @endif @endif>&nbsp;&nbsp;{{ $benefit }}<br>
                 @endforeach

                 @endif

             </ul>
         </div>
         <!-- /.sidebar-widget-body -->
     </div>

     <div class="sidebar-widget wow fadeInUp">
         <div class="widget-header">
             <h4 class="widget-title">@if(session()->get('language') == 'romanian') Tipul produsului @else Product type @endif</h4>
         </div>
         @php
         $products =App\Models\Product::where('status',1)->get();
         $product_types_en=array();
         $product_types_ro=array();
         foreach($products as $product){
         if( $product->product_type_en!=NULL && $product->product_type_ro!=NULL){
         $results_en = array_unique(explode(',', $product->product_type_en));
         $results_ro = array_unique(explode(',', $product->product_type_ro));

         foreach($results_en as $result){
         array_push($product_types_en, $result);
         }

         foreach($results_ro as $result){
         array_push($product_types_ro, $result);
         }
        
         }
       
         
         $product_types_en = array_unique($product_types_en);
         $product_types_ro = array_unique($product_types_ro);
         }
         
         @endphp
         <div class="sidebar-widget-body">
             <ul class="list">
                 @if(session()->get('language') == 'romanian')

                 @foreach($product_types_ro as $type)


                 <input class="type" style="margin-top: -3px;" onchange="javascript:this.form.submit();" type="checkbox" name="typeFilter[]" id="{{ $type}}" value="{{ $type }}" @if(isset($selected_type)) @if (in_array($type, $selected_type)) checked="checked" @endif @endif>&nbsp;&nbsp;{{ $type }}<br>
                 @endforeach

                 @else

                 @foreach($product_types_en as $type)

                 <input class="type" style="margin-top: -3px;" onchange="javascript:this.form.submit();" type="checkbox" name="typeFilter[]" id="{{ $type}}" value="{{ $type }}" @if(isset($selected_type)) @if (in_array($type, $selected_type)) checked="checked" @endif @endif>&nbsp;&nbsp;{{ $type }}<br>
                 @endforeach

                 @endif

             </ul>
         </div>
         <!-- /.sidebar-widget-body -->
     </div>

     <div class="sidebar-widget wow fadeInUp">
         <div class="widget-header">
             <h4 class="widget-title">@if(session()->get('language') == 'romanian') Utilizare @else Mode of use @endif</h4>
         </div>
         @php
         $products =App\Models\Product::where('status',1)->get();
         $product_uses_en=array();
         $product_uses_ro=array();
         foreach($products as $product){
         if( $product->mode_of_use_en!=NULL && $product->mode_of_use_ro!=NULL){
         $results_en = array_unique(explode(',', $product->mode_of_use_en));
         $results_ro = array_unique(explode(',', $product->mode_of_use_ro));

         foreach($results_en as $result){
         array_push($product_uses_en, $result);
         }

         foreach($results_ro as $result){
         array_push($product_uses_ro, $result);
         }
        
         }
       
         
         $product_uses_en = array_unique($product_uses_en);
         $product_uses_ro = array_unique($product_uses_ro);
         }
         
         @endphp
         <div class="sidebar-widget-body">
             <ul class="list">
                 @if(session()->get('language') == 'romanian')

                 @foreach($product_uses_ro as $use)


                 <input class="use" style="margin-top: -3px;" onchange="javascript:this.form.submit();" type="checkbox" name="useFilter[]" id="{{ $use}}" value="{{ $use }}" @if(isset($selected_use)) @if (in_array($use, $selected_use)) checked="checked" @endif @endif>&nbsp;&nbsp;{{ $use }}<br>
                 @endforeach

                 @else

                 @foreach($product_uses_en as $use)

                 <input class="use" style="margin-top: -3px;" onchange="javascript:this.form.submit();" type="checkbox" name="useFilter[]" id="{{ $use}}" value="{{ $use }}" @if(isset($selected_use)) @if (in_array($use, $selected_use)) checked="checked" @endif @endif>&nbsp;&nbsp;{{ $use }}<br>
                 @endforeach

                 @endif

             </ul>
         </div>
         <!-- /.sidebar-widget-body -->
     </div>

     <div class="sidebar-widget wow fadeInUp">
         <div class="widget-header">
             <h4 class="widget-title">@if(session()->get('language') == 'romanian') Pentru @else Destinated to @endif</h4>
         </div>
         @php
         $products =App\Models\Product::where('status',1)->get();
         $product_destinations_en=array();
         $product_destinations_ro=array();
         foreach($products as $product){
         if( $product->destinated_to_en!=NULL && $product->destinated_to_ro!=NULL){
         $results_en = array_unique(explode(',', $product->destinated_to_en));
         $results_ro = array_unique(explode(',', $product->destinated_to_ro));

         foreach($results_en as $result){
         array_push($product_destinations_en, $result);
         }

         foreach($results_ro as $result){
         array_push($product_destinations_ro, $result);
         }
        
         }
       
         
         $product_destinations_en = array_unique($product_destinations_en);
         $product_destinations_ro = array_unique($product_destinations_ro);
         }
         
         @endphp
         <div class="sidebar-widget-body">
             <ul class="list">
                 @if(session()->get('language') == 'romanian')

                 @foreach($product_destinations_ro as $destination)


                 <input class="destination" style="margin-top: -3px;" onchange="javascript:this.form.submit();" type="checkbox" name="destinationFilter[]" id="{{ $destination}}" value="{{ $destination }}" @if(isset($selected_destination)) @if (in_array($destination, $selected_destination)) checked="checked" @endif @endif>&nbsp;&nbsp;{{ $destination }}<br>
                 @endforeach

                 @else

                 @foreach($product_destinations_en as $destination)

                 <input class="destination" style="margin-top: -3px;" onchange="javascript:this.form.submit();" type="checkbox" name="destinationFilter[]" id="{{ $destination}}" value="{{ $destination }}" @if(isset($selected_destination)) @if (in_array($destination, $selected_destination)) checked="checked" @endif @endif>&nbsp;&nbsp;{{ $destination }}<br>
                 @endforeach

                 @endif

             </ul>
         </div>
         <!-- /.sidebar-widget-body -->
     </div>

     <div class="sidebar-widget wow fadeInUp">
         <div class="widget-header">
             <h4 class="widget-title">@if(session()->get('language') == 'romanian') Dimensiune @else Size @endif</h4>
         </div>
         @php
         $sizess =App\Models\ProductAttributes::groupBy('size')->select('size')->get();



         $products =App\Models\Product::where('status',1)->get();
         $product_size_en=array();
         $product_size_ro=array();
         foreach($products as $product){
         if( $product->product_size_en!=NULL && $product->product_size_ro!=NULL){
         $results_en = array_unique(explode(',', $product->product_size_en));
         $results_ro = array_unique(explode(',', $product->product_size_ro));

         foreach($results_en as $result){
         array_push($product_size_en, $result);
         }

         foreach($results_ro as $result){
         array_push($product_size_ro, $result);
         }
        
         }
       
         
         $product_size_en = array_unique($product_size_en);
         $product_size_ro = array_unique($product_size_ro);
         }
         @endphp
         <div class="sidebar-widget-body">
             <ul class="list">

                 @foreach($product_size_en as $size)

                 <input class="size" style="margin-top: -3px;" onchange="javascript:this.form.submit();" type="checkbox" name="sizeFilter[]" id="{{ $size }}" value="{{ $size }}" @if(isset($selected_size)) @if (in_array($size, $selected_size)) checked="checked" @endif @endif>&nbsp;&nbsp;{{ $size }}<br>
                 @endforeach


             </ul>
         </div>
         <!-- /.sidebar-widget-body -->
     </div>

     <div class="sidebar-widget wow fadeInUp">
         <div class="widget-header">
             <h4 class="widget-title"> @if(session()->get('language') == 'romanian') Pret @else Price @endif</h4>
         </div>
         <div class="sidebar-widget-body m-t-10">
             <div class="filter-attribute-list-inner">
                 Min: <input type="text" onblur="javascript:this.form.submit();" id="product_min_price" name="product_min_price" placeholder="<?php if (isset($product_min_price)) {
                                                                                                                                                    echo $product_min_price;
                                                                                                                                                } ?>" value="<?php if (isset($selected_min_price)) {
                                                                                                                                                                    echo $selected_min_price;
                                                                                                                                                                } ?>">
                 <br>
                 <br>
                 Max: <input type="text" onblur="javascript:this.form.submit();" id="product_max_price" name="product_max_price" placeholder="<?php if (isset($product_max_price)) {
                                                                                                                                                    echo $product_max_price;
                                                                                                                                                } ?>" value="<?php if (isset($selected_max_price)) {
                                                                                                                                                                    echo $selected_max_price;
                                                                                                                                                                } ?>">

             </div>
             <!-- /.price-range-holder -->

         </div>
         <!-- /.sidebar-widget-body -->
     </div>
     <!-- /.sidebar-widget -->
     <!-- ============================================== COLOR: END ============================================== -->
 </form>

 <script>
     $.ajaxSetup({
         headers: {
             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
         }
     });


    //  $(".color").on('click', function() {
    //      this.form.submit();
    //  });
    //  $(".brand").on('click', function() {
    //      this.form.submit();
    //  });
    //  $(".size").on('click', function() {
    //      this.form.submit();
    //  });

    //  $("#product_max_price").on('click', function() {
    //      this.form.submit();
    //  });

    //  $("#product_min_price").on('click', function() {
    //      this.form.submit();
    //  });
 </script>