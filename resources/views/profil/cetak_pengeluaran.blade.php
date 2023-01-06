<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>ARSA APP | Cetak Laporan Pengeluaran</title>
</head>

<body style="background-color: white" onload="window.print()">
    <style>
        .line-title {
            border: 0;
            border-style: inset;
            border-top: 1px solid #000;
        }

    </style>
    <div class="row">
        <div class="col-md-12">
            <div class="card-body">
                <table style="width: 100%">
                    <tr>
                        <td align="center">
                            <span style="line-height: 1.6; font-weight:bold;">
                                CV. ARSA JAYA MANDIRI <br>
                                LAPORAN PENGELUARAN <br>
                                Periode {{ Carbon\carbon::parse($tanggal_awal)->translatedFormat('d F Y') }} s/d
                                {{ Carbon\carbon::parse($tanggal_akhir)->translatedFormat('d F Y') }}
                            </span>
                        </td>
                    </tr>
                </table>
                <hr class="line-title">
                </hr>

                <table class="table table-bordered">
                    <tr style="text-align: center">
                        <th>No</th>
                        <th>Tanggal</th>
                        <th>Keterangan</th>
                        <th>Nominal</th>
                    </tr>
                    @if ($totalpengeluaran == 0)
                        <tr>
                            <td colspan="4">
                                <center><b>Data tidak ada pada periode tersebut!</b></center>
                            </td>
                        </tr>
                    @else
                        @foreach ($pengeluaran as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td> {{ Carbon\carbon::parse($item->tanggal)->translatedFormat('l, d F Y') }}</td>
                                <td>{{ $item->keterangan }}</td>
                                <td style="text-align: right">Rp{{ number_format($item->nominal) }}</td>
                            </tr>
                        @endforeach
                        <tr>
                            <td colspan="3" style="text-align: center">Total Pengeluaran</td>
                            <td style="text-align: right">Rp{{ number_format($totalpengeluaran) }}</td>
                        </tr>
                    @endif
                </table>

            </div>
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
