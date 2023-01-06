@extends('layouts.app')
@section('title', 'Detail Transaksi')
@section('breadcrumb')
    @parent
    <li class="breadcrumb-item"><a href="/pengiriman">Pengiriman</a></li>
    <li class="breadcrumb-item active">Detail Transaksi</li>
@endsection
@push('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
@endpush

@section('content')

    <!-- Main row -->
    <!-- Left col -->

    @if (auth()->user()->level != 'pelanggan')
        <div class="card">
            <div class="card-header">
                <a href="/pengiriman" class="btn btn-xs btn-danger"><i class="fa fa-arrow-left"></i>
                    Kembali</a>
                <a href="/pengiriman/cetak_tagihan/{{ $pengiriman->id }}" class="btn btn-xs btn-success" target="_blank"><i
                        class="fa fa-print"></i>
                    Cetak Tagihan</a>
                @if (auth()->user()->level == 'koordinator' || auth()->user()->level == 'staff')
                    <button class="btn btn-info btn-xs" onclick="show({{ $pengiriman->id }})"><i class="fa fa-check"></i>
                        Verifikasi Pengiriman</button>
                @endif



            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <table class="table ">
                            <thead>
                                <tr>
                                    <th style="text-align: center" colspan="3">Invoice</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>No. Invoice</td>
                                    <td>{{ $pengiriman->noinvoice }}</td>
                                </tr>
                                <tr>
                                    <td>Tanggal</td>
                                    <td>{{ Carbon\carbon::parse($pengiriman->tanggal)->translatedFormat('d-m-Y') }}</td>
                                </tr>
                                <tr>
                                    <td>Status Pengiriman</td>
                                    <td>
                                        @if ($pengiriman->status_pengiriman == 'Selesai')
                                            <button class="btn btn-xs btn-success">Selesai</button>
                                        @elseif($pengiriman->status_pengiriman == 'OTW')
                                            <button class="btn btn-xs btn-info">OTW</button>
                                        @elseif($pengiriman->status_pengiriman == 'Pembayaran Ditolak')
                                            <button class="btn btn-xs btn-danger">Pembayaran Ditolak</button>
                                        @elseif($pengiriman->status_pengiriman == 'Pembayaran Diverifikasi')
                                            <button class="btn btn-xs btn-secondary">Pembayaran
                                                Diverifikasi</button>
                                        @elseif($pengiriman->status_pengiriman == 'Menunggu Pembayaran')
                                            <button class="btn btn-xs btn-warning">Menunggu Pembayaran</button>
                                        @else
                                            <button class="btn btn-xs btn-danger">Diproses</button>
                                        @endif
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-8">
                        <table class="table ">
                            <tr>
                                <td>Kepada</td>
                                <td>{{ $pengiriman->nama_pengirim }}</td>
                            </tr>
                            <tr>
                                <td>Alamat</td>
                                <td>{{ $pengiriman->alamat_pengirim }}</td>
                            </tr>
                            <tr>
                                <td>Telepon</td>
                                <td>{{ $pengiriman->telepon_pengirim }}</td>
                            </tr>
                        </table>
                    </div>
                </div>

                <table class="table ">
                    <thead style="text-align: center">
                        <tr>
                            <th colspan="4">Keterangan</th>
                            <th colspan="2">Jumlah(Rp)</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pengiriman->detail as $item)
                            <tr>
                                <td colspan="4" style="text-align: left">
                                    <b> Pengiriman Unit kepada {{ $item->nama_penerima }} ({{ $item->antar->rute_asal }} -
                                        {{ $item->antar->rute_tujuan }})
                                    </b>
                                    <br>
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
                                    Keterangan: {{ $item->keterangan }} <br>
                                    @if (auth()->user()->level != 'owner')
                                        <a href="/pengiriman/berita_acara/{{ $item->id }}"
                                            class="btn btn-xs btn-primary" target="_blank"><i class="fa fa-print"></i> Cetak
                                            Berita
                                            Acara Pengiriman</a>
                                    @endif
                                </td>
                                <td colspan="2" style="text-align: right">
                                    <br><br><br><br><br><br><br><br><br>
                                    @currency($item->biaya_kirim) <br>
                                    @currency($item->biaya_koordinasi) <br>
                                    @currency($item->biaya_tambahan) <br>
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
                            <td colspan="2" style="text-align: right"><b>@currency($pengiriman->total_biaya_keseluruhan)</b></td>
                        </tr>
                        <tr>
                            <td colspan="6" style="text-align: right"><b>Terbilang:
                                    {{ terbilang($pengiriman->total_biaya_keseluruhan) }} Rupiah</b>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="6"><small>Pembayaran dapat melalui Rek. BCA 8275028165 a/n Andry</small></td>
                        </tr>

                    </tbody>
                </table>

            </div>
        </div>

        {{-- PELANGGAN --}}
    @else
        <div class="card">
            <div class="card-header">
                <a href="/pengiriman" class="btn btn-xs btn-danger"><i class="fa fa-arrow-left"></i>
                    Kembali</a>
                @if ($pengiriman->status_pengiriman != 'Diproses')
                    <a href="/pengiriman/cetak_tagihan/{{ $pengiriman->id }}" class="btn btn-xs btn-success"
                        target="_blank"><i class="fa fa-print"></i>
                        Cetak Tagihan</a>
                @endif
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <table class="table ">
                            <thead>
                                <tr>
                                    <th style="text-align: center" colspan="3">Invoice</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>No. Invoice</td>
                                    <td>{{ $pengiriman->noinvoice }}</td>
                                </tr>
                                <tr>
                                    <td>Tanggal</td>
                                    <td>{{ Carbon\carbon::parse($pengiriman->tanggal)->translatedFormat('d-m-Y') }}</td>
                                </tr>
                                <tr>
                                    <td>Status Pengiriman</td>
                                    <td>
                                        @if ($pengiriman->status_pengiriman == 'Selesai')
                                            <button class="btn btn-xs btn-success">Selesai</button>
                                        @elseif($pengiriman->status_pengiriman == 'OTW')
                                            <button class="btn btn-xs btn-info">OTW</button>
                                        @elseif($pengiriman->status_pengiriman == 'Pembayaran Ditolak')
                                            <button class="btn btn-xs btn-danger">Pembayaran Ditolak</button>
                                        @elseif($pengiriman->status_pengiriman == 'Pembayaran Diverifikasi')
                                            <button class="btn btn-xs btn-secondary">Pembayaran
                                                Diverifikasi</button>
                                        @elseif($pengiriman->status_pengiriman == 'Menunggu Pembayaran')
                                            <button class="btn btn-xs btn-warning">Menunggu Pembayaran</button>
                                        @else
                                            <button class="btn btn-xs btn-danger">Diproses</button>
                                        @endif
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-8">
                        <table class="table ">
                            <tr>
                                <td>Kepada</td>
                                <td>{{ $pengiriman->nama_pengirim }}</td>
                            </tr>
                            <tr>
                                <td>Alamat</td>
                                <td>{{ $pengiriman->alamat_pengirim }}</td>
                            </tr>
                            <tr>
                                <td>Telepon</td>
                                <td>{{ $pengiriman->telepon_pengirim }}</td>
                            </tr>
                        </table>
                    </div>
                </div>

                @if ($pengiriman->status_pengiriman == 'Diproses')
                    <table class="table ">
                        <thead style="text-align: center">
                            <tr>
                                <th colspan="4">Keterangan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pengiriman->detail as $item)
                                <tr>
                                    <td colspan="4" style="text-align: left">
                                        <b> Pengiriman Unit kepada {{ $item->nama_penerima }}
                                            ({{ $item->antar->rute_asal }} -
                                            {{ $item->antar->rute_tujuan }})
                                        </b>
                                        <br>
                                        Jenis Pengiriman: {{ $item->antar->jenis->nama_layanan }} <br>
                                        Alamat Penerima: {{ $item->alamat_penerima }} <br>
                                        Telepon Penerima: {{ $item->telepon_penerima }} <br>
                                        Nama Kapal: {{ $item->nama_kapal ?? '-' }} <br>
                                        Unit: {{ $item->merk_type }} ({{ $item->warna }}) <br>
                                        No. Polisi: {{ $item->no_polisi ?? '-' }} <br>
                                        No. Rangka: {{ $item->no_rangka }} <br>
                                        No. Mesin: {{ $item->no_mesin }} <br>
                                    </td>
                                </tr>
                            @endforeach


                        </tbody>
                    </table>
                @else
                    <table class="table ">
                        <thead style="text-align: center">
                            <tr>
                                <th colspan="4">Keterangan</th>
                                <th colspan="2">Jumlah(Rp)</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pengiriman->detail as $item)
                                <tr>
                                    <td colspan="4" style="text-align: left">
                                        <b> Pengiriman Unit kepada {{ $item->nama_penerima }}
                                            ({{ $item->antar->rute_asal }} -
                                            {{ $item->antar->rute_tujuan }})
                                        </b>
                                        <br>
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
                                        Keterangan: {{ $item->keterangan }} <br>
                                        @if (auth()->user()->level != 'owner')
                                            <a href="/pengiriman/berita_acara/{{ $item->id }}"
                                                class="btn btn-xs btn-primary" target="_blank"><i class="fa fa-print"></i>
                                                Cetak Berita
                                                Acara Pengiriman</a>
                                        @endif
                                    </td>
                                    <td colspan="2" style="text-align: right">
                                        <br><br><br><br><br><br><br><br><br>
                                        @currency($item->biaya_kirim) <br>
                                        @currency($item->biaya_koordinasi) <br>
                                        @currency($item->biaya_tambahan) <br>
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
                                <td colspan="2" style="text-align: right"><b>@currency($pengiriman->total_biaya_keseluruhan)</b></td>
                            </tr>
                            <tr>
                                <td colspan="6" style="text-align: right"><b>Terbilang:
                                        {{ terbilang($pengiriman->total_biaya_keseluruhan) }} Rupiah</b>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="6"><small>Pembayaran dapat melalui Rek. BCA 8275028165 a/n Andry</small>
                                </td>
                            </tr>

                        </tbody>
                    </table>
                @endif

            </div>
        </div>
    @endif

    <!-- /.row (main row) -->

    <!-- Modal -->
    <div class="modal" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ubah Status Pengiriman</h5>
                    <a href="#" class="close" data-dismiss="modal" aria-label="close">&times;</a>
                </div>
                <div class="modal-body">
                    <div id="page"></div>
                </div>
            </div>
        </div>
    </div>





@endsection

@push('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

    <script>
        function show(id) {
            $.get("{{ url('show') }}/" + id, {}, function(data, status) {
                $("#exampleModalLabel").html('Ubah Status Pengiriman')
                $("#page").html(data);
                $("#exampleModal").modal('show');
            });
        }

        // untuk proses update data
        function update(id) {
            var status_pengiriman = $("#status_pengiriman").val();

            $.ajax({
                type: "get",
                url: "{{ url('status_pengiriman') }}/" + id,
                data: "status_pengiriman=" + status_pengiriman,
                success: function(data) {
                    window.location.reload();
                    toastr.success(data.success);
                }
            });
        }
    </script>
    <x-toast />
@endpush
