@extends('layouts.admin')

@section('css')
  <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
  <link rel="stylesheet" href="//cdn.datatables.net/1.11.4/css/dataTables.bootstrap4.min.css">
  <style>
    @media print {
      * { 
          display: none; 
      }
    }

  </style>
@endsection

@section('content')
<script>document.title = "Pemeriksaan Klinis Virtual - Mpok Siti"</script>
<main class="col-md-9 ms-sm-auto col-lg-12 px-md-4"><div class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand"><div class=""></div></div><div class="chartjs-size-monitor-shrink"><div class=""></div></div></div>
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2" style="font-weight:bold; color:#2E2A61;">Pemeriksaan Klinis Virtual</h1>
  </div>

  @if (session()->has('success'))
    <div class="alert alert-primary alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    </div>
    @endif

  @if ($errors->any())
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{$errors->first()}}
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    </div>
  @endif
  <div class="d-flex justify-content-center flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3">
    <div class="card shadow w-100 responsive" style="margin: top 10px;">
        <div class="card-body" style="margin: top 10px;">
        <div class="table-responsive">
            <table class="table table-striped" id="tablePPK">
                <thead>
                <tr>
                    <th scope="col">ID PPK</th>
                    <th scope="col">No PPK</th>
                    <th scope="col">No Aju PPK</th>
                    <th scope="col">Kode Konter</th>
                    <th scope="col">Nama Konter</th>
                    <th scope="col">Nama Trader</th>
                    <th scope="col">Nama Penerima/Tujuan</th>
                    <th scope="col">Jadwal Pemeriksaan</th>
                    <th scope="col">Link Meet Virtual</th>
                    <th scope="col">Aksi</th>
                </tr>
                </thead>
                <tbody>
                <?php $count = 0; ?>
                @foreach ($pks as $ppk)
                <?php $count++; ?>
                <tr>
                    <td>{{ $ppk->id_ppk }}</td>
                    <td>{{ $ppk->no_ppk }}</td>
                    <td>{{ $ppk->no_aju_ppk }}</td>
                    <td>{{ $ppk->kode_counter }}</td>
                    <td>{{ $ppk->nama_counter }}</td>
                    <td>{{ $ppk->nm_trader }}</td>
                    <td>{{ $ppk->nm_penerima }}</td>
                    <?php 
                    $jadwal_string = "";
                    if ($ppk->jadwal_periksa!=null){
                      $jadwal_string = date('Y-m-d H:i A', strtotime($ppk->jadwal_periksa));
                    }
                    ?>
                    <td>{{ $jadwal_string }}</td>
                    @if ($ppk->url_periksa)
                      <td><a target="_blank" style="margin: 0 3px" class="btn btn-sm btn-link" href="{{ $ppk->url_periksa}}">Link Meeting</a></td>
                    @else
                      <td>
                        <a href="" style="margin: 0 3px; " class="btn btn-sm btn-primary" data-toggle="modal" data-target=<?= '"#linkModal'.$count.'"' ?>>Kirim Link</a>

                        <!-- modal kirim virtual -->
                        <div class="modal fade" id=<?= '"linkModal'.$count.'"' ?> tabindex="-1" role="dialog" aria-labelledby=<?= '"#linkModalLabel'.$count.'"' ?> aria-hidden="true">
                          <div class="modal-dialog modal-dialog-centered" role="document">
                              <div class="modal-content">
                                  <div class="modal-header">
                                      <h5 class="modal-title" id=<?= '"#linkModalLabel'.$count.'"' ?>>Pemeriksaan Klinis Virtual <?= $ppk->no_ppk?> </h5>
                                      <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                          <span aria-hidden="true">×</span>
                                      </button>
                                  </div>
                                  <form id=<?= '"kirim-link-url'.$count.'"' ?> action="pemeriksaan_klinis/kirim_url" method="POST">
                                    @csrf
                                    <div class="modal-body">
                                      <div class="form-group">
                                        <input type="hidden" id="id_ppk" name="id_ppk" value=<?= $ppk->id_ppk ?>>
                                        <input type="hidden" id="id_jpp" name="id_jpp" value=<?= $ppk->id_jpp ?>>
                                        <label for="linkMeet" class="col-form-label">Link Meet Online:</label><br>
                                        <input type="url" id="linkMeet" name="linkMeet" class="form-control"><br>
                                        <label for="jadwalMeet" class="col-form-label">Jadwal Pemeriksaan:</label><br>
                                        <input type=date min=<?= date('Y-m-d');?>  id="jadwalMeet" name="jadwalMeet">
                                        <input type=time id="jamMeet" name="jamMeet">
                                      </div>
                                    </div>
                                    <div class="modal-footer">
                                      <button type="submit" name="action" class="btn btn-primary">Kirim</button>
                                    </div>
                                  </form>
                              </div>
                          </div>
                        </div>
                      </td>
                    @endif
                    <td>
                        <a href="" style="margin: 0 3px; " class="btn btn-sm btn-outline-dark" data-toggle="modal" data-target=<?= '"#cekModal'.$count.'"' ?>>Cek PPK</a>
                        <!-- modal cek ppk -->
                        <div class="modal fade" id=<?= '"cekModal'.$count.'"' ?> tabindex="-1" role="dialog" aria-labelledby=<?= '"#cekModalLabel'.$count.'"' ?> aria-hidden="true">
                          <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
                              <div class="modal-content">
                                  <div class="modal-header">
                                      <h5 class="modal-title" id=<?= '"#cekModalLabel'.$count.'"' ?>>Cek No PPK <?= $ppk->no_ppk?> </h5>
                                      <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                          <span aria-hidden="true">×</span>
                                      </button>
                                  </div>
                                  <div class="modal-body" id=<?= '"cetakPPK'.$count.'"' ?>>
                                    <div class="container-fluid">
                                      <div class="row">
                                        <div class="col-sm-12">
                                            <div class="row justify-content-center h4" style="font-weight:bold;">PPK (DETAIL PENGIRIMAN KOMODITI PERIKANAN)</div>
                                            <div class="row justify-content-center h5" style="font-weight:bold;">Asperindo-BBKIPM Jakarta I</div>
                                            <div class="row justify-content-center h5" style="font-weight:bold;">Nomor Aju PPK: {{ $ppk->no_aju_ppk }}</div>
                                        </div>
                                      </div>
                                      <br>
                                      <div class="row">
                                        <div class="col-8 col-sm-6">
                                          <div class="row">PENGIRIM: </div>
                                          <div class="row">NPWP: {{ $ppk->npwp }}</div>
                                          <div class="row">Nama: {{ $ppk->nm_trader }}</div>
                                          <div class="row">Alamat: {{ $ppk->al_trader }}</div>
                                        </div>
                                        <div class="col-4 col-sm-6">
                                          <div class="row">PENERIMA: </div>
                                          <div class="row">Nama: {{ $ppk->nm_penerima }} </div>
                                          <div class="row">Alamat: {{ $ppk->alamat }} </div>
                                        </div>
                                      </div>
                                      <br>
                                      
                                      <div class="row">
                                        <div class="col-4 col-sm-12">
                                          <div class="row">JASA PENYELENGGARA POS: </div>
                                          <div class="row">JPP: {{ $ppk->namaKurir }} </div>
                                          <div class="row">Konter: {{ $ppk->nama_counter }}</div>
                                          <div class="row">Alamat: {{ $ppk->alamat_counter }}</div>
                                        </div>
                                      </div>
                                      <br>

                                      <div class="row">
                                        <div class="col-4 col-sm-12">
                                          <div class="row">DETAIL KOMODITI: </div>
                                          <table class="table">
                                            <thead>
                                              <tr>
                                                <th scope="col">No</th>
                                                <th scope="col">Komoditi</th>
                                                <th scope="col">Jumlah</th>
                                                <th scope="col">Satuan</th>
                                              </tr>
                                            </thead>
                                            <tbody>
                                              <?php $countDataIkan=0; ?>
                                              @foreach ($ppk->ikan as $data_ikan)                                              
                                              <tr>
                                                <td><?= ++$countDataIkan ?></td>
                                                <td>{{ $data_ikan->nm_lokal }}</td>
                                                <td>{{ $data_ikan->jumlah }}</td>
                                                <td>{{ $data_ikan->satuan }}</td>
                                              </tr>
                                               @endforeach
                                            </tbody>
                                          </table>
                                        </div>
                                      </div>

                                      <div class="pagebreak"> </div>
                                      <div class="row">
                                        <div class="col-4 col-sm-12">
                                          <div class="row">DOKUMENTASI PENGGUNA: </div>
                                          <table class="table">
                                            <thead>
                                              <tr>
                                                <th scope="col">No</th>
                                                <th scope="col">Komoditi</th>
                                                <th scope="col">Dokumentasi</th>
                                              </tr>
                                            </thead>
                                            <tbody>
                                              <?php $countDataIkan=0; ?>
                                              @foreach ($ppk->ikan as $data_ikan)                                           
                                              <tr>
                                                <td>{{ ++$countDataIkan}}</td>
                                                <td>{{ $data_ikan->nm_lokal }}</td>
                                                <td>
                                                  @foreach ($data_ikan->images as $image)
                                                  @if($image->id_ppk == $ppk->id_ppk)  
                                                  <figure class="figure">
                                                    <?php
                                                      $str = explode("-", $image->url_file);
                                                    ?>
                                                    @if ($str[0] == 'video')
                                                    <a href="{{ asset('img/pemeriksaan_klinis/') }}/<?= $image->url_file ?>" target="_blank" style="position: relative;">
                                                      <img src="{{ asset('img/pemeriksaan_klinis/') }}/<?= 'thumb-' . $image->url_file ?>" class="figure-img img-fluid rounded" alt="...">
                                                      <div class="icon-wrap" style="
                                                          width: 100%;
                                                          height: 100%;
                                                          position: absolute;
                                                          display: flex;
                                                          align-items: center;
                                                          justify-content: center;">
                                                        <i class="fa fa-play-circle fa-4x"></i>
                                                      </div>
                                                    </a>
                                                    @else
                                                    <img src="{{ asset('img/pemeriksaan_klinis/') }}/<?= $image->url_file ?>" class="figure-img img-fluid rounded" alt="...">
                                                    @endif
                                                    <figcaption class="figure-caption">Lokasi: <?= $image->latitude.','.$image->longitude ?></figcaption>
                                                    <figcaption class="figure-caption">Waktu Upload: <?= $image->updated_at ?></figcaption>
                                                  </figure>
                                                  @endif
                                                  @endforeach
                                                </td>
                                              </tr>
                                               @endforeach
                                            </tbody>
                                          </table>
                                        </div>
                                      </div>

                                      <div class="pagebreak"> </div>
                                      <div class="row">
                                        <div class="col-4 col-sm-12">
                                          <div class="row">DOKUMENTASI PEMERIKSAAN: </div>
                                          <table class="table">
                                            <thead>
                                              <tr>
                                                <th scope="col">No</th>
                                                <th scope="col">Dokumentasi</th>
                                              </tr>
                                            </thead>
                                            <tbody>
                                              <?php $countDokumentasi=0; ?>
                                              @foreach ($ppk->images_dokumentasi as $image)                                              
                                              <tr>
                                                <td>{{ ++$countDokumentasi}}</td>
                                                <td>
                                                  <img src="{{ asset('img/pemeriksaan_klinis/') }}/<?= $image->url_file ?>" class="figure-img img-fluid rounded" alt="...">
                                                </td>
                                              </tr>
                                               @endforeach
                                            </tbody>
                                          </table>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="modal-footer">
                                      <button class="btn btn-link" type="button" data-dismiss="modal">Tutup</button>
                                      <button class="btn btn-primary" onclick=<?= 'printDiv("cetakPPK'.$count.'")' ?>>Cetak</button>
                                  </div>
                              </div>
                          </div>
                        </div>
                        
                        @if ($ppk->status==NULL || $ppk->status==1)
                        <a href="" style="margin: 0 3px; " class="btn btn-sm btn-primary" data-toggle="modal" data-target=<?= '"#actionModal'.$count.'"' ?>>Action</a>
                        <!-- modal action, fuck jquery -->
                        <div class="modal fade" id=<?= '"actionModal'.$count.'"' ?> tabindex="-1" role="dialog" aria-labelledby=<?= '"#actionModalLabel'.$count.'"' ?> aria-hidden="true">
                          <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                              <div class="modal-content">
                                  <div class="modal-header">
                                      <h5 class="modal-title" id=<?= '"#actionModalLabel'.$count.'"' ?>>No PPK <?= $ppk->no_ppk?> </h5>
                                      <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                          <span aria-hidden="true">×</span>
                                      </button>
                                  </div>
                                  <form id=<?= '"action-form'.$count.'"' ?> action="pemeriksaan_klinis/action" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="modal-body">
                                      <div class="form-group">
                                        <input type="hidden" id="id_ppk" name="id_ppk" value=<?= $ppk->id_ppk ?>>
                                        <input type="hidden" id="id_jpp" name="id_jpp" value=<?= $ppk->id_jpp ?>>
                                        <label for="file_gambar" style="font-weight:500; color:#2E2A61; font-size: 18px;">File Gambar</label>
                                        <input type="file" class="form-control" name="files[]" multiple required>
                                        <label for="keterangan" class="col-form-label">Keterangan:</label>
                                        <textarea class="form-control" id="keterangan" name="keterangan" required form=<?= '"action-form'.$count.'"' ?>></textarea>
                                      </div>
                                    </div>
                                    <div class="modal-footer">
                                      <button type="submit" name="action" value="Tolak" class="btn btn-danger">Tolak PPK</button>
                                      <button type="submit" name="action" value="Setuju" class="btn btn-primary">Setujui PPK</button>
                                    </div>
                                  </form>
                              </div>
                          </div>
                        </div>
                        @endif
                    </td>
                </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
    </div>
  </div>
