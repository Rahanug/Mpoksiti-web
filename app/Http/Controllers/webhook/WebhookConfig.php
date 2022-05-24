<?php

namespace App\Http\Controllers\webhook;


class WebhookConfig
{
    const BASE_URL = 'https://multichannel.qiscus.com/whatsapp/v1/teslu-h7a83pux7kepxqs/2167/messages';

    const MESSAGE_CONFIG = array(
        CURLOPT_URL => self::BASE_URL,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_HTTPHEADER => array(
            'Qiscus-App-Id: teslu-h7a83pux7kepxqs',
            'Qiscus-Secret-Key: fc79da7fa276099ec0cc54bd3e46e69a',
            'content-type: application/json'
        )
    );

    const MESSAGE_TYPE_BUTTON = "Button";

    const MESSAGE_TYPE_POPUP = "Popup";
}