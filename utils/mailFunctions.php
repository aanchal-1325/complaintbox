<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
require_once '../vendor/autoload.php';

function sendUpdate($email,$message){
    $mail = new PHPMailer(true);
try {
    $mail->SMTPDebug = 0;               
    $mail->isSMTP();                                
    $mail->Host='smtp.gmail.com';   
    $mail->SMTPAuth   = true;                                 
    $mail->Username='complaintbox.avishkar2022@gmail.com';          
    $mail->Password='snbnvqppfmjnjuyi';
    //'wyjhzdclewluguye-new';                        
    $mail->SMTPSecure = 'tls';            
    $mail->Port= 587;
    $mail->setFrom('complaintbox.avishkar2022@gmail.com');
    $mail->addAddress($email);
    $mail->isHTML(true);                                  
    $mail->Subject ='Update!, From ComplaintBox.';
    $mail->Body =$message;
    if($mail->send()){
        return true;
    }else{
        return false;
    }
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error:";
}
}
function sendMail($name,$email,$subject,$content){
$mail = new PHPMailer(true);
try {
    //Server settings
    $mail->SMTPDebug = 0;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host='smtp.gmail.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username='complaintbox.avishkar2022@gmail.com';                     //SMTP username
    $mail->Password='snbnvqppfmjnjuyi';
    //'wyjhzdclewluguye-new';
    //;                               //SMTP password
    $mail->SMTPSecure = 'tls';            //Enable implicit TLS encryption
    $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
    //Recipients
	$mail->setFrom('complaintbox.avishkar2022@gmail.com');
	$mail->addAddress('monishksg@gmail.com');
    //Attachments
    // $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
    // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name
    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = $subject;
    $mail->Body = 'Name : ' . $name . " \n";
    $mail->Body = $mail->Body . 'Email : ' . $email . " \n";
    $mail->Body = $mail->Body . 'Query : ' . $content;
    if($mail->send()){
        return true;
    }else{
        return false;
    }
  //  echo 'Message has been sent';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error:";
}
}

//sendMail("monishksg@gmail.com","this is Subject","text mail from complaint box");

function registrationMail($userName,$email){

    $mail = new PHPMailer(true);
try {
    //Server settings
    $mail->SMTPDebug = 0;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host='smtp.gmail.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username='complaintbox.avishkar2022@gmail.com';                     //SMTP username
    $mail->Password='snbnvqppfmjnjuyi';
    //'wyjhzdclewluguye-new';
    //;                               //SMTP password
    $mail->SMTPSecure = 'tls';            //Enable implicit TLS encryption
    $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
    //Recipients
    $mail->setFrom('complaintbox.avishkar2022@gmail.com','COMPLAINT BOX');
    $mail->addAddress($email);
    //Attachments
    // $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
    // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name
    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject ="Registration Successful!!";
    $mail->Body = 'Hey! ' . $userName . " \n";
    $mail->Body = $mail->Body." \n". 'Thank you for registering! We look forward to seeing your complaint' ." \n";
    if($mail->send()){
        return true;
    }else{
      return false;
    }
  //  echo 'Message has been sent';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error:";
}


}
?>