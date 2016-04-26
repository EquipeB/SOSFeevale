<?php

/**
 * emailHelper
 * Disparos de e-mails autenticados.
 * @copyright (c) Setembro, 2015, Anderson B. Glaeser - F5 Digital
 */
class mailHelper {
    public function sendMail($mensagem, $assunto, $destinatario, $anexo = null){

        require_once('complements/phpmailer/class.phpmailer.php');

        $mail = new PHPMailer(); // defaults to using php "mail()"
        $conteudo = eregi_replace("[\]",'',$mensagem);
        
        $mail->IsSMTP();
        $mail->Host       = "smtp.fitwellnh.com.br";
        $mail->SMTPDebug  = 0;
        $mail->SMTPAuth   = true;
        $mail->Host       = "smtp.fitwellnh.com.br";
        $mail->Port       = 587;
        $mail->Username   = "ads@f5digital.com.br";
        $mail->Password   = "wm6hz053";

        $mail->SetFrom('ads@f5digital.com.br', 'Academia Fitwell NH');
        $mail->AddReplyTo('contato@f5digital.com.br', 'Academia Fitwell NH');
        $mail->AddAddress($destinatario);
        $mail->Subject    = $assunto;
        $mail->AltBody    = "Para visualizar esta mensagem, ative a visualização por HTML!";
        $mail->MsgHTML($conteudo);
        if($anexo != ''){
            $mail->AddAttachment($anexo);
        }

        if(!$mail->Send()) {
            return $mail->ErrorInfo;
        } else {
            return "E-mail enviado com sucesso.";
        }
    }
}