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
            Data Panitia
            <h6 class="d-block text-muted pt-2 font-size-sm m-0 p-0 fst-italic">
              Management Data Panitia
            </h6>
          </h3>
        </div>
        <div class="card-toolbar ml-auto">
          <div class="row d-flex justify-content-end">
            <button class="btn btn-outline-success font-weight-bolder" data-toggle="modal" data-target="#tambahPanitiaModal" id="createNewPanitia">
              <i class="fa-solid fa-file-circle-plus"></i>
              Tambah Data
            </button>
          </div>
        </div>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table id="table-data" class="table">
            <thead>
              <tr class="text-uppercase">
                <th>Nama</th>
                <th>Email</th>
                <th>Aksi</th>
              </tr>
            </thead>

            <tbody>
              @foreach ($users as $user)
              <tr>
                <td>{{ $user->nama }} </td>
                <td>{{ $user->email }} </td>
                <td>
                  <button
                    type="button"
                    id="btn-edit-panitia"
                    class="btn btn-outline-success btn-sm editPanitia-{{ $user->id }}"
                    title="Edit Panitia"
                    onclick="updateConfirmation('{{ $user->id }}')"
                    data-toggle="modal"
                    data-id="{{ $user->id }}"
                    data-target="#editPanitiaModal"
                    data-nama="{{ $user->nama }}"
                    data-password="{{ $user->password }}"
                    data-email="{{ $user->email }}"
                    data-created_at="{{ $user->created_at }}"
                  >
                    <i class="fa-solid fa-pen-to-square"></i>
                  </button>
                  <a
                    type="button"
                    id="btn-hapus-panitia"
                    title="Hapus"
                    class="btn btn-outline-danger btn-sm hapusPanitia-{{ $user->id }}"
                    onclick="return confirm('Apakah Kamu yakin?')"
                    href="{{ url('/datapanitia/delete/' . $user->id) }}"
                  >
                    <i class="fas fa-trash"></i>
                  </a>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Edit Panitia -->
<div class="modal fade" id="editPanitiaModal" tabindex="-1" aria-labelledby="editPanitiaModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title text-capitalize" id="editPanitiaModalLabel">Edit Panitia</h5>
        <a style="cursor: pointer" data-dismiss="modal" aria-label="Close">
          <i class="fa-solid fa-xmark"></i>
        </a>
      </div>
      <div class="modal-body p-0 pb-0">
        <div class="card card-custom">
          <div class="card-body">
            <div class="row">
              <form method="post" enctype="multipart/form-data" name="panitiaFormUpdate" id="editForm">
                <div class="row">
                  <div class="col-12">
                    <div class="form-group">
                      <label>Nama</label>
                      <input type="text" class="form-control form-control-sm" name="nama" id="edit-nama" required />
                    </div>
                  </div>
                  <div class="col-12">
                    <div class="form-group">
                      <label for="edit-password">Email</label>
                      <input type="username" class="form-control form-control-sm" name="email" id="edit-email" required disabled />
                    </div>
                  </div>
                  <div class="col-12">
                    <div class="form-group">
                      <label for="edit-password">Password</label>
                      <input type="text" class="form-control form-control-sm" id="edit-password" required />
                    </div>
                  </div>
                  <div class="col-12">
                    <div class="form-group">
                      <label for="edit-password">Konfirmasi Password</label>
                      <input type="text" class="form-control form-control-sm" name="password" id="konfirmasi-password" required />
                    </div>
                  </div>
                </div>
                <div class="modal-footer">
                  <input type="hidden" name="id" id="edit-id" />
                  <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Tutup</button>
                  <button type="submit" onclick="updateData()" class="btn btn-primary mr-1 btn-submit btn-sm">SIMPAN</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

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
              <input type="text" class="form-control" name="nama" id="data-nama" required />
            </div>
            <div class="form-group">
              <label for="data-password">Kata Sandi</label>
              <input type="text" class="form-control" name="password" id="data-password" required />
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
              <button type="submit" class="btn btn-primary" id="saveBtn" value="create">Kirim</button>
            </div>
        </form>
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
  $("#edit-email").val($(".editPanitia-" + id).attr("data-email"))
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
