@extends('layouts.app')
@section('title', 'Edit Detail Transaksi')
@section('breadcrumb')
    @parent
    <li class="breadcrumb-item"><a href="/pengiriman/edit/{{ $detail->id }}"> Detail Transaksi Pengiriman</a></li>
    <li class="breadcrumb-item active">Edit</li>
@endsection

@section('content')

    <!-- Main row -->
    <div class="row">
        <!-- Left col -->
        <div class="col-lg-12">
            @if (auth()->user()->level != 'pelanggan')
                <form action="{{ '/pengiriman/update_detail/' . $detail->id }}" method="POST">
                    @csrf
                    @method('put')
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="nama_penerima">Nama Penerima</label>
                                        <input type="text"
                                            class="form-control @error('nama_penerima') is-invalid @enderror"
                                            id="nama_penerima" name="nama_penerima" value="{{ $detail->nama_penerima }}">
                                        @error('nama_penerima')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="telepon_penerima">Telepon Penerima</label>
                                        <input type="number"
                                            class="form-control @error('telepon_penerima') is-invalid @enderror"
                                            id="telepon_penerima" name="telepon_penerima"
                                            value="{{ $detail->telepon_penerima }}" placeholder="081122334455 / 0213322344">
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
                                    class="form-control @error('alamat_penerima') is-invalid @enderror">{{ $detail->alamat_penerima }}</textarea>
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
                                <label for="biaya_pengiriman_id">Rute Pengiriman</label>
                                <select class="form-control select2bs4 @error('biaya_pengiriman_id') is-invalid @enderror"
                                    id="biaya_pengiriman_id" name="biaya_pengiriman_id" style="width: 100%;">
                                    <option value="">Cari Rute Pengantaran</option>
                                    @foreach ($biaya_pengiriman as $item)
                                        @if ($item->id == $detail->biaya_pengiriman_id)
                                            <option value="{{ $item->id }}" selected>
                                                Unit:
                                                {{ $item->unit->nama }} ||
                                                Rute: {{ $item->rute_asal }}
                                                -
                                                {{ $item->rute_tujuan }} ||Jenis: {{ $item->jenis->nama_layanan }}
                                                ||Biaya:
                                                {{ number_format($item->biaya_pengiriman) }}
                                            </option>
                                        @else
                                            <option value="{{ $item->id }}">
                                                Unit:
                                                {{ $item->unit->nama }} ||
                                                Rute: {{ $item->rute_asal }}
                                                -
                                                {{ $item->rute_tujuan }} ||Jenis: {{ $item->jenis->nama_layanan }} ||
                                                Biaya:
                                                {{ number_format($item->biaya_pengiriman) }}
                                            </option>
                                        @endif
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
                                    class="form-control @error('nama_kapal') is-invalid @enderror"
                                    value="{{ $detail->nama_kapal }}">
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
                                            id="merk_type" name="merk_type" value="{{ $detail->merk_type }}">
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
                                        <input type="text" class="form-control @error('warna') is-invalid @enderror"
                                            id="warna" name="warna" value="{{ $detail->warna }}">
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
                                            id="no_polisi" name="no_polisi" value="{{ $detail->no_polisi }}">
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
                                            id="no_rangka" name="no_rangka" value="{{ $detail->no_rangka }}">
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
                                            id="no_mesin" name="no_mesin" value="{{ $detail->no_mesin }}">
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
                                            id="biaya_kirim" name="biaya_kirim" value="{{ $detail->biaya_kirim }}"
                                            readonly>
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
                                            id="biaya_koordinasi" name="biaya_koordinasi"
                                            value="{{ $detail->biaya_koordinasi }}">
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
                                            id="biaya_tambahan" name="biaya_tambahan"
                                            value="{{ $detail->biaya_tambahan }}">
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
                                    class="form-control @error('total_biaya_per_unit') is-invalid @enderror"
                                    id="total_biaya_per_unit" name="total_biaya_per_unit"
                                    value="{{ $detail->total_biaya_per_unit }}" readonly>
                                @error('total_biaya_per_unit')
                                    <span class="invalid-feedback">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="">Keterangan</label>
                                <textarea name="keterangan" id="keterangan" class="form-control @error('keterangan') is-invalid @enderror">{{ $detail->keterangan }}</textarea>
                                @error('keterangan')
                                    <span class="invalid-feedback">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="modal-footer">
                            <a href="/pengiriman/edit/{{ $detail->transaksi_id }}" class="btn btn-danger">Kembali</a>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </div>
                </form>
            @else
                <form action="{{ '/pengiriman/update_detail/' . $detail->id }}" method="POST">
                    @csrf
                    @method('put')
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="nama_penerima">Nama Penerima</label>
                                        <input type="text"
                                            class="form-control @error('nama_penerima') is-invalid @enderror"
                                            id="nama_penerima" name="nama_penerima"
                                            value="{{ $detail->nama_penerima }}">
                                        @error('nama_penerima')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="telepon_penerima">Telepon Penerima</label>
                                        <input type="number"
                                            class="form-control @error('telepon_penerima') is-invalid @enderror"
                                            id="telepon_penerima" name="telepon_penerima"
                                            value="{{ $detail->telepon_penerima }}"
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
                                    class="form-control @error('alamat_penerima') is-invalid @enderror">{{ $detail->alamat_penerima }}</textarea>
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
                                <label for="biaya_pengiriman_id">Rute Pengiriman</label>
                                @if ($detail->kirim->status_pengiriman == 'Diproses')
                                    <select
                                        class="form-control select2bs4 @error('biaya_pengiriman_id') is-invalid @enderror"
                                        id="biaya_pengiriman_id" name="biaya_pengiriman_id" style="width: 100%;">
                                        <option value="">Cari Rute Pengantaran</option>
                                        @foreach ($biaya_pengiriman as $item)
                                            @if ($item->id == $detail->biaya_pengiriman_id)
                                                <option value="{{ $item->id }}" selected>
                                                    Unit:
                                                    {{ $item->unit->nama }} ||
                                                    Rute: {{ $item->rute_asal }}
                                                    -
                                                    {{ $item->rute_tujuan }} ||Jenis: {{ $item->jenis->nama_layanan }}
                                                    ||Biaya:
                                                    {{ number_format($item->biaya_pengiriman) }}
                                                </option>
                                            @else
                                                <option value="{{ $item->id }}">
                                                    Unit:
                                                    {{ $item->unit->nama }} ||
                                                    Rute: {{ $item->rute_asal }}
                                                    -
                                                    {{ $item->rute_tujuan }} ||Jenis: {{ $item->jenis->nama_layanan }} ||
                                                    Biaya:
                                                    {{ number_format($item->biaya_pengiriman) }}
                                                </option>
                                            @endif
                                        @endforeach
                                    </select>
                                @else
                                    <select class="form-control @error('biaya_pengiriman_id') is-invalid @enderror"
                                        id="biaya_pengiriman_id" name="biaya_pengiriman_id"
                                        style="width: 100%; pointer-events:none;" onclick="return false"
                                        onkeydown="return false">
                                        <option value="">Cari Rute Pengantaran</option>
                                        @foreach ($biaya_pengiriman as $item)
                                            @if ($item->id == $detail->biaya_pengiriman_id)
                                                <option value="{{ $item->id }}" selected>
                                                    Unit:
                                                    {{ $item->unit->nama }} ||
                                                    Rute: {{ $item->rute_asal }}
                                                    -
                                                    {{ $item->rute_tujuan }} ||Jenis: {{ $item->jenis->nama_layanan }}
                                                    ||Biaya:
                                                    {{ number_format($item->biaya_pengiriman) }}
                                                </option>
                                            @else
                                                <option value="{{ $item->id }}">
                                                    Unit:
                                                    {{ $item->unit->nama }} ||
                                                    Rute: {{ $item->rute_asal }}
                                                    -
                                                    {{ $item->rute_tujuan }} ||Jenis: {{ $item->jenis->nama_layanan }} ||
                                                    Biaya:
                                                    {{ number_format($item->biaya_pengiriman) }}
                                                </option>
                                            @endif
                                        @endforeach
                                    </select>
                                @endif
                                @error('biaya_pengiriman_id')
                                    <span class="invalid-feedback">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="">Nama Kapal</label>
                                <input type="text" name="nama_kapal" id="nama_kapal"
                                    class="form-control @error('nama_kapal') is-invalid @enderror"
                                    value="{{ $detail->nama_kapal }}">
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
                                            name="merk_type" value="{{ $detail->merk_type }}">
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
                                        <input type="text" class="form-control @error('warna') is-invalid @enderror"
                                            id="warna" name="warna" value="{{ $detail->warna }}">
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
                                            name="no_polisi" value="{{ $detail->no_polisi }}">
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
                                            name="no_rangka" value="{{ $detail->no_rangka }}">
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
                                            name="no_mesin" value="{{ $detail->no_mesin }}">
                                        @error('no_mesin')
                                            <span class="invalid-feedback">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                            </div>

                            @if ($detail->kirim->status_pengiriman == 'Diproses')
                                <div class="form-group">
                                    <label for="">Keterangan</label>
                                    <textarea name="keterangan" id="keterangan" class="form-control @error('keterangan') is-invalid @enderror"
                                        placeholder="Contoh: Lampu belakang rusak">{{ $detail->keterangan }}</textarea>
                                    @error('keterangan')
                                        <span class="invalid-feedback">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <input type="hidden"
                                                class="form-control @error('biaya_kirim') is-invalid @enderror"
                                                id="biaya_kirim" name="biaya_kirim" value="{{ $detail->biaya_kirim }}"
                                                readonly>
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
                                                id="biaya_koordinasi" name="biaya_koordinasi"
                                                value="{{ $detail->biaya_koordinasi }}" readonly>
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
                                                id="biaya_tambahan" name="biaya_tambahan"
                                                value="{{ $detail->biaya_tambahan }}" readonly>
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
                                        class="form-control @error('total_biaya_per_unit') is-invalid @enderror"
                                        id="total_biaya_per_unit" name="total_biaya_per_unit"
                                        value="{{ $detail->total_biaya_per_unit }}" readonly>
                                    @error('total_biaya_per_unit')
                                        <span class="invalid-feedback">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                            @else
                                <hr>
                                Detail Biaya
                                <hr>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="biaya_kirim">Biaya Pengiriman</label>
                                            <input type="number"
                                                class="form-control @error('biaya_kirim') is-invalid @enderror"
                                                id="biaya_kirim" name="biaya_kirim" value="{{ $detail->biaya_kirim }}"
                                                readonly>
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
                                                id="biaya_koordinasi" name="biaya_koordinasi"
                                                value="{{ $detail->biaya_koordinasi }}" readonly>
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
                                                id="biaya_tambahan" name="biaya_tambahan"
                                                value="{{ $detail->biaya_tambahan }}" readonly>
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
                                        class="form-control @error('total_biaya_per_unit') is-invalid @enderror"
                                        id="total_biaya_per_unit" name="total_biaya_per_unit"
                                        value="{{ $detail->total_biaya_per_unit }}" readonly>
                                    @error('total_biaya_per_unit')
                                        <span class="invalid-feedback">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="">Keterangan</label>
                                    <textarea name="keterangan" id="keterangan" class="form-control @error('keterangan') is-invalid @enderror"
                                        placeholder="Contoh: Lampu belakang rusak">{{ $detail->keterangan }}</textarea>
                                    @error('keterangan')
                                        <span class="invalid-feedback">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                            @endif

                        </div>
                        <div class="modal-footer">
                            <a href="/pengiriman/edit/{{ $detail->transaksi_id }}" class="btn btn-danger">Kembali</a>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </div>
                </form>
            @endif
        </div>
    </div>
    <!-- /.row (main row) -->

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
