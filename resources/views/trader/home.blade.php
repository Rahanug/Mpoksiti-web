@extends('layouts.trader')

@section('css')
  <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
  <link rel="stylesheet" href="//cdn.datatables.net/1.11.4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" type="text/css" href="vendor/DataTables/datatables.min.css"/>
@endsection

@section('content')
<script>document.title = "Dashboard"</script>
<main class="justify-content-md-center-lg-10 px-md-2"><div class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand"><div class=""></div></div><div class="chartjs-size-monitor-shrink"><div class=""></div></div></div>
  <div class="d-flex justify-content-center flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3"> 
  <h2 class="h2">Proses Stuffing Virtual</h2> 
  </div>
  <div class="d-flex justify-content-center flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3">
    <img src="img/Proses.png"  srcset="img/Proses.png 10000w 7000h" sizes="(min-width: 200px, min-height: 50px)">
  </div>
  <div class="d-flex justify-content-center flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3">
    <div class="card shadow w-100 responsive" style="margin: top 10px;">
        <div class="card-body" style="margin: top 10px;">
          @include('trader.table_ppk')
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
      $('#tablePpk').DataTable({
        ordering: false,
        responsive: true,
      });
      
    } );
  </script>
@endpush