<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Pemberitahuan Kegiatan</title>
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
    }

    .request-details th {
      text-align: center;
      padding-bottom: 10px;
    }

    .custom-table {
      border: 1px solid black;
      border-collapse: collapse;
    }

    .custom-table th,
    .custom-table td {
      border: 1px solid black;
      padding: 8px;
      text-align: center;
    }

    .signature {
      display: flex;
      justify-content: flex-end;
    }

    .signature th {
      text-align: center;
      width: 50px;
      font-weight: bold;
      border: none;
    }

    .signature td {
      text-align: center;
      width: 200px;
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
    <div class="request-info">
      <h3 style="text-align: center; font-weight: bold; text-decoration: underline;">FORMULIR PEMBERITAHUAN TENTANG
        MULAI DAN SELESAINYA FUMIGASI</h3>
      <p>Hal : Pemberitahuan pada pemilik Depo
        <br>Bersama ini kami beritahukan kepada Pengelola/pemilik Depo, bahwa kami telah mulai/selesai melaksanakan
        fumigasi
      </p>
      <table>
        <tr>
          <th style="font-weight: normal;">Tanggal Mulai</th>
          <td>: (get "start date" saat disortir berdasarkan tanggal)</td>
        </tr>
        <tr>
          <th style="font-weight: normal;">Tanggal Selesai</th>
          <td>: (get "end date" saat disortir berdasarkan tanggal)</td>
          <td></td>
        </tr>
      </table>
      <br>
      <table class="custom-table">
        <tr>
          <th style="width: 5%;">No</th>
          <th>No. Container</th>
          <th style="width: 10%;">Volume</th>
          <th>Waktu Mulai</th>
          <th>Waktu Selesai</th>
          <th style="width: 30%;">Keterangan</th>
        </tr>
        @foreach ($pemberitahuanKegiatan as $record)
        <tr>
          <td>{{ $loop->iteration }}</td>
          <td>{{ $record->dataOrder->container }}</td>
          <td>{{ $record->dataOrder->volume }}</td>
          <td>{{ $record->jam_mulai }}</td>
          <td>{{ $record->jam_selesai }}</td>
          <td>{{ $record->keterangan }}</td>
        </tr>
        @endforeach
      </table>
      <p>Demikian pemberitahuan ini kami sampaikan.
        <br>Atas kerjasamanya kami ucapkan terima kasih.
        <br>PT MITRA INDO MAJU MANDIRI
      </p>
      <br>
      <br>
      <br>
    </div>
    <div class="signature" style="text-align: right; margin-left: 500px">
      <table>
        <tr>
          <th>Fumigator</th>
        </tr>
        <tr>
          <td>
            <br>
            <br>
            <br>
          </td>
        </tr>
      </table>
    </div>
  </div>
</body>

</html>