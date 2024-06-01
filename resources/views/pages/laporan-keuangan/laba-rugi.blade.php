<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>SIMITRA - Laporan Laba Rugi</title> <!-- EDIT NAMA -->

  <link href="{{ asset('img/logo/logo.png')}}" rel="icon">
  <link href="{{ asset('vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
  <link href="{{ asset('vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css">
  <link href="{{ asset('css/simitra.min.css')}}" rel="stylesheet">
  <link href="{{ asset('css/simitra.css')}}" rel="stylesheet">
  <link href="{{ asset('vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
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
            <h1 class="h3 mb-0 text-gray-800">Laporan Laba Rugi</h1> <!-- EDIT NAMA -->
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="./">Laporan Keuangan</a></li>
              <li class="breadcrumb-item active" aria-current="page">Laporan Laba Rugi</li>
              <!-- EDIT NAMA -->
            </ol>
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
                  <h6 class="m-0 font-weight-bold text-primary">Laporan Laba Rugi</h6>
                  <div class="btn-group ml-auto" role="group" aria-label="Basic mixed styles example">
                    <!-- Tombol Posting  -->
                    <div>
                      <form action="{{ route('Posting Laba Rugi') }}" method="POST" id="posting">
                        @csrf
                        <input type="hidden" name="bulan" value="{{ request()->bulan }}">
                        <input type="hidden" name="tahun" value="{{ request()->tahun }}">
                        <button type="submit" class="btn btn-sm btn-primary" style='width: 70px; height: 30px;'>
                          Posting
                        </button>
                      </form>
                    </div>
                    <!-- Tombol Filter Pilih BUlan dan Tahun dengan Icon -->
                    <div class="input-group">
                      <form action="{{ route('Laporan Laba Rugi') }}">
                        <label for="bulan" class="mb-0 mr-2">Bulan:</label>
                        <select class="form-control-sm border-1" style="width: 120px; height: 30px;" id="bulan"
                          name="bulan" onchange="filterData()">
                          <option value="">Pilih Bulan</option>
                          <option value="1">Januari</option>
                          <option value="2">Februari</option>
                          <option value="3">Maret</option>
                          <option value="4">April</option>
                          <option value="5">Mei</option>
                          <option value="6">Juni</option>
                          <option value="7">Juli</option>
                          <option value="8">Agustus</option>
                          <option value="9">September</option>
                          <option value="10">Oktober</option>
                          <option value="11">November</option>
                          <option value="12">Desember</option>
                        </select>
                        <label for="tahun" class="mb-0 mr-2 ml-2">Tahun:</label>
                        <select class="form-control-sm border-1" style="width: 120px; height: 30px;" id="tahun"
                          name="tahun" onchange="filterData()">
                          <option value="">Pilih Tahun</option>
                          <option value="2021">2021</option>
                          <option value="2022">2022</option>
                          <option value="2023">2023</option>
                          <option value="2024">2024</option>
                          <option value="2025">2025</option>
                        </select>
                        <button type="submit" class="btn btn-secondary btn-sm" style="width: 60px; height: 30px;">
                          Filter
                        </button>
                      </form>
                    </div>
                    <!-- Tombol Cetak Tabel dengan Icon -->
                    <div>
                      <a href="{{ route('Laporan Laba Rugi') }}?export=pdf{{ (request()->bulan)? '&bulan='.request()->bulan : '' }}{{ (request()->tahun)? '&tahun='.request()->tahun : '' }}"
                        class="btn btn-sm btn-warning" style='width: 60px; height: 30px;'>
                        Cetak
                      </a>
                    </div>
                  </div>

                  <!-- Skrip JavaScript untuk Filter Tanggal dan Cetak Tabel -->
                  <script>
                    function filterData() {
                      var namaAkun = document.getElementById('namaAkun').value;
                      var tanggalMulai = document.getElementById('tanggalMulai').value;
                      var tanggalAkhir = document.getElementById('tanggalAkhir').value;

                      // Ambil semua baris data yang ada dalam tabel
                      var rows = document.querySelectorAll('#tabelData tr');

                      // Loop melalui setiap baris data
                      rows.forEach(function(row) {
                        var namaAkunCell = row.cells[0].innerText; // Ambil data nama akun dari sel pertama
                        var tanggalJurnalCell = row.cells[1].innerText; // Ambil data tanggal jurnal dari sel kedua

                        // Periksa apakah baris data harus ditampilkan atau disembunyikan berdasarkan filter
                        if ((namaAkun === '' || namaAkun === namaAkunCell) &&
                            (tanggalMulai === '' || tanggalJurnalCell >= tanggalMulai) &&
                            (tanggalAkhir === '' || tanggalJurnalCell <= tanggalAkhir)) {
                          row.style.display = ''; // Tampilkan baris data
                        } else {
                          row.style.display = 'none'; // Sembunyikan baris data
                        }
                      });
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
                        <th>Keterangan</th>
                        <th>Jumlah</th>
                        <th>Total</th>
                      </tr>
                    </thead>
                    <tbody>
                      @php
                      $jumlah_pendapatan = 0;
                      $total_hpp_sesungguhnya = 0;
                      $jumlah_beban = 0;
                      @endphp
                      @if (isset($pendapatan[0]))
                      <tr>
                        <th colspan="3">Pendapatan</th>
                      </tr>
                      @foreach ($pendapatan as $record)
                      @php
                      $jumlah_pendapatan += $record->saldo_akun;
                      @endphp
                      <tr>
                        <td>{{ $record->nama_akun }}</td>
                        <td>Rp. {{ number_format($record->saldo_akun) }}</td>
                        <td></td>
                      </tr>
                      @endforeach
                      <tr>
                        <th>Jumlah Pendapatan</th>
                        <th></th>
                        <th>Rp. {{ number_format($jumlah_pendapatan) }}</th>
                      </tr>
                      <tr>
                        <td colspan="3">
                          <br>
                        </td>
                      </tr>
                      @endif
                      @if (isset($hpp[0]))
                      @php
                      $total_hpp_sesungguhnya = $hpp->sum('bbb_standar') + $hpp->sum('btk_standar') +
                      $hpp->sum('bop_standar');
                      @endphp
                      <tr>
                        <th colspan="3">Harga Pokok Penjualan</th>
                      </tr>
                      <tr>
                        <td>Harga Pokok Penjualan</td>
                        <td></td>
                        <td>Rp. {{ number_format($total_hpp_sesungguhnya) }}</td>
                      </tr>
                      <tr>
                        <th>Laba/Rugi Kotor</th>
                        <th></th>
                        <th>Rp. {{ number_format($jumlah_pendapatan - $total_hpp_sesungguhnya) }}</th>
                      </tr>
                      @endif
                      @if (isset($beban[0]))
                      <tr>
                        <th colspan="3">Beban Usaha</th>
                      </tr>
                      @foreach ($beban as $record)
                      @php
                      $jumlah_beban += $record->saldo_akun;
                      @endphp
                      <tr>
                        <td>{{ $record->nama_akun }}</td>
                        <td>Rp. {{ number_format($record->saldo_akun) }}</td>
                        <td></td>
                      </tr>
                      @endforeach
                      <tr>
                        <th>Total Beban Usaha</th>
                        <th></th>
                        <th>Rp. {{ number_format($jumlah_beban) }}</th>
                      </tr>
                      <tr>
                        {{-- identifikasi laba rugi operasional --}}
                        <?php $labaRugiOperasional = ($jumlah_pendapatan - $total_hpp_sesungguhnya) - $jumlah_beban ?>
                        <th>Laba/Rugi Operasional</th>
                        <th></th>
                        <th>Rp. {{ number_format($labaRugiOperasional) }}
                        </th>
                      </tr>
                      <tr>
                        <?php 
                        $bebanPajakPenghasilan = $labaRugiOperasional  * 22/100 ;
                          if($bebanPajakPenghasilan < 0){
                            $bebanPajakPenghasilan = 0;
                          }
                        ?>
                        <th>Beban Pajak Penghasilan</th>
                        <th></th>
                        <th>Rp. {{ number_format( $bebanPajakPenghasilan) }}
                        </th>
                        <input type="hidden" name="beban_pajak_penghasilan" value="{{ $bebanPajakPenghasilan }}"
                          form="posting">
                      </tr>
                      @endif
                      @if (isset($labaRugiOperasional) || isset($bebanPajakPenghasilan))
                      <tr>
                        <th>Laba/Rugi Bersih</th>
                        <th></th>
                        <th>Rp. {{ number_format($labaRugiOperasional - $bebanPajakPenghasilan) }}
                        </th>
                        <input type="hidden" name="jumlah_laba_rugi"
                          value="{{ $labaRugiOperasional - $bebanPajakPenghasilan }}" form="posting">
                      </tr>
                      @else
                      <tr>
                        <th colspan="3" class="text-center">Data Tidak Ada</th>
                      </tr>
                      @endif
                      <tr>
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
      </script>
      <!-- Footer -->
    </div>

    <!-- Scroll to top -->
    <a class="scroll-to-top rounded" href="#page-top">
      <i class="fas fa-angle-up"></i>
    </a>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.2/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js') }}"></script>
    <script src="{{ asset('js/simitra.min.js') }}"></script>
    <!-- Page level plugins -->
    <script src="{{ asset('vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>

    <!-- Page level custom scripts -->
    <script>
      $(document).ready(function () {
      $('#dataTableHover').DataTable();
    });
    </script>
</body>

</html>