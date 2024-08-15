@extends('layout.app')
@section('content')
<div class="content-wrapper">
    <div class="row">
        <div class="col-md-12 ">
            <x-accounttab />

            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card card-primary">
                                <div class="card-header">
                                    <h3 class="card-title">B<small>ank</small></h3>
                                </div>
                                @if (session('status'))
                                <div class="alert alert-success" id="success_message">
                                    {{ session('status') }}
                                </div>
                                @endif
                                <form id="quickForm" method="POST" action="{{route('bank')}}">
                                    @csrf
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-xl-6">


                                                <div class="mb-3 row">
                                                    <label class="col-lg-4 col-form-label" for="bank_name">Bank
                                                        name</label>
                                                    <div class="col-lg-6">
                                                        <input type="text" class="form-control" placeholder="Bank name"
                                                            name="bank_name" value="<?php if (isset($bank->bank_name)) {
                                                        echo $bank->bank_name;
                                                        } ?>">
                                                        @error('bank_name')
                                                        <small class="text-danger">{{ $message }}</small>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="mb-3 row">
                                                    <label class="col-lg-4 col-form-label" for="bank_name">Account Holder Name</label>
                                                    <div class="col-lg-6">
                                                        <input type="text" class="form-control"
                                                            placeholder="Account Holder Name" name="account_holder_name"
                                                            value="<?php if (isset($bank->account_holder_name)) {
                                                        echo $bank->account_holder_name;
                                                        } ?>">
                                                        @error('account_holder_name')
                                                        <small class="text-danger">{{ $message }}</small>
                                                        @enderror
                                                    </div>
                                                </div>



                                                <div class="mb-3 row">
                                                    <label class="col-lg-4 col-form-label" for="bank_name">IBAN
                                                        Number</label>
                                                    <div class="col-lg-6">
                                                        <input type="text" class="form-control" placeholder="IBAN Number"
                                                            name="ibn_number" value="<?php if (isset($bank->ibn_number)) {
                                                        echo $bank->ibn_number;
                                                        } ?>">
                                                        @error('ibn_number')
                                                        <small class="text-danger">{{ $message }}</small>
                                                        @enderror
                                                    </div>
                                                </div>



                                                <div class="mb-3 row">
                                                    <label class="col-lg-4 col-form-label" for="bank_name">Sort
                                                        Code</label>
                                                    <div class="col-lg-6">
                                                        <input type="text" class="form-control" placeholder="Sort Code"
                                                            name="short_code" value="<?php if (isset($bank->short_code)) {
                                                        echo $bank->short_code;
                                                        } ?>">
                                                        @error('short_code')
                                                        <small class="text-danger">{{ $message }}</small>
                                                        @enderror
                                                    </div>
                                                </div>


                                               


                                                <div class="mb-3 row">
                                                    <label class="col-lg-4 col-form-label" for="account_no">Account no

                                                    </label>
                                                    <div class="col-lg-6">
                                                        <input type="text" class="form-control" placeholder="Account no"
                                                            name="account_no"
                                                            value="<?php if(isset($bank->account_no)){ echo $bank->account_no;}?>">
                                                        @error('account_no')
                                                        <small class="text-danger">{{ $message }}</small>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="mb-3 row">
                                                    <label class="col-lg-4 col-form-label" for="branch">Branch

                                                    </label>
                                                    <div class="col-lg-6">
                                                        <input type="text" class="form-control" placeholder="Branch"
                                                            name="branch"
                                                            value="<?php if(isset($bank->branch)){ echo $bank->branch;}?>">

                                                        @error('branch')
                                                        <small class="text-danger">{{ $message }}</small>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="mb-3 row">
                                                    <label class="col-lg-4 col-form-label" for="ifsc_code">IFSC Code

                                                    </label>
                                                    <div class="col-lg-6">
                                                        <input type="text" class="form-control " placeholder="Year"
                                                            name="ifsc_code"
                                                            value="<?php if(isset($bank->ifsc_code)){ echo $bank->ifsc_code;}?>">
                                                        @error('ifsc_code')
                                                        <small class="text-danger">{{ $message }}</small>
                                                        @enderror
                                                    </div>
                                                </div>



                                                <div class="mb-3 row">
                                                    <label class="col-lg-4 col-form-label" for="country">Country

                                                    </label>
                                                    <div class="col-lg-6">
                                                        <input type="text" class="form-control" placeholder="Country"
                                                            name="country"
                                                            value="<?php if (isset($address->country)) {
                                                                                                                                                echo $address->country;
                                                                                                                                            } ?>">
                                                        @error('country')
                                                        <small class="text-danger">{{ $message }}</small>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="mb-3 row">
                                                    <label class="col-lg-4 col-form-label" for="state">State

                                                    </label>
                                                    <div class="col-lg-6">
                                                        <input type="text" class="form-control" placeholder="State"
                                                            name="state"
                                                            value="<?php if (isset($address->state)) {
                                                                                                                                            echo $address->state;
                                                                                                                                        } ?>">
                                                        @error('state')
                                                        <small class="text-danger">{{ $message }}</small>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="mb-3 row">
                                                    <label class="col-lg-4 col-form-label" for="city">City

                                                    </label>
                                                    <div class="col-lg-6">
                                                        <input type="text" class="form-control " placeholder="City"
                                                            name="city"
                                                            value="<?php if (isset($address->city)) {
                                                                                                                                            echo $address->city;
                                                                                                                                        } ?>">
                                                        @error('city')
                                                        <small class="text-danger">{{ $message }}</small>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="mb-3 row">
                                                    <label class="col-lg-4 col-form-label" for="zip_code">Zipcode

                                                    </label>
                                                    <div class="col-lg-6">
                                                        <input type="text" class="form-control" placeholder="ZipCode"
                                                            name="zip_code"
                                                            value="<?php if (isset($address->zip_code)) {
                                                                                                                                                    echo $address->zip_code;
                                                                                                                                                } ?>">
                                                        @error('zip_code')
                                                        <small class="text-danger">{{ $message }}</small>
                                                        @enderror
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer">
                                        <button type="submit" class="btn btn-primary">Save</button>
                                        <!-- <a href="" class="btn btn-primary">Back</a> -->
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>
<script>
$(function() {
    $('#quickForm').validate({
        rules: {
            bank_name: {
                required: true,
                maxlength: 150,
                minlength: 2
            },
            account_no: {
                required: true,
                maxlength: 150,
                minlength: 2
            },
            branch: {
                required: true,
                maxlength: 150,
                minlength: 2
            },
            ifsc_code: {
                required: true,
                maxlength: 150,
                minlength: 2
            },
        },
        errorElement: 'span',
        errorPlacement: function(error, element) {
            error.addClass('invalid-feedback');
            element.closest('.form-group').append(error);
        },
        highlight: function(element, errorClass, validClass) {
            $(element).addClass('is-invalid');
        },
        unhighlight: function(element, errorClass, validClass) {
            $(element).removeClass('is-invalid');
        }
    });
});
</script>
@endsection