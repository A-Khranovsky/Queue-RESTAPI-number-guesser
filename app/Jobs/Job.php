<?php

namespace App\Jobs;

use App\Events\FailedJobEvent;
use App\Events\SuccessJobEvent;
use App\Events\TryJobEvent;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Throwable;

class Job implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $args = [];
    protected string $transaction;
    protected int $guessNumber;
    protected int $randNumber;
    public $tries = 100;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($args = [])
    {
        $this->args = $args;
        if (isset($args['tries'])) {
            $this->tries = $args['tries'];
        }
        $this->guessNumber = $args['number'] ?? 50;
        $this->transaction = time();
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $this->randNumber = mt_rand(1, 100);
        event(new TryJobEvent($this->randNumber, $this->transaction));
        if ($this->randNumber != $this->guessNumber) {
            throw new \Exception('Trying failed. Number ' . $this->randNumber . ' is not ' . $this->guessNumber);
        } else {
            event(new SuccessJobEvent($this->randNumber, $this->transaction));
        }
    }

    public function failed(Throwable $throwable)
    {
        event(new FailedJobEvent($this->randNumber, $this->transaction, $throwable->getMessage()));
    }

    public function backoff()
    {
        return $this->args['backoff'] ?? 0;
    }
}
