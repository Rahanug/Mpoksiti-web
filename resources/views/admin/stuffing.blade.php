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
                <td>{{ $ppk->negara_penerima}}</td>
                @if($ppk->jadwal_periksa != "")
                <td>{{ date('Y-m-d H:i A', strtotime($ppk->jadwal_periksa))}}</td>
                @else
                <td></td>
                @endif
                <td>{{ $ppk->url_periksa}}</td>
                <td style="font-weight: bold">{{ ucfirst($ppk->status)}}</td>
                <td>
                  @if ($ppk->status == "verifikasi")
                  <a style="margin: 0 3px" class="btn btn-sm btn-primary" href="/admin/stuffing/{{$ppk->id_ppk}}">Dokumen</a>
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
                                        <form method="POST" action="/admin/stuffing/{{$ppk->id_ppk}}/tolak" enctype="multipart/form-data">
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
                                        <form method="POST" action="/admin/stuffing/{{$ppk->id_ppk}}/terima" enctype="multipart/form-data">
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
                  <a style="margin: 0 3px" class="btn btn-sm btn-info" href="/admin/stuffing/form/{{$ppk->id_ppk}}">Form</a>
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
                                        <form method="POST" action="/admin/stuffing/{{$ppk->id_ppk}}/izin" enctype="multipart/form-data">
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
                  <a style="margin: 0 3px" class="btn btn-sm btn-secondary" id="detail">Detail</a>
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
</script>
@endpush