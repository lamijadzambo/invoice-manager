@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header"><h1>Order #{{$order->id}}</h1></div>
                    <div class="card-body">
                        <div class="order-export">
                            <div class="summary-title mb-3 mt-3">
                                <h4>EXPORT ORDER</h4>
                            </div>
                            <div class="d-flex mt-3 mb-5">
                                <a href="{{ route('generate-pdf', ['project_id'=>$project_id, 'id'=>$order->id, 'customer_id' => App\Models\Order::$man] ) }}" class="btn btn-dark mr-2"><i class="fas fa-file-download mr-1"></i> PDF Man</a>
                                <a href="{{ route('generate-pdf', ['project_id'=>$project_id, 'id'=>$order->id, 'customer_id' => App\Models\Order::$woman]) }}" class="btn btn-dark mr-2"><i class="fas fa-file-download mr-1"></i> PDF Woman</a>
                                <a href="{{ route('generate-doc', ['project_id'=>$project_id, 'id'=>$order->id, 'customer_id' => App\Models\Order::$man]) }}" class="btn btn-info mr-2"><i class="fas fa-file-download mr-1"></i> Word Man</a>
                                <a href="{{ route('generate-doc', ['project_id'=>$project_id, 'id'=>$order->id, 'customer_id' => App\Models\Order::$woman]) }}" class="btn btn-info"><i class="fas fa-file-download mr-1"></i> Word Woman</a>
                            </div>
                        </div>
                        <div class="d-flex justify-content-around mb-5">
                            <div class="order-details">
                                <div class="order-title mb-4">
                                    <h4>ORDER DETAILS</h4>
                                </div>
                                <div class="order-number">
                                    <p><strong>ORDER NUMBER:</strong> {{$order->id}}</p>
                                </div>
                                <div class="order-date">
                                    <p><strong>ORDERED AT:</strong> {{$order->order_date}}</p>
                                </div>
                                <div class="order-status">
                                    <p><strong>STATUS:</strong> {{$order->order_status}}</p>
                                </div>
                            </div>

                            <div class="billing-details">
                                <div class="billing-title mb-4">
                                    <h4>BILLING DETAILS</h4>
                                </div>
                                <div class="billing-company">
                                    <p><strong>COMPANY:</strong> {{$order->billing_company}}</p>
                                </div>
                                <div class="name">
                                    <p>
                                        <strong>NAME:</strong> {{$order->billing_first_name}} {{$order->billing_last_name}}
                                    </p>
                                </div>
                                <div class="billing-address">
                                    <p><strong>ADDRESS:</strong> {{$order->billing_address}}</p>
                                </div>
                                <div class="billing-city">
                                    <p><strong>CITY:</strong> {{$order->billing_post_code}} {{$order->billing_city}}</p>
                                </div>
                                <div class="billing-email">
                                    <p><strong>EMAIL:</strong> {{$order->billing_email}}</p>
                                </div>
                                <div class="billing-phone">
                                    <p><strong>PHONE:</strong> {{$order->billing_phone}}</p>
                                </div>
                            </div>


                            <div class="shipping-details">
                                <div class="shipping-title mb-4">
                                    <h4>SHIPPING DETAILS</h4>
                                </div>
                                <div class="shipping-company">
                                    <p><strong>COMPANY:</strong> {{$order->shipping_company}}</p>
                                </div>
                                <div class="name">
                                    <p>
                                        <strong>NAME:</strong> {{$order->shipping_first_name}} {{$order->shipping_last_name}}
                                    </p>
                                </div>
                                <div class="billing-address">
                                    <p><strong>ADDRESS:</strong> {{$order->shipping_address}}</p>
                                </div>
                                <div class="billing-city">
                                    <p><strong>CITY:</strong> {{$order->shipping_post_code}} {{$order->shipping_city}}
                                    </p>
                                </div>
                            </div>

                            <div class="order-summary">
                                <div class="summary-title mb-4">
                                    <h4>BREAKDOWN</h4>
                                </div>
                                @foreach(json_decode($order->products) as $product)
                                    <div class="products-total">
                                        <p><strong>PRICE OF PRODUCTS:</strong> {{$product->subtotal}}</p>
                                    </div>
                                @endforeach
                                <div class="shipping-price">
                                    <p><strong>SHIPPING PRICE:</strong> {{$order->order_shipping_amount}}</p>
                                </div>
                                <div class="tax">
                                    <p><strong>TAX:</strong> {{$order->order_total_tax_amount}}</p>
                                </div>
                                <div class="total-price">
                                    <p><strong>TOTAL PRICE:</strong> {{$order->order_total_amount}}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="products-details mb-3 mt-3">
                            <div class="product-title  mb-3 mt-3">
                                <h4>PRODUCT DETAILS</h4>
                            </div>
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>PRODUCT NAME</th>
                                        <th>SKU</th>
                                        <th>PRODUCT PRICE</th>
                                        <th>PRODUCT VARIATION</th>
                                        <th>PRODUCT QUANTITY</th>
                                        <th>PRODUCT SUBTOTAL</th>
                                        <th>SHIPPING TYPE</th>
                                        <th>SHIPPING PRICE</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach(json_decode($order->products) as $product)
                                        <tr>
                                            <td>{{ $productName = str_replace(['<span>', '</span>'], '', $product->name) }}</td>
                                            <td>{{ $product->sku }}</td>
                                            <td>{{$product->price}}</td>
                                            @if($product->meta_data)
                                                @foreach($product->meta_data as $item)
                                                        <td>{{$item->value}}</td>
                                                @endforeach
                                            @elseif(!$product->meta_data)
                                                <td>{{''}}</td>
                                            @endif
                                            <td>{{$product->quantity}}</td>
                                            <td>{{$product->subtotal}}</td>
                                            <td>{{$order->shipping_method_title}}</td>
                                            <td>{{$order->order_shipping_amount}}</td>
                                        </tr>
                                    @endforeach

                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>PRODUCT NAME</th>
                                        <th>SKU</th>
                                        <th>PRODUCT PRICE</th>
                                        <th>PRODUCT VARIATION</th>
                                        <th>PRODUCT QUANTITY</th>
                                        <th>PRODUCT SUBTOTAL</th>
                                        <th>SHIPPING TYPE</th>
                                        <th>SHIPPING PRICE</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
