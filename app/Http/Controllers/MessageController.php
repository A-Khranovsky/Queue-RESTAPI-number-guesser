<?php

namespace App\Http\Controllers;

use App\Http\Resources\LogsResource;
use App\Jobs\Job;
use App\Models\Log;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function show(Request $request)
    {
        if ($request->has('transaction')) {
            return LogsResource::collection(Log::where('transaction', '=', $request->get('transaction'))->get());
        }
        return LogsResource::collection(Log::all());
    }

    public function start(Request $request)
    {
        $args = [];
        $result = '';
        if ($request->has('backoff')) {
            $args['backoff'] = $request->backoff;
        }
        if ($request->has('tries')) {
            $args['tries'] = $request->tries;
        }
        if ($request->has('number')) {
            $args['number'] = $request->number;
        }
        Job::dispatch($args);
        if (!empty($args)) {
            $result = ' Args:';
            foreach ($args as $key => $arg) {
                $result .= ' ' . $key . ' = ' . $arg;
            }
        }
        return response('Started, transaction = ' . time() . $result ?? '', 200);
    }

    public function clear()
    {
        Log::truncate();
        return response('Cleared', 200);
    }

    public function total()
    {
        $total = Log::all();
        $transactions = $total->pluck('transaction')->unique();
        $result = [];
        $transactions->each(function ($item, $key) use (&$result, $total) {
            $result[] = [
                'transaction' => $item,
                'status' => $total->whereIn('transaction', $item)->pluck('status')->last(),
                'used tries' => $total->whereIn('transaction', $item)->count() - 1
            ];

        });

        return $result;
//        $statuses = $total->map(function($item, $key), use $total{
//            return $total['transaction']->whereIn() $item[$key][] = 'e';
//        });
//        $transactions = $total->pluck('transaction');
//        $result = $total->groupBy(['transaction', function ($transactions) {
//            return $transactions[0];
//        }]);
        //
        //$transactionsCount = $transactions->countBy()->all();

        //$statuses = $total->pluck('status');
        //$statuses = $statuses->countBy()->all();
        //return $transactions; //[$transactionsCount, $statuses];

    }

}
