@extends('layouts.admin')

@section('css')
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
<link rel="stylesheet" href="//cdn.datatables.net/1.11.4/css/dataTables.bootstrap4.min.css">
@endsection

@section('content')
<script>
  document.title = "Verifikasi Dokumen Trader - Mpok Siti"
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
    <h1 class="h2" style="font-weight:bold; color:#2E2A61;">Verifikasi Dokumen Trader</h1>
  </div>
  <div class="d-flex justify-content-center flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3">
    <div class="card shadow w-100 responsive" style="margin: top 10px;">
      <div class="card-body" style="margin: top 10px;">
        <form method="POST" enctype="multipart/form-data">
          @csrf
          <div class="table-responsive">
            <table class="table table-striped" id="tableMaster">
              <thead>
                <tr>
                  <th scope="col">No</th>
                  <th scope="col">No Dokumen</th>
                  <th scope="col">Nama Dokumen</th>
                  <th scope="col">Tanggal Terbit</th>
                  <th scope="col">Status</th>
                  <th scope="col">Preview</th>
                  <th scope="col">Aksi</th>
                </tr>
              </thead>
              <tbody>
                <?php $no = 0; ?>
                @foreach ($masters as $master)
                <tr>
                  <td>{{ ++$no; }}</td>
                  <td>{{ $master->no_dokumen }}</td>
                  <td>{{ $master->nm_dokumen }}</td>
                  <td>{{ $master->tgl_terbit }}</td>
                  <td>{{ $master->status }}</td>
                  <td>
                    <a style="margin: 0 3px" class="btn btn-sm btn-info" target="_blank" href="<?= url('files/' . $master->nm_dokumen) ?>">Preview</a>
                  </td>
                  <td>
                    @if($master->status == 'non-Aktif')
                    <a style="margin: 0 3px" class="btn btn-sm btn-primary" href="/admin/master/accept/{{$master->id_master}}">Setuju</a>
                    <a style="margin: 0 3px" class="btn btn-sm btn-danger" href="/admin/master/decline/{{$master->id_master}}">Tidak Setuju</a>
                    @endif
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </form>
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
    $('#tableMaster').DataTable({
      responsive: true,
    });

  });
</script>
@endpush