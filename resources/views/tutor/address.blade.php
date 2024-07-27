@extends('layout.app')
@section('content')
<div class="content-wrapper">
    <div class="row">
        <div class="col-md-12">
            <x-accounttab />

            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card card-primary">
                                <div class="card-header">
                                    <h3 class="card-title">A<small>ddress</small></h3>
                                </div>
                                @if (session('status'))
                                <div class="alert alert-success" id="success_message">
                                    {{ session('status') }}
                                </div>
                                @endif
                                <form id="quickForm" method="POST" action="{{route('address')}}">
                                    @csrf
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-xl-6">
                                                <div class="mb-3 row">
                                                    <label class="col-lg-4 col-form-label" for="country">Country
                                                        <span class="text-danger">*</span>
                                                    </label>
                                                    <div class="col-lg-6">
                                                        <input type="text" class="form-control" placeholder="Country" name="country" value="<?php if (isset($address->country)) {
                                                                                                                                                echo $address->country;
                                                                                                                                            } ?>">
                                                        @error('country')
                                                        <small class="text-danger">{{ $message }}</small>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="mb-3 row">
                                                    <label class="col-lg-4 col-form-label" for="state">State
                                                        <span class="text-danger">*</span>
                                                    </label>
                                                    <div class="col-lg-6">
                                                        <input type="text" class="form-control" placeholder="State" name="state" value="<?php if (isset($address->state)) {
                                                                                                                                            echo $address->state;
                                                                                                                                        } ?>">
                                                        @error('state')
                                                        <small class="text-danger">{{ $message }}</small>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="mb-3 row">
                                                    <label class="col-lg-4 col-form-label" for="city">City
                                                        <span class="text-danger">*</span>
                                                    </label>
                                                    <div class="col-lg-6">
                                                        <input type="text" class="form-control " placeholder="City" name="city" value="<?php if (isset($address->city)) {
                                                                                                                                            echo $address->city;
                                                                                                                                        } ?>">
                                                        @error('city')
                                                        <small class="text-danger">{{ $message }}</small>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="mb-3 row">
                                                    <label class="col-lg-4 col-form-label" for="zip_code">Zipcode
                                                        <span class="text-danger">*</span>
                                                    </label>
                                                    <div class="col-lg-6">
                                                        <input type="text" class="form-control" placeholder="ZipCode" name="zip_code" value="<?php if (isset($address->zip_code)) {
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
                                        <button type="submit" class="btn btn-primary">Save and continue</button>
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
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>
<script>
    $(function() {
        $('#quickForm').validate({
            rules: {
                country: {
                    required: true,
                    maxlength: 150,
                    minlength: 2
                },
                state: {
                    required: true,
                    maxlength: 150,
                    minlength: 2
                },
                city: {
                    required: true,
                    maxlength: 150,
                    minlength: 2
                },
                zip_code: {
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