<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Rekap HPP Standar</title>
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
      padding: 0px 5px 0px 5px;
      font-size: 10px;
      text-align: center;
    }

    .signature {
      display: flex;
      justify-content: flex-end;
    }

    .signature th {
      text-align: center;
      width: 50px;
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
    <div class="request-info" style="font-size: 12px">
      <h3 style="text-align: center; font-weight: bold; text-decoration: underline;">REKAP HPP STANDAR</h3>
      <br>
      <table class="custom-table">
        <!-- AWAL EDIT SESUAIKAN TABEL DATABASE -->
        <thead class="thead-light">
          <tr>
            <th>ID Invoice</th>
            <th>Tanggal Invoice</th>
            <th>Volume</th>
            <th>Quantity</th>
            <th>ID Data Standar</th>
            <th>Biaya Bahan Baku</th>
            <th>Biaya tenaga Kerja</th>
            <th>Biaya Overhead Pabrik</th>
            <th>HPP</th>
            <th>Total HPP</th>
            {{-- <th>Aksi</th> --}}
          </tr>
        </thead>
        <tbody>
          @php
          $jumlahBBB = 0;
          $jumlahBTK = 0;
          $jumlahBOP = 0;
          $jumlahHPP = 0;
          $jumlahTotalHPP = 0;
          @endphp
          @foreach ($rekapHppStandar as $record)
          @php
          $jumlahBBB += $record->dataHarga->bbb_standar;
          $jumlahBTK += $record->dataHarga->btk_standar;
          $jumlahBOP += $record->dataHarga->bop_standar;
          $jumlahHPP += $record->dataHarga->hpp;
          $JumlahTotalHPP += $record->dataHarga->hpp * $record->detailOrder->dataOrder->jumlah_order
          @endphp
          <tr>
            <td>{{ $record->id_invoice }}</td>
            <td>{{ $record->tanggal_invoice }}</td>
            <td>{{ $record->dataHarga->volume }}</td>
            <td>{{ $record->detailOrder->dataOrder->jumlah_order }}</td>
            <td>{{ $record->dataHarga->id_datastandar }}</td>
            <td>Rp. {{ number_format($record->dataHarga->bbb_standar) }}</td>
            <td>Rp. {{ number_format($record->dataHarga->btk_standar) }}</td>
            <td>Rp. {{ number_format($record->dataHarga->bop_standar) }}</td>
            <td>Rp. {{ number_format($record->dataHarga->hpp) }}</td>
            <td>Rp. {{ number_format($record->dataHarga->hpp *
              $record->detailOrder->dataOrder->jumlah_order) }}
            </td>
            {{-- <td>
              <button type='button' class='btn btn-success btn-sm' data-bs-toggle='modal'
                data-bs-target='#editModal{{ $record->id }}'><i class='fas fa-edit'></i></button>
              <button type="submit" class='btn btn-danger btn-sm' data-bs-toggle="modal"
                data-bs-target="#deleteRecord{{ $record->id }}"><i class='fas fa-trash'></i></button>
            </td> --}}
          </tr>
          @endforeach
          @if ($JumlahTotalHPP != 0)
          <tr>
            <th colspan="5">Jumlah</th>
            <th>Rp. {{ number_format($jumlahBBB) }}</th>
            <th>Rp. {{ number_format($jumlahBTK) }}</th>
            <th>Rp. {{ number_format($jumlahBOP) }}</th>
            <th>Rp. {{ number_format($jumlahHPP) }}</th>
            <th>Rp. {{ number_format($JumlahTotalHPP) }}</th>
          </tr>
          @endif
        </tbody>
        <!-- AKHIR EDIT SESUAIKAN TABEL DATABASE -->
      </table>
      <br>
      <br>
      <br>
    </div>
    <div class="signature" style="text-align: right; margin-left: 400px">
      <table>
        <tr>
          <th>Semarang, {{ date('d M Y') }}</th>
        </tr>
        <tr>
          <th>Manajer Teknik,</th>
        </tr>
        <tr>
          <td>
            <br>
            <br>
            <br>
            (DIDIK SETIAWAN)
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
</body>

</html>