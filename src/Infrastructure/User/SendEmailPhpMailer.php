<?php

namespace Project\System\Infrastructure\User;

use Exception;
use PHPMailer\PHPMailer\PHPMailer;
use Project\System\Application\User\SendEmail\SendEmail;

class SendEmailPhpMailer implements SendEmail
{
    public function send(string $addresses, string $subject, string $body, string|array $attachments = [],
        string|array $ccs = [], string|array $bccs = []): bool
    {
        $mail = new PHPMailer(true);
    
            try {
            //Acceso SMTP
            $mail->isSMTP(true);
            $mail->Host       = getenv('SMTP_HOST');
            $mail->SMTPAuth   = true;
            $mail->Username   = getenv('SMTP_USER');
            $mail->Password   = getenv('SMTP_PASS');
            $mail->SMTPSecure = getenv('SMTP_SECURE');
            $mail->Port       = getenv('SMTP_PORT');
            $mail->CharSet    = getenv('SMTP_CHARSET');

            //Remetente
            $mail->setFrom(
                getenv('SMTP_FROM_EMAIL'),
                getenv('SMTP_FROM_NAME')
            );

            //Destinatário
            $addresses = is_array($addresses) ? $addresses : [$addresses];
            foreach($addresses as $address){
                $mail->addAddress($address);
            }

            //Anexos
            $attachments = is_array($attachments) ? $attachments : [$attachments];
            foreach($attachments as $attachment){
                $mail->addAttachment($attachment);
            }

            //cc
            $ccs = is_array($ccs) ? $ccs : [$ccs];
            foreach($ccs as $cc){
                $mail->addCC($cc);
            }

            //bcc
            $bccs = is_array($bccs) ? $bccs : [$bccs];
            foreach($bccs as $bcc){
                $mail->addBCC($bcc);
            }

            //Conteudo do self
            $mail->isHTML(true);
            $mail->Subject = $subject;
            $mail->Body = $body;

            return $mail->send();
        } catch (\Exception $e) {
            throw new Exception('Ocorreu um erro ao enviar o e-mail.');
        }
    }
}