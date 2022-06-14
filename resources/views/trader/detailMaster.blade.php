@extends('layouts.trader')

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
        <h1 class="h2" style="font-weight:bold; color:#2E2A61;">Detail Master Dokumen</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="mr-2">
                <a type="button" class="btn btn-secondary" href="{{ route('trader.master_dokumen') }}" style="font-weight: bold">
                    Kembali
                </a>
            </div>
        </div>
    </div>
    <section id="multiple-column-form">
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
        <div class="row match-height">
            @foreach($details as $detail)
            <div class="col-6">
                <div class="card">
                    <div class="card-content">
                        <div class="card-body">
                            <div class="form-group">
                                <label style="font-weight: bold;">Kategori Dokumen</label>
                                <input class="form-control" type="text" value="{{ $kategori[$detail->id_kategori] }}" disabled>
                            </div>
                            <div class="form-group">
                                <label style="font-weight: bold;">Nomor Dokumen</label>
                                <input class="form-control" type="text" value="{{  $detail->no_dokumen  }}" disabled>
                            </div>
                            <div class="form-group">
                                <label style="font-weight: bold;">Tanggal Terbit</label>
                                <input class="form-control" type="text" value="{{  date('Y-m-d', strtotime($detail->tgl_terbit)) }}" disabled>
                            </div>
                            <div class="form-group">
                                <label style="font-weight: bold;">Tanggal Berakhir</label>
                                <input class="form-control" type="text" value="{{  date('Y-m-d', strtotime($detail->tgl_expired)) }}" disabled>
                            </div>
                            <div class="form-group">
                                <label style="font-weight: bold;">Status</label>
                                <input class="form-control" type="text" value="{{  $detail->status }}" disabled>
                            </div>
                            @if($detail->status=='non-Aktif')
                            <div class="col-12 d-flex justify-content-end">
                                <a href="#" data-toggle="modal" data-target="#editModal" class="btn btn-secondary" style="background-color: #3C5C94">Edit</a>
                                <!--Edit Modal -->
                                <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLongTitle">Edit</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <main class="justify-content-md-center-lg-10 px-md-2">
                                                    <div class="chartjs-size-monitor">
                                                        <div class="chartjs-size-monitor-expand">
                                                            <div class=""></div>
                                                        </div>
                                                        <div class="chartjs-size-monitor-shrink">
                                                            <div class=""></div>
                                                        </div>
                                                    </div>
                                                    <section id="multiple-column-form">
                                                        <div class="row match-height">
                                                            <div class="col-12">
                                                                <div class="card">
                                                                    <div class="card-content">
                                                                        <div class="card-body">
                                                                            <form method="POST" action="{{route('trader.updateMaster', [$id_master] )}}" enctype="multipart/form-data">
                                                                                @csrf
                                                                                <div class="row">
                                                                                    <div class="col">
                                                                                        @if (count($errors) > 0)
                                                                                        <div class="alert alert-danger">
                                                                                            <ul>
                                                                                                @foreach ($errors->all() as $error)
                                                                                                <li>{{ $error }}</li>
                                                                                                @endforeach
                                                                                            </ul>
                                                                                        </div>
                                                                                        @endif
                                                                                        @foreach($editMasters as $p)
                                                                                        <div class="form-group">
                                                                                            <label for="id_kategori" style="font-weight:500; color:#2E2A61; font-size: 18px;">Kategori Dokumen</label>
                                                                                            <select class="form-control" id="id_kategori" name="id_kategori">
                                                                                                @foreach ($items as $item)
                                                                                                <option value="{{ $item->id_kategori }}" {{ strcmp($p->id_kategori,"$item->id_kategori")==0? 'selected':''; }}>{{ $item->nama_kategori }}</option>
                                                                                                @endforeach
                                                                                            </select>
                                                                                        </div>

                                                                                        <div class="form-group">
                                                                                            <label for="no_dokumen" style="font-weight:500; color:#2E2A61; font-size: 18px;">Nomor Dokumen</label>
                                                                                            <input type="text" id="no_dokumen" value="{{ $p->no_dokumen }}" class="form-control" placeholder="Nomor dokumen" name="no_dokumen">
                                                                                        </div>

                                                                                        <div class="form-group">
                                                                                            <label for="time" style="font-weight:500; color:#2E2A61; font-size: 18px;">Tanggal Terbit</label>
                                                                                            <input type="date" id="tgl_terbit" value="{{ date('Y-m-d', strtotime($p->tgl_terbit)) }}" class="form-control" placeholder="tgl_terbit" name="tgl_terbit">
                                                                                        </div>
                                                                                        <div class="col-12 d-flex justify-content-end">
                                                                                            <button type="submit" class="btn btn-secondary" style="background-color: #3C5C94" name="submit" value="Simpan Data">Submit</button>
                                                                                        </div>
                                                                                        @endforeach
                                                                                    </div>
                                                                                </div>
                                                                            </form>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </section>
                                                </main>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
                <br>
                <br>
            </div>
            <div class="col-6">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <!-- File Upload -->
                                <div class="row">
                                    <div class="col-md-12 text-center">
                                        <p><b>Master Dokumen</b></p>
                                        <a target="_blank" href="<?= url('files/' . $detail->nm_dokumen); ?>">
                                            <a href="https://www.flaticon.com/free-icons/click" title="click icons">Click icons created by Freepik - Flaticon</a></a>
                                        <br>
                                        @if($detail->status=='non-Aktif')
                                        <a href="#" data-toggle="modal" data-target="#reuploadModal" class="btn btn-secondary" style="background-color: #3C5C94"> Reupload Dokumen </a>
                                        <!--Reupload Modal -->
                                        <div class="modal fade" id="reuploadModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLongTitle">Edit</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <main class="justify-content-md-center-lg-10 px-md-2">
                                                            <div class="chartjs-size-monitor">
                                                                <div class="chartjs-size-monitor-expand">
                                                                    <div class=""></div>
                                                                </div>
                                                                <div class="chartjs-size-monitor-shrink">
                                                                    <div class=""></div>
                                                                </div>
                                                            </div>
                                                            <section id="multiple-column-form">
                                                                <div class="row match-height">
                                                                    <div class="col-12">
                                                                        <div class="card">
                                                                            <div class="card-content">
                                                                                <div class="card-body">
                                                                                    <form method="POST" action="{{route('trader.updateFiles', [$id_master] )}}" enctype="multipart/form-data">
                                                                                        @csrf
                                                                                        <div class="row">
                                                                                            <div class="col">
                                                                                                @if (count($errors) > 0)
                                                                                                <div class="alert alert-danger">
                                                                                                    <ul>
                                                                                                        @foreach ($errors->all() as $error)
                                                                                                        <li>{{ $error }}</li>
                                                                                                        @endforeach
                                                                                                    </ul>
                                                                                                </div>
                                                                                                @endif
                                                                                                @foreach($editMasters as $p)
                                                                                                <div class="form-group">
                                                                                                    <label for="nm_dokumen" style="font-weight:500; color:#2E2A61; font-size: 18px;">Upload Dokumen</label>
                                                                                                    <input type="file" id="nm_dokumen" class="form-control" name="nm_dokumen" value="{{$p->nm_dokumen}}">
                                                                                                </div>
                                                                                                <div class="col-12 d-flex justify-content-end">
                                                                                                    <button type="submit" class="btn btn-secondary" style="background-color: #3C5C94" name="submit" value="Simpan Data">Submit</button>
                                                                                                </div>
                                                                                                @endforeach
                                                                                            </div>
                                                                                        </div>
                                                                                    </form>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </section>
                                                        </main>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        <br>
                    </div>
                </div>
            </div>
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