@extends('layout.app')
@section('content')
@if($orderRequest->status == 'ACCEPT')
@include('requests.accept',['orderRequest'=>$orderRequest])
@elseif($orderRequest->status == 'REJECT')
@include('requests.reject',['orderRequest'=>$orderRequest])
@else
@include('requests.pending_details',['orderRequest'=>$orderRequest])
@endif
@endsection