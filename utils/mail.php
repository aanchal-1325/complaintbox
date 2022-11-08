<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
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
    $mail->Subject ='Update!, Regarding your complaint';
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


?>