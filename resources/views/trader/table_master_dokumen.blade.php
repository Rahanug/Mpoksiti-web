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
            <td>{{ $master->tgl_terbit }}</td>
            <td>{{ $master->status }}</td>
            <td>
              @if($master->status == 'non-Aktif')
              <a style="margin: 0 3px" class="btn btn-sm btn-secondary" href="/master/editMaster/{{$master->id_master}}">Edit</a>
              @endif
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
</div>