<!DOCTYPE html>
<html lang="en">
@php
$seo = App\Models\Seo::find(1);
@endphp

@php
Session::put('currency','USD');
@endphp

<head>
    <!-- Meta -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    
    <meta name="description" content="{{ $seo->meta_description }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <meta name="author" content="{{ $seo->meta_author }}">
    <meta name="keywords" content="{{ $seo->meta_keyword }}">
    <meta name="robots" content="all">
    <link rel="icon" href="{{ asset('frontend/assets/images/favicon.ico') }}">

    <!-- /// Google Analytics Code // -->
    <script>
    {{ $seo->google_analytics }}
    </script>
    <!-- /// Google Analytics Code // -->
    <title>@yield('title')</title>

    <!-- Bootstrap Core CSS -->
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/bootstrap.min.css') }}">

    <!-- Customizable CSS -->
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/blue.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/owl.carousel.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/owl.transitions.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/animate.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/rateit.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/bootstrap-select.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/easyzoom.css') }}">

    <!-- Icons/Glyphs -->
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/font-awesome.css') }}">
    <!-- Fonts -->
    <link href='http://fonts.googleapis.com/css?family=Roboto:300,400,500,700' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,400italic,600,600italic,700,700italic,800' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>

    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css">
    
    <script src="https://js.stripe.com/v3/"></script>
</head>

