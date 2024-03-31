@extends('layout.app')
@section('content')
    <div class="content-wrapper">
        <div class="row">
        <div class="col-md-12 ">
        <x-accounttab/>
            <div class="card">
            <div class="card-body">
                <h4 class="card-title">Education</h4>
                @if (session('status'))
                    <div class="alert alert-success"  id="success_message">
                        {{ session('status') }}
                    </div>
                @endif
                <form class="forms-sample" id="quickForm" method="POST" action="{{route('education')}}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label >Highest education</label>
                        <input type="text" class="form-control" placeholder="Highest education" name="highest_education" value="<?php if(isset($education->highest_education)){ echo $education->highest_education;}?>">
                    </div>
                    <div class="form-group">
                        <label >University</label>
                        <input type="text" class="form-control" placeholder="University" name="university" value="<?php if(isset($education->university)){ echo $education->university;}?>">
                    </div>
                    <div class="form-group">
                        <label>Year</label>
                        <input type="text" class="form-control " placeholder="Year" name="year"  value="<?php if(isset($education->year)){ echo $education->year;}?>">         
                    </div>
                    <div class="form-group">
                        <label >Proof</label>
                        <input type="file" class="form-control" name="proof" >
                        @if(!empty($education->proof))
                        <a href="<?= asset($education->proof);?>" target="_blank">View</a>

                        @endif
                        @error('proof')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        <div style="margin-bottom:15px;margin-top:15px;">
                            <a href="javascript:void(0);" style="text-decoration:none;color:black" onclick="add_education()">Add More Education</a>
                            <input type="hidden" id="no_education" value="{{count($additional_educations)}}">
                        </div>

                    </div>
                    <div id="add_education">
                        @if(!empty($additional_educations))
                            <?php $i1 = 0;?>
                            @foreach ($additional_educations as $additional1)
                                <?php $i1++;?>
                                <div class="form-group" id="education_{{$i1}}">
                                    <label >Education</label>
                                    <input type="text" name="addional_education[]" class="form-control" required placeholder="Enter education " value="{{$additional1->education_name}}">
                                    <div style="margin-bottom:15px;margin-top:15px;">
                                        <button class="remove-textbox" onclick="remove_education('{{$i1}}')">Remove</button>
                                    </div>
                                </div>
                            @endforeach

                        @endif
                        
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
                    highest_education: {
                        required: true,
                        maxlength:150,
                        minlength:2
                    },
                    university: {
                        required: true,
                        maxlength:150,
                        minlength:2
                    },
                    year:{
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
        function add_education() {
            let textboxCount = $('#no_education').val();
            textboxCount++;
            var newTextbox = '<div class="form-group" id="education_'+textboxCount+'"><label >Education</label><input type="text" name="addional_education[]" class="form-control" required placeholder="Enter education "><div style="margin-bottom:15px;margin-top:15px;"><button class="remove-textbox" onclick="remove_education('+textboxCount+')">Remove</button></div></div>';
            $('#add_education').append(newTextbox);
            $('#no_education').val(textboxCount);
        }
        function remove_education(remove_id){
            $('#education_'+remove_id).html('');
           // $('input[id="education_' + remove_id + '"]').parent().remove();
        }
    </script>
@endsection