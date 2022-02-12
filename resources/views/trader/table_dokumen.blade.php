<div class="table-responsive">
  <table class="table" id="tableDokumen">
    <thead>
      <tr>
        <style>
          #col-aksi {
            text-align: right;
            padding-right: 85pt;
          }
        </style>
        <th scope="col">Kategori Dokumen</th>
        <th scope="col">Nama Dokumen</th>
        <th scope="col" id="col-aksi">Aksi</th>       
      </tr>
    </thead>
    <tbody>
      <form method="POST" enctype="multipart/form-data" id="upload-file" action="/home/{id_ppk}/store">
        @csrf
        @foreach ($kategoris as $kategori)
        <?php $no = 0; ?>
        <tr>
          <td>{{$kategori->nama_dokumen}}</td>
          <style>
            #button-aksi {
              text-align: right;
            }
          </style>
          <td>
            {{$dokumens[$kategori['id_kategori']]['nm_dokumen'] ?? ''}}
          </td>
          <td id="button-aksi">
            <input type="file" name="nm_dokumen" placeholder="Choose file" id="nm_dokumen">
          </td>
        </tr>
        @endforeach
    </tbody>
    </form>
  </table>
  <div class="col-md-12">
    <button form="upload-file" type="submit" class="btn btn-primary" id="submit">Submit</button>
  </div>
</div>