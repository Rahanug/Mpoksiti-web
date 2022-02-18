<div class="table-responsive">
  <table class="table" id="tableDokumen">
    <thead>
      <tr>
        <th scope="col">Kategori Dokumen</th>
        <th scope="col">Nama Dokumen</th>
        <th scope="col" id="col-aksi">Aksi</th>
      </tr>
    </thead>
    <tbody>
      <?php
      $showButton = false;
      ?>
      <form method="POST" enctype="multipart/form-data" id="upload-file" action="/home/{{$ppk->id_ppk}}/store">
        @csrf
        @foreach ($kategoris as $kategori)
        <?php $no = 0; ?>
        <tr>
          <td>{{$kategori->nama_dokumen}}</td>
          <td>
            {{$dokumens[$kategori['id_kategori']]['nm_dokumen'] ?? ''}}
          </td>

          <td id="button-aksi">
            @if(!isset($dokumens[$kategori['id_kategori']]['nm_dokumen']))
            <?php $showButton = true; ?>
            <input type="file" name="nm_dokumen-{{$kategori->id_kategori}}" placeholder="Choose file" id="nm_dokumen-{{$kategori->id_kategori}}" required>
            @else
            <a href="/home/{{$ppk->id_ppk}}/delete/{{$dokumens[$kategori['id_kategori']]['id_dokumen']}}" style="margin: 0 3px" class="btn btn-sm btn-outline-dark">Delete</a>
            @endif
          </td>
        </tr>
        @endforeach
    </tbody>
    </form>
  </table>
  @if($showButton)
  <div class="col-md-12">
    <button form="upload-file" type="submit" class="btn btn-primary" id="submit">Submit</button>
  </div>
  @endif
</div>