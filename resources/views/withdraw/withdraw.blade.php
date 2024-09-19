@extends('layout.app')
@section('content')
<div class="content-wrapper">
    <div class="row">
        <div class="col-md-12 ">
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            @include('orders.account_tab')
                            <div class="card card-primary">
                                
                                <div class="card-body">
                                    <div id="withdraw_amount" class="" role="">
                                        <div class="row" style="margin-bottom:10px;">
                                            <div class="col-lg-12">
                                            @if (session('success'))
                                <div class="alert alert-success" id="success_message">
                                    {{ session('success') }}
                                </div>
                                @endif

                                @if (session('error'))
                                <div class="alert alert-danger" id="success_message">
                                    {{ session('error') }}
                                </div>
                                @endif
                                                <form id="upi_details_form" method="POST"
                                                    action="{{route('payment.method.withdraw')}}">
                                                    @csrf
                                                    <div class="card-body">
                                                        <div class="row">
                                                            <div class="col-xl-6">

                                                                <div class="mb-3 row">
                                                                <label class="col-lg-4 col-form-label" for="upi_id">Balance</label>
                                                                <div class="col-lg-6">
                                                                £{{$balance}}
                                                                </div>
                                                            </div>

                                                                <div class="mb-3 row">
                                                                    <label class="col-lg-4 col-form-label"
                                                                        for="upi_id">Withdraw Amount</label>
                                                                    <div class="col-lg-6">
                                                                        <input pattern="^\d*(\.\d{0,2})?$" type="text"
                                                                            class="form-control" placeholder="amount"
                                                                            name="amount" value="{{old('amount')}}">
                                                                        @error('amount')
                                                                        <small
                                                                            class="text-danger">{{ $message }}</small>
                                                                        @enderror
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="card-footer">
                                                        <button type="submit" class="btn btn-primary">Withdraw</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>


@endsection