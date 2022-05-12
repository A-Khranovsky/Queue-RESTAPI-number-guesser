<?php

namespace App\Http\Controllers;

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
        return $this->queueControllerService->show($request);
    }

    public function start(Request $request)
    {
        return $this->queueControllerService->start($request);
    }

    public function clear()
    {
        return $this->queueControllerService->clear();
    }

    public function total()
    {
        return $this->queueControllerService->total();
    }
}
