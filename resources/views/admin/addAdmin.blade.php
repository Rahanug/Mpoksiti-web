@extends('layouts.admin')

@section('css')
  <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
  <link rel="stylesheet" href="//cdn.datatables.net/1.11.4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" type="text/css" href="vendor/DataTables/datatables.min.css"/>
@endsection

@section('content')

{{-- <script>document.title = "Proses Stuffing Virtual"</script> --}}
<main class="justify-content-md-center-lg-10 px-md-2"><div class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand"><div class=""></div></div><div class="chartjs-size-monitor-shrink"><div class=""></div></div></div>
  <section id="multiple-column-form">
                    <div class="row match-height">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h2 class="card-title" style="font-weight:bold; color:#2E2A61;">Tambah Admin</h2>
                                </div>
                                <div class="card-content">
                                    <div class="card-body">
                                        <form method="POST" action="/admin/admin-chatbot/addAdmins/storeAdmins" enctype="multipart/form-data">
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

                                            {{-- 'id',
                                                'no_wa',
                                                'username' --}}

                                            {{-- <div class="form-group"> --}}
                                                {{-- <label for="id_kategori" style="font-weight:500; color:#2E2A61; font-size: 18px;">Kategori Dokumen</label> --}}
                                                {{-- <select class="form-control" id="id_kategori" name="id_kategori" > --}}
                                                    {{-- <option value="" onclick="pushData('id_kategori')">-- Pilih Kategori --</option>
                                                    @foreach ($kategori as $item)
                                                        <option value="{{ $item->id_kategori }}">{{ $item->nama_kategori }}</option>
                                                    @endforeach --}}
                                                {{-- </select> --}}
                                            {{-- </div> --}}
                                            
                                            {{-- <div class="form-group">
                                            <label for="id" style="font-weight:500; color:#2E2A61; font-size: 18px;">Id Admin</label>
                                                <input type="number" id="id" value="{{ old('id') }}" class="form-control"
                                                    placeholder="Id Admin" name="id" >
                                            </div> --}}

                                            <div class="form-group">
                                            <label for="no_wa" style="font-weight:500; color:#2E2A61; font-size: 18px;">Nomor WhatsApp</label>
                                                <input type="text" id="no_wa" value="{{ old('no_wa') }}" class="form-control"
                                                    placeholder="Nomor WhatsApp" name="no_wa" >
                                            </div>

                                            <div class="form-group">
                                            <label for="username" style="font-weight:500; color:#2E2A61; font-size: 18px;">Username</label>
                                                <input type="text" id="username" value="{{ old('username') }}" class="form-control"
                                                    placeholder="Username Admin" name="username" >
                                            </div>

                                            {{-- <div class="form-group" >
                                              <label for="time" style="font-weight:500; color:#2E2A61; font-size: 18px;">Tanggal Terbit</label>
                                              <input type="date" id="tgl_terbit" value="{{ old('tgl_terbit') }}" class="form-control" placeholder="tgl_terbit" name="tgl_terbit"  >
                                            </div> --}}

                                            {{-- <div class="form-group">
                                                <label for="nm_dokumen" style="font-weight:500; color:#2E2A61; font-size: 18px;">Upload Dokumen</label>
                                                <input type="file" id="nm_dokumen" class="form-control" name="nm_dokumen">
                                            </div> --}}
                                                <div class="col-12 d-flex justify-content-end">
                                                    <a type="button" class="btn btn-outline-danger" style="margin-right: 1%" href="/admin/admin-chatbot">Cancel</a>
                                                    <button type="submit" class="btn btn-outline-primary" name="submit" value="Simpan Data">Submit</button>
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