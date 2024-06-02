@extends('emails.500.layout')

@section('content')

<p>Hi Admin</p>
<p>Order request has been {{$status}} by tutor {{$tutor_name}}. Please <a href="{{$url}}">click here</a> to view order</p>
<p>Thanks</p>

@endsection