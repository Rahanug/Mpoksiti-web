<div class="table-responsive">
      <table class="table" id="tableDokumen">
        <thead>
          <tr>
          <style>
              #col-aksi{
                text-align : right;
                padding-right: 85pt;
              }
          </style>
            <th scope="col">Kategori Dokumen</th>
            <th scope="col" id="col-aksi">Aksi</th>
          </tr>
        </thead>
        <tbody>
          <?php $no = 0; ?>
          @foreach ($dokumens as $dokumen) 
          <tr>
            <td>{{$dokumen->nama_dokumen}}</td>
            <style>
              #button-aksi{
                text-align : right;
              }
          </style>
            <td id="button-aksi">
              <a style="margin: 0 3px" class="btn btn-sm btn-outline-dark" href="">Unggah</a>
              <a style="margin: 0 3px" class="btn btn-sm btn-outline-dark" href="">Unduh</a>    
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
</div>