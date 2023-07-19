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
           Nilai
           <h6 class="d-block text-muted pt-2 font-size-sm m-0 p-0 fst-italic">
             Management Data Nilai
           </h6>
         </h3>
       </div>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table id="table-data" class="table">
            <thead>
              <tr class="text-uppercase">
                <th style="text-align: center;width: 5%">No</th>
                <th>Nama Peserta</th>
                <th>Nilai Minat</th>
                <th>Nilai Pengetahuan</th>
                <th>Nilai Psikotest</th>
                <th>Nilai Wawancara</th>
                @hasanyrole('panitia|admin')
                <th>Aksi</th>
                @endhasanyrole
              </tr>
            </thead>
            <tbody>
              @foreach ($datanilai as $no => $row)
                <tr>
                  <td style="text-align: center">{{ ++$no + ($row->currentPage()-1) * $row->perPage() }}</td>
                  <td>{{ $row->nama_user }}</td>
                  <td>{{ $row->nilai_minat }}</td>
                  <td>{{ $row->nilai_pengetahuan }}</td>
                  <td>{{ $row->nilai_psikotest }}</td>
                  <td>{{ $row->nilai_wawancara }}</td>
                  @hasanyrole('panitia|admin')
                  <td>
                    <a
                      class="btn btn-outline-success btn-sm btn-edit"
                      title="Edit Soal"
                      data-bs-toggle="modal"
                      data-bs-target="#modalEditNilai"
                      data-id={{ $row->id }}
                      data-nama-user={{ $row->nama_user }}
                      data-minat={{ $row->nilai_minat }}
                      data-pengetahuan={{ $row->nilai_pengetahuan }}
                      data-psikotes={{ $row->nilai_psikotest }}
                      data-wawancara={{ $row->nilai_wawancara }}
                    >
                      <i class="fa-solid fa-pen-to-square"></i>
                    </a>
                    <a
                      type="button"
                      title="Hapus"
                      class="btn btn-outline-danger btn-sm hapusNilai-{{ $row->id }}"
                      onclick="return confirm('Apakah Kamu yakin?')"
                      href="{{ url('/datanilais/delete/' . $row->id) }}"
                    >
                      <i class="fas fa-trash"></i>
                    </a>
                  </td>
                  @endhasanyrole
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>

{{--  Modal Edit  --}}
<div class="modal fade" id="modalEditNilai" tabindex="-1" aria-labelledby="modalEditNilaiLabel"
  aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title text-capitalize" id="modalEditNilaiLabel">Edit Nilai</h5>
        <a style="cursor: pointer" data-bs-dismiss="modal" aria-label="Close">
          <i class="fa-solid fa-xmark"></i>
        </a>
      </div>
      <div class="modal-body p-0 pb-0">
        <div class="card card-custom">
          <div class="card-body">
            <div class="row" style="min-height: 100%;">
              <form id="formEditNilai" action="" method="POST" enctype="multipart/form-data">
                <div class="row">
                  <div class="col-12">
                    <div class="form-group">
                      <label for="data-nama_user">Nama Peserta</label>
                      <input type="text" class="form-control" placeholder="Masukkan Nama Peserta" name="nama_user" id="data-nama-user" required disabled />
                    </div>
                  </div>
                  <div class="col-6">
                    <div class="form-group">
                      <label for="data-minat">Nilai Minat</label>
                      <input type="number" class="form-control" placeholder="Masukkan Nilai Minat" name="minat" id="data-minat" required />
                    </div>
                  </div>
                  <div class="col-6">
                    <div class="form-group">
                      <label for="data-pengetahuan">Nilai Pengetahuan</label>
                      <input type="number" class="form-control" placeholder="Masukkan Nilai Pengetahuan" name="pengetahuan" id="data-pengetahuan" required />
                    </div>
                  </div>
                  <div class="col-6">
                    <div class="form-group">
                      <label for="data-psikotes">Nilai Psikotes</label>
                      <input type="number" class="form-control" placeholder="Masukkan Nilai Psikotes" name="psikotes" id="data-psikotes" required />
                    </div>
                  </div>
                  <div class="col-6">
                    <div class="form-group">
                      <label for="data-wawancara">Nilai Wawancara</label>
                      <input type="number" class="form-control" placeholder="Masukkan Nilai Wawancara" name="wawancara" id="data-wawancara" required />
                    </div>
                  </div>
                </div>
                <div class="modal-footer mt-3">
                  <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Tutup</button>
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
</div>

<script>
  $(document).ready(function() {
    $('.btn-edit').each(function() {
      $(this).on('click', function() {
        var id = $(this).data('id');
        var nama = $(this).data('nama_user');
        var minat = $(this).data('nilai_minat');
        var pengetahuan = $(this).data('nilai_pengetahuan');
        var psikotes = $(this).data('nilai_psikotest');
        var wawancara = $(this).data('nilai_wawancara');

        $("#data-nama-user").val(nama)
        $("#data-minat").val(minat)
        $("#data-pengetahuan").val(pengetahuan)
        $("#data-psikotest").text(psikotes);
        $("#data-wawancara").val(wawancara);
        $('#formEditNilai').on('submit', function(e) {
          e.preventDefault();

          var formAction = $(this).attr('action');
          var appendedString = '{{ route('datanilais.update', '$id') }}';
          var newAction = formAction + appendedString;
          $(this).attr('action', newAction);

          this.submit();
        });
      });
    });
  });
</script>
@endsection
