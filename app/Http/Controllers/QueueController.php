<?php

namespace App\Http\Controllers;

use App\Http\Resources\LogsResource;
use App\Jobs\Job;
use App\Models\Log;
use App\Models\Param;
use App\Services\QueueControllerServiceInterface;
use Illuminate\Http\Request;

class QueueController extends Controller
{
    protected $queueControllerService;

    public function __construct(QueueControllerServiceInterface $queueControllerService)
    {
        $this->queueControllerService = $queueControllerService;
    }

    public function show(Request $request)
    {
        $this->queueControllerService->show($request);
    }

    public function start(Request $request)
    {
        $this->queueControllerService->start($request);
    }

    public function clear()
    {
        $this->queueControllerService->clear();
    }

    public function total()
    {
        $this->queueControllerService->total();
    }
}
