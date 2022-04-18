@extends('layouts.admin')

@section('css')
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
<link rel="stylesheet" href="//cdn.datatables.net/1.11.4/css/dataTables.bootstrap4.min.css">
@endsection

@section('content')
<script>
    document.title = "Hasil Stuffing - Mpok Siti"
</script>
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="chartjs-size-monitor">
        <div class="chartjs-size-monitor-expand">
            <div class=""></div>
        </div>
        <div class="chartjs-size-monitor-shrink">
            <div class=""></div>
        </div>
    </div>
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2" style="font-weight:bold; color:#2E2A61;">Detail Stuffing</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="mr-2">
                <a type="button" class="btn btn-secondary" href="/admin/stuffing" style="font-weight: bold">
                    Kembali
                </a>
            </div>
        </div>
    </div>
    <section id="multiple-column-form">
        <div class="row match-height">
            @foreach($details as $detail)
            <div class="col-6">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title" style="font-weight: bold; font-size:large;">Detail PPK</h4>
                    </div>

                    <div class="card-content">
                        <div class="card-body">
                            <div class="form-group">
                                <label style="font-weight: bold;">No PPK</label>
                                <input class="form-control" type="text" value="{{ $detail->no_ppk }}" disabled>
                            </div>
                            <div class="form-group">
                                <label style="font-weight: bold;">No Aju PPK</label>
                                <input class="form-control" type="text" value="{{ $detail->no_aju_ppk }}" disabled>
                            </div>
                            <div class="form-group">
                                <label style="font-weight: bold;">Tanggal PPK</label>
                                <input class="form-control" type="text" value="{{ $detail->tgl_ppk }}" disabled>
                            </div>
                            <div class="form-group">
                                <label style="font-weight: bold;">KD Kegiatan</label>
                                <input class="form-control" type="text" value="{{ $detail->kd_kegiatan }}" disabled>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <div class="col-6">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title" style="font-weight: bold; font-size:large;">Detail Penerima</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">

                            <div class="form-group">
                                <label style="font-weight: bold;">Nama</label>
                                <input class="form-control" type="text" value="{{ $detail->nm_penerima }}" disabled>
                            </div>

                            <div class="form-group">
                                <label style="font-weight: bold;">Alamat</label>
                                <input class="form-control" type="text" value="{{ $detail->alamat }}" disabled>
                            </div>

                            <div class="form-group">
                                <label style="font-weight: bold;">Negara</label>
                                <input class="form-control" type="text" value="{{ $detail->negara_penerima }}" disabled>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @foreach($stuffing as $s)
        <div class="row match-height" style="margin-top:2rem">
            <div class="col-6">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title" style="font-weight: bold; font-size:large;">Detail Stuffing</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">

                            <div class="form-group">
                                <label style="font-weight: bold;">Status</label>
                                <input class="form-control" type="text" value="{{ $s->status }}" disabled>
                            </div>

                            <div class="form-group">
                                <label style="font-weight: bold;">Jadwal Periksa</label>
                                @if($s->jadwal_periksa != "")
                                <input class="form-control" type="text" value="{{ date('Y-m-d H:i', strtotime($s->jadwal_periksa))}}" disabled>
                                @else
                                <input class="form-control" type="text" value="" disabled>
                                @endif
                            </div>

                            <div class="form-group">
                                <label style="font-weight: bold;">No Izin</label>
                                <input class="form-control" type="text" value="{{ $s->no_izin }}" disabled>
                            </div>
                            <div class="form-group">
                                <label style="font-weight: bold;">Tanggal Izin</label>
                                <input class="form-control" type="text" value="{{ $s->tgl_izin }}" disabled>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-6">
                <div class="card">
                    <div class="card-content">
                        <div class="card-body">
                            <div class="form-group">
                                <label style="font-weight: bold;">Deskripsi</label>
                                <textarea class="form-control" type="text" value="{{ $s->deskripsi }}" disabled>{{ $s->deskripsi }}</textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
        <div class="row match-height" style="margin-top:2rem">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title" style="font-weight: bold; font-size:large;">Dokumen Stuffing</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th scope="col">Kategori Dokumen</th>
                                            <th scope="col">Nomor Dokumen</th>
                                            <th scope="col">Nama Dokumen</th>
                                            <th scope="col">Tanggal Terbit</th>
                                            <th scope="col">Preview</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($dokumen as $f)
                                        <tr>
                                            <td>{{ $kategori[$f->id_kategori] }}</td>
                                            <td>{{ $f->no_dokumen }}</td>
                                            <td>{{ $f->nm_dokumen }}</td>
                                            <td>{{ date('Y-m-d', strtotime($f->tgl_terbit))}}</td>
                                            <td><a target="_blank" href="<?=url('files/'. $f->nm_dokumen) ?>" style="margin: 0 3px" class="btn btn-sm btn-outline-dark">Preview</a></td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
        <br>
    </section>
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