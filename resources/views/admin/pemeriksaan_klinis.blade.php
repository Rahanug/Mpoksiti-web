@extends('layouts.admin')

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
            <table class="table table-striped" id="tablePPK">
                <thead>
                <tr>
                    <th scope="col">ID_PPK</th>
                    <th scope="col">No PPK</th>
                    <th scope="col">No Aju PPK</th>
                    <th scope="col">ID_JPP</th>
                    <th scope="col">Nama Counter</th>
                    <th scope="col">Nama Trader</th>
                    <th scope="col">Cek PPK</th>
                    <th scope="col">Link Meet Virtual</th>
                    <th scope="col">Aksi</th>
                </tr>
                </thead>
                <tbody>
                <?php $no = 0; ?>
                @foreach ($pks as $ppk) 
                <tr>
                    <td>{{ $ppk->id_ppk }}</td>
                    <td>{{ $ppk->no_ppk }}</td>
                    <td>{{ $ppk->no_aju_ppk }}</td>
                    <td>{{ $ppk->id_jpp }}</td>
                    <td>{{ $ppk->nama_counter }}</td>
                    <td>{{ $ppk->nm_trader }}</td>
                    <td>
                        <a style="margin: 0 3px" class="btn btn-sm btn-primary" href="">Cek Files</a>
                    </td>
                    <td>{{ $ppk->url_periksa ?? 'Belum ada link meet' }}</td>
                    <td>
                        <a style="margin: 0 3px" class="btn btn-sm btn-primary" href="">Kirim Jadwal Pemeriksaan</a>
                        <a style="margin: 0 3px" class="btn btn-sm btn-warning" href="">Tolak</a>
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
  </script>
@endpush
