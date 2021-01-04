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
                                @if($project_id == 1)
                                    <th class="rotate"><div><span>{{($productName->typII ?: 'TYP II')}}</span></div></th>
                                    <th class="rotate"><div><span>{{$productName->typIIR ?: 'TYP IIR'}}</span></div></th>
                                    <th class="rotate"><div><span>{{$productName->hg002 ?: 'HG-002'}}</span></div></th>
                                    <th class="rotate"><div><span>{{$productName->hg005 ?: 'HG-005'}}</span></div></th>
                                    <th class="rotate"><div><span>{{$productName->redMask ?: 'HYG ROTE MASKEN'}}</span></div></th>
                                    <th class="rotate"><div><span>{{$productName->doorHandler ?: 'DOORHANDLER'}}</span></div></th>
                                    <th class="rotate"><div><span>{{$productName->medEinweg ?: 'MED. EINWEG'}}</span></div></th>
                                    <th class="rotate"><div><span>{{$productName->stoff ?: 'STOFFMASKEN'}}</span></div></th>
                                    <th class="rotate"><div><span>{{$productName->trennwand ?: 'TRENNWAND'}}</span></div></th>
                                    <th class="rotate"><div><span>{{$productName->thermometer ?: 'THERMOMETER'}}</span></div></th>
                                    <th class="rotate"><div><span>{{$productName->handSmilsan ?: 'HANDDESINFEKTION SMILSAN'}}</span></div></th>
                                    <th class="rotate"><div><span>{{$productName->handsmittel ?: 'HANDSMITTEL'}}</span></div></th>
                                    <th class="rotate"><div><span>{{$productName->flachendes ?: 'FLACHENDES'}}</span></div></th>
                                    <th class="rotate"><div><span>{{$productName->handSpender ?: 'HAND SPENDER'}}</span></div></th>

                                @elseif($project_id == 2)
                                    <th class="rotate"><div><span>{{($productName->flipflop ?: 'FLIPFLOP 1')}}</span></div></th>
                                    <th class="rotate"><div><span>{{$productName->flipflop ?: 'FLIPFLOP 2'}}</span></div></th>
                                    <th class="rotate"><div><span>{{$productName->flipflop ?: 'FLIPFLOP 3'}}</span></div></th>
                                    <th class="rotate"><div><span>{{$productName->flipflop ?: 'FLIPFLOP 4'}}</span></div></th>
                                    <th class="rotate"><div><span>{{$productName->flipflop ?: 'FLIPFLOP 5'}}</span></div></th>
                                    <th class="rotate"><div><span>{{$productName->flipflop ?: 'FLIPFLOP 6'}}</span></div></th>
                                    <th class="rotate"><div><span>{{$productName->flipflop ?: 'FLIPFLOP 7'}}</span></div></th>
                                    <th class="rotate"><div><span>{{$productName->flipflop ?: 'FLIPFLOP 8'}}</span></div></th>
                                    <th class="rotate"><div><span>{{$productName->flipflop ?: 'FLIPFLOP 9'}}</span></div></th>
                                    <th class="rotate"><div><span>{{$productName->flipflop ?: 'FLIPFLOP 10'}}</span></div></th>
                                    <th class="rotate"><div><span>{{$productName->flipflop ?: 'FLIPFLOP 11'}}</span></div></th>
                                    <th class="rotate"><div><span>{{$productName->flipflop ?: 'FLIPFLOP 12'}}</span></div></th>
                                    <th class="rotate"><div><span>{{$productName->flipflop ?: 'FLIPFLOP 13'}}</span></div></th>
                                    <th class="rotate"><div><span>{{$productName->flipflop ?: 'FLIPFLOP 14'}}</span></div></th>
                                @endif
                                <th class="rotate"><div><span>BETRAG</span></div></th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($orders as $order)
                            <tr>
                                <td title="FIRMA">{{$order->billing_company}}</td>
                                <td title="NAME">{{$order->billing_last_name}}</td>
                                <td title="VORNAME">{{$order->billing_first_name}}</td>
                                <td></td>
                                <td title="EMAIL"><a href="mailto:{{$order->billing_email}}">{{$order->billing_email}}</a></td>
                                <td title="TELEFON"><a href="tel:{{$order->billing_phone}}">{{$order->billing_phone}}</a></td>
                                <td class="BESTELL NO.">{{$order->id}}</td>
                                <td title="STATUS">{{$order->order_status}}</td>
                                @if($project_id == 1)
                                <td title="TYP II">{{$order->typII}}</td>
                                <td title="TYP IIR">{{$order->typIIR}}</td>
                                <td title="N95 HG-002">{{$order->hg002}}</td>
                                <td title="SHILD HG-005">{{$order->hg005}}</td>
                                <td title="HYG ROTE MASKEN">{{$order->redMask}}</td>
                                <td title="DOORHANDLER">{{$order->doorHandler}}</td>
                                <td title="MED. EINWEG">{{$order->medEinweg}}</td>
                                <td title="STOFFMASKEN">{{$order->stoff}}</td>
                                <td title="TRENNWAND">{{$order->trennwand}}</td>
                                <td title="THERMOMETER">{{$order->thermometer}}</td>
                                <td title="HANDDESINF.">{{$order->handSmilsan}}</td>
                                <td title="FLÄCHENDES.">{{$order->handsmittel}}</td>
                                <td title="FLÄCHENDES.">{{$order->flachendes}}</td>
                                <td title="HAND SPENDER">{{$order->handSpender}}</td>
                                @endif
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
