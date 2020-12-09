<!DOCTYPE html>
<html>
<head>
    <title>Bestellung</title>
    <link href="{{asset('public/fonts/Roboto-regular.ttf')}}" rel="stylesheet">

    <style>
        body {
            position: relative;
            width: 17cm;
            height: 29.7cm;
            margin: 0 auto;
            color: #001028;
            background: #FFFFFF;
            font-family: Roboto, Arial, sans-serif;
            font-size: 12px;
        }

        .customer-info {
            font-size: 16px;
        }

        .header-image {
            margin-bottom: 85px;
            margin-top: -20px;
        }

        .customer-info {
            margin-bottom: 70px;
            padding-left: 15px;
        }

        .order-number {
            font-size: 20px;
            margin-bottom: 10px;
            padding-left: 15px;
        }

        .invoice-date {
            margin-left: 385px;
        }

        .thank-customer {
            font-size: 13px;
            margin-top: 20px;
            font-weight: 400;
            line-height: 40px;
            padding-left: 15px;
        }

        .red-bar {
            height: 15px;
            background-color: #FF0000;
            color: #ffffff;
            padding-left: 10px;
            margin-top: 15px;
            border: 1px solid black;
        }

        .product-name-quantity {
            margin-top: 20px;
            padding-left: 15px;
        }

        .ordered-quantity {
            padding-left: 250px;
        }

        .post-type {
            margin-top: 50px;
            padding-left: 15px;
        }

        .horizontal-line {
            background-color: #4a5568;
            height: 2px;
            margin-top: 50px;
        }

        .questions {
            font-size: 13px;
            font-weight: 400;
            margin-top: 20px;
        }

        .signature {
            font-size: 14px;
            font-weight: 530;
            margin-left: 430px;
            line-height: 40px;
        }

        .footer {
            width: 100%;
            height: 100px;
            position: absolute;
            bottom: 0;
        }

        .contact-info {
            padding-bottom: 50px;
            margin-bottom: 50px;
        }

        .footer-image img {
            margin-left: 230px;
            padding-top: 38px;
            width: 90px;
        }
    </style>
</head>

<body>

<div class="container">
    <div class="header-image">
        <img src="{{asset('img/masken.png')}}" style="width: 100px; height: 120px;"/>
    </div>
    <div class="customer-info">
        <strong>{{$order->shipping_company}}</strong><br>
        <strong>{{$order->shipping_first_name}} {{$order->shipping_last_name}}</strong><br>
        <strong>{{$order->shipping_address}}</strong><br>
        <strong>{{$order->shipping_post_code}} {{$order->shipping_city}}</strong>
    </div>

    <div class="order-number">
        <strong>LIEFERSCHEIN / {{$order->id}}</strong>
    </div>


    <div class="invoice-date">
        8317 Tagelswangen, {{date('j. F. Y')}}
    </div>

    <div class="thank-customer">
        {{App\Models\Order::$message_woman}} {{$order->shipping_last_name}}<br/>{{App\Models\Order::$thx_message}}
    </div>

    <div class="red-bar">Artikel-/Leistungsbeschrieb</div>


    @foreach(json_decode($order->products) as $product)



        <div class="product-name-quantity">
            <table>
                <tr>
                    <td style="width:250px"><div><strong>{{str_replace(['<span>', '</span>'], '', $product->name)}}</strong></div></td>
                    <td style="width:150px"><div class="ordered-quantity"><strong>{{$product->quantity}}</strong></div></td>
                    <td style="width:150px"><div><strong>{{App\Models\Order::$piece}}</strong></div></td>
                </tr>
            </table>
        </div>
    @endforeach

    {{--@foreach($order->products as $product)
        <div class="product-name-quantity">
            <table>
                <tr>
                    <td style="width:250px">
                        <div><strong>{{$product->name}} - {{$product->color}}</strong></div>
                    </td>
                    <td style="width:150px">
                        <div class="ordered-quantity"><strong>{{$product->ordered_quantity}}</strong></div>
                    </td>
                    <td style="width:150px">
                        <div><strong>{{App\Models\Order::$piece}}</strong></div>
                    </td>
                </tr>
            </table>
        </div>
    @endforeach--}}

    <div class="post-type">
        <strong>{{$order->shipping_method_title}}</strong>
    </div>

    <div class="horizontal-line"></div>

    <div class="questions">
        {{App\Models\Order::$questions}}
    </div>

    <div class="signature">
        Freundliche Grüsse <br> Reto Schaufelberger
    </div>

    <div class="footer">

        <table>
            <tr>
                <th></th>
                <th></th>
            </tr>
            <tr>
                <td>
                    <span class="contact-info">Reto Schaufelberger Eurotrends GmbH <br>
                        Hinterrietstrasse 1<br>
                        ch-8317 Tagelswangen <br>
                        + 41 43 321 29 29 <br>
                        info@atemschutzmasken24.ch <br>
                        www.atemschutzmasken24.ch<br>
                    </span>
                </td>
                <td>
                    <span class="footer-image">
                        <img src="{{asset('img/masken.png')}}"/>
                    </span>
                </td>
            </tr>
        </table>
    </div>
</div>


</body>
</html>




