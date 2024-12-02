@extends('admin.admin_master')
@section('admin')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>


<div class="container-full">
    <!-- Content Header (Page header) -->


    <!-- Main content -->
    <section class="content">

        <!-- Basic Forms -->
        <div class="box bt-3 border-info">

            <!-- /.box-header -->
            <div class="box-body">
                <div class="row">
                    <div class="col">

                        <form name="addAttributeForm" id="addAttributeForm" method="post" action="{{ route('product.add.stock',$productdata->id) }}">@csrf
                            <div class="card card-default">
                                <div class="card-header">
                                    <h3 class="card-title">Manage stock</h3>
                                    <div class="card-tools">

                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">

                                            <div class="form-group">
                                                <label for="product_name">Product name:</label> &nbsp;{{ $productdata->product_name_en }}

                                            </div>
                                            <div class="form-group">
                                                <label for="product_code">Product code:</label> &nbsp; {{ $productdata->product_code }}
                                            </div>
                                           
                                            <div class="form-group">
                                                <label for="product_color">Product price:</label> &nbsp; ${{ $productdata->selling_price }}
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <img style="width:120px;" src="{{ asset($productdata->product_thumbnail) }}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <div class="field_wrapper">
                                                    <div>
                                                        <input id="size" name="size[]" type="text" name="size[]" value="" placeholder="Size" style="width: 120px;" required="" />
                                                        <input id="sku" name="sku[]" type="text" name="sku[]" value="" placeholder="SKU" style="width: 120px;" required="" />
                                                        <input id="price" name="price[]" type="number" name="price[]" value="" placeholder="Price" style="width: 120px;" required="" />
                                                        <input id="stock" name="stock[]" type="number" name="stock[]" value="" placeholder="Stock" style="width: 120px;" required="" />
                                                        <a href="javascript:void(0);" class="add_button" title="Add field">Add</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <div class="text-xs-right">
                                        <input type="submit" class="btn btn-rounded btn-primary mb-5" value="Add stock">
                                    </div>
                                </div>
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

    <section class="content">
        <div class="row">

            <div class="col-md-12">
                <div class="box bt-3 border-info">


                    <form name="editAttributeForm" id="editAttributeForm" method="post" action="{{  route('product.update.stock',$productdata->id) }}">@csrf
                        <div class="box">
                            <div class="box-header">
                                <h3 class="card-title">Added stock</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="box-body">

                                <div class="table-responsive">

                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Size</th>
                                                <th>SKU</th>
                                                <th>Price</th>
                                                <th>Stock</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($productdata['attributes'] as $attribute)
                                            <input style="display: none;" type="text" name="attrId[]" value="{{ $attribute['id'] }}">
                                            <tr>
                                                <td>{{ $attribute['id'] }}</td>
                                                <td>{{ $attribute['size'] }}</td>
                                                <td>{{ $attribute['sku'] }}</td>
                                                <td>
                                                    <input type="number" name="price[]" value="{{ $attribute['price'] }}" required="">
                                                </td>
                                                <td>
                                                    <input type="number" name="stock[]" value="{{ $attribute['stock'] }}" required="">
                                                </td>
                                                <td>
                                                    @if($attribute['status']==1)
                                                    <a class="updateAttributeStatus" id="attribute-{{ $attribute['id'] }}" attribute_id="{{ $attribute['id'] }}" href="javascript:void(0)">Active</a>
                                                    @else
                                                    <a class="updateAttributeStatus" id="attribute-{{ $attribute['id'] }}" attribute_id="{{ $attribute['id'] }}" href="javascript:void(0)">Inactive</a>
                                                    @endif
                                                    &nbsp;&nbsp;
                                                    <a title="Delete Attribute" href="javascript:void(0)" class="confirmDelete" record="attribute" recordid="{{ $attribute['id'] }}"><i class="fa fa-trash"></i></a>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>

                                    </table>
                                </div>
                            </div>
                            <div class="card-footer">
                            <div class="text-xs-right">
                                        <input type="submit" class="btn btn-rounded btn-primary mb-5" value="Update stock">
                                    </div>
                            </div>
                            <!-- /.card-body -->
                        </div>
                    </form>



                </div>
            </div>



        </div> <!-- // end row  -->

    </section>




</div>

<script>
    // products Attributes Add/Remove Script
    var maxField = 10; //Input fields increment limitation
    var addButton = $('.add_button'); //Add button selector
    var wrapper = $('.field_wrapper'); //Input field wrapper
    var fieldHTML = '<div ><div style="height:10px;"></div><input type="text" name="size[]" style="width:120px" placeholder="Size" />&nbsp;<input type="text" name="sku[]" style="width:120px" placeholder="SKU" />&nbsp;<input type="text" name="price[]" style="width:120px" placeholder="Price" />&nbsp;<input type="text" name="stock[]" style="width:120px" placeholder="Stock" />&nbsp;<a href="javascript:void(0);" class="remove_button">Delete</a></div>'; //New input field html 
    var x = 1; //Initial field counter is 1

    //Once add button is clicked
    $(addButton).click(function() {
        //Check maximum number of input fields
        if (x < maxField) {
            x++; //Increment field counter
            $(wrapper).append(fieldHTML); //Add field html
        }
    });

    //Once remove button is clicked
    $(wrapper).on('click', '.remove_button', function(e) {
        e.preventDefault();
        $(this).parent('div').remove(); //Remove field html
        x--; //Decrement field counter
    });
</script>

<script>
    // Update Attribute Status
    $(document).on("click", ".updateAttributeStatus", function() {
        var status = $(this).text();
        var attribute_id = $(this).attr("attribute_id");
        $.ajax({
            type: 'post',
            url: '/product/stock/update-status',
            data: {
                status: status,
                attribute_id: attribute_id
            },
            success: function(resp) {
                if (resp['status'] == 0) {
                    $("#attribute-" + attribute_id).html("Inactive");
                } else if (resp['status'] == 1) {
                    $("#attribute-" + attribute_id).html("Active");
                }
            },
            error: function() {
                alert("Error");
            }
        });
    });
</script>

<script>
	// Confirm Deletion with SweetAlert
	$(document).on("click",".confirmDelete",function(){	
		var record = $(this).attr("record");
		var recordid = $(this).attr("recordid");
		Swal.fire({
		  title: 'Are you sure?',
		  text: "You won't be able to revert this!",
		  icon: 'warning',
		  showCancelButton: true,
		  confirmButtonColor: '#3085d6',
		  cancelButtonColor: '#d33',
		  confirmButtonText: 'Yes, delete it!'
		}).then((result) => {
		  if (result.value) {
		    window.location.href="/product/stock/delete/"+recordid;		    
		  }
		});
	});


</script>

@endsection