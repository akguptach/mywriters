@extends('layout.app')
@section('content')
    <div class="content-wrapper">
        <div class="row">
        <div class="col-md-12 ">
            <x-accounttab/>
            <div class="card">
            <div class="card-body">
                <h4 class="card-title">Account Info</h4>
                @if (session('status'))
                    <div class="alert alert-success"  id="success_message">
                        {{ session('status') }}
                    </div>
                @endif
                @if (session('success'))
                    <div class="alert alert-success" id="success_message">
                        {{ session('success') }}
                    </div>
                @endif
                <form class="forms-sample" id="quickForm" method="POST" action="{{route('account_info')}}">
                    @csrf
                    <div class="form-group">
                        <label >First name</label>
                        <input type="text" class="form-control" placeholder="First name" name="tutor_first_name" value="{{$tutors->tutor_first_name}}">
                    </div>
                    <div class="form-group">
                        <label >Last name</label>
                        <input type="text" class="form-control" placeholder="Last name" name="tutor_last_name" value="{{$tutors->tutor_last_name}}">
                    </div>
                    <div class="form-group">
                        <label>Contact no</label>
                        <input type="text" class="form-control form-control-lg border-left-0" placeholder="Contact no" name="tutor_contact_no"  value="{{$tutors->tutor_contact_no}}">                        

                        @error('tutor_contact_no')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label >Email</label>
                        <input type="email" class="form-control" placeholder="Email" name="tutor_email" value="{{$tutors->tutor_email}}">
                        @error('tutor_email')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Subject</label>
                        <select class="form-control form-control-lg border-left-0"  name="tutor_subject">
                                <option selected="selected" value="">Please Select Subject</option>
                                @if(!empty($subjects))
                                @foreach ($subjects as $subject)
                                    <option value="{{$subject->id}}" @if($tutors->tutor_subject == $subject->id) selected @endif>{{$subject->subject_name}}</option>
                                @endforeach
                                @endif
                        </select>
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
                    tutor_first_name: {
                        required: true,
                        maxlength:150,
                        minlength:2
                    },
                    tutor_last_name: {
                        required: true,
                        maxlength:150,
                        minlength:2
                    },
                    tutor_email:{
                        required:true,
                        email:true
                    },
                    tutor_contact_no: {
                        required: true,
                        number:true
                    },
                    tutor_subject: {
                        required: true,
                    },,
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