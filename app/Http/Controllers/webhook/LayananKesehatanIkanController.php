<?php

namespace App\Http\Controllers\webhook;

use App\Http\Controllers\webhook\HandlerCommandInterface;

use App\Http\Controllers\webhook\AbstractWebhookController;

class LayananKesehatanIkanController extends AbstractWebhookController implements HandlerCommandInterface
{
    public function handleMessage(
        String $mobile,
        String $command,
        String $pesan,
        Bool $isFirstError
    ) {
        switch (true) {
            case str_contains($command, "layanan sertifikasi mutu"):
                switch (true) {
                    case str_contains($pesan, "sertifikasi haccp"):
                        // parent::insertCommand("sertif_haccp", $mobile);
                        parent::sendMsg(
                            $mobile,
                            "*Persyaratan serta Dokumen yang diperlukan untuk pelayanan Sertifikasi Penerapan HACCP*\n\n1. Memiliki unit penanganan dan/atau pengolahan yang sesuai dengan jenis  produk perikanan yang akan disertifikasi.\n\n2. Mempekerjakan sekurang-kurangnya 1 (satu) orang penanggungjawab mutu yang mempunyai sertifikat HACCP di bidang perikanan/pangan.\n\n3. Khusus untuk UPI yang melakukan proses suhu tinggi, mempekerjakan operator yang mempunyai sertifikat pelatihan proses suhu tinggi.\n\n4. Memiliki dan menerapkan Sistem HACCP secara konsisten sesuai dengan Persyaratan Jaminan Mutu dan Keamanan Hasil Perikanan pada Proses Produksi, Pengolahan dan Distribusi minimal 10 kali proses sebelum permohonan.\n\n5. Melakukan produksi secara aktif\n\nUPI mengajukan surat permohonan kepada Kepala Pusat Pengendalian Mutu – BKIPM, dengan melampirkan dokumen sebagai berikut :\n\n1. Panduan Mutu berdasarkan konsepsi HACCP yang telah divalidasi;\n\n2. Fotokopi identitas pemohon;\n\n3. Fotokopi Nomor Pokok Wajib Pajak;\n\n4. Fotokopi Sertifikat SKP;\n\n5. Surat Pernyataan melakukan proses produksi secara aktif dan menerapkan HACCP.\n\nApabila semua persyaratan dinyatakan sesuai, maka Kepala Pusat Pengendalian Mutu akan menugaskan inspektur mutu untuk melakukan inspeksi penerapan HACCP\n\n\n*Biaya dan Waktu*\n\na. Gratis\nb. Waktu Pelayanan : 10 hari kerja",
                            [],
                        );

                        parent::endMenu($mobile);
                        break;

                    case str_contains($pesan, "negara mitra"):
                        // parent::insertCommand("negara mitra", $mobile);
                        parent::sendMsg(
                            $mobile,
                            "*Persyaratan serta Dokumen yang diperlukan untuk pelayanan Negara Mitra*\n\n1. Nomor registrasi  (Noreg) negara mitra adalah nomor identifikasi tertentu UPI yang diterbitkan oleh otoritas kompeten dan telah mendapat persetujuan dari negara mitra tertentu untuk melakukan ekspor.\n\n2. Negara mitra adalah negara tujuan ekspor dan Impor hasil perikanan Indonesia yang telah memiliki kesepakatan/kerjasama dengan pemerintah Republik Indonesia dalam penerapan system jaminan mutu dan keamanan hasil perikanan. Adapun negara –negara tersebut yaitu negara anggota Uni Eropa (28 negara anggota), Kanada, Korea, China, Vietnam, Rusia dan Norwegia.\n\n3. Bagaimana cara memperoleh nomor registrasi?\nUPI dapat mengajukan permohonan kepada Kepala Pusat Pengendalian Mutu, BKIPM dengan melampirkan :Copy HACCP, Surat Pernyataan pemanfaatan nomor registrasi, dan Appendix 3, khusus untuk pendaftaran ke Vietnam.\n\n4. nomor registrasi tidak memiliki masa berlaku terkecuali apabila terhadap nomor registrasi tersebut dilakukan suspend atau pencabutan\n\n\n*Biaya dan Waktu*\n\na. Gratis\nb. Waktu Pelayanan: 10 Hari Kerja",
                            [],
                        );

                        parent::endMenu($mobile);
                        break;

                    case str_contains($pesan, "surveilance"):
                        // parent::insertCommand("surveilance", $mobile);
                        parent::sendMsg(
                            $mobile,
                            "*Persyaratan serta Dokumen yang diperlukan untuk pelayanan Surveilance*\n\n1. Surveilan merupakan kegiatan inspeksi yang harus dilakukan oleh lembaga inspeksi dan sertifikasi untuk memastikan bahwa penerapan HACCP oleh Unit Penanganan dan pengolahan Ikan (UPI) berjalan secara konsisten dan efektif. Hasil dari surveilan dan pengambilan contoh menjadi dasar menerbitkan Sertifikat Kesehatan (Health Certificate/HC).\n\n2. Frekuensi surveilan dilaksanakan berdasarkan grade Sertifikat Penerapan HACCP yaitu sekurang-kurangnya 3 (tiga) bulan sekali untuk grade A, 2 (dua) bulan sekali untuk grade B dan 1 (satu) bulan sekali untuk grade C.",
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