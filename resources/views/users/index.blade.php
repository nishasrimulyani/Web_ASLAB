@extends('layouts.admin')

@section('main-content')
    <?php
    $params_id = null;

    ?>
    <div class="row mt-5">
        <div class="col-lg-12 margin-tb">
            <div class="float-start">
                <h2>Data Pengguna</h2>
            </div>
        </div>
    </div>
    <hr>
    <div class="container-fluid">
        <div class="card card-default">
            <div class="card-body">
                @hasanyrole('panitia|admin')
                <a href="{{ route('users.create') }}"><button class="btn btn-primary">Tambah Data</button></a>
                <hr>
                @endhasanyrole
                   
                    
                        <table class="table table-bordered">
                            <thead>
                            <tr style="text-align: center">
                                <th scope="col" style="text-align: center;width: 6%">No</th>
                                <th scope="col">Nama Pengguna</th>
                                <th scope="col">Role</th>
                                <th scope="col" style="width: 15%;text-align: center">Aksi</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($users as $no => $user)
                                <tr>
                                    <th scope="row" style="text-align: center">{{ ++$no + ($users->currentPage()-1) * $users->perPage() }}</th>
                                    <td>{{ $user->nama }}</td>
                                    <td>
                                        @if(!empty($user->getRoleNames()))
                                            @foreach($user->getRoleNames() as $role)
                                                <label class="badge badge-success">{{ $role }}</label>
                                            @endforeach
                                        @endif
                                    </td>
                                    <td class="text-center">
                                       
                                            <a href="{{ route('users.edit', $user->id) }}" class="btn btn-sm btn-primary">
                                                <i class="fa fa-pencil-alt"></i>
                                            </a>
                                        
                                        
                                        
                                            <button onClick="Delete(this.id)" class="btn btn-sm btn-danger" id="{{ $user->id }}">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                      
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        
                    
            </div>
        </div>
    </div>

<script>
    //ajax delete
    function Delete(id)
        {
            var id = id;
            var token = $("meta[nama='csrf-token']").attr("content");

            swal({
                title: "APAKAH KAMU YAKIN ?",
                text: "INGIN MENGHAPUS DATA INI!",
                icon: "warning",
                buttons: [
                    'TIDAK',
                    'YA'
                ],
                dangerMode: true,
            }).then(function(isConfirm) {
                if (isConfirm) {

                    //ajax delete
                    jQuery.ajax({
                        url: "{{ route("users.index") }}/"+id,
                        data:   {
                            "id": id,
                            "_token": token
                        },
                        type: 'DELETE',
                        success: function (response) {
                            if (response.status == "success") {
                                swal({
                                    title: 'BERHASIL!',
                                    text: 'DATA BERHASIL DIHAPUS!',
                                    icon: 'success',
                                    timer: 1000,
                                    showConfirmButton: false,
                                    showCancelButton: false,
                                    buttons: false,
                                }).then(function() {
                                    location.reload();
                                });
                            }else{
                                swal({
                                    title: 'GAGAL!',
                                    text: 'DATA GAGAL DIHAPUS!',
                                    icon: 'error',
                                    timer: 1000,
                                    showConfirmButton: false,
                                    showCancelButton: false,
                                    buttons: false,
                                }).then(function() {
                                    location.reload();
                                });
                            }
                        }
                    });

                } else {
                    return true;
                }
            })
        }
</script>
@endsection



