@extends('layout.app')
@section('content')
<style>
.switch {
    position: relative;
    display: inline-block;
    width: 80px;
    height: 34px;
}

.switch input {
    display: none;
}

.slider {
    position: absolute;
    cursor: pointer;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-color: #ca2222;
    -webkit-transition: .4s;
    transition: .4s;
}

.slider:before {
    position: absolute;
    content: "";
    height: 26px;
    width: 26px;
    left: 4px;
    bottom: 4px;
    background-color: white;
    -webkit-transition: .4s;
    transition: .4s;
}

input:checked+.slider {
    background-color: #2ab934;
}

input:focus+.slider {
    box-shadow: 0 0 1px #2196F3;
}

input:checked+.slider:before {
    -webkit-transform: translateX(55px);
    -ms-transform: translateX(55px);
    transform: translateX(45px);
}

/*------ ADDED CSS ---------*/
.on {
    display: none;
}

.on,
.off {
    color: white;
    position: absolute;
    transform: translate(-50%, -50%);
    top: 50%;
    left: 50%;
    font-size: 10px;
    font-family: Verdana, sans-serif;
}

input:checked+.slider .on {
    display: block;
}

input:checked+.slider .off {
    display: none;
}

/*--------- END --------*/

/* Rounded sliders */
.slider.round {
    border-radius: 34px;
}

