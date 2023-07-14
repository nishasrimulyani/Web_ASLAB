@extends('layouts.admin')

@section('main-content')
    <?php
    $params_id = null;

    ?>
    <div class="row mt-5">
        <div class="col-lg-12 margin-tb">
            <div class="float-start">
                <h2>Data Panitia</h2>
            </div>
        </div>
    </div>
    <hr>
    <div class="container-fluid">
        <div class="card card-default">
            <div class="card-body">
                <button class="btn btn-primary" data-toggle="modal" data-target="#tambahPanitiaModal" id="createNewPanitia">Tambah Data</button>
                <hr>
                <table id="table-data" class="table table-bordered">
                    <thead>
                        {{-- tambah data panitia --}}
                        <div class="modal fade" id="tambahPanitiaModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Tambah Data Panitia</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form id="panitiaForm" name="panitiaForm" method="post" enctype="multipart/form-data">
                                            <div class="modal-body">
                                                @csrf
                                                <div class="form-group">
                                                    <label for="data-nama">Nama</label>
                                                    <input type="text"class="form-control" name="nama"
                                                        id="data-nama" required />
                                                </div>
                                                <div class="form-group">
                                                    <label for="data-password">Kata Sandi</label>
                                                    <input type="text"class="form-control" name="password"
                                                        id="data-password" required />
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-dismiss="modal">Tutup</button>
                                                    <button type="submit" class="btn btn-primary" id="saveBtn"
                                                        value="create">Kirim</button>
                                                </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                    </thead>
                </table>

                <table id="table-data" class="table table-bordered">
                <thead>
                    <tr class="text-center">
                        <th>Nama</th>
                        <th>Password</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                @foreach ($users as $user)
                    <tr style="text-align: center">
                        <td>{{ $user->nama }} </td>
                        <td>{{ $user->password }} </td>
                        <td>
                            <div class="btn-group" role="group" aria-label="Basic example">
                                <button type="button" id="btn-edit-panitia"
                                    class="btn btn-success editPanitia-{{ $user->id }}"
                                    onclick="updateConfirmation('{{ $user->id }}')" data-toggle="modal"
                                    data-id="{{ $user->id }}" data-target="#editPanitiaModal"
                                    data-nama="{{ $user->nama }}"
                                    data-password="{{ $user->password }}"
                                    data-created_at="{{ $user->created_at }}">
                                    Edit
                                </button>
                                <a type="button" id="btn-hapus-panitia"
                                    class="btn btn-danger hapusPanitia-{{ $user->id }}"
                                    onclick="return confirm('Apakah Kamu yakin?')"
                                    href="{{ url('/datapanitia/delete/' . $user->id) }}">
                                    Hapus
                                </a>
                            </div>
                        </td>
                    </tr>
                    <tbody>
                @endforeach
                </tbody>
                </table>
            </div>
           
        </div>
    </div>
    </div>

    <!-- Edit Jenis Soal -->
    <div class="modal fade" id="editPanitiaModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Data Pantia</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times; </span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" enctype="multipart/form-data" name="panitiaFormUpdate" id="editForm">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="edit-nama">Nama</label>
                                    <input type="text" class="form-control" name="nama" id="edit-nama"
                                        required />
                                </div>
                                
                                <div class="form-group">
                                    <label for="edit-password">Password</label>
                                    <input type="text" class="form-control" name="password"
                                        id="edit-password" required />
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <input type="hidden" name="id" id="edit-id" />
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                            <button type="submit" onclick="updateData()" class="btn btn-success">Ubah</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script>
        //create
        $(function() {
            $('#panitiaForm').submit(function(e) {
                e.preventDefault();
                $(this).html('Mengirim..');
                $.ajax({
                    data: $('#panitiaForm').serialize(),
                    url: "{{ route('datapanitia.store') }}",
                    type: "post",
                    dataType: 'json',
                    success: function(data) {
                        $('#panitiaForm').trigger("reset");
                        $('#tambahPanitiaModal').modal('hide');
                        table.draw();
                    },
                    error: function(data) {
                        console.log('Error:', data);
                        $('#saveBtn').html('Save Changes');
                    }
                });
                location.reload();
            });

            // Update
            $('#editForm').submit(function(e) {
                e.preventDefault();
                $(this).html('Mengirim..');
                $.ajax({
                    data: $(this).serializeArray().concat([{
                        name: '_token',
                        value: '{{ csrf_token() }}'
                    }]),
                    url: "{{ url('/datapanitia/update') }}",
                    type: "post",
                    dataType: 'json',
                    success: function(data) {
                        $('#editForm').trigger("reset");
                        $('#tambahPanitiaModal').modal('hide');
                        table.draw();
                    },
                    error: function(data) {
                        console.log('Error:', data);
                        $('#saveBtn').html('Save Changes');
                    }
                });
                //  location.reload();
            });
        })

        //update
        function updateConfirmation(id) {
            $("#edit-nama").val($(".editPanitia-" + id).attr("data-nama"))
            $("#edit-id").val($(".editPanitia-" + id).attr("data-id"))
            $("#edit-password").val($(".editPanitia-" + id).attr("data-password"))
        }

        function updateData() {
            $.ajax({
                data: {
                    _token: '{{ csrf_token() }}',
                    nama: $("#edit-nama").val(),
                    password: $("#edit-password").val(),
                    id: $("#edit-id").val(),
                },
                url: "{{ url('/datapanitia/update') }}",
                type: "post",
                dataType: 'json',
                success: function(data) {
                    $('#editForm').trigger("reset");
                    $('#tambahPanitiaModal').modal('hide');
                    table.draw();
                },
                error: function(data) {
                    console.log('Error:', data);
                    $('#saveBtn').html('Save Changes');
                }
            });
            location.reload();
        }
    </script>
@endpush
