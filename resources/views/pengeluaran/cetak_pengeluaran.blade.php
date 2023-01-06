<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">



    <title>ARSA APP | Cetak Laporan Pengeluaran</title>
    <link href="{{ asset('haldep/img/logo-ajm.png') }}" rel="icon">
</head>

<body style="background-color: white" onload="window.print()">
    <style>
        .tabel {
            margin-top: 30px;
            width: 100%;
            border-collapse: collapse;
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
                            Laporan Pengeluaran <br>
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
                    <th>Keterangan</th>
                    <th>Jumlah</th>
                </tr>
                @if ($totalpengeluaran == 0)
                    <tr>
                        <td colspan="5">
                            <center><b>Tidak ada pengeluaran pada periode
                                    {{ Carbon\carbon::parse($tanggal_awal)->translatedFormat('d-m-Y') }} s/d
                                    {{ Carbon\carbon::parse($tanggal_akhir)->translatedFormat('d-m-Y') }}</b></center>
                        </td>
                    </tr>
                @else
                    @foreach ($pengeluaran as $item)
                        <tr>
                            <td style="text-align: center">{{ $loop->iteration }}</td>
                            <td style="text-align: center">
                                {{ Carbon\carbon::parse($item->tanggal)->translatedFormat('d-m-Y') }}
                            </td>
                            <td style="text-align: center">{{ $item->keterangan }}</td>
                            <td style="text-align: right">@currency($item->jumlah)</td>
                        </tr>
                    @endforeach
                    <tr>
                        <td colspan="3" style="text-align: center"><b>Total Pengeluaran</b></td>
                        <td style="text-align: right"><b>@currency($totalpengeluaran)</b></td>
                    </tr>
                @endif
            </table>

        </div>


    </div>







    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>
</body>

</html>
