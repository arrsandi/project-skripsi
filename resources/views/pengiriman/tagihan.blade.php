<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->


    <title>ARSA APP | Cetak Tagihan</title>
    <link href="{{ asset('haldep/img/logo-ajm.png') }}" rel="icon">
</head>

<body style="background-color: white" onload="window.print()">
    <style>
        th,
        td {
            padding: 15px;
        }

        .tabel {
            width: 100%;
            border-collapse: collapse;
            border: 1px solid;
            border-bottom: 0px;
            font-size: 12px;
        }

        .tabel th {
            border: 1px solid;
            margin: 1px;
        }

        .tabel tr {
            margin: 1px;

        }

        .tabel2 {
            width: 100%;
            border-collapse: collapse;
            border-top: 0px;
            font-size: 12px;
        }

        .tabel2 tr {
            border: 1px solid;
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
                            style="display: inline-block; width:120px;  margin-right:-74px; height:auto; float:right;">
                    </td>
                    <td style="text-align:center;">
                        <span style=" font-weight: bold;">
                            <span class="judul"> CV. ARSA JAYA MANDIRI </span><br>
                            JASA PENGIRIMAN : MOTOR, MOBIL, TRUK, DAN ALAT BERAT <br>
                            Kantor : Jl. Pramuka Km. 6 Gg. Manunggal Raya No. 26A RT. 10<br>
                            Telp / fax (0511) 3262045 Email : ajm.bjm2016@gmail.com<br>
                            Banjarmasin, Kal-Sel<br>
                        </span>
                    </td>

                </tr>
            </table>

            <div class="card">
                <div class="card-body">
                    <table class="tabel">
                        <thead>
                            <tr>
                                <th style="text-align: center" colspan="2">Invoice</th>
                                <td style="width:25%; ">Kepada</td>
                                <td style="width:40%; ">{{ $pengiriman->nama_pengirim }}
                                </td>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>No. Invoice</td>
                                <td style="border-right: 1px solid">{{ $pengiriman->noinvoice }}</td>
                                <td>Alamat</td>
                                <td>{{ $pengiriman->alamat_pengirim }}</td>

                            </tr>
                            <tr>
                                <td>Tanggal</td>
                                <td style="border-right: 1px solid">
                                    {{ Carbon\carbon::parse($pengiriman->tanggal)->translatedFormat('d-m-Y') }}
                                </td>
                                <td>Telepon</td>
                                <td>{{ $pengiriman->telepon_pengirim }}</td>
                            </tr>
                        </tbody>
                    </table>



                    <table class="tabel2">
                        <thead style="text-align: center">
                            <tr>
                                <th colspan="4">Keterangan</th>
                                <th colspan="2">Jumlah (Rp)</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pengiriman->detail as $item)
                                <tr>
                                    <td colspan="4" style="text-align: left; ">
                                        <b> Pengiriman Unit kepada {{ $item->nama_penerima }}
                                            ({{ $item->antar->rute_asal }}
                                            - {{ $item->antar->rute_tujuan }})
                                        </b><br>
                                        Jenis Pengiriman: {{ $item->antar->jenis->nama_layanan }} <br>
                                        Alamat Penerima: {{ $item->alamat_penerima }} <br>
                                        Telepon Penerima: {{ $item->telepon_penerima }} <br>
                                        Nama Kapal: {{ $item->nama_kapal ?? '-' }} <br>
                                        Unit: {{ $item->merk_type }} ({{ $item->warna }}) <br>
                                        No. Polisi: {{ $item->no_polisi ?? '-' }} <br>
                                        No. Rangka: {{ $item->no_rangka }} <br>
                                        No. Mesin: {{ $item->no_mesin }} <br>
                                        Biaya Pengiriman: <br>
                                        Biaya Koordinasi: <br>
                                        Biaya Tambahan: <br>
                                        Keterangan: {{ $item->keterangan }}
                                    </td>
                                    <td colspan="2" style="text-align: right">
                                        <br>
                                        <br>
                                        <br><br><br><br><br><br>
                                        @currency($item->biaya_kirim) <br>
                                        @currency($item->biaya_koordinasi) <br>
                                        @currency($item->biaya_tambahan)
                                    </td>
                                </tr>
                            @endforeach
                            <tr>
                                <td colspan="4" style="text-align: center"><b>Total Biaya</b></td>
                                <td colspan="2" style="text-align: right">@currency($pengiriman->total_biaya)</td>
                            </tr>
                            <tr>
                                <td colspan="4" style="text-align: center"><b>Potongan</b></td>
                                <td colspan="2" style="text-align: right">@currency($pengiriman->potongan)</td>
                            </tr>
                            <tr>
                                <td colspan="4" style="text-align: center"><b>Total Biaya Keseluruhan</b></td>
                                <td colspan="2" style="text-align: right"><b>@currency($pengiriman->total_biaya_keseluruhan)</b>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="6" style="text-align: right"><b>Terbilang:
                                        {{ terbilang($pengiriman->total_biaya_keseluruhan) }}
                                        Rupiah</b>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="6"><small>Pembayaran dapat melalui Rek. BCA 8275028165 a/n Andry</small>
                                </td>
                            </tr>
                        </tbody>
                    </table>

                </div>
            </div>
</body>

</html>
