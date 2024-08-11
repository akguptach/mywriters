<!DOCTYPE html>
<html lang="en">

<head>

  <!-- Title -->
  <title>EduMin - Education Admin Dashboard Template | dexignlabs</title>

  <!-- Meta -->
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="author" content="dexignlabs">
  <meta name="robots" content="index, follow">

  <meta name="keywords" content="">

  <meta name="description" content="">

  <meta property="og:title" content="">
  <meta property="og:description" content="">

  <meta property="og:image" content="https://edumin.dexignlab.com/xhtml/social-image.png">

  <meta name="format-detection" content="telephone=no">

  <meta name="twitter:title" content="">
  <meta name="twitter:description" content="">

  <meta name="twitter:image" content="https://edumin.dexignlab.com/xhtml/social-image.png">
  <meta name="twitter:card" content="summary_large_image">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" type="image/png" sizes="16x16" href="./images/favicon.png">
  <link rel="stylesheet" href="{{env('APP_URL')}}/vendor/bootstrap-select/dist/css/bootstrap-select.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.12/css/intlTelInput.css">
  <link class="main-css" rel="stylesheet" href="{{env('APP_URL')}}/css/style.css">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous">
  </script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.12/js/intlTelInput.min.js"></script>
  <script>
		var APP_URL = "{{env('APP_URL','/')}}"
	</script>
</head>

