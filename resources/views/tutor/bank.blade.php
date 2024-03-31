@extends('layout.app')
@section('content')
    <div class="content-wrapper">
        <div class="row">
        <div class="col-md-12 ">
            <x-accounttab/>

            <div class="card">
            <div class="card-body">
                <h4 class="card-title">Bank</h4>
                @if (session('status'))
                    <div class="alert alert-success"  id="success_message">
                        {{ session('status') }}
                    </div>
                @endif
                <form class="forms-sample" id="quickForm" method="POST" action="{{route('bank')}}">
                    @csrf
                    <div class="form-group">
                        <label >Bank name</label>
                        <input type="text" class="form-control" placeholder="Bank name" name="bank_name" value="<?php if(isset($bank->bank_name)){ echo $bank->bank_name;}?>">
                    </div>
                    <div class="form-group">
                        <label >Account no</label>
                        <input type="text" class="form-control" placeholder="Account no" name="account_no" value="<?php if(isset($bank->account_no)){ echo $bank->account_no;}?>">
                    </div>
                    <div class="form-group">
                        <label >Branch</label>
                        <input type="text" class="form-control" placeholder="Branch" name="branch" value="<?php if(isset($bank->branch)){ echo $bank->branch;}?>">
                    </div>
                    <div class="form-group">
                        <label>IFSC Code</label>
                        <input type="text" class="form-control " placeholder="Year" name="ifsc_code"  value="<?php if(isset($bank->ifsc_code)){ echo $bank->ifsc_code;}?>">         
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
                    bank_name: {
                        required: true,
                        maxlength:150,
                        minlength:2
                    },
                    account_no: {
                        required: true,
                        maxlength:150,
                        minlength:2
                    },
                    branch: {
                        required: true,
                        maxlength:150,
                        minlength:2
                    },
                    ifsc_code:{
                        required:true,
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