.slider.round:before {
    border-radius: 50%;
}
</style>
<div class="content-wrapper">
    <div class="row">
        <div class="col-md-12 ">


            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <x-accounttab />
                            <div class="card card-primary">
                                <div class="card-header">
                                    <h3 class="card-title">E<small>ducation</small></h3>
                                </div>
                                @if (session('status'))
                                <div class="alert alert-success" id="success_message">
                                    {{ session('status') }}
                                </div>
                                @endif
                                <form id="quickForm" method="POST" enctype="multipart/form-data"
                                    action="{{route('education')}}">
                                    @csrf
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-xl-6">
                                                <div class="mb-3 row">
                                                    <label class="col-lg-6 col-form-label"
                                                        for="highest_education">Highest education</label>
                                                    <div class="col-lg-6">
                                                        <input type="text" class="form-control"
                                                            placeholder="Highest education" name="highest_education"
                                                            value="<?php if (isset($education->highest_education)) {
                                                                                                                                                                    echo $education->highest_education;
                                                                                                                                                                } ?>">
                                                        @error('highest_education')
                                                        <small class="text-danger">{{ $message }}</small>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="mb-3 row">
                                                    <label class="col-lg-6 col-form-label"
                                                        for="university">University</label>
                                                    <div class="col-lg-6">
                                                        <input type="text" class="form-control" placeholder="University"
                                                            name="university"
                                                            value="<?php if (isset($education->university)) {
                                                                                                                                                        echo $education->university;
                                                                                                                                                    } ?>">
                                                        @error('university')
                                                        <small class="text-danger">{{ $message }}</small>
                                                        @enderror
                                                    </div>
                                                </div>








                                                <!--   ******* -->

                                                <div class="mb-3 row">
                                                    <label class="col-lg-6 col-form-label" for="university">Linkedin
                                                        Url</label>
                                                    <div class="col-lg-6">
                                                        <input type="text" class="form-control"
                                                            placeholder="Linkedin Url" name="linkedin_url"
                                                            value="{{ old('linkedin_url', optional($education)->linkedin_url) }}">
                                                        @error('linkedin_url')
                                                        <small class="text-danger">{{ $message }}</small>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="mb-3 row">
                                                    <label class="col-lg-6 col-form-label" for="university">What score
                                                        did you get in your bachelor's or master's?</label>
                                                    <div class="col-lg-6">
                                                        <input type="text" class="form-control" placeholder="score"
                                                            name="score"
                                                            value="{{ old('score', optional($education)->score) }}">
                                                        @error('score')
                                                        <small class="text-danger">{{ $message }}</small>
                                                        @enderror
                                                    </div>
                                                </div>


                                                <div class="mb-3 row">
                                                    <label class="col-lg-6 col-form-label" for="university">How many
                                                        years of experience do you have in academic writing? (
                                                        Experience is not compulsory if you have a good score.
                                                        ) </label>
                                                    <div class="col-lg-6">
                                                        <input type="text" class="form-control"
                                                            placeholder="years of experience" name="years_of_experience"
                                                            value="{{ old('years_of_experience', optional($education)->years_of_experience) }}">
                                                        @error('years_of_experience')
                                                        <small class="text-danger">{{ $message }}</small>
                                                        @enderror
                                                    </div>
                                                </div>


                                                <div class="mb-3 row">
                                                    <label class="col-lg-6 col-form-label"
                                                        for="tasks_can_handle_in_month">How many tasks can you handle in
                                                        a month? </label>
                                                    <div class="col-lg-6">
                                                        <input type="text" class="form-control"
                                                            placeholder="tasks can handle in month"
                                                            name="tasks_can_handle_in_month"
                                                            value="{{ old('tasks_can_handle_in_month', optional($education)->tasks_can_handle_in_month) }}">
                                                        @error('tasks_can_handle_in_month')
                                                        <small class="text-danger">{{ $message }}</small>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="mb-3 row">
                                                    <label class="col-lg-6 col-form-label" for="turnaround_time">What is
                                                        your turnaround time for a 2000-word essay? </label>
                                                    <div class="col-lg-6">
                                                        <input type="text" class="form-control"
                                                            placeholder="turnaround time" name="turnaround_time"
                                                            value="{{ old('turnaround_time', optional($education)->turnaround_time) }}">
                                                        @error('turnaround_time')
                                                        <small class="text-danger">{{ $message }}</small>
                                                        @enderror
                                                    </div>
                                                </div>


                                                <div class="mb-3 row">
                                                    <label class="col-lg-6 col-form-label" for="charges">How much do you
                                                        charge per 1000 words, or how much pay do you expect to
                                                        get? </label>
                                                    <div class="col-lg-6">
                                                        <input type="text" class="form-control"
                                                            placeholder="charges time" name="charges"
                                                            value="{{ old('charges', optional($education)->charges) }}">
                                                        @error('charges')
                                                        <small class="text-danger">{{ $message }}</small>
                                                        @enderror
                                                    </div>
                                                </div>









                                                <div class="mb-3 row">
                                                    <label class="col-lg-6 col-form-label"
                                                        for="know_how_to_write_essays">Do you know how to write essays,
                                                        reports, assignments, and dissertations in UK and US education
                                                        system formats with proper formatting and referencing, such as
                                                        Harvard, OSCOLA , APA, MLA, etc.? </label>
                                                    <div class="col-lg-6">

                                                        <label class="switch">
                                                            <input type="checkbox" name="know_how_to_write_essays"
                                                                value="YES" @if( old('know_how_to_write_essays',
                                                                optional($education)->know_how_to_write_essays) ==
                                                            'YES') checked="checked" @endif>
                                                            <div class="slider round">
                                                                <!--ADDED HTML -->
                                                                <span class="on">Yes</span>
                                                                <span class="off">No</span>
                                                                <!--END-->
                                                            </div>
                                                        </label>


                                                        @error('know_how_to_write_essays')
                                                        <small class="text-danger">{{ $message }}</small>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="mb-3 row">
                                                    <label class="col-lg-6 col-form-label"
                                                        for="familiar_with_plagiarism">Are you familiar with Plagiarism
                                                        and AI policies and how to avoid them in your writing? </label>
                                                    <div class="col-lg-6">

                                                        <label class="switch">
                                                            <input type="checkbox" name="familiar_with_plagiarism"
                                                                value="YES" @if( old('familiar_with_plagiarism',
                                                                optional($education)->familiar_with_plagiarism) ==
                                                            'YES')
                                                            checked="checked" @endif>
                                                            <div class="slider round">
                                                                <!--ADDED HTML -->
                                                                <span class="on">Yes</span>
                                                                <span class="off">No</span>
                                                                <!--END-->
                                                            </div>
                                                        </label>


                                                        @error('familiar_with_plagiarism')
                                                        <small class="text-danger">{{ $message }}</small>
                                                        @enderror
                                                    </div>
                                                </div>


                                                <div class="mb-3 row">
                                                    <label class="col-lg-6 col-form-label"
                                                        for="comfortable_with_tight_deadlines">Are you comfortable with
                                                        tight deadlines? </label>
                                                    <div class="col-lg-6">


                                                        <label class="switch">

                                                            <input type="checkbox"
                                                                name="comfortable_with_tight_deadlines" value="YES" @if(
                                                                old('comfortable_with_tight_deadlines',
                                                                optional($education)->comfortable_with_tight_deadlines)
                                                            ==
                                                            'YES') checked="checked" @endif>

                                                            <div class="slider round">
                                                                <!--ADDED HTML -->
                                                                <span class="on">Yes</span>
                                                                <span class="off">No</span>
                                                                <!--END-->
                                                            </div>
                                                        </label>

                                                        @error('comfortable_with_tight_deadlines')
                                                        <small class="text-danger">{{ $message }}</small>
                                                        @enderror
                                                    </div>
                                                </div>


                                                <div class="mb-3 row">
                                                    <label class="col-lg-6 col-form-label" for="provide_revisions">Will
                                                        you provide revisions if the client is not satisfied with the
                                                        work or if changes are needed according to the tutor's
                                                        comments? </label>
                                                    <div class="col-lg-6">


                                                        <label class="switch">

                                                            <input type="checkbox" name="provide_revisions" value="YES"
                                                                @if( old('provide_revisions',
                                                                optional($education)->provide_revisions) == 'YES')
                                                            checked="checked" @endif>

                                                            <div class="slider round">
                                                                <!--ADDED HTML -->
                                                                <span class="on">Yes</span>
                                                                <span class="off">No</span>
                                                                <!--END-->
                                                            </div>
                                                        </label>

                                                        @error('provide_revisions')
                                                        <small class="text-danger">{{ $message }}</small>
                                                        @enderror
                                                    </div>
                                                </div>


                                                <div class="mb-3 row">
                                                    <label class="col-lg-6 col-form-label" for="offer_refund">We have a
                                                        policy where we either refund the money or redo the work for
                                                        free if the results are a failure, provided the customer submits
                                                        proof of failure. Will you offer a refund or redo the work for
                                                        free in such cases?  </label>
                                                    <div class="col-lg-6">



                                                        <label class="switch">

                                                            <input type="checkbox" name="offer_refund" value="YES" @if(
                                                                old('offer_refund', optional($education)->offer_refund)
                                                            ==
                                                            'YES') checked="checked" @endif>

                                                            <div class="slider round">
                                                                <!--ADDED HTML -->
                                                                <span class="on">Yes</span>
                                                                <span class="off">No</span>
                                                                <!--END-->
                                                            </div>
                                                        </label>



                                                        @error('offer_refund')
                                                        <small class="text-danger">{{ $message }}</small>
                                                        @enderror
                                                    </div>
                                                </div>








                                                <!--   ******* -->










                                                <div class="mb-3 row">
                                                    <label class="col-lg-6 col-form-label" for="year">Year</label>
                                                    <div class="col-lg-6">
                                                        <input type="text" class="form-control " placeholder="Year"
                                                            name="year"
                                                            value="<?php if (isset($education->year)) {
                                                                                                                                            echo $education->year;
                                                                                                                                        } ?>">
                                                        @error('year')
                                                        <small class="text-danger">{{ $message }}</small>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="mb-3 row">
                                                    <label class="col-lg-6 col-form-label" for="proof">Proof</label>
                                                    <div class="col-lg-6">
                                                        <span>Max file upload size is 10MB</span>
                                                        <input type="file" class="form-control" name="proof">

                                                        <div class="viewFile">
                                                        @if(!empty($education->proof))
                                                        <a href="<?= asset($education->proof); ?>" style="color:blue;"
                                                            target="_blank">View</a>
                                                        @endif
                                                        </div>

                                                        @error('proof')
                                                        <div class="alert alert-danger">{{ $message }}</div>
                                                        @enderror

                                                        <div>
                                                            <!-- <a href="javascript:void(0);" style="text-decoration:none;color:black" onclick="add_education()">Add More Education</a> -->
                                                            <input type="hidden" id="no_education"
                                                                value="{{count($additional_educations)}}">
                                                        </div>
                                                    </div>
                                                </div>
                                                <!--*******-->

                                                <div class="mb-3 row">
                                                    <label class="col-lg-6 col-form-label" for="cv_file">Upload your
                                                        CV</label>
                                                    <div class="col-lg-6">
                                                        <span>Max file upload size is 10MB</span>
                                                        <input type="file" class="form-control" name="cv_file">

                                                        <div class="viewFile">
                                                        @if(!empty($education->cv_file))
                                                        <a href="<?= asset($education->cv_file); ?>" style="color:blue;"
                                                            target="_blank">View</a>
                                                        @endif
                                                        </div>
                                                        @error('cv_file')
                                                        <div class="alert alert-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>



                                                <div class="mb-3 row">
                                                    <label class="col-lg-6 col-form-label"
                                                        for="graduation_degree">Please upload or provide a link to your
                                                        graduation degree and your mark sheet</label>
                                                    <div class="col-lg-6">
                                                        <span>Max file upload size is 10MB</span>
                                                        <input type="file" class="form-control"
                                                            name="graduation_degree">

                                                            <div class="viewFile">
                                                        @if(!empty($education->graduation_degree))
                                                        <a href="<?= asset($education->graduation_degree); ?>"
                                                            style="color:blue;" target="_blank">View</a>
                                                        @endif
                                                            </div>
                                                        @error('graduation_degree')
                                                        <div class="alert alert-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>


                                                <div class="mb-3 row">
                                                    <label class="col-lg-6 col-form-label"
                                                        for="samples_of_previous_work">Can you provide samples of your
                                                        previous work?</label>
                                                    <div class="col-lg-6">
                                                        <span>Max file upload size is 10MB</span>
                                                        <input type="file" class="form-control"
                                                            name="samples_of_previous_work">

                                                            <div class="viewFile">
                                                        @if(!empty($education->samples_of_previous_work))
                                                        <a href="<?= asset($education->samples_of_previous_work); ?>"
                                                            style="color:blue;" target="_blank">View</a>
                                                        @endif
                                                            </div>

                                                        @error('samples_of_previous_work')
                                                        <div class="alert alert-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>


                                                <div class="mb-3 row">
                                                    <label class="col-lg-6 col-form-label" for="anything_else">Do you
                                                        want to add anything else?</label>
                                                    <div class="col-lg-6">
                                                        <textarea class="form-control" placeholder="anything else"
                                                            name="anything_else">{{ old('anything_else', optional($education)->anything_else) }}</textarea>
                                                        @error('anything_else')
                                                        <small class="text-danger">{{ $message }}</small>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <!--*****-->







                                                <div id="add_education">
                                                    @if(!empty($additional_educations))
                                                    <?php $i1 = 0; ?>
                                                    @foreach ($additional_educations as $additional1)
                                                    <?php $i1++; ?>
                                                    <div class="mb-3 row" id="education_{{$i1}}">
                                                        <label class="col-lg-6 col-form-label" for="education_{{$i1}}">
                                                            <?php if($i1 == 1){ ?> Education <?php } ?>
                                                        </label>
                                                        <div class="col-lg-6"
                                                            style="display: flex;justify-content: right;">
                                                            <input type="text" name="addional_education[]"
                                                                class="form-control" placeholder="Enter education "
                                                                value="{{$additional1->education_name}}">
                                                            <div style="position: absolute;">
                                                                <?php if($i1 == 1){ ?>
                                                                <button class="remove-textbox btn"
                                                                    onclick="add_education()"><i class="fa fa-plus"
                                                                        style="color:green;"
                                                                        aria-hidden="true"></i></button>
                                                                <?php }else{ ?>
                                                                <button class="remove-textbox btn"
                                                                    onclick="remove_education('{{$i1}}')"><i
                                                                        class="fa fa-trash" style="color:red;"
                                                                        aria-hidden="true"></i></button>
                                                                <?php }?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    @endforeach

                                                    @endif

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
    <div id="progressModal" class="modal center" tabindex="-1" role="dialog" aria-hidden="true"
        data-bs-keyboard="false" data-bs-backdrop="static">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div id="uploadProgressBar" style="height: 20px;background:#6a73fa; text-align:center;color:#fff;">
                </div>
            </div>
        </div>
    </div>



    <div class="modal" tabindex="-1" role="dialog" id="uploadSuccess" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">

                <div class="modal-body">
                    <p id="uploadingResponse">File uploaded successfully</p>
                </div>
                <div class="modal-footer" style="text-align: center;">
                    <button type="button" class="btn btn-secondary closePopup">OK</button>
                </div>
            </div>
        </div>
    </div>



