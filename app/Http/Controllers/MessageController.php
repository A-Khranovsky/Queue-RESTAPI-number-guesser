<?php

namespace App\Http\Controllers;

use App\Jobs\MessageJob;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function receiveMessage(Request $request)
    {
        MessageJob::dispatch($request->message);
        return response($request->message ,200);
    }
}
