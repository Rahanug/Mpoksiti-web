<?php

namespace App\Http\Controllers\webhook;

use App\Http\Controllers\Controller;

use App\Models\CommandModel;

use App\Http\Controllers\webhook\WebhookConfig;

abstract class AbstractWebhookController extends Controller
{
    use ButtonTrait;
    use QueryTrait;

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

    function sendSorryMessage($mobile, $isFirstError)
    {
        if ($isFirstError) {
            $this->sendMsg(
                $mobile,
                "*Halo disana!*\n Bagaimana pengalamanmu menggunakan layanan Halo Mpok Siti?\n\nAnda telah mengalami error sebanyak 2 kali atau lebih, kami mohon maaf yang sebesar-besarnya mengingat layanan ini masih dalam tahap uji coba. Kami sarankan Anda untuk menggunakan layanan Hubungi Customer Service dibawah ini untuk pengalaman yang lebih baik. Kami akan bantu Anda menyelesaikan masalah Anda sebaik yang kami bisa\n",
                [
                    $this->getSingleButtonReply("reply", "Ulang", "Menu Utama"),
                    $this->getSingleButtonReply("reply", "CS", "Hubungi CS")
                ],
                WebhookConfig::MESSAGE_TYPE_BUTTON

            );
        } else {
            $this->sendMsg($mobile, "Maaf pilih sesuai dengan menu yang ada", []);
        }
    }
}