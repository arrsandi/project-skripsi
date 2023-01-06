@extends('layouts.app')
@section('title', 'Dashboard')
@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Dashboard</li>
@endsection

@section('content')
    <!-- Small boxes (Stat box) -->
    <!-- Small boxes (Stat box) -->
    @if (auth()->user()->level == 'pelanggan')
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    Selamat Datang, <b>{{ auth()->user()->name }}!</b> <br>
                </h3>
            </div><!-- /.card-header -->
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="">
                            <p>Untuk melakukan transaksi pengiriman, silakan masuk ke menu Transaksi Pengiriman.</p>
                            <p>Tata Cara Input Pengiriman</p>
                            <ol>
                                <li>Silakan isi data-data penerima unit terlebih dahulu dengan benar</li>
                                <li>Jika sudah diisi, silakan tekan tombol tambah</li>
                                <li>Jika ingin menambah unit yg akan dikirimkan (ke penerima yg sama), isi kembali informasi
                                    penerima</li>
                                <li>Periksa data-data dengan benar</li>
                                <li>Setelah itu, silakan isi data pengirim unit</li>
                                <li>Tekan tombol <b>SIMPAN TRANSAKSI</b> untuk menyimpan transaksi</li>
                            </ol>

                            <br>
                            <p>Tata Cara Pembayaran</p>
                            <ol>
                                <li>Lakukan pembayaran saat tombol cetak tagihan sudah muncul! atau status pengiriman
                                    <b>"MENUNGGU
                                        PEMBAYARAN"</b>
                                </li>
                                <li>Jumlah yang dibayarkan sesuai yang ada pada <b>TAGIHAN</b></li>
                                <li>Lakukan pembayaran ke rekening yang tertera pada <b>TAGIHAN</b> atau bisa dilakukan
                                    secara
                                    tunai
                                    ke CV. Arsa Jaya Mandiri (Pak Andry)</li>
                            </ol>






                        </div>

                    </div>
                    <div class="col-md-6">
                        <h5>Statistik Pengiriman Pengiriman</h5>
                        <div id="jumlah-pengiriman-pelanggan">
                            {!! $chart7->renderHtml() !!}
                        </div>
                    </div>
                </div>



            </div><!-- /.card-body -->
        </div>
    @else
        <div class="row">

            <!-- ./col -->
            <div class="col-lg-6">
                <!-- small box -->
                <div class="small-box bg-success">
                    <div class="inner">
                        <h3>@currency($pengiriman)</h3>

                        <p>Pemasukan</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-cash"></i>
                    </div>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-6">
                <!-- small box -->
                <div class="small-box bg-danger">
                    <div class="inner">
                        <h3>@currency($pengeluaran)</h3>

                        <p>Pengeluaran</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-cash"></i>
                    </div>
                </div>
            </div>
            <!-- ./col -->
        </div>
        <div class="row">
            <!-- Left col -->
            <section class="col-lg-12 connectedSortable">
                <!-- Custom tabs (Charts with tabs)-->
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">
                            Selamat Datang, <b>{{ auth()->user()->name }}!</b> <br>
                        </h3>
                    </div><!-- /.card-header -->
                    <div class="card-body">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div id="total-pendepatan-tahunan">
                                        {!! $chart1->renderHtml() !!}
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div id="total-pendapatan-bulanan">
                                        {!! $chart2->renderHtml() !!}
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div id="jumlah-pengiriman-tahunan">
                                        {!! $chart3->renderHtml() !!}
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div id="jumlah-pengiriman-bulanan">
                                        {!! $chart4->renderHtml() !!}
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div id="jumlah-pengiriman-tahunan">
                                        {!! $chart5->renderHtml() !!}
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div id="jumlah-pengiriman-bulanan">
                                        {!! $chart6->renderHtml() !!}
                                    </div>
                                </div>
                            </div>




                        </div>


                    </div><!-- /.card-body -->
                </div>
                <!-- /.card -->




            </section>
        </div>
    @endif
    <!-- /.row (main row) -->

@endsection

@push('script')
    {!! $chart1->renderChartJsLibrary() !!}

    {!! $chart1->renderJs() !!}
    {!! $chart2->renderJs() !!}
    {!! $chart3->renderJs() !!}
    {!! $chart4->renderJs() !!}
    {!! $chart5->renderJs() !!}
    {!! $chart6->renderJs() !!}
    {!! $chart7->renderJs() !!}

    <script>
        $(document).ready(function() {
            $('#myTable').DataTable();
            //event : delete 
        });
    </script>
    <!-- AdminLTE for demo purposes -->
    <script src="{{ asset('adminlte/dist/js/demo.js') }}"></script>
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="{{ asset('adminlte/dist/js/pages/dashboard.js') }}"></script>
@endpush
