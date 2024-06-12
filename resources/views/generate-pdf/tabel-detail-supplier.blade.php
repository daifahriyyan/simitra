<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Daftar Detail Supplier</title>
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
      <h3 style="text-align: center; font-weight: bold; text-decoration: underline;">DAFTAR DETAIL SUPPLIER</h3>
      <table style="font-size: 11px">
        <tr>
          <th>Id Detail Supplier</th>
          <th>Id Supplier</th>
          <th>Nama Supplier</th>
          <th>Termin Pembayaran</th>
          <th>Tanggal Input</th>
          <th>Pembelian</th>
          <th>Pembayaran</th>
          <th>Saldo Akhir Supplier</th>
          <th>Tanggal Jatuh Tempo</th>
          <th>Status</th>
        </tr>
        @foreach ($detailSupplier as $record)
        @php
        $jatuh_tempo = $record->tanggal_jatuh_tempo;
        $saldo_akhir = $record->saldo_akhir_supplier;
        @endphp
        <tr>
          <td>{{ $record->id_detail_supplier}}</td>
          <td>{{ $record->supplier->id_supplier}}</td>
          <td>{{ $record->supplier->nama_supplier}}</td>
          <td>{{ $record->termin_pembayaran}}</td>
          <td>{{ $record->tanggal_input}}</td>
          <td>{{ number_format($record->pembelian, 2, ',', '.')}}</td>
          <td>{{ number_format($record->pembayaran, 2, ',', '.')}}</td>
          <td>{{ number_format($saldo_akhir, 2, ',', '.')}}</td>
          <td>{{ $jatuh_tempo}}</td>
          <td>
            @if ($record->status == 'Lunas')
            <span class='badge badge-success'>{{ $record->status }}</span>
            @elseif($jatuh_tempo > date('Y-m-d') && isset($saldo_akhir))
            <span class='badge badge-warning'>Masa Hutang</span>
            @elseif($jatuh_tempo > date('Y-m-d') &&
            is_null($saldo_akhir))
            <span class='badge badge-success'>Lunas</span>
            @elseif($jatuh_tempo <= date('Y-m-d') && isset($saldo_akhir)) <span class='badge badge-danger'>Jatuh
              Tempo</span>
              @elseif($jatuh_tempo <= date('Y-m-d') && is_null( $saldo_akhir )) <span class='badge badge-success'>
                Lunas</span>
                @endif
          </td>
        </tr>
        @endforeach
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