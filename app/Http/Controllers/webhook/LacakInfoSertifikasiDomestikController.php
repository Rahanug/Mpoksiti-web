<?php

namespace App\Http\Controllers\webhook;

use Illuminate\Support\Facades\DB;

use App\Http\Controllers\webhook\HandlerCommandInterface;

use App\Http\Controllers\webhook\AbstractWebhookController;

class LacakInfoSertifikasiDomestikController extends AbstractWebhookController implements HandlerCommandInterface
{

    // LACAK DOMESTIK KELUAR
    public function selectPPKKeluar($pesan)
    {
        // return FlowguideModel::select('no_aju_ppk')
        return DB::connection('sqlsrv2')
            ->table('v_for_flowguide')
            ->select('no_aju_ppk')
            ->where('no_aju_ppk', $pesan)
            ->where('kd_kegiatan', 'K')
            ->first();
    }

    public function lacakKeluar($pesan)
    {
        // return FlowguideModel::select('nm_dok')
        return DB::connection('sqlsrv2')
            ->table('v_for_flowguide')
            ->select('nm_dok')
            ->where('no_aju_ppk', $pesan)
            ->where('kd_kegiatan', 'K')
            ->orderByDesc('id_urut')
            ->first();
    }

    // LACAK DOMESTIK MASUK
    public function selectPPKMasuk($pesan)
    {
        // return FlowguideModel::select('no_aju_ppk')
        return DB::connection('sqlsrv2')
            ->table('v_for_flowguide')
            ->select('no_aju_ppk')
            ->where('no_aju_ppk', $pesan)
            ->where('kd_kegiatan', 'M')
            ->first();
    }

    public function lacakMasuk($pesan)
    {
        // return FlowguideModel::select('nm_dok')
        return DB::connection('sqlsrv2')
            ->table('v_for_flowguide')
            ->select('nm_dok')
            ->where('no_aju_ppk', $pesan)
            ->where('kd_kegiatan', 'M')
            ->orderByDesc('id_urut')
            ->first();
    }

