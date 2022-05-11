@extends('layouts.trader')

@section('css')
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
<link rel="stylesheet" href="//cdn.datatables.net/1.11.4/css/dataTables.bootstrap4.min.css">
@endsection

@section('content')
<script>
  document.title = "Proses Stuffing Virtual"
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
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2" style="font-weight:bold; color:#2E2A61;">Master Dokumen</h1>
    <div class="btn-toolbar mb-2 mb-md-0">
      <div class="mr-2">
        <a type="button" class="btn btn-outline-primary" href="{{ route('trader.home') }}" style="font-weight: bold">
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
  <div class="card responsive shadow" style="margin: top 10px;">
    <div class="card-body" style="margin: top 10px;">
      @include('trader.table_dokumen')
    </div>
  </div>

</main>
@endsection

@push('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script src="//code.jquery.com/jquery-3.5.1.js"></script>
<script src="//cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
<script src="//cdn.datatables.net/1.11.4/js/dataTables.bootstrap4.min.js"></script>
<script>
  $(document).ready(function() {
    $('#tableMaster').DataTable({
      responsive: true,
    });

  });

  function chooseMaster(id_master) {
    $.ajax({
      type: "POST",
      url: "<?php echo url('/home/dokumen/pilihMaster') ?>",
      data: {
        'id_ppk': <?php echo $id_ppk ?>,
        'id_master': id_master
      },
      success: function(response) {
        response = JSON.parse(response)
        if (response['error']) {
          console.log(response['id_ppk'] + response['id_master'])
        } else {
          location.reload()
        }
      }
    });
  }
</script>
@endpush