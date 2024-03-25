<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title> | SIMITRA</title>

  <link href="img/logo/logo.png" rel="icon">
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
  <link href="css/simitra.min.css" rel="stylesheet">
  <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
</head>

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
        @yield('container-fluid')
        <!---Container Fluid-->
        <footer>
          <p id="tanggalJam"
            style="font-size: 12px; margin: 0; justify-content: flex-end; display: flex; background-color: #f8f9fa;">
          </p>
        </footer>


      </div>
    </div>
  </div>

  <!-- Scroll to top -->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.2/js/bootstrap.bundle.min.js"></script>
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
  <script src="js/simitra.min.js"></script>
  <script src="vendor/chart.js/Chart.min.js"></script>
  <script src="js/demo/chart-area-demo.js"></script>
  <!-- Page level plugins -->
  <script src="vendor/datatables/jquery.dataTables.min.js"></script>
  <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

  <!-- Script Tanggal -->
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
  </script>
  <!-- Script Tanggal -->
</body>

</html>