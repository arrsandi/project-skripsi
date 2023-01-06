@extends('layouts.app')
@section('title', 'Biaya Pengiriman')
@section('breadcrumb')
    @parent
    <li class="breadcrumb-item"><a href="/biaya_pengiriman">Biaya Pengiriman</a></li>
    <li class="breadcrumb-item active">Tambah</li>
@endsection

@section('content')

    <!-- Main row -->
    <div class="row">
        <!-- Left col -->
        <div class="col-lg-12">
            <form action="/biaya_pengiriman/input" method="POST">
                @csrf
                <div class="card">
                    <div class="card-body">

                        <div class="form-group">
                            <label for="unit_id"> Unit</label>
                            <select name="unit_id" id="unit_id"
                                class="form-control  @error('unit_id') is-invalid @enderror select2bs4 ">
                                <option value="">Pilih Unit</option>
                                @foreach ($unit as $item)
                                    <option value="{{ $item->id }}">{{ $item->nama }}
                                    </option>
                                @endforeach
                            </select>
                            @error('unit_id')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>


                        <div class="form-group">
                            <label for="rute_asal">Rute Asal</label>
                            <input type="text" name="rute_asal" id="rute_asal"
                                class="form-control  @error('rute_asal') is-invalid @enderror"
                                value="{{ old('rute_asal') }}">
                            @error('rute_asal')
                                <span class="invalid-feedback">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="rute_tujuan">Rute Tujuan</label>
                            <input type="text" name="rute_tujuan" id="rute_tujuan"
                                class="form-control  @error('rute_tujuan') is-invalid @enderror"
                                value="{{ old('rute_tujuan') }}">
                            @error('rute_tujuan')
                                <span class="invalid-feedback">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="jenis_pengiriman_id"> Jenis Pengiriman</label>
                            <select name="jenis_pengiriman_id" id="jenis_pengiriman_id"
                                class="form-control  @error('jenis_pengiriman_id') is-invalid @enderror select2bs4 ">
                                <option value="">Pilih Jenis Pengiriman</option>
                                @foreach ($jenis as $jen)
                                    <option value="{{ $jen->id }}">{{ $jen->nama_layanan }}
                                    </option>
                                @endforeach

                            </select>
                            @error('jenis_pengiriman_id')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="biaya_pengiriman">Biaya Pengiriman</label>
                            <input type="number" name="biaya_pengiriman" id="biaya_pengiriman"
                                class="form-control  @error('biaya_pengiriman') is-invalid @enderror"
                                value="{{ old('biaya_pengiriman') }}">
                            @error('biaya_pengiriman')
                                <span class="invalid-feedback">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>


                    </div>
                    <div class="card-footer">
                        <a href="/biaya_pengiriman" class="btn btn-danger">Kembali</a>
                        <button class="btn btn-primary">Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- /.row (main row) -->

@endsection

@push('script')
    <script>
        $(document).ready(function() {
            $('.select2').select2()

            //Initialize Select2 Elements
            $('.select2bs4').select2({
                theme: 'bootstrap4'
            })
        });
    </script>
@endpush
