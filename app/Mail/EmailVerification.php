<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class EmailVerification extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $token;

    public function __construct(User $user, $token)
    {
        $this->user = $user;
        $this->token = $token;
    }

    public function build()
    {
        $transport = Mail::getSwiftMailer()->getTransport();

        if ($transport instanceof \Swift_SmtpTransport) {
            $transport->setStreamOptions(['ssl' => ['verify_peer' => false, 'verify_peer_name' => false]]);
        }

        return $this->subject('Verificação de Email')
            ->from(env('MAIL_USERNAME'), env('MAIL_FROM_NAME'))
            ->to($this->user->email)
            ->view('page.verificacao-email')
            ->withSwiftMessage(function ($message) {
                $message->getHeaders()
                    ->addTextHeader('Content-Type', 'text/html');
            });
    }
}