</div>


<style>
.modal {
    top: 40%;

}
</style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>
@php($tutorId = auth()->user()->id)
<script>
function uploadProgressHandler(event) {
    // $("#loaded_n_total").html("Uploaded " + event.loaded + " bytes of " + event.total);
    var percent = (event.loaded / event.total) * 100;
    var progress = Math.round(percent);
    //$("#uploadProgressBar").html(progress);
    $("#uploadProgressBar").css("width", progress + "%");
    //$("#status").html(progress + "% uploaded... please wait");
}

function loadHandler(event) {
    //$("#status").html(event.target.responseText);
    // $("#uploadProgressBar").css("width", "0%");
}

function errorHandler(event) {
    $('#uploadingResponse').html(`<div class="alert alert-primary d-flex align-items-center" role="alert">
  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:">
    <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
  </svg>
  <div>
    There is an error in file uploading
  </div>
</div>`);
    $('#progressModal').modal('hide');
    $('#uploadSuccess').modal('show');
}

function abortHandler(event) {
    //$("#status").html("Upload Aborted");
}

$(document).ready(function() {

    $('.closePopup').click(function() {
        $('#uploadSuccess').modal('hide');
       // location.reload();
    })



    $("input[type=file]").change(function() {

        var element = $(this);
        attachmentSize = ($(this)[0].files[0].size / 1024) / 1024;
        if (attachmentSize > 10) {
            $('#uploadingResponse').html(`<div class="alert alert-primary d-flex align-items-center" role="alert">
  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:">
    <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
  </svg>
  <div>
    Attachment size should be less than or equal to 10 MB
  </div>
</div>`);
            $('#uploadSuccess').modal('show');
            $("input[type=file]").val(null);
        } else {

            var formData = new FormData();
            formData.append('name', $(this).attr('name'));
            formData.append('file', $(this)[0].files[0]);
            formData.append("_token", "{{ csrf_token() }}");
            $('#progressModal').modal('show');
            $.ajax({
                url: "{{route('education.fileupload',$tutorId)}}",
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                xhr: function() {
                    var xhr = new window.XMLHttpRequest();
                    xhr.upload.addEventListener("progress",
                        uploadProgressHandler,
                        false
                    );
                    xhr.addEventListener("load", loadHandler, false);
                    xhr.addEventListener("error", errorHandler, false);
                    xhr.addEventListener("abort", abortHandler, false);

                    return xhr;
                },
                success: function(data) {

                    element.val(null);
                    //$('#progressModal').hide();
                    $('#progressModal').modal('hide');
                    $('#uploadSuccess').modal('show');
                    element.siblings('[class=viewFile]').html(`<a href="${data.url}"
                                                            style="color:blue;" target="_blank">View</a>`);
                    
                    $('#uploadingResponse').html(`<div class="alert alert-success d-flex align-items-center" role="alert">
  <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor" class="bi bi-check" viewBox="0 0 16 16">
  <path d="M10.97 4.97a.75.75 0 0 1 1.07 1.05l-3.99 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425z"/>
</svg>
  <div>
                ${data.msg}
  </div>
</div>`);
                    //alert(data.msg)
                    
                }
            });
        }
    });
});


