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
        <h1 class="h2" style="font-weight:bold; color:#2E2A61;">Dashboard Jasper</h1>
    </div>
    <table>
        <tr>
            <th scope="col">Nama Konter: {{ $data->nama_counter }}</th>
        </tr>
        <tr>
            <th scope="col">Alamat: {{ $data->alamat_counter }}</th>
        </tr>
        <tr>
            <th scope="col">Penanggung Jawab: {{ $data->penanggungJawab }}</th>
        </tr>
        <tr>
            <th scope="col">
                <?php $count = 1 ?>
                <a href="" class="btn btn-sm btn-outline-dark" data-toggle="modal" data-target=<?= '"#mapModal' . $count . '"' ?>>Cek Lokasi</a>
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
                                <button type="submit" class="btn btn-primary">Ubah</button>
                            </div>
                        </div>
                    </div>
                </div>
            </th>
        </tr>
    </table>
</main>

@endsection