@extends('layouts.single-content')

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
            Bank Soal
            <h6 class="d-block text-muted pt-2 font-size-sm m-0 p-0 fst-italic">
              Management Data Bank Soal
            </h6>
          </h3>
        </div>
        @hasanyrole('panitia|admin')
        <div class="card-toolbar ml-auto">
          <div class="row d-flex justify-content-end">
            <a href="{{ route('soals.create') }}">
              <button class="btn btn-outline-success font-weight-bolder" title="Tambah Data">
                <i class="fa-solid fa-file-circle-plus"></i>
                Tambah Data
              </button>
            </a>
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
                <th>Jenis Soal</th>
                <th>Isi Soal</th>
                <th>Pilihan A</th>
                <th>Pilihan B</th>
                <th>Pilihan C</th>
                <th>Pilihan D</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($questions as $no => $question)
              <tr>
                <td style="text-align: center">{{ ++$no + ($questions->currentPage()-1) *
                  $questions->perPage() }}</td>
                <td>{{ $subject->getName($question->jenis_id) }}</td>
                <td>
                  <div
                  style="width: 25ch;
                    text-transform: none;
                    white-space: nowrap;
                    overflow: hidden;
                    text-overflow: ellipsis;"
                    title={!! $question->detail !!}>
                    {!! $question->detail !!}
                  </div>
                </td>
                <td>{{ $question->option_A }}</td>
                <td>{{ $question->option_B }}</td>
                <td>{{ $question->option_C }}</td>
                <td>{{ $question->option_D }}</td>
                <!-- <td>{{ $user->getName($question->dibuat_oleh) }}</td> -->
                <td>
                  <a
                    class="btn btn-outline-info btn-sm btn-detail"
                    title="Lihat Detail"
                    data-bs-toggle="modal"
                    data-bs-target="#modalDetailSoal"
                    data-id={{ $question->id }}
                    data-gambar={{ $question->image_id ? Storage::url('public/images/'.$image->getLink($question->image_id)) : '-'}}
                    data-jenis={{ $subject->getName($question->jenis_id) }}
                    data-isi={{ $question->detail }}
                    data-a={{ $question->option_A }}
                    data-b={{ $question->option_B }}
                    data-c={{ $question->option_C }}
                    data-d={{ $question->option_D }}
                    data-jawaban={{ $question->jawaban }}
                    data-penjelasan={{$question->penjelasan }}
                  >
                    <i class="fa-solid fa-eye"></i>
                  </a>
                  <a
                    class="btn btn-outline-success btn-sm btn-edit"
                    title="Edit Soal"
                    data-bs-toggle="modal"
                    data-bs-target="#modalEditSoal"
                    data-id={{ $question->id }}
                    data-gambar={{ $question->image_id ? Storage::url('public/images/'.$image->getLink($question->image_id)) : '-'}}
                    data-jenis={{ $subject->getName($question->jenis_id) }}
                    data-isi={{ $question->detail }}
                    data-a={{ $question->option_A }}
                    data-b={{ $question->option_B }}
                    data-c={{ $question->option_C }}
                    data-d={{ $question->option_D }}
                    data-jawaban={{ $question->jawaban }}
                    data-penjelasan={{$question->penjelasan }}
                  >
                    <i class="fa-solid fa-pen-to-square"></i>
                  </a>
                  <a
                    type="button"
                    id="btn-hapus-soal"
                    title="Hapus"
                    class="btn btn-outline-danger btn-sm hapusJenis-{{ $question->id }}"
                    onclick="return confirm('Apakah Kamu yakin?')"
                    href="{{ url('/soal/delete/' . $question->id) }}"
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

