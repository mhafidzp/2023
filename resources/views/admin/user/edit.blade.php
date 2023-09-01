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
                    <div class="col-md-6"><h5 class="card-title mb-0">Ubah User</h5></div>
                    <div class="col-md-6"><a href="{{ route('index.user') }}" class="btn btn-sm btn-secondary float-end">Kembali</a></div>
                </div>
            </div>
            <form action="{{ route('update.user',$user->id) }}" method="post" autocomplete="off" id="data-form">
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
                             value="" >
                             <span>*Kosongkan jika tidak diubah</span>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <button class="btn btn-sm btn-success" type="submit" id="btn-submit">Ubah</button>
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
