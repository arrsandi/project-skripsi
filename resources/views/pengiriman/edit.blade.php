@extends('layouts.app')
@section('title', 'Transaksi Pengiriman')
@section('breadcrumb')
    @parent
    <li class="breadcrumb-item"><a href="/pengiriman">Transaksi Pengiriman</a></li>
    <li class="breadcrumb-item active">Edit</li>
@endsection

@section('content')

    <!-- Main row -->
    @if (auth()->user()->level != 'pelanggan')
        <div class="row">
            <div class="col-md-5">
                <div class="card">
                    <div class="card-header">
                        Detail Transaksi </b>
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Keterangan Penerima</th>
                                    <th><i class="fa fa-cog"></i></th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $total_biaya = 0;
                                @endphp
                                @foreach ($pengiriman->detail as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>
                                            <small>Nama Penerima: {{ $item->nama_penerima }}</small><br>
                                            <small>Telepon Penerima: {{ $item->telepon_penerima }}</small><br>
                                            <small>Alamat Penerima: {{ $item->alamat_penerima }}</small>
                                            <br>
                                            <small>Rute Pengiriman:
                                                {{ $item->antar->rute_asal ?? '' }} -
                                                {{ $item->antar->rute_tujuan ?? '' }}
                                            </small><br>
                                            <small>Jenis Pengiriman: {{ $item->antar->jenis->nama_layanan ?? '-' }}</small>
                                            <small>Merk/Tipe: {{ $item->merk_type }}</small><br>
                                            <small>Warna: {{ $item->warna }}</small><br>
                                            <small>No. Polisi: {{ $item->no_polisi }}</small><br>
                                            <small>No. Rangka: {{ $item->no_rangka }}</small><br>
                                            <small>No. Mesin: {{ $item->no_mesin }}</small>
                                            <br>
                                            <small>Biaya Pengiriman:
                                                @currency($item->biaya_kirim)</small><br>
                                            <small> Biaya Koordinasi: @currency($item->biaya_koordinasi)</small> <br>
                                            <small> Biaya Tambahan: @currency($item->biaya_tambahan)</small> <br>
                                            <small>Total Biaya Per Unit:
                                                <b>@currency($item->total_biaya_per_unit)</b></small><br>
                                            <small>Keterangan: {{ $item->keterangan }}</small>
                                        </td>
                                        <td>
                                            <a href="/pengiriman/edit_detail/{{ $item->id }}"
                                                class="btn btn-sm btn-primary"><i class="fa fa-edit"></i></a>
                                            @if (auth()->user()->level != 'staff' || $item->kirim->user_id == auth()->user()->id)
                                                <form role="alert" action="/pengiriman/delete_detail/{{ $item->id }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm delete"
                                                        onclick="selectItem('{{ $item->nama_penerima }}')"><i
                                                            class="fas fa-trash"></i></button>
                                                </form>
                                            @endif
                                        </td>
                                    </tr>
                                    @php
                                        $total_biaya = $item->total_biaya_per_unit + $total_biaya;
                                        
                                    @endphp
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-md-7">
                <div class="card">
                    <div class="card-header">
                        Informasi Penerima
                    </div>
                    <div class="card-body">
                        <form action="/pengiriman/store_detail" method="POST">

                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="nama_penerima">Nama Penerima</label>
                                        <input type="text"
                                            class="form-control @error('nama_penerima') is-invalid @enderror"
                                            id="nama_penerima" name="nama_penerima">
                                        @error('nama_penerima')
                                            <span class="invalid-feedback">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                        <input type="hidden" name="transaksi_id" value="{{ $pengiriman->id }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="telepon_penerima">Telepon Penerima</label>
                                        <input type="number"
                                            class="form-control @error('telepon_penerima') is-invalid @enderror"
                                            id="telepon_penerima" name="telepon_penerima"
                                            placeholder="081122334455 / 0213322344">
                                        @error('telepon_penerima')
                                            <span class="invalid-feedback">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="alamat_penerima">Alamat Penerima</label>
                                <textarea name="alamat_penerima" id="alamat_penerima"
                                    class="form-control  @error('alamat_penerima') is-invalid @enderror"></textarea>
                                @error('alamat_penerima')
                                    <span class="invalid-feedback">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                            <hr>
                            Informasi Pengiriman
                            <hr>
                            <div class="form-group">
                                <label for="biaya_pengiriman_id">Rute pengiriman</label>
                                <select class="form-control select2bs4 @error('biaya_pengiriman_id') is-invalid @enderror"
                                    id="biaya_pengiriman_id" name="biaya_pengiriman_id" style="width: 100%;">
                                    <option value="">Cari Rute pengiriman</option>
                                    @foreach ($biaya_pengiriman as $item)
                                        <option value="{{ $item->id }}">Unit:
                                            {{ $item->unit->nama }} || Rute: {{ $item->rute_asal }} -
                                            {{ $item->rute_tujuan }} || Jenis: {{ $item->jenis->nama_layanan }} || Biaya:
                                            {{ number_format($item->biaya_pengiriman) }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('biaya_pengiriman_id')
                                    <span class="invalid-feedback">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="">Nama Kapal</label>
                                <input type="text" name="nama_kapal" id="nama_kapal"
                                    class="form-control @error('nama_kapal') is-invalid @enderror">
                                @error('nama_kapal')
                                    <span class="invalid-feedback">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                            <hr>
                            Detail Unit
                            <hr>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="merk_type">Merk/Type</label>
                                        <input type="text" class="form-control @error('merk_type') is-invalid @enderror"
                                            id="merk_type" name="merk_type">
                                        @error('merk_type')
                                            <span class="invalid-feedback">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="warna">Warna</label>
                                        <input type="text" class="form-control  @error('warna') is-invalid @enderror"
                                            id="warna" name="warna">
                                        @error('warna')
                                            <span class="invalid-feedback">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="no_polisi">No. Polisi</label>
                                        <input type="text" class="form-control @error('no_polisi') is-invalid @enderror"
                                            id="no_polisi" name="no_polisi">
                                        @error('no_polisi')
                                            <span class="invalid-feedback">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="no_rangka">No. Rangka</label>
                                        <input type="text" class="form-control @error('no_rangka') is-invalid @enderror"
                                            id="no_rangka" name="no_rangka" value="{{ old('no_rangka') }}">
                                        @error('no_rangka')
                                            <span class="invalid-feedback">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="no_mesin">No. Mesin</label>
                                        <input type="text" class="form-control @error('no_mesin') is-invalid @enderror"
                                            id="no_mesin" name="no_mesin" value="{{ old('no_mesin') }}">
                                        @error('no_mesin')
                                            <span class="invalid-feedback">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <hr>
                            Detail Biaya
                            <hr>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="biaya_kirim">Biaya Pengiriman</label>
                                        <input type="number"
                                            class="form-control @error('biaya_kirim') is-invalid @enderror"
                                            id="biaya_kirim" name="biaya_kirim" value="0" readonly>
                                        @error('biaya_kirim')
                                            <span class="invalid-feedback">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="biaya_koordinasi">Biaya Koordinasi</label>
                                        <input type="number"
                                            class="form-control @error('biaya_koordinasi') is-invalid @enderror"
                                            id="biaya_koordinasi" name="biaya_koordinasi" value="0">
                                        @error('biaya_koordinasi')
                                            <span class="invalid-feedback">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="biaya_tambahan">Biaya Tambahan</label>
                                        <input type="number"
                                            class="form-control @error('biaya_tambahan') is-invalid @enderror"
                                            id="biaya_tambahan" name="biaya_tambahan" value="0">
                                        @error('biaya_tambahan')
                                            <span class="invalid-feedback">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="total_biaya_per_unit">Total Biaya Per Unit</label>
                                <input type="number"
                                    class="form-control  @error('total_biaya_per_unit') is-invalid @enderror"
                                    id="total_biaya_per_unit" name="total_biaya_per_unit" value="0" readonly>
                                @error('total_biaya_per_unit')
                                    <span class="invalid-feedback">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="">Keterangan</label>
                                <textarea name="keterangan" id="keterangan" class="form-control @error('keterangan') is-invalid @enderror"
                                    placeholder="Contoh: Lampu belakang rusak">{{ old('keterangan') }}</textarea>
                                @error('keterangan')
                                    <span class="invalid-feedback">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-success" style="float:right">Tambah</button>
                            </div>
                        </form>
                        <br>
                        <br>
                        <hr>
                        Informasi Pengirim
                        <hr>
                        <form action="/pengiriman/update/{{ $pengiriman->id }}" method="POST">
                            @method('PUT')
                            @csrf
                            <div class="form-group">
                                <label for="">Tanggal</label>
                                <input type="date" class="form-control @error('tanggal') is-invalid @enderror"
                                    id="tanggal" name="tanggal" value="{{ $pengiriman->tanggal }}">
                                @error('tanggal')
                                    <span class="invalid-feedback">
                                        {{ $message }}
                                    </span>
                                @enderror
                                <input type="hidden" name="noinvoice" id="noinvoice"
                                    value="{{ $pengiriman->noinvoice }}">

                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="nama_pengirim">Nama Pengirim</label>
                                        <input type="text"
                                            class="form-control @error('nama_pengirim') is-invalid @enderror"
                                            id="nama_pengirim" name="nama_pengirim"
                                            value="{{ $pengiriman->nama_pengirim }}">
                                        @error('nama_pengirim')
                                            <span class="invalid-feedback">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="telepon_pengirim">Telepon pengirim</label>
                                        <input type="text"
                                            class="form-control  @error('telepon_pengirim') is-invalid @enderror"
                                            id="telepon_pengirim" name="telepon_pengirim"
                                            value="{{ $pengiriman->telepon_pengirim }}"
                                            placeholder="081122334455 / 0213322344">
                                        @error('telepon_pengirim')
                                            <span class="invalid-feedback">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="">Alamat Pengirim</label>
                                <textarea name="alamat_pengirim" id="alamat_pengirim"
                                    class="form-control @error('alamat_pengirim') is-invalid @enderror">{{ $pengiriman->alamat_pengirim }}</textarea>
                                @error('alamat_pengirim')
                                    <span class="invalid-feedback">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="">Total Biaya</label>
                                <input type="number" class="form-control @error('total_biaya') is-invalid @enderror"
                                    id="total_biaya" name="total_biaya" value="{{ $total_biaya }}" readonly>
                                @error('total_biaya')
                                    <span class="invalid-feedback">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="">Potongan</label>
                                <input type="number" class="form-control @error('potongan') is-invalid @enderror"
                                    id="potongan" name="potongan" value="{{ $pengiriman->potongan }}">
                                @error('potongan')
                                    <span class="invalid-feedback">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="">Total Biaya Keseluruhan</label>
                                <input type="number"
                                    class="form-control @error('total_biaya_keseluruhan') is-invalid @enderror"
                                    id="total_biaya_keseluruhan" name="total_biaya_keseluruhan"
                                    value="{{ $total_biaya }}" readonly>
                                @error('total_biaya_keseluruhan')
                                    <span class="invalid-feedback">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-block btn-primary">Simpan Transaksi</button>
                                <a href="/pengiriman" class="btn btn-block btn-danger">Kembali</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        {{-- FORM UNTUK PELANGGAN  --}}
    @else
        <div class="row">
            <div class="col-md-5">
                <div class="card">
                    <div class="card-header">
                        Detail Transaksi </b>
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Keterangan Penerima</th>
                                    <th><i class="fa fa-cog"></i></th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $total_biaya = 0;
                                @endphp
                                @foreach ($pengiriman->detail as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>
                                            <small>Nama Penerima: {{ $item->nama_penerima }}</small><br>
                                            <small>Telepon Penerima: {{ $item->telepon_penerima }}</small><br>
                                            <small>Alamat Penerima: {{ $item->alamat_penerima }}</small>
                                            <br>
                                            <small>Rute Pengiriman:
                                                {{ $item->antar->rute_asal ?? '' }} -
                                                {{ $item->antar->rute_tujuan ?? '' }}
                                            </small><br>
                                            <small>Jenis Pengiriman: {{ $item->antar->jenis->nama_layanan ?? '-' }}</small>
                                            <small>Merk/Tipe: {{ $item->merk_type }}</small><br>
                                            <small>Warna: {{ $item->warna }}</small><br>
                                            <small>No. Polisi: {{ $item->no_polisi }}</small><br>
                                            <small>No. Rangka: {{ $item->no_rangka }}</small><br>
                                            <small>No. Mesin: {{ $item->no_mesin }}</small>
                                            <br>
                                            @if ($item->kirim->status_pengiriman != 'Diproses')
                                                <small>Biaya Pengiriman:
                                                    @currency($item->biaya_kirim)</small><br>
                                                <small> Biaya Koordinasi: @currency($item->biaya_koordinasi)</small> <br>
                                                <small> Biaya Tambahan: @currency($item->biaya_tambahan)</small> <br>
                                                <small>Total Biaya Per Unit:
                                                    <b>@currency($item->total_biaya_per_unit)</b></small><br>
                                            @endif
                                            <small>Keterangan: {{ $item->keterangan }}</small>
                                        </td>
                                        <td>
                                            <form role="alert" action="/pengiriman/delete_detail/{{ $item->id }}"
                                                method="POST">
                                                <a href="/pengiriman/edit_detail/{{ $item->id }}"
                                                    class="btn btn-sm btn-primary"><i class="fa fa-edit"></i></a>
                                                @csrf
                                                @method('DELETE')
                                                @if ($item->kirim->status_pengiriman == 'Diproses')
                                                    <button type="submit" class="btn btn-danger btn-sm delete"
                                                        onclick="selectItem('{{ $item->nama_penerima }}')"><i
                                                            class="fas fa-trash"></i></button>
                                                @endif
                                            </form>
                                        </td>
                                    </tr>
                                    @php
                                        $total_biaya = $item->total_biaya_per_unit + $total_biaya;
                                        
                                    @endphp
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-md-7">
                <div class="card">
                    <div class="card-header">
                        Informasi Penerima
                    </div>
                    <div class="card-body">
                        <form action="/pengiriman/store_detail" method="POST">

                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="nama_penerima">Nama Penerima</label>
                                        <input type="text"
                                            class="form-control @error('nama_penerima') is-invalid @enderror"
                                            id="nama_penerima" name="nama_penerima">
                                        @error('nama_penerima')
                                            <span class="invalid-feedback">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                        <input type="hidden" name="transaksi_id" value="{{ $pengiriman->id }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="telepon_penerima">Telepon Penerima</label>
                                        <input type="number"
                                            class="form-control @error('telepon_penerima') is-invalid @enderror"
                                            id="telepon_penerima" name="telepon_penerima"
                                            placeholder="081122334455 / 0213322344">
                                        @error('telepon_penerima')
                                            <span class="invalid-feedback">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="alamat_penerima">Alamat Penerima</label>
                                <textarea name="alamat_penerima" id="alamat_penerima"
                                    class="form-control  @error('alamat_penerima') is-invalid @enderror"></textarea>
                                @error('alamat_penerima')
                                    <span class="invalid-feedback">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                            <hr>
                            Informasi Pengiriman
                            <hr>
                            <div class="form-group">
                                <label for="biaya_pengiriman_id">Rute pengiriman</label>
                                <select class="form-control select2bs4 @error('biaya_pengiriman_id') is-invalid @enderror"
                                    id="biaya_pengiriman_id" name="biaya_pengiriman_id" style="width: 100%;">
                                    <option value="">Cari Rute pengiriman</option>
                                    @foreach ($biaya_pengiriman as $item)
                                        <option value="{{ $item->id }}">Unit:
                                            {{ $item->unit->nama }} || Rute: {{ $item->rute_asal }} -
                                            {{ $item->rute_tujuan }} || Jenis: {{ $item->jenis->nama_layanan }} || Biaya:
                                            {{ number_format($item->biaya_pengiriman) }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('biaya_pengiriman_id')
                                    <span class="invalid-feedback">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <input type="hidden" name="nama_kapal" id="nama_kapal"
                                    class="form-control @error('nama_kapal') is-invalid @enderror">
                                @error('nama_kapal')
                                    <span class="invalid-feedback">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                            <hr>
                            Detail Unit
                            <hr>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="merk_type">Merk/Type</label>
                                        <input type="text"
                                            class="form-control @error('merk_type') is-invalid @enderror" id="merk_type"
                                            name="merk_type">
                                        @error('merk_type')
                                            <span class="invalid-feedback">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="warna">Warna</label>
                                        <input type="text" class="form-control  @error('warna') is-invalid @enderror"
                                            id="warna" name="warna">
                                        @error('warna')
                                            <span class="invalid-feedback">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="no_polisi">No. Polisi</label>
                                        <input type="text"
                                            class="form-control @error('no_polisi') is-invalid @enderror" id="no_polisi"
                                            name="no_polisi">
                                        @error('no_polisi')
                                            <span class="invalid-feedback">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="no_rangka">No. Rangka</label>
                                        <input type="text"
                                            class="form-control @error('no_rangka') is-invalid @enderror" id="no_rangka"
                                            name="no_rangka" value="{{ old('no_rangka') }}">
                                        @error('no_rangka')
                                            <span class="invalid-feedback">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="no_mesin">No. Mesin</label>
                                        <input type="text"
                                            class="form-control @error('no_mesin') is-invalid @enderror" id="no_mesin"
                                            name="no_mesin" value="{{ old('no_mesin') }}">
                                        @error('no_mesin')
                                            <span class="invalid-feedback">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <input type="hidden"
                                            class="form-control @error('biaya_kirim') is-invalid @enderror"
                                            id="biaya_kirim" name="biaya_kirim" value="0" readonly>
                                        @error('biaya_kirim')
                                            <span class="invalid-feedback">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <input type="hidden"
                                            class="form-control @error('biaya_koordinasi') is-invalid @enderror"
                                            id="biaya_koordinasi" name="biaya_koordinasi" value="0" readonly>
                                        @error('biaya_koordinasi')
                                            <span class="invalid-feedback">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <input type="hidden"
                                            class="form-control @error('biaya_tambahan') is-invalid @enderror"
                                            id="biaya_tambahan" name="biaya_tambahan" value="0" readonly>
                                        @error('biaya_tambahan')
                                            <span class="invalid-feedback">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <input type="hidden"
                                    class="form-control  @error('total_biaya_per_unit') is-invalid @enderror"
                                    id="total_biaya_per_unit" name="total_biaya_per_unit" value="0" readonly>
                                @error('total_biaya_per_unit')
                                    <span class="invalid-feedback">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="">Keterangan</label>
                                <textarea name="keterangan" id="keterangan" class="form-control @error('keterangan') is-invalid @enderror"
                                    placeholder="Contoh: Lampu belakang rusak">{{ old('keterangan') }}</textarea>
                                @error('keterangan')
                                    <span class="invalid-feedback">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                            @if ($pengiriman->status_pengiriman == 'Diproses')
                                <div class="form-group">
                                    <button type="submit" class="btn btn-success" style="float:right">Tambah</button>
                                </div>
                                <br>
                                <br>
                            @endif
                        </form>
                        <hr>
                        Informasi Pengirim
                        <hr>
                        <form action="/pengiriman/update/{{ $pengiriman->id }}" method="POST">
                            @method('PUT')
                            @csrf
                            <div class="form-group">
                                <label for="">Tanggal</label>
                                <input type="date" class="form-control @error('tanggal') is-invalid @enderror"
                                    id="tanggal" name="tanggal" value="{{ $pengiriman->tanggal }}">
                                @error('tanggal')
                                    <span class="invalid-feedback">
                                        {{ $message }}
                                    </span>
                                @enderror
                                <input type="hidden" name="noinvoice" id="noinvoice"
                                    value="{{ $pengiriman->noinvoice }}">

                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="nama_pengirim">Nama Pengirim</label>
                                        <input type="text"
                                            class="form-control @error('nama_pengirim') is-invalid @enderror"
                                            id="nama_pengirim" name="nama_pengirim"
                                            value="{{ $pengiriman->nama_pengirim }}">
                                        @error('nama_pengirim')
                                            <span class="invalid-feedback">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="telepon_pengirim">Telepon pengirim</label>
                                        <input type="text"
                                            class="form-control  @error('telepon_pengirim') is-invalid @enderror"
                                            id="telepon_pengirim" name="telepon_pengirim"
                                            value="{{ $pengiriman->telepon_pengirim }}"
                                            placeholder="081122334455 / 0213322344">
                                        @error('telepon_pengirim')
                                            <span class="invalid-feedback">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="">Alamat Pengirim</label>
                                <textarea name="alamat_pengirim" id="alamat_pengirim"
                                    class="form-control @error('alamat_pengirim') is-invalid @enderror">{{ $pengiriman->alamat_pengirim }}</textarea>
                                @error('alamat_pengirim')
                                    <span class="invalid-feedback">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                            @if ($pengiriman->status_pengiriman == 'Diproses')
                                <div class="form-group">
                                    <input type="hidden" class="form-control @error('total_biaya') is-invalid @enderror"
                                        id="total_biaya" name="total_biaya" value="{{ $total_biaya }}" readonly>
                                    @error('total_biaya')
                                        <span class="invalid-feedback">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <input type="hidden" class="form-control @error('potongan') is-invalid @enderror"
                                        id="potongan" name="potongan" value="{{ $pengiriman->potongan }}" readonly>
                                    @error('potongan')
                                        <span class="invalid-feedback">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <input type="hidden"
                                        class="form-control @error('total_biaya_keseluruhan') is-invalid @enderror"
                                        id="total_biaya_keseluruhan" name="total_biaya_keseluruhan"
                                        value="{{ $total_biaya }}" readonly>
                                    @error('total_biaya_keseluruhan')
                                        <span class="invalid-feedback">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                            @else
                                <div class="form-group">
                                    <label for="">Total Biaya</label>
                                    <input type="number" class="form-control @error('total_biaya') is-invalid @enderror"
                                        id="total_biaya" name="total_biaya" value="{{ $total_biaya }}" readonly>
                                    @error('total_biaya')
                                        <span class="invalid-feedback">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="">Potongan</label>
                                    <input type="number" class="form-control @error('potongan') is-invalid @enderror"
                                        id="potongan" name="potongan" value="{{ $pengiriman->potongan }}" readonly>
                                    @error('potongan')
                                        <span class="invalid-feedback">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="">Total Biaya Keseluruhan</label>
                                    <input type="number"
                                        class="form-control @error('total_biaya_keseluruhan') is-invalid @enderror"
                                        id="total_biaya_keseluruhan" name="total_biaya_keseluruhan"
                                        value="{{ $total_biaya }}" readonly>
                                    @error('total_biaya_keseluruhan')
                                        <span class="invalid-feedback">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                            @endif
                            <div class="form-group">
                                <button type="submit" class="btn btn-block btn-primary">Simpan Transaksi</button>
                                <a href="/pengiriman" class="btn btn-block btn-danger">Kembali</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endif











@endsection

@push('script')
    <script>
        let selectedItem = ''

        const selectItem = (item) => {
            selectedItem = item
        }

        function hitungTotalBiayaPerUnit() {
            var biaya_kirim = $("#biaya_kirim").val();
            var biaya_koordinasi = $("#biaya_koordinasi").val();
            var biaya_tambahan = $("#biaya_tambahan").val();

            if (!biaya_kirim) {
                return $("#total_biaya_per_unit").val(0);
            }

            var total = parseInt(biaya_kirim) + parseInt(
                biaya_koordinasi) + parseInt(
                biaya_tambahan);
            $("#total_biaya_per_unit").val(total);
        }

        function hitungTotalBiayaKeseluruhan() {
            var total_biaya = $("#total_biaya").val();
            var potongan = $("#potongan").val();

            if (!total_biaya) {
                return
            }

            var total = parseInt(total_biaya) - parseInt(
                potongan);
            $("#total_biaya_keseluruhan").val(total);
        }

        $(document).ready(function() {
            $('#myTable').DataTable();

            //Initialize Select2 Elements
            $('.select2').select2()

            //Initialize Select2 Elements
            $('.select2bs4').select2({
                theme: 'bootstrap4'
            });

            $("form[role='alert']").submit(function(event) {
                event.preventDefault();
                Swal.fire({
                    title: `Apakah yakin ingin menghapus data detail penerima unit dari "${selectedItem}"?`,
                    text: "Data yang dihapus tidak bisa dikembalikan lagi!",
                    icon: 'warning',
                    allowOutsideClick: false,
                    showCancelButton: true,
                    cancelButtonText: "Tidak",
                    reverseButtons: true,
                    confirmButtonText: "Ya",
                }).then((result) => {
                    if (result.isConfirmed) {
                        // todo: process of deleting categories
                        event.target.submit();
                    }
                });

            });


            $("#biaya_kirim , #biaya_koordinasi, #biaya_tambahan").keyup(function() {
                // var biaya_kirim = $("#biaya_kirim").val();
                // var biaya_kapal = $("#biaya_kapal").val();
                // var biaya_koordinasi = $("#biaya_koordinasi").val();

                // var total = parseInt(biaya_kirim) + parseInt(
                //     biaya_kapal) + parseInt(
                //     biaya_koordinasi);
                // $("#total_biaya_per_unit").val(total);

                hitungTotalBiayaPerUnit();
                hitungTotalBiayaKeseluruhan();
            });

            $("#total_biaya, #potongan").keyup(function() {
                // var total_biaya = $("#total_biaya").val();
                // var potongan = $("#potongan").val();

                // var total = parseInt(total_biaya) - parseInt(
                //     potongan);
                // $("#total_biaya_keseluruhan").val(total);

                hitungTotalBiayaPerUnit();
                hitungTotalBiayaKeseluruhan();
            });


        });

        $('#biaya_pengiriman_id').change(function() {
            var id = $(this).val();
            if (!id) {
                $('#biaya_kirim').val(0);
                $("#biaya_koordinasi").val(0);
                $("#biaya_tambahan").val(0);
                hitungTotalBiayaPerUnit();
                hitungTotalBiayaKeseluruhan();
                return;

            }
            var url = '{{ route('getBiayaPengiriman', ':id') }}';
            url = url.replace(':id', id);

            $.ajax({
                url: url,
                type: 'get',
                dataType: 'json',
                success: function(response) {
                    if (response != null) {
                        $('#biaya_kirim').val(response.biaya_pengiriman);

                        hitungTotalBiayaPerUnit();
                        hitungTotalBiayaKeseluruhan();
                    }
                }
            });
        });


        function sum() {
            var biaya = document.getElementById('biaya');
            var biaya_tambahan = document.getElementById('biaya_tambahan');
            var subtotal = parseInt(biaya) + parseInt(biaya_tambahan);
            if (!isNaN(subtotal)) {
                document.getElementById('subtotal').value = subtotal;
            }
        }
    </script>
    <x-toast />
@endpush
