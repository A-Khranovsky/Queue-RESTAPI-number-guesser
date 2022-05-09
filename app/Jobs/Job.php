<?php

namespace App\Jobs;

use App\Events\FailedJobEvent;
use App\Events\SuccessJobEvent;
use App\Events\TryJobEvent;
use App\Models\Param;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\Middleware\ThrottlesExceptions;
use Illuminate\Queue\SerializesModels;
use Throwable;

class Job implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $args = [
        'backoff' => 0,
        'tries' => 100,
        'guessNumber' => 50,
        'thrtlExcept' => [
                'excptCount' => '',
                'waitMin' => '',
            ]
    ];
    protected string $transaction;
    protected int $randNumber;
    protected int $idParam;
    public $tries = 100;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($args)
    {
        if (sizeof($args) > 0) {
            $this->args = array_merge($this->args, $args);
            $this->tries = $this->args['tries'];
        }
        $param = Param::create([
            'params' => json_encode($this->args),
            'startDateTime' => date("Y-m-d H:i:s")
        ]);
        $this->idParam = $param->id;
        $this->transaction = time();

//        $fp = fopen('/var/www/app/qq.txt', 'w');
//        fwrite($fp, print_r(sizeof($args), TRUE));
//        fclose($fp);
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $this->randNumber = mt_rand(1, 100);
        event(new TryJobEvent($this->randNumber, $this->args['guessNumber'], $this->transaction, $this->idParam));
        if ($this->randNumber != $this->args['guessNumber']) {
            throw new \Exception('Trying failed. Number ' . $this->randNumber . ' is not ' . $this->args['guessNumber']);
        } else {
            event(new SuccessJobEvent($this->randNumber, $this->args['guessNumber'], $this->transaction, $this->idParam));
        }
    }

    public function failed(Throwable $throwable)
    {
        event(new FailedJobEvent($this->randNumber, $this->args['guessNumber'], $this->transaction, $throwable->getMessage(), $this->idParam));
    }

    public function backoff()
    {
        return $this->args['backoff'];
    }

    public function middleware()
    {
        if (sizeof($this->args['thrtlExcept']) > 0) {
            return [new ThrottlesExceptions
            (
                $this->args['thrtlExcept']['excptCount'], $this->args['thrtlExcept']['waitMin']
            )];
        }
    }

//    public function retryUntil()
//    {
//        return now()->addMinutes(2);
//    }
}
