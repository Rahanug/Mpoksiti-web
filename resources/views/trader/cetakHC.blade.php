<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" style="font-family:'Times New Roman', Times, serif">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Laravel SB Admin 2">
    <meta name="author" content="Alejandro RH">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Halaman Trader') }}</title>

    <!-- Fonts -->
    <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/styleAdmin.css') }}">
    <style>
        body {
        background-color: white !important;
        }
        ::-moz-selection {
        background-color: white !important;
        }
        ::selection {
        background-color: white !important;
        }
    </style>
    <style>
        <?php include(public_path() . '/css/sb-admin-2.min.css'); ?><?php include(public_path() . '/css/app.css'); ?><?php include(public_path() . '/js/sb-admin-2.min.js'); ?>
    </style>

    <!-- Favicon -->

    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="//cdn.datatables.net/1.11.4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="vendor/DataTables/datatables.min.css" />
</head>

<body id="page-top">
    
    <script>
        document.title = "Cetak HC"
    </script>
    <main class="justify-content-md-center-lg-10 px-md-2">
        <div class="d-flex justify-content-center flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3">
            <div class="row">
                <div class="col-md-2">
                    <img src="<?php echo $_SERVER["DOCUMENT_ROOT"] . '/img/logo_header.png'; ?>" alt="logo BKIPM" width="100%" />
                </div>
                <div class="col-md-10" style="text-align: center; margin-left:-3rem">
                    <h6 style="color: blue;">KEMENTERIAN KELAUTAN DAN PERIKANAN</h6>
                    <h6 style="color: blue;">BADAN KARANTINA IKAN, PENGENDALIAN MUTU,</h6>
                    <h6 style="color: blue;">DAN KEAMANAN HASIL PERIKANAN</h6>
                    <h6 style="color: blue;">BALAI BESAR KARANTINA IKAN, PENGENDALIAN MUTU DAN</h6>
                    <h6 style="color: blue;">KEAMANAN HASIL PERIKANAN JAKARTA I</h6>
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
                    Perikanan (SKIPP) Ekspor. dengan No izin <u>{{$f->no_izin}}</u> dan tanggal izin <u>{{ date('Y-m-d H:i', strtotime($f->tgl_izin))}}</u></div>
            </div>
            <div class="row">
                <div class="col-sm-1"><input type="checkbox" name="rekomendasi-2" id="rekomendasi-2" class="w-100" disabled></div>
                <div class="col-sm-11">
                    <p>
                        Tidak sesuai dengan permohonan penerbitan Sertifikat Kesehatan Ikan dan
                        Produk Perikanan (SKIPP) Ekspor , karena</br>
                    </p>
                    <p>
                        .....................................................................................................................................................
                    </p>
                </div>
            </div>
            @elseif (($master[$f->id_masterSubform]) == 'Rekomendasi' && $f->value == 'Tidak Sesuai')
            <div>
                <div style="float:left;"><input type="checkbox" name="rekomendasi-1" id="rekomendasi-1" class="w-100" disabled></div>
                <div style="float:right;">Setelah dilakukan verifikasi atas kebenaran data, bahwa sudah
                    sesuai permohonan penerbitan Sertifikat Kesehatan Ikan dan Produk
                    Perikanan (SKIPP) Ekspor .</div>
            </div>
            <div>
                <div style="float:left;"><input type="checkbox" name="rekomendasi-2" id="rekomendasi-2" class="w-100" checked></div>
                <div style="float:right;">
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
            <div style="margin-bottom:5rem">
                @foreach ($ppks as $f)
                @if (($master[$f->id_masterSubform]) == 'Nama Petugas')
                <div style="float:left; text-align:center">
                    <p>Cap dan Tanda Tangan</p>
                    <p>Inspektu Mutu</p>
                    <br><br>
                    <p>{{ucfirst($f->value)}}</p>
                </div>
                @endif
                @if (($master[$f->id_masterSubform]) == 'Nama UPI')
                <div style="float:right; text-align:center">
                    <p>Cap dan Tanda</p>
                    <p>Tangan UPI</p><br><br>
                    <p>{{ucfirst($f->value)}}</p>
                </div>
                @endif
                @endforeach
            </div>
            <br><br>
            <div class="table-responsive">
                <div class="table-responsive" id="tableHasil">
                    <table class="table table-bordered">
                        <tbody>
                            @foreach($images as $i)
                            <tr>
                                <td>
                                    <img src='<?php echo include(public_path() . '/images_stuffing'. "/$i->images"); ?>' srcset="img/Proses.png 10000w 7000h" sizes="(min-width: 200px, min-height: 50px)">
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>

    <!-- Scripts -->
    <script src=<?php include(public_path() . '/vendor/jquery/jquery.min.js'); ?>> </script>
    <script src=<?php include(public_path() . '/vendor/bootstrap/js/bootstrap.min.js'); ?>> </script>
    <script src=<?php include(public_path() . '/vendor/jquery-easing/jquery.easing.min.js'); ?>> </script>
    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js') }}"></script>
    <script src="{{ asset('js/sb-admin-2.min.js') }}"></script>

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
            return true; }
    </script>
</body>
</html>