    public function handleMessage(
        String $mobile,
        String $command,
        String $pesan,
        Bool $isFirstError
    ) {
        switch (true) {
            case str_contains($command, "sertifikat domestik"):
                switch (true) {
                    case str_contains($pesan, "domestik keluar"):
                        parent::insertCommand($pesan, $mobile);
                        parent::sendMsg(
                            $mobile,
                            "Pelayanan Sertifikat Domestik Keluar memiliki tiga jenis fitur yang dapat diajukan menggunakan nomor aju PPK, yang manakah kebutuhan Anda? ",
                            [
                                parent::getSingleButton("Lacak Status Pengajuan", "TSP", ""),

                                parent::getSingleButton("No Ijin/No Sertifikat", "NoIjin", ""),

                                parent::getSingleButton("Biaya PNBP", "PNBP", ""),

                                parent::getSingleButton("Menu Sebelumnya", "back", ""),

                            ],
                            WebhookConfig::MESSAGE_TYPE_POPUP
                        );
                        break;
                    case str_contains($pesan, "domestik masuk"):
                        parent::insertCommand($pesan, $mobile);
                        parent::sendMsg(
                            $mobile,
                            "Pelayanan Sertifikat Domestik Masuk memiliki tiga jenis fitur yang dapat diajukan menggunakan nomor aju PPK, yang manakah kebutuhan Anda? ",
                            [
                                parent::getSingleButton("Lacak Status Pengajuan", "TSP", ""),

                                parent::getSingleButton("No Ijin/No Sertifikat", "NoIjin", ""),

                                parent::getSingleButton("Biaya PNBP", "PNBP", ""),

                                parent::getSingleButton("Menu Sebelumnya", "back", ""),

                            ],
                            WebhookConfig::MESSAGE_TYPE_POPUP
                        );
                        break;
                    case str_contains($pesan, "menu sebelumnya"):
                        parent::sendMsg(
                            $mobile,
                            "Terdapat dua jenis layanan Sertifikasi, pilih sesuai dengan kebutuhan Anda\n",
                            [
                                parent::getSingleButtonReply("reply", "SEI", "Sertif Ekspor Impor"),

                                parent::getSingleButtonReply("reply", "SDomestik", "Sertifikat Domestik",),

                                parent::getSingleButtonReply("reply", "kembali", "Menu Sebelumnya"),
                            ],
                            WebhookConfig::MESSAGE_TYPE_BUTTON
                        );
                        break;
                    default:
                        parent::insertCommand("maaf", $mobile);
                }
                break;
            case str_contains($command, "domestik keluar"):
                switch (true) {
                    case str_contains($pesan, "menu sebelumnya"):
                        parent::sendMsg(
                            $mobile,
                            "Berikut adalah layanan sertifikasi yang kami sediakan, silahkan pilih sesuai kebutuhan Anda\n",
                            [
                                parent::getSingleButtonReply("reply", "DK", "Domestik Keluar"),

                                parent::getSingleButtonReply("reply", "DM", "Domestik Masuk",),

                                parent::getSingleButtonReply("reply", "kembali", "Menu Sebelumnya"),

                            ],
                            WebhookConfig::MESSAGE_TYPE_BUTTON
                        );
                        break;
                    case str_contains($pesan, "lacak status pengajuan"):
                        parent::insertCommand("dk_aju_lacak", $mobile);
                        parent::sendMsg(
                            $mobile,
                            "Silahkan masukkan nomor aju PPK Anda\n",
                            [
                                parent::getSingleButtonReply("reply", "kembali", "Menu Sebelumnya"),
                            ],
                            WebhookConfig::MESSAGE_TYPE_BUTTON
                        );
                        break;
                    case str_contains($pesan, "no ijin/no sertifikat"):
                        parent::insertCommand("dk_no_sertif", $mobile);
                        parent::sendMsg(
                            $mobile,
                            "Silahkan masukkan nomor aju PPK Anda\n",
                            [
                                parent::getSingleButtonReply("reply", "kembali", "Menu Sebelumnya"),
                            ],
                            WebhookConfig::MESSAGE_TYPE_BUTTON
                        );
                        break;
                    case str_contains($pesan, "biaya pnbp"):
                        parent::insertCommand("biaya pnbp dk", $mobile);
                        parent::sendMsg(
                            $mobile,
                            "Silahkan masukkan nomor aju PPK Anda\n",
                            [
                                parent::getSingleButtonReply("reply", "kembali", "Menu Sebelumnya"),
                            ],
                            WebhookConfig::MESSAGE_TYPE_BUTTON
                        );
                        break;
                    default:
                        parent::insertCommand("maaf", $mobile);
                }
                break;
            case str_contains($command, "dk_aju_lacak"):
                $selectPPK = $this->selectPPKKeluar(strtoupper($pesan));
                $sertif = $this->lacakKeluar(strtoupper($pesan));
                switch (true) {
                    case str_contains($pesan, "menu sebelumnya"):
                        parent::sendMsg(
                            $mobile,
                            "Pelayanan Sertifikat Domestik Keluar memiliki tiga jenis fitur yang dapat diajukan menggunakan nomor aju PPK, yang manakah kebutuhan Anda? ",
                            [
                                parent::getSingleButton("Lacak Status Pengajuan", "TSP", ""),

                                parent::getSingleButton("No Ijin/No Sertifikat", "NoIjin", ""),

                                parent::getSingleButton("Biaya PNBP", "PNBP", ""),

                                parent::getSingleButton("Menu Sebelumnya", "back", ""),

                            ],
                            WebhookConfig::MESSAGE_TYPE_POPUP
                        );
                        break;
                    case str_contains(strtoupper($pesan), $selectPPK->no_aju_ppk):
                        parent::insertCommand("nomor aju dk", $mobile);
                        parent::sendMsg(
                            $mobile,
                            "Berdasarkan tracking, proses Anda telah sampai pada $sertif->nm_dok",
                            [],
                        );
                        parent::sendMsg(
                            $mobile,
                            "Anda telah sampai pada akhir sesi ini. Apa yang ingin Anda lakukan?\n",
                            [
                                parent::getSingleButtonReply("reply", "Ulang", "Menu Utama"),

                                parent::getSingleButtonReply("reply", "Selesai", "Selesai"),
                            ],
                            WebhookConfig::MESSAGE_TYPE_BUTTON
                        );

                        break;
                    default:
                        parent::insertCommand("maaf", $mobile);
                }
                break;
            case str_contains($command, "nomor aju dk"):
                switch (true) {
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
                    case str_contains($pesan, "selesai"):
                        parent::insertCommand("selesai", $mobile);
                        parent::sendMsg(
                            $mobile,
                            "Terima kasih telah menggunakan layanan chatbot Mpok Siti",
                            [],
                        );
                        break;
                    default:
                        parent::insertCommand("maaf", $mobile);
                }
                break;
            case str_contains($command, "dk_no_sertif"):
                $selectPPK = $this->selectPPK(strtoupper($pesan));
                switch (true) {
                    case str_contains($pesan, "menu sebelumnya"):
                        parent::sendMsg(
                            $mobile,
                            "Pelayanan Sertifikat Domestik Keluar memiliki tiga jenis fitur yang dapat diajukan menggunakan nomor aju PPK, yang manakah kebutuhan Anda?",
                            [
                                parent::getSingleButton("Lacak Status Pengajuan", "TSP", ""),

                                parent::getSingleButton("No Ijin/No Sertifikat", "NoIjin", ""),

                                parent::getSingleButton("Biaya PNBP", "PNBP", ""),

                                parent::getSingleButton("Menu Sebelumnya", "back", ""),

                            ],
                            WebhookConfig::MESSAGE_TYPE_POPUP
                        );
                        break;
                    case str_contains(strtoupper($pesan), $selectPPK->no_aju_ppk):
                        $nomorSertif = $this->getNoIjin(strtoupper($pesan));
                        if ($nomorSertif == false) {
                            parent::insertCommand("selesai", $mobile);
                            parent::sendMsg(
                                $mobile,
                                "Data yang Anda cari berdasarkan nomor Aju tidak ditemukan. Periksa kembali status pengajuan Anda di menu lacak informasi dan pastikan Anda telah sampai pada proses Single Certificate",
                                [],
                            );
                            parent::sendMsg(
                                $mobile,
                                "Anda telah sampai pada akhir sesi ini. Apa yang ingin Anda lakukan?\n",
                                [
                                    parent::getSingleButtonReply("reply", "Ulang", "Menu Utama"),

                                    parent::getSingleButtonReply("reply", "Selesai", "Selesai"),
                                ],
                                WebhookConfig::MESSAGE_TYPE_BUTTON
                            );
                        } else {
                            parent::insertCommand("nomor aju dk", $mobile);
                            parent::sendMsg(
                                $mobile,
                                "Berdasarkan nomor Aju Domestik Keluar yang Anda masukkan, berikut adalah nomor sertifikat Anda $nomorSertif->no_sertifikat",
                                [],
                            );
                            parent::sendMsg(
                                $mobile,
                                "Anda telah sampai pada akhir sesi ini. Apa yang ingin Anda lakukan?\n",
                                [
                                    parent::getSingleButtonReply("reply", "Ulang", "Menu Utama"),

                                    parent::getSingleButtonReply("reply", "Selesai", "Selesai"),
                                ],
                                WebhookConfig::MESSAGE_TYPE_BUTTON
                            );
                        }
                        break;

                    default:
                        parent::insertCommand("maaf", $mobile);
                }
                break;
            case str_contains($command, "biaya pnbp dk"):
                $selectPPK = $this->selectPPKPNBP(strtoupper($pesan));
                switch (true) {
                    case str_contains($pesan, "menu sebelumnya"):
                        parent::sendMsg(
                            $mobile,
                            "Pelayanan Sertifikat Domestik Keluar memiliki tiga jenis fitur yang dapat diajukan menggunakan nomor aju PPK, yang manakah kebutuhan Anda?",
                            [
                                parent::getSingleButton("Lacak Status Pengajuan", "TSP", ""),

                                parent::getSingleButton("No Ijin/No Sertifikat", "NoIjin", ""),

                                parent::getSingleButton("Biaya PNBP", "PNBP", ""),

                                parent::getSingleButton("Menu Sebelumnya", "back", ""),

                            ],
                            WebhookConfig::MESSAGE_TYPE_POPUP
                        );
                        break;
                    case str_contains(strtoupper($pesan), $selectPPK->no_aju_ppk):
                        $kelTarif = $this->selectTarif(strtoupper($pesan));
                        $tarifText = "";
                        $total = 0;
                        foreach ($kelTarif as $tarif) {
                            $kel_tarif = $tarif->kel_tarif;

                            $harga = $tarif->total;
                            $tarifText .=  "$kel_tarif Rp $harga \n";
                            $total += $harga;
                        }
                        if ($kelTarif == null) {
                            parent::insertCommand("selesai", $mobile);
                            parent::sendMsg(
                                $mobile,
                                "Data yang Anda cari berdasarkan nomor Aju tidak ditemukan. Periksa kembali status pengajuan Anda di menu lacak informasi dan pastikan Anda telah sampai pada proses PNBP",
                                [],
                            );
                            parent::sendMsg(
                                $mobile,
                                "Anda telah sampai pada akhir sesi ini. Apa yang ingin Anda lakukan?\n",
                                [
                                    parent::getSingleButtonReply("reply", "Ulang", "Menu Utama"),

                                    parent::getSingleButtonReply("reply", "Selesai", "Selesai"),
                                ],
                                WebhookConfig::MESSAGE_TYPE_BUTTON
                            );
                        } else {
                            parent::insertCommand("pnbp dk", $mobile);
                            parent::sendMsg(
                                $mobile,
                                "Berdasarkan nomor Aju Domestik Keluar yang Anda masukkan, berikut adalah pnbp Anda \n$tarifText \n total: Rp $total",
                                [],
                            );
                            parent::sendMsg(
                                $mobile,
                                "Anda telah sampai pada akhir sesi ini. Apa yang ingin Anda lakukan?\n",
                                [
                                    parent::getSingleButtonReply("reply", "Ulang", "Menu Utama"),

                                    parent::getSingleButtonReply("reply", "Selesai", "Selesai"),
                                ],
                                WebhookConfig::MESSAGE_TYPE_BUTTON
                            );
                        }
                        break;

                    default:
                        parent::insertCommand("maaf", $mobile);
                }
                break;

            case str_contains($command, "pnbp dk"):
                switch (true) {
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
                    case str_contains($pesan, "selesai"):
                        parent::insertCommand("selesai", $mobile);
                        parent::sendMsg(
                            $mobile,
                            "Terima kasih telah menggunakan layanan chatbot Mpok Siti",
                            [],
                        );
                        break;

                    default:
                        parent::insertCommand("maaf", $mobile);
                }
                break;



            case str_contains($command, "domestik masuk"):
                switch (true) {
                    case str_contains($pesan, "menu sebelumnya"):
                        parent::sendMsg(
                            $mobile,
                            "Berikut adalah layanan sertifikasi yang kami sediakan, silahkan pilih sesuai kebutuhan Anda\n",
                            [
                                parent::getSingleButtonReply("reply", "DK", "Domestik Keluar"),

                                parent::getSingleButtonReply("reply", "DM", "Domestik Masuk",),

                                parent::getSingleButtonReply("reply", "kembali", "Menu Sebelumnya"),

                            ],
                            WebhookConfig::MESSAGE_TYPE_BUTTON
                        );
                        break;
                    case str_contains($pesan, "lacak status pengajuan"):
                        parent::insertCommand("dm_aju_lacak", $mobile);
                        parent::sendMsg(
                            $mobile,
                            "Silahkan masukkan nomor aju PPK Anda\n",
                            [
                                parent::getSingleButtonReply("reply", "kembali", "Menu Sebelumnya"),
                            ],
                            WebhookConfig::MESSAGE_TYPE_BUTTON
                        );
                        break;
                    case str_contains($pesan, "no ijin/no sertifikat"):
                        parent::insertCommand("dm_no_sertif", $mobile);
                        parent::sendMsg(
                            $mobile,
                            "Silahkan masukkan nomor aju PPK Anda\n",
                            [
                                parent::getSingleButtonReply("reply", "kembali", "Menu Sebelumnya"),
                            ],
                            WebhookConfig::MESSAGE_TYPE_BUTTON
                        );
                        break;
                    case str_contains($pesan, "biaya pnbp"):
                        parent::insertCommand("biaya pnbp dm", $mobile);
                        parent::sendMsg(
                            $mobile,
                            "Silahkan masukkan nomor aju PPK Anda\n",
                            [
                                parent::getSingleButtonReply("reply", "kembali", "Menu Sebelumnya"),
                            ],
                            WebhookConfig::MESSAGE_TYPE_BUTTON
                        );
                        break;

                    default:
                        parent::insertCommand("maaf", $mobile);
                }
                break;
            case str_contains($command, "dm_aju_lacak"):
                $selectPPK = $this->selectPPKMasuk(strtoupper($pesan));
                $sertif = $this->lacakMasuk(strtoupper($pesan));
                switch (true) {
                    case str_contains($pesan, "menu sebelumnya"):
                        parent::sendMsg(
                            $mobile,
                            "Pelayanan Sertifikat Domestik Masuk memiliki tiga jenis fitur yang dapat diajukan menggunakan nomor aju PPK, yang manakah kebutuhan Anda? ",
                            [
                                parent::getSingleButton("Lacak Status Pengajuan", "TSP", ""),

                                parent::getSingleButton("No Ijin/No Sertifikat", "NoIjin", ""),

                                parent::getSingleButton("Biaya PNBP", "PNBP", ""),

                                parent::getSingleButton("Menu Sebelumnya", "back", ""),

                            ],
                            WebhookConfig::MESSAGE_TYPE_POPUP
                        );
                        break;
                    case str_contains(strtoupper($pesan), $selectPPK->no_aju_ppk):
                        parent::insertCommand("nomor aju dm", $mobile);
                        parent::sendMsg(
                            $mobile,
                            "Berdasarkan tracking, proses Anda telah sampai pada $sertif->nm_dok",
                            [],
                        );
                        parent::sendMsg(
                            $mobile,
                            "Anda telah sampai pada akhir sesi ini. Apa yang ingin Anda lakukan?\n",
                            [
                                parent::getSingleButtonReply("reply", "Ulang", "Menu Utama"),

                                parent::getSingleButtonReply("reply", "Selesai", "Selesai"),
                            ],
                            WebhookConfig::MESSAGE_TYPE_BUTTON
                        );
                        break;
                    default:
                        parent::insertCommand("maaf", $mobile);
                }
                break;
            case str_contains($command, "nomor aju dm"):
                switch (true) {
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
                    case str_contains($pesan, "selesai"):
                        arent::insertCommand("selesai", $mobile);
                        parent::sendMsg(
                            $mobile,
                            "Terima kasih telah menggunakan layanan chatbot Mpok Siti",
                            [],
                        );
                        break;

                    default:
                        parent::insertCommand("maaf", $mobile);
                }
                break;
            case str_contains($command, "dm_no_sertif"):
                $selectPPK = $this->selectPPK(strtoupper($pesan));
                switch (true) {
                    case str_contains($pesan, "menu sebelumnya"):
                        parent::sendMsg(
                            $mobile,
                            "Pelayanan Sertifikat Domestik Masuk memiliki tiga jenis fitur yang dapat diajukan menggunakan nomor aju PPK, yang manakah kebutuhan Anda?",
                            [
                                parent::getSingleButton("Lacak Status Pengajuan", "TSP", ""),

                                parent::getSingleButton("No Ijin/No Sertifikat", "NoIjin", ""),

                                parent::getSingleButton("Biaya PNBP", "PNBP", ""),

                                parent::getSingleButton("Menu Sebelumnya", "back", ""),

                            ],
                            WebhookConfig::MESSAGE_TYPE_POPUP
                        );
                        break;
                    case str_contains(strtoupper($pesan), $selectPPK->no_aju_ppk):
                        $nomorSertif = $this->getNoIjin(strtoupper($pesan));
                        if ($nomorSertif == false) {
                            parent::insertCommand("selesai", $mobile);
                            parent::sendMsg(
                                $mobile,
                                "Data yang Anda cari berdasarkan nomor Aju tidak ditemukan. Periksa kembali status pengajuan Anda di menu lacak informasi dan pastikan Anda telah sampai pada proses Single Certificate",
                                [],
                            );
                            parent::sendMsg(
                                $mobile,
                                "Anda telah sampai pada akhir sesi ini. Apa yang ingin Anda lakukan?\n",
                                [
                                    parent::getSingleButtonReply("reply", "Ulang", "Menu Utama"),

                                    parent::getSingleButtonReply("reply", "Selesai", "Selesai"),
                                ],
                                WebhookConfig::MESSAGE_TYPE_BUTTON
                            );
                        } else {
                            parent::insertCommand("nomor aju dm", $mobile);
                            parent::sendMsg(
                                $mobile,
                                "Berdasarkan nomor Aju Domestik Masuk yang Anda masukkan, berikut adalah nomor sertifikat Anda $nomorSertif->no_sertifikat",
                                [],
                            );
                            parent::sendMsg(
                                $mobile,
                                "Anda telah sampai pada akhir sesi ini. Apa yang ingin Anda lakukan?\n",
                                [
                                    parent::getSingleButtonReply("reply", "Ulang", "Menu Utama"),

                                    parent::getSingleButtonReply("reply", "Selesai", "Selesai"),
                                ],
                                WebhookConfig::MESSAGE_TYPE_BUTTON
                            );
                        }
                        break;

                    default:
                        parent::insertCommand("maaf", $mobile);
                }
                break;
            case str_contains($command, "biaya pnbp dm"):
                $selectPPK = $this->selectPPKPNBP(strtoupper($pesan));
                switch (true) {
                    case str_contains($pesan, "menu sebelumnya"):
                        parent::sendMsg(
                            $mobile,
                            "Pelayanan Sertifikat Domestik Masuk memiliki tiga jenis fitur yang dapat diajukan menggunakan nomor aju PPK, yang manakah kebutuhan Anda?",
                            [
                                parent::getSingleButton("Lacak Status Pengajuan", "TSP", ""),

                                parent::getSingleButton("No Ijin/No Sertifikat", "NoIjin", ""),

                                parent::getSingleButton("Biaya PNBP", "PNBP", ""),

                                parent::getSingleButton("Menu Sebelumnya", "back", ""),

                            ],
                            WebhookConfig::MESSAGE_TYPE_POPUP
                        );
                        break;
                    case str_contains(strtoupper($pesan), $selectPPK->no_aju_ppk):
                        $kelTarif = $this->selectTarif(strtoupper($pesan));
                        $tarifText = "";
                        $total = 0;
                        foreach ($kelTarif as $tarif) {
                            $kel_tarif = $tarif->kel_tarif;

                            $harga = $tarif->total;
                            $tarifText .=  "$kel_tarif Rp $harga \n";
                            $total += $harga;
                        }
                        if ($kelTarif == null) {
                            parent::insertCommand("selesai", $mobile);
                            parent::sendMsg(
                                $mobile,
                                "Data yang Anda cari berdasarkan nomor Aju tidak ditemukan. Periksa kembali status pengajuan Anda di menu lacak informasi dan pastikan Anda telah sampai pada proses PNBP",
                                [],
                            );
                            parent::sendMsg(
                                $mobile,
                                "Anda telah sampai pada akhir sesi ini. Apa yang ingin Anda lakukan?\n",
                                [
                                    parent::getSingleButtonReply("reply", "Ulang", "Menu Utama"),

                                    parent::getSingleButtonReply("reply", "Selesai", "Selesai"),
                                ],
                                WebhookConfig::MESSAGE_TYPE_BUTTON
                            );
                        } else {
                            parent::insertCommand("pnbp dm", $mobile);
                            parent::sendMsg(
                                $mobile,
                                "Berdasarkan nomor Aju Domestik Masuk yang Anda masukkan, berikut adalah pnbp Anda \n$tarifText \n total: Rp $total",
                                [],
                            );
                            parent::sendMsg(
                                $mobile,
                                "Anda telah sampai pada akhir sesi ini. Apa yang ingin Anda lakukan?\n",
                                [
                                    parent::getSingleButtonReply("reply", "Ulang", "Menu Utama"),

                                    parent::getSingleButtonReply("reply", "Selesai", "Selesai"),
                                ],
                                WebhookConfig::MESSAGE_TYPE_BUTTON
                            );
                        }
                        break;

                    default:
                        parent::insertCommand("maaf", $mobile);
                }
                break;
            case str_contains($command, "pnbp dm"):
                switch (true) {
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
                    case str_contains($pesan, "selesai"):
                        parent::insertCommand("selesai", $mobile);
                        parent::sendMsg(
                            $mobile,
                            "Terima kasih telah menggunakan layanan chatbot Mpok Siti",
                            [],
                        );
                        break;

                    default:
                        parent::insertCommand("maaf", $mobile);
                }
                break;
            default:
                parent::sendSorryMessage($mobile, $isFirstError);
        }
    }
}