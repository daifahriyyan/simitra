<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>SIMITRA - Pembelian</title> <!-- EDIT NAMA -->

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
            <h1 class="h3 mb-0 text-gray-800">Pembelian</h1> <!-- EDIT NAMA -->
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="./">Akuntansi</a></li>
              <li class="breadcrumb-item active" aria-current="page">Pembelian</li> <!-- EDIT NAMA -->
            </ol>
          </div>
          <!-- AWAL EDIT SESUAIKAN TABEL DATABASE -->
          <!-- Modal Tambah Data -->
          <!-- Modal Tambah Data Pembelian -->
          <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="addModalLabel">Tambah Data Pembelian</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <form id="purchaseForm" method="POST" action="{{ route('Tambah Pembelian') }}">
                    @csrf
                    <div class="mb-3">
                      <label for="id_pembelian" class="form-label">ID Pembelian:</label>
                      <input type="text" class="form-control" id="id_pembelian" name="id_pembelian"
                        value="P{{ str_pad($id_pembelian, 4, 0, STR_PAD_LEFT) }}" required>
                    </div>
                    <div class="mb-3">
                      <label for="tanggal_beli" class="form-label">Tanggal Pembelian:</label>
                      <input type="date" class="form-control" id="tanggal_beli" name="tanggal_beli" required>
                    </div>
                    <div class="mb-3">
                      <label for="termin_pembayaran" class="form-label">Termin Pembayaran:</label>
                      <input type="text" class="form-control" id="termin_pembayaran" name="termin_pembayaran" required>
                    </div>
                    <div class="mb-3">
                      <label for="id_supplier" class="form-label">ID Supplier:</label>
                      <select class="custom-select form-select-lg mb-3" aria-label="Large select example"
                        id="id_supplier" name="id_supplier">
                        <option selected>Pilih ID Supplier</option>
                        @foreach ($keuSupplier as $item)
                        <option value="{{ $item->id }}">{{ $item->id_supplier }} | {{ $item->nama_supplier }}</option>
                        @endforeach
                      </select>
                    </div>
                    <div class="mb-3">
                      <label for="metode_beli" class="form-label">Metode Pembelian:</label>
                      <select class="form-control form-select-lg" id="metode_beli" name="metode_beli" required>
                        <option value="">Pilih Metode</option>
                        <option value="Tunai">Tunai</option>
                        <option value="Kredit">Kredit</option>
                      </select>
                    </div>
                    <div class="mb-3">
                      <label for="id_persediaan" class="form-label">ID Persediaan:</label>
                      <select class="form-control form-select-lg" name="id_persediaan" id="id_persediaan" required>
                        <option selected>Pilih ID Persediaan</option>
                        @foreach ($dataPersediaan as $item)
                        <option value="{{ $item->id_persediaan }}">{{ $item->id_persediaan }} | {{
                          $item->nama_persediaan }}</option>
                        @endforeach
                      </select>
                    </div>
                    <div class="mb-3">
                      <label for="jumlah_beli" class="form-label">Jumlah Pembelian:</label>
                      <input type="number" class="form-control" id="jumlah_beli" name="jumlah_beli"
                        onchange="hitungTotal()">
                    </div>
                    <div class="mb-3">
                      <label for="harga_beli" class="form-label">Harga Pembelian:</label>
                      <input type="number" class="form-control" id="harga_beli" name="harga_beli"
                        onchange="hitungTotal()">
                    </div>
                    <div class="mb-3">
                      <label for="ppn_masukan" class="form-label">PPN Masukan:</label>
                      <input type="number" class="form-control" id="ppn_masukan" name="ppn_masukan"
                        onchange="hitungTotal()">
                    </div>
                    <div class="mb-3">
                      <label for="total_beli" class="form-label">Total Pembelian:</label>
                      <input type="number" class="form-control" id="total_beli" name="total_beli" readonly>
                    </div>
                    <div class="mb-3">
                      <label for="total_bayar" class="form-label">Total Bayar:</label>
                      <input type="number" class="form-control" id="total_bayar" name="total_bayar" readonly>
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

          <!-- Modal Konfirmasi -->
          <div class="modal fade" id="confirmModal" tabindex="-1" aria-labelledby="confirmModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title danger" id="confirmModalLabel">Konfirmasi Data Pembelian</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" id="confirm_cancel_up"
                    aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <p>Apakah anda yakin data yang anda masukan sudah benar?</p>
                  <table>
                    <tr>
                      <td>ID Pembelian</td>
                      <td style="width: 50px; text-align:center;">:</td>
                      <td><span id="confirm_id_pembelian"></span></td>
                    </tr>
                    <tr>
                      <td>Tanggal Pembelian</td>
                      <td style="width: 50px; text-align:center;">:</td>
                      <td><span id="confirm_tanggal_beli"></span></td>
                    </tr>
                    <tr>
                      <td>Termin Pembayaran</td>
                      <td style="width: 50px; text-align:center;">:</td>
                      <td><span id="confirm_termin_pembayaran"></span></td>
                    </tr>
                    <tr>
                      <td>ID Supplier</td>
                      <td style="width: 50px; text-align:center;">:</td>
                      <td><span id="confirm_id_supplier"></span></td>
                    </tr>
                    <tr>
                      <td>Metode Pembelian</td>
                      <td style="width: 50px; text-align:center;">:</td>
                      <td><span id="confirm_metode_beli"></span></td>
                    </tr>
                    <tr>
                      <td>ID Persediaan</td>
                      <td style="width: 50px; text-align:center;">:</td>
                      <td><span id="confirm_id_persediaan"></span></td>
                    </tr>
                    <tr>
                      <td>Jumlah Pembelian</td>
                      <td style="width: 50px; text-align:center;">:</td>
                      <td><span id="confirm_jumlah_beli"></span></td>
                    </tr>
                    <tr>
                      <td>Harga Pembelian</td>
                      <td style="width: 50px; text-align:center;">:</td>
                      <td><span id="confirm_harga_beli"></span></td>
                    </tr>
                    <tr>
                      <td>PPN Masukan</td>
                      <td style="width: 50px; text-align:center;">:</td>
                      <td><span id="confirm_ppn_masukan"></span></td>
                    </tr>
                    <tr>
                      <td>Total Pembelian</td>
                      <td style="width: 50px; text-align:center;">:</td>
                      <td><span id="confirm_total_beli"></span></td>
                    </tr>
                    <tr>
                      <td>Total Bayar</td>
                      <td style="width: 50px; text-align:center;">:</td>
                      <td><span id="confirm_total_bayar"></span></td>
                    </tr>
                  </table>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"
                    id="confirm_cancel">Batal</button>
                  <button type="button" class="btn btn-primary" id="confirm_save">Yakin</button>
                </div>
              </div>
            </div>
          </div>


          <!-- Modal Konfirmasi Logout -->
          <div class="modal fade" id="logoutModal" tabindex="-1" aria-labelledby="logoutModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="logoutModalLabel">Konfirmasi Logout</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                  </button>
                </div>
                <div class="modal-body">
                  Apakah Anda Yakin Ingin Keluar dari Sistem?
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                  <a href="login.html" class="btn btn-primary">Logout</a>
                </div>
              </div>
            </div>
          </div>
          <!-- AKHIR EDIT SESUAIKAN TABEL DATABASE -->

          <!-- Row -->
          <div class="row">
            <!-- DataTable with Hover -->
            <div class="col-lg-12">
              <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Pembelian</h6> <!-- EDIT NAMA -->
                  <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                    <!-- Tombol Tambah dengan Icon -->
                    <div>
                      <button type="button" class="btn btn-sm btn-info" style='width: 70px; height: 30px;'
                        data-bs-toggle="modal" data-bs-target="#addModal">
                        Tambah
                      </button>
                    </div>
                    <!-- Tombol Filter Id Supplier dan Tanggal dengan Icon -->
                    <div class="input-group">
                      <label for="id_supplier" class="mb-0 mr-2">Id Supplier:</label>
                      <select class="form-control-sm border-1" style="width: 100px; height: 30px;" id="id_supplier"
                        onchange="filterData()">
                        <option selected>Supplier</option>
                        @foreach ($keuSupplier as $item)
                        <option value="{{ $item->id }}" {{ request('id_supplier')==$item->id ? 'selected' : '' }}>
                          {{ $item->id }} | {{ $item->nama_supplier }}
                        </option>
                        @endforeach
                      </select>
                      <input type="date" class="form-control-sm border-1" id="tanggalMulai"
                        aria-describedby="tanggalMulaiLabel" value="{{ request('tanggalMulai') }}">
                      <input type="date" class="form-control-sm border-1" id="tanggalAkhir"
                        aria-describedby="tanggalAkhirLabel" value="{{ request('tanggalAkhir') }}">
                      <button type="button" class="btn btn-secondary btn-sm" style="width: 60px; height: 30px;"
                        onclick="filterData()">
                        Filter
                      </button>
                    </div>
                    <!-- Tombol Cetak Tabel dengan Icon -->
                    <div>
                      <button type="button" class="btn btn-sm btn-warning" style='width: 60px; height: 30px;'
                        onclick="cetakTabel()">
                        Cetak
                      </button>
                    </div>
                  </div>
                </div>

                <div class="table-responsive p-3">
                  <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                      <tr>
                        <th>ID Pembelian</th>
                        <th>Tanggal Pembelian</th>
                        <th>Termin Pembayaran</th>
                        <th>ID Supplier</th>
                        <th>Metode Pembelian</th>
                        <th>ID Persediaan</th>
                        <th>Jumlah Pembelian</th>
                        <th>Harga Pembelian</th>
                        <th>PPN Masukan</th>
                        <th>Total Pembelian</th>
                        <th>Total Bayar</th>
                        {{-- <th>Aksi</th> --}}
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($dataPembelian as $item)
                      <tr>
                        <td>{{ $item->id_pembelian }}</td>
                        <td>{{ $item->tanggal_beli }}</td>
                        <td>{{ $item->termin_pembayaran }}</td>
                        <td>{{ $item->id_supplier }}</td>
                        <td>{{ $item->metode_beli }}</td>
                        <td>{{ $item->id_persediaan }}</td>
                        <td>{{ $item->jumlah_beli }}</td>
                        <td>{{ $item->harga_beli }}</td>
                        <td>{{ $item->ppn_masukan }}</td>
                        <td>{{ $item->total_beli }}</td>
                        <td>{{ $item->total_bayar }}</td>
                        {{-- <td>
                          <button type='button' class='btn btn-success btn-sm' data-bs-toggle='modal'
                            data-bs-target='#editModal{{ $item->id }}'><i class='fas fa-edit'></i></button>
                          <button type="submit" class='btn btn-danger btn-sm' data-bs-toggle="modal"
                            data-bs-target="#deleteRecord{{ $item->id }}"><i class='fas fa-trash'></i></button>
                        </td> --}}
                      </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Edit Modal -->
      @foreach ($keuPembelian as $pembelian)
      <div class="modal fade" id="editModal{{ $pembelian->id }}" tabindex="-1" aria-labelledby="editModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="editModalLabel">Edit Data Supplier</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <form action="{{ route('Ubah Pembelian', $pembelian->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-3">
                  <label for="tanggal_beli" class="form-label">Tanggal Pembelian</label>
                  <input type="date" class="form-control" id="tanggal_beli" name="tanggal_beli"
                    value="{{ $pembelian->tanggal_beli }}">
                </div>
                <div class="mb-3">
                  <label for="termin_pembayaran" class="form-label">Termin Pembayaran</label>
                  <input type="text" class="form-control" id="termin_pembayaran" name="termin_pembayaran"
                    value="{{ $pembelian->termin_pembayaran }}">
                </div>
                <div class="mb-3">
                  <label for="id_supplier" class="form-label">ID Supplier:</label>
                  <select class="custom-select form-select-lg mb-3" aria-label="Large select example" id="id_supplier"
                    name="id_supplier">
                    <option value="">Pilih ID Supplier</option>
                    @foreach ($keuSupplier as $item)
                    <option value="{{ $item->id }}" {{ $pembelian->id_supplier == $item->id ? 'selected' : '' }}>
                      {{ $item->id_supplier }} | {{ $item->nama_supplier }}
                    </option>
                    @endforeach
                  </select>
                </div>
                <div class="mb-3">
                  <label for="metode_beli" class="form-label">Metode Beli</label>
                  <select class="custom-select form-select-lg mb-3" id="metode_beli" name="metode_beli">
                    <option value="Tunai" {{ $pembelian->metode_beli == 'Tunai' ? 'selected' : '' }}>Tunai</option>
                    <option value="Kredit" {{ $pembelian->metode_beli == 'Kredit' ? 'selected' : '' }}>Kredit</option>
                    <option value="Transfer Bank" {{ $pembelian->metode_beli == 'Transfer Bank' ? 'selected' : ''
                      }}>Transfer Bank</option>
                  </select>
                </div>
                <div class="mb-3">
                  <label for="id_persediaan" class="form-label">ID Persediaan</label>
                  <select class="custom-select form-select-lg mb-3" id="id_persediaan" name="id_persediaan">
                    @foreach ($dataPersediaan as $persediaan)
                    <option value="{{ $persediaan->id }}" {{ $pembelian->id_persediaan == $persediaan->id ? 'selected' :
                      '' }}>
                      {{ $persediaan->id }} | {{ $persediaan->nama_persediaan }}
                    </option>
                    @endforeach
                  </select>
                </div>
                <div class="mb-3">
                  <label for="jumlah_beli" class="form-label">Jumlah Beli</label>
                  <input type="number" class="form-control" id="jumlah_beli" name="jumlah_beli"
                    value="{{ $pembelian->jumlah_beli }}">
                </div>
                <div class="mb-3">
                  <label for="harga_beli" class="form-label">Harga Beli</label>
                  <input type="number" class="form-control" id="harga_beli" name="harga_beli"
                    value="{{ $pembelian->harga_beli }}">
                </div>
                <div class="mb-3">
                  <label for="ppn_masukan" class="form-label">PPN Masukan</label>
                  <input type="number" class="form-control" id="ppn_masukan" name="ppn_masukan"
                    value="{{ $pembelian->ppn_masukan }}">
                </div>
                <div class="mb-3">
                  <label for="total_beli" class="form-label">Total Beli</label>
                  <input type="number" class="form-control" id="total_beli" name="total_beli"
                    value="{{ $pembelian->total_beli }}" readonly>
                </div>
                <div class="mb-3">
                  <label for="total_bayar" class="form-label">Total Bayar</label>
                  <input type="number" class="form-control" id="total_bayar" name="total_bayar"
                    value="{{ $pembelian->total_bayar }}" readonly>
                </div>
                <div class="mb-3">
                  <small class="text-danger">*Pastikan Data yang dimasukkan sudah benar!</small>
                </div>
                <button type="submit" class="btn btn-primary">Simpan</button>
              </form>
            </div>
          </div>
        </div>
      </div>
      <!-- Modal Delete -->
      <div class="modal fade" id="deleteRecord{{ $pembelian->id }}" tabindex="-1" aria-labelledby="deleteRecordLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <form method="POST" action="{{ route('Hapus Pembelian', $pembelian->id) }}">
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
      <!-- Footer -->
      <footer>
        <p id="tanggalJam"
          style="font-size: 12px; margin: 0; justify-content: flex-end; display: flex; background-color: #f8f9fa;"></p>
      </footer>
      <!-- Footer -->
    </div>

    <!-- Scroll to top -->
    <a class="scroll-to-top rounded" href="#page-top">
      <i class="fas fa-angle-up"></i>
    </a>


    <!-- AWAL EDIT SESUAIKAN TABEL DATABASE -->
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

      document.addEventListener('DOMContentLoaded', function () {
        const form = document.getElementById('purchaseForm');
        const confirmModal = new bootstrap.Modal(document.getElementById('confirmModal'));
        const confirmSaveButton = document.getElementById('confirm_save');
        const confirmCancelButton = document.getElementById('confirm_cancel'); // Tambahkan ini

        form.addEventListener('submit', function (event) {
            event.preventDefault();

            document.getElementById('confirm_id_pembelian').textContent = document.getElementById('id_pembelian').value;
            document.getElementById('confirm_tanggal_beli').textContent = document.getElementById('tanggal_beli').value;
            document.getElementById('confirm_termin_pembayaran').textContent = document.getElementById('termin_pembayaran').value;
            document.getElementById('confirm_id_supplier').textContent = document.getElementById('id_supplier').options[document.getElementById('id_supplier').selectedIndex].text;
            document.getElementById('confirm_metode_beli').textContent = document.getElementById('metode_beli').value;
            document.getElementById('confirm_id_persediaan').textContent = document.getElementById('id_persediaan').options[document.getElementById('id_persediaan').selectedIndex].text;
            document.getElementById('confirm_jumlah_beli').textContent = document.getElementById('jumlah_beli').value;
            document.getElementById('confirm_harga_beli').textContent = document.getElementById('harga_beli').value;
            document.getElementById('confirm_ppn_masukan').textContent = document.getElementById('ppn_masukan').value;
            document.getElementById('confirm_total_beli').textContent = document.getElementById('total_beli').value;
            document.getElementById('confirm_total_bayar').textContent = document.getElementById('total_bayar').value;

            confirmModal.show();
        });

        confirmSaveButton.addEventListener('click', function () {
            form.submit();
        });

        // Tambahkan ini
        confirmCancelButton.addEventListener('click', function () {
            confirmModal.hide(); // Menutup modal konfirmasi saat tombol "Batal" ditekan
        });
        confirmCancelUpButton.addEventListener('click', function () {
            confirmModal.hide(); // Menutup modal konfirmasi saat tombol "Batal" ditekan
        });
      });


      function hitungTotal() {
          const jumlahBeli = parseFloat(document.getElementById('jumlah_beli').value) || 0;
          const hargaBeli = parseFloat(document.getElementById('harga_beli').value) || 0;
          const ppnMasukan = parseFloat(document.getElementById('ppn_masukan').value) || 0;

          const totalBeli = jumlahBeli * hargaBeli;
          const totalBayar = totalBeli + ppnMasukan;

          document.getElementById('total_beli').value = totalBeli;
          document.getElementById('total_bayar').value = totalBayar;
      }
      function openEditModal(idBeli, tanggalBeli, idSupplier, terminPembayaran, namaSupplier, metodeBeli, idPersediaan, namaPersediaan, jumlahBeli, hargaBeli, totalBeli, ppnMasukan, totalBayar) {
        document.getElementById("edit_id_pembelian").value = idBeli;
        document.getElementById("edit_tanggal_beli").value = tanggalBeli;
        document.getElementById("edit_termin_pembayaran").value = terminPembayaran;
        document.getElementById("edit_id_supplier").value = idSupplier;
        document.getElementById("edit_nama_supplier").value = namaSupplier;
        document.getElementById("edit_metode_beli").value = metodeBeli;
        document.getElementById("edit_id_persediaan").value = idPersediaan;
        document.getElementById("edit_nama_persediaan").value = namaPersediaan;
        document.getElementById("edit_jumlah_beli").value = jumlahBeli;
        document.getElementById("edit_harga_beli").value = hargaBeli;
        document.getElementById("edit_total_beli").value = totalBeli;
        document.getElementById("edit_ppn_masukan").value = ppnMasukan;
        document.getElementById("edit_total_bayar").value = totalBayar;
      }

    function filterData() {
    var idSupplier = document.getElementById('id_supplier').value;
    var tanggalMulai = document.getElementById('tanggalMulai').value;
    var tanggalAkhir = document.getElementById('tanggalAkhir').value;

    var url = new URL(window.location.href);
    if (idSupplier !== 'Supplier') {
        url.searchParams.set('id_supplier', idSupplier);
    } 

    if (tanggalMulai) {
        url.searchParams.set('tanggalMulai', tanggalMulai);
    } 

    if (tanggalAkhir) {
        url.searchParams.set('tanggalAkhir', tanggalAkhir);
    } 

    window.location.href = url.toString();  
    }

    $(document).ready(function () {
      $('#dataTableHover').DataTable();
    });
    </script>
    <!-- AKHIR EDIT SESUAIKAN TABEL DATABASE -->

    <script src=" https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.2/js/bootstrap.bundle.min.js">
    </script>
    <script src="//cdn.datatables.net/2.0.3/js/dataTables.min.js"></script>
    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js')}}"></script>
    <script src="{{ asset('js/simitra.min.js') }}"></script>
    <script src="{{ asset('vendor/chart.js/Chart.min.js') }}"></script>
    <script src="{{ asset('js/demo/chart-area-demo.js') }}"></script>
    <!-- Page level plugins -->
    <script src="{{ asset('vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
</body>

</html>