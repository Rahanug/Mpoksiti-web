@extends('layouts.admin')

@section('css')
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
<link rel="stylesheet" href="//cdn.datatables.net/1.11.4/css/dataTables.bootstrap4.min.css">
@endsection

@section('content')
<script>
  document.title = "Stuffing Virtual - Mpok Siti"
</script>
<main class="col-md-9 ms-sm-auto col-lg-12 px-md-4">
  <div class="chartjs-size-monitor">
    <div class="chartjs-size-monitor-expand">
      <div class=""></div>
    </div>
    <div class="chartjs-size-monitor-shrink">
      <div class=""></div>
    </div>
  </div>
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2" style="font-weight:bold; color:#2E2A61;">Stuffing Virtual</h1>
  </div>
  <div class="d-flex justify-content-center flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3">
    <div class="card shadow w-100 responsive" style="margin: top 10px;">
      <div class="card-body" style="margin: top 10px;">
        <div class="table-responsive">
          <table class="table table-striped" id="tablePpk">
            <thead>
              <tr>
                <th scope="col">No</th>
                <th scope="col">Nomor Aju PPK</th>
                <th scope="col">Penerima</th>
                <th scope="col">Negara</th>
                <th scope="col">Jadwal</th>
                <th scope="col">Link</th>
                <th scope="col">Status</th>
                <th scope="col">Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php $no = 0; ?>
              @foreach ($ppks as $ppk)
              <tr>
                <td>{{ ++$no; }}</td>
                <td>{{ $ppk->no_aju_ppk }}</td>
                <td>{{ $ppk->nm_penerima}}</td>
                <td>{{ $ppk->Negara_penerima}}</td>
                @if($ppk->jadwal_periksa != "")
                <td>{{ date('Y-m-d H:i A', strtotime($ppk->jadwal_periksa))}}</td>
                @else
                <td></td>
                @endif
                @if($ppk->url_periksa != "" && $ppk->status == "Stuffing")
                <td><a target="_blank" style="margin: 0 3px" class="btn btn-sm btn btn-success" href="{{ $ppk->url_periksa}}">Link Meeting</a></td>
                @else
                <td></td>
                @endif
                <td style="font-weight: bold">{{ ucfirst($ppk->status)}}</td>
                <td>
                  @if ($ppk->status == "verifikasi")
                  <a style="margin: 0 3px" class="btn btn-sm btn-primary" href="{{route('admin.document_stuffing', [$ppk->id_ppk])}}">Dokumen</a>
                  @endif
                  @if ($ppk->status == "Menunggu")
                  <a style="margin: 0 3px" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#declineModal{{$ppk->id_ppk}}">Tidak Setuju</a>
                  <!-- Decline Modal -->
                  <div class="modal fade" id="declineModal{{$ppk->id_ppk}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLongTitle">Alasan Dokumen tidak disetujui</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                          <main class="justify-content-md-center-lg-10 px-md-2">
                            <div class="chartjs-size-monitor">
                              <div class="chartjs-size-monitor-expand">
                                <div class=""></div>
                              </div>
                              <div class="chartjs-size-monitor-shrink">
                                <div class=""></div>
                              </div>
                            </div>
                            <section id="multiple-column-form">
                              <div class="row match-height">
                                <div class="col-12">
                                  <div class="card">
                                    <div class="card-content">
                                      <div class="card-body">
                                        <form method="POST" action="{{route('admin.tolakstuffing', [$ppk->id_ppk])}}" enctype="multipart/form-data">
                                          @csrf
                                          <div class="row">
                                            <div class="col">
                                              @if (count($errors) > 0)
                                              <div class="alert alert-danger">
                                                <ul>
                                                  @foreach ($errors->all() as $error)
                                                  <li>{{ $error }}</li>
                                                  @endforeach
                                                </ul>
                                              </div>
                                              @endif
                                              <div class="form-group">
                                                <label for="deskripsi" style="font-weight:500; color:#2E2A61; font-size: 18px;">Alasan</label>
                                                <textarea type="textarea" id="deskripsi" value="{{ old('deskripsi') }}" class="form-control" placeholder="Alasan" name="deskripsi"></textarea>
                                              </div>
                                            </div>
                                            <div class="col-12 d-flex justify-content-end">
                                              <button type="submit" class="btn btn-secondary" style="background-color: #3C5C94" name="submit" value="Simpan Data">Submit</button>
                                            </div>
                                        </form>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </section>
                          </main>
                        </div>
                      </div>
                    </div>
                  </div>
                  <!-- Setuju Jadwal Stuffing -->
                  <a style="margin: 0 3px" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#acceptModal{{$ppk->id_ppk}}">Setuju</a>
                  <div class="modal fade" id="acceptModal{{$ppk->id_ppk}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLongTitle">Link Meeting Stuffing Virtual</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                          <main class="justify-content-md-center-lg-10 px-md-2">
                            <div class="chartjs-size-monitor">
                              <div class="chartjs-size-monitor-expand">
                                <div class=""></div>
                              </div>
                              <div class="chartjs-size-monitor-shrink">
                                <div class=""></div>
                              </div>
                            </div>
                            <section id="multiple-column-form">
                              <div class="row match-height">
                                <div class="col-12">
                                  <div class="card">
                                    <div class="card-content">
                                      <div class="card-body">
                                        <form method="POST" action="{{route('admin.terimastuffing', [$ppk->id_ppk])}}" enctype="multipart/form-data">
                                          @csrf
                                          <div class="row">
                                            <div class="col">
                                              @if (count($errors) > 0)
                                              <div class="alert alert-danger">
                                                <ul>
                                                  @foreach ($errors->all() as $error)
                                                  <li>{{ $error }}</li>
                                                  @endforeach
                                                </ul>
                                              </div>
                                              @endif
                                              <div class="form-group">
                                                <label for="url_periksa" style="font-weight:500; color:#2E2A61; font-size: 18px;">Link Meeting</label>
                                                <input type="text" id="url_periksa" value="{{ old('url_periksa') }}" class="form-control" placeholder="link meeting" name="url_periksa">
                                              </div>
                                            </div>
                                            <div class="col-12 d-flex justify-content-end">
                                              <button type="submit" class="btn btn-secondary" style="background-color: #3C5C94" name="submit" value="Simpan Data">Submit</button>
                                            </div>
                                        </form>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </section>
                          </main>
                        </div>
                      </div>
                    </div>
                  </div>
                  @endif
                  @if($ppk->status == 'Stuffing')
                  <a style="margin: 0 3px" class="btn btn-sm btn-info" href="{{route('admin.form_stuffing', [$ppk->id_ppk])}}">Form</a>
                  @endif
                  <!-- Persetujuan -->
                  @if($ppk->status == 'Persetujuan')
                  <a style="margin: 0 3px" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#izinModal-{{$ppk->id_ppk}}">No Izin</a>
                  <div class="modal fade" id="izinModal-{{$ppk->id_ppk}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLongTitle">Link Meeting Stuffing Virtual</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                          <main class="justify-content-md-center-lg-10 px-md-2">
                            <div class="chartjs-size-monitor">
                              <div class="chartjs-size-monitor-expand">
                                <div class=""></div>
                              </div>
                              <div class="chartjs-size-monitor-shrink">
                                <div class=""></div>
                              </div>
                            </div>
                            <section id="multiple-column-form">
                              <div class="row match-height">
                                <div class="col-12">
                                  <div class="card">
                                    <div class="card-content">
                                      <div class="card-body">
                                        <form method="POST" action="{{route('admin.izinstuffing', [$ppk->id_ppk])}}" enctype="multipart/form-data">
                                          @csrf
                                          <div class="row">
                                            <div class="col">
                                              @if (count($errors) > 0)
                                              <div class="alert alert-danger">
                                                <ul>
                                                  @foreach ($errors->all() as $error)
                                                  <li>{{ $error }}</li>
                                                  @endforeach
                                                </ul>
                                              </div>
                                              @endif
                                              <div class="form-group">
                                                <label for="no_izin" style="font-weight:500; color:#2E2A61; font-size: 18px;">Nomor Izin</label>
                                                <input type="text" id="no_izin" value="{{ old('no_izin') }}" class="form-control" placeholder="Nomor Izin" name="no_izin">
                                              </div>
                                              <div class="form-group">
                                                <label for="tgl_izin" style="font-weight:500; color:#2E2A61; font-size: 18px;">Tanggal Izin</label>
                                                <input type="datetime-local" id="tgl_izin" value="{{ date('Y-m-d H:i', strtotime($ppk->tgl_izin)) }}" class="form-control" placeholder="Jadwal" name="tgl_izin">
                                              </div>
                                            </div>
                                            <div class="col-12 d-flex justify-content-end">
                                              <button type="submit" class="btn btn-secondary" style="background-color: #3C5C94" name="submit" value="Simpan Data">Submit</button>
                                            </div>
                                        </form>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </section>
                          </main>
                        </div>
                      </div>
                    </div>
                  </div>
                  @endif
                  @if ($ppk->status == "Cetak HC" || $ppk->status == "Tidak Sesuai")
                  <a style="margin: 0 3px" class="btn btn-sm btn-info" data-toggle="modal" data-target="#hasilModal-{{$ppk->id_ppk}}">Cetak Verifikasi</a>
                  <!-- <a target="_blank" style="margin: 0 3px" class="btn btn-sm btn-primary" href="/home/cetakHC/{{$ppk->id_ppk}}">Cetak HC</a> -->

                  <!-- Modal Hasil -->
                  <div class="modal fade" id="hasilModal-{{$ppk->id_ppk}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLongTitle">Hasil Pemeriksaan Virtual</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body" id="tableHasil-{{$ppk->id_ppk}}">
                          <main class="justify-content-md-center-lg-10 px-md-2">
                            <div class="chartjs-size-monitor">
                              <div class="chartjs-size-monitor-expand">
                                <div class=""></div>
                              </div>
                              <div class="chartjs-size-monitor-shrink">
                                <div class=""></div>
                              </div>
                            </div>
                            <section id="multiple-column-form">
                              <div class="row match-height">
                                <div class="d-flex">
                                  <div class="col-md-2">
                                    <img src="../img/logo_header.png" width="100" />
                                  </div>
                                  <div class="col-md-10" style="text-align: center; ">
                                    <h6 style="color: blue;">KEMENTERIAN KELAUTAN DAN PERIKANAN</h6>
                                    <h6 style="color: blue;">BADAN KARANTINA IKAN, PENGENDALIAN MUTU,</h6>
                                    <h6 style="color: blue;">DAN KEAMANAN HASIL PERIKANAN</h6>
                                    <h6 style="color: blue;">BALAI BESAR KARANTINA IKAN, PENGENDALIAN MUTU DAN</h6>
                                    <h6 style="color: blue;">KEAMANAN HASIL PERIKANAN JAKARTA I</h6>
                                    <h6 style="font-size: small;">ALAMAT GEDUNG KARANTINA PERTANIAN BANDARA SOEKARNO – HATTA 19120</h6>
                                    <h6 style="font-size: small;">TELEPON : (021) 5507932,5591 5059 FAKSIMILI : (021) 5506738 email : JakartaI@bkipm.kkp.go.id</h6>
                                  </div>
                                </div>
                                <hr style="border: 0; clear:both; display:block; width: 100%; background-color:#000000; height: 5px;" />
                                <div class="row">
                                  <div class="col-lg-12">
                                    <h4 style="text-align: center;">FORM HASIL VERIFIKASI LAPANGAN</h4>
                                    <table class='table borderless'>
                                      @foreach ($ppk->subform as $f)
                                      <tr>
                                        @if(($master[$f->id_masterSubform]) == 'Tanggal verifikasi lapangan')
                                        <td>Tanggal verifikasi lapangan</td>
                                        <td>&nbsp;: {{date('d-m-Y H:i', strtotime($f->value))}}</td>
                                        @endif
                                      </tr>
                                      <tr>
                                        @if(($master[$f->id_masterSubform]) == 'No Agenda')
                                        <td>No Agenda</td>
                                        <td>&nbsp;: {{$f->value}}</td>
                                        @endif
                                      </tr>
                                      <tr>
                                        @if(($master[$f->id_masterSubform]) == 'Nama UPI')
                                        <td>Nama UPI</td>
                                        <td>&nbsp;: {{$f->value}}</td>
                                        @endif
                                      </tr>
                                      @endforeach
                                    </table>
                                  </div>
                                </div>
                              </div>
                              <div class="table-responsive">
                                <div class="table-responsive" id="tableHasil">
                                  <table class="table table-bordered">
                                    <thead>
                                      <tr>
                                        <th scope="col">Indikator</th>
                                        <th scope="col">Hasil</th>
                                        <th scope="col">Keterangan</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                      @foreach ($ppk->subform as $f)
                                      @if(($master[$f->id_masterSubform]) != 'Tanggal verifikasi lapangan'
                                      && ($master[$f->id_masterSubform]) != 'No Agenda'
                                      && ($master[$f->id_masterSubform]) != 'Nama UPI'
                                      && ($master[$f->id_masterSubform]) != 'Nama Petugas'
                                      && ($master[$f->id_masterSubform]) != 'Rekomendasi')
                                      <tr>
                                        <td>{{ $master[$f->id_masterSubform] }}</td>
                                        <td>{{ $f->value }}</td>
                                        <td>{{ $f->keterangan }}</td>
                                      </tr>
                                      @endif
                                      @endforeach
                                    </tbody>
                                  </table>
                                </div>
                              </div>
                              <p>Keterangan : Beri tanda √ pada kolom pilihan</p>
                              <p>REKOMENDASI :</p>
                              @foreach ($ppk->subform as $f)
                              @if (($master[$f->id_masterSubform]) == 'Rekomendasi' && $f->value == 'Sesuai')
                              <div class="row">
                                <div class="col-sm-1"><input type="checkbox" name="rekomendasi-1" id="rekomendasi-1" class="w-100" checked></div>
                                <div class="col-sm-11">Setelah dilakukan verifikasi atas kebenaran data, bahwa sudah
                                  sesuai permohonan penerbitan Sertifikat Kesehatan Ikan dan Produk
                                  Perikanan (SKIPP) Ekspor. dengan No izin <u>{{$f->no_izin}}</u> dan tanggal izin <u>{{ date('Y-m-d H:i', strtotime($f->tgl_izin))}}</u></div>
                              </div>
                              <div class="row">
                                <div class="col-sm-1"><input type="checkbox" name="rekomendasi-2" id="rekomendasi-2" class="w-100" disabled></div>
                                <div class="col-sm-11">
                                  <p>
                                    Tidak sesuai dengan permohonan penerbitan Sertifikat Kesehatan Ikan dan
                                    Produk Perikanan (SKIPP) Ekspor , karena</br>
                                  </p>
                                  <p>
                                    .....................................................................................................................................................
                                  </p>
                                </div>
                              </div>
                              @elseif (($master[$f->id_masterSubform]) == 'Rekomendasi' && $f->value == 'Tidak Sesuai')
                              <div>
                                <div style="float:left;"><input type="checkbox" name="rekomendasi-1" id="rekomendasi-1" class="w-100" disabled></div>
                                <div style="float:right;">Setelah dilakukan verifikasi atas kebenaran data, bahwa sudah
                                  sesuai permohonan penerbitan Sertifikat Kesehatan Ikan dan Produk
                                  Perikanan (SKIPP) Ekspor .</div>
                              </div>
                              <div>
                                <div style="float:left;"><input type="checkbox" name="rekomendasi-2" id="rekomendasi-2" class="w-100" checked></div>
                                <div style="float:right;">
                                  <p>
                                    Tidak sesuai dengan permohonan penerbitan Sertifikat Kesehatan Ikan dan
                                    Produk Perikanan (SKIPP) Ekspor , karena <b>{{$f->keterangan}}</b></br>
                                  </p>
                                </div>
                              </div>
                              @endif
                              @endforeach
                              <div style="margin-bottom:5rem">
                                @foreach ($ppk->subform as $f)
                                @if (($master[$f->id_masterSubform]) == 'Nama Petugas')
                                <div style="float:left; text-align:center">
                                  <p>Cap dan Tanda Tangan</p>
                                  <p>Inspektu Mutu</p>
                                  <br><br>
                                  <p>{{ucfirst($f->value)}}</p>
                                </div>
                                @endif
                                @if (($master[$f->id_masterSubform]) == 'Nama UPI')
                                <div style="float:right; text-align:center">
                                  <p>Cap dan Tanda</p>
                                  <p>Tangan UPI</p><br><br>
                                  <p>{{ucfirst($f->value)}}</p>
                                </div>
                                @endif
                                @endforeach
                              </div>
                              <br><br>
                              <div style="margin-bottom:5rem">
                                <div class="table-responsive">
                                  <div class="table-responsive" id="tableHasil">
                                    <table class="table table-bordered">
                                      <thead>
                                        <th>Dokumentasi Stuffing Virtual</th>
                                      </thead>
                                      <tbody>
                                        @foreach($ppk->stuffing as $i)
                                        <tr>
                                          <td>
                                            <img src='../images_stuffing/{{$i->images}}' style="max-width: 300px; max-height: 300px">
                                          </td>
                                        </tr>
                                        @endforeach
                                      </tbody>
                                    </table>
                                  </div>
                                </div>
                              </div>
                            </section>
                          </main>
                        </div>
                        <div class="modal-footer">
                          <button class="btn btn-link" type="button" data-dismiss="modal">Tutup</button>
                          <button class="btn btn-primary" onclick=<?= 'printDiv("tableHasil-' . $ppk->id_ppk . '")' ?>>Cetak</button>
                        </div>
                      </div>
                    </div>
                  </div>
                  @endif
                  <a style="margin: 0 3px" class="btn btn-sm btn-secondary" id="detail" href="{{route('admin.detail',[$ppk->id_ppk])}}">Detail</a>
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
  $(document).ready(function() {
    $('#tablePpk').DataTable({
      responsive: true,
    });

  });

  function printDiv(divName) {
    var mywindow = window.open('', 'PRINT', 'toolbar=1, scrollbars=1, location=1, statusbar=0, menubar=1, resizable=1,height=720,width=1280');
    mywindow.document.write('<html><head><title>' + document.title + '-' + divName + '</title>');
    //bootstrap
    mywindow.document.write('<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous" type="text/css" media="all">');
    mywindow.document.write('<link href="public/css/sb-admin-2.min.css" rel="stylesheet">');
    mywindow.document.write('<link href="public/css/app.css" rel="stylesheet">');
    mywindow.document.write('<link href="public/js/sb-admin-2.min.js" rel="stylesheet">');
    mywindow.document.write('</head><body >');
    mywindow.document.write('<link href="public/vendor/jquery/jquery.min.js" rel="stylesheet">');
    mywindow.document.write('<link href="public/vendor/bootstrap/js/bootstrap.min.js" rel="stylesheet">');
    mywindow.document.write('<link href="public/vendor/jquery-easing/jquery.easing.min.js" rel="stylesheet">');
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