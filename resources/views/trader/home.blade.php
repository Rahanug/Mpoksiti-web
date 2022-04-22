@extends('layouts.trader')

@section('css')
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
<link rel="stylesheet" href="//cdn.datatables.net/1.11.4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" type="text/css" href="vendor/DataTables/datatables.min.css" />
@endsection

@section('content')
<script>
  document.title = "Dashboard"
</script>
<main class="justify-content-md-center-lg-10 px-md-2">
  <div class="chartjs-size-monitor">
    <div class="chartjs-size-monitor-expand">
      <div class=""></div>
    </div>
    <div class="chartjs-size-monitor-shrink">
      <div class=""></div>
    </div>
  </div>
  <div class="d-flex justify-content-center flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3">
    <h2 class="h2">Proses Stuffing Virtual</h2>
  </div>
  <div class="d-flex justify-content-center flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3">
    <img src="{{ public_path('img/Proses.png') }}" srcset="img/Proses.png 10000w 7000h" sizes="(min-width: 200px, min-height: 50px)">
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
  $(document).ready(function() {
    $('#tablePpk').DataTable({
      ordering: false,
      responsive: true,
    });

  });
  window.addEventListener('resize', myFunction);

  function myFunction() {
    if (screen.availWidth <= 800) {
      document.getElementById("detail").innerText = "Value baru"
    }
  }

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