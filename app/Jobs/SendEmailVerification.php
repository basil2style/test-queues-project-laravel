<?php

namespace App\Jobs;

use App\Models\User;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SendEmailVerification implements ShouldQueue
{
    protected $user;
    use Queueable, SerializesModels, Dispatchable, InteractsWithQueue;

    /**
     * Create a new job instance.
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        if($this->user instanceof MustVerifyEmail && ! $this->user->hasVerifiedEmail()) {
            $this->user->sendEmailVerificationNotification();
        }
    }
}
