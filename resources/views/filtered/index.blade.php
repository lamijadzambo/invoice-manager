@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered">
                        <thead class="bg-dark text-white text-center">
                            <tr>
                                <th>FIRMA</th>
                                <th>NAME</th>
                                <th>VORNAME</th>
                                <th></th>
                                <th>EMAIL</th>
                                <th>TELEFON</th>
                                <th>BESTELL NO.</th>
                                <th>STATUS</th>
                                <th class="rotate"><div><span>HYG HG-001</span></div></th>
                                <th class="rotate"><div><span>TYP II</span></div></th>
                                <th class="rotate"><div><span>TYP IIR</span></div></th>
                                <th class="rotate"><div><span>N95 HG-002</span></div></th>
                                <th class="rotate"><div><span>SHILD HG-005</span></div></th>
                                <th class="rotate"><div><span>HYG ROTE MASKEN</span></div></th>
                                <th class="rotate"><div><span>DOORHANDLER</span></div></th>
                                <th class="rotate"><div><span>MED. EINWEG</span></div></th>
                                <th class="rotate"><div><span>STOFFMASKEN</span></div></th>
                                <th class="rotate"><div><span>TRENNWAND</span></div></th>
                                <th class="rotate"><div><span>THERMOMETER</span></div></th>
                                <th class="rotate"><div><span>HANDDESINF.</span></div></th>
                                <th class="rotate"><div><span>FLÄCHENDES.</span></div></th>
                                <th class="rotate"><div><span>HAND SPENDER</span></div></th>
                                <th class="rotate"><div><span>BETRAG</span></div></th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($savedOrder as $order)
                            <tr>
                                <td title="FIRMA">{{$order->billing_company}}</td>
                                <td title="NAME">{{$order->billing_last_name}}</td>
                                <td title="VORNAME">{{$order->billing_first_name}}</td>
                                <td></td>
                                <td title="EMAIL"><a href="mailto:{{$order->billing_email}}">{{$order->billing_email}}</a></td>
                                <td title="TELEFON"><a href="tel:{{$order->billing_phone}}">{{$order->billing_phone}}</a></td>
                                <td class="BESTELL NO.">{{$order->id}}</td>
                                <td title="STATUS">{{$order->order_status}}</td>
                                <td title="HYG HG-001"></td>
                                <td title="TYP II"></td>
                                <td title="TYP IIR"></td>
                                <td title="N95 HG-002"></td>
                                <td title="SHILD HG-005"></td>
                                <td title="HYG ROTE MASKEN"></td>
                                <td title="DOORHANDLER"></td>
                                <td title="MED. EINWEG"></td>
                                <td title="STOFFMASKEN"></td>
                                <td title="TRENNWAND"></td>
                                <td title="THERMOMETER"></td>
                                <td title="HANDDESINF."></td>
                                <td title="FLÄCHENDES."></td>
                                <td title="HAND SPENDER"></td>
                                <td title="BETRAG">{{$order->order_total_amount}}</td>

                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
