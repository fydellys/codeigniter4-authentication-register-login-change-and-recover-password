<?php

use CodeIgniter\Email\Email;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

function SendMailPhpMailer($from, $fromName, $to, $toName, $subject, $message, $attach = null)
{

    $mail = new PHPMailer;

    $mail->isSMTP();
    $mail->Host     = Settings('phpmailer_host');
    $mail->SMTPAuth = true;
    $mail->Username = Settings('phpmailer_username');
    $mail->Password = Settings('phpmailer_password');
    $mail->SMTPSecure = Settings('phpmailer_secure');
    $mail->Port     = Settings('phpmailer_port');
    $mail->CharSet = Settings('phpmailer_charset');

    $mail->setFrom($from, $fromName);
    $mail->addReplyTo($from, $fromName);
    $mail->addAddress($to,$toName);
    $mail->Subject = $subject;
    $mail->isHTML(true);

    $msg['message'] = $message;

    $mailContent = view('mail/mail_layout', $msg);
    $mail->Body = $mailContent;

    if($mail->send())
        return true;
    else
        return false;

}

function SendMail($from, $fromName, $to, $toName, $subject, $message, $attach = null)
{

    $email = \Config\Services::email();

    $config['smtp_host'] = Settings('email_host');
    $config['smtp_user'] = Settings('email_username');
    $config['smtp_pass'] = Settings('email_password');
    $config['protocol'] = Settings('email_secure');
    $config['smtp_port']= Settings('email_port');
    $config['charset'] = Settings('email_charset');   
    $config['wordwrap'] = TRUE;
    $config['mailtype'] = 'html';
    $config['smtp_timeout']='30';
    $config['newline'] = '\r\n';

    $email->initialize($config);
    
    $email->setFrom($from, $fromName);
    $email->setTo($to);
    $email->setSubject($subject);

    $msg['message'] = $message;

    $mailContent = view('mail/mail_layout', $msg);
    $email->setMessage($mailContent);

    if($attach)
        $email->attach($attach);

    if($email->send())
        return true;
    else
        return false;
}
