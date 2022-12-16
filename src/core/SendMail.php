<?php

namespace Certify\Certify\core;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception as MailException;

class SendMail{
    private $mail;
    private $username = "apscecollege@gmail.com";
    private $password = "xnubuquoylifnwdf";

    public function __construct()
    {
        $this->mail = new PHPMailer(true);

        $this->mail->isSMTP();
        $this->mail->Host = "smtp.gmail.com";
        $this->mail->SMTPAuth = true;
        $this->mail->Username = $this->username;
        $this->mail->Password = $this->password;
        $this->mail->SMTPSecure = "ssl";
        $this->mail->Port = 465;

        $this->mail->setFrom($this->username);
    }

    public function send($email, $subject, $body, $is_html = false){
        try{
            $this->mail->addAddress($email);
            $this->mail->isHTML($is_html);
            $this->mail->Subject = $subject;
            $this->mail->Body = $body;

            $this->mail->send();

            return ["result" => true];
        }catch(MailException $e){
            return ["result" => false];
        }
    }
}