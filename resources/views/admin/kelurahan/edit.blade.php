@extends('layouts.index')
@section('item-kelurahan','active')
@section('css')
<link rel="stylesheet" href="{{ asset('assets/select2/select2.min.css') }}">
@endsection
@section('content')
<h1 class="h3 mb-3"><strong>Kelurahan/Desa</strong> Master</h1>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-6"><h5 class="card-title mb-0">Ubah Kelurahan/Desa</h5></div>
                    <div class="col-md-6"><a href="{{ route('index.kelurahan') }}" class="btn btn-sm btn-secondary float-end">Kembali</a></div>
                </div>
            </div>
            <form action="{{ route('update.kelurahan', $kelurahan->kode) }}" method="post" autocomplete="off">
                @csrf
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <label class="form-label">Provinsi</label>
                            <select name="provinsi_kode" id="provinsi" class="form-select">
                                <option disabled>- Pilih -</option>
                                @foreach ($provinsi as $val)
                                    <option value="{{ $val->kode }}" {{ ($kelurahan->kecamatan->kota->provinsi->kode == $val->kode) ? 'selected' : '' }}>{{ $val->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-6">
                            <label class="form-label">Kota/Kab</label>
                            <select name="kota_kode" id="kota" class="form-select">
                                <option disabled>- Pilih -</option>
                                <option value="{{ $kelurahan->kecamatan->kota->kode }}" selected>{{ $kelurahan->kecamatan->kota->nama }}</option>
                            </select>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-6">
                            <label class="form-label">Kecamatan</label>
                            <select name="kecamatan_kode" id="kecamatan" class="form-select">
                                <option disabled>- Pilih -</option>
                                <option value="{{ $kelurahan->kecamatan->kode }}" selected>{{ $kelurahan->kecamatan->nama }}</option>
                            </select>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-6">
                            <label class="form-label">Kode Kelurahan</label>
                            <input type="text" name="kode" class="form-control {{ $errors->has('kode') ? 'is-invalid' : '' }}"
                             value="{{ $kelurahan->kode }}" required>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-12">
                            <label class="form-label">Nama Kelurahan</label>
                            <input type="text" name="nama" class="form-control {{ $errors->has('nama') ? 'is-invalid' : '' }}"
                             value="{{ $kelurahan->nama }}" required>
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
        $('#kecamatan').select2({
        });

        //provinsi
        $( "#provinsi" ).change(function() {
            $('#kota').empty();
            $('#kecamatan').empty();
            $('#kota').prop('disabled', 'disabled');
            $('#kecamatan').prop('disabled', 'disabled');
            let provinsi_kode = $(this).val();
            $.ajax({
                url: '{{ route('select.kota') }}',
                type: 'GET',
                data: { provinsi_kode: provinsi_kode },
            })
            .done(function( response ) {
                $('#kota').prop('disabled', false);
                $("#kota").append('<option selected disabled>- Pilih -</option>');
                $('#kota').select2({
                    data: response.data
                });
            })
            .fail(function(response) {
                console.log("error");
                var data = JSON.stringify(response);
                console.log(data);
            });
        });

        //kota
        $( "#kota" ).change(function() {
            $('#kecamatan').prop('disabled', 'disabled');
            $('#kecamatan').empty();
            let kota_kode = $(this).val();
            $.ajax({
                url: '{{ route('select.kecamatan') }}',
                type: 'GET',
                data: { kota_kode: kota_kode },
            })
            .done(function( response ) {
                $('#kecamatan').prop('disabled', false);
                $("#kecamatan").append('<option selected disabled>- Pilih -</option>');
                $('#kecamatan').select2({
                    data: response.data
                });
            })
            .fail(function(response) {
                console.log("error");
                var data = JSON.stringify(response);
                console.log(data);
            });
        });
    })
</script>
@endsection
