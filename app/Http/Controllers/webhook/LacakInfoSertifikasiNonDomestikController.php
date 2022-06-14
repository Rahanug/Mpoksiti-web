<?php

namespace App\Http\Controllers\webhook;

use Illuminate\Support\Facades\DB;

use App\Http\Controllers\webhook\HandlerCommandInterface;

use App\Http\Controllers\webhook\AbstractWebhookController;

class LacakInfoSertifikasiNonDomestikController extends AbstractWebhookController implements HandlerCommandInterface
{
    // LACAK EKSPOR

    private function selectPPKEkspor($pesan)
    {
        // return FlowguideModel::select('no_aju_ppk')
        return DB::connection('sqlsrv2')
            ->table('v_for_flowguide')
            ->select('no_aju_ppk')
            ->where('no_aju_ppk', $pesan)
            ->where('kd_kegiatan', 'E')
            ->first();
    }

    private function lacakEkspor($pesan)
    {
        // return FlowguideModel::select('nm_dok')
        return DB::connection('sqlsrv2')
            ->table('v_for_flowguide')
            ->select('nm_dok')
            ->where('no_aju_ppk', $pesan)
            ->where('kd_kegiatan', 'E')
            ->orderByDesc('id_urut')
            ->first();
    }

    // LACAK IMPOR

    private function selectPPKImpor($pesan)
    {
        // return FlowguideModel::select('no_aju_ppk')
        return DB::connection('sqlsrv2')
            ->table('v_for_flowguide')
            ->select('no_aju_ppk')
            ->where('no_aju_ppk', $pesan)
            ->where('kd_kegiatan', 'I')
            ->first();
    }

