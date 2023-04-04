<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\User;
use App\Models\Training;

class TrainingCreated extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public $training;

    public function __construct(Training $training)
    {
        $this->training = $training;
    }

    

    public function build()
    {
        return $this->view('training-mailable')
        ->subject('Training Created Email using Mailable Class');
    }
}
