@extends('layouts.customer')

@section('section')
<!-- breadcrumb-section -->
<div class="breadcrumb-section breadcrumb-bg">
  <div class="container">
    <div class="row">
      <div class="col-lg-8 offset-lg-2 text-center">
        <div class="breadcrumb-text">
          <h1>Contact us</h1>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- end breadcrumb section -->

<!-- google map section -->
<div class="embed-responsive embed-responsive-21by9">
  <iframe
    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3966.756148486439!2d110.47625199379732!3d-7.039123125469981!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e7a588c28957c5d%3A0x73f3087d6e66f066!2sHollywood%2C%20Yogyakarta%2C%20Special%20Region%20of%20Yogyakarta%2C%20Indonesia!5e0!3m2!1sen!2sbd!4v1576846473265!5m2!1sen!2sbd"
    width="600" height="450" frameborder="0" style="border:0;" allowfullscreen=""
    class="embed-responsive-item"></iframe>
</div>
<!-- end google map section -->

<div class="wa-popup" id="wa-popup">
  <img src="assets/img/whatsapp_logo.png" alt="">
  <span class="close-btn" id="close-btn">&times;</span>
</div>
<a href="https://wa.me/6282137253446" class="open-btn" id="open-btn">
  <img src="assets/img/whatsapp_logo.png" alt="">
</a>

@endsection