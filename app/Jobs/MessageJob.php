<?php

namespace App\Jobs;

use App\Events\FailedJobEvent;
use App\Events\SuccessJobEvent;
use App\Events\TryJobEvent;
use App\Models\Log;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Hash;
use Throwable;

class MessageJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected string $message;
    protected string $transaction;
    protected int $number;
    public $backoff = 1;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($message)
    {
        $this->message = $message;
        $this->transaction = time();
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $this->number = mt_rand(1, 100);
        event(new TryJobEvent($this->number,$this->transaction));
        if ($this->number != 50) {
            throw new \Exception('Trying failed. Number ' . $this->number . ' is not 5');
        } else {
            event(new SuccessJobEvent($this->number,$this->transaction));
        }
    }

    public function failed(Throwable $throwable)
    {
        event(new FailedJobEvent($this->number,$this->transaction, $throwable->getMessage()));
    }
}
