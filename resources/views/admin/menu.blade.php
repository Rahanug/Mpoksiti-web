@extends('layouts.admin')

@section('content')
<script>document.title = "Menu - Mpok Siti"</script>
<main class="col-md-9 ms-sm-auto col-lg-12 px-md-4"><div class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand"><div class=""></div></div><div class="chartjs-size-monitor-shrink"><div class=""></div></div></div>
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h1" style="font-weight:bold; color:#2E2A61;">Home Menu</h1>
    <div class="btn-toolbar mb-2 mb-md-0">
      <div class="btn-group me-2">
      </div>
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
            <th scope="col" style="font-weight:semibold; color:#2E2A61;">No</th>
            <th scope="col" style="font-weight:semibold; color:#2E2A61;">Nama Menu</th>
            <th scope="col" style="font-weight:semibold; color:#2E2A61;">URL</th>
            <th scope="col" style="font-weight:semibold; color:#2E2A61;">Action</th>
          </tr>
        </thead>
        <tbody>
        <?php $no = 0;?>
          @foreach ($menus as $menu)
          <tr>
            <td style="font-weight:regular; color:#2E2A61;">{{ ++$no; }}</td>
            <td style="font-weight:regular; color:#2E2A61;">{{ $menu->nm_menu }}</td>
            <td style="font-weight:regular; color:#2E2A61;">{{ $menu->url }}</td>
            <td>
              <a href="/admin/menu/editMenu/{{$menu->id_menu}}" style="margin: 0 3px; " class="btn btn-sm btn-outline-dark">Edit</a>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>

</main>
@endsection