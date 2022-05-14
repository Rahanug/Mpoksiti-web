@extends('layouts.admin')

@section('css')
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
<link rel="stylesheet" href="//cdn.datatables.net/1.11.4/css/dataTables.bootstrap4.min.css">
@endsection

@section('content')
<script>
    document.title = "Form Stuffing - Mpok Siti"
</script>
<main class="col-md-9 ms-sm-auto col-lg-12 px-md-4">
    <div class="chartjs-size-monitor">
        <div class="chartjs-size-monitor-expand">
            <div class=""></div>
        </div>
        <div class="chartjs-size-monitor-shrink">
            <div class=""></div>
        </div>
    </div>
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2" style="font-weight:bold; color:#2E2A61;">Form Hasil Verifikasi Lapangan</h1>
        <a class="btn btn-sm btn-secondary" id="edit form">Edit form</a>
    </div>
    <section id="multiple-column-form">
        <div class="row match-height">
            <div class="col-12">
                <div class="card">
                    <div class="card-content">
                        <div class="card-body">
                            <form method="POST" action="{{$ppk}}/storeSubform" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col">
                                        @if (session()->has('Error'))
                                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                            <ul>
                                                <li>{{ session('Error') }}</li>
                                            </ul>
                                        </div>
                                        @endif
                                        
                                        <div class="table-responsive">
                                            <table class="table">
                                                <thead>
                                                    <th scope='col'>Indikator</th>
                                                    <th scope='col'>Keterangan</th>
                                                    <th></th>
                                                </thead>
                                                <tbody>
                                                    @foreach($data as $d)
                                                    <!-- Buat Switch Case tergantung tipe data -->
                                                    <td>{{$d->indikator}}</td>
                                                    <td>
                                                        <?php
                                                        $old = old("input-' . $d->id_masterSubform . '-' . $d->id_subform . '");
                                                        switch ($d->tipe_data) {
                                                            case 'datetime':
                                                                echo '
                                                        <div class="form-group">
                                                            <input type="datetime-local" id="jadwal_periksa" value="' . $old . '" class="form-control" placeholder="Jadwal" name="input-' . $d->id_masterSubform . '-' . $d->id_subform . '">
                                                        </div>                             
                                                        ';
                                                                break;
                                                            case 'kondisi':
                                                                $oldK = old("keterangan-' . $d->id_masterSubform . '-' . $d->id_subform . '");
                                                                echo '
                                                        <div class="form-group">
                                                            <select name="input-' . $d->id_masterSubform . '-' . $d->id_subform . '">
                                                                <option value="Sesuai">Sesuai</option>
                                                                <option value="Tidak Sesuai">Tidak Sesuai</option>
                                                            </select>
                                                            <td>
                                                            <div class="form-group">
                                                                <input type="text" id="" value="' . old("keterangan-' . $d->id_masterSubform . '-' . $d->id_subform . '") . '" class="form-control" placeholder="" name="keterangan-' . $d->id_masterSubform . '-' . $d->id_subform . '">
                                                            </div>
                                                            </td> 
                                                        </div>
                                                        ';
                                                                break;
                                                            case 'text':
                                                                echo '
                                                        <div class="form-group">
                                                            <input type="text" id="" value="' . old("input-' . $d->id_masterSubform . '-' . $d->id_subform . '") . '" class="form-control" placeholder="" name="input-' . $d->id_masterSubform . '-' . $d->id_subform . '">
                                                        </div>  
                                                        ';
                                                                break;
                                                            case 'rekomendasi':
                                                                echo '
                                                                <div class="form-group">
                                                                    <select name="input-' . $d->id_masterSubform . '-' . $d->id_subform . '">
                                                                        <option value="Sesuai">Sesuai</option>
                                                                        <option value="Tidak Sesuai">Tidak Sesuai</option>
                                                                    </select>
                                                                </div>
                                                                <td>
                                                                <div class="form-group">
                                                                    <input type="text" id="" value="' . old("keterangan-' . $d->id_masterSubform . '-' . $d->id_subform . '"). '" class="form-control" placeholder="" name="keterangan-' . $d->id_masterSubform . '-' . $d->id_subform . '">
                                                                </div> 
                                                                </td> 
                                                                ';
                                                                break;
                                                                case 'gambar':
                                                                    echo '
                                                                    <div class="form-group">
                                                                        <input type="file" name="gambar-' . $d->id_masterSubform . '-' . $d->id_subform . '" placeholder="Choose files"></td>
                                                                    </div>
                                                                    <td>
                                                                    
                                                                    </td> 
                                                                    ';
                                                                    break;
                                                        } ?>
                                                    </td>
                                                </tbody>
                                                @endforeach
                                            </table>
                                            <!-- <table class="table">
                                                <thead>
                                                    <th>
                                                        Upload Gambar
                                                    </th>
                                                </thead>
                                                    <tbody>
                                                        <td><input type="file" name="images_stuffing[]" placeholder="Choose files" multiple></td>
                                                    </tbody>                                                
                                            </table> -->
                                        </div>
                                        <br>
                                        <div class="col-12 d-flex justify-content-end">
                                            <button type="submit" class="btn btn-secondary" style="background-color: #3C5C94" name="submit" value="Simpan Data">Submit</button>
                                        </div>
                                    </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    </div>
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
        $('#tablePpk').DataTable({
            responsive: true,
        });

    });
</script>
@endpush