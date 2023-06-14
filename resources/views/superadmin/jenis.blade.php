@extends('layouts.admin')

@section('main-content')
    <?php
    $params_id = null;

    ?>
    <div class="row mt-5">
        <div class="col-lg-12 margin-tb">
            <div class="float-start">
                <h2>Jenis Soal Asisten</h2>
            </div>
        </div>
    </div>
    <hr>
    <div class="container-fluid">
        <div class="card card-default">
            <div class="card-body">
                <button class="btn btn-primary" data-toggle="modal" data-target="#tambahJenisModal" id="createNewJenis">Tambah
                    Data</button>
                <hr>
                <table id="table-data" class="table table-bordered">
                    <thead>
                        {{-- tambah data Jenis Soal --}}
                        <div class="modal fade" id="tambahJenisModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Tambah Data Jenis Soal</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form id="jenisForm" name="jenisForm" method="post" enctype="multipart/form-data">
                                            <div class="modal-body">
                                                @csrf
                                                <div class="form-group">
                                                    <label for="data-nama_soal">Nama Soal</label>
                                                    <input type="text"class="form-control" name="nama_soal"
                                                        id="data-nama_soal" required />
                                                </div>
                                                <div class="form-group">
                                                    <label for="data-jumlah_soal">Jumlah Soal</label>
                                                    <input type="text"class="form-control" name="jumlah_soal"
                                                        id="data-jumlah_soal" required />
                                                </div>
                                            <div class="form-group">
                                                <label for="data-jumlah_minimal_benar">Jumlah Minimal Benar</label>
                                                <input type="text"class="form-control" name="jumlah_minimal_benar"
                                                    id="data-jumlah_minimal_benar" required />
                                            </div>
                                            <div class="form-group">
                                                <label for="data-total_nilai">Total Nilai</label>
                                                <input type="text"class="form-control" name="total_nilai"
                                                    id="data-total_nilai" required />
                                            </div>
                                            <div class="form-group">
                                                <label for="data-passing_grade">Passing Grade</label>
                                                <input type="text"class="form-control" name="passing_grade"
                                                    id="data-passing_grade" required />
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
            </div>
            <table id="table-data" class="table table-bordered">
                <thead>
                    <tr class="text-center">
                        <th>Nama Soal</th>
                        <th>Jumlah Soal</th>
                        <th>Jumlah Minimal Benar</th>
                        <th>Total Nilai</th>
                        <th>Passing Grade</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                @foreach ($jenis_soals as $jenis_soal)
                    <tr>
                        <td>{{ $jenis_soal->nama_soal }} </td>
                        <td>{{ $jenis_soal->jumlah_soal }}</td>
                        <td>{{ $jenis_soal->jumlah_minimal_benar }} </td>
                        <td>{{ $jenis_soal->total_nilai }}</td>
                        <td>{{ $jenis_soal->passing_grade }}</td>
                        <td>
                            <div class="btn-group" role="group" aria-label="Basic example">
                                <button type="button" id="btn-edit-jenis"
                                    class="btn btn-success editJenis-{{ $jenis_soal->id }}"
                                    onclick="updateConfirmation('{{ $jenis_soal->id }}')" data-toggle="modal"
                                    data-id="{{ $jenis_soal->id }}" data-target="#editJenisModal"
                                    data-nama_soal="{{ $jenis_soal->nama_soal }}"
                                    data-jumlah_soal="{{ $jenis_soal->jumlah_soal }}"
                                    data-jumlah_minimal_benar="{{ $jenis_soal->jumlah_minimal_benar }}"
                                    data-total_nilai="{{ $jenis_soal->total_nilai }}"
                                    data-passing_grade="{{ $jenis_soal->passing_grade }}"
                                    data-created_at="{{ $jenis_soal->created_at }}">
                                    Edit
                                </button>
                                <a type="button" id="btn-hapus-jenis"
                                    class="btn btn-danger hapusJenis-{{ $jenis_soal->id }}"
                                    onclick="return confirm('Apakah Kamu yakin?')"
                                    href="{{ url('/jenis/delete/' . $jenis_soal->id) }}">
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

    <!-- Edit Jenis Soal -->
    <div class="modal fade" id="editJenisModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Data Jenis Soal</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times; </span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" enctype="multipart/form-data" name="jenisFormUpdate" id="editForm">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="edit-nama_soal">Nama Soal</label>
                                    <input type="text" class="form-control" name="nama_soal" id="edit-nama_soal"
                                        required />
                                </div>
                                <div class="form-group">
                                    <label for="edit-jumlah_soal">Jumlah Soal</label>
                                    <input type="text" class="form-control" name="jumlah_soal" id="edit-jumlah_soal"
                                        required />
                                </div>
                                <div class="form-group">
                                    <label for="edit-jumlah_minimal_benar">Jumlah Minimal Benar</label>
                                    <input type="text" class="form-control" name="jumlah_minimal_benar"
                                        id="edit-jumlah_minimal_benar" required />
                                </div>
                                <div class="form-group">
                                    <label for="edit-total_nilai">Total Nilai</label>
                                    <input type="text" class="form-control" name="total_nilai" id="edit-total_nilai"
                                        required />
                                </div>
                                <div class="form-group">
                                    <label for="edit-passing_grade">Passing Grade</label>
                                    <input type="text" class="form-control" name="passing_grade"
                                        id="edit-passing_grade" required />
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
            $('#jenisForm').submit(function(e) {
                e.preventDefault();
                $(this).html('Mengirim..');
                $.ajax({
                    data: $('#jenisForm').serialize(),
                    url: "{{ route('jenis.store') }}",
                    type: "post",
                    dataType: 'json',
                    success: function(data) {
                        $('#jenisForm').trigger("reset");
                        $('#tambahJenisModal').modal('hide');
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
                    url: "{{ url('/jenis/update') }}",
                    type: "post",
                    dataType: 'json',
                    success: function(data) {
                        $('#editForm').trigger("reset");
                        $('#tambahJenisModal').modal('hide');
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
            $("#edit-nama_soal").val($(".editJenis-" + id).attr("data-nama_soal"))
            $("#edit-id").val($(".editJenis-" + id).attr("data-id"))
            $("#edit-jumlah_soal").val($(".editJenis-" + id).attr("data-jumlah_soal"))
            $("#edit-jumlah_minimal_benar").val($(".editJenis-" + id).attr("data-jumlah_minimal_benar"))
            $("#edit-total_nilai").val($(".editJenis-" + id).attr("data-total_nilai"))
            $("#edit-passing_grade").val($(".editJenis-" + id).attr("data-passing_grade"))
        }

        function updateData() {
            $.ajax({
                data: {
                    _token: '{{ csrf_token() }}',
                    nama_soal: $("#edit-nama_soal").val(),
                    jumlah_soal: $("#edit-jumlah_soal").val(),
                    jumlah_minimal_benar: $("#edit-jumlah_minimal_benar").val(),
                    total_nilai: $("#edit-total_nilai").val(),
                    passing_grade: $("#edit-passing_grade").val(),
                    id: $("#edit-id").val(),
                },
                url: "{{ url('/jenis/update') }}",
                type: "post",
                dataType: 'json',
                success: function(data) {
                    $('#editForm').trigger("reset");
                    $('#tambahJenisModal').modal('hide');
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
