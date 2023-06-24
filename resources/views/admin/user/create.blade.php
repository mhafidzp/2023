@extends('layouts.index')
@section('data-user','active')
@section('collapsed','')
@section('data-user-show','show')
@section('item-user','active')
@section('css')

@endsection
@section('content')
<h1 class="h3 mb-3"><strong>User</strong> Master</h1>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-6"><h5 class="card-title mb-0">Tambah User</h5></div>
                    <div class="col-md-6"><a href="{{ route('index.user') }}" class="btn btn-sm btn-secondary float-end">Kembali</a></div>
                </div>
            </div>
            <form action="{{ route('store.user') }}" method="post" autocomplete="off" id="data-form" class="fv-plugins-bootstrap5">
                @csrf
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <label class="form-label">Nama</label>
                            <input type="text" name="name" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}"
                             value="{{ old('name') }}">

                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-12">
                            <label class="form-label">Email</label>
                            <input type="text" name="email" class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}"
                             value="{{ old('email') }}">
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-12">
                            <label class="form-label">Password</label>
                            <input type="password" name="password" class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}"
                             value="{{ old('password') }}">
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-12">
                            <label class="form-label">Konfirmasi Password</label>
                            <input type="password" name="konfirmasi_password" class="form-control">
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
                    'name': {
                        validators: {
                            notEmpty: {
                                message: 'Nama harus di isi.'
                            }
                        }
                    },
                    'email': {
                        validators: {
                            emailAddress: {
                                message: 'Format Email Salah'
                            },
                            notEmpty: {
                                message: 'Email harus di isi.'
                            },
                            remote: {
                                url: "{{ route('cek-email.user') }}",
                                data: function () {
                                    return {
                                        email: form.querySelector('[name="email"]').value,
                                    };
                                },
                                message: 'Email sudah digunakan.',
                                type: 'GET',
                            }
                        }
                    },
                    'password': {
                        validators: {
                            notEmpty: {
                                message: 'Password harus di isi.'
                            }
                        }
                    },
                    'konfirmasi_password': {
                        validators: {
                            notEmpty: {
                                message: 'Konfirmasi Password harus di isi.'
                            },
                            identical: {
                                compare: function () {
                                    return form.querySelector('[name="password"]').value;
                                },
                                message: 'Password tidak sama.'
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
