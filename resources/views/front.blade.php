<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CV. ARSA JAYA MANDIRI</title>
    <link href="{{ asset('haldep/img/logo-ajm.png') }}" rel="icon">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="//cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="{{ asset('haldep/style.css') }}">
</head>

<body>
    <!-- navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary py-3" id="navbar_top">
        <div class="container">
            <a class="navbar-brand" href="#">CV. ARSA JAYA MANDIRI</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="#home" style="color: white;">Beranda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#tentang-kami" style="color: white;">Tentang Kami</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#layanan" style="color: white;">Layanan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#biaya-pengiriman" style="color: white;">Biaya Pengiriman</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#syarat-ketentuan" style="color: white;">Syarat & Ketentuan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#kontak" style="color: white;">Kontak</a>
                    </li>
                    @if (auth()->user())
                        <li class="nav-item">
                            <a class="nav-link" href="/dashboard" style="color: white;">Dashboard</a>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link" href="/login" style="color: white;">Login/Register</a>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>
    <!-- navbar end -->

    <!-- start hero -->
    <section class="bg-primary text-light p-5 text-center text-sm-start" id="home">
        <div class="container py-5">
            <div class="d-sm-flex align-items-center justify-content-between py-5">
                <div>
                    <h1><span class="text-warning">{{ $informasi_perusahaan->nama_perusahaan }}</span> </h1>
                    <h5 class="my-4">Jasa Pengiriman Sepeda Motor, Mobil, Truk, dan Alat Berat <br> <span
                            class="text-warning"> Cepat, Aman, dan Terpercaya</span></h5>
                    <a href="#biaya-pengiriman" class="btn btn-success">Lihat Biaya Pengiriman</a>
                </div>
                <a href="#">
                    <img src="{{ asset('storage/informasi_perusahaan/' . $informasi_perusahaan->cover) }}"
                        class="img-fluid" width="600" alt="">
                </a>
            </div>
        </div>
    </section>
    <!-- end hero -->

    <!-- start about -->
    <section class="p-2" id="tentang-kami">
        <div class="container py-5">
            <h2 class="text-center mb-4">Tentang Kami</h2>
            <div class="card">
                {{-- <div class="row justify-content-between align-items-center">
                    <div class="col-md-5">
                        <img src="{{ asset('haldep/img/logo-ajm.png') }}" class="img-circle img-fluid" alt="">
                    </div>
                    <div class="col-md-7">
                        <h2>CV. ARSA JAYA MANDIRI</h2>
                        <p style="text-align: justify;">CV. Arsa Jaya mandiri merupakan sebuah perusahaan ekspedisi
                            pengiriman kendaraan bermotor hingga alat berat yang melayani pengiriman mobil, sepeda
                            motor,
                            truk, compactor bomag, bulldozer, forklif, motor graders, ekskavator, wheel loader, backhoe
                            loader, vibro, dan lain-lain. CV. Arsa Jaya Mandiri melayani pengiriman untuk seluruh daerah
                            di pulau
                            Kalimantan,
                            pengiriman dari Jakarta ke daerah-daerah di Pulau Kalimantan, dan pengiriman ke Jakarta
                            sejak tahun 2016.
                            Perusahaan ini berlokasi di kota Banjarmasin, provinsi Kalimantan Selatan. </p>
                    </div>
                </div> --}}
                <div class="row">
                    <div class="col-md-7 px-5 mt-3">
                        <h1 class="mb-4">{{ $informasi_perusahaan->nama_perusahaan }}</h1>
                        <p style="text-align: justify">{{ $informasi_perusahaan->deskripsi_perusahaan }}</p>
                    </div>
                    <div class="col-md-5 py-4">
                        <div class="row" style="text-align: center">
                            <div class="col-sm-2">
                                <i class="fa-solid fa-motorcycle"></i>
                            </div>
                            <div class="col-sm-10">
                                <h4>Sepeda Motor</h4>
                            </div>

                            <div class="col-sm-2">
                                <i class="fa-solid fa-car"></i>
                            </div>
                            <div class="col-sm-10">
                                <h4>Mobil</h4>
                            </div>

                            <div class="col-sm-2">
                                <i class="fa-solid fa-truck"></i>
                            </div>
                            <div class="col-sm-10">
                                <h4>Truk</h4>
                            </div>
                            <div class="col-sm-2">
                                <i class="fas fa-tractor"></i>
                            </div>
                            <div class="col-sm-10">
                                <h4>Alat Berat</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </div>
        </div>
    </section>
    <!-- end about -->


    <!-- start service -->
    <section class="" id="layanan">
        <div class="container">
            <h2 class="text-center mb-4">Layanan</h2>
            <div class="row">
                @foreach ($jenis_pengiriman as $jen)
                    <div class="col">
                        <div class="card h-100">
                            <img src="{{ asset('storage/jenis_pengiriman/' . $jen->foto) }}" class="card-img-top"
                                alt="{{ $jen->nama_layanan }}" width="300" height="250" />
                            <div class="card-body">
                                <h5 class="card-title" style="text-align: center">{{ $jen->nama_layanan }}</h5>
                                <p class="card-text" style="text-align: justify">
                                    {{ $jen->deskripsi }}
                                </p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- end service -->



    <!-- start learn -->
    <div class="p-5" id="biaya-pengiriman">
        <div class="containter">
            <h2 class="text-center mb-4">Biaya Pengiriman</h2>
            <h6 class="text-center mb-4">Biaya pengiriman merupakan biaya yang harus dibayarkan pelanggan untuk setiap
                pengiriman unit sesuai dengan jenis unit dan rute pengantaran. Untuk memperjelas cakupan jenis unit,
                dapat membaca bagian Syarat & Ketentuan. <br><br>
                <a href="#syarat-ketentuan" class="btn btn-sm btn-success">Baca Syarat & Ketentuan</a>
            </h6>
            <div class="card table-responsive">
                <div class="card-body">
                    <table class="table table-striped table-responsive" id="myTable">
                        <thead>
                            <th width="5%">No</th>
                            <th style="text-align: center">Nama Unit</th>
                            <th style="text-align: center">Rute Asal</th>
                            <th style="text-align: center">Rute Tujuan</th>
                            <th style="text-align: center">Jenis</th>
                            <th style="text-align: center">Biaya Pengiriman</th>
                        </thead>
                        <tbody>
                            @foreach ($biaya_pengiriman as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td style="text-align: center">{{ $item->unit->nama }}</td>
                                    <td style="text-align: center">{{ $item->rute_asal }}</td>
                                    <td style="text-align: center">{{ $item->rute_tujuan }}</td>
                                    <td style="text-align: center">{{ $item->jenis->nama_layanan }}</td>
                                    <td style="text-align: center">@currency($item->biaya_pengiriman)</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
    <!-- end learn -->

    <!-- start Q & A -->
    <section id="syarat-ketentuan">
        <div class="container py-5">
            <h2 class="text-center mb-4">Syarat & Ketentuan</h2>
            <div class="accordion accordion-flush" id="accordionFlushExample">
                @foreach ($syarat_ketentuan as $syarat)
                    @php
                        $flush_heading = $loop->iteration;
                        $flush_bs_target = $loop->iteration;
                        $flush_arial_controls = $loop->iteration;
                        $flush_id = $loop->iteration;
                        $flush_aria_labelledby = $loop->iteration;
                    @endphp
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="flush-heading{{ $flush_heading }}">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#flush-collapse{{ $flush_bs_target }}" aria-expanded="false"
                                aria-controls="flush-collapse{{ $flush_arial_controls }}">
                                {{ $syarat->judul }}
                            </button>
                        </h2>
                        <div id="flush-collapse{{ $flush_id }}" class="accordion-collapse collapse"
                            aria-labelledby="flush-heading{{ $flush_aria_labelledby }}"
                            data-bs-parent="#accordionFlushExample">
                            <div class="accordion-body" style="text-align: justify">
                                {!! $syarat->isi !!}
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- end Q & A -->



    <!-- start footer -->
    <footer class="bg-primary text-white page-footer text-md-left" id="kontak">
        <div class="container py-5">
            <div class="row g-4">
                <div class="col-lg-6">
                    <h5 class="text-uppercase font-weight-bold mb-4">
                        CV. ARSA JAYA MANDIRI
                    </h5>
                    <p>Menawarkan Jasa Pengantaran Kendaraan & Alat Berat yang Aman dan Terpercaya.</p>
                </div>
                <div class="col-lg-6  location">
                    <h5 class="text-uppercase font-weight-bold mb-4">Kontak</h5>
                    <p class="d-flex align-items-center">
                        <i class="bi bi-geo-alt text-white mx-2 lead"></i>
                        {{ $informasi_perusahaan->alamat_perusahaan }}
                    </p>
                    <p class="d-flex align-items-center">
                        <i class="bi bi-phone text-white mx-2 lead"></i>
                        {{ $informasi_perusahaan->telepon_perusahaan }}
                    </p>
                    <p class="d-flex align-items-center">
                        <i class="bi bi-envelope text-white mx-2 lead"></i>
                        {{ $informasi_perusahaan->email_perusahaan }}
                    </p>
                </div>
            </div>
        </div>
    </footer>
    <!-- end footer -->

    <!-- start copyright -->
    <footer class="p-3 bg-primary text-white text-center position-relative">
        <div class="container">
            <p class="mb-0">
                Copyright &copy; {{ date('Y') }} CV. ARSA JAYA MANDIRI
            </p>
            <a href="#" class="position-absolute bottom-0 end-0 p-5">
                <i class="bi bi-arrow-up-circle h1"></i>
            </a>
        </div>
    </footer>
    <!-- end  copyright -->
    <script src="https://kit.fontawesome.com/88ae52f9fb.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
        crossorigin="anonymous"></script>
    <script src="//cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>

    <script>
        $(document).on('click', 'ul li', function() {
            $(this).addClass('active').siblings().removeClass('active')
        });

        $(document).ready(function() {
            $('#myTable').DataTable();
        });

        document.addEventListener("DOMContentLoaded", function() {
            window.addEventListener('scroll', function() {
                if (window.scrollY > 50) {
                    document.getElementById('navbar_top').classList.add('fixed-top');
                    // add padding top to show content behind navbar
                    navbar_height = document.querySelector('.navbar').offsetHeight;
                    document.body.style.paddingTop = navbar_height + 'px';
                } else {
                    document.getElementById('navbar_top').classList.remove('fixed-top');
                    // remove padding top from body
                    document.body.style.paddingTop = '0';
                }
            });
        });
    </script>
</body>

</html>
