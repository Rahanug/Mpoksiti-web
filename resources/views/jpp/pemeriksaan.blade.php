@extends('layouts.jpp')

@section('css')
  <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
  <link rel="stylesheet" href="//cdn.datatables.net/1.11.4/css/dataTables.bootstrap4.min.css">
@endsection

@section('content')
<script>document.title = "Pemeriksaan Klinis Virtual - Mpok Siti"</script>
<main class="col-md-9 ms-sm-auto col-lg-12 px-md-4"><div class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand"><div class=""></div></div><div class="chartjs-size-monitor-shrink"><div class=""></div></div></div>
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2" style="font-weight:bold; color:#2E2A61;">Pemeriksaan Klinis Virtual</h1>
  </div>

  <div class="d-flex justify-content-center flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3">
    <div class="card shadow w-100 responsive" style="margin: top 10px;">
        <div class="card-body" style="margin: top 10px;">
        <div class="table-responsive">
          <table class="table table-striped" id="tablePermohonanPemeriksaanVirtual">
          <thead>
            <tr>
              <th scope="col" style="font-weight:semibold; color:#2E2A61;">No Aju PPK</th>
              <th scope="col" style="font-weight:semibold; color:#2E2A61;">Tgl PPK</th>
              <th scope="col" style="font-weight:semibold; color:#2E2A61;">Trader</th>
              <th scope="col" style="font-weight:semibold; color:#2E2A61;">Penerima/Tujuan</th>
              <th scope="col" style="font-weight:semibold; color:#2E2A61;">Permohonan Pemeriksaan Virtual</th>
              <th scope="col" style="font-weight:semibold; color:#2E2A61;">Link Pemeriksaan Virtual</th>
              <th scope="col" style="font-weight:semibold; color:#2E2A61;">Jadwal Pemeriksaan</th>
              <th scope="col" style="font-weight:semibold; color:#2E2A61;">No Sertifikat</th>
              <th scope="col" style="font-weight:semibold; color:#2E2A61;">Aksi</th>
              <th scope="col" style="font-weight:semibold; color:#2E2A61;">Status</th>
            </tr>
          </thead>
          <tbody>
            <?php $count = 0?>
            @foreach ($list_ppk as $ppk)
            <?php $count++?>
              <tr>
              <td style="font-weight:regular; color:#2E2A61;"> {{ $ppk->no_aju_ppk }}</td>
              <td style="font-weight:regular; color:#2E2A61;"> {{ $ppk->tgl_ppk }}</td>
              <td style="font-weight:regular; color:#2E2A61;"> {{ $ppk->nm_trader }}</td>
              <td style="font-weight:regular; color:#2E2A61;"> {{ $ppk->nm_penerima }}</td>
              
              @if ($ppk->status_periksa == null)
                <td>
                  <form action="/jpp/permohonan" method="POST">
                    @csrf
                    <input type="hidden" id="id_ppk" name="id_ppk" value= <?=$ppk->id_ppk?>>
                    <button class="btn btn-sm btn-outline-dark">Ajukan Permohonan</button>       
                  </form>
                </td>
              @else
                <td style="font-weight:regular; color:#2E2A61;"> Sudah diajukan </td>
              @endif
              
              <?php 
              $url_pemeriksaan = "Belum diberikan";
              if ($ppk->url_periksa!=null){
                $url_pemeriksaan = $ppk->url_periksa;
              }
              ?>
              <td style="font-weight:regular; color:#2E2A61;"> {{ $url_pemeriksaan }}</td>
              
              <?php 
              $jadwal_string = "";
              if ($ppk->jadwal_periksa!=null){
                $jadwal_string = date('Y-m-d H:i A', strtotime($ppk->jadwal_periksa));
              }
              ?>
              <td style="font-weight:regular; color:#2E2A61;"> {{ $jadwal_string }}</td>
              <td style="font-weight:regular; color:#2E2A61;"> {{ $ppk->no_sertifikat }}</td>
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
                                  <div class="row">NPWP: </div>
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
                                    <div class="row">JPP: {{ $kurir->namaKurir }} </div>
                                    <div class="row">Counter: {{ Auth::user()->nama_counter }}</div>
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

                              <div class="row">
                                <div class="col-4 col-sm-12">
                                  <div class="row">DOKUMENTASI: </div>
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
                                          <figure class="figure">
                                            <img src="/img/pemeriksaan_klinis/<?= $image->url_file ?>" class="figure-img img-fluid rounded" alt="...">
                                            <figcaption class="figure-caption">Lokasi: <?= $image->latitude.','.$image->longitude ?></figcaption>
                                            <figcaption class="figure-caption">Waktu Upload: <?= $image->updated_at ?></figcaption>
                                          </figure>
                                          @endforeach
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
                              <button class="btn btn-primary" onclick=<?= 'printPPK("cetakPPK'.$count.'")' ?>>Cetak</button>
                          </div>
                      </div>
                  </div>
                </div>
                <a href="" style="margin: 0 3px; " class="btn btn-sm btn-outline-dark" data-toggle="modal" data-target=<?= '"#cetakSegel'.$count.'"' ?>>Cetak Segel</a>
                <!-- modal cetak segel-->
                <div class="modal fade" id=<?= '"cetakSegel'.$count.'"' ?> tabindex="-1" role="dialog" aria-labelledby=<?= '"#cetakSegelLabel'.$count.'"' ?> aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id=<?= '"#cetakSegelLabel'.$count.'"' ?>>Cetak Segel <?= $ppk->no_aju_ppk?> </h5>
                                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                            </div>
                            @if ($ppk->status==3)
                              <div class="modal-body" id=<?= '"segel'.$count.'"' ?>>
                                <table style="border: 1px solid;">
                                  <tr style="border: 1px solid;">
                                    <td style="border: 1px solid; margin: 8px">
                                      {!! QrCode::size(192)->generate($ppk->data_segel); !!}
                                    </td>
                                    <th style="border: 1px solid;">Kementerian Kelautan<br> dan Perikanan Balai<br> Besar KIPM <br>Jakarta I</th>
                                    <td style="border: 1px solid;"><img src="/img/bkipm-logo.png" height="192"></td>
                                  </tr>
                                  <tr style="border: 1px solid;">
                                    <td style="border: 1px solid;">
                                      KEGIATAN<br>
                                      NO SERTIFIKAT<br>
                                      NO SERI<br>
                                      TANGGAL<br>
                                      TUJUAN<br>
                                    </td>
                                    <td colspan=2 style="border: 1px solid;">
                                      {{ $ppk->kd_kegiatan }}<br>
                                      {{ $ppk->no_sertifikat }}<br>
                                      {{ $ppk->seri }}<br>
                                      {{ $ppk->tgl_ppk }}<br>
                                      {{ $ppk->nm_penerima }}<br>
                                      {{ $ppk->alamat }}<br>
                                    </td>
                                  </tr>
                                </table>
                              </div>
                            @else
                              <div class="modal-body">Segel tidak tersedia</div>
                            @endif
                            <div class="modal-footer">
                                <button class="btn btn-link" type="button" data-dismiss="modal">Tutup</button>
                                @if ($ppk->status==3)
                                <button class="btn btn-primary" onclick=<?= 'printDiv("segel'.$count.'")' ?>>Cetak</button>
                                @endif
                            </div>
                        </div>
                    </div>
                  </div>
              </td>
              
              <?php 
              $status_string = "Belum di proses";
              if ($ppk->status==1){
                $status_string = "Diproses";
              }else if ($ppk->status==2){
                $status_string = "Ditolak";
              }else if ($ppk->status==3){
                $status_string = "Disetujui";
              }
              ?>
              <td style="font-weight:regular; color:#2E2A61;"> {{ $status_string }}</td>
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
      $('#tablePermohonanPemeriksaanVirtual').DataTable({
        responsive: true,
      });
      
    } );
    function printDiv(divName) {
      var mywindow = window.open('', 'PRINT', 'height=400,width=600');
      mywindow.document.write('<html><head><title>' + document.title  + '</title>');
      mywindow.document.write('</head><body >');
      mywindow.document.write('<h1>' + document.title  + '</h1>');
      mywindow.document.write(document.getElementById(divName).innerHTML);
      mywindow.document.write('</body></html>');
      mywindow.document.close(); // necessary for IE >= 10
      mywindow.focus(); // necessary for IE >= 10*/
      mywindow.print();
      mywindow.close();

      return true;
    }
    function printPPK(divName) {
    var mywindow = window.open('', 'PRINT', 'toolbar=1, scrollbars=1, location=1, statusbar=0, menubar=1, resizable=1,height=720,width=1280');
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