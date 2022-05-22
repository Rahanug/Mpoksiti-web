<?php

namespace App\Http\Controllers\webhook;

use App\Http\Controllers\webhook\HandlerCommandInterface;

use App\Http\Controllers\webhook\AbstractWebhookController;

class SeputarKesehatanIkanController extends AbstractWebhookController implements HandlerCommandInterface
{
    public function handleMessage(
        String $mobile,
        String $command,
        String $pesan,
        Bool $isFirstError
    ) {
        switch (true) {
            case str_contains($command, "seputar kesehatan ikan"):
                switch (true) {
                    case str_contains($pesan, "ekspor"):
                        // parent::insertCommand("sk_ikan_ekspor", $mobile);
                        parent::sendMsg(
                            $mobile,
                            "*Persyaratan serta Dokumen yang diperlukan untuk pengurusan karantina ekspor*\n\n1. Permohonan Pemeriksaan Karantina Online (www.ppk.bkipm.kkp.go.id)\n\n2. Dokumen lain yang dipersyaratkan, untuk jenis-jenis yang dilarang/dibatasi pengeluarannya SAJI-LN\n\n3. Packing List (PL), Identitas Produk atau batch code, Invoice, Identitas Sertifikat sesuai Negara tujuan dan Air Way Bill, Bill of Loading; dan Dokumen lain yang dipersyaratkan sesuai ketentuan negara tujuan atau ketentuan internasional yang mengikat.\n\n4. LHU Survailance CKIB/ HACCP.\n\n5. Sertifkat CKIB/ HACCP ( www.ckib.bkipm.kkp.go.id dan http://haccp.bkipm.kkp.go.id/)\n\n*Biaya dan Waktu*\n\na. Biaya sesuai dengan PP 85 Tahun 2021\n\nb. Waktu Pelayanan:\n   - Permohonan Online 24 jam\n   - Sertifikasi dan Pembayaran PNBP 07.00-24.00\n   - Pemeriksaan Fisik: 24 jam",
                            [],
                        );
                        parent::endMenu($mobile);
                        break;

                    case str_contains($pesan, "impor"):
                        // parent::insertCommand("sk_ikan_impor", $mobile);
                        parent::sendMsg(
                            $mobile,
                            "*Persyaratan serta Dokumen yang diperlukan untuk pengurusan karantina impor*\n\n1. Surat Permohonan Pemeriksaan Karantina (PPK) impor\n\n2. Sertifikat Kesehatan dari Negara asal dan/atau Negara transit\n\n3. Sertifikat asal / Certificate of origin yang diterbitkan oleh pejabat berwenang di Negara asal\n\n4. Surat Izin Pemasukan (Impor) Ikan Hias/Ikan Hidup dari Direktorat Jenderal Perikanan Budidaya/ Surat Izin Pemasukan Hasil Perikanan dari Direktorat Jenderal Pengolahan dan Pemasaran Hasil Perikanan/ Surat Keterangan Teknis dari Direktorat Jenderal Budidaya untuk Media Pembawa berupa bahan baku pakan ikan/udang (fish meal, fish oil, dll), makanan ikan/udang, dan obat ikan.\n\n5. Sertifikat Penetapan Instalasi Karantina Ikan\n\n6. Dokumen CITES untuk jenis-jenis media pembawa yang dilindungi atau diatur peredarannya\n\n7. Dokumen lain sebagai kewajiban tambahan sesuai dengan pasal 7 Peraturan Menteri Kelautan dan Perikanan Nomor PER.10/MEN/2012  tentang Kewajiban Tambahan Karantina Ikan.\n\n*Biaya dan Waktu*\n\na. Biaya sesuai dengan PP 85 Tahun 2021\n\nb. Waktu Pelayanan:\n   - Permohonan Online 24 jam\n   - Sertifikasi dan Pembayaran PNBP 07.00-24.00\n   - Pemeriksaan Fisik: 24 jam",
                            [],
                        );

                        parent::endMenu($mobile);
                        break;

                    case str_contains($pesan, "domestik"):
                        // parent::insertCommand("sk_ikan_domestik", $mobile);
                        parent::sendMsg(
                            $mobile,
                            "*Persyaratan serta Dokumen yang diperlukan untuk pengurusan karantina domestik*\n\n1. Permohonan Pemeriksaan Karantina Online (www.ppk.bkipm.kkp.go.id)\n\n2. Dokumen lain yang dipersyaratkan, untuk jenis-jenis yang dilarang/dibatasi pengeluarannya SAJI-DN\n\n3. Packing List (PL), Invoice.\n\n4. LHU Survailance CKIB/ LHU bagi end product inspection.\n\n5. ESKIPP/ Pas Karantina bagi Domestik Masuk/ Sertifikat Pelepasan.\n\n*Biaya dan Waktu*\n\na. Biaya sesuai dengan PP 85 Tahun 2021\n\nb. Waktu Pelayanan:\n   - Permohonan Online 24 jam\n   - Sertifikasi dan Pembayaran PNBP 07.00-24.00\n   - Pemeriksaan Fisik: 24 jam",
                            [],
                        );
                        parent::endMenu($mobile);

                        break;

                    case str_contains($pesan, "menu utama"):
                        parent::insertCommand("halo", $mobile);
                        parent::sendMsg(
                            $mobile,
                            "Selamat Datang di layanan Halo Mpok Siti, Media Pelayanan Online Karantina Simpel dan Terintegrasi, apa yang ingin Anda ketahui ? \n",
                            [
                                parent::getSingleButton("Seputar Kesehatan Ikan", "IPKI", ""),

                                parent::getSingleButton("Layanan Sertifikasi Mutu", "PSPM", ""),

                                parent::getSingleButton("Lacak Info Sertifikasi", "TILS", ""),

                                parent::getSingleButton("Hubungi Customer Service", "CS", ""),

                            ],
                            WebhookConfig::MESSAGE_TYPE_POPUP
                        );

                        break;
                    default:
                        parent::insertCommand("maaf", $mobile);
                        parent::sendSorryMessage($mobile, $isFirstError);
                }
                break;
        }
    }
}