@extends('layout.app')
@section('content')
<div class="content-wrapper">
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Pending Requests</h4>
                    <div class="table-responsive">
                        <table class="table" id="example1">
                            <thead>
                                <tr>
                                    <th>Task code</th>
                                    <th>Order date</th>
                                    <th>Level of study</th>
                                    <th>Order type</th>
                                    <th>Referncing Style</th>
                                    <th>Word count</th>
                                    <th>Desired grades</th>
                                    <th>Due date</th>
                                    <th>Status</th>
                                    <th>Assigned</th>
                                    <th>Amount</th>
                                    <th>Chat</th>
                                    <th>Rating</th>
                                    <th>Review</th>
                                    <th>Rework</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($orderRequests as $request)
                                <tr>
                                    <td>{{$request->order->task}}</td>
                                    <td><a href="{{route('request_details',[$request->order->id])}}">{{$request->order->created_at}}</a></td>
                                    <td>{{$request->order->lavelStudy->level_name}}</td>
                                    <td>{{$request->order->taskType->type_name}}</td>
                                    <td>{{$request->order->referencingStyle->style}}</td>
                                    <td>{{$request->order->no_of_words}}</td>
                                    <td>{{$request->order->grade->grade_name}}</td>
                                    <td>{{$request->order->delivery_date}}</td>
                                    <td>Pending</td>
                                    <td>Checking</td>
                                    <td>{{$request->order->price}}</td>
                                    <td>Test</td>
                                    <td>{{$request->order->rating}}</td>
                                    <td>{{$request->order->review}}</td>
                                    <td>Checking</td>
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