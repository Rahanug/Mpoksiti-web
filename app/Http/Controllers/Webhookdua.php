<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

use App\Models\CommandModel;
use App\Models\PPKSModel;
use App\Models\FlowguideModel;
use App\Models\RPTHarianModel;
use App\Models\RPTPNBPHarianModel;
use App\Models\chatbotAdminModel;
use Illuminate\Http\Request;

define("temp1", [
    [
        "title" => "Seputar Kesehatan Ikan",
        "rows" => [
            [
                "id" => "IPKI",
                "title" => "Seputar Kesehatan Ikan",
                "description" => ""
            ]
        ]
    ],
    [
        "title" => "Layanan Sertifikasi Mutu",
        "rows" => [
            [
                "id" => "PSPM",
                "title" => "Layanan Sertifikasi Mutu",
                "description" => ""
            ]
        ]
    ],
    [
        "title" => "Lacak Info Sertifikasi",
        "rows" => [
            [
                "id" => "TILS",
                "title" => "Lacak Info Sertifikasi",
                "description" => ""
            ]
        ]
    ],
    [
        "title" => "Hubungi Customer Service",
        "rows" => [
            [
                "id" => "CS",
                "title" => "Hubungi Customer Service",
                "description" => ""
            ]
        ]
    ],
]);

define("temp2", [
    [
        "type" => "reply",
        "reply" => [
            "id" => "SEI",
            "title" => "Sertif Ekspor Impor"
        ]
    ],
    [
        "type" => "reply",
        "reply" => [
            "id" => "SDomestik",
            "title" => "Sertifikat Domestik"
        ]
    ],
    [
        "type" => "reply",
        "reply" => [
            "id" => "kembali",
            "title" => "Menu Sebelumnya"
        ]
    ]
]);

define("temp3", [
    [
        "type" => "reply",
        "reply" => [
            "id" => "Ekspor",
            "title" => "Ekspor"
        ]
    ],
    [
        "type" => "reply",
        "reply" => [
            "id" => "Impor",
            "title" => "Impor"
        ]
    ],
    [
        "type" => "reply",
        "reply" => [
            "id" => "kembali",
            "title" => "Menu Sebelumnya"
        ]
    ]
]);

define("temp4", [
    [
        "title" => "Lacak Status Pengajuan",
        "rows" => [
            [
                "id" => "TSP",
                "title" => "Lacak Status Pengajuan",
                "description" => ""
            ]
        ]
    ],
    [
        "title" => "No Ijin/No Sertifikat",
        "rows" => [
            [
                "id" => "NoIjin",
                "title" => "No Ijin/No Sertifikat",
                "description" => ""
            ]
        ]
    ],
    [
        "title" => "Biaya PNBP",
        "rows" => [
            [
                "id" => "PNBP",
                "title" => "Biaya PNBP",
                "description" => ""
            ]
        ]
    ],
    [
        "title" => "Menu Sebelumnya",
        "rows" => [
            [
                "id" => "back",
                "title" => "Menu Sebelumnya",
                "description" => ""
            ]
        ]
    ]
]);

define("temp5", [
    [
        "type" => "reply",
        "reply" => [
            "id" => "DK",
            "title" => "Domestik Keluar"
        ]
    ],
    [
        "type" => "reply",
        "reply" => [
            "id" => "DM",
            "title" => "Domestik Masuk"
        ]
    ],
    [
        "type" => "reply",
        "reply" => [
            "id" => "kembali",
            "title" => "Menu Sebelumnya"
        ]
    ]
]);

define("temp6", [
    [
        "type" => "reply",
        "reply" => [
            "id" => "Ulang",
            "title" => "Menu utama"
        ]
    ],
    [
        "type" => "reply",
        "reply" => [
            "id" => "Selesai",
            "title" => "Selesai"
        ]
    ]
]);

define("temp7", [
    [
        "type" => "reply",
        "reply" => [
            "id" => "kembali",
            "title" => "Menu Sebelumnya"
        ]
    ]
]);

define("temp8", [
    [
        "title" => "Ekspor",
        "rows" => [
            [
                "id" => "Ekspor",
                "title" => "Ekspor",
                "description" => ""
            ]
        ]
    ],
    [
        "title" => "Impor",
        "rows" => [
            [
                "id" => "Impor",
                "title" => "Impor",
                "description" => ""
            ]
        ]
    ],
    [
        "title" => "Domestik",
        "rows" => [
            [
                "id" => "Domestik",
                "title" => "Domestik",
                "description" => ""
            ]
        ]
    ],
    [
        "title" => "Menu Utama",
        "rows" => [
            [
                "id" => "Ulang",
                "title" => "Menu Utama",
                "description" => ""
            ]
        ]
    ],
]);

define("temp9", [
    [
        "title" => "Sertifikasi HACCP",
        "rows" => [
            [
                "id" => "HACCP",
                "title" => "Sertifikasi HACCP",
                "description" => ""
            ]
        ]
    ],
    [
        "title" => "Negara Mitra",
        "rows" => [
            [
                "id" => "Mitra",
                "title" => "Negara Mitra",
                "description" => ""
            ]
        ]
    ],
    [
        "title" => "Surveilance",
        "rows" => [
            [
                "id" => "Surveilance",
                "title" => "Surveilance",
                "description" => ""
            ]
        ]
    ],
    [
        "title" => "Menu Utama",
        "rows" => [
            [
                "id" => "Ulang",
                "title" => "Menu Utama",
                "description" => ""
            ]
        ]
    ],
]);

define("temp10", [
    [
        "type" => "reply",
        "reply" => [
            "id" => "Ulang",
            "title" => "Menu utama"
        ]
    ],
    [
        "type" => "reply",
        "reply" => [
            "id" => "CS",
            "title" => "Hubungi CS"
        ]
    ],
    // [
    //     "type" => "reply",
    //     "reply" => [
    //         "id" => "CL",
    //         "title" => "Coba lagi"
    //     ]
    // ]
]);

class Webhookdua extends Controller
{
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

    private function send_msg($mobile, $msg)
    {

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://multichannel.qiscus.com/whatsapp/v1/teslu-h7a83pux7kepxqs/2167/messages',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => '{
                "recipient_type": "individual",
                "to": "' . $mobile . '",
                "type": "text",
                "text": {
                "body": "' . $msg . '"
                }
            }',
            CURLOPT_HTTPHEADER => array(
                'Qiscus-App-Id: teslu-h7a83pux7kepxqs',
                'Qiscus-Secret-Key: fc79da7fa276099ec0cc54bd3e46e69a',
                'content-type: application/json'
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        echo $response;
    }

