@extends('layouts.main')

@section('container-fluid')
<div class="container-fluid" id="container-wrapper">
  @if ($errors->any())
  <div class="alert alert-danger alert-dismissible fade show" role="alert">
    <h3>Pesan Error</h3>
    <ul>
      @foreach ($errors->all() as $error)
      <li>{{ $error }}</li>
      @endforeach
    </ul>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
  @endif
  <!-- Your container content -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Pegawai</h1> <!-- EDIT NAMA -->
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="./">Master</a></li>
      <li class="breadcrumb-item active" aria-current="page">Pegawai</li> <!-- EDIT NAMA -->
    </ol>
  </div>
  <!-- AWAL EDIT SESUAIKAN TABEL DATABASE -->
  <!-- Modal Tambah Data -->
  <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="addModalLabel">Tambah Data Pegawai</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form method="POST" action="{{ route('pegawai.store') }}">
            @csrf
            <div class="mb-3">
              <label for="id_pegawai" class="form-label">ID Pegawai:</label>
              <input type="text" class="form-control" id="id_pegawai" name="id_pegawai" required>
            </div>
            <div class="mb-3">
              <label for="nama_pegawai" class="form-label">Nama Pegawai:</label>
              <input type="text" class="form-control" id="nama_pegawai" name="nama_pegawai" required>
            </div>
            <div class="mb-3">
              <label for="alamat_pegawai" class="form-label">Alamat Pegawai:</label>
              <input type="text" class="form-control" id="alamat_pegawai" name="alamat_pegawai" required>
            </div>
            <div class="mb-3">
              <label for="telp_pegawai" class="form-label">Telepon Pegawai:</label>
              <input type="text" class="form-control" id="telp_pegawai" name="telp_pegawai" required>
            </div>
            <div class="mb-3">
              <label for="posisi" class="form-label">Posisi:</label>
              <br>
              <select class="form-select" id="posisi" name="posisi" required>
                <option value="">Pilih Posisi</option>
                <option value="Direktur">Direktur</option>
                <option value="Direktur">Manajer</option>
                <option value="Admin">Admin</option>
                <option value="Operasional">Operasional</option>
                <option value="Keuangan">Keuangan</option>
                <option value="Keuangan">Fumigator</option>
                <option value="Direktur">Staff Lainnya</option>
              </select>
            </div>
            <div class="mb-3">
              <label for="noreg_fumigasi" class="form-label">No. Registrasi Fumigasi:</label>
              <input type="text" class="form-control" id="noreg_fumigasi" name="noreg_fumigasi">
            </div>
            <div class="mb-3">
              <label for="gaji_pokok" class="form-label">Gaji Pokok:</label>
              <input type="number" class="form-control" id="gaji_pokok" name="gaji_pokok" required>
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
  <div class="modal fade" id="editModal{{ $record->id }}" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editModalLabel">Edit Data Pegawai</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form method="POST" action="{{ route('pegawai.update', $record->id) }}">
            @csrf @method('put')
            <div class="mb-3">
              <label for="id_pegawai" class="form-label">ID Pegawai:</label>
              <input type="text" class="form-control" id="id_pegawai" value="{{ $record->id_pegawai }}" name="id_pegawai" readonly required>
            </div>
            <div class="mb-3">
              <label for="nama_pegawai" class="form-label">Nama Pegawai:</label>
              <input type="text" class="form-control" id="nama_pegawai" value="{{ $record->nama_pegawai }}" name="nama_pegawai" required>
            </div>
            <div class="mb-3">
              <label for="alamat_pegawai" class="form-label">Alamat Pegawai:</label>
              <input type="text" class="form-control" id="alamat_pegawai" value="{{ $record->alamat_pegawai }}" name="alamat_pegawai" required>
            </div>
            <div class="mb-3">
              <label for="telp_pegawai" class="form-label">Telepon Pegawai:</label>
              <input type="text" class="form-control" id="telp_pegawai" value="{{ $record->telp_pegawai }}" name="telp_pegawai" required>
            </div>
            <div class="mb-3">
              <label for="posisi" class="form-label">Posisi:</label>
              <br>
              <select class="form-select" id="posisi" name="posisi" required>
                @if (isset($record->posisi))
                <option value="{{ $record->posisi }}">{{ $record->posisi }}</option>
                @else
                <option value="">Pilih Posisi</option>
                @endif
                <option value="Direktur">Direktur</option>
                <option value="Manajer">Manajer</option>
                <option value="Admin">Admin</option>
                <option value="Operasional">Operasional</option>
                <option value="Keuangan">Keuangan</option>
                <option value="Fumigator">Fumigator</option>
                <option value="Staff Lainnya">Staff Lainnya</option>
              </select>
            </div>
            <div class="mb-3">
              <label for="noreg_fumigasi" class="form-label">No. Registrasi Fumigasi:</label>
              <input type="text" class="form-control" id="noreg_fumigasi" value="{{ $record->noreg_fumigasi }}" name="noreg_fumigasi">
            </div>
            <div class="mb-3">
              <label for="gaji_pokok" class="form-label">Gaji Pokok:</label>
              <input type="number" class="form-control" id="gaji_pokok" value="{{ $record->gaji_pokok }}" name="gaji_pokok" required>
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
        <form method="POST" action="{{ route('pegawai.destroy', $record->id) }}">
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
          <h6 class="m-0 font-weight-bold text-primary">Data Pegawai</h6> <!-- EDIT NAMA -->
          <div class="btn-group" role="group" aria-label="Basic mixed styles example">
            <!-- Tombol Tambah dengan Icon -->
            <button type="button" class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#addModal">
              Tambah
            </button>
            <!-- Tombol Cetak Tabel dengan Icon -->
            <button type="button" class="btn btn-sm btn-warning" onclick="cetakTabel()">
              Cetak
            </button>
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
          <table class="table align-items-center table-flush table-hover" id="dataTableHover">
            <!-- AWAL EDIT SESUAIKAN TABEL DATABASE -->
            <thead class="thead-light">
              <tr>
                <th>ID Pegawai</th>
                <th>Nama Pegawai</th>
                <th>Alamat Pegawai</th>
                <th>Telepon Pegawai</th>
                <th>Posisi</th>
                <th>No Reg Fumigasi</th>
                <th>Gaji Pokok</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($records as $record)
              <tr>
                <td>{{ $record->id_pegawai }}</td>
                <td>{{ $record->nama_pegawai }}</td>
                <td>{{ $record->alamat_pegawai }}</td>
                <td>{{ $record->telp_pegawai }}</td>
                <td>{{ $record->posisi }}</td>
                <td>{{ $record->noreg_fumigasi }}</td>
                <td>{{ $record->gaji_pokok }}</td>
                <td>
                  <button type='button' class='btn btn-success btn-sm' data-bs-toggle='modal'
                    data-bs-target='#editModal{{ $record->id }}'><i class='fas fa-edit'></i></button>
                  <button type="submit" class='btn btn-danger btn-sm' data-bs-toggle="modal"
                    data-bs-target="#deleteRecord{{ $record->id }}"><i class='fas fa-trash'></i></button>
                </td>
              </tr>
              @endforeach
              {{--
              <?php
            $query = "SELECT * FROM data_pegawai";
            $result = mysqli_query($conn, $query);
            while ($data = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>".$data['id_pegawai']."</td>";
                echo "<td>".$data['nama_pegawai']."</td>";
                echo "<td>".$data['alamat_pegawai']."</td>";
                echo "<td>".$data['telp_pegawai']."</td>";
                echo "<td>".$data['posisi']."</td>";
                echo "<td>".$data['noreg_fumigasi']."</td>";
                echo "<td>".number_format($data['gaji_pokok'], 2, ',', '.')."</td>"; 
                echo "<td>";
                echo "<button type='button' class='btn btn-success btn-sm' data-bs-toggle='modal' data-bs-target='#editModal' onclick='openEditModal(\"".$data['id_pegawai']."\", \"".$data['nama_pegawai']."\", \"".$data['alamat_pegawai']."\", \"".$data['telp_pegawai']."\", \"".$data['posisi']."\", \"".$data['noreg_fumigasi']."\", \"".$data['gaji_pokok']."\")'><i class='fas fa-edit'></i></button>";
                echo "<button type='button' class='btn btn-danger btn-sm' onclick='deleteData(\"".$data['id_pegawai']."\")'><i class='fas fa-trash'></i></button>";
                echo "</td>";
                echo "</tr>"; 
            }
          ?> --}}
            </tbody>
            <!-- AKHIR EDIT SESUAIKAN TABEL DATABASE -->
          </table>
        </div>
      </div>
    </div>
  </div>

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
    
    function openEditModal(idpegawai, namapegawai, alamatpegawai, telppegawai, posisi, noregfumigasi, gajipokok) {
      document.getElementById("edit_id_pegawai").value = idpegawai;
      document.getElementById("edit_nama_pegawai").value = namapegawai;
      document.getElementById("edit_alamat_pegawai").value = alamatpegawai;
      document.getElementById("edit_telp_pegawai").value = telppegawai;
      document.getElementById("edit_posisi").value = posisi;
      document.getElementById("edit_noreg_fumigasi").value = noregfumigasi;
      document.getElementById("edit_gaji_pokok").value = gajipokok;
    }

    function deleteData(idpegawai) {
      if (confirm("Apakah Anda yakin ingin menghapus data ini?")) {
        window.location.href = "?id_pegawai=" + idpegawai;
      }
    }
    
	// Ajax Data Table 
	$(document).ready(function () {
	  $('#dataTableHover').DataTable();
	});
  </script>
  @endsection