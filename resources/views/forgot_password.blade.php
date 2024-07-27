<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="../assets/img/favicon.png">
  <title>My Writers</title>
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
  <!-- Nucleo Icons -->
  <link href="{{ asset('assets/css/nucleo-icons.css') }}" rel="stylesheet" />
  <link href="{{ asset('assets/css/nucleo-svg.css') }}" rel="stylesheet" />
  <!-- Font Awesome Icons -->
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <link href="{{ asset('assets/css/nucleo-svg.css') }}" rel="stylesheet" />
  <!-- CSS Files -->
  <!-- <link id="pagestyle" href="{{ asset('assets/css/soft-ui-dashboard.css?v=1.0.3') }}" rel="stylesheet" /> -->
  <!-- STYLESHEETS -->
  <link href="vendor/bootstrap-select/dist/css/bootstrap-select.min.css" rel="stylesheet">

  <link class="main-css" rel="stylesheet" href="css/style.css">
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
              <h4 class="text-center mb-4">Forgot password</h4>
              @if (session('success'))
              <div class="alert alert-success" id="success_message">
                {{ session('success') }}
              </div>
              @endif
              <div id="invalid_login_data" class="error" style="display:none">Invalid email</div>

              <form role="form text-left" id="login_form" method="POST" action="{{route('tutor_forgot_password')}}">
                @csrf

                <div class="form-group">
                  <label class="form-label" for="username">Email</label>
                  <input type="email" name="tutor_email" class="form-control" placeholder="email" onkeyup="error_form('invalid_login_data')" id="">
                </div>

                <div class="text-center">
                  <button type="submit" class="btn btn-primary btn-block">Forgot password</a>
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
  <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
  <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script> -->

  <!-- ✅ FIRST - load jquery ✅ -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous">
  </script>

  <!-- ✅ SECOND - load jquery validate ✅ -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js" integrity="sha512-37T7leoNS06R80c8Ulq7cdCDU5MNQBwlYoy1TX/WUsLFC2eYNqtKlV0QjH7r8JpG/S0GUMZwebnVFLPd6SU5yg==" crossorigin="anonymous" referrerpolicy="no-referrer">
  </script>

  <!-- ✅ THIRD - load additional methods ✅ -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/additional-methods.min.js" integrity="sha512-XZEy8UQ9rngkxQVugAdOuBRDmJ5N4vCuNXCh8KlniZgDKTvf7zl75QBtaVG1lEhMFe2a2DuA22nZYY+qsI2/xA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

  <script>
    $().ready(function() {

      $("#login_form").validate({
        rules: {
          tutor_email: {
            required: true,
            email: true
          },
        },
        submitHandler: function(form) {
          $('#invalid_login_data').hide();
          var formData = $(form).serialize();
          $.post("{{route('tutor_forgot_password')}}", formData)
            .done(function(response) {
              //window.location.href="home";
              console.log('Success:', response);
            })
            .fail(function(xhr, status, error) {
              $('#invalid_login_data').show();
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
</body>

</html>