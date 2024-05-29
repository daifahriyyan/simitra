<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <link href="{{ asset('img/logo/logo.png') }}" rel="icon">
  <title>SIMITRA - Profile</title>
  <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
  <link href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css">
  <link href="{{ asset('css/simitra.min.css') }}" rel="stylesheet">
</head>
<style>
  .upload-file-container {
    border: 1px solid #ccc;
    display: flex;
    align-items: center;
    border-radius: 5px;
    padding: 5px 5px;
    max-width: 300px;
    /* Lebar maksimum */
    min-width: 150px;
    /* Lebar minimum */
    overflow: hidden;
  }

  .custom-file-upload {
    background-color: #666;
    color: #fff;
    padding: 4px 6px;
    border-radius: 5px;
    cursor: pointer;
  }

  #file-chosen {
    margin-left: 10px;
    color: #666;
  }
</style>

<body id="page-top">
  <div id="wrapper">

    <!-- Sidebar -->
    @include('partials.sidebar')
    <!-- Sidebar -->

    <div id="content-wrapper" class="d-flex flex-column">
      <div id="content">

        <!-- TopBar -->
        @include('partials.topbar')
        <!-- Topbar -->

        <!-- Container Fluid-->
        <div class="container-fluid" id="container-wrapper">
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Profile</h1>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="./">Home</a></li>
              <li class="breadcrumb-item active" aria-current="page">Profile</li>
            </ol>
          </div>
          <div class="row mb-3">
            <div class="col-md-6">
              <div class="edit-profile">
                <div class="edit-profile-image">
                  <label for="image" class="profile-image-label">
                    <img class="img-profile rounded-circle" id="profile-image-preview"
                      src="{{ asset((Auth::user()->foto != null)? Auth::user()->foto : 'img/girl.png') }}"
                      style="max-width: 300px">
                    <input type="file" id="image" name="foto" value="{{ Auth::user()->image }}" style="display: none;"
                      onchange="previewImage()" form="profile">
                  </label>
                </div>
                <div class="upload-file-container">
                  <label for="image" class="custom-file-upload">
                    Choose File
                  </label>
                  <span id="file-chosen">No file chosen</span>
                </div>
              </div>
            </div>
            <div class="col-md-5">
              <div class="edit-profile-details">
                <form action="{{ route('Update Profile Pegawai') }}" method="post" id="profile"
                  enctype="multipart/form-data">
                  @csrf
                  <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" class="form-control" id="username" name="username"
                      value="{{ Auth::user()->username }}">
                  </div>
                  <div class="form-group">
                    <label for="nama_lengkap">Nama Lengkap</label>
                    <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap"
                      value="{{ Auth::user()->nama_lengkap }}">
                  </div>
                  <div class="form-group">
                    <label for="posisi">Posisi</label>
                    <input type="text" class="form-control" id="posisi" name="posisi"
                      value="{{ Auth::user()->posisi }}">
                  </div>
                  <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp"
                      value="{{ Auth::user()->email }}">
                  </div>
                  <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" id="password" name="password"
                      value="{{ Auth::user()->pass }}">
                  </div>
                  <div class="form-group">
                    <label for="reenter_password">Reenter Password</label>
                    <input type="password" class="form-control" id="reenter_password" name="reenter_password"
                      value="{{ Auth::user()->pass }}">
                  </div>
                  <!-- Tombol Save -->
                  <button type="submit" class="btn btn-primary">Save</button>
                  <!-- Tombol Batal -->
                  <button type="reset" class="btn btn-secondary">Cancel</button>
                </form>
              </div>
            </div>
          </div>



          <!-- Modal Logout -->
          <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabelLogout"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabelLogout">LOGOUT - SIMITRA</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <p>Yakin ingin logout dari sistem?</p>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Cancel</button>
                  <form action="{{ route('Logout') }}" method="post">
                    @csrf
                    <button type="submit" class="btn btn-primary"><a>Logout</a></button>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!---Container Fluid-->
      </div>
    </div>
  </div>

  <!-- Scroll to top -->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
  <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js') }}"></script>
  <script src="{{ asset('js/simitra.min.js') }}"></script>
  <script src="{{ asset('vendor/chart.js/Chart.min.js') }}"></script>
  <script src="{{ asset('js/demo/chart-area-demo.js') }}"></script>

  <!-- Footer -->
  <footer>
    <p id="tanggalJam"
      style="font-size: 12px; margin: 0; justify-content: flex-end; display: flex; background-color: #f8f9fa;"></p>
  </footer>

  <script>
    function updateTanggalJam() {
        var date = new Date();
        var options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric', hour: '2-digit', minute: '2-digit', second: '2-digit' };
        var formattedDate = date.toLocaleDateString('id-ID', options);
        document.getElementById('tanggalJam').textContent = formattedDate;
      }
  
      // Memanggil fungsi untuk pertama kali saat halaman dimuat
      updateTanggalJam();
  
      // Memperbarui tanggal dan jam setiap detik
      setInterval(updateTanggalJam, 1000);

      function previewImage() {
      var fileInput = document.getElementById('image');
      var fileChosen = document.getElementById('file-chosen');
      var imagePreview = document.getElementById('profile-image-preview');

      if (fileInput.files.length > 0) {
          var reader = new FileReader();
          reader.onload = function(e) {
              imagePreview.src = e.target.result;
          };
          reader.readAsDataURL(fileInput.files[0]);

          fileChosen.textContent = fileInput.files[0].name;
      } else {
          fileChosen.textContent = 'No file chosen';
          imagePreview.src = 'img/girl.png'; // Set default image jika tidak ada file yang dipilih
      }
  }

  </script>
  <!-- Footer -->
</body>

</html>