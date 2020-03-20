<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
class PHPMail
{

  
  protected $ci;

  public function __construct()
  {
        $this->ci =& get_instance();
  }

  public function generate($email, $subject, $body, $att="")
  {
    require_once './vendormailer/autoload.php';
    $mail = new PHPMailer(true);
      try {
          //Server settings
          $mail->SMTPDebug = 2;                                       // Enable verbose debug output
          $mail->isSMTP();                                            // Set mailer to use SMTP
          $mail->Host       = 'smtp.gmail.com';  // Specify main and backup SMTP servers
          $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
          $mail->Username   = 'ponrakka1@gmail.com';                     // SMTP username
          $mail->Password   = 'israiskandar09';                               // SMTP password
          $mail->SMTPSecure = 'tls';                                  // Enable TLS encryption, `ssl` also accepted
          $mail->Port       = 587;                                    // TCP port to connect to

          //Recipients
          $mail->setFrom('ponrakka1@gmail.com', 'Butik Tokyo');    
          // Add a recipient
          $mail->addAddress($email);               // Name is optional
          $mail->addReplyTo('ponrakka1@gmail.com', 'Butik Tokyo');

          // Attachments
          if($att!=""){
            $mail->addAttachment($att);         // Add attachments
          }

          // Content
          $mail->isHTML(true);                                  // Set email format to HTML
          $mail->Subject = $subject;
          $mail->Body    = $body;
          //$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

          $mail->send();
          //echo 'Message has been sent';
      } catch (Exception $e) {
          //echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
      }
  }

}

/* End of file PHPMail.php */
/* Location: ./application/libraries/PHPMail.php */