</main>



@endsection

@push('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script src="//code.jquery.com/jquery-3.5.1.js"></script>
<script src="//cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
<script src="//cdn.datatables.net/1.11.4/js/dataTables.bootstrap4.min.js"></script>
<script src="//cdn.datatables.net/responsive/2.2.3/js/responsive.bootstrap4.min.js"></script>
<script>
  $(document).ready( function () {
    $('#tablePPK').DataTable({
      responsive: true,
    });
  } );

  setInterval(function() {
    $.get('/api/checkPemeriksaanKlinis',
    function(data) {
      console.log(data['updated_at']);
      const lastUpdate = Date.parse(data['updated_at']);
      const currUpdate = Date.parse('<?= $lastDate.' '.$lastTime?>');
        if (lastUpdate > currUpdate) 
            // refresh your page
          window.location.reload()
    });
   }, 600000);

  function printDiv(divName) {
    var mywindow = window.open('', 'PRINT', 'toolbar=1, scrollbars=1, location=1, statusbar=0, menubar=1, resizable=1,height=720,width=1280');
    mywindow.document.write("<style> @media print { .pagebreak { page-break-before: always; }}</style>");
    mywindow.document.write('<html><head><title>' + document.title + '-' + divName  + '</title>');
    //bootstrap
    mywindow.document.write('<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous" type="text/css" media="all">');
    mywindow.document.write('</head><body >');
    mywindow.document.write(document.getElementById(divName).innerHTML);
    mywindow.document.write('</body></html>');
    mywindow.document.close(); // necessary for IE >= 10
    mywindow.focus(); // necessary for IE >= 10
    mywindow.print();
    mywindow.close();

    return true;
  }
</script>
@endpush
