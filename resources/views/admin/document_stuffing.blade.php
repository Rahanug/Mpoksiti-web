@extends('layouts.admin')

@section('css')
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
<link rel="stylesheet" href="//cdn.datatables.net/1.11.4/css/dataTables.bootstrap4.min.css">
@endsection

@section('content')
<script>
  document.title = "Proses Stuffing Virtual"
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
    <h1 class="h2" style="font-weight:bold; color:#2E2A61;">Verifikasi Dokumen</h1>
    <div class="btn-toolbar mb-2 mb-md-0">
      <div class="mr-2">
        <a type="button" class="btn btn-secondary" href="{{route('admin.stuffing')}}" style="font-weight: bold">
          Kembali
        </a>
      </div>
    </div>
  </div>
  <div class="row">
    <!-- Kartu Pendapatan -->
    <div class="col-6 col-md-4 mb-4">
      <div class="card border-left-primary shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Penerima</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800">{{$ppk->nm_penerima}}</div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-6 col-md-4 mb-4">
      <div class="card border-left-success shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Negara</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800">{{$ppk->Negara_penerima}}</div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-6 col-md-4 mb-4">
      <div class="card border-left-info shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Nomor Pengajuan</div>
              <div class="row no-gutters align-items-center">
                <div class="col-auto">
                  <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">{{$ppk->no_aju_ppk}}</div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="d-flex justify-content-center flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3">
    <div class="card shadow w-100 responsive" style="margin: top 10px;">
      <div class="card-body" style="margin: top 10px;">
        @include('admin.table_document')
      </div>
      <div class="card-footer" style="margin: top 10px;">
        <div class="d-flex justify-content-end">

          <a style="margin: 0 3px" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#declineModal">Tidak Setuju</a>

          <!-- Decline Modal -->
          <div class="modal fade" id="declineModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
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
                                <form method="POST" action="{{route('admin.declinestuffing', [$ppk->id_ppk])}}" enctype="multipart/form-data">
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
          <a style="margin: 0 3px" class="btn btn-sm btn-primary" href="{{route('admin.acceptstuffing', [$ppk->id_ppk])}}">Setuju</a>
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
@endpush