{{--  Modal Detail  --}}
<div class="modal fade" id="modalDetailSoal" tabindex="-1" aria-labelledby="modalDetailSoalLabel"
  aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title text-capitalize" id="modalDetailSoalLabel">Detail Soal</h5>
        <a style="cursor: pointer" data-bs-dismiss="modal" aria-label="Close">
          <i class="fa-solid fa-xmark"></i>
        </a>
      </div>
      <div class="modal-body p-0 pb-0">
        <div class="card card-custom">
          <div class="card-body">
            <div class="row" style="min-height: 100%;">
              <div class="col-6" style="min-height: 100%;">
                <div class="row">
                  <div class="col-12">
                    <div class="row">
                      <div class="col-4">
                        <div class="form-group">
                          <label class="p-0">
                            <small>ID Soal :</small>
                          </label>
                          <p class="m-0 p-0">
                            <strong class="id-soal">
                            </strong>
                          </p>
                        </div>
                      </div>
                      <div class="col-4">
                        <div class="form-group">
                          <label class="p-0">
                            <small>Jenis Soal :</small>
                          </label>
                          <p class="m-0 p-0">
                            <strong class="jenis-soal">
                            </strong>
                          </p>
                        </div>
                      </div>
                      <div class="col-4">
                        <div class="form-group">
                          <label class="p-0">
                            <small>Gambar Soal :</small>
                          </label>
                          <p class="m-0 p-0">
                            <div id="gambar-soal"></div>
                            <strong class="gambar-soal"></strong>
                          </p>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <hr class="mt-0">
                <div class="row bg-body-secondary mx-0 py-md-3 py-5 rounded-sm">
                  <div class="col-12 mb-2">
                    <h6>ISI SOAL</h6>
                  </div>
                  <div class="col-12">
                    <p class="m-0 p-0 isi-soal">
                    </p>
                  </div>
                </div>
              </div>

              <div class="col-6" style="min-height: 100%;">
                <div class="row bg-body-secondary mx-0 py-md-3 py-5 rounded-sm" style="min-height: 100%;">
                  <div class="col-3">
                    <div class="form-group">
                      <label class="p-0">
                        <small>Jawaban A :</small>
                      </label>
                      <p class="m-0 p-0">
                        <strong class="jawaban-a"></strong>
                      </p>
                    </div>
                  </div>
                  <div class="col-3">
                    <div class="form-group">
                      <label class="p-0">
                        <small>Jawaban B :</small>
                      </label>
                      <p class="m-0 p-0">
                        <strong class="jawaban-b"></strong>
                      </p>
                    </div>
                  </div>
                  <div class="col-3">
                    <div class="form-group">
                      <label class="p-0">
                        <small>Jawaban C :</small>
                      </label>
                      <p class="m-0 p-0">
                        <strong class="jawaban-c"></strong>
                      </p>
                    </div>
                  </div>
                  <div class="col-3">
                    <div class="form-group">
                      <label class="p-0">
                        <small>Jawaban D :</small>
                      </label>
                      <p class="m-0 p-0">
                        <strong class="jawaban-d"></strong>
                      </p>
                    </div>
                  </div>

                  <div class="col-12">
                    <h6>PENJELASAN JAWABAN</h6>
                  </div>
                  <div class="col-12">
                    <p class="m-0 p-0 penjelasan-jawaban">
                    </p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

