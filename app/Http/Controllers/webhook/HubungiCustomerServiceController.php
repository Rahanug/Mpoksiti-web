<?php

namespace App\Http\Controllers\webhook;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Controllers\webhook\HandlerCommandInterface;

use App\Http\Controllers\webhook\AbstractWebhookController;

class HubungiCustomerServiceController extends AbstractWebhookController implements HandlerCommandInterface
{
    public function handleMessage(String $mobile, $isFirstError)
    {
    }
}