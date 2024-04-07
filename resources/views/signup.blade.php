<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="../assets/img/favicon.png">
  <title>Essay Help</title>
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
  <!-- Nucleo Icons -->
  <link href="{{ asset('assets/css/nucleo-icons.css') }}" rel="stylesheet" />
  <link href="{{ asset('assets/css/nucleo-svg.css') }}" rel="stylesheet" />
  <!-- Font Awesome Icons -->
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <link href="{{ asset('assets/css/nucleo-svg.css') }}" rel="stylesheet" />
  <link href="{{ asset('assets/css/multi-select.css') }}" rel="stylesheet" />
  <!-- CSS Files -->
  <link id="pagestyle" href="{{ asset('assets/css/soft-ui-dashboard.css?v=1.0.3') }}" rel="stylesheet" />
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
  <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>
  <script src="{{asset('assets/js/jquery.multi-select.min.js')}}"></script>
</head>

<body class="g-sidenav-show  bg-gray-100 ">
  <div class="container2 position-sticky2 z-index-stick2y top-202">
    <div class="row">
      <div class="col-12">
        <x-navbar />

        <section class="min-vh-100 mb-8">
          <div class="page-header align-items-start min-vh-50 pt-5 pb-11 mx-3 border-radius-lg" style="background-image: url('public/assets/img/curved-images/curved14.jpg');">
            <span class="mask bg-gradient-dark opacity-6"></span>
            <div class="container">
              <div class="row justify-content-center">
                <div class="col-lg-5 text-center mx-auto">
                  <h1 class="text-white mb-2 mt-5">Welcome!</h1>
                </div>
              </div>
            </div>
          </div>
          <div class="container">
            <div class="row mt-lg-n10 mt-md-n11 mt-n10">
              <div class="col-xl-4 col-lg-5 col-md-7 mx-auto">

                <div class="card z-index-0">
                  <div class="card-header text-center pt-4">
                    <h5>Register</h5>
                  </div>
                  <div class="row px-xl-5 px-sm-4 px-3">
                    <div class="col-3 ms-auto px-1">
                    </div>
                    <div class="col-3 px-1">
                    </div>
                    <div class="col-3 me-auto px-1">

                      </a>
                    </div>
                    <div class="mt-2 position-relative text-center">

                    </div>
                  </div>
                  <div class="card-body">
                    <div id="invalid_signup_data" class="error" style="display:none">Email or mobile number already exists</div>

                    <form role="form text-left" id="signup_form" method="POST" action="{{route('signup')}}">
                      @csrf
                      <div class="mb-3">
                        <input type="text" class="form-control " placeholder="First name" name="tutor_first_name">

                      </div>
                      <div class="mb-3">
                        <input type="text" class="form-control" placeholder="Last name" name="tutor_last_name">
                      </div>
                      <div class="mb-3">
                        <input type="text" class="form-control" placeholder="Contact no" name="tutor_contact_no">
                      </div>
                      <div class="mb-3">
                        <input type="email" class="form-control" placeholder="Email id" name="tutor_email">
                      </div>

                      <div class="mb-3 tutor-subjects">
                        <select class="form-control" name="tutor_subject[]" id="tutor_subject" multiple>
                          @if(!empty($subjects))
                          @foreach ($subjects as $subject)
                          <option value="{{$subject->id}}">{{$subject->subject_name}}</option>
                          @endforeach
                          @endif
                        </select>
                      </div>
                      <div class="mb-3">
                        <input type="password" class="form-control" name="password" placeholder="Password">
                      </div>
                      <div class="text-center">
                        <button type="submit" class="btn bg-gradient-dark w-100 my-4 mb-2">Sign up</button>
                      </div>
                      <p class="text-sm mt-3 mb-0">Already have an account? <a href="{{route('home')}}" class="text-dark font-weight-bolder">Sign in</a></p>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
      </div>
    </div>
  </div>

  <script>
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
          tutor_contact_no: {
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
    $('#tutor_subject').multiSelect();

    $('.tutor-subjects .multi-select-button').html('Please Select Subject');
  </script>
  <style>
    .error {
      color: red;
    }

    .tutor-subjects .multi-select-container {
      width: 100%;
    }

    .tutor-subjects .multi-select-button {
      -webkit-appearance: none;
      -moz-appearance: none;
      appearance: none;
      background-clip: padding-box;
      background-color: #fff;
      border: 1px solid #d2d6da;
      border-radius: .5rem;
      color: #495057;
      display: block;
      font-size: .875rem;
      font-weight: 400;
      line-height: 1.4rem;
      padding: .5rem .75rem;
      transition: box-shadow .15s ease, border-color .15s ease;
      width: 100%;
      max-width: 100%;
    }
  </style>




</body>

</html>