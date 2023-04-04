<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Mail;
use App\Models\Training;

class SendEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $training;

    public function __construct(Training $training)
    {
        $this->training = $training;
    }

    /**
     * Execute the job.
     */
    public function handle()
    {
        Mail::to('azh@email.com')->send(new \App\Mail\TrainingCreated($this->training));
    }
}
