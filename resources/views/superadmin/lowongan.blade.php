@extends('layouts.admin')

@section('main-content')
    <?php
    $params_id = null;

    ?>
    <div class="row mt-5">
        <div class="col-lg-12 margin-tb">
            <div class="float-start">
                <h2>Lowongan Asisten</h2>
            </div>
        </div>
    </div>
    <hr>
    <div class="container-fluid">
        <div class="card card-default">
            <div class="card-body">
                <button class="btn btn-primary" data-toggle="modal" data-target="#tambahLowonganModal"
                    id="createNewLowongan">Tambah Data</button>
                <hr>
                <table id="table-data" class="table table-bordered">
                    <thead>
                        {{-- tambah data Lowongan --}}
                        <div class="modal fade" id="tambahLowonganModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Tambah Data Lowongan</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form id="lowonganForm" name="lowonganForm" method="post"
                                            enctype="multipart/form-data">
                                            <div class="modal-body">
                                                @csrf
                                                <div class="form-group">
                                                    <label for="data-nama_loker">Nama Posisi</label>
                                                    <input type="text"class="form-control" name="nama_loker"
                                                        id="data-nama_dokter" required />
                                                </div>
                                                <div class="form-group">
                                                    <label for="data-jumlah_yang_dibutuhkan">Jumlah Yang Dibutuhkan</label>
                                                    <input type="text"class="form-control" name="jumlah_yang_dibutuhkan"
                                                        id="data-jumlah_yang_dibutuhkan" required />
                                                </div>
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
                        <th>Nama Posisi</th>
                        <th>Jumlah Yang Dibutuhkan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                @foreach ($lowongans as $lowongan)
                    <tr style="text-align: center">
                        <td>{{ $lowongan->nama_loker }} </td>
                        <td>{{ $lowongan->jumlah_yang_dibutuhkan }}</td>
                        <td>
                            <div class="btn-group" role="group" aria-label="Basic example">
                                <button type="button" id="btn-edit-jenis"
                                    class="btn btn-success editLowongan-{{ $lowongan->id }}"
                                    onclick="updateConfirmation('{{ $lowongan->id }}')" data-toggle="modal"
                                    data-id="{{ $lowongan->id }}" data-target="#editLowonganModal"
                                    data-nama_loker="{{ $lowongan->nama_loker }}"
                                    data-jumlah_yang_dibutuhkan="{{ $lowongan->jumlah_yang_dibutuhkan }}"
                                    data-created_at="{{ $lowongan->created_at }}">
                                    Edit
                                </button>
                                <a type="button" id="btn-hapus-lowongan"
                                    class="btn btn-danger hapusLowongan-{{ $lowongan->id }}"
                                    onclick="return confirm('Apakah Kamu yakin?')"
                                    href="{{ url('/lowongan/delete/' . $lowongan->id) }}">
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

    <!-- Edit Lowongan -->
    <div class="modal fade" id="editLowonganModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Data Lowongan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times; </span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="edit-nama_loker">Nama Posisi</label>
                                <input type="text" class="form-control" name="nama_loker" id="edit-nama_loker"
                                    required />
                            </div>
                            <div class="form-group">
                                <label for="edit-jumlah_yang_dibuthkan">Jumlah Yang Dibutuhkan</label>
                                <input type="text" class="form-control" name="jumlah_yang_dibutuhkan"
                                    id="edit-jumlah_yang_dibutuhkan" required />
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" name="id" id="edit-id" />
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        <button type="button" onclick="updateData()" class="btn btn-success">Ubah</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script>
        //create
        $(function() {
            $('#lowonganForm').submit(function(e) {
                e.preventDefault();
                $(this).html('Mengirim..');
                $.ajax({
                    data: $('#lowonganForm').serialize(),
                    url: "{{ route('lowongan.store') }}",
                    type: "post",
                    dataType: 'json',
                    success: function(data) {
                        $('#lowonganForm').trigger("reset");
                        $('#tambahLowonganModal').modal('hide');
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
                    url: "{{ url('/lowongan/update') }}",
                    type: "post",
                    dataType: 'json',
                    success: function(data) {
                        $('#editForm').trigger("reset");
                        $('#tambahLowonganModal').modal('hide');
                        table.draw();
                    },
                    error: function(data) {
                        console.log('Error:', data);
                        $('#saveBtn').html('Save Changes');
                    }
                });
                // location.reload();
            });
        })

        //update
        function updateConfirmation(id) {
            $("#edit-nama_loker").val($(".editLowongan-" + id).attr("data-nama_loker"))
            $("#edit-id").val($(".editLowongan-" + id).attr("data-id"))
            $("#edit-jumlah_yang_dibutuhkan").val($(".editLowongan-" + id).attr("data-jumlah_yang_dibutuhkan"))
        }

        function updateData() {
            $.ajax({
                data: {
                    _token: '{{ csrf_token() }}',
                    nama_loker: $("#edit-nama_loker").val(),
                    jumlah_yang_dibutuhkan: $("#edit-jumlah_yang_dibutuhkan").val(),
                    id: $("#edit-id").val(),
                },
                url: "{{ url('/lowongan/update') }}",
                type: "post",
                dataType: 'json',
                success: function(data) {
                    $('#editForm').trigger("reset");
                    $('#tambahLowonganModal').modal('hide');
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
