@extends('layouts.index')
@section('data-user','active')
@section('collapsed','')
@section('data-user-show','show')
@section('item-admin','active')
@section('css')
<link rel="stylesheet" href="{{ asset('assets/select2/select2.min.css') }}">
@endsection
@section('content')
<h1 class="h3 mb-3"><strong>Admin</strong> Master</h1>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-6"><h5 class="card-title mb-0">Ubah User Admin</h5></div>
                    <div class="col-md-6"><a href="{{ route('admin.user') }}" class="btn btn-sm btn-secondary float-end">Kembali</a></div>
                </div>
            </div>
            <form action="{{ route('update.admin',$user->id) }}" id="data-form" method="post" class="fv-plugins-bootstrap5" autocomplete="off">
                @csrf
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <label class="form-label">Nama</label>
                            <input type="text" name="name" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}"
                             value="{{ $user->name }}" required>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-12">
                            <label class="form-label">Email</label>
                            <input type="text" name="email" class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}"
                             value="{{ $user->email }}" required>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-12">
                            <label class="form-label">Password</label>
                            <input type="password" name="password" class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}"
                             value="{{ old('password') }}" required>
                             <span>*Kosongkan jika tidak diubah</span>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-12">
                            <label class="form-label">Role</label>
                            <select name="role" id="role" class="form-select">
                                @foreach ($role as $val)
                                    <option value="{{ $val->id }}" {{ ($val->id == $user->role) ? 'selected' : '' }}>{{ $val->name }}</option>
                                @endforeach
                            </select>
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
                            }
                        }
                    },
                    'role': {
                        validators: {
                            notEmpty: {
                                message: 'Role harus di pilih.'
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

        $('#role').select2({
            placeholder: "-Pilih-",
            allowClear: true
        });

        validasi();
    });

</script>
@endsection
