@extends('layouts.index')
@section('data-user','active')
@section('collapsed','')
@section('data-user-show','show')
@section('item-user','active')
@section('css')
<link rel="stylesheet" href="{{ asset('assets/datatables/css/datatables.min.css') }}">
@endsection
@section('content')
<h1 class="h3 mb-3"><strong>User</strong> Master</h1>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-6"><h5 class="card-title mb-0">Data User</h5></div>
                    <div class="col-md-6"><a href="{{ route('create.user') }}" class="btn btn-sm btn-primary float-end">Tambah</a></div>
                </div>
            </div>
            <div class="card-body">
                <table id="tbl_user" class="table table-bordered">
                    <thead>
                        <tr>
                            <td>#</td>
                            <td>Nama</td>
                            <td>Email</td>
                            <td>Opsi</td>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
@section('js')
<script src="{{ asset('assets/datatables/js/datatables.min.js') }}"></script>

<script>
    $(function() {
        $("#tbl_user tbody").on('click', '.btn_hapus', function(e) {
            e.preventDefault();
            let id = $(this).data('id');
            Swal.fire({
                icon: 'warning',
                title: 'Apakah anda yakin?',
                showConfirmButton: true,
                showCancelButton: true,
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Tidak',
            }).then((result) => {
                if (result.isConfirmed) {
                    blockui();
                    $("#delete-id-" + id).submit();
                }
            });
        });

        $('#tbl_user').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: '{{ url()->current() }}',
            },
            columns: [
                {
                    data: 'id',
                    render: function(data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }
                },
                {data: 'name',name: 'name'},
                {data: 'email',name: 'email'},
                {
                    data: 'opsi',
                    name: 'opsi',
                    orderable: false,
                    searchable: false,
                    className: 'text-center'
                }
            ],
            search: {
                return: true,
            },
        });
    })
</script>
@endsection
