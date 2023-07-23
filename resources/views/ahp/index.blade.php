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
            Analisis Hirarki Proses (AHP)
            <h6 class="d-block text-muted pt-2 font-size-sm m-0 p-0 fst-italic">
              Management Perhitungan AHP
            </h6>
          </h3>
        </div>
        @hasanyrole('panitia|admin')
        <div class="card-toolbar ml-auto">
          <div class="row d-flex justify-content-end">
            <button class="btn btn-outline-success font-weight-bolder" title="Tambah Data" data-bs-toggle="modal" data-bs-target="#hitungAhpModal">
                <i class="fa-solid fa-file-circle-plus"></i>
                Hitung AHP
            </button>
          </div>
        </div>
        @endhasanyrole
        <!-- Modal -->
            <div class="modal fade" id="hitungAhpModal" tabindex="-1" aria-labelledby="hitungAhpModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title" id="hitungAhpModalLabel">Perhitungan AHP</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <table class="table table-responsive m-auto" width="100%">
                            <thead>
                                <tr>
                                    <th style="width: 68%">Kriteria</th>
                                    <th>Bobot</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Psikotest</td>
                                    <td>
                                        <select id="psikotest" class="form-select">
                                            <option value="" hidden>Pilih Bobot</option>
                                            <option value="0.1">1</option>
                                            <option value="0.2">2</option>
                                            <option value="0.3">3</option>
                                            <option value="0.4">4</option>

                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Pengetahuan Umum</td>
                                    <td>
                                        <select id="pengetahuan" class="form-select">
                                            <option value="" hidden>Pilih Bobot</option>
                                            <option value="0.1">1</option>
                                            <option value="0.2">2</option>
                                            <option value="0.3">3</option>
                                            <option value="0.4">4</option>

                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Minat</td>
                                    <td>
                                        <select id="minat" class="form-select">
                                            <option value="" hidden>Pilih Bobot</option>
                                            <option value="0.1">1</option>
                                            <option value="0.2">2</option>
                                            <option value="0.3">3</option>
                                            <option value="0.4">4</option>

                                        </select>
                                    </td>
                                </tr>                                
                                <tr>
                                    <td>Wawancara</td>
                                    <td>
                                        <select id="wawancara" class="form-select">
                                            <option value="" hidden>Pilih Bobot</option>
                                            <option value="0.1">1</option>
                                            <option value="0.2">2</option>
                                            <option value="0.3">3</option>
                                            <option value="0.4">4</option>

                                        </select>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="modal-footer mt-3">
                        <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        <button class="btn btn-primary mr-1 btn-submit btn-sm" type="button">
                          Hitung
                        </button>
                      </div>
                </div>
                </div>
            </div>
       </div>
       <div class="row">
        <div class="col-8">
            <div class="card-body px-0">
                <h6>Tabel Nilai Peserta</h6>
                <div class="table table-bordered table-responsive">
                <table class="table">
                    <thead>
                    <tr class="text-uppercase">
                        <th scope="col">No</th> 
                        <th scope="col" style="width: 50%;">Nama Peserta</th> 
                        <th scope="col">Psikotest</th>
                        <th scope="col">Pengetahuan Umum</th>   
                        <th scope="col">Minat</th>                           
                        <th scope="col">Wawancara</th>              
                    </tr>
                    </thead>
                    <tbody>
                    @php $i = 1; @endphp
                    @forelse($datanilai as $row)
                    <tr>
                        <td>{{ $i++ }}</td>
                        <td>{{ $row->nama_user }}</td>
                        <td>{{ $row->nilai_psikotest }}</td>
                        <td>{{ $row->nilai_pengetahuan }}</td>
                        <td>{{ $row->nilai_minat }}</td>                    
                        <td>{{ $row->nilai_wawancara }}</td>
                    </tr>
                    @empty 
                    <tr>
                        <td colspan="6" align="center"><span class="text-muted fst-italic">Tidak ada data</span></td>
                    </tr>
                    </tbody>
                    @endforelse
                </table>
                </div>
            </div>
        </div>
         <div class="col-4">
            <div class="card-body px-0">
                <h6>Tabel Hasil Perhitungan AHP</h6>
                <div class="table table-bordered table-responsive">
                <table class="table" id="table_rank">
                    <thead>
                    <tr class="text-uppercase">
                        <th scope="col">Nama</th> 
                        <th scope="col">Peringkat</th>           
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td colspan="2" align="center"><span class="text-muted fst-italic">Silahkan hitung ahp terlebih dahulu</span></td>
                    </tr>
                    </tbody>
                </table>
                </div>
            </div>
         </div>
       </div>
    </div>
  </div>
</div>

<script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
<script>
    $(document).ready(function () {
        $('.btn-submit').on('click', function() {
            var pengetahuan = $('#pengetahuan').val();
            var minat = $('#minat').val();
            var psikotest = $('#psikotest').val();
            var wawancara = $('#wawancara').val(); 
            if(pengetahuan == "" || minat == "" || psikotest == "" || wawancara == "")
            {
                alert('Isikan bobot dengan benar');
            } else 
            {
                $.ajax({
                    url: "{{ url('ahp/calculate-ranking') }}",
                    data: {
                        bobot_pengetahuan: pengetahuan,
                        bobot_minat: minat,
                        bobot_psikotest: psikotest,
                        bobot_wawancara: wawancara,
                        '_token': '{{ csrf_token() }}'
                    },
                    type: 'post',
                    success: function(res) {    
                        var tbody = $('#table_rank tbody');          
                        tbody.empty();
                        for(var i = 0; i < res.data.length; i++) 
                        {
                            var row = '<tr>';
                            row += `<td>${res.data[i].nama_user}</td>`;
                            row += `<td>${i + 1}</td>`;
                            row += '</tr>';
                            tbody.append(row);
                        }       
                    },
                    error: function(err) {

                    }
                })
            } 
        });
    });
</script>
@endsection
