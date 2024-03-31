@extends('layout.app')
@section('content')
    <div class="content-wrapper">
        <div class="row">
        <div class="col-md-12">
            <x-accounttab/>
            <div class="card">
            <div class="card-body">
                <h4 class="card-title">Address</h4>
                @if (session('status'))
                    <div class="alert alert-success"  id="success_message">
                        {{ session('status') }}
                    </div>
                @endif
                <form class="forms-sample" id="quickForm" method="POST" action="{{route('address')}}">
                    @csrf
                    <div class="form-group">
                        <label >Country</label>
                        <input type="text" class="form-control" placeholder="Country" name="country" value="<?php if(isset($address->country)){ echo $address->country;}?>">
                    </div>
                    <div class="form-group">
                        <label >State</label>
                        <input type="text" class="form-control" placeholder="State" name="state" value="<?php if(isset($address->state)){ echo $address->state;}?>">
                    </div>
                    <div class="form-group">
                        <label>City</label>
                        <input type="text" class="form-control " placeholder="City" name="city"  value="<?php if(isset($address->city)){ echo $address->city;}?>">         
                    </div>
                    <div class="form-group">
                        <label >Zipcode</label>
                        <input type="text" class="form-control" placeholder="ZipCode" name="zip_code" value="<?php if(isset($address->zip_code)){ echo $address->zip_code;}?>">
                    </div>
                    <button type="submit" class="btn btn-primary me-2">Save and continue</button>
                    </form>
            </div>
            </div>
        </div>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>
    <script>
        $(function () {
            $('#quickForm').validate({
                rules: {
                    country: {
                        required: true,
                        maxlength:150,
                        minlength:2
                    },
                    state: {
                        required: true,
                        maxlength:150,
                        minlength:2
                    },
                    city:{
                        required:true,
                        maxlength:150,
                        minlength:2
                    },
                    zip_code: {
                        required: true,
                        maxlength:150,
                        minlength:2
                    },
                },
                errorElement: 'span',
                errorPlacement: function (error, element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
                },
                highlight: function (element, errorClass, validClass) {
                $(element).addClass('is-invalid');
                },
                unhighlight: function (element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
                }
            });
        });
    </script>
@endsection