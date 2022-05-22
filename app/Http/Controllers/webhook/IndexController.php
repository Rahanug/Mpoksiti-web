<?php

namespace App\Http\Controllers\webhook;

use Illuminate\Http\Request;

use App\Models\CommandModel;

use App\Models\chatbotAdminModel;

use App\Http\Controllers\webhook\HandlerCommandInterface;

use App\Http\Controllers\webhook\AbstractWebhookController;

use App\Http\Controllers\webhook\LacakInfoSertifikasiDomestikController;

use App\Http\Controllers\webhook\LacakInfoSertifikasiNonDomestikController;

use App\Http\Controllers\webhook\LayananKesehatanIkanController;

use App\Http\Controllers\webhook\SeputarKesehatanIkanController;

use App\Http\Controllers\webhook\WebhookConfig;



class IndexController extends AbstractWebhookController
{

    public function __construct()
    {
        $this->seputarKesehatanIkanController = new SeputarKesehatanIkanController();
        $this->layananKesehatanIkanController = new LayananKesehatanIkanController();
        $this->lacakInfoDomestikController = new LacakInfoSertifikasiDomestikController();
        $this->lacakInfoNonDomestikController = new LacakInfoSertifikasiNonDomestikController();
    }

    private function invalidateUserSession($from)
    {
        $affectedRows = CommandModel::where('no_wa', $from)
            ->whereRaw('DATEDIFF(MINUTE, created_at, GETDATE()) > 14')
            ->delete();

        if ($affectedRows > 0) {
            parent::sendMsg(
                $this->from,
                "*Anda dapat mengabaikan pesan ini*\n\nDengan adanya pesan ini, dinyatakan sesi terakhir Anda telah habis. Siklus Anda akan diulang dari pesan pertama.",
                [],

            );
        }
    }

    private function clearNowUserSession($from)
    {

        CommandModel::where('no_wa', $from)
            ->delete();

        parent::sendMsg(
            $this->from,
            "*Anda dapat mengabaikan pesan ini*\n\nDengan adanya pesan ini, dinyatakan sesi terakhir Anda telah habis. Siklus Anda akan diulang dari pesan pertama.",
            [],

        );
    }

    private function readMessage($event)
    {
        if (isset($event['messages'][0]['text'])) {
            $msg = $event['messages'][0]['text']['body'];
        } elseif (isset($event['messages'][0]['interactive']['list_reply'])) {
            $msg = $event['messages'][0]['interactive']['list_reply']['title'];
        } elseif (isset($event['messages'][0]['interactive']['button_reply'])) {
            $msg = $event['messages'][0]['interactive']['button_reply']['title'];
        } else {
            $msg = "";
        }
        return $msg;
    }


    private function dispatchHandler(HandlerCommandInterface $handler, $command, $pesan, $isFirstError)
    {
        $handler->handleMessage($this->from, $command, $pesan, $isFirstError);
    }

    private function selectAdmin()
    {
        return chatbotAdminModel::get('no_wa');
    }

    private function broadcastMsgAdmin($admin, $mobile)
    {
        foreach ($admin as $a) {
            parent::sendMsg(
                $a->no_wa,
                "Kepada Admin, dibutuhkan pelayanan pelanggan di nomor $mobile berikan tanggapan sesuai dengan SOP yang berlaku. Terimakasih.\n",
                [],
            );
        }
    }

    private function selectLastTwo($from)
    {
        return CommandModel::select('command')
            ->where('no_wa', $from)
            ->orderByDesc('created_at')
            ->take(2)
            ->get();
    }


