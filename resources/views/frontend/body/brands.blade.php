@php
$brands = App\Models\Brand::latest()->get();
@endphp

<!-- ============================================== BRANDS CAROUSEL ============================================== -->
<div id="brands-carousel" class="logo-slider wow fadeInUp">
      <div class="logo-slider-inner">
        <div id="brand-slider" class="owl-carousel brand-slider custom-carousel owl-theme">
          @foreach($brands as $brand)
        <div class="item"> <a href="{{ url('products/brand/'.$brand->brand_slug_en) }}" class="image"><img src="{{ asset($brand->brand_image) }}" alt=""></a> </div>
          <!--/.item-->
          
          @endforeach
          <!--/.item--> 
        </div>
        <!-- /.owl-carousel #logo-slider --> 
      </div>
      <!-- /.logo-slider-inner --> 
      
    </div>