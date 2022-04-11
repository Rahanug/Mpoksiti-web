@extends('layouts.admin')

@section('css')
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
<link rel="stylesheet" href="//cdn.datatables.net/1.11.4/css/dataTables.bootstrap4.min.css">
@endsection

@section('content')
<script>
    document.title = "Kategori Dokumen - Mpok Siti"
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
        <h1 class="h2" style="font-weight:bold; color:#2E2A61;">Kategori Dokumen</h1>
    </div>
    <div class="container">
        <div class="d-flex justify-content-left flex-wrap flex-md-nowrap align-items-center pt-3 pb-2">
            <div class="btn-group">
                <button type="button" class="btn btn-sm btn btn-outline-primary" style="font-weight: bold;" onclick="location.href='/admin/kategori/TambahKategori'">Tambah Kategori</button>
            </div>
        </div>

        <div class="d-flex justify-content-center flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3">
            <div class="card shadow w-100 responsive" style="margin: top 10px;">
                <div class="card-body" style="margin: top 10px;">
                @if (session()->has('success'))
                <div class="alert alert-primary alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                </div>
                @endif

                @if (session()->has('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                </div>
                @endif

                @if (session()->has('info'))
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    {{ session('info') }}
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                </div>
                @endif
                    <div class="table-responsive">
                        <table class="table table-striped" id="tableMaster">
                            <thead>
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Kategori Dokumen</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Instansi</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 0; ?>
                                @foreach ($kategoris as $kategori)
                                <tr>
                                    <td>{{ ++$no; }}</td>
                                    <td>{{ $kategori->nama_kategori }}</td>
                                    @if($kategori->status == 1)
                                    <td>Aktif</td>
                                    @endif
                                    @if($kategori->status == 0)
                                    <td>Tidak Aktif</td>
                                    @endif
                                    <td>{{ $kategori->instansi_penerbit }}</td>
                                    <td>
                                        <a style="margin: 0 3px" class="btn btn-sm btn-secondary" href="/admin/kategori/editKategori/{{$kategori->id_kategori}}">Edit</a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
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
        $('#tableMaster').DataTable({
            responsive: true,
        });

    });
</script>
@endpush