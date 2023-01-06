<div class="form-group">
    <label for="">Status Pengiriman</label>
    <select name="status_pengiriman" id="status_pengiriman"
        class="form-control @error('status_pengiriman') is-invalid @enderror">
        <option value="Selesai" {{ $data->status_pengiriman == 'Selesai' ? 'selected' : '' }}>
            Selesai</option>
        <option value="OTW" {{ $data->status_pengiriman == 'OTW' ? 'selected' : '' }}>
            OTW</option>
        <option value="Pembayaran Ditolak" {{ $data->status_pengiriman == 'Pembayaran Ditolak' ? 'selected' : '' }}>
            Pembayaran Ditolak
        </option>
        <option value="Pembayaran Diverifikasi"
            {{ $data->status_pengiriman == 'Pembayaran Diverifikasi' ? 'selected' : '' }}>
            Pembayaran Diverifikasi
        </option>
        <option value="Menunggu Pembayaran" {{ $data->status_pengiriman == 'Menunggu Pembayaran' ? 'selected' : '' }}>
            Menunggu Pembayaran
        </option>
        <option value="Diproses" {{ $data->status_pengiriman == 'Diproses' ? 'selected' : '' }}>
            Diproses
        </option>
    </select>
</div>
<div class="form-group mt-2">
    <button class="btn btn-primary btn-sm" onClick="update({{ $data->id }})">Ubah</button>
</div>