    public function index(Request $request)
    {
        $event = json_decode($request->getContent(), true);
        if (isset($event)) {
            //Here, you now have event and can process them how you like e.g Add to the database or generate a response
            $file = 'log.txt';

            $data = json_encode($event) . "\n";

            $this->from = $event['contacts'][0]['wa_id'];

            $pesan = $this->readMessage($event);

            $pesan = strtolower($pesan);

            $this->invalidateUserSession($this->from);

            $stackCommand = $this->selectLastTwo($this->from);

            $isFirstError = false;
            if (count($stackCommand) > 1) {
                $top = $stackCommand[0];
                $bottom = $stackCommand[1];
                // [$top, $bottom] = $stackCommand;

                if (str_contains($top->command, "maaf") && str_contains($bottom->command, "maaf")) {
                    $isFirstError = true;

                    $lastRow = $bottom;
                } elseif (str_contains($top->command, "maaf")) {
                    $isFirstError = true;

                    $lastRow = $bottom;
                } else {
                    $lastRow = $top;
                }
            } else {
                $lastRow = $stackCommand[0] ?? null;
            }


            // IF kembali then deleteLastRow
            if (str_contains($pesan, "menu sebelumnya") !== false) {
                $this->deleteCommand($this->from);
            }

            if (!isset($lastRow)) {
                parent::insertCommand('halo', $this->from);
                parent::sendMsg(
                    $this->from,
                    "Selamat Datang di layanan Halo Mpok Siti, Media Pelayanan Online Karantina Simpel dan Terintegrasi, apa yang ingin Anda ketahui?",
                    [
                        parent::getSingleButton("Seputar Kesehatan Ikan", "IPKI", ""),

                        parent::getSingleButton("Layanan Sertifikasi Mutu", "PSPM", ""),

                        parent::getSingleButton("Lacak Info Sertifikasi", "TILS", ""),

                        parent::getSingleButton("Hubungi Customer Service", "CS", ""),

                    ],
                    WebhookConfig::MESSAGE_TYPE_POPUP
                );

                //tampil menu utama
            } else {
                switch (true) {
                    case str_contains($lastRow->command, 'halo'):
                        switch (true) {
                            case str_contains($pesan, "seputar kesehatan ikan"):
                                parent::insertCommand($pesan, $this->from);
                                parent::sendMsg(
                                    $this->from,
                                    "Selamat datang di menu sertifikasi kesehatan Ikan!\n\nPada menu ini akan dijelaskan terkait dengan informasi serta persyaratan apa saja yang perlu dipersiapkan untuk melakukan sertifikasi kesehatan perikanan. Disini kami menyediakan tiga jenis sertifikasi:\n\n1.Ekspor\n2.Impor\n3.Domestik\n\nDari pilihan diatas, yang mana yang ingin Anda ketahui?",
                                    [
                                        parent::getSingleButton("Ekspor", "Ekspor", ""),

                                        parent::getSingleButton("Impor", "Impor", ""),

                                        parent::getSingleButton("Domestik", "Domestik", ""),

                                        parent::getSingleButton("Menu Utama", "Ulang", ""),

                                    ],
                                    WebhookConfig::MESSAGE_TYPE_POPUP
                                );
                                break;

                            case str_contains($pesan, "layanan sertifikasi mutu"):
                                parent::insertCommand($pesan, $this->from);
                                parent::sendMsg(
                                    $this->from,
                                    "Selamat datang di menu sertifikasi mutu!\n\nPada menu ini akan dijelaskan terkait dengan informasi serta persyaratan apa saja yang perlu dipersiapkan untuk melakukan sertifikasi mutu. Disini kami menyediakan tiga jenis sertifikasi:\n\n1.Sertifikasi Penerapan HACCP\n2.Negara Mitra\n3.Surveilance\n\nDari pilihan diatas, yang mana yang ingin Anda ketahui?",
                                    [
                                        parent::getSingleButton("Sertifikasi HACCP", "HACCP", ""),

                                        parent::getSingleButton("Negara Mitra", "Mitra", ""),

                                        parent::getSingleButton("Surveilance", "Surveilance", ""),

                                        parent::getSingleButton("Menu Utama", "Domestik", ""),

                                    ],
                                    WebhookConfig::MESSAGE_TYPE_POPUP
                                );
                                break;

                            case str_contains($pesan, "lacak info sertifikasi"):
                                parent::insertCommand($pesan, $this->from);
                                parent::sendMsg(
                                    $this->from,
                                    "Terdapat dua jenis layanan Sertifikasi, pilih sesuai dengan kebutuhan Anda\n",
                                    [
                                        parent::getSingleButtonReply("reply", "SEI", "Sertif Ekspor Impor"),

                                        parent::getSingleButtonReply("reply", "SDomestik", "Sertifikat Domestik",),

                                        parent::getSingleButtonReply("reply", "kembali", "Menu Sebelumnya"),

                                    ],
                                    WebhookConfig::MESSAGE_TYPE_BUTTON
                                );
                                break;
                            case str_contains($pesan, "hubungi customer service"):

                                $cs = $this->selectAdmin();
                                // echo json_encode($cs);

                                parent::insertCommand("selesai", $this->from);
                                parent::sendMsg(
                                    $this->from,
                                    "Anda akan dihubungkan ke layanan customer support kami, mohon tunggu hingga pesan selanjutnya. Terimakasih telah menggunakan layanan chatbot mpok Siti\n",
                                    [],

                                );
                                $this->broadcastMsgAdmin($cs, $this->from);
                                $this->clearNowUserSession($this->from);
                                break;

                            case str_contains($pesan, "batal"):
                            case str_contains($pesan, "selesai"):
                                parent::insertCommand("selesai", $this->from);
                                parent::sendMsg(
                                    $this->from,
                                    "Layanan dibatalkan. Terimakasih telah menggunakan layanan chatbot Mpok Siti\n",
                                    [],

                                );
                                break;
                            default:
                                parent::insertCommand("maaf", $this->from);
                                parent::sendSorryMessage($this->from, $isFirstError);
                        }
                        break;

                        // Menu Seputar Kesehatan Ikan
                    case str_contains($lastRow->command, "seputar kesehatan ikan"):
                    case str_contains($lastRow->command, "sk_ikan_ekspor"):
                    case str_contains($lastRow->command, "sk_ikan_impor"):
                    case str_contains($lastRow->command, "sk_ikan_domestik"):
                        $this->dispatchHandler(
                            $this->seputarKesehatanIkanController,
                            $lastRow->command,
                            $pesan,
                            $isFirstError
                        );
                        break;

                        // Menu Layanan Sertifikasi Mutu
                    case str_contains($lastRow->command, "layanan sertifikasi mutu"):
                    case str_contains($lastRow->command, "sertif_haccp"):
                    case str_contains($lastRow->command, "negara mitra"):
                    case str_contains($lastRow->command, "surveilance"):
                        $this->dispatchHandler(
                            $this->layananKesehatanIkanController,
                            $lastRow->command,
                            $pesan,
                            $isFirstError
                        );
                        break;

                        // Menu Lacak Info Sertifikasi 
                    case str_contains($lastRow->command, "lacak info sertifikasi"):
                        switch (true) {
                            case str_contains($pesan, "sertif ekspor impor"):
                                parent::insertCommand($pesan, $this->from);
                                parent::sendMsg(
                                    $this->from,
                                    "Berikut adalah layanan sertifikasi yang kami sediakan, silahkan pilih sesuai kebutuhan Anda\n",
                                    [
                                        parent::getSingleButtonReply("reply", "Ekspor", "Ekspor"),

                                        parent::getSingleButtonReply("reply", "Impor", "Impor",),

                                        parent::getSingleButtonReply("reply", "kembali", "Menu Sebelumnya"),

                                    ],
                                    WebhookConfig::MESSAGE_TYPE_BUTTON
                                );
                                break;

                            case str_contains($pesan, "sertifikat domestik"):
                                parent::insertCommand($pesan, $this->from);
                                parent::sendMsg(
                                    $this->from,
                                    "Berikut adalah layanan sertifikasi yang kami sediakan, silahkan pilih sesuai kebutuhan Anda\n",
                                    [
                                        parent::getSingleButtonReply("reply", "DK", "Domestik Keluar"),

                                        parent::getSingleButtonReply("reply", "DM", "Domestik Masuk",),

                                        parent::getSingleButtonReply("reply", "kembali", "Menu Sebelumnya"),

                                    ],
                                    WebhookConfig::MESSAGE_TYPE_BUTTON
                                );
                                break;

                            case str_contains($pesan, "menu sebelumnya"):
                                parent::sendMsg(
                                    $this->from,
                                    "Selamat Datang di layanan Halo Mpok Siti, Media Pelayanan Online Karantina Simpel dan Terintegrasi, apa yang ingin Anda ketahui?",
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
                                parent::insertCommand("maaf", $this->from);
                                parent::sendSorryMessage($this->from, $isFirstError);
                        }
                        break;



                        //Non Domestik
                    case str_contains($lastRow->command, "sertif ekspor impor"):
                    case str_contains($lastRow->command, "ekspor"):
                    case str_contains($lastRow->command, "eks_aju_lacak"):
                    case str_contains($lastRow->command, "nomor aju eks"):
                    case str_contains($lastRow->command, "eks_no_sertif"):
                    case str_contains($lastRow->command, "biaya pnbp eks"):
                    case str_contains($lastRow->command, "pnbp eks"):


                    case str_contains($lastRow->command, "impor"):
                    case str_contains($lastRow->command, "imp_aju_lacak"):
                    case str_contains($lastRow->command, "nomor aju imp"):
                    case str_contains($lastRow->command, "imp_no_sertif"):
                    case str_contains($lastRow->command, "biaya pnbp imp"):
                    case str_contains($lastRow->command, "pnbp imp"):
                        $this->dispatchHandler(
                            $this->lacakInfoNonDomestikController,
                            $lastRow->command,
                            $pesan,
                            $isFirstError
                        );
                        break;

                        // DOMESTIK
                    case str_contains($lastRow->command, "sertifikat domestik"):
                    case str_contains($lastRow->command, "domestik keluar"):
                    case str_contains($lastRow->command, "dk_aju_lacak"):
                    case str_contains($lastRow->command, "nomor aju dk"):
                    case str_contains($lastRow->command, "dk_no_sertif"):
                    case str_contains($lastRow->command, "biaya pnbp dk"):
                    case str_contains($lastRow->command, "pnbp dk"):


                    case str_contains($lastRow->command, "domestik masuk"):
                    case str_contains($lastRow->command, "dm_aju_lacak"):
                    case str_contains($lastRow->command, "nomor aju dm"):
                    case str_contains($lastRow->command, "dm_no_sertif"):
                    case str_contains($lastRow->command, "biaya pnbp dm"):
                    case str_contains($lastRow->command, "pnbp dm"):
                        $this->dispatchHandler(
                            $this->lacakInfoDomestikController,
                            $lastRow->command,
                            $pesan,
                            $isFirstError
                        );
                        break;
                    case str_contains($lastRow->command, "dialog end"):
                        switch (true) {
                            case str_contains($pesan, "selesai"):
                                parent::sendMsg(
                                    $this->from,
                                    "Terima kasih telah menggunakan layanan chatbot Mpok Siti",
                                    [],
                                );

                                $this->clearNowUserSession($this->from);

                                break;

                            case str_contains($pesan, "menu utama"):
                                parent::insertCommand("halo", $this->from);
                                parent::sendMsg(
                                    $this->from,
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
                        }
                        break;

                    default:
                        switch (true) {
                            case str_contains($pesan, "menu utama"):
                                parent::insertCommand("halo", $this->from);
                                parent::sendMsg(
                                    $this->from,
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
                            case str_contains($pesan, "hubungi cs"):
                                $cs = $this->selectAdmin();
                                // echo json_encode($cs);

                                parent::insertCommand("selesai", $this->from);
                                parent::sendMsg(
                                    $this->from,
                                    "Anda akan dihubungkan ke layanan customer support kami, mohon tunggu hingga pesan selanjutnya. Terimakasih telah menggunakan layanan chatbot mpok Siti\n",
                                    [],

                                );
                                $this->broadcastMsgAdmin($cs, $this->from);
                                $this->clearNowUserSession($this->from);
                                break;
                            default:
                                parent::insertCommand("maaf", $this->from);
                                parent::sendSorryMessage($this->from, $isFirstError);
                        }

                        break;
                }
            }
        }
        file_put_contents($file, $data, FILE_APPEND | LOCK_EX);
        exit;
    }
}