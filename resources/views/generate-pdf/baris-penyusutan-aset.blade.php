<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Penyusutan Aset Tetap</title>
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
    }

    .request-details th {
      padding: 8px;
      width: 300px;
      padding-bottom: 10px;
      text-align: left;
    }

    .request-details td {
      padding: 8px;
      width: 300px;
      padding-bottom: 10px;
      text-align: left;
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
      <img src="{{ public_path('assets/img/logo-surat.jpg') }}" alt="Company Logo" class="logo">
      <h1>PT MITRA INDO MAJU MANDIRI<br>Fumigation, Termite & Pest Control</h1>
      <div class="address">
        <p>Jl. Pakis II Blok C No. 60 Perum Ardhimas Bumi Mulya</p>
        <p>Kel. Sendangmulyo Kec. Tembalang Kota Semarang, Kode Pos 50272</p>
        <p>Telp./Fax. (024) 6705285 - Email: mitra.indomandiri@gmail.com</p>
      </div>
    </div>
    <hr>
    <div class="request-details">
      <h3 style="text-align: center; font-weight: bold; text-decoration: underline;">PENYUSUTAN ASET TETAP</h3>
      <table>
        <tr>
          <th>Kode Penyusutan Aset</th>
          <td>: {{ $detail->kode_penyusutan_at }}</td>
          <td></td>
        </tr>
        <tr>
          <th>Kode Aset Tetap</th>
          <td>: {{ $detail->asetTetap->kode_at }}</td>
          <td></td>
        </tr>
        <tr>
          <th>Jenis Aset Tetap</th>
          <td>: {{ $detail->asetTetap->jenis_at }}</td>
          <td></td>
        </tr>
        <tr>
          <th>Nama Aset Tetap</th>
          <td>: {{ $detail->asetTetap->nama_at }}</td>
          <td></td>
        </tr>
        <tr>
          <th>Total Perolehan</th>
          <td>: {{ number_format($detail->asetTetap->harga_perolehan * $detail->asetTetap->jumlah_at, 2, ',','.') }}
          </td>
          <td></td>
        </tr>
        <tr>
          <th>Tanggal Penyusutan</th>
          <td>: {{ $detail->tanggal_penyusutan }}</td>
          <td></td>
        </tr>
        <tr>
          <th>Tahun Ke</th>
          <td>: {{ $detail->tahun_ke }}</td>
          <td></td>
        </tr>
        <tr>
          <th>Beban Penyusutan</th>
          <td>: {{ number_format($detail->beban_penyusutan, 2, ',','.') }}</td>
          <td></td>
        </tr>
        <tr>
          <th>Akumulasi Penyusutan</th>
          <td>: {{ number_format($detail->akumulasi_penyusutan, 2, ',','.') }}</td>
          <td></td>
        </tr>
        <tr>
          <th>Nilai Buku</th>
          <td>: {{ $detail->nilai_buku }}</td>
          <td></td>
        </tr>
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