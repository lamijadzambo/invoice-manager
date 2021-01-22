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
                                @if($project_id == \App\Models\Project::$atemshutz)
                                    <th class="rotate"><div><span>{{($productName->hg001 ?: 'HG-001')}}</span></div></th>
                                    <th class="rotate"><div><span>{{($productName->typII ?: 'TYP II')}}</span></div></th>
                                    <th class="rotate"><div><span>{{$productName->typIIR ?: 'TYP IIR'}}</span></div></th>
                                    <th class="rotate"><div><span>{{$productName->hg002 ?: 'HG-002'}}</span></div></th>
                                    <th class="rotate"><div><span>{{$productName->ffp2 ?: 'FFP2'}}</span></div></th>
                                    <th class="rotate"><div><span>{{$productName->ffp3 ?: 'FFP3'}}</span></div></th>
                                    <th class="rotate"><div><span>{{$productName->childMask ?: 'KINDERMASKEN'}}</span></div></th>
                                    <th class="rotate"><div><span>{{$productName->hg005 ?: 'HG-005'}}</span></div></th>
                                    <th class="rotate"><div><span>{{$productName->redMask ?: 'HYG ROTE MASKEN'}}</span></div></th>
                                    <th class="rotate"><div><span>{{$productName->doorHandler ?: 'DOORHANDLER'}}</span></div></th>
                                    <th class="rotate"><div><span>{{$productName->medEinweg ?: 'MED. EINWEG'}}</span></div></th>
                                    <th class="rotate"><div><span>{{$productName->stoff ?: 'STOFFMASKEN'}}</span></div></th>
                                    <th class="rotate"><div><span>{{$productName->trennwand ?: 'TRENNWAND'}}</span></div></th>
                                    <th class="rotate"><div><span>{{$productName->thermometer ?: 'THERMOMETER'}}</span></div></th>
                                    <th class="rotate"><div><span>{{$productName->handsmittel ?: 'HANDSMITTEL'}}</span></div></th>
                                    <th class="rotate"><div><span>{{$productName->flachendes ?: 'FLACHENDES'}}</span></div></th>
                                    <th class="rotate"><div><span>{{$productName->handSpender ?: 'HAND SPENDER'}}</span></div></th>

                                @elseif($project_id == \App\Models\Project::$flipflop)
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

                                @if($project_id == \App\Models\Project::$atemshutz)
                                    <?php $atemshutz = true ?>
                                @endif

                                <td title="{{isset($atemshutz) ? $productName->hg001 : $productName->germany }}">{{$order->hg001 ?: $order->germany}}</td>
                                <td title="{{isset($atemshutz) ? $productName->typII : $productName->switzerland }}">{{$order->typII ?: $order->switzerland}}</td>
                                <td title="{{isset($atemshutz) ? $productName->typIIR : $productName->italy}}">{{$order->typIIR ?: $order->italy}}</td>
                                <td title="{{isset($atemshutz) ? $productName->hg002 : $productName->france}}">{{$order->hg002 ?: $order->france}}</td>
                                <td title="{{isset($atemshutz) ? $productName->ffp2 : $productName->netherlands}}">{{$order->ffp2 ?: $order->netherlands}}</td>
                                <td title="{{isset($atemshutz) ? $productName->ffp3 : $productName->spain}}">{{$order->ffp3 ?: $order->spain}}</td>
                                <td title="{{isset($atemshutz) ? $productName->childMask : $productName->england}}">{{$order->childMask ?: $order->england}}</td>
                                <td title="{{isset($atemshutz) ? $productName->hg005 : $productName->austria}}">{{$order->hg005 ?: $order->austria}}</td>
                                <td title="{{isset($atemshutz) ? $productName->redMask : $productName->portugal}}">{{$order->redMask ?: $order->portugal}}</td>
                                @if($project_id == \App\Models\Project::$atemshutz)
                                    <td title="{{isset($productName->doorHandler) ? $productName->doorHandler : ''  }}">{{$order->doorHandler ?: ''}}</td>
                                    <td title="{{isset($productName->medEinweg) ? $productName->medEinweg : ''}}">{{$order->medEinweg ?: ''}}</td>
                                    <td title="{{isset($productName->stoff) ? $productName->stoff : ''}}">{{$order->stoff ?: ''}}</td>
                                    <td title="{{isset($productName->trennwand) ? $productName->trennwand : ''}}">{{$order->trennwand ?: ''}}</td>
                                    <td title="{{isset($productName->thermometer) ? $productName->thermometer : ''}}">{{$order->thermometer ?: ''}}</td>
                                    <td title="{{isset($productName->handsmittel) ? $productName->handsmittel : ''}}">{{$order->handsmittel ?: ''}}</td>
                                    <td title="{{isset($productName->flachendes) ? $productName->flachendes : ''}}">{{$order->flachendes ?: ''}}</td>
                                    <td title="{{isset($productName->handSpender) ? $productName->handSpender : ''}}">{{$order->handSpender ?: ''}}</td>
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
