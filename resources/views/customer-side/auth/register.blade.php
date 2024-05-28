@extends('layouts.customer')

@section('section')
  <section class="register-banner">
    <div class="form-container-register">
    <div class="form-container-register-form">
      <div class="breadcrumb-text">
        <h1>Register</h1>
      </div>
      <br>
      <form action="{{ route('Sign Up') }}" method="POST">
        @csrf
        <input type="hidden" name="id_customer" value="C_00{{ App\Models\DataCustomer::get()->count()+1 }}">
        <p class="input-with-label">
          <label for="username">Username</label>
          <input type="text" id="username" name="username">
        </p>	
        <p class="input-with-label">
          <label for="nama_customer">Nama Perusahaan</label>
          <input type="text" id="nama_customer" name="nama_customer">
        </p>
        <p class="input-with-label">
          <label for="alamat_customer">Alamat Perusahaan</label>
          <input type="text" id="alamat_customer" name="alamat_customer">
        </p>
        <p class="input-with-label">
          <label for="telepon_customer">Telepon Perusahaan</label>
          <input type="tel" id="telepon_customer" name="telepon_customer">
        </p>
        <p class="input-with-label">
          <label for="email_customer">Email</label>
          <input type="email" id="email_customer" name="email_customer">
        </p>
        <p class="input-with-label">
          <label for="pic">Nama PIC</label>
          <input type="text" id="pic" name="pic">
        </p>
        <p class="input-with-label">
          <label for="phone_pic">No. Telp (PIC)</label>
          <input type="tel" id="phone_pic" name="phone_pic">
        </p>				
        <p class="password-input">
          <label for="password">Password </label>
          <input type="password" id="password" name="password">
          <span class="toggle-password" onclick="togglePasswordVisibility('password')">
            <i class="fas fa-eye"></i>
          </span>
        </p>
        <p class="password-input">
          <label for="password">Reenter Password</label>
          <input type="password" id="reenter_password" name="reenter_password">
          <span class="toggle-password" onclick="togglePasswordVisibility('reenter_password')">
            <i class="fas fa-eye"></i>
          </span>
        </p>
        <br>								
        <p><input type="submit" value="Register"></p>
      </form>			
    </div>
  </div>
  </section>
  <script>
    function togglePasswordVisibility(inputId) {
      var input = document.getElementById(inputId);
      var icon = input.nextElementSibling.querySelector('i');
  
      if (input.type === "password") {
          input.type = "text";
          icon.classList.remove("fa-eye");
          icon.classList.add("fa-eye-slash");
      } else {
          input.type = "password";
          icon.classList.remove("fa-eye-slash");
          icon.classList.add("fa-eye");
      }
  }
  </script>
@endsection