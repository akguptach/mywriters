<html lang="en" >
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
    <!-- CSS Files -->
    <link id="pagestyle" href="{{ asset('assets/css/soft-ui-dashboard.css?v=1.0.3') }}" rel="stylesheet" />
  </head>

  <body class="g-sidenav-show  bg-gray-100 ">
    <div class="container2 position-sticky z-index-sticky top-0">
      <div class="row">
          <div class="col-12">
            <x-navbar/>
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
                        <h5>Login with</h5>
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
                        @if (session('success'))
                          <div class="alert alert-success" id="success_message">
                              {{ session('success') }}
                          </div>
                        @endif
                        <div id="invalid_login_data" class="error" style="display:none">Invalid email or password</div>

                        <form role="form text-left" id="login_form" method="POST" action="{{route('login')}}">
                          @csrf
                          <div class="mb-3">
                            <input type="text" class="form-control"  placeholder="Email" name="tutor_email" onkeyup="error_form('invalid_login_data')">
                          </div>
                          <div class="mb-3">
                            <input type="password" class="form-control "  placeholder="Password" name="password" onkeyup="error_form('invalid_login_data')">
                          </div>
                          <div class="text-center">
                            <button type="submit" class="btn bg-gradient-dark w-100 my-4 mb-2">Sign in</button>
                          </div>
                          <small class="text-muted">Forgot you password? Reset you password 
                            <a href="{{route('forgot_password')}}" class="text-info text-gradient font-weight-bold">here</a>
                          </small>
                          <p class="text-sm mt-3 mb-0">Don't have an account?  <a href="{{route('signup')}}" class="text-dark font-weight-bolder">Sign up</a></p>
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>
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
  </body>

</html>