$(function() {



    // $('#quickForm').validate({
    //     rules: {
    //         highest_education: {
    //             required: true,
    //             maxlength: 150,
    //             minlength: 2
    //         },
    //         university: {
    //             required: true,
    //             maxlength: 150,
    //             minlength: 2
    //         },
    //         year: {
    //             required: true,
    //             maxlength: 150,
    //             minlength: 2
    //         },
    //     },
    //     errorElement: 'span',
    //     errorPlacement: function(error, element) {
    //         error.addClass('invalid-feedback');
    //         element.closest('.form-group').append(error);
    //     },
    //     highlight: function(element, errorClass, validClass) {
    //         $(element).addClass('is-invalid');
    //     },
    //     unhighlight: function(element, errorClass, validClass) {
    //         $(element).removeClass('is-invalid');
    //     }
    // });
});

function add_education() {
    let textboxCount = $('#no_education').val();
    textboxCount++;
    var newTextbox = '<div class="mb-3 row" id="education_' + textboxCount +
        '"><label class="col-lg-6 col-form-label" for="education_{{$i1}}"></label><div class="col-lg-6" style="display: flex;justify-content: right;"><input type="text" name="addional_education[]" class="form-control" required placeholder="Enter education"><div style="position: absolute;"><button class="remove-textbox btn" onclick="remove_education(' +
        textboxCount +
        ')"><i class="fa fa-trash" style="color:red;" aria-hidden="true"></i></button></div></div></div>';
    $('#add_education').append(newTextbox);
    $('#no_education').val(textboxCount);
}

function remove_education(remove_id) {
    $('#education_' + remove_id).html('');
    $('#education_' + remove_id).remove();
}
</script>
@endsection