<body>
  <div class="fix-wrapper">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-5 col-md-6">
          <div class="card mb-0 h-auto">
            <div class="card-body">
              <div class="text-center mb-2">
                <a href="javascript:void(0);">
                  <h1>MY WRITER</h1>
                </a>
              </div>
              <h4 class="text-center mb-4">Sign up your account</h4>
              <div id="invalid_signup_data" class="error" style="display:none">Email or mobile number already exists</div>

              <form role="form text-left" id="signup_form" method="POST" action="{{route('signup')}}">
                @csrf
                <div class="form-group">
                  <label class="form-label" for="username">First Name</label>
                  <input type="text" class="form-control" placeholder="firstname" name="tutor_first_name" id="tutor_first_name">
                </div>
                <div class="form-group">
                  <label class="form-label" for="username">Last Name</label>
                  <input type="text" class="form-control" placeholder="lastname" name="tutor_last_name" id="tutor_last_name">
                </div>
                <div class="form-group">
                  <div>
                    <label class="form-label" for="username">Contact</label>
                  </div>
                  <input type="text" class="form-control" placeholder="contact" name="tutor_contact_no" id="phone_number" style="width:392px;">
                  <input type="hidden" class="form-control" name="country_code" id="country_code">
                                <span id="phone-error" style="color: red;"></span>
                </div>
                <div class="form-group">
                  <label class="form-label" for="email">Email</label>
                  <input type="email" class="form-control" placeholder="hello@example.com" name="tutor_email" id="email">
                </div>


                <div class="form-group">
                  <label class="form-label" for="username">Subject</label>
                  <select class="form-control multi-select" name="tutor_subject[]" id="tutor_subject" multiple>
                    @if(!empty($subjects))
                    @foreach ($subjects as $subject)
                    <option value="{{$subject->id}}">{{$subject->subject_name}}</option>
                    @endforeach
                    @endif
                  </select>
                </div>

                <div class="mb-4 position-relative">
                  <label class="form-label" for="dlabPassword">Password</label>
                  <input type="password" id="dlabPassword" name="password" class="form-control" value="" autocomplete="new-password">
                  <span class="show-pass eye">
                    <i class="fa fa-eye-slash"></i>
                    <i class="fa fa-eye"></i>
                  </span>
                </div>
                <div class="text-center mt-4">
                  <button type="submit" class="btn btn-primary btn-block">Sign me up</button>
                </div>
              </form>
              <div class="new-account mt-3">
                <p>Already have an account? <a class="text-primary" href="{{route('login')}}">Sign in</a></p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- ✅ FIRST - load jquery ✅ -->
  

  <!-- ✅ SECOND - load jquery validate ✅ -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js" integrity="sha512-37T7leoNS06R80c8Ulq7cdCDU5MNQBwlYoy1TX/WUsLFC2eYNqtKlV0QjH7r8JpG/S0GUMZwebnVFLPd6SU5yg==" crossorigin="anonymous" referrerpolicy="no-referrer">
  </script>

  <!-- ✅ THIRD - load additional methods ✅ -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/additional-methods.min.js" integrity="sha512-XZEy8UQ9rngkxQVugAdOuBRDmJ5N4vCuNXCh8KlniZgDKTvf7zl75QBtaVG1lEhMFe2a2DuA22nZYY+qsI2/xA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>


  <script src="{{env('APP_URL')}}/vendor/global/global.min.js"></script>
	<script src="{{env('APP_URL')}}/vendor/bootstrap-select/dist/js/bootstrap-select.min.js"></script>
	
	<!-- Datatable -->
    <script src="{{env('APP_URL')}}/vendor/datatables/js/jquery.dataTables.min.js"></script>
    <script src="{{env('APP_URL')}}/js/plugins-init/datatables.init.js"></script>
	
    <!-- Svganimation scripts -->
    <script src="{{env('APP_URL')}}/vendor/svganimation/vivus.min.js"></script>
    <script src="{{env('APP_URL')}}/vendor/svganimation/svg.animation.js"></script>

    <script src="{{env('APP_URL')}}/js/custom.min.js"></script>
    <script src="{{env('APP_URL')}}/js/dlabnav-init.js"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>
  <script>
    $(document).ready(function() {
        // Initialize intl-tel-input plugin
        var input = document.querySelector("#phone_number");
        var iti = window.intlTelInput(input, {
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

    $().ready(function() {

      $("#signup_form").validate({
        rules: {
          tutor_first_name: {
            required: true,
            minlength: 2
          },
          tutor_last_name: {
            required: true,
            minlength: 2
          },
          tutor_email: {
            required: true,
            email: true
          },
          phone_number: {
            required: true,
            number: true
          },
          tutor_subject: {
            required: true,
          },
          password: {
            required: true,
          },
        },
        submitHandler: function(form) {
          $('#invalid_login_data').hide();
          var formData = $(form).serialize();
          $.post("{{route('signup')}}", formData)
            .done(function(response) {
              window.location.href = "account_info";
              console.log('Success:', response);
            })
            .fail(function(xhr, status, error) {

              var data = xhr.responseJSON.data;
              var message = Object.values(data)
              $('#invalid_signup_data').html(message[0][0]);
              $('#invalid_signup_data').show();
              console.error('Error:', error);
            })
            .always(function() {
              console.log('Request completed.');
            });
          return false;
        }
      });
    });

    function error_form(error_id) {
      $('#' + error_id).hide();
    }
  </script>
  <style>
    .error {
      color: red;
    }
  </style>

  <!-- STYLESHEETS -->

  <link class="main-css" rel="stylesheet" href="css/style.css">
  <!-- STYLESHEETS -->


  <!--**********************************
        Scripts
    ***********************************-->
  <!-- Required vendors -->
  <!-- <script src="vendor/global/global.min.js"></script> -->
  <!-- <script src="vendor/bootstrap-select/dist/js/bootstrap-select.min.js"></script> -->


  

  <!-- Svganimation scripts -->
 

  <!-- <script src="js/custom.min.js"></script>
  <script src="js/dlabnav-init.js"></script> -->


  <script>
        $().ready(function () {

            $("#signup_form").validate({
                rules: {
                    tutor_first_name: {
                        required: true,
                        minlength:2
                    },
                    tutor_last_name: {
                        required: true,
                        minlength:2
                    },
                    tutor_email: {
                        required: true,
                        email:true
                    },
                    tutor_contact_no: {
                        required: true,
                        number:true
                    },
                    tutor_subject: {
                        required: true,
                    },
                    password: {
                        required: true,
                    },
                },
                submitHandler: function(form) {
                    $('#invalid_login_data').hide();
                    var formData        =   $(form).serialize();
                    $.post("{{route('signup')}}", formData)
                        .done(function(response) {
                            window.location.href="account_info";
                            console.log('Success:', response);
                        })
                        .fail(function(xhr, status, error) {
                            $('#invalid_signup_data').show();
                            var data = xhr.responseJSON.data;
              var message = Object.values(data)
              $('#invalid_signup_data').html(message[0][0]);
              
                            console.error('Error:', error);
                        })
                        .always(function() {
                            console.log('Request completed.');
                        }
                    );
                    return false;
                }
            });
        });
        function error_form(error_id){
            $('#'+error_id).hide();
        }
    </script>
</body>

</html>