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

  <meta name="keywords" content="admin, dashboard, admin dashboard, admin template, template, admin panel, administration, analytics, bootstrap, modern, responsive, creative, retina ready, modern Dashboard responsive dashboard, responsive template, user experience, user interface, Bootstrap Dashboard, Analytics Dashboard, Customizable Admin Panel, EduMin template, ui kit, web app, EduMin, School Management,Dashboard Template, academy, course, courses, e-learning, education, learning, learning management system, lms, school, student, teacher">

  <meta name="description" content="EduMin - Empower your educational institution with the all-in-one Education Admin Dashboard Template. Streamline administrative tasks, manage courses, track student performance, and gain valuable insights with ease. Elevate your education management experience with a modern, responsive, and feature-packed solution. Explore EduMin now for a smarter, more efficient approach to education administration.">

  <meta property="og:title" content="EduMin - Education Admin Dashboard Template | dexignlabs">
  <meta property="og:description" content="EduMin - Empower your educational institution with the all-in-one Education Admin Dashboard Template. Streamline administrative tasks, manage courses, track student performance, and gain valuable insights with ease. Elevate your education management experience with a modern, responsive, and feature-packed solution. Explore EduMin now for a smarter, more efficient approach to education administration.">

  <meta property="og:image" content="https://edumin.dexignlab.com/xhtml/social-image.png">

  <meta name="format-detection" content="telephone=no">

  <meta name="twitter:title" content="EduMin - Education Admin Dashboard Template | dexignlabs">
  <meta name="twitter:description" content="EduMin - Empower your educational institution with the all-in-one Education Admin Dashboard Template. Streamline administrative tasks, manage courses, track student performance, and gain valuable insights with ease. Elevate your education management experience with a modern, responsive, and feature-packed solution. Explore EduMin now for a smarter, more efficient approach to education administration.">

  <meta name="twitter:image" content="https://edumin.dexignlab.com/xhtml/social-image.png">
  <meta name="twitter:card" content="summary_large_image">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" type="image/png" sizes="16x16" href="./images/favicon.png">

  <!-- STYLESHEETS -->
  <link href="vendor/bootstrap-select/dist/css/bootstrap-select.min.css" rel="stylesheet">

  <link class="main-css" rel="stylesheet" href="css/style.css">
  <!-- STYLESHEETS -->
  <!-- <link href="vendor/bootstrap-select/dist/css/bootstrap-select.min.css" rel="stylesheet"> -->
  <!-- <link rel="stylesheet" href="./vendor/select2/css/select2.min.css"> -->
  <!-- <link href="vendor/bootstrap-select/dist/css/bootstrap-select.min.css" rel="stylesheet"> -->

</head>

<body>

  <div class="fix-wrapper">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-5 col-md-6">
          <div class="card mb-0 h-auto">
            <div class="card-body">
              <div class="text-center mb-2">
                <a href="index.html">
                  <h1>MY WRITER</h1>
                </a>
              </div>
              <h4 class="text-center mb-4">Sign in your account</h4>
              @if (session('success'))
              <div class="alert alert-success" id="success_message">
                {{ session('success') }}
              </div>
              @endif
              <div id="invalid_login_data" class="error" style="display:none">Invalid email or password</div>

              <form role="form text-left" id="login_form" method="POST">
                @csrf

                <div class="form-group">
                  <label class="form-label" for="username">Email</label>
                  <input type="email" name="tutor_email" class="form-control" placeholder="email" id="">
                </div>
                <div class="mb-4 position-relative">
                  <label class="form-label" for="dlabPassword">Password</label>
                  <input type="password" id="dlabPassword" name="password" class="form-control" value="" autocomplete="new-password">
                  <span class="show-pass eye">
                    <i class="fa fa-eye-slash"></i>
                    <i class="fa fa-eye"></i>
                  </span>
                </div>
                @if($errors->any())
                {!! implode('', $errors->all('<div style="color:red;" class="mb-3">:message</div>')) !!}
                @endif
                <div class="form-row d-flex flex-wrap justify-content-between mt-4 mb-2">
                  <div class="form-group">
                    <div class="form-check custom-checkbox ms-1">
                      <input type="checkbox" class="form-check-input" id="basic_checkbox_1">
                      <label class="form-check-label" for="basic_checkbox_1">Remember my preference</label>
                    </div>
                  </div>
                  <div class="form-group ms-2">
                    <a class="btn-link" href="{{route('forgot_password')}}">Forgot Password?</a>
                  </div>
                </div>
                <div class="text-center">
                  <button type="submit" class="btn btn-primary btn-block">Sign Me In</a>
                </div>
              </form>
              <div class="new-account mt-3">
                <p>Don't have an account? <a class="text-primary" href="{{route('signup')}}">Sign up</a></p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- ✅ FIRST - load jquery ✅ -->
  <script
      src="https://code.jquery.com/jquery-3.6.0.min.js"
      integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
      crossorigin="anonymous">
    </script>

    <!-- ✅ SECOND - load jquery validate ✅ -->
    <script
      src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js"
      integrity="sha512-37T7leoNS06R80c8Ulq7cdCDU5MNQBwlYoy1TX/WUsLFC2eYNqtKlV0QjH7r8JpG/S0GUMZwebnVFLPd6SU5yg=="
      crossorigin="anonymous"
      referrerpolicy="no-referrer">
    </script>

    <!-- ✅ THIRD - load additional methods ✅ -->
    <script
      src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/additional-methods.min.js"
      integrity="sha512-XZEy8UQ9rngkxQVugAdOuBRDmJ5N4vCuNXCh8KlniZgDKTvf7zl75QBtaVG1lEhMFe2a2DuA22nZYY+qsI2/xA=="
      crossorigin="anonymous"
      referrerpolicy="no-referrer"
    ></script>
  <script>
        $().ready(function () {

            $("#login_form").validate({
                rules: {
                    tutor_email: {
                        required: true,
                    },
                    password: {
                        required: true,
                    },
                },
                submitHandler: function(form) {
                    $('#invalid_login_data').hide();
                    var formData        =   $(form).serialize();
                    $.post("{{route('login')}}", formData)
                        .done(function(response) {
                            window.location.href="dashboard";
                            console.log('Success:', response);
                        })
                        .fail(function(xhr, status, error) {
                            $('#invalid_login_data').show();
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
    <style>
        .error{
            color:red;
        }
    </style>

  <!--**********************************
        Scripts
    ***********************************-->
  <!-- Required vendors -->
  <!-- <script src="vendor/global/global.min.js"></script>
  <script src="vendor/bootstrap-select/dist/js/bootstrap-select.min.js"></script>

  <script src="js/custom.min.js"></script>
  <script src="js/dlabnav-init.js"></script> -->



</body>

</html>