<?php

namespace App\Http\Controllers\webhook;

interface HandlerCommandInterface
{
    public function handleMessage(
        String $mobile,
        String $command,
        String $pesan,
        Bool $isFirstError
    );
}