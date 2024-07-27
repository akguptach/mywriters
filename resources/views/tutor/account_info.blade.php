@extends('layout.app')
@section('content')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.12/css/intlTelInput.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.12/js/intlTelInput.min.js"></script>
<style>
.error {
    color: red;
}


</style>
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
                                    <h3 class="card-title">Account <small>Info</small></h3>
                                </div>
                                @if (session('status'))
                                <div class="alert alert-success" id="success_message">
                                    {{ session('status') }}
                                </div>
                                @endif
                                <form id="quickForm" method="POST" action="{{route('account_info')}}">
                                    @csrf
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-xl-6">
                                                <div class="mb-3 row">
                                                    <label class="col-lg-4 col-form-label" for="tutor_first_name">First
                                                        name
                                                        <span class="text-danger">*</span>
                                                    </label>
                                                    <div class="col-lg-6">
                                                        <input type="text" class="form-control" placeholder="First name"
                                                            name="tutor_first_name"
                                                            value="{{$tutors->tutor_first_name}}">
                                                        @error('tutor_first_name')
                                                        <small class="text-danger">{{ $message }}</small>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="mb-3 row">
                                                    <label class="col-lg-4 col-form-label" for="tutor_last_name">Last
                                                        name
                                                        <span class="text-danger">*</span>
                                                    </label>
                                                    <div class="col-lg-6">
                                                        <input type="text" class="form-control" placeholder="Last name"
                                                            name="tutor_last_name" value="{{$tutors->tutor_last_name}}">
                                                        @error('tutor_last_name')
                                                        <small class="text-danger">{{ $message }}</small>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="mb-3 row">
                                                    <label class="col-lg-4 col-form-label"
                                                        for="tutor_contact_no">Contact no
                                                        <span class="text-danger">*</span>
                                                    </label>
                                                    <div class="col-lg-6">
                                                        
                                                        <input id="phone_number"type="text" class="form-control" placeholder="Contact no" name="tutor_contact_no" value="{{$tutors->tutor_contact_no}}"  style="width:252px;">

                                                        <input type="hidden" class="form-control" name="country_code" id="country_code" >
                                                        <span id="phone-error" style="color: red;"></span>



                                                        @error('tutor_contact_no')
                                                        <small class="text-danger">{{ $message }}</small>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="mb-3 row">
                                                    <label class="col-lg-4 col-form-label" for="tutor_email">Email
                                                        <span class="text-danger">*</span>
                                                    </label>
                                                    <div class="col-lg-6">
                                                        <input type="email" class="form-control" placeholder="Email"
                                                            name="tutor_email" value="{{$tutors->tutor_email}}">
                                                        @error('tutor_email')
                                                        <small class="text-danger">{{ $message }}</small>
                                                        @enderror
                                                    </div>
                                                </div>

                                                @php($subjectsList = [])
                                                @foreach($tutors->subjects as $selected)
                                                @php($subjectsList[] = $selected->subject_id)
                                                @endforeach

                                                @php($selectedString = [])
                                                <div class="mb-3 row">
                                                    <label class="col-lg-4 col-form-label" for="tutor_email">Subject
                                                        <span class="text-danger">*</span>
                                                    </label>
                                                    <div class="col-lg-6">
                                                        <select class="form-control" name="tutor_subject[]"
                                                            id="tutor_subject" multiple="multiple">
                                                            @if(!empty($subjects))
                                                            @foreach ($subjects as $subject)

                                                            @if(in_array($subject->id, $subjectsList))
                                                            @php($selectedString[] = $subject->subject_name)
                                                            <option selected="selected  " value="{{$subject->id}}">
                                                                {{$subject->subject_name}}</option>
                                                            @else
                                                            <option value="{{$subject->id}}">{{$subject->subject_name}}
                                                            </option>
                                                            @endif
                                                            @endforeach
                                                            @endif
                                                        </select>
                                                    </div>

                                                    <?php /*<select class="form-control form-control-lg border-left-0"  name="tutor_subject">
                                                        <option selected="selected" value="">Please Select Subject</option>
                                                        @if(!empty($subjects))
                                                        @foreach ($subjects as $subject)
                                                            <option value="{{$subject->id}}" @if($tutors->tutor_subject == $subject->id) selected @endif>{{$subject->subject_name}}</option>
                                                        @endforeach
                                                        @endif
                                                    </select>*/ ?>

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
</div>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>
@php($selectedString = implode(',',$selectedString))
<script>
$(document).ready(function() {
    // Initialize intl-tel-input plugin
    var input = document.querySelector("#phone_number");
    var iti = window.intlTelInput(input, {
        //initialCountry: "IN",
        separateDialCode: true,
        utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.12/js/utils.js"
    });

    input.addEventListener("countrychange", function() {
        var selectedCountryData = iti.getSelectedCountryData();
        var countryCode = selectedCountryData.dialCode;
        $('#country_code').val(countryCode);
    });

    

    // Validate phone number and update country code
    $('#phone_number').on('keyup change', function() {
        
        var isValidNumber = iti.isValidNumber();
        var selectedCountryData = iti.getSelectedCountryData();
        if (!isValidNumber) {
            $('#phone-error').text('Invalid phone number');
        } else if (selectedCountryData == null) {
            $('#phone-error').text('Please select a country');
        } else {
            $('#phone-error').text('');
            var countryCode = selectedCountryData.dialCode;
            
            $('#country_code').val(countryCode);
        }
    });
});

/*$(function() {
    $('#quickForm').validate({
        rules: {
            tutor_first_name: {
                required: true,
                maxlength: 150,
                minlength: 2
            },
            tutor_last_name: {
                required: true,
                maxlength: 150,
                minlength: 2
            },
            tutor_email: {
                required: true,
                email: true
            },
            tutor_contact_no: {
                required: true,
                number: true
            },
            tutor_subject: {
                required: true,
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
});*/
</script>
@endsection