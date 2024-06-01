<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <link href="{{ asset('img/logo/logo.png') }}" rel="icon">
  <title>SIMITRA - Register</title>
  <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
  <link href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css">
  <link href="{{ asset('css/simitra.css') }}" rel="stylesheet">
  <style>
    body {
      background: linear-gradient(to right, #6777EF, #44489A);
      margin: 0;
      padding: 0;
    }

    .text-center a {
      color: white;
      /* Mengatur warna teks menjadi putih */
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

    /* CSS untuk input */
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

    .form-group select {
      background-color: rgba(255, 255, 255, 0.2);
      border: none;
      flex: 1;
    }

    .form-group select option {
      color: black;
      /* Change this to desired color for dropdown items */
    }
  </style>
</head>
<div class="container-login2">
  <div class="row justify-content-center">
    <div class="col-xl-10 col-lg-12 col-md-9">
      <div class="row">
        <div class="col-lg-12">
          <div class="login-form">
            <div class="text-center">
              <img class="logo" src="{{ asset('img/logo/logo.png') }}" alt="Logo" style="width: 160px;">
              <h5 style="color: white;">Sistem Informasi Akuntansi
                <br>PT Mitra Indo Maju Mandiri
              </h5>
            </div>
            <br>
            <form method="POST" action="{{ route('Sign Up Pegawai') }}">
              @csrf
              <div class="form-group" style="display: flex; align-items: center;">
                <label for="username">Username</label>
                <input type="text" class="form-control" id="username" name="username" placeholder="Enter Username"
                  style="flex: 1;">
              </div>
              <div class="form-group" style="display: flex; align-items: center;">
                <label for="nama_lengkap">Nama Lengkap</label>
                <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap"
                  placeholder="Enter Nama Lengkap" style="flex: 1;">
              </div>
              <div class="form-group" style="display: flex; align-items: center;">
                <label for="posisi">Posisi</label>
                <select class="form-control" id="posisi" name="posisi" placeholder="Select Posisi" style="flex: 1;">
                  <option value="Direktur">Direktur</option>
                  <option value="Administrasi">Administrasi</option>
                  <option value="Operasional">Operasional</option>
                  <option value="Keuangan">Keuangan</option>
                </select>
              </div>
              <div class="form-group" style="display: flex; align-items: center;">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp"
                  placeholder="Enter Email Address" style="flex: 1;">
              </div>
              <div class="form-group" style="position: relative;">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Enter Password">
                <i class="fas fa-eye-slash toggle-password" onclick="togglePasswordVisibility('password')"
                  style="position: absolute; top: 50%; right: 10px; transform: translateY(-50%); cursor: pointer;"></i>
              </div>
              <div class="form-group" style="position: relative;">
                <label for="reenter_password">Reenter Password</label>
                <input type="password" class="form-control" id="reenter_password" name="reenter_password"
                  placeholder="Reenter Password">
                <i class="fas fa-eye-slash toggle-password" onclick="togglePasswordVisibility('reenter_password')"
                  style="position: absolute; top: 50%; right: 10px; transform: translateY(-50%); cursor: pointer;"></i>
              </div>
              <div class="form-group">
                <button type="submit" class="btn btn-primary btn-block">Register</button>
              </div>
            </form>
            <hr>
            <div class="text-center">
              <a class="font-weight-bold small" href="{{ route('Login Pegawai') }}">Already have an account?</a>
            </div>
            <div class="text-center">
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- Register Content -->
<script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js') }}"></script>
<script src="{{ asset('js/simitra.min.js') }}"></script>
</body>
<script>
  function togglePasswordVisibility(inputId) {
    var passwordInput = document.getElementById(inputId);
    var icon = document.querySelector('#' + inputId + '+ .toggle-password'); // Cari ikon toggle yang terkait dengan input

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
document.addEventListener('DOMContentLoaded', function() {
    var selectElement = document.getElementById('exampleInputPosisi');

    selectElement.addEventListener('change', function() {
        if (this.value === "") {
            this.classList.add('placeholder');
            this.style.color = 'gray'; // Placeholder color
        } else {
            this.classList.remove('placeholder');
            this.style.color = 'white'; // Text color for selected option
            this.style.backgroundColor = 'rgba(255, 255, 255, 0.2)'; // Transparent background for selected option
        }
    });
});
</script>

</html>