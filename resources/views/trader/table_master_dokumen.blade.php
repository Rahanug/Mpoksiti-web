<div class="table-responsive">
  <table class="table table-striped" id="tableMaster">
    <thead>
      <tr>
        <th scope="col">No</th>
        <th scope="col">Kategori Dokumen</th>
        <th scope="col">Nomor Dokumen</th>
        <th scope="col">Tanggal Terbit</th>
        <th scope="col">Status</th>
        <th scope="col">Aksi</th>
      </tr>
    </thead>
    <tbody>
      <?php $no = 0; ?>
      @foreach ($masters as $master)
      <tr>
        <td>{{ ++$no; }}</td>
        <td>{{ $kategori[$master->id_kategori] }}</td>
        <td>{{ $master->no_dokumen }}</td>
        @if($master->tgl_terbit != null)
        <td>{{ date('Y-m-d', strtotime($master->tgl_terbit))}}</td>
        @else
        <td></td>
        @endif
        <?php 
        switch ($master->status){
          case $master->status == 'non-Aktif':
            echo '<td><a style="color:red; font-weight: 600;">'.$master->status.'</a></td>';
            break;
          case $master->status == 'Aktif':
            echo '<td><a style="color:blue; font-weight: bold;">'.$master->status.'</a></td>';
            break;
          default:
            echo '<td><a style="color:black; font-weight: bold;">'.$master->status.'</span></td>';
            break;
        }
        ?>
        <td>
          <a style="margin: 0 3px" class="btn btn-sm btn-secondary" href="{{route('trader.detailMaster', [$master->id_master])}}">Detail</a>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>