<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Laporan Posisi Keuangan</title>
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
      <h3 style="text-align: center; font-weight: bold; text-decoration: underline;">LAPORAN POSISI KEUANGAN</h3>
      <p style="text-align: center;">Untuk Periode yang Berakhir {{ $bulan[request()->bulan] ?? 'Belum Dipilih' }} {{
        request()->tahun ??
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
          @if ($asetLancar != null || $asetTetap != null)
          <tr>
            <th colspan="3">Aktiva</th>
          </tr>

          {{-- Aset Lancar --}}
          @if ($asetLancar != null)
          <tr>
            <th colspan="3">Aset Lancar</th>
          </tr>
          @php
          $total_hpp_sesungguhnya = 0;
          @endphp
          @foreach ($asetLancar as $record)
          <?php
          $total_hpp_sesungguhnya = $hppSesungguhnya->sum('bbb_sesungguhnya') +
          $hppSesungguhnya->sum('btk_sesungguhnya') +
          $hppSesungguhnya->sum('bop_sesungguhnya');
          
          $kas = $labaRugi->beban_pajak_penghasilan - ($total_hpp_sesungguhnya - $hpp->dataHarga->sum('hpp'));
          // if ($record->kode_akun == '1110') {
          //   $jumlah_aset_lancar += $kas;
          // <tr>
          //   <td>Kas</td>
          //   <td>Rp. {{ number_format($kas) }}</td>
          //   <td></td>
          // </tr>
          // } else{
            $jumlah_aset_lancar += $record->saldo_akun;
          ?>
          <tr>
            <td>{{ $record->nama_akun }}</td>
            <td>Rp. {{ number_format($record->saldo_akun) }}</td>
            <td></td>
          </tr>
          <?php
          // }
          ?>
          @endforeach
          <tr>
            <th>Jumlah Aset Lancar</th>
            <th></th>
            <th>Rp. {{ number_format($jumlah_aset_lancar) }}</th>
          </tr>
          @endif

          {{-- Aset Tetap --}}
          @if ($asetTetap != null)
          <tr>
            <th colspan="3">Aset Tetap</th>
          </tr>
          @foreach ($asetTetap as $record)
          @php
          if($record->kode_akun == '1220'){
          $jumlah_aset_tetap -= $record->saldo_akun;
          }else{
          $jumlah_aset_tetap += $record->saldo_akun;
          }
          @endphp
          <tr>
            <td>{{ $record->nama_akun }}</td>
            <td>Rp. {{ number_format($record->saldo_akun) }}</td>
            <td></td>
          </tr>
          @endforeach
          <tr>
            <th>Jumlah Aset Tetap</th>
            <th></th>
            <th>Rp. {{ number_format($jumlah_aset_tetap) }}</th>
          </tr>
          @endif
          <tr>
            <th>Total Aktiva</th>
            <th></th>
            <th>Rp. {{ number_format($jumlah_aset_tetap + $jumlah_aset_lancar) }}</th>
          </tr>

          <tr>
            <th colspan="3"><br></th>
          </tr>
          @endif

          @if ($kewajibanJkPdk != null || $kewajibanJkPjg != null || $ekuitas != null)
          <tr>
            <th colspan="3">Passiva</th>
          </tr>
          @if ($kewajibanJkPdk != null || $kewajibanJkPjg != null)
          <tr>
            <th colspan="3">Kewajiban</th>
          </tr>
          @endif
          {{-- Kewajiban Jangka Pendek --}}
          @if ($kewajibanJkPdk != null)
          <tr>
            <th colspan="3">Kewajiban Jangka Pendek</th>
          </tr>
          @foreach ($kewajibanJkPdk as $record)
          @php
          $jumlah_kewajiban_jkpdk += $record->saldo_akun;
          @endphp
          <tr>
            <td>{{ $record->nama_akun }}</td>
            <td>Rp. {{ number_format($record->saldo_akun) }}</td>
            <td></td>
          </tr>
          @endforeach
          <tr>
            <td>Hutang Pajak</td>
            <td>Rp. {{ number_format($labaRugi->beban_pajak_penghasilan) }}</td>
            <td></td>
          </tr>
          <tr>
            <?php $jumlah_kewajiban_jkpdk = $jumlah_kewajiban_jkpdk + $labaRugi->beban_pajak_penghasilan ?>
            <th>Jumlah Kewajiban Jangka Pendek</th>
            <th></th>
            <th>Rp. {{ number_format($jumlah_kewajiban_jkpdk) }}</th>
          </tr>
          @endif

          {{-- Kewajiban Jangka Panjang --}}
          @if ($kewajibanJkPjg != null)
          <tr>
            <th colspan="3">Kewajiban Jangka Panjang</th>
          </tr>
          @foreach ($kewajibanJkPjg as $record)
          @php
          $jumlah_kewajiban_jkpjg += $record->saldo_akun;
          @endphp
          <tr>
            <td>{{ $record->nama_akun }}</td>
            <td>Rp. {{ number_format($record->saldo_akun) }}</td>
            <td></td>
          </tr>
          @endforeach
          <tr>
            <th>Jumlah Kewajiban Jangka Panjang</th>
            <th></th>
            <th>Rp. {{ number_format($jumlah_kewajiban_jkpjg) }}</th>
          </tr>
          @endif
          <tr>
            <th>Jumlah Kewajiban</th>
            <th></th>
            <th>Rp. {{ number_format($jumlah_kewajiban_jkpjg + $jumlah_kewajiban_jkpdk) }}</th>
          </tr>

          {{-- Ekuitas --}}
          @if ($ekuitas != null)
          <tr>
            <th colspan="3">Ekuitas</th>
          </tr>
          @foreach ($ekuitas as $record)
          @php
          $jumlah_ekuitas += $record->saldo_akun;
          @endphp
          <tr>
            <td>{{ $record->nama_akun }}</td>
            <td>Rp. {{ number_format($record->saldo_akun) }}</td>
            <td></td>
          </tr>
          @endforeach
          <tr>
            <td>Laba / Rugi Bersih</td>
            <td>Rp. {{ number_format($labaRugi->jumlah_laba_rugi) }}</td>
            <td></td>
          </tr>
          <tr>
            <th>Jumlah Ekuitas</th>
            <th></th>
            <th>Rp. {{ number_format($jumlah_ekuitas + $labaRugi->jumlah_laba_rugi) }}</th>
          </tr>
          @endif
          <tr>
            <th>Total Passiva</th>
            <th></th>
            <th>Rp. {{ number_format($jumlah_ekuitas + $labaRugi->jumlah_laba_rugi + $jumlah_kewajiban_jkpjg
              + $jumlah_kewajiban_jkpdk) }}
            </th>
          </tr>
          @else
          <tr>
            <th colspan="3" class="text-center">Data Tidak Ada</th>
          </tr>
          @endif
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