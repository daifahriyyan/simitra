<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>SIMITRA - Draft Pelayaran</title>

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
          @if (session()->has('error'))
          <div class="row">
            <div class="col d-flex justify-content-center">
              <div class="alert alert-danger alert-dismissible fade show" style="min-height: 50px; width:500px;"
                role="alert">
                <div>
                  {{ session('error') }}
                </div>
                <button type="button" class="close" data-bs-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
            </div>
          </div>
          @endif
          <!-- Your container content -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Draft Pelayaran</h1> <!-- EDIT NAMA -->
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="./">Operasional</a></li>
              <li class="breadcrumb-item active" aria-current="page">Draft Pelayaran</li> <!-- EDIT NAMA -->
            </ol>
          </div>
          <!-- AWAL EDIT SESUAIKAN TABEL DATABASE -->
          <!-- Modal Tambah Data -->
          {{-- <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="addModalLabel">Tambah Data Draft Pelayaran</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <form method="POST" action="{{ route('Tambah Draft Pelayaran') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                      <label for="id_draft" class="form-label">ID Draft:</label>
                      <input type="text" class="form-control" id="id_draft" name="id_draft"
                        value="D00{{ $draftPelayaran->count() + 1 }}" readonly required>
                    </div>
                    <div class="mb-3">
                      <label for="id_order" class="form-label">ID Order:</label>
                      <select class="form-control form-select-lg" name="id_order" id="id_order" required>
                        <option selected>Pilih ID Order</option>
                        @foreach ($dataOrder as $item)
                        <option value="{{ $item->id }}">{{ $item->id_order }}</option>
                        @endforeach
                      </select>
                    </div>
                    <div class="mb-3">
                      <label for="tanggal_order" class="form-label">Tanggal Order:</label>
                      <input type="date" class="form-control" id="tanggal_order" name="tanggal_order" required>
                    </div>
                    <div class="mb-3">
                      <label for="draft_pelayaran" class="form-label">Upload File Draft Pelayaran:</label>
                      <input type="file" class="form-control" id="draft_pelayaran" name="draft_pelayaran" required>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                      <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div> --}}
          @foreach ($draftPelayaran as $record)
          <!-- Modal Edit Data -->
          <div class="modal fade" id="editModal{{ $record->id }}" tabindex="-1" aria-labelledby="editModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="editModalLabel">Edit Data Draft Pelayaran</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <form method="POST" action="{{ route('Ubah Draft Pelayaran', $record->id) }}"
                    enctype="multipart/form-data">
                    @method('put')@csrf
                    <div class="mb-3">
                      <label for="id_draft" class="form-label">ID Draft:</label>
                      <input type="text" class="form-control" id="id_draft" name="id_draft"
                        value="{{ $record->id_draft }}" readonly required>
                    </div>
                    <div class="mb-3">
                      <label for="id_order" class="form-label">ID Order:</label>
                      <select class="form-control form-select-lg" name="id_order" id="id_order" required>
                        <option value="{{ $record->id_order }}">{{ $record->detailOrder->id_detailorder }}</option>
                        @foreach ($dataOrder as $item)
                        <option value="{{ $item->id }}">{{ $item->id_order }}</option>
                        @endforeach
                      </select>
                    </div>
                    <div class="mb-3">
                      <label for="tanggal_order" class="form-label">Tanggal Order:</label>
                      <input type="date" class="form-control" id="tanggal_order" name="tanggal_order"
                        value="{{ $record->tanggal_order }}" required>
                    </div>

                    <div class="mb-3">
                      <label for="draft_pelayaran" class="form-label">Upload File Draft Pelayaran:</label>
                      <input type="file" class="form-control" id="draft_pelayaran" name="draft_pelayaran">
                      <span>{{ $record->draft_pelayaran }}</span>
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
          <!-- Modal Delete -->
          <div class="modal fade" id="deleteRecord{{ $record->id }}" tabindex="-1" aria-labelledby="deleteRecordLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
              <div class="modal-content">
                <form method="POST" action="{{ route('Hapus Draft Pelayaran', $record->id) }}">
                  @method('delete')@csrf
                  <div class="modal-body">
                    Apakah Anda sudah yakin ingin menghapus Data ini?
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
          <!-- AKHIR EDIT SESUAIKAN TABEL DATABASE -->

          <!-- Row -->
          <div class="row">
            <!-- DataTable with Hover -->
            <div class="col-lg-12">
              <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Draft Pelayaran</h6> <!-- EDIT NAMA -->
                  <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                    <!-- Tombol Tambah dengan Icon -->
                    {{-- <div>
                      <button type="button" class="btn btn-sm btn-info" style='width: 70px; height: 30px;'
                        data-bs-toggle="modal" data-bs-target="#addModal">
                        Tambah
                      </button>
                    </div> --}}
                    <!-- Tombol Filter Tanggal dengan Icon -->
                    <div class="input-group">
                      <form action="{{ route('Draft Pelayaran') }}">
                        <input type="date" class="form-control-sm border-1" id="tanggalMulai"
                          value="{{ request()->tanggalMulai }}" name="tanggalMulai"
                          aria-describedby="tanggalMulaiLabel">
                        <input type="date" class="form-control-sm border-1" id="tanggalAkhir"
                          value="{{ request()->tanggalAkhir }}" name="tanggalAkhir"
                          aria-describedby="tanggalAkhirLabel">
                        <button type="subnit" class="btn btn-secondary btn-sm" style="width: 60px; height: 30px;">
                          Filter
                        </button>
                      </form>
                    </div>
                    <!-- Tombol Cetak Tabel dengan Icon -->
                    <div>
                      <a href="{{ route('Draft Pelayaran') }}?export=pdf{{ (request()->tanggalMulai)? '&tanggalMulai='.request()->tanggalMulai : '' }}{{ (request()->tanggalAkhir)? '&tanggalAkhir='.request()->tanggalAkhir : '' }}"
                        class="btn btn-sm btn-warning">
                        Cetak
                      </a>
                    </div>
                  </div>

                  <!-- Skrip JavaScript untuk Filter Tanggal dan Cetak Tabel -->
                  <script>
                    function filterTanggal() {
                        var tanggalMulai = document.getElementById("tanggalMulai").value;
                        var tanggalAkhir = document.getElementById("tanggalAkhir").value;
                        
                        // Lakukan sesuatu dengan tanggalMulai dan tanggalAkhir, misalnya menyaring data tabel
                        // Anda dapat menambahkan logika Anda di sini
                        console.log("Tanggal Mulai:", tanggalMulai);
                        console.log("Tanggal Akhir:", tanggalAkhir);
                    }

                    function cetakTabel() {
                        // Mencetak isi tabel yang sesuai dengan rentang tanggal yang dipilih
                        filterTanggal(); // Memanggil fungsi filterTanggal() untuk mendapatkan rentang tanggal yang dipilih
                        
                        // Lakukan pencetakan sesuai dengan rentang tanggal yang dipilih
                        window.print();
                    }
                  </script>
                </div>

                <div class="table-responsive p-3">
                  <table class="table align-items-center table-flush table-hover" id="dataTableHover">
                    <!-- AWAL EDIT SESUAIKAN TABEL DATABASE -->
                    <thead class="thead-light">
                      <tr>
                        <th>ID Draft</th>
                        <th>ID Order</th>
                        <th>ID Detail Order</th>
                        <th>Tanggal Order </th>
                        <th>Berkas Draft Pelayaran</th>
                        <th>Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($draftPelayaran as $record)
                      <tr>
                        <td>{{ $record->id_draft }}</td>
                        <td>{{ $record->detailOrder->dataOrder->id_order}}</td>
                        <td>{{ $record->detailOrder->id_detailorder }}</td>
                        <td>{{ $record->tanggal_order }}</td>
                        <td>
                          <a href='{{ asset("storage/draft_pelayaran/$record->draft_pelayaran") }}' target='_blank'>{{
                            $record->draft_pelayaran }}</a>
                        </td>
                        <td class="d-flex">
                          <button type='button' class='btn btn-success btn-sm' data-bs-toggle='modal'
                            data-bs-target='#editModal{{ $record->id }}'><i class='fas fa-edit'></i></button>
                          <button type="submit" class='btn btn-danger btn-sm' data-bs-toggle="modal"
                            data-bs-target="#deleteRecord{{ $record->id }}"><i class='fas fa-trash'></i></button>
                        </td>
                      </tr>
                      @endforeach
                    </tbody>
                    <!-- AKHIR EDIT SESUAIKAN TABEL DATABASE -->
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- Footer -->
      <footer>
        <p id="tanggalJam"
          style="font-size: 12px; margin: 0; justify-content: flex-end; display: flex; background-color: #f8f9fa;">
        </p>
      </footer>
      <!-- Footer -->
    </div>
  </div>

  <!-- Scroll to top -->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>
  <script src="https://code.jquery.com/jquery-3.7.1.min.js"
    integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.2/js/bootstrap.bundle.min.js"></script>
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