<body class="cnt-home">

    @include('frontend.body.header')


    @yield('content')


    @include('frontend.body.footer')

    <!-- For demo purposes – can be removed on production -->

    <!-- For demo purposes – can be removed on production : End -->

    <!-- JavaScripts placed at the end of the document so the pages load faster -->
    <script src="{{ asset('frontend/assets/js/jquery-1.11.1.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/bootstrap-hover-dropdown.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/echo.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/jquery.easing-1.3.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/bootstrap-slider.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/jquery.rateit.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/easyzoom.js') }}"></script>
    <script type="text/javascript" src="{{ asset('frontend/assets/js/lightbox.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/bootstrap-select.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/wow.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/scripts.js') }}"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <script>
        @if(Session::has('message'))
        var type = "{{ Session::get('alert-type','info') }}"
        switch (type) {
            case 'info':
                toastr.info(" {{ Session::get('message') }} ");
                break;
            case 'success':
                toastr.success(" {{ Session::get('message') }} ");
                break;
            case 'warning':
                toastr.warning(" {{ Session::get('message') }} ");
                break;
            case 'error':
                toastr.error(" {{ Session::get('message') }} ");
                break;
        }
        @endif
    </script>

    <!-- Add to Cart Product Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"><strong><span id="pname"></span> </strong></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="closeModel">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">

                    <div class="row">

                        <div class="col-md-4">

                            <div class="card" style="width: 18rem;">

                                <img src=" " class="card-img-top" alt="..." style="height: 200px; width: 200px;" id="pimage">

                            </div>

                        </div><!-- // end col md -->


                        <div class="col-md-4">

                            <ul class="list-group">
                                <li class="list-group-item">Product price: <del><span id="oldprice">$</span></del><strong class="text-danger">$<span id="pprice"></span></strong>

                                </li>
                                <li class="list-group-item">Product code: <strong id="pcode"></strong></li>
                                <li class="list-group-item">Category: <strong id="pcategory"></strong></li>
                                <li class="list-group-item">Brand: <strong id="pbrand"></strong></li>
                                <li class="list-group-item">Stock:
                                    <span class="badge badge-pill badge-success" id="available" style="background: green; color: white;"></span>
                                    <span class="badge badge-pill badge-danger" id="stockout" style="background: red; color: white;"></span>

                                </li>
                            </ul>

                        </div><!-- // end col md -->


                        <div class="col-md-4">

                            <!-- <div class="form-group">
                                <label for="color">Choose color</label>
                                <select class="form-control" id="color" name="color">


                                </select>
                            </div>  -->
                            <!-- // end form group -->


                            <div class="form-group" id="sizeArea">
                                <label for="size">Size</label>
                                <select class="form-control" id="size" name="size">


                                </select>
                            </div>
                            <!-- // end form group -->
                            <!-- <div class="form-group">
                                <label for="size">Size</label>
                                <input type="text" class="form-control" id="size" disabled>
                            </div>  -->
                            <!-- // end form group -->


                            <div class="form-group">
                                <label for="qty">Quantity</label>
                                <input type="number" class="form-control" id="qty" value="1" min="1" max="10">
                            </div> <!-- // end form group -->

                            <input type="hidden" id="product_id">
                            <button type="submit" class="btn btn-primary mb-2" onclick="addToCart()">Add to Cart</button>


                        </div><!-- // end col md -->


                    </div> <!-- // end row -->



                </div> <!-- // end modal Body -->

            </div>
        </div>
    </div>
    <!-- End Add to Cart Product Modal -->

    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        })
        // Start Product View with Modal 
        function productView(id) {
            // alert(id)
            $.ajax({
                type: 'GET',
                url: '/product/view/modal/' + id,
                dataType: 'json',
                success: function(data) {
                    //console.log(data)
                    $('#pname').text(data.product.product_name_en);
                    $('#pprice').text(data.product.selling_price);
                    $('#pcode').text(data.product.product_code);
                    $('#pcategory').text(data.product.category.category_name_en);
                    $('#pbrand').text(data.product.brand.brand_name_en);
                    $('#pimage').attr('src', '/' + data.product.product_thumbnail);
                    $('#product_id').val(id);
                    // $('#size').val(data.product.product_size_en);
                    $('#qty').val(1);

                    // Product Price 
                    if (data.product.discount_price == null) {
                        $('#pprice').text('');
                        $('#oldprice').text('');
                        $('#pprice').text(data.product.selling_price);
                    } else {
                        $('#pprice').text('');
                        $('#oldprice').text('');
                        $('#pprice').text(data.product.discount_price);
                        $('#oldprice').text(data.product.selling_price);
                    } // end product price 
                    // Stock option
                    if (data.total_stock > 0) {
                        $('#available').text('');
                        $('#stockout').text('');
                        $('#available').text('available');
                    } else {
                        $('#available').text('');
                        $('#stockout').text('');
                        $('#stockout').text('out of stock');
                    } // end Stock Option 
                    // Color
                    // $('select[name="color"]').empty();
                    // $.each(data.color, function(key, value) {
                    //     $('select[name="color"]').append('<option value=" ' + value + ' ">' + value + ' </option>')
                    // }) // end color
                    // Size
                    $('select[name="size"]').append('<option value=" ' + data.product.product_size_en + ' ">' + data.product.product_size_en + ' </option>')
                    // $('select[name="size"]').empty();
                    // $.each(data.product.product_size_en, function(key, value) {
                    //     $('select[name="size"]').append('<option value=" ' + value + ' ">' + value + ' </option>')
                    //     if (data.product.product_size_en == "") {
                    //         $('#sizeArea').hide();
                    //     } else {
                    //         $('#sizeArea').show();
                    //     }
                    // }) // end size

                }
            })

        }
        // End Product View with Modal 

        // Start Add To Cart Product 
        function addToCart() {
            var product_name = $('#pname').text();
            var id = $('#product_id').val();
            // var color = $('#color option:selected').text();
            var size = $('#size option:selected').text();
            var quantity = $('#qty').val();
            $.ajax({
                type: "POST",
                dataType: 'json',
                data: {
                    // color: color,
                    size: size,
                    quantity: quantity,
                    product_name: product_name
                },
                url: "/cart/data/store/" + id,
                success: function(data) {
                    miniCart()
                    $('#closeModel').click();
                    // console.log(data)
                    // Start Message 
                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        icon: 'success',
                        showConfirmButton: false,
                        timer: 3000
                    })
                    if ($.isEmptyObject(data.error)) {
                        Toast.fire({
                            type: 'success',
                            title: data.success
                        })
                    } else {
                        Toast.fire({
                            type: 'error',
                            title: data.error
                        })
                    }
                    // End Message 
                }
            })
        }

        // End Add To Cart Product 
    </script>

    <script type="text/javascript">
        function miniCart() {
            $.ajax({
                type: 'GET',
                url: '/product/mini/cart',
                dataType: 'json',
                success: function(response) {
                    $('span[id="cartSubTotal"]').text(response.cartTotal);
                    $('#cartQty').text(response.cartQty);
                    var miniCart = ""
                    $.each(response.carts, function(key, value) {
                        miniCart += `<div class="cart-item product-summary">
          <div class="row">
            <div class="col-xs-4">
              <div class="image"> <a href="{{url('/product/details/${value.id}')}}"><img src="/${value.options.image}" alt=""></a> </div>
            </div>
            <div class="col-xs-7">
              <h3 class="name"><a href="{{url('/product/details/${value.id}')}}">${value.name}</a></h3>
              <div class="price">$${value.price} x ${value.qty} </div>
            </div>
            <div class="col-xs-1 action"> 
            <button type="submit" id="${value.rowId}" onclick="miniCartRemove(this.id)"><i class="fa fa-trash"></i></button> </div>
          </div>
        </div>
        <!-- /.cart-item -->
        <div class="clearfix"></div>
        <hr>`
                    });

                    $('#miniCart').html(miniCart);
                }
            })
        }
        miniCart();
        /// mini cart remove Start 
        function miniCartRemove(rowId) {
            $.ajax({
                type: 'GET',
                url: '/minicart/product-remove/' + rowId,
                dataType: 'json',
                success: function(data) {
                    miniCart();
                    cart();
                    couponCalculation();
                    location.reload();
                    // Start Message 
                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        icon: 'success',
                        showConfirmButton: false,
                        timer: 3000
                    })
                    if ($.isEmptyObject(data.error)) {
                        Toast.fire({
                            type: 'success',
                            title: data.success
                        })
                    } else {
                        Toast.fire({
                            type: 'error',
                            title: data.error
                        })
                    }
                    // End Message 
                }
            });
        }
        //  end mini cart remove 
    </script>

    <!--  /// Start Add to Wishlist  //// -->

    <script type="text/javascript">
        function addToWishList(product_id) {
            $.ajax({
                type: "POST",
                dataType: 'json',
                url: "/add-to-wishlist/" + product_id,
                success: function(data) {
                    // Start Message 
                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',

                        showConfirmButton: false,
                        timer: 3000
                    })
                    if ($.isEmptyObject(data.error)) {
                        Toast.fire({
                            type: 'success',
                            icon: 'success',
                            title: data.success
                        })
                    } else {
                        Toast.fire({
                            type: 'error',
                            icon: 'error',
                            title: data.error
                        })
                    }
                    // End Message 
                }
            })
        }
    </script>

    <!--  /// End Add to Wishlist   ////   -->

    <!-- /// Load Wishlist Data  -->


    <script type="text/javascript">
        function wishlist() {
            $.ajax({
                type: 'GET',
                url: '/user/get-wishlist-product',
                dataType: 'json',
                success: function(response) {
                    var rows = ""
                    $.each(response, function(key, value) {
                        rows += `<tr>
                    <td class="col-md-2"><img src="/${value.product.product_thumbnail} " alt="imga"></td>
                    <td class="col-md-7">
                        <div class="product-name"><a href="{{url('/product/details/${value.product.id}')}}">${value.product.product_name_en}</a></div></td>
                       
                         
                        <div class="price">
                        ${value.product.discount_price == null
                            ? `$${value.product.selling_price}`
                            :
                            `$${value.product.discount_price}`
                        }
                            
                        </div>
                    </td>
        <td class="col-md-2">
            <button class="btn btn-primary icon" type="button" title="Add Cart" data-toggle="modal" data-target="#exampleModal" id="${value.product_id}" onclick="productView(this.id)"> Add to Cart </button>
        </td>
        <td class="col-md-1 close-btn">
            <button type="submit" class="" id="${value.id}" onclick="wishlistRemove(this.id)"><i class="fa fa-times"></i></button>
        </td>
                </tr>`
                    });

                    $('#wishlist').html(rows);
                }
            })
        }

        wishlist();
        ///  Wishlist remove Start 
        function wishlistRemove(id) {
            $.ajax({
                type: 'GET',
                url: '/user/wishlist-remove-product/' + id,
                dataType: 'json',
                success: function(data) {
                    wishlist();
                    // Start Message 
                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',

                        showConfirmButton: false,
                        timer: 3000
                    })
                    if ($.isEmptyObject(data.error)) {
                        Toast.fire({
                            type: 'success',
                            icon: 'success',
                            title: data.success
                        })
                    } else {
                        Toast.fire({
                            type: 'error',
                            icon: 'error',
                            title: data.error
                        })
                    }
                    // End Message 
                }
            });
        }
        // End Wishlist remove   
    </script>

    <!-- /// Load My Cart /// -->

    <script type="text/javascript">
        function cart() {
            $.ajax({
                type: 'GET',
                url: '/user/get-cart-product',
                dataType: 'json',
                success: function(response) {
                    var rows = ""
                    $.each(response.carts, function(key, value) {
                        rows += `<tr>
        <td class="col-md-2"><img src="/${value.options.image} " alt="imga" style="width:60px; height:60px;"></td>
        
        <td class="col-md-2">
            <div class="product-name"><a href="{{url('/product/details/${value.id}')}}">${value.name}</a></div></td>
             
            <td class="col-md-2"><div class="price"> 
            <strong>  $${value.price} </strong>     
                        </div>
                    </td>
          
         <td class="col-md-2">
          ${value.options.size == null
            ? `<span> Standard </span>`
            :
          `<strong>${value.options.size} </strong>` 
          }           
            </td>
           <td class="col-md-2">
           ${value.qty > 1
            ? `<button type="submit" class="btn btn-danger btn-sm" id="${value.rowId}" onclick="cartDecrement(this.id)" >-</button> `
            : `<button type="submit" class="btn btn-danger btn-sm" disabled >-</button> `
            }
        
        <input type="text" value="${value.qty}" min="1" max="10" disabled="" style="width:25px;" >  
         <button type="submit" class="btn btn-success btn-sm" id="${value.rowId}" onclick="cartIncrement(this.id)" >+</button>    
         
            </td>
             <td class="col-md-2">
            <strong>$${value.subtotal} </strong> 
            </td>
         
        <td class="col-md-1 close-btn">
            <button type="submit" class="" id="${value.rowId}" onclick="cartRemove(this.id)"><i class="fa fa-times"></i></button>
        </td>
                </tr>`
                    });

                    $('#cartPage').html(rows);
                }
            })
        }
        cart();
        ///  Cart remove Start 
        function cartRemove(id) {
            $.ajax({
                type: 'GET',
                url: '/user/cart-remove/' + id,
                dataType: 'json',
                success: function(data) {
                    location.reload();

                    cart();
                    miniCart();
                    couponCalculation();
                    $('#couponField').show();
                    $('#coupon_name').val('');
                    // Start Message 
                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',

                        showConfirmButton: false,
                        timer: 3000
                    })
                    if ($.isEmptyObject(data.error)) {
                        Toast.fire({
                            type: 'success',
                            icon: 'success',
                            title: data.success
                        })
                    } else {
                        Toast.fire({
                            type: 'error',
                            icon: 'error',
                            title: data.error
                        })
                    }
                    // End Message 
                }
            });
        }
        // End Cart remove   
        // -------- CART INCREMENT --------//
        function cartIncrement(rowId) {
            $.ajax({
                type: 'GET',
                url: "/cart-increment/" + rowId,
                dataType: 'json',
                success: function(data) {
                    couponCalculation();
                    cart();
                    miniCart();
                    //couponCalculation();
                    //location.reload();
                }
            });
        }
        // ---------- END CART INCREMENT -----///
        // -------- CART Decrement  --------//
        function cartDecrement(rowId) {
            $.ajax({
                type: 'GET',
                url: "/cart-decrement/" + rowId,
                dataType: 'json',
                success: function(data) {
                    couponCalculation();
                    cart();
                    miniCart();
                    //couponCalculation();
                    //location.reload();
                }
            });
        }
        // ---------- END CART Decrement -----///
    </script>

    <!--  //////////////// =========== Coupon Apply Start ================= ////  -->
    <script type="text/javascript">
        function applyCoupon() {
            var coupon_name = $('#coupon_name').val();
            $.ajax({
                type: 'POST',
                dataType: 'json',
                data: {
                    coupon_name: coupon_name
                },
                url: "{{ url('/coupon-apply') }}",
                success: function(data) {
                    couponCalculation();
                    miniCart();
                    if (data.validity == true) {
                        $('#couponField').hide();
                    }

                    // Start Message 
                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',

                        showConfirmButton: false,
                        timer: 3000
                    })
                    if ($.isEmptyObject(data.error)) {
                        Toast.fire({
                            type: 'success',
                            icon: 'success',
                            title: data.success
                        })
                    } else {
                        Toast.fire({
                            type: 'error',
                            icon: 'error',
                            title: data.error
                        })
                    }
                    // End Message 
                }
            })
        }

        function couponCalculation() {
            $.ajax({
                type: 'GET',
                url: "{{ url('/coupon-calculation') }}",
                dataType: 'json',
                success: function(data) {
                    if (data.total) {
                        $('#couponCalField').html(
                            ` <thead>
    <tr>
      
    </tr>
  </thead>
  <tbody>
    <tr >
      <th scope="row">Subtotal</th>
      <td class="font-weight-bold">$${data.subtotal}</td>
     
    </tr>
    <tr class="font-weight-bold">
      <th scope="row">Of which taxes</th>
      <td>$${data.tax}</td>
     
    </tr>

   
  
	<hr>
	<tr class="cart-grand-total text-success font-weight-bold">
      <th scope="row">Grand total</th>
      <td>$${data.total}</td>
     
    </tr>
  </tbody>`
                        )
                    } else {
                        $('#couponCalField').html(
                            `   <thead>
    <tr>
      
    </tr>
  </thead>
  <tbody>
    <tr class="font-weight-bold">
      <th scope="row">Subtotal</th>
      <td>$${data.subtotal_amount}</td>
     
    </tr>
    <tr class="font-weight-bold">
    <th scope="row">Of whics taxes</th>
      <td>$${data.tax_amount}</td>
     
    </tr>

    
    <tr class="font-weight-bold">
      <th scope="row">Total without discount</th>
      <td>$${data.total_without_discount}</td>
     
    </tr>
    <tr class="font-weight-bold">
      <th scope="row">Coupon</th>
      <td>${data.coupon_name} 
	  <button type="submit" onclick="couponRemove()"><i class="fa fa-times"></i>  </button>
	  </td>
     
    </tr>
	<tr class="text-danger font-weight-bold">
      <th scope="row">Discount</th>
      <td>$${data.discount_amount}</td>
     <hr>
    </tr>
	<tr class="cart-grand-total text-success font-weight-bold">
      <th scope="row">Grand total</th>
      <td>$${data.total_amount}</td>
     
    </tr>
    
  </tbody>`
                        )
                    }
                }
            });
        }
        couponCalculation();
    </script>

    <!--  //////////////// =========== End Coupon Apply Start ================= ////  -->


    <!--  //////////////// =========== Start Coupon Remove================= ////  -->

    <script type="text/javascript">
        function couponRemove() {
            $.ajax({
                type: 'GET',
                url: "{{ url('/coupon-remove') }}",
                dataType: 'json',
                success: function(data) {
                    location.reload();
                    couponCalculation();
                    $('#couponField').show();
                    $('#coupon_name').val('');
                    // Start Message 
                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',

                        showConfirmButton: false,
                        timer: 3000
                    })
                    if ($.isEmptyObject(data.error)) {
                        Toast.fire({
                            type: 'success',
                            icon: 'success',
                            title: data.success
                        })
                    } else {
                        Toast.fire({
                            type: 'error',
                            icon: 'error',
                            title: data.error
                        })
                    }
                    // End Message 
                }
            });
        }
    </script>


    <!--  //////////////// =========== End Coupon Remove================= ////  -->
    <script>
        // Instantiate EasyZoom instances
        var $easyzoom = $('.easyzoom').easyZoom();

        // Setup thumbnails example
        var api1 = $easyzoom.filter('.easyzoom--with-thumbnails').data('easyZoom');

        $('.thumbnails').on('click', 'a', function(e) {
            var $this = $(this);

            e.preventDefault();

            // Use EasyZoom's `swap` method
            api1.swap($this.data('standard'), $this.attr('href'));
        });

        // Setup toggles example
        var api2 = $easyzoom.filter('.easyzoom--with-toggle').data('easyZoom');

        $('.toggle').on('click', function() {
            var $this = $(this);

            if ($this.data("active") === true) {
                $this.text("Switch on").data("active", false);
                api2.teardown();
            } else {
                $this.text("Switch off").data("active", true);
                api2._init();
            }
        });
    </script>

    <script type="text/javascript">
       $(document).on('click','#btnCancelOrder',function(e){
        e.preventDefault();
        var link = $(this).attr("href");

  
                  Swal.fire({
                    title: 'Are you sure?',
                    text: "Do you really want to cancel this order?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, cancel it!'
                  }).then((result) => {
                    if (result.isConfirmed) {
                      window.location.href = link
                      Swal.fire(
                        'Cancelled!',
                        'Order cancelled successfully.',
                        'success'
                      )
                    }

                    
                  }) 


    });
    </script>



    <script type="text/javascript">
        function addSubscriber() {
            var subscriberEmail = $("#subscriber_email").val();
           
            var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
            
            if(regex.test(subscriberEmail)==false){
                alert("Please enter a valid email!");
                return false;
            }

            $.ajax({
                type:'post',
                url:'/add-subscriber-email',
               
                dataType: 'json',
                success: function(data) {
                    alert(data.success);
                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',

                        showConfirmButton: false,
                        timer: 3000
                    })
                    if ($.isEmptyObject(data.error)) {
                        Toast.fire({
                            type: 'success',
                            icon: 'success',
                            title: data.success
                        })
                    } else {
                        Toast.fire({
                            type: 'error',
                            icon: 'error',
                            title: data.error
                        })
                    }
                    // End Message 
                }
                
            });

           


        }

        
    </script>

</body>

</html>