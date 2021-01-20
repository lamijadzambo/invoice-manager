@extends('layouts.app')

@section('content')

    @if(Auth::check())
        <div class="container-fluid mt-4 mb-5">
            <div class="row">
                <div class="col-12">
                    @if(session()->has('success'))
                        <div class="alert alert-success alert-dismissible fade show flash-session-message pl-5 mb-5" role="alert">
                            <h5>{{session()->get('success')}}</h5>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                        @if(session()->has('info'))
                            <div class="alert alert-info alert-dismissible fade show flash-session-message pl-5 mb-5" role="alert">
                                <h5>{{session()->get('info')}}</h5>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="actions mb-5 text-right">
                        <a href="{{ route('get.orders', $project_id) }}" class="btn btn-primary"><i class="fas fa-file-import mr-1"></i> Update Orders</a>
                        <a href="{{ route('excel-export', $project_id) }}" class="btn btn-secondary"><i class="fas fa-file-download mr-1"></i> Export All Orders</a>
                        @if($project_id == \App\Models\Project::$atemshutz)
                            <a href="{{ route('color-table-export', $project_id) }}" class="btn btn-warning"><i class="fas fa-file-download mr-1"></i> Export Color Table</a>
                        @endif
                        <a href="{{--{{ route('google-spreadsheet', $project_id) }}--}}" class="btn btn-info"><i class="fas fa-file-download mr-1"></i> Insert Google Sheets</a>
{{--                        <a href="{{ route('export-invoices') }}" class="btn btn-info"><i class="fas fa-file-download mr-1"></i> Export Invoices</a>--}}
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <table class="table table-striped text-center" id="orders-table">
                        <thead>
                            <tr>
                                <th>ORDER NUMBER</th>
                                <th>FIRST NAME</th>
                                <th>LAST NAME</th>
                                <th>ORDER DATE</th>
                                <th>ORDER STATUS</th>
                                <th>ORDER AMOUNT</th>
                                <th>ACTION</th>
                                <th>STATUS</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($orders as $order)
                                <tr>
                                    <td>{{$order->id}}</td>
                                    <td>{{$order->billing_first_name}}</td>
                                    <td>{{$order->billing_last_name}}</td>
                                    <td>{{$order->order_date}}</td>
                                    <td>{{$order->order_status}}</td>
                                    <td>{{$order->order_total_amount}}</td>
                                    <td>
                                        <div class="d-flex justify-content-center">
                                            <div class="mr-2 d-flex flex-column">
                                                <a href="{{ route('generate-pdf', ['project_id'=>$project_id, 'id'=>$order->id, 'customer_id' => App\Models\Order::$man] ) }}" class="btn btn-dark action-buttons my-1"><i class="fas fa-file-download mr-1"></i> PDF Man</a>
                                                <a href="{{ route('generate-pdf', ['project_id'=>$project_id, 'id'=>$order->id, 'customer_id' => App\Models\Order::$woman]) }}" class="btn btn-dark action-buttons my-1"><i class="fas fa-file-download mr-1"></i> PDF Woman</a>                                            </div>
                                            <div class="mr-2 d-flex flex-column">
                                                <a href="{{ route('generate-doc', ['project_id'=>$project_id, 'id'=>$order->id, 'customer_id' => 'man']) }}" class="btn btn-info action-buttons my-1"><i class="fas fa-file-download mr-1"></i> Word Man</a>
                                                <a href="{{ route('generate-doc', ['project_id'=>$project_id, 'id'=>$order->id, 'customer_id' => 'woman']) }}" class="btn btn-info action-buttons my-1"><i class="fas fa-file-download mr-1"></i> Word Woman</a>
                                            </div>
                                            <div class="d-flex flex-column">
                                                <a href="{{ route('show.order', ['project_id'=>$project_id, 'id'=>$order->id]) }}" class="btn btn-secondary action-buttons my-1"><i class="fas fa-directions mr-1"></i> View Order</a>
                                                <form method="POST" action="{{ route('delete.order', $order->id) }}" class="d-inline-block">
                                                    @csrf
                                                    @method('delete')
                                                    <button type="submit" class="btn btn-danger action-buttons my-1"><i class="fas fa-exclamation-triangle mr-1"></i> Delete Order</button>
                                                </form>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div>
                                            @if($order->print_status == 'printed')
                                                <span class="d-block p-2 bg-success text-white rounded my-1"><i class="fas fa-check-circle mr-1"></i> Printed</span>
                                            @else
                                                <a href="{{ route('set-status.order', $order->id) }}" class="d-block btn btn-warning my-1"><i class="fas fa-times-circle mr-1"></i> Not Printed</a>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>ORDER NUMBER</th>
                                <th>FIRST NAME</th>
                                <th>LAST NAME</th>
                                <th>ORDER DATE</th>
                                <th>ORDER STATUS</th>
                                <th>ORDER AMOUNT</th>
                                <th>ACTION</th>
                                <th>STATUS</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    @endif
@endsection
