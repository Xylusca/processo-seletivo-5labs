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

    protected $user;
    protected $token;
    protected $isPasswordReset;

    public function __construct(User $user, $token, $isPasswordReset = false)
    {
        $this->user = $user;
        $this->token = $token;
        $this->isPasswordReset = $isPasswordReset;
    }

    public function build()
    {
        $transport = Mail::getSwiftMailer()->getTransport();

        if ($transport instanceof \Swift_SmtpTransport) {
            $transport->setStreamOptions(['ssl' => ['verify_peer' => false, 'verify_peer_name' => false]]);
        }

        $subject = $this->isPasswordReset ? 'Recuperação de Senha' : 'Verificação de Email';
        $view = $this->isPasswordReset ? 'email.recuperar-senha' : 'email.verificacao-email';

        return $this->subject($subject)
            ->from(env('MAIL_USERNAME'), env('MAIL_FROM_NAME'))
            ->to($this->user->email)
            ->view($view)
            ->with([
                'user' => $this->user,
                'token' => $this->token,
            ])
            ->withSwiftMessage(function ($message) {
                $message->getHeaders()
                    ->addTextHeader('Content-Type', 'text/html');
            });
    }
}
