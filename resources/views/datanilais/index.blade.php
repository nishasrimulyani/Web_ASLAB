@extends('layouts.single-content')

@section('main-content')
<?php
    $params_id = null;
?>

<div class="row">
  <div class="col-12">
    <div id="notifikasi">
      @if(Session::get('success'))
      <div class="alert alert-success alert-dismissible fade show" id="successAlert" role="alert">
        {{ Session::get('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
      @endif
    </div>
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
      <div class="card-body px-0">
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
              @php $i = 1; @endphp
              @foreach ($datanilai as $no => $row)
                <tr>
                  <td style="text-align: center">{{ $i++ }}</td>
                  <td>{{ $row->nama_user }}</td>
                  <td>{{ $row->nilai_minat }}</td>
                  <td>{{ $row->nilai_pengetahuan }}</td>
                  <td>{{ $row->nilai_psikotest }}</td>
                  <td>{{ ($row->nilai_wawancara == null) ? '-' : $row->nilai_wawancara }}</td>
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
                      data-psikotest={{ $row->nilai_psikotest }}
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
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title text-capitalize" id="modalEditNilaiLabel">Edit Nilai</h5>
        <a style="cursor: pointer" data-bs-dismiss="modal" aria-label="Close">
          <i class="fa-solid fa-xmark"></i>
        </a>
      </div>
      <div class="modal-body p-0 pb-0">
        <div class="card card-custom">
          <div class="card-body px-0">
            <div class="row" style="min-height: 100%;">
              <form id="formEditNilai" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                  <div class="col-12">
                    <div class="form-group">
                      <label class="p-0">
                        <small>Nama Peserta :</small>
                      </label>
                      <p class="m-0 p-0">
                        <strong class="data-nama-user">
                        </strong>
                      </p>
                      <input type="hidden" class="form-control" placeholder="Masukkan Nama Peserta" name="nama_user" id="data-nama-user" required readonly />
                    </div>
                  </div>
                </div>
                <div class="row bg-body-secondary mx-0 py-md-3 py-5 rounded-sm">
                  <div class="col-3">
                    <div class="form-group">
                      <label class="p-0">
                        <small>Nilai Minat :</small>
                      </label>
                      <p class="m-0 p-0">
                        <strong class="data-minat text-primary h5">
                        </strong>
                      </p>
                      <input type="hidden" min="1" class="form-control" placeholder="Masukkan Nilai Minat" name="nilai_minat" id="data-minat" required readonly/>
                    </div>
                  </div>
                  <div class="col-5">
                    <div class="form-group">
                      <label class="p-0">
                        <small>Nilai Pengetahuan :</small>
                      </label>
                      <p class="m-0 p-0">
                        <strong class="data-pengetahuan text-info h5">
                        </strong>
                      </p>
                      <input type="hidden" min="1" class="form-control" placeholder="Masukkan Nilai Pengetahuan" name="nilai_pengetahuan" id="data-pengetahuan" required readonly >
                    </div>
                  </div>
                  <div class="col-4">
                    <div class="form-group">
                      <label class="p-0">
                        <small>Nilai Psikotes :</small>
                      </label>
                      <p class="m-0 p-0">
                        <strong class="data-psikotest text-success h5">
                        </strong>
                      </p>
                      <input type="hidden" min="1" class="form-control" placeholder="Masukkan Nilai Psikotes" name="nilai_psikotes" id="data-psikotest" required readonly/>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-12">
                    <hr>
                    <div class="form-group">
                      <label for="data-wawancara">Nilai Wawancara</label>
                      <input type="number" min="1" class="form-control" placeholder="Masukkan Nilai Wawancara" name="nilai_wawancara" id="data-wawancara" required />
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
        var nama = $(this).data('nama-user');
        var minat = $(this).data('minat');
        var pengetahuan = $(this).data('pengetahuan');
        var psikotes = $(this).data('psikotest');
        var wawancara = $(this).data('wawancara');

        $('.data-id').text(id);
        $(".data-nama-user").text(nama)
        $(".data-minat").text(minat)
        $(".data-pengetahuan").text(pengetahuan)
        $(".data-psikotest").text(psikotes);
        $(".data-wawancara").text(wawancara);

        $('#data-id').val(id);
        $("#data-nama-user").val(nama)
        $("#data-minat").val(minat)
        $("#data-pengetahuan").val(pengetahuan)
        $("#data-psikotest").val(psikotes);
        $("#data-wawancara").val(wawancara);


        $('#formEditNilai').on('submit', function(e) {
          e.preventDefault();
          var id = $('#data-id').val();
          var nilai_wawancara = $('#data-wawancara').val();
          var table = $('#table-data');
            $.ajax({
              url: "{{ url('nilai/update') }}/"+id+"",
              data: $(this).serializeArray(),
              type: "post",
              dataType: 'json',
              success: function(response) {
                $('#modalEditNilai').trigger("reset");
                var notifikasi = `
                <div class="alert alert-success alert-dismissible fade show" id="successAlert" role="alert">
                  ${response.message}
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                `;
                $('#notifikasi').append(notifikasi);

                setTimeout(function() {
                  $('#successAlert').alert('close');
                }, 2000);
            },
            error: function(response) {
                console.log('Error:', response);
                $('#saveBtn').html('Save Changes');
            }
          });
          $('#modalEditNilai').modal('hide');
          table.load(document.URL + ' #table-data');
        });
      });
    });
  });
</script>
@endsection
