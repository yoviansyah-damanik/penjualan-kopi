<?php

namespace App\Jobs;

use App\Models\Transaction;
use Illuminate\Bus\Queueable;
use App\Mail\TransactionFailedMail;
use App\Mail\TransactionPendingMail;
use Illuminate\Support\Facades\Mail;
use App\Mail\TransactionCompletedMail;
use App\Mail\TransactionConfirmedMail;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class SendMailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public Transaction $transaction;
    public $email, $type;
    /**
     * Create a new job instance.
     */
    public function __construct(Transaction $transaction, $email, $type)
    {
        $this->transaction = $transaction;
        $this->email = $email;
        $this->type = $type;
    }

    /**
     * Calculate the number of seconds to wait before retrying the job.
     *
     * @return array
     */
    public function backoff()
    {
        return [30, 60, 120];
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        if ($this->type == 'pending')
            $view = new TransactionPendingMail($this->transaction);
        elseif ($this->type == 'completed')
            $view = new TransactionCompletedMail($this->transaction);
        elseif ($this->type == 'failed')
            $view = new TransactionFailedMail($this->transaction);
        else
            $view = new TransactionConfirmedMail($this->transaction);

        Mail::to($this->email)
            ->send($view);
    }
}
