<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Invoice</title>

  <style type="text/css">
    * {
      font-family: Verdana, Arial, sans-serif;
    }

    table {
      font-size: x-small;
    }

    tfoot tr td {
      font-weight: bold;
      font-size: x-small;
    }

    .gray {
      background-color: lightgray
    }

    .font {
      font-size: 15px;
    }

    .authority {
      /*text-align: center;*/
      float: right
    }

    .authority h5 {
      margin-top: -10px;
      color: blue;
      /*text-align: center;*/
      margin-left: 35px;
    }

    .thanks p {
      color: blue;
      ;
      font-size: 16px;
      font-weight: normal;
      font-family: serif;
      margin-top: 20px;
    }
  </style>

</head>

<body>

  @php
  $setting = App\Models\SiteSetting::find(1);
  @endphp

  <table width="100%" style="background: #F7F7F7; padding:0 20px 0 20px;">
    <tr>
      <td valign="top">
        <!-- {{-- <img src="" alt="" width="150"/> --}} -->
        <h2 style="color: blue; font-size: 26px;"><strong>Herbal Remedies</strong></h2>
      </td>
      <td align="right">
        <pre class="font">
        {{ $setting->company_name }}
               Email: {{ $setting->email }} <br>
               Mobile: {{ $setting->phone_one }} <br>
               {{ $setting->company_address }} <br>
              
            </pre>
      </td>
    </tr>

  </table>


  <table width="100%" style="background:white; padding:2px;""></table>
  <table width=" 100%" style="background: #F7F7F7; padding:0 5 0 5px;" class="font">
    <tr>
      <td>
        <p class="font" style="margin-left: 20px;">
          <strong>Name:</strong> {{ $order->name }}<br>
          <strong>Email:</strong> {{ $order->email }} <br>
          <strong>Phone:</strong> {{ $order->phone }} <br>
          @php
          $div = $order->division->division_name;
          $dis = $order->district->district_name;
          $state = $order->state->state_name;
          @endphp

          <strong>Address:</strong> {{ $order->address }} <br>
          <strong>City:</strong> {{ $state }} <br>
          <strong>County:</strong> {{ $dis }} <br>
          <strong>Country:</strong> {{ $div }} <br>
          <strong>Zip code:</strong> {{ $order->post_code }}
        </p>
      </td>
      <td>
        <p class="font">
        <h3><span style="color: blue;">Invoice:</span> #{{ $order->invoice_no}}</h3>
        <br>
        <span>
          <?php echo DNS1D::getBarcodeHTML('4445645656', 'C39'); ?>
        </span>
        Order Date: <td> {{ Carbon\Carbon::parse($order->created_at)->format('d-m-Y, g:i a')}} </td> <br>
        Delivery Date: {{ $order->delivered_date }} <br>
        Payment Type : {{ $order->payment_method }} </span>
        </p>
      </td>
    </tr>
  </table>
  <br />
  <h3>Products</h3>
  <table width="100%">
    <thead style="background-color: blue; color:#FFFFFF;">
      <tr class="font">
        <th>Image</th>
        <th>Product Name</th>
        <th>Size</th>
        <th>Code</th>
        <th>Quantity</th>
        <th>Unit Price </th>
        <th>Discount </th>
        <th>Total </th>
      </tr>
    </thead>
    <tbody>
      @foreach($orderItem as $item)
      <tr class="font">
        <td align="center">
          <img src="{{ public_path($item->product->product_thambnail)  }}" height="60px;" width="60px;" alt="">
        </td>
        <td align="center"> {{ $item->product->product_name_en }}</td>
        <td align="center">
          @if($item->size == NULL)
          ----
          @else
          {{ $item->size }}
          @endif

        </td>
        <td align="center">{{ $item->product->product_code }}</td>
        <td align="center">{{ $item->qty }}</td>
        <td align="center">${{ $item->price }}</td>
        @if($item->coupon_name!=NULL)
        <td align="center">${{ $item->price*$order->coupon_discount/100 }}</td>
        <td align="center">${{ $item->price*(1-$order->coupon_discount/100) * $item->qty }} </td>
        @else
        <td align="center">-</td>
        <td align="center">${{ $item->price * $item->qty }} </td>
        @endif

      </tr>
      @endforeach

    </tbody>
  </table>
  <br>
  <table width="100%" style=" padding:0 10px 0 10px;">
    <tr>
      <td align="right">
        <h2><span style="color: blue;">Subtotal:</span> ${{ $order->amount }}</h2>
        <h2><span style="color: blue;">Of which taxes:</span> ${{ $order->amount*0.09}}</h2>
        <h2><span style="color: blue;">Shipping taxes:</span> $0</h2>
        @if($order->coupon_name!=NULL)
        <h2><span style="color: blue;">Discount:</span> - ${{$order->coupon_discount}}</h2>
        @else

        @endif
        <h2><span style="color: blue;">Total:</span> ${{ $order->amount }}</h2>

      </td>
    </tr>
  </table>
  <div class="thanks mt-3">
    <p>Thank you for buying our products!</p>
  </div>
  <div class="authority float-right mt-5">
    <p>-----------------------------------</p>
    <h5>Authority Signature:</h5>
  </div>
</body>

</html>