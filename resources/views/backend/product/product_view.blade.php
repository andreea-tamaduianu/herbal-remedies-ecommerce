@extends('admin.admin_master')
@section('admin')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>


<div class="container-full">
    <!-- Content Header (Page header) -->


    <!-- Main content -->
    <section class="content">

        <!-- Basic Forms -->
        <div class="box">
            <div class="box-header with-border">
                <h4 class="box-title">View product </h4>

            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div class="row">
                    <div class="col">

                        <form method="post" action="">
                            @csrf
                            <input type="hidden" name="id" value="{{ $products->id }}">
                            <div class="row">
                                <div class="col-12">


                                    <div class="row">
                                        <!-- start 1st row  -->
                                        <div class="col-md-3">

                                            <div class="form-group">
                                                <h5>Brand <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <select name="brand_id" class="form-control" required="" disabled>
                                                        <option value="" selected="" disabled="">Select brand</option>
                                                        @foreach($brands as $brand)
                                                        <option value="{{ $brand->id }}" {{ $brand->id == $products->brand_id ? 'selected': '' }}>{{ $brand->brand_name_en }}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('brand_id')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>

                                        </div> <!-- end col md 4 -->

                                        <div class="col-md-3">

                                            <div class="form-group">
                                                <h5>Category <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <select name="category_id" class="form-control" required="" disabled>
                                                        <option value="" selected="" disabled="">Select category</option>
                                                        @foreach($categories as $category)
                                                        <option value="{{ $category->id }}" {{ $category->id == $products->category_id ? 'selected': '' }}>{{ $category->category_name_en }}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('category_id')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>

                                        </div> <!-- end col md 4 -->


                                        <div class="col-md-3">

                                            <div class="form-group">
                                                <h5>Subcategory <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <select name="subcategory_id" class="form-control" required="" disabled>
                                                        <option value="" selected="" disabled="">Select subcategory</option>

                                                        @foreach($subcategory as $sub)
                                                        <option value="{{ $sub->id }}" {{ $sub->id == $products->subcategory_id ? 'selected': '' }}>{{ $sub->subcategory_name_en }}</option>
                                                        @endforeach

                                                    </select>
                                                    @error('subcategory_id')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>

                                        </div> <!-- end col md 4 -->

                                        <div class="col-md-3">

                                            <div class="form-group">
                                                <h5>Sub-subcategory <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <select name="subsubcategory_id" class="form-control" required="" disabled>
                                                        <option value="" selected="" disabled="">Select sub-subcategory</option>

                                                        @foreach($subsubcategory as $subsub)
                                                        <option value="{{ $subsub->id }}" {{ $subsub->id == $products->subsubcategory_id ? 'selected': '' }}>{{ $subsub->subsubcategory_name_en }}</option>
                                                        @endforeach

                                                    </select>
                                                    @error('subsubcategory_id')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>

                                        </div> <!-- end col md 4 -->

                                    </div> <!-- end 1st row  -->



                                    <div class="row">
                                        <!-- start 2nd row  -->


                                        <div class="col-md-4">

                                            <div class="form-group">
                                                <h5>Product name English <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="text" name="product_name_en" class="form-control" required="" disabled value="{{ $products->product_name_en }}">
                                                    @error('product_name_en')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>

                                        </div> <!-- end col md 4 -->


                                        <div class="col-md-4">

                                            <div class="form-group">
                                                <h5>Product name Romanian <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="text" name="product_name_ro" class="form-control" disabled required="" value="{{ $products->product_name_ro }}">
                                                    @error('product_name_ro')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>

                                        </div> <!-- end col md 4 -->

                                        <div class="col-md-4">

                                            <div class="form-group">
                                                <h5>Product code <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="text" name="product_code" class="form-control" disabled required="" value="{{ $products->product_code }}">
                                                    @error('product_code')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>

                                        </div> <!-- end col md 4 -->


                                    </div> <!-- end 2nd row  -->

                                    <div class="row">
                                        <!-- start 4th row  -->

                                        <div class="col-md-4">

                                            <div class="form-group">
                                                <h5>Product size English <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="text" name="product_size_en" class="form-control" disabled value="{{ $products->product_size_en }}" data-role="tagsinput" required="">
                                                    @error('product_size_en')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>

                                        </div> <!-- end col md 4 -->

                                        <div class="col-md-4">

                                            <div class="form-group">
                                                <h5>Product size Romanian <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="text" name="product_size_ro" class="form-control" disabled value="{{ $products->product_size_ro }}" data-role="tagsinput" required="">
                                                    @error('product_size_ro')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>

                                        </div> <!-- end col md 4 -->



                                    </div> <!-- end 4th row  -->

                                    <div class="row">
                                        <!-- start 4th row  -->

                                        <div class="col-md-4">

                                            <div class="form-group">
                                                <h5>Product tags English</h5>
                                                <div class="controls">
                                                    <input type="text" name="product_tags_en" class="form-control"  disabled data-role="tagsinput" value="{{ $products->product_tags_en }}">
                                                    @error('product_tags_en')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>

                                        </div> <!-- end col md 4 -->

                                        <div class="col-md-4">

                                            <div class="form-group">
                                                <h5>Product tags Romanian</h5>
                                                <div class="controls">
                                                    <input type="text" name="product_tags_ro" class="form-control" disabled data-role="tagsinput" value="{{ $products->product_tags_ro }}">
                                                    @error('product_tags_ro')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>

                                        </div> <!-- end col md 4 -->



                                    </div> <!-- end 4th row  -->

                                    
                                    <div class="row">
                                        <!-- start 4th row  -->

                                        <div class="col-md-4">

                                            <div class="form-group">
                                                <h5>Product type English</h5>
                                                <div class="controls">
                                                    <input type="text" name="product_type_en" class="form-control" disabled data-role="tagsinput" value="{{ $products->product_type_en }}">
                                                    @error('product_type_en')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>

                                        </div> <!-- end col md 4 -->

                                        <div class="col-md-4">

                                            <div class="form-group">
                                                <h5>Product type Romanian</h5>
                                                <div class="controls">
                                                    <input type="text" name="product_type_ro" class="form-control" disabled  data-role="tagsinput" value="{{ $products->product_type_ro }}">
                                                    @error('product_type_ro')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>

                                        </div> <!-- end col md 4 -->



                                    </div> <!-- end 4th row  -->
                                    <div class="row">
                                        <!-- start 5th row  -->
                                        <div class="col-md-4">

                                            <div class="form-group">
                                                <h5>Product benefit English </h5>
                                                <div class="controls">
                                                    <input type="text" name="product_benefit_en" class="form-control" disabled  data-role="tagsinput" value="{{ $products->product_benefit_en }}">
                                                    <!-- @error('product_benefit_en')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror -->
                                                </div>
                                            </div>

                                        </div> <!-- end col md 4 -->

                                        <div class="col-md-4">

                                            <div class="form-group">
                                                <h5>Product benefit Romanian </h5>
                                                <div class="controls">
                                                    <input type="text" name="product_benefit_ro" class="form-control" disabled  data-role="tagsinput" value="{{ $products->product_benefit_ro }}">
                                                    <!-- @error('product_benefit_ro')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror -->
                                                </div>
                                            </div>

                                        </div> <!-- end col md 4 -->




                                    </div> <!-- end 5th row  -->

                                    <div class="row">
                                        <!-- start 5th row  -->
                                        <div class="col-md-4">

                                            <div class="form-group">
                                                <h5>Mode of use English</h5>
                                                <div class="controls">
                                                    <input type="text" name="product_mode_of_use_en" class="form-control" disabled data-role="tagsinput" value="{{ $products->mode_of_use_en }}">
                                                    @error('product_mode_of_use_en')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>

                                        </div> <!-- end col md 4 -->

                                        <div class="col-md-4">

                                            <div class="form-group">
                                                <h5>Mode of use Romanian</h5>
                                                <div class="controls">
                                                    <input type="text" name="product_mode_of_use_ro" class="form-control" disabled data-role="tagsinput" value="{{ $products->mode_of_use_ro }}">
                                                    @error('product_mode_of_use_ro')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>

                                        </div> <!-- end col md 4 -->




                                    </div> <!-- end 5th row  -->

                                    <div class="row">
                                        <!-- start 5th row  -->
                                        <div class="col-md-4">

                                            <div class="form-group">
                                                <h5>Product destinated to English</h5>
                                                <div class="controls">
                                                    <input type="text" name="product_destinated_to_en" class="form-control" disabled value="{{ $products->destinated_to_en }}" data-role="tagsinput">
                                                    @error('product_destinated_to_en')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>

                                        </div> <!-- end col md 4 -->

                                        <div class="col-md-4">

                                            <div class="form-group">
                                                <h5>Product destinated to Romanian</h5>
                                                <div class="controls">
                                                    <input type="text" name="product_destinated_to_ro" class="form-control" disabled value="{{ $products->destinated_to_ro }}" data-role="tagsinput">
                                                    @error('product_destinated_to_ro')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>

                                        </div> <!-- end col md 4 -->




                                    </div> <!-- end 5th row  -->


                                    
                                    <div class="row">

                                        

                                        <div class="col-md-3">

                                            <div class="form-group">
                                                <h5>Product weight <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="text" name="product_weight" class="form-control" disabled required="" value="{{ $products->product_weight }}">
                                                    @error('product_weight')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>

                                        </div> <!-- end col md 4 -->
                                        <div class="col-md-3">

                                            <div class="form-group">
                                                <h5>Product selling price <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="text" name="selling_price" class="form-control" disabled required="" value="{{ $products->selling_price }}">
                                                    @error('selling_price')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>

                                        </div> <!-- end col md 4 -->

                                        <div class="col-md-3">

                                            <div class="form-group">
                                                <h5>Product discount price</h5>
                                                <div class="controls">
                                                    <input type="text" name="discount_price" class="form-control" disabled value="{{ $products->discount_price }}">
                                                    @error('discount_price')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>

                                        </div> <!-- end col md 4 -->

                                        <div class="col-md-3">

                                            <div class="form-group">
                                                <h5>Product quantity <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="text" name="product_quantity" class="form-control" required="" value="{{ $products->product_qty }}" disabled>
                                                    @error('product_quantity')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>

                                        </div> <!-- end col md 4 -->
                                    </div>







                                    <div class="row">
                                        <!-- start 7th row  -->
                                        <div class="col-md-6">

                                            <div class="form-group">
                                                <h5>Short description English <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <textarea name="short_description_en" disabled id="textarea" class="form-control" required placeholder="Textarea text">
		{!! $products->short_description_en !!}
	</textarea>
                                                </div>
                                            </div>

                                        </div> <!-- end col md 6 -->

                                        <div class="col-md-6">

                                            <div class="form-group">
                                                <h5>Short description Romanian <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <textarea name="short_description_ro" disabled id="textarea" class="form-control" required placeholder="Textarea text">
		{!! $products->short_description_ro !!}
	</textarea>
                                                </div>
                                            </div>


                                        </div> <!-- end col md 6 -->

                                    </div> <!-- end 7th row  -->





                                    <div class="row">
                                        <!-- start 8th row  -->
                                        <div class="col-md-6">

                                            <div class="form-group">
                                                <h5>Long description English <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <textarea id="editor1" name="long_description_en" disabled rows="10" cols="80" required="">
		{!! $products->long_description_en !!}
						</textarea>
                                                </div>
                                            </div>

                                        </div> <!-- end col md 6 -->

                                        <div class="col-md-6">

                                            <div class="form-group">
                                                <h5>Long Description Romanian <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <textarea id="editor2" disabled name="long_description_ro" rows="10" cols="80">
		{!! $products->long_description_ro !!}
						</textarea>
                                                </div>
                                            </div>


                                        </div> <!-- end col md 6 -->

                                    </div> <!-- end 8th row  -->


                                    <hr>



                                    <div class="row">

                                        <div class="col-md-6">
                                            <div class="form-group">

                                                <div class="controls">
                                                    <fieldset>
                                                        <input type="checkbox" disabled id="checkbox_4" name="new_arrival" value="1" {{ $products->new_arrival == 1 ? 'checked': '' }}>
                                                        <label for="checkbox_4">New arrival</label>
                                                    </fieldset>

                                                    <fieldset>
                                                        <input type="checkbox" disabled id="checkbox_3" name="featured" value="1" {{ $products->featured == 1 ? 'checked': '' }}>
                                                        <label for="checkbox_3">Featured</label>
                                                    </fieldset>
                                                </div>
                                            </div>
                                        </div>



                                        <div class="col-md-6">
                                            <div class="form-group">

                                                <div class="controls">
                                                    <fieldset>
                                                        <input type="checkbox" disabled id="checkbox_2" name="hot_deals" value="1" {{ $products->hot_deals == 1 ? 'checked': '' }}>
                                                        <label for="checkbox_2">Hot deals</label>
                                                    </fieldset>
                                                    <fieldset>
                                                        <input type="checkbox" disabled id="checkbox_5" name="special_deals" value="1" {{ $products->special_deals == 1 ? 'checked': '' }}>
                                                        <label for="checkbox_5">Special deals</label>
                                                    </fieldset>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <hr>
                                    <div class="row">
                                        <!-- start 7th row  -->

                                        <div class="col-md-4">

                                            <div class="form-group">
                                                <h5>Meta title <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="text" disabled name="product_meta_title" class="form-control" required="" value="{{ $products->product_meta_title }}">
                                                    @error('product_meta_description')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>

                                        </div> <!-- end col md 4 -->
                                        <div class="col-md-4">

                                            <div class="form-group">
                                                <h5>Meta keywords <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="text" disabled name="product_meta_keywords" class="form-control" required="" value="{{ $products->product_meta_keywords }}">
                                                    @error('product_meta_keywords')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror

                                                </div>
                                            </div>


                                        </div> <!-- end col md 6 -->
                                        <div class="col-md-6">

                                            <div class="form-group">
                                                <h5>Meta description <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <textarea disabled name="product_meta_description" id="textarea" class="form-control" required>{!! $products->product_meta_description !!}</textarea>
                                                </div>
                                            </div>

                                        </div> <!-- end col md 6 -->



                        </form>

                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->

    </section>
    <!-- /.content -->


    <!-- ///////////////// Start Multiple Image Update Area ///////// -->

    <section class="content">
        <div class="row">

            <div class="col-md-12">
                <div class="box bt-3 border-info">
                    <div class="box-header">
                        <h4 class="box-title">Product multiple images</h4>
                    </div>


                    <form method="post" action="" enctype="multipart/form-data">
                        @csrf
                        <div class="row row-sm">
                            @foreach($multiImgs as $img)
                            <div class="col-md-3">

                                <div class="card">
                                    <img src="{{ asset($img->photo_name) }}" class="card-img-top" style="height: 300px; width: 300px;">
                                    <div class="card-body">



                                    </div>
                                </div>

                            </div><!--  end col md 3		 -->
                            @endforeach
                            <!-- <div class="col-md-3">
                            <label class="form-control-label">Add more images</label>
                            <input class="form-control" type="file" name="multi_image[]" multiple="" id="multiImg">
                            <div class="row" id="preview_img"></div>
                            </div> -->

                        </div>


                        <br><br>



                    </form>





                </div>
            </div>



        </div> <!-- // end row  -->

    </section>
    <!-- ///////////////// End Start Multiple Image Update Area ///////// -->



    <!-- ///////////////// Start Thambnail Image Update Area ///////// -->

    <section class="content">
        <div class="row">

            <div class="col-md-12">
                <div class="box bt-3 border-info">
                    <div class="box-header">
                        <h4 class="box-title">Product thumbnail image </h4>
                    </div>


                    <form method="post" action="" enctype="multipart/form-data">
                        @csrf

                        <input type="hidden" name="id" value="{{ $products->id }}">
                        <input type="hidden" name="old_img" value="{{ $products->product_thumbnail }}">

                        <div class="row row-sm">

                            <div class="col-md-3">

                                <div class="card">
                                    <img src="{{ asset($products->product_thumbnail) }}" class="card-img-top" style="height: 300px; width: 300px;">
                                    <div class="card-body">



                                    </div>
                                </div>

                            </div><!--  end col md 3		 -->


                        </div>


                        <br><br>



                    </form>





                </div>
            </div>



        </div> <!-- // end row  -->

    </section>
    <!-- ///////////////// End Start Thambnail Image Update Area ///////// -->



    <section class="content">
        <div class="row">

            <div class="col-md-12">
                <div class="box bt-3 border-info">
                    <div class="box-header">
                        <h4 class="box-title">Product video </h4>
                    </div>


                    <form method="post" action="" enctype="multipart/form-data">
                        @csrf

                        <input type="hidden" name="id" value="{{ $products->id }}">
                        <input type="hidden" name="old_img" value="{{ $products->product_video }}">

                        <div class="row row-sm">

                            <div class="col-md-3">

                                <div class="card">
                                    <video width="320" height="300" controls>
                                        <source src="{{ asset($products->product_video) }}">

                                        Your browser does not support the video tag.
                                    </video>

                                    <div class="card-body">



                                    </div>
                                </div>

                            </div><!--  end col md 3		 -->


                        </div>


                        <br><br>



                    </form>





                </div>
            </div>



        </div> <!-- // end row  -->

    </section>