{{--  Modal Edit  --}}
<div class="modal fade" id="modalEditSoal" tabindex="-1" aria-labelledby="modalEditSoalLabel"
  aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title text-capitalize" id="modalEditSoalLabel">Edit Soal</h5>
        <a style="cursor: pointer" data-bs-dismiss="modal" aria-label="Close">
          <i class="fa-solid fa-xmark"></i>
        </a>
      </div>
      <div class="modal-body p-0 pb-0">
        <div class="card card-custom">
          <div class="card-body">
            <div class="row" style="min-height: 100%;">
              <form id="formEditSoal" action="" method="POST" enctype="multipart/form-data">
                <div class="row">
                  <div class="col-6 pl-0" style="min-height: 100%;">
                    <div class="card card-default" style="min-height: 100%;">
                      <div class="card-header">
                        <h6 class="m-0">Soal</h6>
                      </div>
                      <div class="card-body bg-body-tertiary">
                        @csrf
                        <div class="row" style="min-height: 100%;">
                          <div class="col-6">
                            <div class="form-group">
                              <label>Jenis Soal</label>
                              <select class="form-select select-subject @error('jenis_id') is-invalid @enderror" name="jenis_id">
                                <option value="">Pilih Jenis Soal</option>
                                @foreach ($selectSubject as $subject)
                                <option value="{{ $subject->id }}">{{ $subject->nama_soal }}</option>
                                @endforeach
                              </select>
                              @error('subject_id')
                              <div class="invalid-feedback font-italic fst-italic" style="display: block">
                                {{ $message }}
                              </div>
                              @enderror
                            </div>
                          </div>
                          <div class="col-6">
                            <div class="form-group">
                              <label>Gambar</label>
                              <select class="form-select select-image @error('image_id') is-invalid @enderror" name="image_id">
                                <option value="">Pilih Gambar</option>
                                @foreach ($selectImage as $image)
                                <option value="{{ $image->id }}">{{ $image->judul }}</option>
                                @endforeach
                              </select>
                              @error('image_id')
                              <div class="invalid-feedback font-italic fst-italic" style="display: block">
                                {{ $message }}
                              </div>
                              @enderror
                            </div>
                          </div>
                        </div>
                        <div class="form-group pb-2">
                          <label>Isi Soal</label>
                          <textarea name="detail" cols="17" rows="17" class="form-control isi-soal" placeholder="Masukkan Isi Soal"></textarea>
                          @error('detail')
                          <div class="invalid-feedback font-italic fst-italic" style="display: block">
                            {{ $message }}
                          </div>
                          @enderror
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-6 pr-0" style="min-height: 100%;">
                    <div class="card card-default" style="min-height: 100%;">
                      <div class="card-header">
                        <h6 class="m-0">Jawaban</h6>
                      </div>
                      <div class="card-body bg-body-tertiary">
                        <div class="row" style="min-height: 100%;">
                          <div class="col-6">
                            <div class="form-group">
                              <label>Pilihan A</label>
                              <input type="text" name="option_A" value="{{ old('option_A') }}" class="form-control jawaban-a" placeholder="Masukkan Pilihan A">
                              @error('option_A')
                              <div class="invalid-feedback font-italic fst-italic" style="display: block">
                                {{ $message }}
                              </div>
                              @enderror
                            </div>
                          </div>
                          <div class="col-6">
                            <div class="form-group">
                              <label>Pilihan B</label>
                              <input type="text" name="option_B" value="{{ old('option_B') }}" class="form-control jawaban-b" placeholder="Masukkan Pilihan B">
                              @error('option_B')
                              <div class="invalid-feedback font-italic fst-italic" style="display: block">
                                {{ $message }}
                              </div>
                              @enderror
                            </div>
                          </div>
                          <div class="col-6">
                            <div class="form-group">
                              <label>Pilihan C</label>
                              <input type="text" name="option_C" value="{{ old('option_C') }}" class="form-control jawaban-c" placeholder="Masukkan Pilihan C">
                              @error('option_C')
                              <div class="invalid-feedback font-italic fst-italic" style="display: block">
                                {{ $message }}
                              </div>
                              @enderror
                            </div>
                          </div>
                          <div class="col-6">
                            <div class="form-group">
                              <label>Pilihan D</label>
                              <input type="text" name="option_D" value="{{ old('option_D') }}" class="form-control jawaban-d" placeholder="Masukkan Pilihan D">
                              @error('option_D')
                              <div class="invalid-feedback font-italic fst-italic" style="display: block">
                                {{ $message }}
                              </div>
                              @enderror
                            </div>
                          </div>
                          <div class="col-12">
                            <div class="form-group">
                              <label>Jawaban Benar</label>
                              <input type="text" name="jawaban" value="{{ old('jawaban') }}" class="form-control jawaban" placeholder="Masukkan Jawaban Benar">

                              @error('jawaban')
                              <div class="invalid-feedback font-italic fst-italic" style="display: block">
                                {{ $message }}
                              </div>
                              @enderror
                            </div>
                          </div>
                          <div class="col-12">
                            <div class="form-group">
                              <label>Penjelasan Jawaban</label>
                              <textarea name="penjelasan" cols="10" rows="10" class="form-control penjelasan-jawaban" placeholder="Masukkan Penjelasan Jawaban">{{ old('penjelasan') }}</textarea>
                              @error('penjelasan')
                              <div class="invalid-feedback font-italic fst-italic" style="display: block">
                                {{ $message }}
                              </div>
                              @enderror
                            </div>
                          </div>
                        </div>
                      </div>
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
    $('.btn-detail').each(function() {
      $(this).on('click', function() {
          var id = $(this).data('id');
          var jenis = $(this).data('jenis');
          var isi = $(this).data('isi')
          var gambar = $(this).data('gambar');
          var opsiJawaban = {a: $(this).data('a'), b: $(this).data('b'), c: $(this).data('c'), d: $(this).data('d')};
          var jawaban = $(this).data('jawaban');
          var penjelasan = $(this).data('penjelasan');

          $(".id-soal").text(id);
          $(".jenis-soal").text(jenis);
          $(".isi-soal").text(isi);

          if(gambar !== '-') {
            $('#gambar-soal').append(
              $(document.createElement('a')).prop({
                  innerHTML: '<i class="fa-regular fa-file-image mr-1"></i> Lihat',
                  class: 'btn btn-outline-primary btn-sm',
                  href: gambar,
                  target: '_blank'
              })
          );
          } else {
            $(".gambar-soal").text('-');
          }

          $(".jawaban-a").html(`${opsiJawaban?.a} ${jawaban === opsiJawaban?.a ? '<i><small><b>(BENAR)</b></small></i>' : ''}`);
          $(".jawaban-b").html(`${opsiJawaban?.b} ${jawaban === opsiJawaban?.b ? '<i><small><b>(BENAR)</b></small></i>' : ''}`);
          $(".jawaban-c").html(`${opsiJawaban?.c} ${jawaban === opsiJawaban?.c ? '<i><small><b>(BENAR)</b></small></i>' : ''}`);
          $(".jawaban-d").html(`${opsiJawaban?.d} ${jawaban === opsiJawaban?.d ? '<i><small><b>(BENAR)</b></small></i>' : ''}`);
          $(".penjelasan-jawaban").text(penjelasan);
        })
      })
    })

    $('.btn-edit').each(function() {
      $(this).on('click', function() {
        var id = $(this).data('id');
        var jenis = $(this).data('jenis');
        var isi = $(this).data('isi')
        var gambar = $(this).data('gambar');
        var opsiJawaban = {a: $(this).data('a'), b: $(this).data('b'), c: $(this).data('c'), d: $(this).data('d')};
        var jawaban = $(this).data('jawaban');
        var penjelasan = $(this).data('penjelasan');


        $('.isi-soal').text(isi)
        $(".jawaban-a").val(`${opsiJawaban?.a}`)
        $(".jawaban-b").val(`${opsiJawaban?.b}`)
        $(".jawaban-c").val(`${opsiJawaban?.c}`)
        $(".jawaban-d").val(`${opsiJawaban?.d}`)
        $(".penjelasan-jawaban").text(penjelasan);
        $(".jawaban").val(`${opsiJawaban?.d}`)
        $('#formEditSoal').on('submit', function(e) {
          e.preventDefault();

          var formAction = $(this).attr('action');
          var appendedString = '{{ route('soals.update', '$id') }}';
          var newAction = formAction + appendedString;
          $(this).attr('action', newAction);

          this.submit();
        });
      })
    })
</script>
@endsection
