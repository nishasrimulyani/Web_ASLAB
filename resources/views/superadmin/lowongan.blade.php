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
             Lowongan Asisten
            <h6 class="d-block text-muted pt-2 font-size-sm m-0 p-0 fst-italic">
              Management Data Lowongan Asisten
            </h6>
          </h3>
        </div>
        @hasanyrole('panitia|admin')
        <div class="card-toolbar ml-auto">
          <div class="row d-flex justify-content-end">
            <button class="btn btn-outline-success font-weight-bolder" data-toggle="modal" data-target="#tambahLowonganModal" id="createNewLowongan">
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
                <th style="text-align: center;width: 5%">No</th>
                <th>Nama Posisi</th>
                <th>Jumlah Yang Dibutuhkan</th>
                <th>Aksi</th>
              </tr>
            </thead>

            @foreach ($lowongans as $no => $lowongan)
            <tr>
              <td style="text-align: center">{{ ++$no + ($lowongans->currentPage()-1) *
                $lowongans->perPage() }}</td>
              <td>{{ $lowongan->nama_loker }} </td>
              <td>{{ $lowongan->jumlah_yang_dibutuhkan }}</td>
              <td>
                <button
                  type="button"
                  title="Edit Lowongan"
                  class="btn btn-outline-success btn-sm editLowongan-{{ $lowongan->id }}"
                  onclick="updateConfirmation('{{ $lowongan->id }}')"
                  data-toggle="modal"
                  data-target="#editLowonganModal"
                  data-id="{{ $lowongan->id }}"
                  data-nama_loker="{{ $lowongan->nama_loker }}"
                  data-jumlah_yang_dibutuhkan="{{ $lowongan->jumlah_yang_dibutuhkan }}"
                  data-created_at="{{ $lowongan->created_at }}"
                >
                  <i class="fa-solid fa-pen-to-square"></i>
                </button>
                <a
                  type="button"
                  id="btn-hapus-lowongan"
                  class="btn btn-outline-danger btn-sm hapusLowongan-{{ $lowongan->id }}"
                  onclick="return confirm('Apakah Kamu yakin?')"
                  href="{{ url('/lowongan/delete/' . $lowongan->id) }}"
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
        <form id="lowonganForm" name="lowonganForm" method="post" enctype="multipart/form-data">
          <div class="modal-body">
            @csrf
            <div class="form-group">
              <label for="data-nama_loker">Nama Posisi</label>
              <input type="text" class="form-control" name="nama_loker" id="data-nama_dokter" required />
            </div>
            <div class="form-group">
              <label for="data-jumlah_yang_dibutuhkan">Jumlah Yang Dibutuhkan</label>
              <input type="number" class="form-control" name="jumlah_yang_dibutuhkan"
                id="data-jumlah_yang_dibutuhkan" required />
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
            <button type="submit" class="btn btn-primary" id="saveBtn" value="create">Kirim</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</thead>

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
              <input type="text" class="form-control" name="nama_loker" id="edit-nama_loker" required />
            </div>
            <div class="form-group">
              <label for="edit-jumlah_yang_dibuthkan">Jumlah Yang Dibutuhkan</label>
              <input type="number" class="form-control" name="jumlah_yang_dibutuhkan" id="edit-jumlah_yang_dibutuhkan"
                required />
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
