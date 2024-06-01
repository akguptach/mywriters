@extends('layout.app')
@section('content')
    <div class="content-wrapper">
        <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
            <div class="card-body">
                <h4 class="card-title">{{ucfirst(strtolower($type))}} Open orders</h4>
                <div class="table-responsive">
                    <table class="table" id="example1">
                        <thead>
                            <tr>
                                <th>Task code</th>
                                <th>Order date</th>
                                <th>Level of study</th>
                                <th>Order type</th>
                                <th>Referncing Style</th>
                                <th>Status</th>
                                <th>Word count</th>
                            </tr>
                        </thead>
                        <tbody>
                            
                            @foreach($openOrders as $item)
                            <tr>
                                <td>{{$item->order->task}}</td>
                                <td>
                                    @if($type == 'TUTOR') 
                                    <a href="{{route('open.order.details',[$item->id])}}">{{$item->order->created_at}}</a>
                                    @else
                                    <a href="{{route('qc.open.order.details',[$item->id])}}">{{$item->order->created_at}}</a>
                                    @endif
                                    
                                </td>
                                <td>{{$item->order->lavelStudy->level_name}}</td>
                                <td>{{@$item->order->taskType->type_name}}</td>
                                <td>{{$item->order->referencingStyle->style}}</td>
                                <td>{{$item->status}}</td>
                                <td>{{$item->order->no_of_words}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            </div>
        </div>
        </div>
    </div>
@endsection