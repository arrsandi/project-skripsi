<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->


    <title>ARSA APP | Berita Acara Pengiriman</title>
    <link href="{{ asset('haldep/img/logo-ajm.png') }}" rel="icon">
</head>

<body style="background-color: white" onload="window.print()">
    <style>
        th,
        td {
            padding: 2px;
        }

        .tabel {
            width: 100%;
            border: 1px solid;
            border-right: 0px;
            font-size: 12px;
        }

        .tabel th {
            border: 1px black;

        }

        .tabel2 {

            width: 100%;
            border: 1px solid;
            font-size: 12px;
        }

        .tabel2 tr {
            border: 1px solid black;
        }

        .tabel3 {

            width: 100%;
            border: 1px solid;
            border-top: 0px;
            border-right: 0px;
            font-size: 12px;
        }

        .tabel3 tr {
            border: 1px solid black;
        }

        .tabel4 {

            width: 100%;
            border: 1px solid;
            border-top: 0px;
            font-size: 12px;
        }

        .tabel4 tr {
            border: 1px solid black;
        }

        .tabel5 {

            width: 100%;
            border: 1px solid;
            border-top: 0px;
            font-size: 12px;
        }

        .tabel5 tr {
            border: 1px solid black;
        }

        .tabel6 {

            width: 100%;
            border: 1px solid;
            border-top: 0px;
            font-size: 12px;
        }

        .tabel6 tr {
            border: 1px solid black;
        }

        .card-body {
            font-family: Arial, Helvetica, sans-serif;
        }


        .judul {
            font-weight: bolder;
            font-size: 20px;

        }

        .column {
            float: left;
            width: 50%;
        }

        /* Clear floats after the columns */
        .row:after {
            content: "";
            display: table;
            clear: both;
        }

        .perlengkapan {
            border-bottom: 1px;
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

            <br>

            <div class="row">
                <div class="column">
                    <table class="tabel" style="width:100%">
                        <tr>
                            <td>Nama Pengirim</td>
                            <td>{{ $berita_acara->kirim->nama_pengirim }}</td>
                        </tr>
                        <tr>
                            <td>Nama Penerima</td>
                            <td>{{ $berita_acara->nama_penerima }}</td>
                        </tr>
                        <tr>
                            <td>Type/Merk</td>
                            <td>{{ $berita_acara->merk_type }}</td>
                        </tr>
                        <tr>
                            <td>No Rangka</td>
                            <td>{{ $berita_acara->no_rangka }}</td>
                        </tr>
                        <tr>
                            <td>No Mesin</td>
                            <td>{{ $berita_acara->no_mesin }}</td>
                        </tr>
                        <tr>
                            <td>Warna</td>
                            <td>{{ $berita_acara->warna }}</td>
                        </tr>
                        <tr>
                            <td>No Polisi</td>
                            <td>{{ $berita_acara->no_polisi }}</td>
                        </tr>
                        <tr>
                            <td>Rute Pengiriman</td>
                            <td>{{ $berita_acara->antar->rute_asal }} - {{ $berita_acara->antar->rute_tujuan }}</td>
                        </tr>
                        <tr>
                            <td>Nama Kapal</td>
                            <td>{{ $berita_acara->nama_kapal }}</td>
                        </tr>
                        <tr>
                            <td>Jenis Pengiriman</td>
                            <td>{{ $berita_acara->antar->jenis->nama_layanan }} </td>
                        </tr>
                    </table>
                </div>
                <div class="column">

                    <table class="tabel2" style="width: 100%">
                        <tr>
                            <td>Keterangan</td>
                            <td>{{ $berita_acara->keterangan }} </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                        </tr>
                    </table>
                </div>
            </div>

            <div class="row">
                <div class="column">
                    <table class="tabel3" style="width: 100%">
                        <tr>
                            <td style="text-align: center">Perlengkapan</td>
                            <td style="text-align: center">Ada</td>
                            <td style="text-align: center">Tidak Ada</td>
                        </tr>
                        <tr>
                            <td>Sabuk Pengaman</td>
                            <td style="text-align: center"><input type="checkbox"></td>
                            <td style="text-align: center"><input type="checkbox"></td>
                        </tr>
                        <tr>
                            <td>Ligther</td>
                            <td style="text-align: center"><input type="checkbox"></td>
                            <td style="text-align: center"><input type="checkbox"></td>
                        </tr>
                        <tr>
                            <td>Dongkrak + Slang</td>
                            <td style="text-align: center"><input type="checkbox"></td>
                            <td style="text-align: center"><input type="checkbox"></td>
                        </tr>
                        <tr>
                            <td>Ban Serep</td>
                            <td style="text-align: center"><input type="checkbox"></td>
                            <td style="text-align: center"><input type="checkbox"></td>
                        </tr>
                        <tr>
                            <td>Karpet</td>
                            <td style="text-align: center"><input type="checkbox"></td>
                            <td style="text-align: center"><input type="checkbox"></td>
                        </tr>
                        <tr>
                            <td>Buku Petunjuk</td>
                            <td style="text-align: center"><input type="checkbox"></td>
                            <td style="text-align: center"><input type="checkbox"></td>
                        </tr>
                        <tr>
                            <td>Tool Kit</td>
                            <td style="text-align: center"><input type="checkbox"></td>
                            <td style="text-align: center"><input type="checkbox"></td>
                        </tr>
                        <tr>
                            <td>Cat</td>
                            <td style="text-align: center"><input type="checkbox"></td>
                            <td style="text-align: center"><input type="checkbox"></td>
                        </tr>
                        <tr>
                            <td>Radio + Tape + Antena</td>
                            <td style="text-align: center"><input type="checkbox"></td>
                            <td style="text-align: center"><input type="checkbox"></td>
                        </tr>
                        <tr>
                            <td>Wheeldop/dop ban</td>
                            <td style="text-align: center"><input type="checkbox"></td>
                            <td style="text-align: center"><input type="checkbox"></td>
                        </tr>
                        <tr>
                            <td>Buku Service</td>
                            <td style="text-align: center"><input type="checkbox"></td>
                            <td style="text-align: center"><input type="checkbox"></td>
                        </tr>
                    </table>
                </div>

                <div class="column">
                    <table class="tabel4" width="100%">
                        <tr>
                            <td style="text-align: center">Perlengkapan</td>
                            <td style="text-align: center">Ada</td>
                            <td style="text-align: center">Tidak Ada</td>
                        </tr>
                        <tr>
                            <td>Kunci Ban Serep</td>
                            <td style="text-align: center"><input type="checkbox"></td>
                            <td style="text-align: center"><input type="checkbox"></td>
                        </tr>
                        <tr>
                            <td>Emblem</td>
                            <td style="text-align: center"><input type="checkbox"></td>
                            <td style="text-align: center"><input type="checkbox"></td>
                        </tr>
                        <tr>
                            <td>Stiker</td>
                            <td style="text-align: center"><input type="checkbox"></td>
                            <td style="text-align: center"><input type="checkbox"></td>
                        </tr>
                        <tr>
                            <td>Pengamanan</td>
                            <td style="text-align: center"><input type="checkbox"></td>
                            <td style="text-align: center"><input type="checkbox"></td>
                        </tr>
                        <tr>
                            <td>Lampu Kabut</td>
                            <td style="text-align: center"><input type="checkbox"></td>
                            <td style="text-align: center"><input type="checkbox"></td>
                        </tr>
                        <tr>
                            <td>Air Conditioner</td>
                            <td style="text-align: center"><input type="checkbox"></td>
                            <td style="text-align: center"><input type="checkbox"></td>
                        </tr>
                        <tr>
                            <td>Plazer</td>
                            <td style="text-align: center"><input type="checkbox"></td>
                            <td style="text-align: center"><input type="checkbox"></td>
                        </tr>
                        <tr>
                            <td>Wifer</td>
                            <td style="text-align: center"><input type="checkbox"></td>
                            <td style="text-align: center"><input type="checkbox"></td>
                        </tr>
                        <tr>
                            <td>Kaca Spion</td>
                            <td style="text-align: center"><input type="checkbox"></td>
                            <td style="text-align: center"><input type="checkbox"></td>
                        </tr>
                        <tr>
                            <td>Stang Mica</td>
                            <td style="text-align: center"><input type="checkbox"></td>
                            <td style="text-align: center"><input type="checkbox"></td>
                        </tr>
                        <tr>
                            <td>Loud Speaker</td>
                            <td style="text-align: center"><input type="checkbox"></td>
                            <td style="text-align: center"><input type="checkbox"></td>
                        </tr>
                    </table>
                </div>
            </div>

            <table class="tabel5">
                <tr style="text-align: center">
                    <td>Pengirim <br><br><br><br><br><br><br><br><br><br>................................</td>
                    <td>CV. ARSA JAYA MANDIRI <br><br><br><br><br><br><br><br><br><br>................................
                    </td>
                    <td>Penerima <br><br><br><br><br><br><br><br><br><br>................................</td>
                </tr>
            </table>

            <table class="tabel6">
                <tr>
                    <td>Perhatian:</td>
                </tr>
                <tr>
                    <td>a. Tidak menerima dalam barang yang disalurkan melalui CV. AJM</td>
                </tr>
                <tr>
                    <td>b. Tidak memberi pengganti untuk kehilangan dan kerugian disebabkan forcemajeur, kebakaran,
                        perampokan, bencana alam, dsb</td>
                </tr>
                <tr>
                    <td>c. Barang-barang yang bisa pecah karena di-packing kurang baik, bocor, dll, di luar tanggung
                        jawab
                        kami</td>
                </tr>
                <tr>
                    <td>d. Tanda terima ini bukan sebagai kwintansi penagihan pengiriman. Pelanggan diwajibkan
                        menyetujui
                        syarat-syarat yang ada pada berita acara pengiriman</td>
                </tr>
            </table>





        </div>
    </div>


</body>

</html>
