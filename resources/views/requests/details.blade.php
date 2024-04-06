@extends('layout.app')
@section('content')
<div class="content-wrapper">
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">

                    @if (Session::has('success'))
                    <div class="alert alert-success">
                        {{ Session::get('success') }}
                    </div>
                    @endif

                    @if (Session::has('error'))
                    <div class="alert alert-danger">
                        {{ Session::get('error') }}
                    </div>
                    @endif

                    @if($orderAssign || $qcAssign)
                    @include('requests.assigned',['orderRequest'=>$orderRequest])
                    @else
                    @if($orderRequest->status == 'ACCEPTED')
                    @include('requests.accept',['orderRequest'=>$orderRequest])
                    @elseif($orderRequest->status == 'REJECTED')
                    @include('requests.reject',['orderRequest'=>$orderRequest])
                    @else
                    @include('requests.pending_details',['orderRequest'=>$orderRequest])
                    @endif
                    @endif

                </div>
            </div>
        </div>
    </div>
</div>

@endsection