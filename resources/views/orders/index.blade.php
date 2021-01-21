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
{{--                        <a href="{{route('google-spreadsheet', $project_id)}}" class="btn btn-info"><i class="fas fa-file-download mr-1"></i> Insert Google Sheets</a>--}}
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <table class="table table-striped text-center" id="orders-table">
                        <thead>
                            <tr>
                                <th>DELETE ORDER</th>
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
                                    <td>
                                        <form method="POST" action="{{ route('delete.order', $order->id) }}" class="d-inline-block">
                                            @csrf
                                            @method('delete')
                                            <button type="submit"  title="DELETE ORDER"><i style="color:red;" class="far fa-trash-alt"></i></button>
                                        </form>
                                    </td>
                                    <td><a title="VIEW ORDER" href="{{route('show.order', ['project_id'=>$project_id, 'id'=>$order->id])}}">{{$order->id}}</a></td>
                                    <td>{{$order->billing_first_name}}</td>
                                    <td>{{$order->billing_last_name}}</td>
                                    <td>{{$order->order_date}}</td>
                                    <td>{{$order->order_status}}</td>
                                    <td>{{$order->order_total_amount}}</td>
                                    <td>
                                        <div class="d-flex justify-content-center">
                                            <div class="mr-2 d-flex flex-column">
                                                <a href="{{ route('generate-pdf', ['project_id'=>$project_id, 'id'=>$order->id, 'customer_id' => App\Models\Order::$man] ) }}" class="my-1" title="PDF MAN"><i class="fas fa-file-pdf"></i></a>
                                                <a href="{{ route('generate-pdf', ['project_id'=>$project_id, 'id'=>$order->id, 'customer_id' => App\Models\Order::$woman]) }}" class="my-1" title="PDF WOMAN"><i class="fas fa-file-pdf"></i></a>                                            </div>
                                            <div class="mr-2 d-flex flex-column">
                                                <a href="{{ route('generate-doc', ['project_id'=>$project_id, 'id'=>$order->id, 'customer_id' => 'man']) }}" class="my-1" title="WORD MAN"><i class="fas fa-file-word"></i></a>
                                                <a href="{{ route('generate-doc', ['project_id'=>$project_id, 'id'=>$order->id, 'customer_id' => 'woman']) }}" class="my-1" title="WORD WOMAN"><i class="fas fa-file-word"></i></a>
                                            </div>
{{--                                            <div class="mr-2 d-flex flex-column">--}}
{{--                                                <a href="" class="my-1" title="GOOGLE DRIVE MAN"><i class="fab fa-google-drive"></i></a>--}}
{{--                                                <a href="" class="my-1" title="GOOLE DRIVE WOMAN"><i class="fab fa-google-drive"></i></a>--}}
{{--                                            </div>--}}
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex justify-content-center">
                                            @if($order->print_status == 'printed')
                                                <span class="my-1"><i class="fas fa-print" style="color:green;"></i></span>
                                            @else
                                                <a href="{{ route('set-status.order', $order->id) }}" class="my-1"><i class="fas fa-print" style="color:red;"></i></a>
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
