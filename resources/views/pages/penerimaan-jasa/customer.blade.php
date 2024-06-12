<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>SIMITRA - Customer</title>

  <link rel="stylesheet" href="//cdn.datatables.net/2.0.3/css/dataTables.dataTables.min.css">
  <link href="{{ asset('img/logo/logo.png') }}" rel="icon">
  <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
  <link href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css">
  <link href="{{ asset('css/simitra.min.css') }}" rel="stylesheet">
  <link href="{{ asset('vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
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
        <div class="container-fluid" id="container-wrapper">
          <!-- Your container content -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Customer</h1> <!-- EDIT NAMA -->
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="./">Penerimaan Jasa</a></li>
              <li class="breadcrumb-item active" aria-current="page">Customer</li> <!-- EDIT NAMA -->
            </ol>
          </div>
          <!-- AWAL EDIT SESUAIKAN TABEL DATABASE -->
          <!-- Modal Tambah Data -->
          <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="addModalLabel">Tambah Data Customer</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">x</button>
                </div>
                <div class="modal-body">
                  <form method="POST" action="{{ route('Tambah Data Customer') }}">
                    @csrf
                    <div class="mb-3">
                      <label for="id_customer" class="form-label">ID Customer:</label>
                      <input type="text" class="form-control" id="id_customer" name="id_customer" required>
                      @error('id_customer')
                      <span class="text-danger">{{ $message }}</span>
                      @enderror
                    </div>
                    <div class="mb-3">
                      <label for="nama_customer" class="form-label">Nama Customer:</label>
                      <input type="text" class="form-control" id="nama_customer" name="nama_customer" required>
                      @error('nama_customer')
                      <span class="text-danger">{{ $message }}</span>
                      @enderror
                    </div>
                    <div class="mb-3">
                      <label for="alamat_customer" class="form-label">Alamat Customer:</label>
                      <input type="text" class="form-control" id="alamat_customer" name="alamat_customer" required>
                      @error('alamat_customer')
                      <span class="text-danger">{{ $message }}</span>
                      @enderror
                    </div>
                    <div class="mb-3">
                      <label for="telp_customer" class="form-label">Telepon Customer:</label>
                      <input type="number" class="form-control" id="telp_customer" name="telp_customer" required>
                      @error('telp_customer')
                      <span class="text-danger">{{ $message }}</span>
                      @enderror
                    </div>
                    <div class="mb-3">
                      <label for="email_customer" class="form-label">Email Customer:</label>
                      <input type="email" class="form-control" id="email_customer" name="email_customer" required>
                      @error('email_customer')
                      <span class="text-danger">{{ $message }}</span>
                      @enderror
                    </div>
                    <div class="mb-3">
                      <label for="pic" class="form-label">PIC:</label>
                      <input type="text" class="form-control" id="pic" name="pic" required>
                      @error('pic')
                      <span class="text-danger">{{ $message }}</span>
                      @enderror
                    </div>
                    <div class="mb-3">
                      <label for="phone_pic" class="form-label">Telepon PIC:</label>
                      <input type="number" class="form-control" id="phone_pic" name="phone_pic" required>
                      @error('phone_pic')
                      <span class="text-danger">{{ $message }}</span>
                      @enderror
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                      <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
          @foreach ($records as $record)
          <!-- Modal Edit Data -->
          <div class="modal fade" id="editModal{{ $record->id }}" tabindex="-1" aria-labelledby="editModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="editModalLabel">Edit Data Customer</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <form method="POST" action="{{ route('Ubah Data Customer', $record->id_customer) }}">
                    @method('put')
                    @csrf
                    <div class="mb-3">
                      <label for="id_customer" class="form-label">ID Customer:</label>
                      <input type="text" class="form-control" id="id_customer" value="{{ $record->id_customer }}"
                        name="id_customer" readonly required>
                    </div>
                    <div class="mb-3">
                      <label for="nama_customer" class="form-label">Nama Customer:</label>
                      <input type="text" class="form-control" id="nama_customer" value="{{ $record->nama_customer }}"
                        name="nama_customer" required>
                    </div>
                    <div class="mb-3">
                      <label for="alamat_customer" class="form-label">Alamat Customer:</label>
                      <input type="text" class="form-control" id="alamat_customer"
                        value="{{ $record->alamat_customer }}" name="alamat_customer" required>
                    </div>
                    <div class="mb-3">
                      <label for="telp_customer" class="form-label">Telepon Customer:</label>
                      <input type="number" class="form-control" id="telp_customer"
                        value="{{ $record->telepon_customer }}" name="telp_customer" required>
                    </div>
                    <div class="mb-3">
                      <label for="email_customer" class="form-label">Email Customer:</label>
                      <input type="email" class="form-control" id="email_customer" value="{{ $record->email_customer }}"
                        name="email_customer" required>
                    </div>
                    <div class="mb-3">
                      <label for="pic" class="form-label">PIC:</label>
                      <input type="text" class="form-control" id="pic" value="{{ $record->pic }}" name="pic" required>
                    </div>
                    <div class="mb-3">
                      <label for="phone_pic" class="form-label">Telepon PIC:</label>
                      <input type="number" class="form-control" id="phone_pic" value="{{ $record->phone_pic }}"
                        name="phone_pic" required>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                      <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
          <!-- AKHIR EDIT SESUAIKAN TABEL DATABASE -->

          <!-- Modal Delete -->
          <div class="modal fade" id="deleteRecord{{ $record->id }}" tabindex="-1" aria-labelledby="deleteRecordLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
              <div class="modal-content">
                <form method="POST" action="{{ route('Hapus Data Customer', $record->id_customer) }}">
                  @method('delete')@csrf
                  <div class="modal-body">
                    Apakah Anda sudah yakin ingin menghapus Record ini?
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-danger">Delete</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
          @endforeach

          <!-- Row -->
          <div class="row">
            <!-- DataTable with Hover -->
            <div class="col-lg-12">
              <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Customer</h6> <!-- EDIT NAMA -->
                  <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                    <!-- Tombol Tambah dengan Icon -->
                    {{-- <button type="button" class="btn btn-sm btn-info" data-bs-toggle="modal"
                      data-bs-target="#addModal">
                      Tambah
                    </button> --}}
                    <!-- Tombol Cetak Tabel dengan Icon -->
                    <a href="{{ route('Data Customer') }}?export=pdf" class="btn btn-sm btn-warning">
                      Cetak
                    </a>
                  </div>

                  <!-- Skrip JavaScript untuk Cetak Tabel -->
                  <script>
                    function cetakTabel() {
				  // Mencetak isi tabel yang sesuai dengan rentang tanggal yang dipilih
				  filterTanggal(); // Memanggil fungsi filterTanggal() untuk mendapatkan rentang tanggal yang dipilih
				  
				  // Lakukan pencetakan sesuai dengan rentang tanggal yang dipilih
				  window.print();
			  }
                  </script>
                </div>

                <div class="table-responsive p-3">
                  <table class="table align-items-center table-flush table-hover text-nowrap" id="dataTableHover">
                    <!-- AWAL EDIT SESUAIKAN TABEL DATABASE -->
                    <thead class="thead-light">
                      <tr>
                        <th>Id Customer</th>
                        <th>Nama Customer</th>
                        <th>Alamat Customer</th>
                        <th>Telp Customer</th>
                        <th>Email Customer</th>
                        <th>Nama PIC</th>
                        <th>Telp PIC</th>
                        {{-- <th>Aksi</th> --}}
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($records as $record)
                      <tr>
                        <td>{{ $record->id_customer }}</td>
                        <td>{{ $record->nama_customer }}</td>
                        <td>{{ $record->alamat_customer }}</td>
                        <td>{{ $record->telepon_customer }}</td>
                        <td>{{ $record->email_customer }}</td>
                        <td>{{ $record->pic }}</td>
                        <td>{{ $record->phone_pic }}</td>
                        {{-- <td>
                          <button type='button' class='btn btn-success btn-sm' data-bs-toggle='modal'
                            data-bs-target='#editModal{{ $record->id }}'><i class='fas fa-edit'></i></button>
                          <button type="submit" class='btn btn-danger btn-sm' data-bs-toggle="modal"
                            data-bs-target="#deleteRecord{{ $record->id }}"><i class='fas fa-trash'></i></button>
                          <a href="" class='btn btn-primary btn-sm' target='_blank' role='button'><i
                              class='fas fa-print'></i></a>
                        </td> --}}
                      </tr>
                      @endforeach
                    </tbody>
                    <!-- AKHIR EDIT SESUAIKAN TABEL DATABASE -->
                  </table>
                </div>
              </div>
            </div>
          </div>
          <!-- Scroll to top -->
          <a class="scroll-to-top rounded" href="#page-top">
            <i class="fas fa-angle-up"></i>
          </a>
          <script src="https://code.jquery.com/jquery-3.7.1.min.js"
            integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
          <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
          <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.2/js/bootstrap.bundle.min.js">
          </script>
          <script src="//cdn.datatables.net/2.0.3/js/dataTables.min.js"></script>
          <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
          <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
          <script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js')}}"></script>
          <script src="{{ asset('js/simitra.min.js') }}"></script>
          <!-- Page level plugins -->
          <script src="{{ asset('vendor/datatables/jquery.dataTables.min.js') }}"></script>
          <script src="{{ asset('vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>

          <!-- Page level custom scripts -->
          <script>
            $(document).ready(function () {
  $('#dataTableHover').DataTable();
  });

  // Function to display selected file name
  function displayFileName(input, targetId) {
  var fileName = input.files[0].name;
  document.getElementById(targetId).innerHTML = fileName;
  }

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
</body>

</html>