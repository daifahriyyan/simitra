@extends('layouts.customer')

@section('section')
<section class="register-banner">
  <div class="form-container-register">
    <div class="form-container-register-form">
      <div class="breadcrumb-text">
        <h1>Register</h1>
      </div>
      <br>
      <form action="{{ route('Update Profile') }}" method="POST">
        @csrf
        <p class="input-with-label">
          <label for="username">Username</label>
          <input type="text" id="username" name="username" value="{{ Auth::user()->username }}">
        </p>
        <p class="input-with-label">
          <label for="nama_customer">Nama Perusahaan</label>
          <input type="text" id="nama_customer" name="nama_customer"
            value="{{ Auth::user()->dataCustomer->nama_customer }}">
        </p>
        <p class="input-with-label">
          <label for="alamat_customer">Alamat Perusahaan</label>
          <input type="text" id="alamat_customer" name="alamat_customer"
            value="{{ Auth::user()->dataCustomer->alamat_customer }}">
        </p>
        <p class="input-with-label">
          <label for="telepon_customer">Telepon Perusahaan</label>
          <input type="tel" id="telepon_customer" name="telepon_customer"
            value="{{ Auth::user()->dataCustomer->telepon_customer }}">
        </p>
        <p class="input-with-label">
          <label for="email_customer">Email</label>
          <input type="text" id="email_customer" name="email_customer"
            value="{{ Auth::user()->dataCustomer->email_customer }}">
        </p>
        <p class="input-with-label">
          <label for="pic">Nama PIC</label>
          <input type="text" id="pic" name="pic" value="{{ Auth::user()->dataCustomer->pic }}">
        </p>
        <p class="input-with-label">
          <label for="phone_pic">No. Telp (PIC)</label>
          <input type="tel" id="phone_pic" name="phone_pic" value="{{ Auth::user()->dataCustomer->phone_pic }}">
        </p>
        <br>
        <p><input type="submit" value="Simpan"></p>
      </form>
    </div>
  </div>
</section>
@endsection