    /// TEMPLATE 2 BUTTON
    private function send_msg2($mobile, $msg, $arr)
    {
        $curl = curl_init();

        $arr = json_encode($arr);


        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://multichannel.qiscus.com/whatsapp/v1/teslu-h7a83pux7kepxqs/2167/messages',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => '{
                "recipient_type": "individual",
                "to": "' . $mobile . '",
                "type": "interactive",
                "interactive":{
                    "type": "button",
                    "header": {
                    "type": "text",
                    "text": "Layanan MPOK SITI"
                    },
                    "body": {
                    "text": "' . $msg . '"
                    },
                    "footer": {
                    "text": "Pilih sesuai dengan kebutuhan Anda"
                    },
                    "action": {
                    "buttons": ' . $arr . '
                    }
            }
            }',
            CURLOPT_HTTPHEADER => array(
                'Qiscus-App-Id: teslu-h7a83pux7kepxqs',
                'Qiscus-Secret-Key: fc79da7fa276099ec0cc54bd3e46e69a',
                'content-type: application/json'
            ),
        ));

        $response = curl_exec($curl);



        curl_close($curl);
        echo $response;
    }

    // TEMPLATE 3 BUTTON
    private function send_msg3($mobile, $msg, $arr)
    {
        $curl = curl_init();

        $arr = json_encode($arr);

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://multichannel.qiscus.com/whatsapp/v1/teslu-h7a83pux7kepxqs/2167/messages',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => '{
                "recipient_type": "individual",
                "to": "' . $mobile . '",
                "type": "interactive",
                "interactive":{
                    "type": "list",
                    "header": {
                    "type": "text",
                    "text": "Layanan Mpok Siti"
                    },
                    "body": {
                    "text": "' . $msg . '"
                    },
                    "footer": {
                    "text": "Pilih sesuai kebutuhan Anda"
                    },
                    "action": {
                    "button": "Pilih Menu",
                    "sections":' . $arr . '
                    }
            }
            }',
            CURLOPT_HTTPHEADER => array(
                'Qiscus-App-Id: teslu-h7a83pux7kepxqs',
                'Qiscus-Secret-Key: fc79da7fa276099ec0cc54bd3e46e69a',
                'content-type: application/json'
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        echo $response;
    }

    private function send_msg_cs($admin, $mobile)
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://multichannel.qiscus.com/whatsapp/v1/teslu-h7a83pux7kepxqs/2167/messages',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => '{
                "recipient_type": "individual",
                "to": "' . $admin . '",
                "type": "text",
                "text": {
                "body": "Kepada Admin, dibutuhkan pelayanan pelanggan di nomor ' . $mobile . ', berikan tanggapan sesuai dengan SOP yang berlaku. Terimakasih."
                }
            }',
            CURLOPT_HTTPHEADER => array(
                'Qiscus-App-Id: teslu-h7a83pux7kepxqs',
                'Qiscus-Secret-Key: fc79da7fa276099ec0cc54bd3e46e69a',
                'content-type: application/json'
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        echo $response;
    }

    public function selectAdmin()
    {
        return chatbotAdminModel::get('no_wa');
    }

    private function send_msg_admin($admin, $mobile)
    {
        foreach ($admin as $a) {
            $this->send_msg_cs($a->no_wa, $mobile);
            //  echo $response;
            //  Harus punya session agar dapat berjalan
        }
    }

    public function insertCommand($pesan, $from)
    {
        $command = new  CommandModel();
        $command->command = $pesan;
        $command->no_wa = $from;
        $command->save();
    }

    public function deleteCommand($from)
    {
        CommandModel::where('no_wa', $from)
            ->where('command', '!=', 'selesai')
            ->where('command', '!=', 'halo')
            ->orderByDesc('created_at')
            ->first()
            ->delete();
    }

    public function deletePesan($from)
    {
        CommandModel::where('no_wa', $from)
            ->where('command', '!=', 'selesai')
            ->where('command', '!=', 'halo')
            ->orderByDesc('created_at')
            ->first()
            ->delete();
    }

    public function selectPPK($pesan)
    {
        // return FlowguideModel::select('no_aju_ppk')
        return DB::connection('sqlsrv2')
            ->table('v_for_flowguide')
            ->select('no_aju_ppk')
            ->where('no_aju_ppk', $pesan)
            ->first();
    }

    // Baru
    public function selectIDPPK($no_aju, $idUrut)
    {
        // return FlowguideModel::select('id_ppk')
        return DB::connection('sqlsrv2')
            ->table('v_for_flowguide')
            ->select('id_ppk')
            ->where('no_aju_ppk', $no_aju)
            ->where('id_urut', $idUrut)
            ->first();
    }

    //============== No Sertifikat ========================

    public function selectNoSertif($pesan)
    {
        // return RPTHarianModel::select('no_sertifikat')
        return DB::connection('sqlsrv2')
            ->table('v_rpt_ops_harian')
            ->select('no_sertifikat')
            ->where('id_ppk', $pesan)
            ->first();
    }

    public function getNoIjin($no_aju)
    {
        // $idUrut = FlowguideModel::select('id_urut')
        $idUrut = DB::connection('sqlsrv2')
            ->table('v_for_flowguide')
            ->select('id_urut')
            ->where('nm_dok', 'Single Certificate')
            ->where('no_aju_ppk', $no_aju)
            ->first();


        $IDPPK = $this->selectIDPPK($no_aju, $idUrut->id_urut);
        if (isset($IDPPK->id_ppk)) {
            return $this->selectNoSertif($IDPPK->id_ppk);
        } else {
            return false;
        }
    }

    //============== PPK EKspor ========================

    public function selectPPKEkspor($pesan)
    {
        // return FlowguideModel::select('no_aju_ppk')
        return DB::connection('sqlsrv2')
            ->table('v_for_flowguide')
            ->select('no_aju_ppk')
            ->where('no_aju_ppk', $pesan)
            ->where('kd_kegiatan', 'E')
            ->first();
    }

    public function selectPPKImpor($pesan)
    {
        // return FlowguideModel::select('no_aju_ppk')
        return DB::connection('sqlsrv2')
            ->table('v_for_flowguide')
            ->select('no_aju_ppk')
            ->where('no_aju_ppk', $pesan)
            ->where('kd_kegiatan', 'I')
            ->first();
    }

    public function lacakEkspor($pesan)
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

    public function lacakImpor($pesan)
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

    // ============== Domestik ==================
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

    // =============================================

    public function sertifPPK($pesan)
    {
        // return FlowguideModel::select('nm_dok')
        return DB::connection('sqlsrv2')
            ->table('v_for_flowguide')
            ->select('nm_dok')
            ->where('no_aju_ppk', $pesan)
            ->orderByDesc('id_urut')
            ->first();
    }

    // =============================================

    public function selectIDPPKPNBP($no_aju)
    {
        // return RPTPNBPHarianModel::select('id_ppk')
        return DB::connection('sqlsrv2')
            ->table('v_rpt_pnbp_harian')
            ->select('id_ppk')
            ->where('no_aju_ppk', $no_aju)
            ->first();
    }

    public function selectTarif($no_aju)
    {
        $idPPK = $this->selectIDPPKPNBP($no_aju);
        // return RPTPNBPHarianModel::select('kel_tarif', 'total')
        return DB::connection('sqlsrv2')
            ->table('v_rpt_pnbp_harian')
            ->select('kel_tarif', 'total')
            ->where('id_ppk', $idPPK->id_ppk)
            ->get();
    }

    public function selectPPKPNBP($pesan)
    {
        // return RPTPNBPHarianModel::select('no_aju_ppk')
        return DB::connection('sqlsrv2')
            ->table('v_rpt_pnbp_harian')
            ->select('no_aju_ppk')
            ->where('no_aju_ppk', $pesan)
            ->first();
    }

    public function selectLastTwo($from)
    {
        return CommandModel::select('command')
            ->where('no_wa', $from)
            ->orderByDesc('created_at')
            ->take(2)
            ->get();
    }


    // public function countMaaf($from)
    // {
    //     return CommandModel::where('no_wa', $from)
    //         ->where('command', 'maaf')
    //         // ->first();
    //         ->count();
    //     // ->orderByDesc('created_at')
    // }

    // public function send_msg_maaf($from)
    // {
    //     $maaf = $this->countMaaf($from);
    //     // echo json_encode($maaf);

    //     if ($maaf >= 2) {
    //         $this->send_msg2($from, "*Halo disana!*\\n Bagaimana pengalamanmu menggunakan layanan Halo Mpok Siti?\\n\\nAnda telah mengalami error sebanyak 2 kali atau lebih, kami mohon maaf yang sebesar-besarnya mengingat layanan ini masih dalam tahap uji coba. Kami sarankan Anda untuk menggunakan layanan Hubungi Customer Service dibawah ini untuk pengalaman yang lebih baik. Kami akan bantu Anda menyelesaikan masalah Anda sebaik yang kami bisa 🤗\\n", constant("temp10"));
    //     }
    // }

    public function index(Request $request)
    {
        $event = json_decode($request->getContent(), true);
        if (isset($event)) {
            //Here, you now have event and can process them how you like e.g Add to the database or generate a response
            $file = 'log.txt';
            $data = json_encode($event) . "\n";

            $from = $event['contacts'][0]['wa_id'];

            $pesan = $this->readMessage($event);
            $pesan = strtolower($pesan);

            $stackCommand = $this->selectLastTwo($from);

            $top = $stackCommand[0];
            $bottom = $stackCommand[1];
            $isFirstError = false;

            if (str_contains($top->command, "maaf") && str_contains($bottom->command, "maaf")) {
                $isFirstError = true;

                $lastRow = $bottom;
            } elseif (str_contains($top->command, "maaf")) {
                $isFirstError = true;

                $lastRow = $bottom;
            } else {
                $lastRow = $top;
            }




            // $lastRow = CommandModel::where('no_wa', $from)
            //     ->orderByDesc('created_at')
            //     ->first();

            $cs = $this->selectAdmin();

            // IF kembali then deleteLastRow
            if (str_contains($pesan, "menu sebelumnya") !== false) {
                $this->deleteCommand($from);
            }

            if (!isset($lastRow)) {
                $this->send_msg3($from, "Selamat Datang di layanan Halo Mpok Siti, Media Pelayanan Online Karantina Simpel dan Terintegrasi, apa yang ingin Anda ketahui ? \\n", constant("temp1"));
                $this->insertCommand('halo', $from);
                //tampil menu utama
            } else {
                switch (true) {
                    case str_contains($lastRow->command, 'selesai'):
                        if (str_contains($pesan, "halo") !== false) {
                            // echo json_encode("halo selamat datang, pilih menu lacak info sertifikasi");
                            $this->send_msg3($from, "Selamat Datang di layanan Halo Mpok Siti, Media Pelayanan Online Karantina Simpel dan Terintegrasi, apa yang ingin Anda ketahui ? \\n", constant("temp1"));
                            $this->insertCommand($pesan, $from);
                        } else {
                            // echo json_encode("Maaf");
                            $this->send_msg($from, "Maaf, kami tidak paham pesan yang Anda masukkan, ketik halo untuk kembali ke menu utama");
                        }
                        break;
                    case str_contains($lastRow->command, 'halo'):
                        switch (true) {
                            case str_contains($pesan, "seputar kesehatan ikan"):
                                $this->insertCommand($pesan, $from);
                                // echo json_encode("Seputar kesehatan ikan");
                                $this->send_msg3($from, "Selamat datang di menu sertifikasi kesehatan Ikan!\\n\\nPada menu ini akan dijelaskan terkait dengan informasi serta persyaratan apa saja yang perlu dipersiapkan untuk melakukan sertifikasi kesehatan perikanan. Disini kami menyediakan tiga jenis sertifikasi:\\n\\n1.Ekspor\\n2.Impor\\n3.Domestik\\n\\nDari pilihan diatas, yang mana yang ingin Anda ketahui?", constant("temp8"));
                                break;
                            case str_contains($pesan, "layanan sertifikasi mutu"):
                                $this->insertCommand($pesan, $from);
                                // echo json_encode("Layanan sertifikasi mutu");
                                $this->send_msg3($from, "Selamat datang di menu sertifikasi kesehatan Ikan!\\n\\nPada menu ini akan dijelaskan terkait dengan informasi serta persyaratan apa saja yang perlu dipersiapkan untuk melakukan sertifikasi mutu. Disini kami menyediakan tiga jenis sertifikasi:\\n\\n1.Sertifikasi Penerapan HACCP\\n2.Negara Mitra\\n3.Surveilance\\n\\nDari pilihan diatas, yang mana yang ingin Anda ketahui?", constant("temp9"));
                                break;
                            case str_contains($pesan, "lacak info sertifikasi"):
                                $this->insertCommand($pesan, $from);
                                // echo json_encode("Lacak infor sertifikasi");
                                $this->send_msg2($from, "Terdapat dua jenis layanan Sertifikasi, pilih sesuai dengan kebutuhan Anda\\n", constant("temp2"));
                                break;
                            case str_contains($pesan, "hubungi customer service"):
                                $this->insertCommand("selesai", $from);
                                // echo json_encode("hubungi customer service");
                                $this->send_msg($from, "Anda akan dihubungkan ke layanan customer support kami, mohon tunggu hingga pesan selanjutnya. Terimakasih telah menggunakan layanan chatbot mpok Siti");
                                $this->send_msg_admin($cs, $from);
                                // echo json_encode($cs);
                                break;
                            case str_contains($pesan, "batal"):
                            case str_contains($pesan, "selesai"):
                                $this->insertCommand("selesai", $from);
                                // echo json_encode("hubungi customer service");
                                $this->send_msg($from, "Layanan dibatalkan. Terimakasih telah menggunakan layanan chatbot Mpok Siti");
                                break;
                            default:
                                $this->insertCommand("halo", $from);
                                // echo json_encode("Maaf");
                                $this->send_msg($from, "Maaf, kami tidak paham pesan yang Anda masukkan, silahkan masukkan ulang sesuai pilihan yang ada.");
                                $this->send_msg3($from, "Selamat Datang di layanan Halo Mpok Siti, Media Pelayanan Online Karantina Simpel dan Terintegrasi, apa yang ingin Anda ketahui ? \\n", constant("temp1"));
                        }
                        break;
                    case str_contains($lastRow->command, "seputar kesehatan ikan"):
                        switch (true) {
                            case str_contains($pesan, "ekspor"):
                                $this->insertCommand("sk_ikan_ekspor", $from);
                                // echo json_encode("Lacak infor sertifikasi");
                                $this->send_msg($from, "*Persyaratan serta Dokumen yang diperlukan untuk pengurusan karantina ekspor*\\n\\n1. Permohonan Pemeriksaan Karantina Online (www.ppk.bkipm.kkp.go.id)\\n\\n2. Dokumen lain yang dipersyaratkan, untuk jenis-jenis yang dilarang/dibatasi pengeluarannya SAJI-LN\\n\\n3. Packing List (PL), Identitas Produk atau batch code, Invoice, Identitas Sertifikat sesuai Negara tujuan dan Air Way Bill, Bill of Loading; dan Dokumen lain yang dipersyaratkan sesuai ketentuan negara tujuan atau ketentuan internasional yang mengikat.\\n\\n4. LHU Survailance CKIB/ HACCP.\\n\\n5. Sertifkat CKIB/ HACCP ( www.ckib.bkipm.kkp.go.id dan http://haccp.bkipm.kkp.go.id/)\\n\\n*Biaya dan Waktu*\\n\\na. Biaya sesuai dengan PP 85 Tahun 2021\\n\\nb. Waktu Pelayanan:\\n   - Permohonan Online 24 jam\\n   - Sertifikasi dan Pembayaran PNBP 07.00-24.00\\n   - Pemeriksaan Fisik: 24 jam");
                                $this->send_msg2($from, "Anda telah sampai pada akhir sesi ini. Apa yang ingin Anda lakukan?\\n", constant("temp6"));
                                break;

                            case str_contains($pesan, "impor"):
                                $this->insertCommand("sk_ikan_impor", $from);
                                // echo json_encode("Lacak infor sertifikasi");
                                $this->send_msg($from, "*Persyaratan serta Dokumen yang diperlukan untuk pengurusan karantina impor*\\n\\n1. Surat Permohonan Pemeriksaan Karantina (PPK) impor\\n\\n2. Sertifikat Kesehatan dari Negara asal dan/atau Negara transit\\n\\n3. Sertifikat asal / Certificate of origin yang diterbitkan oleh pejabat berwenang di Negara asal\\n\\n4. Surat Izin Pemasukan (Impor) Ikan Hias/Ikan Hidup dari Direktorat Jenderal Perikanan Budidaya/ Surat Izin Pemasukan Hasil Perikanan dari Direktorat Jenderal Pengolahan dan Pemasaran Hasil Perikanan/ Surat Keterangan Teknis dari Direktorat Jenderal Budidaya untuk Media Pembawa berupa bahan baku pakan ikan/udang (fish meal, fish oil, dll), makanan ikan/udang, dan obat ikan.\\n\\n5. Sertifikat Penetapan Instalasi Karantina Ikan\\n\\n6. Dokumen CITES untuk jenis-jenis media pembawa yang dilindungi atau diatur peredarannya\\n\\n7. Dokumen lain sebagai kewajiban tambahan sesuai dengan pasal 7 Peraturan Menteri Kelautan dan Perikanan Nomor PER.10/MEN/2012  tentang Kewajiban Tambahan Karantina Ikan.\\n\\n*Biaya dan Waktu*\\n\\na. Biaya sesuai dengan PP 85 Tahun 2021\\n\\nb. Waktu Pelayanan:\\n   - Permohonan Online 24 jam\\n   - Sertifikasi dan Pembayaran PNBP 07.00-24.00\\n   - Pemeriksaan Fisik: 24 jam");
                                $this->send_msg2($from, "Anda telah sampai pada akhir sesi ini. Apa yang ingin Anda lakukan?\\n", constant("temp6"));
                                break;

                            case str_contains($pesan, "domestik"):
                                $this->insertCommand("sk_ikan_domestik", $from);
                                // echo json_encode("Lacak infor sertifikasi");
                                $this->send_msg($from, "*Persyaratan serta Dokumen yang diperlukan untuk pengurusan karantina domestik*\\n\\n1. Permohonan Pemeriksaan Karantina Online (www.ppk.bkipm.kkp.go.id)\\n\\n2. Dokumen lain yang dipersyaratkan, untuk jenis-jenis yang dilarang/dibatasi pengeluarannya SAJI-DN\\n\\n3. Packing List (PL), Invoice.\\n\\n4. LHU Survailance CKIB/ LHU bagi end product inspection.\\n\\n5. ESKIPP/ Pas Karantina bagi Domestik Masuk/ Sertifikat Pelepasan.\\n\\n*Biaya dan Waktu*\\n\\na. Biaya sesuai dengan PP 85 Tahun 2021\\n\\nb. Waktu Pelayanan:\\n   - Permohonan Online 24 jam\\n   - Sertifikasi dan Pembayaran PNBP 07.00-24.00\\n   - Pemeriksaan Fisik: 24 jam");
                                $this->send_msg2($from, "Anda telah sampai pada akhir sesi ini. Apa yang ingin Anda lakukan?\\n", constant("temp6"));
                                break;
                            case str_contains($pesan, "menu utama"):
                                $this->insertCommand("halo", $from);
                                // echo json_encode("Menu utama");
                                $this->send_msg3($from, "Selamat Datang di layanan Halo Mpok Siti, Media Pelayanan Online Karantina Simpel dan Terintegrasi, apa yang ingin Anda ketahui ? \\n", constant("temp1"));
                                break;
                            default:
                                // echo json_encode($this->selectLastThree($from));
                                $this->insertCommand("maaf", $from);
                                if ($isFirstError) {
                                    $this->send_msg2($from, "*Halo disana!*\\n Bagaimana pengalamanmu menggunakan layanan Halo Mpok Siti?\\n\\nAnda telah mengalami error sebanyak 2 kali atau lebih, kami mohon maaf yang sebesar-besarnya mengingat layanan ini masih dalam tahap uji coba. Kami sarankan Anda untuk menggunakan layanan Hubungi Customer Service dibawah ini untuk pengalaman yang lebih baik. Kami akan bantu Anda menyelesaikan masalah Anda sebaik yang kami bisa\\n", constant("temp10"));
                                } else {
                                    $this->send_msg($from, "Maaf, Pilih sesuai menu yang Ada");
                                }

                                // $this->insertCommand("maaf", $from);
                        }
                        break;

                    case str_contains($lastRow->command, "sk_ikan_ekspor"):
                        switch (true) {
                            case str_contains($pesan, "menu utama"):
                                $this->insertCommand("halo", $from);
                                // echo json_encode("Menu utama");

                                $this->send_msg3($from, "Selamat Datang di layanan Halo Mpok Siti, Media Pelayanan Online Karantina Simpel dan Terintegrasi, apa yang ingin Anda ketahui ? \\n", constant("temp1"));
                                break;
                            case str_contains($pesan, "selesai"):
                                $this->insertCommand($pesan, $from);
                                // echo json_encode("Selesai");
                                $this->send_msg($from, "Terima kasih telah menggunakan layanan chatbot Mpok Siti");
                                break;
                            default:
                                $this->insertCommand("maaf", $from);
                                $this->send_msg($from, "Maaf, Pilih sesuai menu yang ada");
                        }
                        break;

                    case str_contains($lastRow->command, "sk_ikan_impor"):
                        switch (true) {
                            case str_contains($pesan, "menu utama"):
                                $this->insertCommand("halo", $from);
                                // echo json_encode("Menu utama");

                                $this->send_msg3($from, "Selamat Datang di layanan Halo Mpok Siti, Media Pelayanan Online Karantina Simpel dan Terintegrasi, apa yang ingin Anda ketahui ? \\n", constant("temp1"));
                                break;
                            case str_contains($pesan, "selesai"):
                                $this->insertCommand($pesan, $from);
                                // echo json_encode("Selesai");
                                $this->send_msg($from, "Terima kasih telah menggunakan layanan chatbot Mpok Siti");
                                break;
                            default:
                                $this->insertCommand("maaf", $from);
                                $this->send_msg($from, "Maaf, Pilih sesuai menu yang ada");
                        }
                        break;

                    case str_contains($lastRow->command, "sk_ikan_domestik"):
                        switch (true) {
                            case str_contains($pesan, "menu utama"):
                                $this->insertCommand("halo", $from);
                                // echo json_encode("Menu utama");

                                $this->send_msg3($from, "Selamat Datang di layanan Halo Mpok Siti, Media Pelayanan Online Karantina Simpel dan Terintegrasi, apa yang ingin Anda ketahui ? \\n", constant("temp1"));
                                break;
                            case str_contains($pesan, "selesai"):
                                $this->insertCommand($pesan, $from);
                                // echo json_encode("Selesai");
                                $this->send_msg($from, "Terima kasih telah menggunakan layanan chatbot Mpok Siti");
                                break;
                            default:
                                $this->insertCommand("maaf", $from);
                                $this->send_msg($from, "Maaf, Pilih sesuai menu yang ada");
                        }
                        break;

                    case str_contains($lastRow->command, "layanan sertifikasi mutu"):
                        switch (true) {
                            case str_contains($pesan, "sertifikasi haccp"):
                                $this->insertCommand("sertif_haccp", $from);
                                // echo json_encode("Lacak infor sertifikasi");
                                $this->send_msg($from, "*Persyaratan serta Dokumen yang diperlukan untuk pelayanan Sertifikasi Penerapan HACCP*\\n\\n1. Memiliki unit penanganan dan/atau pengolahan yang sesuai dengan jenis  produk perikanan yang akan disertifikasi.\\n\\n2. Mempekerjakan sekurang-kurangnya 1 (satu) orang penanggungjawab mutu yang mempunyai sertifikat HACCP di bidang perikanan/pangan.\\n\\n3. Khusus untuk UPI yang melakukan proses suhu tinggi, mempekerjakan operator yang mempunyai sertifikat pelatihan proses suhu tinggi.\\n\\n4. Memiliki dan menerapkan Sistem HACCP secara konsisten sesuai dengan Persyaratan Jaminan Mutu dan Keamanan Hasil Perikanan pada Proses Produksi, Pengolahan dan Distribusi minimal 10 kali proses sebelum permohonan.\\n\\n5. Melakukan produksi secara aktif\\n\\nUPI mengajukan surat permohonan kepada Kepala Pusat Pengendalian Mutu – BKIPM, dengan melampirkan dokumen sebagai berikut :\\n\\n1. Panduan Mutu berdasarkan konsepsi HACCP yang telah divalidasi;\\n\\n2. Fotokopi identitas pemohon;\\n\\n3. Fotokopi Nomor Pokok Wajib Pajak;\\n\\n4. Fotokopi Sertifikat SKP;\\n\\n5. Surat Pernyataan melakukan proses produksi secara aktif dan menerapkan HACCP.\\n\\nApabila semua persyaratan dinyatakan sesuai, maka Kepala Pusat Pengendalian Mutu akan menugaskan inspektur mutu untuk melakukan inspeksi penerapan HACCP\\n\\n\\n*Biaya dan Waktu*\\n\\na. Gratis\\nb. Waktu Pelayanan : 10 hari kerja");
                                $this->send_msg2($from, "Anda telah sampai pada akhir sesi ini. Apa yang ingin Anda lakukan?\\n", constant("temp6"));
                                break;

                            case str_contains($pesan, "negara mitra"):
                                $this->insertCommand($pesan, $from);
                                // echo json_encode("Lacak infor sertifikasi");
                                $this->send_msg($from, "*Persyaratan serta Dokumen yang diperlukan untuk pelayanan Negara Mitra*\\n\\n1. Nomor registrasi  (Noreg) negara mitra adalah nomor identifikasi tertentu UPI yang diterbitkan oleh otoritas kompeten dan telah mendapat persetujuan dari negara mitra tertentu untuk melakukan ekspor.\\n\\n2. Negara mitra adalah negara tujuan ekspor dan Impor hasil perikanan Indonesia yang telah memiliki kesepakatan/kerjasama dengan pemerintah Republik Indonesia dalam penerapan system jaminan mutu dan keamanan hasil perikanan. Adapun negara –negara tersebut yaitu negara anggota Uni Eropa (28 negara anggota), Kanada, Korea, China, Vietnam, Rusia dan Norwegia.\\n\\n3. Bagaimana cara memperoleh nomor registrasi?\\nUPI dapat mengajukan permohonan kepada Kepala Pusat Pengendalian Mutu, BKIPM dengan melampirkan :Copy HACCP, Surat Pernyataan pemanfaatan nomor registrasi, dan Appendix 3, khusus untuk pendaftaran ke Vietnam.\\n\\n4. nomor registrasi tidak memiliki masa berlaku terkecuali apabila terhadap nomor registrasi tersebut dilakukan suspend atau pencabutan\\n\\n\\n*Biaya dan Waktu*\\n\\na. Gratis\\nb. Waktu Pelayanan: 10 Hari Kerja");
                                $this->send_msg2($from, "Anda telah sampai pada akhir sesi ini. Apa yang ingin Anda lakukan?\\n", constant("temp6"));
                                break;

                            case str_contains($pesan, "surveilance"):
                                $this->insertCommand($pesan, $from);
                                // echo json_encode("Lacak infor sertifikasi");
                                $this->send_msg($from, "*Persyaratan serta Dokumen yang diperlukan untuk pelayanan Surveilance*\\n\\n1. Surveilan merupakan kegiatan inspeksi yang harus dilakukan oleh lembaga inspeksi dan sertifikasi untuk memastikan bahwa penerapan HACCP oleh Unit Penanganan dan pengolahan Ikan (UPI) berjalan secara konsisten dan efektif. Hasil dari surveilan dan pengambilan contoh menjadi dasar menerbitkan Sertifikat Kesehatan (Health Certificate/HC).\\n\\n2. Frekuensi surveilan dilaksanakan berdasarkan grade Sertifikat Penerapan HACCP yaitu sekurang-kurangnya 3 (tiga) bulan sekali untuk grade A, 2 (dua) bulan sekali untuk grade B dan 1 (satu) bulan sekali untuk grade C.");
                                $this->send_msg2($from, "Anda telah sampai pada akhir sesi ini. Apa yang ingin Anda lakukan?\\n", constant("temp6"));
                                break;
                            case str_contains($pesan, "menu utama"):
                                $this->insertCommand("halo", $from);
                                // echo json_encode("Menu utama");
                                $this->send_msg3($from, "Selamat Datang di layanan Halo Mpok Siti, Media Pelayanan Online Karantina Simpel dan Terintegrasi, apa yang ingin Anda ketahui ? \\n", constant("temp1"));
                                break;
                            default:
                                // echo json_encode("Maaf");
                                $this->insertCommand("maaf", $from);
                                $this->send_msg($from, "Maaf, Pilih sesuai menu yang Ada");


                                // case str_contains($pesan, "menu utama"):
                                //     $this->insertCommand("halo", $from);
                                //     // echo json_encode("Menu utama");

                                //     $this->send_msg3($from, "Selamat Datang di layanan Mpok Siti, Chatbot Media Pelayanan Online Karantina Simpel dan Terintegrasi, apa yang ingin Anda ketahui ? \\n", constant("temp1"));
                                //     break;
                                // case str_contains($pesan, "selesai"):
                                //     $this->insertCommand($pesan, $from);
                                //     // echo json_encode("Selesai");
                                //     $this->send_msg($from, "Terima kasih telah menggunakan layanan chatbot Mpok Siti");
                                //     break;
                                // default:
                                //     $this->send_msg($from, "Maaf, Pilih sesuai menu yang ada");
                        }
                        break;

                    case str_contains($lastRow->command, "sertif_haccp"):
                        switch (true) {
                            case str_contains($pesan, "menu utama"):
                                $this->insertCommand("halo", $from);
                                // echo json_encode("Menu utama");

                                $this->send_msg3($from, "Selamat Datang di layanan Halo Mpok Siti, Media Pelayanan Online Karantina Simpel dan Terintegrasi, apa yang ingin Anda ketahui ? \\n", constant("temp1"));
                                break;
                            case str_contains($pesan, "selesai"):
                                $this->insertCommand($pesan, $from);
                                // echo json_encode("Selesai");
                                $this->send_msg($from, "Terima kasih telah menggunakan layanan chatbot Mpok Siti");
                                break;
                            default:
                                $this->insertCommand("maaf", $from);
                                $this->send_msg($from, "Maaf, Pilih sesuai menu yang ada");
                        }
                        break;

                    case str_contains($lastRow->command, "negara mitra"):
                        switch (true) {
                            case str_contains($pesan, "menu utama"):
                                $this->insertCommand("halo", $from);
                                // echo json_encode("Menu utama");

                                $this->send_msg3($from, "Selamat Datang di layanan Halo Mpok Siti, Media Pelayanan Online Karantina Simpel dan Terintegrasi, apa yang ingin Anda ketahui ? \\n", constant("temp1"));
                                break;
                            case str_contains($pesan, "selesai"):
                                $this->insertCommand($pesan, $from);
                                // echo json_encode("Selesai");
                                $this->send_msg($from, "Terima kasih telah menggunakan layanan chatbot Mpok Siti");
                                break;
                            default:
                                $this->insertCommand("maaf", $from);
                                $this->send_msg($from, "Maaf, Pilih sesuai menu yang ada");
                        }
                        break;

                    case str_contains($lastRow->command, "surveilance"):
                        switch (true) {
                            case str_contains($pesan, "menu utama"):
                                $this->insertCommand("halo", $from);
                                // echo json_encode("Menu utama");

                                $this->send_msg3($from, "Selamat Datang di layanan Halo Mpok Siti, Media Pelayanan Online Karantina Simpel dan Terintegrasi, apa yang ingin Anda ketahui ? \\n", constant("temp1"));
                                break;
                            case str_contains($pesan, "selesai"):
                                $this->insertCommand($pesan, $from);
                                // echo json_encode("Selesai");
                                $this->send_msg($from, "Terima kasih telah menggunakan layanan chatbot Mpok Siti");
                                break;
                            default:
                                $this->insertCommand("maaf", $from);
                                $this->send_msg($from, "Maaf, Pilih sesuai menu yang ada");
                        }
                        break;

                        //CASE 1 Trackking Informasi    
                    case str_contains($lastRow->command, "lacak info sertifikasi"):
                        switch (true) {
                            case str_contains($pesan, "sertif ekspor impor"):
                                $this->insertCommand($pesan, $from);
                                // echo json_encode("Sertif ekspor impor");
                                $this->send_msg2($from, "Berikut adalah layanan sertifikasi yang kami sediakan, silahkan pilih sesuai kebutuhan Anda", constant("temp3"));
                                break;
                            case str_contains($pesan, "sertifikat domestik"):
                                $this->insertCommand($pesan, $from);
                                // echo json_encode("Sertifikat domestik");
                                $this->send_msg2($from, "Berikut adalah layanan sertifikasi yang kami sediakan, silahkan pilih sesuai kebutuhan Anda", constant("temp5"));
                                break;
                            case str_contains($pesan, "menu sebelumnya"):
                                // echo json_encode("Menu sebelumnya");
                                $this->send_msg3($from, "Selamat Datang di layanan Halo Mpok Siti, Media Pelayanan Online Karantina Simpel dan Terintegrasi, apa yang ingin Anda ketahui ? \\n", constant("temp1"));
                                break;
                            default:
                                $this->insertCommand("maaf", $from);
                                $this->send_msg($from, "Maaf, Pilih sesuai menu yang ada");
                        }
                        break;

                        //CASE 1.1 Sertif Ekspor Impor
                    case str_contains($lastRow->command, "sertif ekspor impor"):
                        switch (true) {
                            case str_contains($pesan, "ekspor"):
                                // echo json_encode("ini sertif ekspor");
                                $this->insertCommand($pesan, $from);
                                $this->send_msg3($from, "Pelayanan Sertifikat Ekspor memiliki tiga jenis fitur yang dapat diajukan menggunakan nomor aju PPK, yang manakah kebutuhan Anda? ", constant("temp4"));
                                break;
                            case str_contains($pesan, "impor"):
                                // echo json_encode("ini sertif impor");
                                $this->insertCommand($pesan, $from);
                                $this->send_msg3($from, "Pelayanan Sertifikat Impor memiliki tiga jenis fitur yang dapat diajukan menggunakan nomor aju PPK, yang manakah kebutuhan Anda? ", constant("temp4"));
                                break;
                            case str_contains($pesan, "menu sebelumnya"):
                                // echo json_encode("Sertif ekspor impor");
                                $this->send_msg2($from, "Terdapat dua jenis layanan Sertifikasi, pilih sesuai dengan kebutuhan Anda\\n", constant("temp2"));
                                break;
                            default:
                                $this->insertCommand("maaf", $from);
                                $this->send_msg($from, "Maaf, Pilih sesuai menu yang ada");
                        }
                        break;

                    case str_contains($lastRow->command, "ekspor"):
                        switch (true) {
                            case str_contains($pesan, "menu sebelumnya"):
                                // echo json_encode("Ini menu sertif ekspor impor");
                                // $this->insertCommand($pesan, $from);
                                $this->send_msg2($from, "Berikut adalah layanan sertifikasi yang kami sediakan, silahkan pilih sesuai kebutuhan Anda", constant("temp3"));
                                break;
                            case str_contains($pesan, "lacak status pengajuan"):
                                // echo json_encode("Ini menu Tracking Status Aju Ekspor");
                                $this->insertCommand("eks_aju_lacak", $from);
                                $this->send_msg2($from, "Silahkan masukkan nomor aju PPK Anda", constant("temp7"));
                                break;
                            case str_contains($pesan, "no ijin/no sertifikat"):
                                // echo json_encode("Ini menu No Ijin/No Sertifikat");
                                $this->insertCommand("eks_no_sertif", $from);
                                $this->send_msg2($from, "Silahkan masukkan nomor aju PPK Anda", constant("temp7"));
                                break;
                            case str_contains($pesan, "biaya pnbp"):
                                // echo json_encode("Ini menu Biaya PNBP");
                                $this->insertCommand("biaya pnbp eks", $from);
                                $this->send_msg2($from, "Silahkan masukkan nomor aju PPK Anda", constant("temp7"));
                                break;
                            default:
                                $this->insertCommand("maaf", $from);
                                $this->send_msg($from, "Maaf, Pilih sesuai menu yang ada");
                        }
                        break;

                    case str_contains($lastRow->command, "eks_aju_lacak"):
                        $selectPPK = $this->selectPPKEkspor(strtoupper($pesan));
                        $sertif = $this->lacakEkspor(strtoupper($pesan));
                        switch (true) {
                            case str_contains($pesan, "menu sebelumnya"):
                                // echo json_encode("Menu sebelumnya");
                                $this->send_msg3($from, "Pelayanan Sertifikat Ekspor memiliki tiga jenis fitur yang dapat diajukan menggunakan nomor aju PPK, yang manakah kebutuhan Anda? ", constant("temp4"));
                                break;
                            case str_contains(strtoupper($pesan), $selectPPK->no_aju_ppk):
                                $this->insertCommand("nomor aju eks", $from);
                                // echo json_encode("Anda telah memasukkan nomor aju ekspor Anda");
                                $this->send_msg($from, "Berdasarkan tracking, proses Anda telah sampai pada " . $sertif->nm_dok);
                                // db
                                $this->send_msg2($from, "Anda telah sampai pada akhir sesi ini. Apa yang ingin Anda lakukan?\\n", constant("temp6"));
                                break;
                            default:
                                // echo json_encode("Ulangi masukkan");
                                $this->insertCommand("maaf", $from);
                                $this->send_msg2($from, "Maaf, Nomor Aju yang Anda masukkan tidak sesuai. Periksa kembali Nomor Aju Anda dan silahkan masukkan kembali", constant("temp7"));
                        }
                        break;

                    case str_contains($lastRow->command, "nomor aju eks"):
                        switch (true) {
                            case str_contains($pesan, "menu utama"):
                                $this->insertCommand("halo", $from);
                                // echo json_encode("Menu utama");
                                $this->send_msg3($from, "Selamat Datang di layanan Halo Mpok Siti, Media Pelayanan Online Karantina Simpel dan Terintegrasi, apa yang ingin Anda ketahui ? \\n", constant("temp1"));
                                break;
                            case str_contains($pesan, "selesai"):
                                $this->insertCommand("selesai", $from);
                                // echo json_encode("Selesai");
                                $this->send_msg($from, "Terima kasih telah menggunakan layanan chatbot Mpok Siti");
                                break;
                            default:
                                $this->insertCommand("maaf", $from);
                                $this->send_msg($from, "Maaf, Pilih sesuai menu yang ada");
                        }
                        break;

                    case str_contains($lastRow->command, "biaya pnbp eks"):
                        $selectPPK = $this->selectPPKPNBP(strtoupper($pesan));
                        // $selectIDPPK = $this->selectIDPPK(strtoupper($pesan));
                        switch (true) {
                            case str_contains($pesan, "menu sebelumnya"):
                                // echo json_encode("Menu sebelumnya");
                                $this->send_msg3($from, "Pelayanan Sertifikat Ekspor memiliki tiga jenis fitur yang dapat diajukan menggunakan nomor aju PPK, yang manakah kebutuhan Anda? ", constant("temp4"));
                                break;
                            case str_contains(strtoupper($pesan), $selectPPK->no_aju_ppk):
                                $kelTarif = $this->selectTarif(strtoupper($pesan));
                                $tarifText = "";
                                $total = 0;
                                foreach ($kelTarif as $tarif) {
                                    $kel_tarif = $tarif->kel_tarif;

                                    $harga = $tarif->total;
                                    $tarifText .=  "$kel_tarif Rp $harga \\n";
                                    $total += $harga;
                                }
                                if ($kelTarif == null) {
                                    // echo json_encode("Pesan tidak ditemukan");
                                    $this->insertCommand("selesai", $from);
                                    $this->send_msg($from, "Data yang Anda cari berdasarkan nomor Aju tidak ditemukan. Periksa kembali status pengajuan Anda di menu lacak informasi dan pastikan Anda telah sampai pada proses PNBP");
                                    $this->send_msg2($from, "Anda telah sampai pada akhir sesi ini. Apa yang ingin Anda lakukan?\\n", constant("temp6"));
                                } else {
                                    // echo json_encode("Anda telah memasukkan nomor aju ekspor Anda, berikut adalah nomor sertifikat Anda " . $nomorSertif->no_sertifikat);
                                    $this->insertCommand("pnbp eks", $from);
                                    $this->send_msg($from, "Berdasarkan nomor Aju Ekspor yang Anda masukkan, berikut adalah pnbp Anda \\n $tarifText \\n total: Rp $total");
                                    $this->send_msg2($from, "Anda telah sampai pada akhir sesi ini. Apa yang ingin Anda lakukan?\\n", constant("temp6"));
                                }
                                break;
                            default:
                                // echo json_encode("Ulangi masukkan");
                                $this->insertCommand("maaf", $from);
                                $this->send_msg2($from, "Maaf, Nomor Aju yang Anda masukkan tidak sesuai. Periksa kembali Nomor Aju Anda dan silahkan masukkan kembali", constant("temp7"));
                        }
                        break;

                    case str_contains($lastRow->command, "pnbp eks"):
                        switch (true) {
                            case str_contains($pesan, "menu utama"):
                                $this->insertCommand("halo", $from);
                                // echo json_encode("Menu utama");
                                $this->send_msg3($from, "Selamat Datang di layanan Halo Mpok Siti, Media Pelayanan Online Karantina Simpel dan Terintegrasi, apa yang ingin Anda ketahui ? \\n", constant("temp1"));
                                break;
                            case str_contains($pesan, "selesai"):
                                $this->insertCommand("selesai", $from);
                                // echo json_encode("Selesai");
                                $this->send_msg($from, "Terima kasih telah menggunakan layanan chatbot Mpok Siti");
                                break;
                            default:
                                $this->insertCommand("maaf", $from);
                                $this->send_msg2($from, "Maaf, Silahkan masukkan kembali nomor aju PPK Anda", constant("temp7"));
                        }
                        break;


                        // CASE IMPOR
                    case str_contains($lastRow->command, "impor"):
                        switch (true) {
                            case str_contains($pesan, "menu sebelumnya"):
                                // echo json_encode("Ini menu sertif ekspor impor");
                                // $this->insertCommand($pesan, $from);
                                $this->send_msg2($from, "Berikut adalah layanan sertifikasi yang kami sediakan, silahkan pilih sesuai kebutuhan Anda", constant("temp3"));
                                break;
                            case str_contains($pesan, "lacak status pengajuan"):
                                // echo json_encode("Ini menu Tracking Status Aju");
                                $this->insertCommand("imp_aju_lacak", $from);
                                $this->send_msg2($from, "Silahkan masukkan nomor aju PPK Anda", constant("temp7"));
                                break;
                            case str_contains($pesan, "no ijin/no sertifikat"):
                                // echo json_encode("Ini menu No Ijin/No Sertifikat");
                                $this->insertCommand("imp_no_sertif", $from);
                                $this->send_msg2($from, "Silahkan masukkan nomor aju PPK Anda", constant("temp7"));
                                break;
                            case str_contains($pesan, "biaya pnbp"):
                                // echo json_encode("Ini menu Biaya PNBP");
                                $this->insertCommand("biaya pnbp imp", $from);
                                $this->send_msg2($from, "Silahkan masukkan nomor aju PPK Anda", constant("temp7"));
                                break;
                            default:
                                // echo json_encode("Ulangi masukkan");
                                $this->insertCommand("maaf", $from);
                                $this->send_msg($from, "Maaf, Pilih sesuai menu yang ada");
                        }
                        break;

                    case str_contains($lastRow->command, "imp_aju_lacak"):
                        $selectPPK = $this->selectPPKImpor(strtoupper($pesan));
                        $sertif = $this->lacakImpor(strtoupper($pesan));
                        switch (true) {
                            case str_contains($pesan, "menu sebelumnya"):
                                // echo json_encode("Menu sebelumnya");
                                $this->send_msg3($from, "Pelayanan Sertifikat Impor memiliki tiga jenis fitur yang dapat diajukan menggunakan nomor aju PPK, yang manakah kebutuhan Anda? ", constant("temp4"));
                                break;
                            case str_contains(strtoupper($pesan), $selectPPK->no_aju_ppk):
                                $this->insertCommand("nomor aju imp", $from);
                                // echo json_encode("Anda telah memasukkan nomor aju impor Anda");
                                $this->send_msg($from, "Berdasarkan tracking, proses Anda telah sampai pada " . $sertif->nm_dok);
                                // db
                                $this->send_msg2($from, "Anda telah sampai pada akhir sesi ini. Apa yang ingin Anda lakukan?\\n", constant("temp6"));
                                break;
                            default:
                                // echo json_encode("Ulangi masukkan");
                                $this->insertCommand("maaf", $from);
                                $this->send_msg2($from, "Maaf, Nomor Aju yang Anda masukkan tidak sesuai. Periksa kembali Nomor Aju Anda dan silahkan masukkan kembali", constant("temp7"));
                        }
                        break;

                    case str_contains($lastRow->command, "nomor aju imp"):
                        switch (true) {
                            case str_contains($pesan, "menu utama"):
                                $this->insertCommand("halo", $from);
                                // echo json_encode("Menu utama");
                                $this->send_msg3($from, "Selamat Datang di layanan Halo Mpok Siti, Media Pelayanan Online Karantina Simpel dan Terintegrasi, apa yang ingin Anda ketahui ? \\n", constant("temp1"));
                                break;
                            case str_contains($pesan, "selesai"):
                                $this->insertCommand("selesai", $from);
                                // echo json_encode("Selesai");
                                $this->send_msg($from, "Terima kasih telah menggunakan layanan chatbot Mpok Siti");
                                break;
                            default:
                                $this->insertCommand("maaf", $from);
                                $this->send_msg($from, "Maaf, Pilih sesuai menu yang ada");
                        }
                        break;

                    case str_contains($lastRow->command, "biaya pnbp imp"):
                        $selectPPK = $this->selectPPKPNBP(strtoupper($pesan));
                        // $selectIDPPK = $this->selectIDPPK(strtoupper($pesan));
                        switch (true) {
                            case str_contains($pesan, "menu sebelumnya"):
                                // echo json_encode("Menu sebelumnya");
                                $this->send_msg3($from, "Pelayanan Sertifikat Ekspor memiliki tiga jenis fitur yang dapat diajukan menggunakan nomor aju PPK, yang manakah kebutuhan Anda? ", constant("temp4"));
                                break;
                            case str_contains(strtoupper($pesan), $selectPPK->no_aju_ppk):
                                $kelTarif = $this->selectTarif(strtoupper($pesan));
                                $tarifText = "";
                                $total = 0;
                                foreach ($kelTarif as $tarif) {
                                    $kel_tarif = $tarif->kel_tarif;

                                    $harga = $tarif->total;
                                    $tarifText .=  "$kel_tarif Rp $harga \\n";
                                    $total += $harga;
                                }
                                if ($kelTarif == null) {
                                    // echo json_encode("Pesan tidak ditemukan");
                                    $this->insertCommand("selesai", $from);
                                    $this->send_msg($from, "Data yang Anda cari berdasarkan nomor Aju tidak ditemukan. Periksa kembali status pengajuan Anda di menu lacak informasi dan pastikan Anda telah sampai pada proses PNBP");
                                    $this->send_msg2($from, "Anda telah sampai pada akhir sesi ini. Apa yang ingin Anda lakukan?\\n", constant("temp6"));
                                } else {
                                    // echo json_encode("Anda telah memasukkan nomor aju ekspor Anda, berikut adalah nomor sertifikat Anda " . $nomorSertif->no_sertifikat);
                                    $this->insertCommand("pnbp imp", $from);
                                    $this->send_msg($from, "Berdasarkan nomor Aju Ekspor yang Anda masukkan, berikut adalah pnbp Anda \\n $tarifText \\n total: Rp $total");
                                    $this->send_msg2($from, "Anda telah sampai pada akhir sesi ini. Apa yang ingin Anda lakukan?\\n", constant("temp6"));
                                }
                                break;
                            default:
                                // echo json_encode("Ulangi masukkan");
                                $this->insertCommand("maaf", $from);
                                $this->send_msg2($from, "Maaf, Nomor Aju yang Anda masukkan tidak sesuai. Periksa kembali Nomor Aju Anda dan silahkan masukkan kembali", constant("temp7"));
                        }
                        break;

                    case str_contains($lastRow->command, "pnbp imp"):
                        switch (true) {
                            case str_contains($pesan, "menu utama"):
                                $this->insertCommand("halo", $from);
                                // echo json_encode("Menu utama");
                                $this->send_msg3($from, "Selamat Datang di layanan Halo Mpok Siti, Media Pelayanan Online Karantina Simpel dan Terintegrasi, apa yang ingin Anda ketahui ? \\n", constant("temp1"));
                                break;
                            case str_contains($pesan, "selesai"):
                                $this->insertCommand("selesai", $from);
                                // echo json_encode("Selesai");
                                $this->send_msg($from, "Terima kasih telah menggunakan layanan chatbot Mpok Siti");
                                break;
                            default:
                                $this->insertCommand("maaf", $from);
                                $this->send_msg2($from, "Maaf, Silahkan masukkan kembali nomor aju PPK Anda", constant("temp7"));
                        }
                        break;


                        //CASE NO_SERTIFIKAT
                    case str_contains($lastRow->command, "eks_no_sertif"):
                        $selectPPK = $this->selectPPK(strtoupper($pesan));
                        // $selectIDPPK = $this->selectIDPPK(strtoupper($pesan));
                        switch (true) {
                            case str_contains($pesan, "menu sebelumnya"):
                                // echo json_encode("Menu sebelumnya");
                                $this->send_msg3($from, "Pelayanan Sertifikat Ekspor memiliki tiga jenis fitur yang dapat diajukan menggunakan nomor aju PPK, yang manakah kebutuhan Anda? ", constant("temp4"));
                                break;
                            case str_contains(strtoupper($pesan), $selectPPK->no_aju_ppk):
                                $nomorSertif = $this->getNoIjin(strtoupper($pesan));
                                if ($nomorSertif == false) {
                                    // echo json_encode("Pesan tidak ditemukan");
                                    $this->insertCommand("selesai", $from);
                                    $this->send_msg($from, "Data yang Anda cari berdasarkan nomor Aju tidak ditemukan. Periksa kembali status pengajuan Anda di menu lacak informasi dan pastikan Anda telah sampai pada proses Single Certificate");
                                    $this->send_msg2($from, "Anda telah sampai pada akhir sesi ini. Apa yang ingin Anda lakukan?\\n", constant("temp6"));
                                } else {
                                    // echo json_encode("Anda telah memasukkan nomor aju ekspor Anda, berikut adalah nomor sertifikat Anda " . $nomorSertif->no_sertifikat);
                                    $this->insertCommand("nomor aju eks", $from);
                                    $this->send_msg($from, "Berdasarkan nomor Aju Ekspor yang Anda masukkan, berikut adalah nomor sertifikat Anda " . $nomorSertif->no_sertifikat);
                                    $this->send_msg2($from, "Anda telah sampai pada akhir sesi ini. Apa yang ingin Anda lakukan?\\n", constant("temp6"));
                                }
                                break;
                            default:
                                // echo json_encode("Ulangi masukkan");
                                $this->insertCommand("maaf", $from);
                                $this->send_msg2($from, "Maaf, Nomor Aju yang Anda masukkan tidak sesuai. Periksa kembali Nomor Aju Anda dan silahkan masukkan kembali", constant("temp7"));
                        }
                        break;

                    case str_contains($lastRow->command, "imp_no_sertif"):
                        $selectPPK = $this->selectPPK(strtoupper($pesan));
                        // $selectIDPPK = $this->selectIDPPK(strtoupper($pesan));
                        switch (true) {
                            case str_contains($pesan, "menu sebelumnya"):
                                // echo json_encode("Menu sebelumnya");
                                $this->send_msg3($from, "Pelayanan Sertifikat Ekspor memiliki tiga jenis fitur yang dapat diajukan menggunakan nomor aju PPK, yang manakah kebutuhan Anda? ", constant("temp4"));
                                break;
                            case str_contains(strtoupper($pesan), $selectPPK->no_aju_ppk):
                                $nomorSertif = $this->getNoIjin(strtoupper($pesan));
                                if ($nomorSertif == false) {
                                    // echo json_encode("Pesan tidak ditemukan");
                                    $this->insertCommand("selesai", $from);
                                    $this->send_msg($from, "Data yang Anda cari berdasarkan nomor Aju tidak ditemukan. Periksa kembali status pengajuan Anda di menu lacak informasi dan pastikan Anda telah sampai pada proses Single Certificate");
                                    $this->send_msg2($from, "Anda telah sampai pada akhir sesi ini. Apa yang ingin Anda lakukan?\\n", constant("temp6"));
                                } else {
                                    // echo json_encode("Anda telah memasukkan nomor aju ekspor Anda, berikut adalah nomor sertifikat Anda " . $nomorSertif->no_sertifikat);
                                    $this->insertCommand("nomor aju imp", $from);
                                    $this->send_msg($from, "Berdasarkan nomor Aju Impor yang Anda masukkan, berikut adalah nomor sertifikat Anda " . $nomorSertif->no_sertifikat);
                                    $this->send_msg2($from, "Anda telah sampai pada akhir sesi ini. Apa yang ingin Anda lakukan?\\n", constant("temp6"));
                                }
                                break;
                            default:
                                // echo json_encode("Ulangi masukkan");
                                $this->insertCommand("maaf", $from);
                                $this->send_msg2($from, "Maaf, Nomor Aju yang Anda masukkan tidak sesuai. Periksa kembali Nomor Aju Anda dan silahkan masukkan kembali", constant("temp7"));
                        }
                        break;

                        //CASE 1.2 Sertifikat Domestik
                    case str_contains($lastRow->command, "sertifikat domestik"):
                        switch (true) {
                            case str_contains($pesan, "domestik keluar"):
                                // echo json_encode("ini sertif ekspor");
                                $this->insertCommand($pesan, $from);
                                $this->send_msg3($from, "Pelayanan Sertifikat Domestik Keluar memiliki tiga jenis fitur yang dapat diajukan menggunakan nomor aju PPK, yang manakah kebutuhan Anda? ", constant("temp4"));
                                break;
                            case str_contains($pesan, "domestik masuk"):
                                // echo json_encode("ini sertif impor");
                                $this->insertCommand($pesan, $from);
                                $this->send_msg3($from, "Pelayanan Sertifikat Domestik Masuk memiliki tiga jenis fitur yang dapat diajukan menggunakan nomor aju PPK, yang manakah kebutuhan Anda? ", constant("temp4"));
                                break;
                            case str_contains($pesan, "menu sebelumnya"):
                                // echo json_encode("Menu sebelumnya");
                                $this->send_msg2($from, "Terdapat dua jenis layanan Sertifikasi, pilih sesuai dengan kebutuhan Anda\\n", constant("temp2"));
                                break;
                            default:
                                $this->insertCommand("maaf", $from);
                                $this->send_msg($from, "Maaf, Pilih sesuai menu yang ada");
                        }
                        break;

                        // ==================== DOMESTIK KELUAR ======================

                    case str_contains($lastRow->command, "domestik keluar"):
                        switch (true) {
                            case str_contains($pesan, "menu sebelumnya"):
                                // echo json_encode("Ini menu sertif ekspor impor");
                                // $this->insertCommand($pesan, $from);
                                $this->send_msg2($from, "Berikut adalah layanan sertifikasi yang kami sediakan, silahkan pilih sesuai kebutuhan Anda", constant("temp5"));
                                break;
                            case str_contains($pesan, "lacak status pengajuan"):
                                // echo json_encode("Ini menu Tracking Status Aju");
                                $this->insertCommand("dk_aju_lacak", $from);
                                $this->send_msg2($from, "Silahkan masukkan nomor aju PPK Anda", constant("temp7"));
                                break;
                            case str_contains($pesan, "no ijin/no sertifikat"):
                                // echo json_encode("Ini menu No Ijin/No Sertifikat");
                                $this->insertCommand("dk_no_sertif", $from);
                                $this->send_msg2($from, "Silahkan masukkan nomor aju PPK Anda", constant("temp7"));
                                break;
                            case str_contains($pesan, "biaya pnbp"):
                                // echo json_encode("Ini menu Biaya PNBP");
                                $this->insertCommand("biaya pnbp dk", $from);
                                $this->send_msg2($from, "Silahkan masukkan nomor aju PPK Anda", constant("temp7"));
                                break;
                            default:
                                $this->insertCommand("maaf", $from);
                                $this->send_msg($from, "Maaf, Pilih sesuai menu yang ada");
                        }
                        break;

                    case str_contains($lastRow->command, "dk_aju_lacak"):
                        $selectPPK = $this->selectPPKKeluar(strtoupper($pesan));
                        $sertif = $this->lacakKeluar(strtoupper($pesan));
                        switch (true) {
                            case str_contains($pesan, "menu sebelumnya"):
                                // echo json_encode("Menu sebelumnya");
                                $this->send_msg3($from, "Pelayanan Sertifikat Domestik Keluar memiliki tiga jenis fitur yang dapat diajukan menggunakan nomor aju PPK, yang manakah kebutuhan Anda? ", constant("temp4"));
                                break;
                            case str_contains(strtoupper($pesan), $selectPPK->no_aju_ppk):
                                $this->insertCommand("nomor aju dk", $from);
                                // echo json_encode("Anda telah memasukkan nomor aju impor Anda");
                                $this->send_msg($from, "Berdasarkan tracking, proses Anda telah sampai pada " . $sertif->nm_dok);
                                // db
                                $this->send_msg2($from, "Anda telah sampai pada akhir sesi ini. Apa yang ingin Anda lakukan?\\n", constant("temp6"));
                                break;
                            default:
                                // echo json_encode("Ulangi masukkan");
                                $this->insertCommand("maaf", $from);
                                $this->send_msg2($from, "Maaf, Silahkan masukkan kembali nomor aju PPK Anda", constant("temp7"));
                        }
                        break;

                    case str_contains($lastRow->command, "nomor aju dk"):
                        switch (true) {
                            case str_contains($pesan, "menu utama"):
                                $this->insertCommand("halo", $from);
                                // echo json_encode("Menu utama");
                                $this->send_msg3($from, "Selamat Datang di layanan Halo Mpok Siti, Media Pelayanan Online Karantina Simpel dan Terintegrasi, apa yang ingin Anda ketahui ? \\n", constant("temp1"));
                                break;
                            case str_contains($pesan, "selesai"):
                                $this->insertCommand("selesai", $from);
                                // echo json_encode("Selesai");
                                $this->send_msg($from, "Terima kasih telah menggunakan layanan chatbot Mpok Siti");
                                break;
                            default:
                                $this->insertCommand("maaf", $from);
                                $this->send_msg2($from, "Maaf, Silahkan masukkan kembali nomor aju PPK Anda", constant("temp7"));
                        }
                        break;

                    case str_contains($lastRow->command, "biaya pnbp dk"):
                        $selectPPK = $this->selectPPKPNBP(strtoupper($pesan));
                        // $selectIDPPK = $this->selectIDPPK(strtoupper($pesan));
                        switch (true) {
                            case str_contains($pesan, "menu sebelumnya"):
                                // echo json_encode("Menu sebelumnya");
                                $this->send_msg3($from, "Pelayanan Sertifikat Ekspor memiliki tiga jenis fitur yang dapat diajukan menggunakan nomor aju PPK, yang manakah kebutuhan Anda? ", constant("temp4"));
                                break;
                            case str_contains(strtoupper($pesan), $selectPPK->no_aju_ppk):
                                $kelTarif = $this->selectTarif(strtoupper($pesan));
                                $tarifText = "";
                                $total = 0;
                                foreach ($kelTarif as $tarif) {
                                    $kel_tarif = $tarif->kel_tarif;

                                    $harga = $tarif->total;
                                    $tarifText .=  "$kel_tarif Rp $harga \\n";
                                    $total += $harga;
                                }
                                if ($kelTarif == null) {
                                    // echo json_encode("Pesan tidak ditemukan");
                                    $this->insertCommand("selesai", $from);
                                    $this->send_msg($from, "Data yang Anda cari berdasarkan nomor Aju tidak ditemukan. Periksa kembali status pengajuan Anda di menu lacak informasi dan pastikan Anda telah sampai pada proses PNBP");
                                    $this->send_msg2($from, "Anda telah sampai pada akhir sesi ini. Apa yang ingin Anda lakukan?\\n", constant("temp6"));
                                } else {
                                    // echo json_encode("Anda telah memasukkan nomor aju ekspor Anda, berikut adalah nomor sertifikat Anda " . $nomorSertif->no_sertifikat);
                                    $this->insertCommand("pnbp dk", $from);
                                    $this->send_msg($from, "Berdasarkan nomor Aju Ekspor yang Anda masukkan, berikut adalah pnbp Anda \\n $tarifText \\n total: Rp $total");
                                    $this->send_msg2($from, "Anda telah sampai pada akhir sesi ini. Apa yang ingin Anda lakukan?\\n", constant("temp6"));
                                }
                                break;
                            default:
                                // echo json_encode("Ulangi masukkan");
                                $this->insertCommand("maaf", $from);
                                $this->send_msg2($from, "Maaf, Nomor Aju yang Anda masukkan tidak sesuai. Periksa kembali Nomor Aju Anda dan silahkan masukkan kembali", constant("temp7"));
                        }
                        break;

                    case str_contains($lastRow->command, "pnbp dk"):
                        switch (true) {
                            case str_contains($pesan, "menu utama"):
                                $this->insertCommand("halo", $from);
                                // echo json_encode("Menu utama");
                                $this->send_msg3($from, "Selamat Datang di layanan Halo Mpok Siti, Media Pelayanan Online Karantina Simpel dan Terintegrasi, apa yang ingin Anda ketahui ? \\n", constant("temp1"));
                                break;
                            case str_contains($pesan, "selesai"):
                                $this->insertCommand("selesai", $from);
                                // echo json_encode("Selesai");
                                $this->send_msg($from, "Terima kasih telah menggunakan layanan chatbot Mpok Siti");
                                break;
                            default:
                                $this->insertCommand("maaf", $from);
                                $this->send_msg2($from, "Maaf, Silahkan masukkan kembali nomor aju PPK Anda", constant("temp7"));
                        }
                        break;



                        // ================= DOMESTIK MASUK ====================

                    case str_contains($lastRow->command, "domestik masuk"):
                        switch (true) {
                            case str_contains($pesan, "menu sebelumnya"):
                                // echo json_encode("Ini menu sertif ekspor impor");
                                // $this->insertCommand($pesan, $from);
                                $this->send_msg2($from, "Berikut adalah layanan sertifikasi yang kami sediakan, silahkan pilih sesuai kebutuhan Anda", constant("temp5"));
                                break;
                            case str_contains($pesan, "lacak status pengajuan"):
                                // echo json_encode("Ini menu Tracking Status Aju");
                                $this->insertCommand("dm_aju_lacak", $from);
                                $this->send_msg2($from, "Silahkan masukkan nomor aju PPK Anda", constant("temp7"));
                                break;
                            case str_contains($pesan, "no ijin/no sertifikat"):
                                // echo json_encode("Ini menu No Ijin/No Sertifikat");
                                $this->insertCommand("dm_no_sertif", $from);
                                $this->send_msg2($from, "Silahkan masukkan nomor aju PPK Anda", constant("temp7"));
                                break;
                            case str_contains($pesan, "biaya pnbp"):
                                // echo json_encode("Ini menu Biaya PNBP");
                                $this->insertCommand("biaya pnbp dm", $from);
                                $this->send_msg2($from, "Silahkan masukkan nomor aju PPK Anda", constant("temp7"));
                                break;
                            default:
                                $this->insertCommand("maaf", $from);
                                $this->send_msg($from, "Maaf, Pilih sesuai menu yang ada");
                        }
                        break;

                    case str_contains($lastRow->command, "dm_aju_lacak"):
                        $selectPPK = $this->selectPPKMasuk(strtoupper($pesan));
                        $sertif = $this->lacakMasuk(strtoupper($pesan));
                        switch (true) {
                            case str_contains($pesan, "menu sebelumnya"):
                                // echo json_encode("Menu sebelumnya");
                                $this->send_msg3($from, "Pelayanan Sertifikat Domestik Masuk memiliki tiga jenis fitur yang dapat diajukan menggunakan nomor aju PPK, yang manakah kebutuhan Anda? ", constant("temp4"));
                                break;
                            case str_contains(strtoupper($pesan), $selectPPK->no_aju_ppk):
                                $this->insertCommand("nomor aju dm", $from);
                                // echo json_encode("Anda telah memasukkan nomor aju impor Anda");
                                $this->send_msg($from, "Berdasarkan tracking, proses Anda telah sampai pada " . $sertif->nm_dok);
                                // db
                                $this->send_msg2($from, "Anda telah sampai pada akhir sesi ini. Apa yang ingin Anda lakukan?\\n", constant("temp6"));
                                break;
                            default:
                                // echo json_encode("Ulangi masukkan");
                                $this->insertCommand("maaf", $from);
                                $this->send_msg2($from, "Maaf, Silahkan masukkan kembali nomor aju PPK Anda", constant("temp7"));
                        }
                        break;

                    case str_contains($lastRow->command, "nomor aju dm"):
                        switch (true) {
                            case str_contains($pesan, "menu utama"):
                                $this->insertCommand("halo", $from);
                                // echo json_encode("Menu utama");
                                $this->send_msg3($from, "Selamat Datang di layanan Halo Mpok Siti, Media Pelayanan Online Karantina Simpel dan Terintegrasi, apa yang ingin Anda ketahui ? \\n", constant("temp1"));
                                break;
                            case str_contains($pesan, "selesai"):
                                $this->insertCommand("selesai", $from);
                                // echo json_encode("Selesai");
                                $this->send_msg($from, "Terima kasih telah menggunakan layanan chatbot Mpok Siti");
                                break;
                            default:
                                $this->insertCommand("maaf", $from);
                                $this->send_msg2($from, "Maaf, Silahkan masukkan kembali nomor aju PPK Anda", constant("temp7"));
                        }
                        break;

                    case str_contains($lastRow->command, "biaya pnbp dm"):
                        $selectPPK = $this->selectPPKPNBP(strtoupper($pesan));
                        // $selectIDPPK = $this->selectIDPPK(strtoupper($pesan));
                        switch (true) {
                            case str_contains($pesan, "menu sebelumnya"):
                                // echo json_encode("Menu sebelumnya");
                                $this->send_msg3($from, "Pelayanan Sertifikat Ekspor memiliki tiga jenis fitur yang dapat diajukan menggunakan nomor aju PPK, yang manakah kebutuhan Anda? ", constant("temp4"));
                                break;
                            case str_contains(strtoupper($pesan), $selectPPK->no_aju_ppk):
                                $kelTarif = $this->selectTarif(strtoupper($pesan));
                                $tarifText = "";
                                $total = 0;
                                foreach ($kelTarif as $tarif) {
                                    $kel_tarif = $tarif->kel_tarif;

                                    $harga = $tarif->total;
                                    $tarifText .=  "$kel_tarif Rp $harga \\n";
                                    $total += $harga;
                                }
                                if ($kelTarif == null) {
                                    // echo json_encode("Pesan tidak ditemukan");
                                    $this->insertCommand("selesai", $from);
                                    $this->send_msg($from, "Data yang Anda cari berdasarkan nomor Aju tidak ditemukan. Periksa kembali status pengajuan Anda di menu lacak informasi dan pastikan Anda telah sampai pada proses PNBP");
                                    $this->send_msg2($from, "Anda telah sampai pada akhir sesi ini. Apa yang ingin Anda lakukan?\\n", constant("temp6"));
                                } else {
                                    // echo json_encode("Anda telah memasukkan nomor aju ekspor Anda, berikut adalah nomor sertifikat Anda " . $nomorSertif->no_sertifikat);
                                    $this->insertCommand("pnbp dm", $from);
                                    $this->send_msg($from, "Berdasarkan nomor Aju Ekspor yang Anda masukkan, berikut adalah pnbp Anda \\n $tarifText \\n total: Rp $total");
                                    $this->send_msg2($from, "Anda telah sampai pada akhir sesi ini. Apa yang ingin Anda lakukan?\\n", constant("temp6"));
                                }
                                break;
                            default:
                                // echo json_encode("Ulangi masukkan");
                                $this->insertCommand("maaf", $from);
                                $this->send_msg2($from, "Maaf, Nomor Aju yang Anda masukkan tidak sesuai. Periksa kembali Nomor Aju Anda dan silahkan masukkan kembali", constant("temp7"));
                        }
                        break;

                    case str_contains($lastRow->command, "pnbp dm"):
                        switch (true) {
                            case str_contains($pesan, "menu utama"):
                                $this->insertCommand("halo", $from);
                                // echo json_encode("Menu utama");
                                $this->send_msg3($from, "Selamat Datang di layanan Halo Mpok Siti, Media Pelayanan Online Karantina Simpel dan Terintegrasi, apa yang ingin Anda ketahui ? \\n", constant("temp1"));
                                break;
                            case str_contains($pesan, "selesai"):
                                $this->insertCommand("selesai", $from);
                                // echo json_encode("Selesai");
                                $this->send_msg($from, "Terima kasih telah menggunakan layanan chatbot Mpok Siti");
                                break;
                            default:
                                $this->insertCommand("maaf", $from);
                                $this->send_msg2($from, "Maaf, Silahkan masukkan kembali nomor aju PPK Anda", constant("temp7"));
                        }
                        break;

                        // CASE NO_SERTIFIKAT =========== 
                        // DOMAIN KELUAR ==========
                    case str_contains($lastRow->command, "dk_no_sertif"):
                        $selectPPK = $this->selectPPK(strtoupper($pesan));
                        // $selectIDPPK = $this->selectIDPPK(strtoupper($pesan));
                        switch (true) {
                            case str_contains($pesan, "menu sebelumnya"):
                                // echo json_encode("Menu sebelumnya");
                                $this->send_msg3($from, "Pelayanan Sertifikat Ekspor memiliki tiga jenis fitur yang dapat diajukan menggunakan nomor aju PPK, yang manakah kebutuhan Anda? ", constant("temp4"));
                                break;
                            case str_contains(strtoupper($pesan), $selectPPK->no_aju_ppk):
                                $nomorSertif = $this->getNoIjin(strtoupper($pesan));
                                if ($nomorSertif == false) {
                                    // echo json_encode("Pesan tidak ditemukan");
                                    $this->insertCommand("selesai", $from);
                                    $this->send_msg($from, "Data yang Anda cari berdasarkan nomor Aju tidak ditemukan. Periksa kembali status pengajuan Anda di menu lacak informasi dan pastikan Anda telah sampai pada proses Single Certificate");
                                    $this->send_msg2($from, "Anda telah sampai pada akhir sesi ini. Apa yang ingin Anda lakukan?\\n", constant("temp6"));
                                } else {
                                    // echo json_encode("Anda telah memasukkan nomor aju ekspor Anda, berikut adalah nomor sertifikat Anda " . $nomorSertif->no_sertifikat);
                                    $this->insertCommand("nomor aju eks", $from);
                                    $this->send_msg($from, "Berdasarkan nomor Aju Ekspor yang Anda masukkan, berikut adalah nomor sertifikat Anda " . $nomorSertif->no_sertifikat);
                                    $this->send_msg2($from, "Anda telah sampai pada akhir sesi ini. Apa yang ingin Anda lakukan?\\n", constant("temp6"));
                                }
                                break;
                            default:
                                // echo json_encode("Ulangi masukkan");
                                $this->insertCommand("maaf", $from);
                                $this->send_msg2($from, "Maaf, Nomor Aju yang Anda masukkan tidak sesuai. Periksa kembali Nomor Aju Anda dan silahkan masukkan kembali", constant("temp7"));
                        }
                        break;

                        // DOMAIN MASUK ==========
                    case str_contains($lastRow->command, "dm_no_sertif"):
                        $selectPPK = $this->selectPPK(strtoupper($pesan));
                        // $selectIDPPK = $this->selectIDPPK(strtoupper($pesan));
                        switch (true) {
                            case str_contains($pesan, "menu sebelumnya"):
                                // echo json_encode("Menu sebelumnya");
                                $this->send_msg3($from, "Pelayanan Sertifikat Ekspor memiliki tiga jenis fitur yang dapat diajukan menggunakan nomor aju PPK, yang manakah kebutuhan Anda? ", constant("temp4"));
                                break;
                            case str_contains(strtoupper($pesan), $selectPPK->no_aju_ppk):
                                $nomorSertif = $this->getNoIjin(strtoupper($pesan));
                                if ($nomorSertif == false) {
                                    // echo json_encode("Pesan tidak ditemukan");
                                    $this->insertCommand("selesai", $from);
                                    $this->send_msg($from, "Data yang Anda cari berdasarkan nomor Aju tidak ditemukan. Periksa kembali status pengajuan Anda di menu lacak informasi dan pastikan Anda telah sampai pada proses Single Certificate");
                                    $this->send_msg2($from, "Anda telah sampai pada akhir sesi ini. Apa yang ingin Anda lakukan?\\n", constant("temp6"));
                                } else {
                                    // echo json_encode("Anda telah memasukkan nomor aju ekspor Anda, berikut adalah nomor sertifikat Anda " . $nomorSertif->no_sertifikat);
                                    $this->insertCommand("nomor aju imp", $from);
                                    $this->send_msg($from, "Berdasarkan nomor Aju Impor yang Anda masukkan, berikut adalah nomor sertifikat Anda " . $nomorSertif->no_sertifikat);
                                    $this->send_msg2($from, "Anda telah sampai pada akhir sesi ini. Apa yang ingin Anda lakukan?\\n", constant("temp6"));
                                }
                                break;
                            default:
                                // echo json_encode("Ulangi masukkan");
                                $this->insertCommand("maaf", $from);
                                $this->send_msg2($from, "Maaf, Nomor Aju yang Anda masukkan tidak sesuai. Periksa kembali Nomor Aju Anda dan silahkan masukkan kembali", constant("temp7"));
                        }
                        break;

                        // case str_contains($lastRow->command, "maaf"):
                        // $this->send_msg($from, "Maaf, pilih sesuai menu yang ada");
                        // $this->send_msg_maaf($from);
                        // echo json_encode($this->send_msg_maaf($from));
                        // break;


                    default:
                    case str_contains($lastRow->command, "maaf"):
                        switch (true) {
                            case str_contains($pesan, "menu utama"):
                                $this->insertCommand("halo", $from);
                                // echo json_encode("Menu utama");
                                $this->send_msg3($from, "Selamat Datang di layanan Halo Mpok Siti, Media Pelayanan Online Karantina Simpel dan Terintegrasi, apa yang ingin Anda ketahui ? \\n", constant("temp1"));
                                break;
                            // case str_contains($pesan, "coba lagi"):
                            //     // $this->insertCommand("selesai", $from);
                            //     // echo json_encode("Selesai");
                            //     $this->deleteCommand($from);
                            //     $this->send_msg($from, "Silahkan masukkan inputan sesuai perintah sebelumnya 🤗");
                            //     break;
                            case str_contains($pesan, "hubungi cs"):
                                $this->insertCommand("selesai", $from);
                                // echo json_encode("hubungi customer service");
                                $this->send_msg($from, "Anda akan dihubungkan ke layanan customer support kami, mohon tunggu hingga pesan selanjutnya. Terimakasih telah menggunakan layanan chatbot mpok Siti");
                                $this->send_msg_admin($cs, $from);
                                break;
                            default:
                                $this->send_msg2($from, "*Halo disana!*\\n Bagaimana pengalamanmu menggunakan layanan Halo Mpok Siti?\\n\\nAnda telah mengalami error sebanyak 2 kali atau lebih, kami mohon maaf yang sebesar-besarnya mengingat layanan ini masih dalam tahap uji coba. Kami sarankan Anda untuk menggunakan layanan Hubungi Customer Service dibawah ini untuk pengalaman yang lebih baik. Kami akan bantu Anda menyelesaikan masalah Anda sebaik yang kami bisa\\n", constant("temp10"));
                        }
                        // $this->send_msg($from, "Maaf, kami tidak paham pesan yang Anda masukkan, ketik halo untuk kembali ke menu utama");
                }
            }
        }
        file_put_contents($file, $data, FILE_APPEND | LOCK_EX);
        exit;
    }
}