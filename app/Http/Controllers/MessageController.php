<?php

namespace App\Http\Controllers;

use App\Http\Resources\LogsResource;
use App\Jobs\MessageJob;
use App\Models\Log;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function receiveMessage(Request $request)
    {
        if($request->message === 'Start') {
            MessageJob::dispatch($request->message);
            return response('Started' ,200);
        }
        if($request->message === 'Result') {
            return LogsResource::collection(Log::all());
        }
        return 0;
    }

}
