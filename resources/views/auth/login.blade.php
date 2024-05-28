<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <link href="{{ asset('img/logo/logo.png') }}" rel="icon">
  <title>SIMITRA - Login</title>
  <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
  <link href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css">
  <link href="{{ asset('css/simitra.min.css') }}" rel="stylesheet">
  <style>
    body {
      background: linear-gradient(to right, #6777EF, #44489A);
      margin: 0;
      padding: 0;
    }

    .image-section {
      position: relative;
      height: 100%;
      margin: 0;
      padding: 0;
      overflow-y: hidden;
    }

    .image-section img {
      position: absolute;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      width: 100%;
      max-height: 100%;
      border-radius: 10px;
      margin: 0;
      padding: 0;
    }

    .btn-primary {
      background-color: rgba(255, 255, 255, 0.5);
      border-color: transparent;
      color: #000;
    }

    .btn-primary:hover {
      background-color: rgba(255, 255, 255, 0.7);
    }

    .form-group label {
      color: white;
      margin-right: 10px;
    }

    .form-group input[type="text"],
    .form-group input[type="email"],
    .form-group input[type="password"] {
      background-color: rgba(255, 255, 255, 0.2);
      border: none;
      color: white;
      flex: 1;
    }

    .form-group .toggle-password {
      color: rgba(255, 255, 255, 0.3);
    }
  </style>
</head>

<body>
  <!-- featured section -->
  <div class="container-login">
    <div class="row">
      <!-- Form section -->
      <div class="col-lg-5" style="margin-left: 100px;">
        <div class="login-form">
          <!-- Image and heading -->
          <div class="text-center">
            <img class="logo" src="{{ asset('img/logo/logo.png') }}" alt="Logo" style="width: 130px;">
            <h5 style="color: white;">Sistem Informasi Akuntansi
              <br>PT Mitra Indo Maju Mandiri
            </h5>
          </div>
          <!-- Rest of your login form -->
          <form class="user" method="POST" action="{{ route('Sign In Pegawai') }}">
            @csrf
            <div class="form-group">
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text text-white"><i class="fas fa-envelope"></i></span>
                </div>
                <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp"
                  placeholder="Enter Email Address">
              </div>
            </div>
            <div class="form-group" style="position: relative;">
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text text-white"><i class="fas fa-lock"></i></span>
                </div>
                <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                <i class="fas fa-eye-slash toggle-password"
                  style="position: absolute; top: 50%; right: 10px; transform: translateY(-50%); cursor: pointer; color: white;"></i>
              </div>
            </div>

            <div class="form-group">
              <div class="custom-control custom-checkbox small" style="line-height: 1.5rem;">
                <input type="checkbox" class="custom-control-input" id="customCheck">
                <label class="custom-control-label" for="customCheck" style="color: white;">Remember Me</label>
              </div>
            </div>
            <div class="form-group">
              <button type="submit" class="btn btn-primary btn-block">Login</button>
            </div>
            <hr>
          </form>
          <hr>
          <div class="text-center">
            <a class="font-weight-bold small" href="register.html" style="color: white;">Create an Account!</a>
          </div>
          <div class="text-center"></div>
        </div>
      </div>
      <div class="col-lg-5" style="margin-left: 100px; margin-right: none;">
        <div class="image-section">
          <!-- Your image goes here -->
          <img src="{{ asset('img/login.png') }}" alt="Your Image" style="max-width: 100%;">
        </div>
      </div>
    </div>
  </div>
  <!-- end featured section -->
  <!-- Login Content -->
  <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
  <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js') }}"></script>
  <script src="{{ asset('js/simitra.min.js') }}"></script>
</body>

<script>
  // Function to toggle password visibility
  function togglePasswordVisibility() {
    var passwordInput = document.getElementById('exampleInputPassword');
    var icon = document.querySelector('.toggle-password');

    if (passwordInput.type === "password") {
      passwordInput.type = "text";
      icon.classList.remove("fa-eye-slash");
      icon.classList.add("fa-eye");
    } else {
      passwordInput.type = "password";
      icon.classList.remove("fa-eye");
      icon.classList.add("fa-eye-slash");
    }
  }

  // Attach togglePasswordVisibility to icon click event
  document.querySelector('.toggle-password').addEventListener('click', togglePasswordVisibility);
</script>

</html>