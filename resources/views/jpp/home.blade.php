@extends('layouts.jpp')

@section('content')

<script>
    document.title = "Dashboard Jasper - Mpok Siti"
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
        <h1 class="h2" style="font-weight:bold; color:#2E2A61;">Dashboard Jasa Pengiriman</h1>
    </div>
    
    <div class="row">
        <!-- Kartu -->
        <div class="col-6 col-md-4 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
            <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Nama Konter</div>
                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $data->nama_counter }}</div>
                </div>
            </div>
            </div>
        </div>
        </div>
        
        <!-- Kartu -->
        <div class="col-6 col-md-4 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
            <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Penanggung Jawab</div>
                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $data->penanggungJawab }}</div>
                </div>
            </div>
            </div>
        </div>
        </div>

        <!-- Kartu -->
        <?php $count = 1 ?>
        <div class="col-6 col-md-4 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
            <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Alamat Konter</div>
                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $data->alamat_counter }}</div>
                <br>
                <a href="" class="btn btn-primary stretched-link" data-toggle="modal" data-target=<?= '"#mapModal' . $count . '"' ?>>Cek Lokasi</a>
                </div>
            </div>
            </div>
        </div>
        </div>

        <!-- modal -->
        <div class="modal fade" id=<?= '"mapModal' . $count . '"' ?> tabindex="-1" role="dialog" aria-labelledby=<?= '"#mapModalLabel' . $count . '"' ?> aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id=<?= '"#mapModalLabel' . $count . '"' ?>>Lokasi <?= $data->nama_counter ?> </h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <iframe src=<?= "https://maps.google.com/maps?q=" . $data->latitude . "," . $data->longitude . "&z=15&output=embed" ?> width="720" height="540" frameborder="0" style="border:0"></iframe>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-primary" type="button" data-dismiss="modal">Tutup</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

</main>

@endsection