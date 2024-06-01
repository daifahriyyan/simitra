<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Buku Besar</title>
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
      font-size: 10px;
      text-align: center;
      border-bottom: 1px solid black;
      border-right: 1px solid black;
    }

    .request-details td {
      padding: 8px;
      padding-bottom: 10px;
      font-size: 10px;
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
      <h3 style="text-align: center; font-weight: bold; text-decoration: underline;">BUKU BESAR</h3>
      <p style="text-align: center;">Per {{ request()->tanggalMulai ?? 'Belum Dipilih' }} {{ request()->tanggalAkhir ??
        'Belum Dipilih' }}</p>
      <table>
        <tr>
          <th style="text-align: left;">NAMA AKUN</th>
          <td>: {{ $akunSelected->nama_akun ?? 'Belum Dipilih' }}</td>
          <td colspan="4"></td>
          <th></th>
          <th></th>
          <th></th>
          <th></th>
          <th style="text-align: right;">KODE AKUN</th>
          <td>: {{ $akunSelected->kode_akun ?? 'Belum Dipilih' }}</td>
        </tr>
      </table>
    </div>
    <div class="request-details">
      <table>
        <tr>
          <th>No Jurnal</th>
          <th>Tanggal Jurnal</th>
          <th>Uraian Jurnal</th>
          <th>Ref</th>
          <th>Debet</th>
          <th>Kredit</th>
          <th>Saldo</th>
        </tr>
        @php
        $saldo = 0;
        $jumlahDebet = 0;
        $jumlahKredit = 0;
        @endphp
        @foreach ($jurnalUmum as $record)
        @php
        $jumlahDebet += $record->debet;
        $jumlahKredit += $record->kredit;
        if($record->akun->jenis_akun == 'debet'){
        $saldo += $record->debet;
        $saldo -= $record->kredit;
        } else if($record->akun->jenis_akun == 'kredit'){
        $saldo -= $record->debet;
        $saldo += $record->kredit;
        }
        @endphp
        <tr>
          <td>{{ $record->jurnal->no_jurnal}}</td>
          <td>{{ $record->jurnal->tanggal_jurnal }}</td>
          <td>{{ $record->jurnal->uraian_jurnal }}</td>
          <td>{{ $record->jurnal->no_bukti }}</td>
          <td>Rp. {{ number_format($record->debet) }}</td>
          <td>Rp. {{ number_format($record->kredit) }}</td>
          <td>Rp. {{ number_format($saldo) }}</td>
        </tr>
        @endforeach
        <tr>
          <th colspan="4">Jumlah</th>
          <th>Rp. {{ number_format($jumlahDebet) }}</th>
          <th>Rp. {{ number_format($jumlahKredit) }}</th>
          <th></th>
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