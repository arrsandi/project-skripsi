<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">



    <title>ARSA APP | Cetak Laporan Pemasukan</title>
    <link href="{{ asset('haldep/img/logo-ajm.png') }}" rel="icon">
</head>

<body style="background-color: white" onload="window.print()">
    <style>
        .tabel {
            margin-top: 30px;
            width: 100%;
            border-collapse: collapse;
            font-size: 10px;
        }

        .tabel td,
        .tabel th {
            border: 2px solid black;

        }

        .card-body {
            font-family: Arial, Helvetica, sans-serif;
        }

        .judul {
            font-weight: bolder;
            font-size: 20px;

        }
    </style>
    <div class="row">

        <div class="card-body">
            <table style="width: 100%">
                <tr>
                    <td align="center">
                        <img src="{{ asset('logo/logo-ajm.png') }}"
                            style="display: inline-block; width:120px; margin-top:-60px; margin-right:-74px; height:auto; float:right;">
                    </td>
                    <td style="text-align:center;">
                        <span style=" font-weight: bold;">
                            <span class="judul"> CV. ARSA JAYA MANDIRI </span><br>
                            JASA PENGIRIMAN : MOTOR, MOBIL, TRUK, DAN ALAT BERAT <br>
                            Kantor : Jl. Pramuka Km. 6 Gg. Manunggal Raya No. 26A RT. 10<br>
                            Telp / fax (0511) 3262045 Email : ajm.bjm2016@gmail.com<br>
                            Banjarmasin, Kal-Sel<br>
                            Laporan Pemasukan <br>
                            Periode
                            {{ Carbon\carbon::parse($tanggal_awal)->translatedFormat('d-m-Y') }} s/d
                            {{ Carbon\carbon::parse($tanggal_akhir)->translatedFormat('d-m-Y') }}
                        </span>
                    </td>

                </tr>
            </table>

            <table class="table table-bordered tabel">
                <tr style="text-align: center">
                    <th>No</th>
                    <th>Tanggal</th>
                    <th>No. Invoice</th>
                    <th>Keterangan</th>
                    <th>Jumlah</th>
                </tr>
                @if ($totalpemasukan == 0)
                    <tr>
                        <td colspan="5">
                            <center><b>Tidak ada pemasukan pada periode
                                    {{ Carbon\carbon::parse($tanggal_awal)->translatedFormat('d-m-Y') }} s/d
                                    {{ Carbon\carbon::parse($tanggal_akhir)->translatedFormat('d-m-Y') }}</b></center>
                        </td>
                    </tr>
                @else
                    @foreach ($pemasukan as $item)
                        <tr>
                            <td style="text-align: center">{{ $loop->iteration }}</td>
                            <td style="text-align: center">
                                {{ Carbon\carbon::parse($item->tanggal)->translatedFormat('d-m-Y') }}
                            </td>
                            <td style="text-align: center">{{ $item->noinvoice }}</td>
                            <td style="text-align: left">
                                @if (isset($item->detail))
                                    @foreach ($item->detail as $data)
                                        Pengiriman Unit kepada {{ $data->nama_penerima }}
                                        ({{ $data->antar->rute_asal }} - {{ $data->antar->rute_tujuan }})
                                        <br>
                                    @endforeach
                                @endif

                            </td>
                            <td style="text-align: right">@currency($item->total_biaya_keseluruhan)</td>
                        </tr>
                    @endforeach
                    <tr>
                        <td colspan="4" style="text-align: center"><b>Total Pemasukan</b></td>
                        <td style="text-align: right"><b>@currency($totalpemasukan)</b></td>
                    </tr>
                @endif
            </table>

        </div>


    </div>






</body>

</html>
