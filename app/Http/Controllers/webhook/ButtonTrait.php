<?php

namespace App\Http\Controllers\webhook;

use App\Http\Controllers\webhook\WebhookConfig;


trait ButtonTrait
{

    public function getSingleButton($title, $id, $description)
    {

        $data['title'] = $title;

        $row["id"] = $id;

        $row["title"] = $title;

        $row["description"] = $description;

        $data["rows"] = [$row];

        return $data;
    }

    public function getSingleButtonReply($type, $id, $title)
    {

        $data['type'] = $type;

        $reply["id"] = $id;

        $reply["title"] = $title;

        $data["reply"] = $reply;

        return $data;
    }


    public function sendMsg(
        $mobile,
        $msg,
        $arrOfButton,
        $type = null
    ) {

        $curl = curl_init();

        $arrayConfig = WebhookConfig::MESSAGE_CONFIG;

        $type = $type ?? "standard";

        switch ($type) {
            case WebhookConfig::MESSAGE_TYPE_BUTTON:
                $data['recipient_type'] = "individual";
                $data['to'] = "$mobile";
                $data['type'] = "interactive";
                $data['interactive']['type'] = "button";
                $data['interactive']['header']['type'] = "text";
                $data['interactive']['header']['text'] = "Layanan Mpok Siti";
                $data['interactive']['body']['text'] = "$msg";
                $data['interactive']['footer']['text'] = "Pilih sesuai dengan kebutuhan Anda";
                $data['interactive']['action']['buttons'] = $arrOfButton;
                break;

            case WebhookConfig::MESSAGE_TYPE_POPUP:
                $data['recipient_type'] = "individual";
                $data['to'] = "$mobile";
                $data['type'] = "interactive";
                $data['interactive']['type'] = "list";
                $data['interactive']['header']['type'] = "text";
                $data['interactive']['header']['text'] = "Layanan Mpok Siti";
                $data['interactive']['body']['text'] = "$msg";
                $data['interactive']['footer']['text'] = "Pilih sesuai dengan kebutuhan Anda";
                $data['interactive']['action']['button'] = "Pilih Menu";
                $data['interactive']['action']['sections'] = $arrOfButton;
                break;

            default:
                $data['recipient_type'] = "individual";
                $data['to'] = "$mobile";
                $data['type'] = "text";
                $data['text']['body'] = "$msg";
                break;
        }

        $arrayConfig += array(CURLOPT_POSTFIELDS => json_encode($data));

        curl_setopt_array($curl, $arrayConfig);

        $response = curl_exec($curl);

        // curl_exec($curl);

        curl_close($curl);
        echo $response;
        echo json_encode($data);
    }
}