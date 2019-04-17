<?php

namespace App\Http\Controllers\Test;

use App\Http\Controllers\Controller;
use App\Services\MessageBroker\Broker;
use Illuminate\Http\Request;

class MessageBrokerController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Send Message to Message Broker
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function send(Request $request)
    {
        // Create Message broker instance
        $broker = new Broker(config('message-broker'));
        // Send message
        $isSent = $broker->send($request->all());

        $statusCode = $isSent ? 200 : 400;
        $message = $isSent ? 'sent' : 'failed';

        return response()->json([
            'code' => $statusCode,
            'message' => $message,
            'data' => null
        ], $statusCode);
    }

}
