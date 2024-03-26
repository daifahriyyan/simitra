@extends('layouts.customer')

@section('section')
<section class="shop-banner">
  <div class="form-container-login">
    <div class="form-container-login-form">
      <div class="breadcrumb-text">
        <h1>Login</h1>
      </div>
      <br>
      <br>
      <form action="index.html">
        <p class="input-with-label">
          <label for="username">Username</label>
          <input type="text" id="username" name="username" required>
        </p>    
        <br>
        <p class="password-input">
          <label for="password">Password </label>
          <input type="password" id="password" name="password">
          <span class="toggle-password" onclick="togglePasswordVisibility('password')">
            <i class="fas fa-eye"></i>
          </span>
        </p>
        <p style="color: white;">Belum punya akun? <a href="{{ route('Register') }}">Register</a></p>
        <p><input type="submit" value="Login"></p>
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