@extends('layouts.admin')

@section('main-content')
<?php
    $params_id = null;

    ?>
<div class="row">
  <div class="col-12">
    <div class="card d-flex border-0 p-0">
      <div class="card-header d-flex border-0 pt-6 pb-6 px-1" style="background: none">
        <div class="card-title">
          <h3 class="card-label text-capitalize m-0 p-0">
            Jenis Soal
            <h6 class="d-block text-muted pt-2 font-size-sm m-0 p-0 fst-italic">
              Management Data Jenis Soal
            </h6>
          </h3>
        </div>
        @hasanyrole('panitia|admin')
        <div class="card-toolbar ml-auto">
          <div class="row d-flex justify-content-end">
            <button class="btn btn-outline-success font-weight-bolder" title="Tambah Data" data-toggle="modal" data-target="#tambahJenisModal" id="createNewJenis">
              <i class="fa-solid fa-file-circle-plus"></i>
              Tambah Data
            </button>
          </div>
        </div>
        @endhasanyrole
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table id="table-data" class="table">
            <thead>
              <tr class="text-uppercase">
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
                <button
                  type="button"
                  title="Edit Jenis"
                  class="btn btn-outline-success btn-sm editJenis-{{ $jenis_soal->id }}"
                  onclick="updateConfirmation('{{ $jenis_soal->id }}')"
                  data-bs-toggle="modal"
                  data-bs-target="#editJenisModal"
                  data-id="{{ $jenis_soal->id }}"
                  data-nama_soal="{{ $jenis_soal->nama_soal }}"
                  data-jumlah_soal="{{ $jenis_soal->jumlah_soal }}"
                  data-jumlah_minimal_benar="{{ $jenis_soal->jumlah_minimal_benar }}"
                  data-total_nilai="{{ $jenis_soal->total_nilai }}"
                  data-passing_grade="{{ $jenis_soal->passing_grade }}"
                  data-created_at="{{ $jenis_soal->created_at }}"
                >
                  <i class="fa-solid fa-pen-to-square"></i>
                </button>
                <a
                  type="button"
                  id="btn-hapus-jenis"
                  class="btn btn-outline-danger btn-sm hapusJenis-{{ $jenis_soal->id }}"
                  onclick="return confirm('Apakah Kamu yakin?')"
                  href="{{ url('/jenis/delete/' . $jenis_soal->id) }}"
                >
                    <i class="fas fa-trash"></i>
                </a>
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
</div>

<div class="modal fade" id="tambahJenisModal" tabindex="-1" aria-labelledby="exampleModalLabel"
aria-hidden="true">
<div class="modal-dialog">
  <div class="modal-content">
    <div class="modal-header">
      <h5 class="modal-title" id="exampleModalLabel">Tambah Jenis Soal</h5>
      <a style="cursor: pointer" data-dismiss="modal" aria-label="Close">
        <i class="fa-solid fa-xmark"></i>
      </a>
    </div>
    <div class="modal-body p-0 pb-0">
      <div class="card card-custom">
        <div class="card-body">
          <div class="row">
            <form id="jenisForm" name="jenisForm" method="post" enctype="multipart/form-data">
              @csrf
              <div class="row">
                <div class="col-12">
                  <div class="form-group">
                    <label for="data-nama_soal">Nama Soal</label>
                    <input type="text" class="form-control" placeholder="Masukkan Nama Soal" name="nama_soal" id="data-nama_soal" required />
                  </div>
                </div>
                <div class="col-6">
                  <div class="form-group">
                    <label for="data-jumlah_soal">Jumlah Soal</label>
                    <input type="number" class="form-control" placeholder="Masukkan Jumlah Soal" name="jumlah_soal" id="data-jumlah_soal" required />
                  </div>
                </div>
                <div class="col-6">
                  <div class="form-group">
                    <label for="data-jumlah_minimal_benar">Jumlah Minimal Benar</label>
                    <input type="number" class="form-control" placeholder="Masukkan Jumlah Minimal Benar" name="jumlah_minimal_benar"
                    id="data-jumlah_minimal_benar" required />
                  </div>
                </div>
                <div class="col-6">
                  <div class="form-group">
                    <label for="data-total_nilai">Total Nilai</label>
                    <input type="number" class="form-control" name="total_nilai" placeholder="Masukkan Total Nilai" id="data-total_nilai" required />
                  </div>
                </div>
                <div class="col-6">
                  <div class="form-group">
                    <label for="data-passing_grade">Passing Grade</label>
                    <input type="number" class="form-control" name="passing_grade" placeholder="Masukkan Passing Grade" id="data-passing_grade" required />
                  </div>
                </div>
              </div>

              <div class="modal-footer">
                <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Tutup</button>
                <button class="btn btn-primary mr-1 btn-submit btn-sm" type="submit">
                  SIMPAN
                </button>
              </div>
            </form>
          </div>
        </div>
      </div>
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
                <input type="text" class="form-control" name="nama_soal" id="edit-nama_soal" required />
              </div>
              <div class="form-group">
                <label for="edit-jumlah_soal">Jumlah Soal</label>
                <input type="text" class="form-control" name="jumlah_soal" id="edit-jumlah_soal" required />
              </div>
              <div class="form-group">
                <label for="edit-jumlah_minimal_benar">Jumlah Minimal Benar</label>
                <input type="text" class="form-control" name="jumlah_minimal_benar" id="edit-jumlah_minimal_benar"
                  required />
              </div>
              <div class="form-group">
                <label for="edit-total_nilai">Total Nilai</label>
                <input type="text" class="form-control" name="total_nilai" id="edit-total_nilai" required />
              </div>
              <div class="form-group">
                <label for="edit-passing_grade">Passing Grade</label>
                <input type="text" class="form-control" name="passing_grade" id="edit-passing_grade" required />
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
