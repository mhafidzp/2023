@extends('layouts.index')
@section('item-kecamatan','active')
@section('css')
<link rel="stylesheet" href="{{ asset('assets/select2/select2.min.css') }}">
@endsection
@section('content')
<h1 class="h3 mb-3"><strong>Kecamatan</strong> Master</h1>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-6"><h5 class="card-title mb-0">Ubah Kecamatan</h5></div>
                    <div class="col-md-6"><a href="{{ route('index.kecamatan') }}" class="btn btn-sm btn-secondary float-end">Kembali</a></div>
                </div>
            </div>
            <form action="{{ route('update.kecamatan', $kecamatan->kode) }}" method="post" autocomplete="off">
                @csrf
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <label class="form-label">Provinsi</label>
                            <select name="provinsi_kode" id="provinsi" class="form-select">
                                <option disabled>- Pilih -</option>
                                @foreach ($provinsi as $val)
                                    <option value="{{ $val->kode }}" {{ ($kecamatan->kota->provinsi->kode == $val->kode) ? 'selected' : '' }}>{{ $val->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-6">
                            <label class="form-label">Kota/Kab</label>
                            <select name="kota_kode" id="kota" class="form-select">
                                <option disabled>- Pilih -</option>
                                <option value="{{ $kecamatan->kota->kode }}" selected>{{ $kecamatan->kota->nama }}</option>
                            </select>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-6">
                            <label class="form-label">Kode Kecamatan</label>
                            <input type="text" name="kode" class="form-control {{ $errors->has('kode') ? 'is-invalid' : '' }}"
                             value="{{ $kecamatan->kode }}" required>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-12">
                            <label class="form-label">Nama Kecamatan</label>
                            <input type="text" name="nama" class="form-control {{ $errors->has('nama') ? 'is-invalid' : '' }}"
                             value="{{ $kecamatan->nama }}" required>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <button class="btn btn-sm btn-success" type="submit">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
@section('js')
<script src="{{ asset('assets/select2/select2.min.js') }}"></script>
<script>
    $(function() {
        $('#provinsi').select2({
        });
        $('#kota').select2({
        });

        //provinsi
        $( "#provinsi" ).change(function() {
            $('#kota').empty();
            let provinsi_kode = $(this).val();
            $.ajax({
                url: '{{ route('select.kota') }}',
                type: 'GET',
                data: { provinsi_kode: provinsi_kode },
            })
            .done(function( response ) {
                $('#kota').select2({
                    data: response.data
                });
            })
            .fail(function(response) {
                console.log("error");
            });
        });
    })
</script>
@endsection
