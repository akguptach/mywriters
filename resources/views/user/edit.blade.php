@extends('layout.app')
@section('content')
    <div class="content-wrapper">
        <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
            <div class="card-body">
                <h4 class="card-title">Edit User</h4>
                <form class="forms-sample" id="quickForm" method="POST" action="{{$formAction}}">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label >First name</label>
                        <input type="text" class="form-control" placeholder="First name" name="first_name" value="{{$data->first_name}}">
                    </div>
                    <div class="form-group">
                        <label >Last name</label>
                        <input type="text" class="form-control" placeholder="Last name" name="last_name" value="{{$data->last_name}}">
                    </div>
                    <div class="form-group">
                        <label >Email</label>
                        <input type="email" class="form-control" placeholder="Email" name="email" value="{{$data->email}}"> 
                        @error('email')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <labe>Password</label>
                        <input type="password" class="form-control" placeholder="Password" name="password" id="password">
                    </div>
                    <button type="submit" class="btn btn-primary me-2">Submit</button>
                    <a class="btn btn-light" href="{{route('tutor_user.index')}}">Back</a>
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
                    first_name: {
                        required: true,
                        maxlength:150,
                        minlength:2
                    },
                    last_name: {
                        required: true,
                        maxlength:150,
                        minlength:2
                    },
                    email:{
                        required:true
                    },
                    password: {
                        minlength: 5,
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