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
                                    <th class="rotate"><div><span>{{($productName->germany ?: 'DEUTSCHLAND')}}</span></div></th>
                                    <th class="rotate"><div><span>{{$productName->switzerland ?: 'SCHWEIZ'}}</span></div></th>
                                    <th class="rotate"><div><span>{{$productName->italy ?: 'ITALIEN'}}</span></div></th>
                                    <th class="rotate"><div><span>{{$productName->france ?: 'FRANKREICH'}}</span></div></th>
                                    <th class="rotate"><div><span>{{$productName->netherlands ?: 'NIEDERLANDE'}}</span></div></th>
                                    <th class="rotate"><div><span>{{$productName->spain ?: 'SPANIEN'}}</span></div></th>
                                    <th class="rotate"><div><span>{{$productName->england ?: 'ENGLAND'}}</span></div></th>
                                    <th class="rotate"><div><span>{{$productName->austria ?: 'ÖSTERREICH'}}</span></div></th>
                                    <th class="rotate"><div><span>{{$productName->portugal ?: 'PORTUGAL'}}</span></div></th>
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
                                <td title="{{$order->germany ?: 'TYPII' }}">{{$order->typII ? $order->typII : ($order->germany ? $order->germany : '')}}</td>
                                <td title="{{$order->switzerland ?: 'TYPIIR' }}">{{$order->typIIR ?: $order->switzerland}}</td>
                                <td title="{{$order->italy ?: 'HG-002' }}">{{$order->hg002 ?: $order->italy}}</td>
                                <td title="{{$order->france ?: 'HG-005'}}">{{$order->hg005 ?: $order->france}}</td>
                                <td title="{{$order->netherlands ?: 'HYG ROTE MASKEN'}}">{{$order->redMask ?: $order->netherlands}}</td>
                                <td title="{{$order->spain ?: 'DOORHANDLER'}}">{{$order->doorHandler ?: $order->spain}}</td>
                                <td title="{{$order->england ?: 'MED. EINWEG'}}">{{$order->medEinweg ?: $order->england}}</td>
                                <td title="{{$order->austria ?: 'STOFFMASKEN'}}">{{$order->stoff ?: $order->austria}}</td>
                                <td title="{{$order->portugal ?: 'TRENNWAND'}}">{{$order->trennwand ?: $order->portugal}}</td>
                                @if($project_id == 1)
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
