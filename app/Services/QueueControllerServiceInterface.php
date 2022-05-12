<?php


namespace App\Services;


use App\Http\Resources\LogsResource;
use Illuminate\Http\Request;

interface QueueControllerServiceInterface
{

    //Returns json response, uses LogResource class
    public function show(Request $request);

    public function start(Request $request);
    public function clear();
    public function total();

}
