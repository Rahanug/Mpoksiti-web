@extends('layouts.cetak')

@section('css')
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
<link rel="stylesheet" href="//cdn.datatables.net/1.11.4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" type="text/css" href="vendor/DataTables/datatables.min.css" />
@endsection

@section('content')
<script>
    document.title = "Dashboard"
</script>
<main class="justify-content-md-center-lg-10 px-md-2">
    <div class="chartjs-size-monitor">
        <div class="chartjs-size-monitor-expand">
            <div class=""></div>
        </div>
        <div class="chartjs-size-monitor-shrink">
            <div class=""></div>
        </div>
    </div>
    <!-- <div class="d-flex justify-content-center flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3">
        <h2 class="h2">Form Hasil Verifikasi Lapangan</h2>
    </div> -->
    <div class="d-flex justify-content-center flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3">
        <div class="card shadow w-100 responsive" style="margin: top 10px;">
            <div class="card-body" style="margin: top 10px; padding: 5rem">
                <div class="row">
                    <div class="col-lg-1">
                        <img src="/img/logo_header.png" alt="logo BKIPM" />
                    </div>
                    <div class="col-lg-11" style="text-align: center; margin-left:-3rem">
                        <h4 style="color: blue;">KEMENTERIAN KELAUTAN DAN PERIKANAN</h4>
                        <h4 style="color: blue;">BADAN KARANTINAIKAN, PENGENDALIAN MUTU</h4>
                        <h4 style="color: blue;">DAN KEAMANAN HASIL PERIKANAN</h4>
                        <h4 style="color: blue;">BALAI BESAR KARANTINA IKAN, PENGENDALIAN MUTU DAN</h4>
                        <h4 style="color: blue;">KEAMANAN HASIL PERIKANAN JAKARTA I</h4>
                        <h6 style="font-size: small;">ALAMAT GEDUNG KARANTINA PERTANIAN BANDARA SOEKARNO – HATTA 19120</h6>
                        <h6 style="font-size: small;">TELEPON : (021) 5507932,5591 5059 FAKSIMILI : (021) 5506738 email : JakartaI@bkipm.kkp.go.id</h6>
                    </div>
                    <hr style="border: 0; clear:both; display:block; width: 100%; background-color:#000000; height: 5px;" />
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <h4 style="text-align: center;">FORM HASIL VERIFIKASI LAPANGAN</h4>
                        <table>
                            @foreach ($ppks as $f)
                            <tr>
                                @if( ($master[$f->id_masterSubform]) == 'Tanggal verifikasi lapangan')
                                <td>Tanggal verifikasi lapangan</td>
                                <td>&nbsp;: {{date('d-m-Y H:i', strtotime($f->value))}}</td>
                                @else
                                <td></td>
                                @endif

                            </tr>
                            <tr>
                                @if(($master[$f->id_masterSubform]) == 'No Agenda')
                                <td>No Agenda</td>
                                <td>&nbsp;: {{$f->value}}</td>
                                @else
                                <td></td>
                                @endif
                            </tr>
                            <tr>
                                @if(($master[$f->id_masterSubform]) == 'Nama UPI')
                                <td>Nama UPI</td>
                                <td>&nbsp;: {{$f->value}}</td>
                                @else
                                <td></td>
                                @endif
                            </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
                <div class="table-responsive">
                    <div class="table-responsive" id="tableHasil">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">Indikator</th>
                                    <th scope="col">Hasil</th>
                                    <th scope="col">Keterangan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($ppks as $f)
                                @if(($master[$f->id_masterSubform]) != 'Tanggal verifikasi lapangan'
                                && ($master[$f->id_masterSubform]) != 'No Agenda'
                                && ($master[$f->id_masterSubform]) != 'Nama UPI'
                                && ($master[$f->id_masterSubform]) != 'Nama Petugas'
                                && ($master[$f->id_masterSubform]) != 'Rekomendasi')
                                <tr>
                                    <td>{{ $master[$f->id_masterSubform] }}</td>
                                    <td>{{ $f->value }}</td>
                                    <td>{{ $f->keterangan }}</td>
                                </tr>
                                @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <p>Keterangan : Beri tanda √ pada kolom pilihan</p>

                <p>REKOMENDASI :</p>
                @foreach ($ppks as $f)
                @if (($master[$f->id_masterSubform]) == 'Rekomendasi' && $f->value == 'Sesuai')
                <div class="row">
                    <div class="col-sm-1"><input type="checkbox" name="rekomendasi-1" id="rekomendasi-1" class="w-100" checked></div>
                    <div class="col-sm-11">Setelah dilakukan verifikasi atas kebenaran data, bahwa sudah
                        sesuai permohonan penerbitan Sertifikat Kesehatan Ikan dan Produk
                        Perikanan (SKIPP) Ekspor .</div>
                </div>
                <div class="row">
                    <div class="col-sm-1"><input type="checkbox" name="rekomendasi-2" id="rekomendasi-2" class="w-100" disabled></div>
                    <div class="col-sm-11">
                        <p>
                            Tidak sesuai dengan permohonan penerbitan Sertifikat Kesehatan Ikan dan
                            Produk Perikanan (SKIPP) Ekspor , karena</br>
                        </p>
                        <p>
                            ...........................................................................................................................................................................................................................................................................................
                        </p>
                    </div>
                </div>
                @elseif (($master[$f->id_masterSubform]) == 'Rekomendasi' && $f->value == 'Tidak Sesuai')
                <div class="row">
                    <div class="col-sm-1"><input type="checkbox" name="rekomendasi-1" id="rekomendasi-1" class="w-100" disabled></div>
                    <div class="col-sm-11">Setelah dilakukan verifikasi atas kebenaran data, bahwa sudah
                        sesuai permohonan penerbitan Sertifikat Kesehatan Ikan dan Produk
                        Perikanan (SKIPP) Ekspor .</div>
                </div>
                <div class="row">
                    <div class="col-sm-1"><input type="checkbox" name="rekomendasi-2" id="rekomendasi-2" class="w-100" checked></div>
                    <div class="col-sm-11">
                        <p>
                            Tidak sesuai dengan permohonan penerbitan Sertifikat Kesehatan Ikan dan
                            Produk Perikanan (SKIPP) Ekspor , karena</br>
                        </p>
                        <p>
                            {{$f->keterangan}}
                        </p>
                    </div>
                </div>
                @endif
                @endforeach
                <div class="row">
                    @foreach ($ppks as $f)
                    @if (($master[$f->id_masterSubform]) == 'Nama Petugas')
                    <div class="col-lg-6" style="text-align: center;">
                        <p>Cap dan Tanda Tangan</p>
                        <p>Inspektu Mutu</p>
                        </br></br></br>
                        <p>{{$f->value}}</p>
                    </div>
                    @endif
                    @endforeach
                    @foreach ($ppks as $f)
                    @if (($master[$f->id_masterSubform]) == 'Nama Petugas')
                    <div class="col-lg-6" style="text-align: center;">
                        <p>Cap dan Tanda</p>
                        <p>Tangan UPI</p></br></br></br>
                        <p>{{$trader[$f->id_trader]}}</p>
                    </div>
                    @endif
                    @endforeach
                </div>
            </div>
        </div>
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
            ordering: false,
            responsive: true,
        });

    });
    window.addEventListener('resize', myFunction);

    function myFunction() {
        if (screen.availWidth <= 800) {
            document.getElementById("detail").innerText = "Value baru"
        }
    }

    function printDiv(divName) {
        var mywindow = window.open('', 'PRINT', 'height=400,width=600');
        mywindow.document.write('<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous" type="text/css" media="all">');
        mywindow.document.write('<html><head><title>' + 'Hasil Stuffing Virtual' + '</title>');
        mywindow.document.write('</head><body >');
        mywindow.document.write('<h1>' + 'Hasil Stuffing Virtual' + '</h1>');
        mywindow.document.write(document.getElementById(divName).innerHTML);
        mywindow.document.write('</body></html>');
        mywindow.document.close(); // necessary for IE >= 10
        mywindow.focus(); // necessary for IE >= 10*/
        mywindow.print();
        mywindow.close();

        return true;
    }
</script>
@endpush