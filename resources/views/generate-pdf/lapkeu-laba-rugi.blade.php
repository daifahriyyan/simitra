<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Laporan Laba Rugi</title>
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
      <h3 style="text-align: center; font-weight: bold; text-decoration: underline;">LAPORAN LABA RUGI</h3>
      <p style="text-align: center;">Per {{ $bulan[request()->bulan] ?? 'Belum Dipilih' }} {{ request()->tahun ??
        'Belum Dipilih' }}</p>
      <table>
        <tr>
          <th>Keterangan</th>
          <th>Jumlah</th>
          <th>Total</th>
        </tr>
        @php
        $jumlah_pendapatan = 0;
        $total_hpp_sesungguhnya = 0;
        $jumlah_beban = 0;
        @endphp
        @if (isset($pendapatan[0]))
        <tr>
          <th style="text-align: left">Pendapatan</th>
          <td></td>
          <td></td>
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
          <th style="text-align: left">Jumlah Pendapatan</th>
          <th></th>
          <th style="text-align: left">Rp. {{ number_format($jumlah_pendapatan) }}</th>
        </tr>
        <tr>
          <td>
            <br>
          </td>
          <td></td>
          <td></td>
        </tr>
        @endif
        @if (isset($beban[0]))
        <tr>
          <th style="text-align: left">Beban Usaha</th>
          <th></th>
          <th></th>
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
          <?php $labaRugiSebelumPajak = $jumlah_pendapatan - $jumlah_beban ?>
          <th>Laba/Rugi Sebelum Pajak</th>
          <th></th>
          <th>Rp. {{ number_format($labaRugiSebelumPajak) }}</th>
        </tr>
        <tr>
          <?php 
        $bebanPajakPenghasilan = intval($pendapatan[0]->saldo_akun) * 0.5 /100 ;
          if($bebanPajakPenghasilan < 0){
            $bebanPajakPenghasilan = 0;
          }
        ?>
          <th>Beban Pajak Penghasilan</th>
          <th></th>
          <th>Rp. {{ number_format($bebanPajakPenghasilan) }}</th>
        </tr>
        @endif
        @if (isset($labaRugiSebelumPajak) || isset($bebanPajakPenghasilan))
        <tr>
          <th>Laba/Rugi Bersih</th>
          <th></th>
          <th>Rp. {{ number_format($labaRugiSebelumPajak - $bebanPajakPenghasilan) }}</th>
        </tr>
        @else
        <tr>
          <th colspan="3" class="text-center">Data Tidak Ada</th>
        </tr>
        @endif
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