</div>





<script type="text/javascript">
    $(document).ready(function() {
        $('select[name="category_id"]').on('change', function() {
            var category_id = $(this).val();
            if (category_id) {
                $.ajax({
                    url: "{{  url('/category/subcategory/ajax') }}/" + category_id,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        $('select[name="subsubcategory_id"]').html('');
                        var d = $('select[name="subcategory_id"]').empty();
                        $.each(data, function(key, value) {
                            $('select[name="subcategory_id"]').append('<option value="' + value.id + '">' + value.subcategory_name_en + '</option>');
                        });
                    },
                });
            } else {
                alert('danger');
            }
        });
        $('select[name="subcategory_id"]').on('change', function() {
            var subcategory_id = $(this).val();
            if (subcategory_id) {
                $.ajax({
                    url: "{{  url('/category/sub-subcategory/ajax') }}/" + subcategory_id,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        var d = $('select[name="subsubcategory_id"]').empty();
                        $.each(data, function(key, value) {
                            $('select[name="subsubcategory_id"]').append('<option value="' + value.id + '">' + value.subsubcategory_name_en + '</option>');
                        });
                    },
                });
            } else {
                alert('danger');
            }
        });

    });
</script>


<script type="text/javascript">
    function mainThamUrl(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#mainThmb').attr('src', e.target.result).width(80).height(80);
            };
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>


<script>
    $(document).ready(function() {
        $('#multiImg').on('change', function() { //on file input change
            if (window.File && window.FileReader && window.FileList && window.Blob) //check File API supported browser
            {
                var data = $(this)[0].files; //this file data

                $.each(data, function(index, file) { //loop though each file
                    if (/(\.|\/)(gif|jpe?g|png)$/i.test(file.type)) { //check supported file type
                        var fRead = new FileReader(); //new filereader
                        fRead.onload = (function(file) { //trigger function on successful read
                            return function(e) {
                                var img = $('<img/>').addClass('thumb').attr('src', e.target.result).width(80)
                                    .height(80); //create image element 
                                $('#preview_img').append(img); //append image to output element
                            };
                        })(file);
                        fRead.readAsDataURL(file); //URL representing the file's data.
                    }
                });

            } else {
                alert("Your browser doesn't support File API!"); //if File API is absent
            }
        });
    });
</script>




@endsection