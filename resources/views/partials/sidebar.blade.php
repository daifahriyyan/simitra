<ul class="navbar-nav sidebar sidebar-light accordion" id="accordionSidebar">
  <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
    <div class="sidebar-brand-icon">
      <img src="{{ asset('img/logo/logo2.png') }}">
    </div>
    <div class="sidebar-brand-text mx-3">SIMITRA</div>
  </a>
  <hr class="sidebar-divider my-0">
  <li class="nav-item active">
    <a class="nav-link" href="{{ route('Dashboard') }}">
      <i class="fas fa-fw fa-tachometer-alt"></i>
      <span>Dashboard</span></a>
  </li>
  <hr class="sidebar-divider">
  <li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseBootstrap" aria-expanded="true"
      aria-controls="collapseBootstrap">
      <i class="far fa-fw fa-window-maximize"></i>
      <span>Master</span>
    </a>
    <div id="collapseBootstrap" class="collapse" aria-labelledby="headingBootstrap" data-parent="#accordionSidebar">
      <!-- Konten dropdown Master -->
      <div class="bg-white py-2 collapse-inner rounded">
        <h6 class="collapse-header">Master</h6>
        <a class="collapse-item" href="{{ route('Standar HPP') }}">Standar HPP</a>
        <a class="collapse-item" href="{{ route('Harga Jasa') }}">Harga Jasa</a>
        <a class="collapse-item" href="{{ route('Persediaan') }}">Persediaan</a>
        <a class="collapse-item" href="{{ route('Importer') }}">Importer</a>
        <a class="collapse-item" href="{{ route('pegawai.index') }}">Pegawai</a>
      </div>
    </div>
  </li>
  @if (Auth::user()->posisi == 'Administrasi' || Auth::user()->posisi == 'Direktur')
  <li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseForm" aria-expanded="true"
      aria-controls="collapseForm">
      <i class="fab fa-fw fa-wpforms"></i>
      <span>Penerimaan Jasa</span>
    </a>
    <div id="collapseForm" class="collapse" aria-labelledby="headingForm" data-parent="#accordionSidebar">
      <!-- Konten dropdown Penerimaan Jasa -->
      <div class="bg-white py-2 collapse-inner rounded">
        <h6 class="collapse-header">Penerimaan Jasa</h6>
        <a class="collapse-item" href="{{ route('Data Customer') }}">Customer</a>
        <a class="collapse-item" href="{{ route('Data Order') }}">Order</a>
        {{-- <a class="collapse-item" href="{{ route('Dokumen Order') }}">Dokumen Order</a> --}}
        <a class="collapse-item" href="{{ route('Sertifikat') }}">Sertifikat</a>
        <a class="collapse-item" href="{{ route('Invoice') }}">Invoice</a>
        <a class="collapse-item" href="{{ route('Bukti Pembayaran') }}">Bukti Pembayaran</a>
        <a class="collapse-item" href="{{ route('Draft Pelayaran') }}">Draft Pelayaran</a>
        <a class="collapse-item" href="{{ route('Detail Customer') }}">Detail Customer</a>
        <a class="collapse-item" href="{{ route('Rekap Penjualan') }}">Rekap Penjualan</a>
      </div>
    </div>
  </li>
  @endif
  @if (Auth::user()->posisi == 'Operasional' || Auth::user()->posisi == 'Direktur')
  <li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseOperasional"
      aria-expanded="true" aria-controls="collapseOperasional">
      <i class="fa fa-users" aria-hidden="true"></i>
      <span>Operasional</span>
    </a>
    <div id="collapseOperasional" class="collapse" aria-labelledby="headingOperasional" data-parent="#accordionSidebar">
      <!-- Konten dropdown Operasional -->
      <div class="bg-white py-2 collapse-inner rounded">
        <h6 class="collapse-header">Operasional</h6>
        <a class="collapse-item" href="{{ route('Verifikasi Order') }}">Verifikasi Order</a>
        <a class="collapse-item" href="{{ route('Surat Perintah Kerja') }}">Surat Perintah Kerja</a>
        <a class="collapse-item" href="{{ route('Surat Pemberitahuan') }}">Surat Pemberitahuan</a>
        <a class="collapse-item" href="{{ route('Ceklist Fumigasi') }}">Ceklist Fumigasi</a>
        <a class="collapse-item" href="{{ route('Methyl Recordsheet') }}">Methyl Recordsheet</a>
        {{-- <a class="collapse-item" href="{{ route('Pemakaian Methyl') }}">Pemakaian Methyl</a> --}}
        <a class="collapse-item" href="{{ route('Kartu Stok Persediaan') }}">Kartu Stok Persediaan</a>
        <a class="collapse-item" href="{{ route('Pemberitahuan Kegiatan') }}">Pemberitahuan Kegiatan</a>
        <a class="collapse-item" href="{{ route('HPP Sesungguhnya') }}">HPP Sesunggguhnya</a>
        <a class="collapse-item" href="{{ route('Rekap HPP Standar') }}">Rekap HPP Standar</a>
      </div>
    </div>
  </li>
  @endif
  @if (Auth::user()->posisi == 'Keuangan' || Auth::user()->posisi == 'Direktur')
  <li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseMoney" aria-expanded="true"
      aria-controls="collapseMoney">
      <i class="fas fa-money-bill"></i>
      <span>Akuntansi</span>
    </a>
    <div id="collapseMoney" class="collapse" aria-labelledby="headingMoney" data-parent="#accordionSidebar">
      <!-- Konten dropdown Akuntansi -->
      <div class="bg-white py-2 collapse-inner rounded">
        <h6 class="collapse-header">Akuntansi</h6>
        <a class="collapse-item" href="{{ route('Daftar Akun') }}">Daftar Akun</a>
        <a class="collapse-item" href="{{ route('Supplier') }}">Supplier</a>
        <a class="collapse-item" href="{{ route('Pembelian') }}">Pembelian</a>
        <a class="collapse-item" href="{{ route('Detail Supplier') }}">Detail Supplier</a>
        <a class="collapse-item" href="{{ route('Penggajian') }}">Penggajian</a>
        <a class="collapse-item" href="{{ route('Aset Tetap') }}">Aset Tetap</a>
        <a class="collapse-item" href="{{ route('Penyusutan Aset Tetap') }}">Penyusutan Aset Tetap</a>
        <a class="collapse-item" href="{{ route('Jurnal Umum') }}">Jurnal Umum</a>
      </div>
    </div>
  </li>
  <li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTableLaporan"
      aria-expanded="true" aria-controls="collapseTableLaporan">
      <i class="fas fa-file-invoice-dollar"></i>
      <span>Laporan Keuangan</span>
    </a>
    <div id="collapseTableLaporan" class="collapse" aria-labelledby="headingTableLaporan"
      data-parent="#accordionSidebar">
      <!-- Konten dropdown Laporan Keuangan -->
      <div class="bg-white py-2 collapse-inner rounded">
        <h6 class="collapse-header">Laporan Keuangan</h6>
        <a class="collapse-item" href="{{ route('Buku Besar') }}">Buku Besar</a>
        <a class="collapse-item" href="{{ route('Neraca Saldo') }}">Neraca Saldo</a>
        <a class="collapse-item" href="{{ route('Harga Pokok Penjualan') }}">Harga Pokok Penjualan</a>
        <a class="collapse-item" href="{{ route('Laporan Laba Rugi') }}">Laba Rugi</a>
        <a class="collapse-item" href="{{ route('Posisi Keuangan') }}">Posisi Keuangan</a>
      </div>
    </div>
  </li>
  @endif
  <hr class="sidebar-divider">
  @if (Auth::user()->posisi == 'Direktur')
  <li class="nav-item">
    <a class="nav-link" href="{{ route('Daftar User') }}">
      <i class="fas fa-user-plus"></i>
      <span>Users</span>
    </a>
  </li>
  @endif
  <li class="nav-item">
    <a class="nav-link" href="javascript:void(0);" data-toggle="modal" data-target="#logoutModal">
      <i class="fas fa-sign-out-alt"></i>
      <span>Logout</span>
    </a>
  </li>
</ul>

<!-- Modal Konfirmasi Logout -->
<div class="modal fade" id="logoutModal" tabindex="-1" aria-labelledby="logoutModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="logoutModalLabel">Konfirmasi Logout</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Apakah Anda Yakin Ingin Keluar dari Sistem?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
        <form action="{{ route('Logout Pegawai') }}" method="post">
          @csrf
          <button type="submit" class="btn btn-primary"><a>Logout</a></button>
        </form>
      </div>
    </div>
  </div>
</div>