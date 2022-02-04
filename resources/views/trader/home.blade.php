@extends('layouts.trader')

@section('content')
<script>document.title = "Pengajuan Stuffing Virtual"</script>
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4"><div class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand"><div class=""></div></div><div class="chartjs-size-monitor-shrink"><div class=""></div></div></div>
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Pengajuan Stuffing Virtual</h1> 
    <div class="btn-toolbar mb-2 mb-md-0">
    </div>
  </div>
  <!-- Session ketika berhasil -->
  @if (session()->has('success'))
    <div class="alert alert-primary alert-dismissible fade show" role="alert">
      {{ session('success') }}
      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    </div>
    @endif
  
    @if (session()->has('accept'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
      {{ session('accept') }}
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

  <div id="taro">
    <div class="table-responsive">
      <table class="table table-striped table-sm">
        <thead>
          <tr>
            <th scope="col">No</th>
            <th scope="col">Penerima</th>
            <th scope="col">Nomor PPK</th>
            <th scope="col">Nomor Pengajuan PPK</th>
            <th scope="col">Status</th>
            <th scope="col">Aksi</th>
          </tr>
        </thead>
        <tbody>
          <?php $no = 0; ?>
          @foreach ($ppks as $ppk) 
          <tr>
            <td>{{ ++$no; }}</td>
            <td>{{ $trader[ppks->nm_trader]}}</td>
            <td>{{ $ppks->no_ppk }}</td>
            <td>{{ $ppks->no_aju_ppk }}</td>
            <td>{{ $ppks->status }}</td>
            <td style="font-weight: bold">{{ ucfirst($ppks->status)}}</td>
            <td>
              <a style="margin: 0 3px" class="btn btn-sm btn-outline-dark">Detail</a>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</main>
@endsection