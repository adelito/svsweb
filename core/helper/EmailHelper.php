<?php

namespace core\helper;

use core\config\SystemCoreConfig;
use core\component\PHPMailer\src\Exception;
use core\component\PHPMailer\src\OAuth;
use core\component\PHPMailer\src\PHPMailer;
use core\component\PHPMailer\src\POP3;
use core\component\PHPMailer\src\SMTP;

/**
 * Classe Helper de Email
 * @package core
 * @subpackage helper
 * @author Judá Passos <juda.santos@educacao.ba.gov.br>
 */
class EmailHelper {

  
    public static function enviar($assunto, $conteudo, $emailRemetente, $nomeRemetente, $emailDestinatario, $isHtml = true, $prioridade = 3, $emailCopia = null, $emailCopiaOculta = null) {

        $mail = new PHPMailer(true);

        try {

            $mail->SMTPDebug = SystemCoreConfig::EMAIL_SMTP_DEBUG;
            $mail->isSMTP();
            $mail->Host = SystemCoreConfig::EMAIL_SERVIDOR;
            $mail->SMTPAuth = SystemCoreConfig::EMAIL_SMTP_AUTENTICACAO;
            $mail->Port = SystemCoreConfig::EMAIL_PORTA;
            $mail->CharSet = 'utf-8';

            $mail->setFrom($emailRemetente, $nomeRemetente);
            $mail->addAddress($emailDestinatario);   

            $mail->isHTML($isHtml);
            $mail->Subject = $assunto;
            $mail->Body = $conteudo;
            
            $mail->send();
        } catch (\Exception $e) {
             throw new \Exception("Não foi Possível realizar o envio do e-mail");
//            echo 'Ocorreu um erro!', $mail->ErrorInfo;
        }
    }

    public static function aplicarTemplatePadrao($conteudo, $logo = 'http://www.sec.ba.gov.br/assinatura-expresso.png') {
        return '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
                <html xmlns="http://www.w3.org/1999/xhtml">
                  <head>
                    <meta charset="utf-8"> <!-- utf-8 works for most cases -->
                    <meta name="viewport" content="width=device-width"> <!-- Forcing initial-scale shouldn"t be necessary -->
                    <meta http-equiv="X-UA-Compatible" content="IE=edge"> <!-- Use the latest (edge) version of IE rendering engine -->
                    <title></title> <!-- The title tag shows in email notifications, like Android 4.4. -->
                </head>
                <body bgcolor="#194e91" width="100%" style="Margin: 0;">
                    <center style="width: 100%; background: #194e91;">

                    <!-- Email Header : BEGIN -->
                    <table cellspacing="0" cellpadding="0" border="0" align="center" width="600" style="margin: auto;" class="email-container">
                        <tr>
                            <td style="padding: 20px 0; text-align: center">&nbsp;</td>
                       </tr>
                    </table>

                    <!-- Email Body : BEGIN -->
                    <table cellspacing="0" cellpadding="0" border="0" align="center" bgcolor="#ffffff" width="600" style="margin: auto;" class="email-container">
                        <tr>
                            <td width="100%" height="172" align="center">
                                    <img src="'.$logo.'"  alt="alt_text" width="40%"  height="auto" border="0" align="center" style="display:inline-block" >
                            </td>
                        </tr>
                        <tr>
                            <td style="padding: 30px; padding-top:0px; text-align: center; font-family: sans-serif; font-size: 15px; mso-height-rule: exactly; line-height: 20px; color: #555555;">                    
                                '.$conteudo.'
                                <br><br>
                            </td>
                        </tr>
                    </table>

                    <!-- Email Footer : BEGIN -->
                    <table cellspacing="0" cellpadding="0" border="0" align="center" width="600" style="margin: auto;" class="email-container">
                        <tr>
                            <td style="padding: 20px 0; text-align: center">&nbsp;</td>
                        </tr>
                    </table>
                </center>
            </body>
            </html>
            ';
    }
    
    
    public function isValid($email) {        
        return filter_var($email, FILTER_VALIDATE_EMAIL) ? TRUE : FALSE;        
    }

}

?>
