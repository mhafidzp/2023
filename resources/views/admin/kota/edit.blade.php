@extends('layouts.index')
@section('item-kota','active')
@section('css')
<link rel="stylesheet" href="{{ asset('assets/select2/select2.min.css') }}">
@endsection
@section('content')
<h1 class="h3 mb-3"><strong>Kota/Kab</strong> Master</h1>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-6"><h5 class="card-title mb-0">Ubah Kota/Kab</h5></div>
                    <div class="col-md-6"><a href="{{ route('index.kota') }}" class="btn btn-sm btn-secondary float-end">Kembali</a></div>
                </div>
            </div>
            <form action="{{ route('update.kota', $kota->kode) }}" method="post" autocomplete="off" id="data-form">
                @csrf
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <label class="form-label">Provinsi</label>
                            <select name="provinsi_kode" id="provinsi" class="form-select" {{ $errors->has('provinsi_kode') ? 'is-invalid' : '' }}>
                                <option disabled selected>- Pilih -</option>
                                @foreach ($provinsi as $val)
                                    <option value="{{ $val->kode }}" {{ ($kota->provinsi_kode == $val->kode) ? 'selected' : '' }}>{{ $val->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-6">
                            <label class="form-label">Kode Kota/Kab</label>
                            <input type="text" name="kode" class="form-control {{ $errors->has('kode') ? 'is-invalid' : '' }}"
                             value="{{ $kota->kode }}" required>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-12">
                            <label class="form-label">Nama Kota/Kab</label>
                            <input type="text" name="nama" class="form-control {{ $errors->has('nama') ? 'is-invalid' : '' }}"
                             value="{{ $kota->nama }}" required>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <button class="btn btn-sm btn-success" type="submit" id="btn-submit">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
@section('js')
<script src="{{ asset('assets/select2/select2.min.js') }}"></script>
<script>

    function validasi(){
        // Define form element
        const form = document.getElementById('data-form');

        // Init form validation rules. For more info check the FormValidation plugin's official documentation:https://formvalidation.io/
        var validator = FormValidation.formValidation(
            form,
            {
                fields: {
                    'provinsi_kode': {
                        validators: {
                            notEmpty: {
                                message: 'Provinsi harus di pilih.'
                            }
                        }
                    },
                    'nama': {
                        validators: {
                            notEmpty: {
                                message: 'Nama Kota/Kab harus di isi.'
                            }
                        }
                    },
                    'kode': {
                        validators: {
                            notEmpty: {
                                message: 'Kode Kota/Kab harus di isi.'
                            },
                        }
                    },
                },

                plugins: {
                    trigger: new FormValidation.plugins.Trigger(),
                    autoFocus: new FormValidation.plugins.AutoFocus(),
                    bootstrap: new FormValidation.plugins.Bootstrap5()
                }
            }
        );

        // Submit button handler
        const submitButton = document.getElementById('btn-submit');
        submitButton.addEventListener('click', function (e) {
            // Prevent default button action
            e.preventDefault();

            // Validate form before submit
            if (validator) {
                validator.validate().then(function (status) {
                    console.log('validated!');

                        if (status == 'Valid') {
                            blockui();
                            form.submit(); // Submit form
                        }
                });
            }
        });
    }

    $(function() {
        validasi();
        $('#provinsi').select2({
        });
    })
</script>
@endsection
