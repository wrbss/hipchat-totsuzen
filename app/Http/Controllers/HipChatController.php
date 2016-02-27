<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HipChatController extends Controller
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

    public function totsuzen(Request $request)
    {
        $item = $request->input('item');
        if (!isset($item)) {
            return self::errorJson();
        }

        $message = $item['message']['message'];
        if (!$message) {
            return self::errorJson();
        }

        $message = preg_replace('/^\/[a-zA-Z0-9]*\s/', '', $message);
        $message str_replace('\r\n', $message);

        $msg_length = mb_strwidth($message) / 2;

        $response_message = '__' . str_repeat('人', $msg_length + 2) . '__<br />'
            . '＞　' . $message . '　＜<br />'
            . '￣' . str_repeat('Y^', $msg_length) . 'Y￣';

        return response()->json([
            'color' => 'green',
            'message' => $response_message,
            'notify' => false,
            'message_format' => 'html'
        ]);
    }

    private function errorJson()
    {
        return response()->json([
            'color' => 'red',
            'message' => 'Sorry. Something went wrong.',
            'notify' => false,
            'message_format' => 'text'
        ]);
    }
}
