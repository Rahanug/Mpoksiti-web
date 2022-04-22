@extends('layouts.admin')

@section('css')
  <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
  <link rel="stylesheet" href="//cdn.datatables.net/1.11.4/css/dataTables.bootstrap4.min.css">
@endsection

@section('content')
<script>document.title = "Master Dokumen Trader - Mpok Siti"</script>
<main class="col-md-9 ms-sm-auto col-lg-12 px-md-4"><div class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand"><div class=""></div></div><div class="chartjs-size-monitor-shrink"><div class=""></div></div></div>
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2" style="font-weight:bold; color:#2E2A61;">Master Dokumen Trader</h1>
  </div>

  <div class="row">
  <!-- Card Hitungan Total Data Aktif -->
  <div class="col-6 col-md-4 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Data Master Aktif</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{$countAktif}}</div>
                        </div>
                    </div>
                </div>
            </div>
    </div>

    <!-- Card Hitungan Total Data Non-Aktif -->
  <div class="col-6 col-md-4 mb-4">
            <div class="card border-left-danger shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Data Master Non-Aktif</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{$countNon}}</div>
                        </div>
                    </div>
                </div>
            </div>
    </div>
</div>

  <div class="d-flex justify-content-center flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3">
    <div class="card shadow w-100 responsive" style="margin: top 10px;">
        <div class="card-body" style="margin: top 10px;">
        <div class="table-responsive">
            <table class="table table-striped" id="tableMaster">
                <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Nama Trader</th>
                    <th scope="col">Alamat Trader</th>
                    <th scope="col">Kota</th>
                    <th scope="col">Tidak Terverifikasi</th>
                    <th scope="col">Aksi</th>
                </tr>
                </thead>
                <tbody>
                <?php $no = 0; ?>
                @foreach ($traders as $trader) 
                <tr>
                    <td>{{ ++$no; }}</td>
                    <td>{{ $trader->nm_trader }}</td>
                    <td>{{ $trader->al_trader }}</td>
                    <td>{{ $trader->kt_trader }}</td>
                    <td>{{ $countMaster[$trader->id_trader] ?? 0 }}</td>
                    <td>
                    <a style="margin: 0 3px" class="btn btn-sm btn-primary" href="{{route('admin.verifikasi', [$trader->id_trader])}}">Verifikasi</a>
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
      $('#tableMaster').DataTable({
        responsive: true,
      });
      
    } );
  </script>
@endpush