    private function lacakImpor($pesan)
    {
        // return FlowguideModel::select('nm_dok')
        return DB::connection('sqlsrv2')
            ->table('v_for_flowguide')
            ->select('nm_dok')
            ->where('no_aju_ppk', $pesan)
            ->where('kd_kegiatan', 'I')
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
            case str_contains($command, "sertif ekspor impor"):
                switch (true) {
                    case str_contains($pesan, "ekspor"):
                        parent::insertCommand($pesan, $mobile);
                        parent::sendMsg(
                            $mobile,
                            "Pelayanan Sertifikat Ekspor memiliki tiga jenis fitur yang dapat diajukan menggunakan nomor aju PPK, yang manakah kebutuhan Anda?",
                            [
                                parent::getSingleButton("Lacak Status Pengajuan", "TSP", ""),

                                parent::getSingleButton("No Ijin/No Sertifikat", "NoIjin", ""),

                                parent::getSingleButton("Biaya PNBP", "PNBP", ""),

                                parent::getSingleButton("Menu Sebelumnya", "back", ""),

                            ],
                            WebhookConfig::MESSAGE_TYPE_POPUP
                        );
                        break;
                    case str_contains($pesan, "impor"):
                        parent::insertCommand($pesan, $mobile);
                        parent::sendMsg(
                            $mobile,
                            "Pelayanan Sertifikat Impor memiliki tiga jenis fitur yang dapat diajukan menggunakan nomor aju PPK, yang manakah kebutuhan Anda?",
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
                        $this->sendSorryMessage($mobile, $isFirstError);
                }
                break;
            case str_contains($command, "ekspor"):
                switch (true) {
                    case str_contains($pesan, "menu sebelumnya"):
                        parent::sendMsg(
                            $mobile,
                            "Berikut adalah layanan sertifikasi yang kami sediakan, silahkan pilih sesuai kebutuhan Anda\n",
                            [
                                parent::getSingleButtonReply("reply", "Ekspor", "Ekspor"),

                                parent::getSingleButtonReply("reply", "Impor", "Impor",),

                                parent::getSingleButtonReply("reply", "kembali", "Menu Sebelumnya"),

                            ],
                            WebhookConfig::MESSAGE_TYPE_BUTTON
                        );

                        break;
                    case str_contains($pesan, "lacak status pengajuan"):
                        parent::insertCommand("eks_aju_lacak", $mobile);
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
                        parent::insertCommand("eks_no_sertif", $mobile);
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
                        parent::insertCommand("biaya pnbp eks", $mobile);
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
                        parent::sendSorryMessage($mobile, $isFirstError);
                }
                break;
            case str_contains($command, "eks_aju_lacak"):
                $selectPPK = $this->selectPPKEkspor(strtoupper($pesan));
                $sertif = $this->lacakEkspor(strtoupper($pesan));
                switch (true) {
                    case str_contains($pesan, "menu sebelumnya"):
                        parent::sendMsg(
                            $mobile,
                            "Pelayanan Sertifikat Ekspor memiliki tiga jenis fitur yang dapat diajukan menggunakan nomor aju PPK, yang manakah kebutuhan Anda? ",
                            [
                                parent::getSingleButton("Lacak Status Pengajuan", "TSP", ""),

                                parent::getSingleButton("No Ijin/No Sertifikat", "NoIjin", ""),

                                parent::getSingleButton("Biaya PNBP", "PNBP", ""),

                                parent::getSingleButton("Menu Sebelumnya", "back", ""),

                            ],
                            WebhookConfig::MESSAGE_TYPE_POPUP
                        );
                        break;

                    case $selectPPK == null:
                        // parent::insertCommand("pnbp dk", $mobile);
                        parent::insertCommand("maaf", $mobile);

                        parent::sendMsg(
                            $mobile,
                            "*Nomor Aju yang Anda masukkan tidak terdaftar di database!*\n\n Pastikan nomor Aju yang Anda masukkan telah terdaftar. Jika Anda merasa ini adalah sebuah kesalahan, silahkan masukkan kembali nomor Aju Anda",
                            [],
                        );
                        // parent::endMenu($mobile);


                        break;

                    case str_contains(strtoupper($pesan), $selectPPK->no_aju_ppk):
                        // parent::insertCommand("nomor aju eks", $mobile);
                        parent::sendMsg(
                            $mobile,
                            "Berdasarkan tracking, proses Anda telah sampai pada $sertif->nm_dok",
                            [],
                        );
                        parent::endMenu($mobile);
                        break;
                    default:
                        parent::insertCommand("maaf", $mobile);
                        $this->sendSorryMessage($mobile, $isFirstError);
                }
                break;
            case str_contains($command, "eks_no_sertif"):
                $selectPPK = $this->selectPPK(strtoupper($pesan));
                switch (true) {
                    case str_contains($pesan, "menu sebelumnya"):
                        parent::sendMsg(
                            $mobile,
                            "Pelayanan Sertifikat Ekspor memiliki tiga jenis fitur yang dapat diajukan menggunakan nomor aju PPK, yang manakah kebutuhan Anda?",
                            [
                                parent::getSingleButton("Lacak Status Pengajuan", "TSP", ""),

                                parent::getSingleButton("No Ijin/No Sertifikat", "NoIjin", ""),

                                parent::getSingleButton("Biaya PNBP", "PNBP", ""),

                                parent::getSingleButton("Menu Sebelumnya", "back", ""),

                            ],
                            WebhookConfig::MESSAGE_TYPE_POPUP
                        );
                        break;

                    case $selectPPK == null:
                        // parent::insertCommand("pnbp dk", $mobile);
                        parent::insertCommand("maaf", $mobile);

                        parent::sendMsg(
                            $mobile,
                            "*Nomor Aju yang Anda masukkan tidak terdaftar di database!*\n\n Pastikan nomor Aju yang Anda masukkan telah terdaftar. Jika Anda merasa ini adalah sebuah kesalahan, silahkan masukkan kembali nomor Aju Anda",
                            [],
                        );
                        // parent::endMenu($mobile);


                        break;

                    case str_contains(strtoupper($pesan), $selectPPK->no_aju_ppk):
                        $nomorSertif = $this->getNoIjin(strtoupper($pesan));
                        if ($nomorSertif == false) {
                            // parent::insertCommand("selesai", $mobile);
                            parent::sendMsg(
                                $mobile,
                                "Data yang Anda cari berdasarkan nomor Aju tidak ditemukan. Periksa kembali status pengajuan Anda di menu lacak informasi dan pastikan Anda telah sampai pada proses Single Certificate",
                                [],
                            );
                        } else {
                            // parent::insertCommand("nomor aju eks", $mobile);
                            parent::sendMsg(
                                $mobile,
                                "Berdasarkan nomor Aju Ekspor yang Anda masukkan, berikut adalah nomor sertifikat Anda $nomorSertif->no_sertifikat",
                                [],
                            );
                        }
                        parent::endMenu($mobile);
                        break;
                    default:
                        parent::insertCommand("maaf", $mobile);
                        $this->sendSorryMessage($mobile, $isFirstError);
                }
                break;
            case str_contains($command, "biaya pnbp eks"):
                $selectPPK = $this->selectPPKPNBP(strtoupper($pesan));
                switch (true) {
                    case str_contains($pesan, "menu sebelumnya"):
                        parent::sendMsg(
                            $mobile,
                            "Pelayanan Sertifikat Ekspor memiliki tiga jenis fitur yang dapat diajukan menggunakan nomor aju PPK, yang manakah kebutuhan Anda?",
                            [
                                parent::getSingleButton("Lacak Status Pengajuan", "TSP", ""),

                                parent::getSingleButton("No Ijin/No Sertifikat", "NoIjin", ""),

                                parent::getSingleButton("Biaya PNBP", "PNBP", ""),

                                parent::getSingleButton("Menu Sebelumnya", "back", ""),

                            ],
                            WebhookConfig::MESSAGE_TYPE_POPUP
                        );
                        break;

                    case $selectPPK == null:
                        // parent::insertCommand("pnbp dk", $mobile);
                        parent::insertCommand("maaf", $mobile);

                        parent::sendMsg(
                            $mobile,
                            "*Nomor Aju yang Anda masukkan tidak terdaftar di database!*\n\n Pastikan nomor Aju yang Anda masukkan telah terdaftar. Jika Anda merasa ini adalah sebuah kesalahan, silahkan masukkan kembali nomor Aju Anda",
                            [],
                        );
                        // parent::endMenu($mobile);


                        break;

                    case $selectPPK != null:
                        $kelTarif = $this->selectTarif($selectPPK->no_aju_ppk);
                        $tarifText = "";
                        $total = 0;

                        if ($kelTarif == null) {
                            // parent::insertCommand("selesai", $mobile);
                            parent::insertCommand("maaf", $mobile);
                            parent::sendMsg(
                                $mobile,
                                "Data yang Anda cari berdasarkan nomor Aju tidak ditemukan. Periksa kembali status pengajuan Anda di menu lacak informasi dan pastikan Anda telah sampai pada proses PNBP",
                                [],
                            );
                        } else {
                            foreach ($kelTarif as $tarif) {
                                $kel_tarif = $tarif->kel_tarif;

                                $harga = $tarif->total;
                                $tarifText .=  "$kel_tarif Rp $harga \n";
                                $total += $harga;
                            }
                            // parent::insertCommand("pnbp dk", $mobile);
                            parent::sendMsg(
                                $mobile,
                                "Berdasarkan nomor Aju Ekspor yang Anda masukkan, berikut adalah pnbp Anda \n$tarifText \n total: Rp $total",
                                [],
                            );
                            parent::endMenu($mobile);
                        }
                        break;
                }
                break;


            case str_contains($command, "impor"):
                switch (true) {
                    case str_contains($pesan, "menu sebelumnya"):
                        parent::sendMsg(
                            $mobile,
                            "Berikut adalah layanan sertifikasi yang kami sediakan, silahkan pilih sesuai kebutuhan Anda\n",
                            [
                                parent::getSingleButtonReply("reply", "Ekspor", "Ekspor"),

                                parent::getSingleButtonReply("reply", "Impor", "Impor",),

                                parent::getSingleButtonReply("reply", "kembali", "Menu Sebelumnya"),

                            ],
                            WebhookConfig::MESSAGE_TYPE_BUTTON
                        );
                        break;
                    case str_contains($pesan, "lacak status pengajuan"):
                        parent::insertCommand("imp_aju_lacak", $mobile);
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
                        parent::insertCommand("imp_no_sertif", $mobile);
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
                        parent::insertCommand("biaya pnbp imp", $mobile);
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
                        $this->sendSorryMessage($mobile, $isFirstError);
                }
                break;
            case str_contains($command, "imp_aju_lacak"):
                $selectPPK = $this->selectPPKImpor(strtoupper($pesan));
                $sertif = $this->lacakImpor(strtoupper($pesan));
                switch (true) {
                    case str_contains($pesan, "menu sebelumnya"):
                        parent::sendMsg(
                            $mobile,
                            "Pelayanan Sertifikat Impor memiliki tiga jenis fitur yang dapat diajukan menggunakan nomor aju PPK, yang manakah kebutuhan Anda? ",
                            [
                                parent::getSingleButton("Lacak Status Pengajuan", "TSP", ""),

                                parent::getSingleButton("No Ijin/No Sertifikat", "NoIjin", ""),

                                parent::getSingleButton("Biaya PNBP", "PNBP", ""),

                                parent::getSingleButton("Menu Sebelumnya", "back", ""),

                            ],
                            WebhookConfig::MESSAGE_TYPE_POPUP
                        );
                        break;

                    case $selectPPK == null:
                        // parent::insertCommand("nomor aju imp", $mobile);
                        parent::insertCommand("maaf", $mobile);

                        parent::sendMsg(
                            $mobile,
                            "*Nomor Aju yang Anda masukkan tidak terdaftar di database!*\n\n Pastikan nomor Aju yang Anda masukkan telah terdaftar. Jika Anda merasa ini adalah sebuah kesalahan, silahkan masukkan kembali nomor Aju Anda",
                            [],
                        );
                        // parent::endMenu($mobile);

                        break;

                    case str_contains(strtoupper($pesan), $selectPPK->no_aju_ppk):
                        // parent::insertCommand("nomor aju imp", $mobile);
                        parent::sendMsg(
                            $mobile,
                            "Berdasarkan tracking, proses Anda telah sampai pada $sertif->nm_dok",
                            [],
                        );
                        parent::endMenu($mobile);
                        break;
                    default:
                        parent::insertCommand("maaf", $mobile);
                        $this->sendSorryMessage($mobile, $isFirstError);
                }
                break;
            case str_contains($command, "imp_no_sertif"):
                $selectPPK = $this->selectPPK(strtoupper($pesan));
                switch (true) {
                    case str_contains($pesan, "menu sebelumnya"):
                        parent::sendMsg(
                            $mobile,
                            "Pelayanan Sertifikat Impor memiliki tiga jenis fitur yang dapat diajukan menggunakan nomor aju PPK, yang manakah kebutuhan Anda?",
                            [
                                parent::getSingleButton("Lacak Status Pengajuan", "TSP", ""),

                                parent::getSingleButton("No Ijin/No Sertifikat", "NoIjin", ""),

                                parent::getSingleButton("Biaya PNBP", "PNBP", ""),

                                parent::getSingleButton("Menu Sebelumnya", "back", ""),

                            ],
                            WebhookConfig::MESSAGE_TYPE_POPUP
                        );
                        break;

                    case $selectPPK == null:
                        // parent::insertCommand("nomor aju imp", $mobile);
                        parent::insertCommand("maaf", $mobile);

                        parent::sendMsg(
                            $mobile,
                            "*Nomor Aju yang Anda masukkan tidak terdaftar di database!*\n\n Pastikan nomor Aju yang Anda masukkan telah terdaftar. Jika Anda merasa ini adalah sebuah kesalahan, silahkan masukkan kembali nomor Aju Anda",
                            [],
                        );
                        // parent::endMenu($mobile);

                        break;

                    case str_contains(strtoupper($pesan), $selectPPK->no_aju_ppk):
                        $nomorSertif = $this->getNoIjin(strtoupper($pesan));
                        if ($nomorSertif == false) {
                            // parent::insertCommand("selesai", $mobile);
                            parent::sendMsg(
                                $mobile,
                                "Data yang Anda cari berdasarkan nomor Aju tidak ditemukan. Periksa kembali status pengajuan Anda di menu lacak informasi dan pastikan Anda telah sampai pada proses Single Certificate",
                                [],
                            );
                        } else {
                            // parent::insertCommand("nomor aju imp", $mobile);
                            parent::sendMsg(
                                $mobile,
                                "Berdasarkan nomor Aju Ekspor yang Anda masukkan, berikut adalah nomor sertifikat Anda $nomorSertif->no_sertifikat",
                                [],
                            );
                        }
                        parent::endMenu($mobile);
                        break;

                    default:
                        parent::insertCommand("maaf", $mobile);
                        $this->sendSorryMessage($mobile, $isFirstError);
                }
                break;

            case str_contains($command, "biaya pnbp imp"):
                $selectPPK = $this->selectPPKPNBP(strtoupper($pesan));
                switch (true) {
                    case str_contains($pesan, "menu sebelumnya"):
                        parent::sendMsg(
                            $mobile,
                            "Pelayanan Sertifikat Impor memiliki tiga jenis fitur yang dapat diajukan menggunakan nomor aju PPK, yang manakah kebutuhan Anda?",
                            [
                                parent::getSingleButton("Lacak Status Pengajuan", "TSP", ""),

                                parent::getSingleButton("No Ijin/No Sertifikat", "NoIjin", ""),

                                parent::getSingleButton("Biaya PNBP", "PNBP", ""),

                                parent::getSingleButton("Menu Sebelumnya", "back", ""),

                            ],
                            WebhookConfig::MESSAGE_TYPE_POPUP
                        );
                        break;

                    case $selectPPK == null:
                        // parent::insertCommand("pnbp imp", $mobile);
                        parent::insertCommand("maaf", $mobile);

                        parent::sendMsg(
                            $mobile,
                            "*Nomor Aju yang Anda masukkan tidak terdaftar di database!*\n\n Pastikan nomor Aju yang Anda masukkan telah terdaftar. Jika Anda merasa ini adalah sebuah kesalahan, silahkan masukkan kembali nomor Aju Anda",
                            [],
                        );
                        // parent::endMenu($mobile);

                        break;

                    case $selectPPK != null:
                        $kelTarif = $this->selectTarif($selectPPK->no_aju_ppk);
                        $tarifText = "";
                        $total = 0;

                        if ($kelTarif == null) {
                            // parent::insertCommand("selesai", $mobile);
                            parent::insertCommand("maaf", $mobile);
                            parent::sendMsg(
                                $mobile,
                                "Data yang Anda cari berdasarkan nomor Aju tidak ditemukan. Periksa kembali status pengajuan Anda di menu lacak informasi dan pastikan Anda telah sampai pada proses PNBP",
                                [],
                            );
                        } else {
                            foreach ($kelTarif as $tarif) {
                                $kel_tarif = $tarif->kel_tarif;

                                $harga = $tarif->total;
                                $tarifText .=  "$kel_tarif Rp $harga \n";
                                $total += $harga;
                            }
                            // parent::insertCommand("pnbp dk", $mobile);
                            parent::sendMsg(
                                $mobile,
                                "Berdasarkan nomor Aju Impor yang Anda masukkan, berikut adalah pnbp Anda \n$tarifText \n total: Rp $total",
                                [],
                            );
                            parent::endMenu($mobile);
                        }
                        break;
                }
                break;
        }
    }
}