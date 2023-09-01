@extends('layouts.index')
@section('item-provinsi','active')
@section('css')

@endsection
@section('content')
<h1 class="h3 mb-3"><strong>Provinsi</strong> Master</h1>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-6"><h5 class="card-title mb-0">Tambah Provinsi</h5></div>
                    <div class="col-md-6"><a href="{{ route('index.provinsi') }}" class="btn btn-sm btn-secondary float-end">Kembali</a></div>
                </div>
            </div>
            <form action="{{ route('store.provinsi') }}" method="post" autocomplete="off" id="data-form">
                @csrf
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <label class="form-label">Kode Provinsi</label>
                            <input type="text" name="kode" class="form-control {{ $errors->has('kode') ? 'is-invalid' : '' }}"
                             value="{{ old('kode') }}" required>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-12">
                            <label class="form-label">Nama Provinsi</label>
                            <input type="text" name="nama" class="form-control {{ $errors->has('nama') ? 'is-invalid' : '' }}"
                             value="{{ old('nama') }}" required>
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

<script>

    function validasi(){
        // Define form element
        const form = document.getElementById('data-form');

        // Init form validation rules. For more info check the FormValidation plugin's official documentation:https://formvalidation.io/
        var validator = FormValidation.formValidation(
            form,
            {
                fields: {
                    'nama': {
                        validators: {
                            notEmpty: {
                                message: 'Nama harus di isi.'
                            }
                        }
                    },
                    'kode': {
                        validators: {
                            notEmpty: {
                                message: 'Kode Provinsi harus di isi.'
                            },
                            remote: {
                                url: "{{ route('cek-kode.provinsi') }}",
                                data: function () {
                                    return {
                                        kode: form.querySelector('[name="kode"]').value,
                                    };
                                },
                                message: 'Kode Provinsi sudah digunakan.',
                                type: 'GET',
                            }
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
    })
</script>
@endsection
