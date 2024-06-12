<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Laporan HPP</title>
  <style>
    body {
      font-family: Arial, sans-serif;
    }

    .container {
      padding: 20px;
      margin: 0 auto;
      max-width: 1000px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .letterhead {
      text-align: center;
      border-bottom: 4px solid #000;
      padding-bottom: 10px;
      margin-bottom: 2px;
      overflow: auto;
    }

    .letterhead h1 {
      font-size: 24px;
      color: #000;
      margin: 20px 0 0;
    }

    .address {
      text-align: center;
      margin-bottom: 20px;
    }

    .address p {
      margin: 5px 0;
    }

    .logo {
      float: left;
      margin-left: 40px;
      margin-right: 10px;
    }

    .logo {
      width: 100px;
    }

    .request-info {
      text-align: left;
      margin-bottom: 20px;
    }

    .request-info table {
      border: none;
    }

    .request-info th {
      text-align: left;
      width: 100px;
      border: none;
    }

    .request-info td {
      text-align: left;
      width: 200px;
      border: none;
    }

    .request-details table {
      width: 100%;
      border-collapse: collapse;
      border: 1px solid black;
    }

    .request-details th {
      padding: 8px;
      padding-bottom: 10px;
      text-align: center;
      border-bottom: 1px solid black;
      border-right: 1px solid black;
    }

    .request-details td {
      padding: 8px;
      padding-bottom: 10px;
      text-align: left;
      border-bottom: 1px solid black;
      border-right: 1px solid black;
    }

    .signature {
      display: flex;
      justify-content: flex-end;
    }

    .signature th {
      text-align: center;
      width: 300px;
      font-weight: normal;
      border: none;
    }

    .signature td {
      text-align: center;
      width: 300px;
      border: none;
    }
  </style>
</head>

<body>
  <div class="container">
    <div class="letterhead">
      <img src="{{ public_path('assets/img/logo-surat.png') }}" alt="Company Logo" class="logo">
      <h1>PT MITRA INDO MAJU MANDIRI<br>Fumigation, Termite & Pest Control</h1>
      <div class="address">
        <p>Jl. Pakis II Blok C No. 60 Perum Ardhimas Bumi Mulya</p>
        <p>Kel. Sendangmulyo Kec. Tembalang Kota Semarang, Kode Pos 50272</p>
        <p>Telp./Fax. (024) 6705285 - Email: mitra.indomandiri@gmail.com</p>
      </div>
    </div>
    <hr>
    <div class="request-details">
      <h3 style="text-align: center; font-weight: bold; text-decoration: underline;">LAPORAN HARGA POKOK PENJUALAN</h3>
      <p style="text-align: center;">Per {{ $bulan[request()->bulan] ?? 'Belum Dipilih' }} {{ request()->tahun ??
        'Belum Dipilih' }}</p>
      <table>
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
          $total_hpp_sesungguhnya = 0;
          $total_hpp_sesungguhnya = $hppSesungguhnya->sum('bbb_sesungguhnya') +
          $hppSesungguhnya->sum('btk_sesungguhnya') +
          $hppSesungguhnya->sum('bop_sesungguhnya');
          @endphp
          <tr>
            <th>HPP SESUNGGUHNYA</th>
            <th></th>
            <th></th>
          </tr>
          <tr>
            <td>Biaya Bahan Baku</td>
            <td>Rp. {{ number_format($hppSesungguhnya->sum('bbb_sesungguhnya')) }}</td>
            <td></td>
          </tr>
          <tr>
            <td>Biaya Tenaga Kerja</td>
            <td>Rp. {{ number_format($hppSesungguhnya->sum('btk_sesungguhnya')) }}</td>
            <td></td>
          </tr>
          <tr>
            <td>Biaya Overhead Pabrik</td>
            <td>Rp. {{ number_format($hppSesungguhnya->sum('bop_sesungguhnya')) }}</td>
            <td></td>
          </tr>
          <tr>
            <th>Jumlah HPP Sesungguhnya</th>
            <th></th>
            <th>Rp. {{ number_format($total_hpp_sesungguhnya) }}</th>
          </tr>
          <tr>
            <td colspan="3">
              <br>
            </td>
          </tr>
          <tr>
            <th>HPP STANDAR</th>
            <th></th>
            <th></th>
          </tr>
          <tr>
            <td>Biaya Bahan Baku</td>
            <td>Rp. {{ number_format($hpp->dataHarga->sum('bbb_standar')) }}</td>
            <td></td>
          </tr>
          <tr>
            <td>Biaya Tenaga Kerja</td>
            <td>Rp. {{ number_format($hpp->dataHarga->sum('btk_standar')) }}</td>
            <td></td>
          </tr>
          <tr>
            <td>Biaya Overhead Pabrik</td>
            <td>Rp. {{ number_format($hpp->dataHarga->sum('bop_standar')) }}</td>
            <td></td>
          </tr>
          <tr>
            <th>Total HPP Standar</th>
            <th></th>
            <th>Rp. {{ number_format($hpp->dataHarga->sum('hpp')) }}</th>
          </tr>
          <tr>
            <th>Selisih Efisiensi Biaya</th>
            <th></th>
            <th>Rp. {{ number_format($total_hpp_sesungguhnya - $hpp->dataHarga->sum('hpp')) }}</th>
          </tr>
        </tbody>
        <!-- AKHIR EDIT SESUAIKAN TABEL DATABASE -->
      </table>
    </div>
    <br>
    <div class="signature" style="text-align: right; margin-left: 400px">
      <table>
        <tr>
          <th>Semarang, {{ date('d M Y') }}</th>
        </tr>
        <tr>
          <th>Bagian Keuangan</th>
        </tr>
        <tr>
          <td>
            <br>
            <br>
            <br>
            (Sita Permatasari)
          </td>
        </tr>
      </table>
    </div>
    <div class="request-info">
      <table>
        <tr>
          <th style="font-size: 10px;">Print by</th>
          <td style="font-size: 10px;">: {{ Auth::user()->username }}</td>
        </tr>
      </table>
    </div>
  </div>
</body>

</html>