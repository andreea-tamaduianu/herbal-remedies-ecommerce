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
                <h4 class="box-title">Add product </h4>

            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div class="row">
                    <div class="col">

                        <form method="post" action="{{ route('product.store') }}" enctype="multipart/form-data">
                            @csrf

                            <div class="row">
                                <div class="col-12">


                                    <div class="row">
                                        <!-- start 1st row  -->
                                        <div class="col-md-3">

                                            <div class="form-group">
                                                <h5>Brand select <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <select name="brand_id" class="form-control" required="">
                                                        <option value="" selected="" disabled="">Select brand</option>
                                                        @foreach($brands as $brand)
                                                        <option value="{{ $brand->id }}">{{ $brand->brand_name_en }}</option>
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
                                                <h5>Category select <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <select name="category_id" class="form-control" required="">
                                                        <option value="" selected="" disabled="">Select category</option>
                                                        @foreach($categories as $category)
                                                        <option value="{{ $category->id }}">{{ $category->category_name_en }}</option>
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
                                                <h5>Subcategory select <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <select name="subcategory_id" class="form-control" required="">
                                                        <option value="" selected="" disabled="">Select subcategory</option>

                                                    </select>
                                                    @error('subcategory_id')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>

                                        </div> <!-- end col md 4 -->

                                        <div class="col-md-3">

                                            <div class="form-group">
                                                <h5>Sub-subcategory select <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <select name="subsubcategory_id" class="form-control" required="">
                                                        <option value="" selected="" disabled="">Select sub-subcategory</option>

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
                                                    <input type="text" name="product_name_en" class="form-control" required="">
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
                                                    <input type="text" name="product_name_ro" class="form-control" required="">
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
                                                    <input type="text" name="product_code" class="form-control" required="">
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
                                                    <input type="text" name="product_size_en" class="form-control" value="" data-role="tagsinput" required="">
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
                                                    <input type="text" name="product_size_ro" class="form-control" value="" data-role="tagsinput" required="">
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
                                                    <input type="text" name="product_tags_en" class="form-control" value="" data-role="tagsinput">
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
                                                    <input type="text" name="product_tags_ro" class="form-control" value="" data-role="tagsinput">
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
                                                    <input type="text" name="product_type_en" class="form-control" value="" data-role="tagsinput">
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
                                                    <input type="text" name="product_type_ro" class="form-control" value="" data-role="tagsinput">
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
                                                    <input type="text" name="product_benefit_en" class="form-control" value="" data-role="tagsinput">
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
                                                    <input type="text" name="product_benefit_ro" class="form-control" value="" data-role="tagsinput">
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
                                                    <input type="text" name="product_mode_of_use_en" class="form-control" value="" data-role="tagsinput">
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
                                                    <input type="text" name="product_mode_of_use_ro" class="form-control" value="" data-role="tagsinput">
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
                                                    <input type="text" name="product_destinated_to_en" class="form-control" value="" data-role="tagsinput">
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
                                                    <input type="text" name="product_destinated_to_ro" class="form-control" value="" data-role="tagsinput">
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
                                                    <input type="text" name="product_weight" class="form-control" required="">
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
                                                    <input type="text" name="selling_price" class="form-control" required="">
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
                                                    <input type="text" name="discount_price" class="form-control">
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
                                                    <input type="text" name="product_quantity" class="form-control" required="">
                                                    @error('product_quantity')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>

                                        </div> <!-- end col md 4 -->
                                    </div>

                                    <div class="row">
                                        <!-- start 3RD row  -->







                                    </div> <!-- end 3RD row  -->

                                    <div class="row">
                                        <!-- start 6th row  -->


                                        <div class="col-md-4">

                                            <div class="form-group">
                                                <h5>Main thumbnail <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="file" name="product_thumbnail" class="form-control" onChange="mainThamUrl(this)" required="">
                                                    @error('product_thumbnail')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                    <img src="" id="mainThmb">
                                                </div>
                                            </div>


                                        </div> <!-- end col md 4 -->


                                        <div class="col-md-4">

                                            <div class="form-group">
                                                <h5>Multiple images <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="file" name="multi_img[]" class="form-control" multiple="" id="multiImg" required="">
                                                    @error('multi_img')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                    <div class="row" id="preview_img"></div>

                                                </div>
                                            </div>


                                        </div> <!-- end col md 4 -->

                                        <div class="col-md-4">

                                            <div class="form-group">
                                                <h5>Product video <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="file" name="product_video" class="form-control" id="product_video">
                                                    @error('product_video')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror


                                                </div>
                                            </div>


                                        </div> <!-- end col md 4 -->


                                    </div> <!-- end 6th row  -->





                                    <div class="row">
                                        <!-- start 7th row  -->
                                        <div class="col-md-6">

                                            <div class="form-group">
                                                <h5>Short description English <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <textarea name="short_description_en" id="textarea" class="form-control" required></textarea>
                                                </div>
                                            </div>

                                        </div> <!-- end col md 6 -->

                                        <div class="col-md-6">

                                            <div class="form-group">
                                                <h5>Short description Romanian <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <textarea name="short_description_ro" id="textarea" class="form-control" required></textarea>
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
                                                    <textarea id="editor1" name="long_description_en" rows="10" cols="80" required="">

						</textarea>
                                                </div>
                                            </div>

                                        </div> <!-- end col md 6 -->

                                        <div class="col-md-6">

                                            <div class="form-group">
                                                <h5>Long description Romanian <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <textarea id="editor2" name="long_description_ro" rows="10" cols="80">

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
                                                        <input type="checkbox" id="checkbox_4" name="new_arrival" value="1">
                                                        <label for="checkbox_4">New arrival</label>
                                                    </fieldset>

                                                    <fieldset>
                                                        <input type="checkbox" id="checkbox_3" name="featured" value="1">
                                                        <label for="checkbox_3">Featured</label>
                                                    </fieldset>
                                                </div>
                                            </div>
                                        </div>



                                        <div class="col-md-6">
                                            <div class="form-group">

                                                <div class="controls">
                                                    <fieldset>
                                                        <input type="checkbox" id="checkbox_2" name="hot_deals" value="1">
                                                        <label for="checkbox_2">Hot deals</label>
                                                    </fieldset>
                                                    <fieldset>
                                                        <input type="checkbox" id="checkbox_5" name="special_deals" value="1">
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
                                                    <input type="text" name="product_meta_title" class="form-control" required="">
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
                                                    <input type="text" name="product_meta_keywords" class="form-control" required="">
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
                                                    <textarea name="product_meta_description" id="textarea" class="form-control" required></textarea>
                                                </div>
                                            </div>

                                        </div> <!-- end col md 6 -->



                                    </div> <!-- end 7th row  -->










                                    <div class="text-xs-right">
                                        <input type="submit" class="btn btn-rounded btn-primary mb-5" value="Add">
                                    </div>
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