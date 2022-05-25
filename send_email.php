<?php
use PHPMailer\PHPMailer\PHPMailer; // path to the PHPMailer class.
 
$fm = "premanong.bot@gmail.com"; // *** ต้องใช้อีเมล์ @gmail.com เท่านั้น ***
$to = "prem-anong@hotmail.com"; // อีเมล์ที่ใช้รับข้อมูลจากแบบฟอร์ม
$custemail = $_POST['email']; // อีเมล์ของผู้ติดต่อที่กรอกผ่านแบบฟอร์ม
 
$subj = "ผู้ใช้งานเว็ปไซต์ต้องการติดต่อของรับการใช้บริการ";
 
/* ------------------------------------------------------------------------------------------------------------- */
$message = "ชื่อ-นามสกุล: ".$_POST['first-name']." ".$_POST['last-name']."\n";
$message.= "เบอร์ติดต่อ: ".$_POST['phone']."\n";
$message.= "อีเมล์ที่ต้องการให้ติดต่อกลับ: ".$_POST['email']."\n";
$message.= "รายละเอียด: ".$_POST['message:']."\n";
/* ------------------------------------------------------------------------------------------------------------- */


$mesg = $message;

require_once "PHPMailer/PHPMailer.php";
require_once "PHPMailer/SMTP.php";
require_once "PHPMailer/Exception.php";
 
$mail = new PHPMailer();
$mail->CharSet = "utf-8"; 
 
/* ------------------------------------------------------------------------------------------------------------- */
/* ตั้งค่าการส่งอีเมล์ โดยใช้ SMTP ของ Gmail */
$mail->IsSMTP();
$mail->Mailer = "smtp";
$mail->IsSMTP(); // telling the class to use SMTP
$mail->SMTPAuth = true;                  // enable SMTP authentication
$mail->SMTPSecure = "tls";                 // sets the prefix to the servier
$mail->Host = "smtp.gmail.com";      // sets GMAIL as the SMTP server
$mail->Port = 587;                   // set the SMTP port for the GMAIL server
$mail->Username = "premanong.bot@gmail.com";  // Gmail Email username
$mail->Password = "premanong11999";            // App Password not Gmail password
/* ------------------------------------------------------------------------------------------------------------- */
 
$mail->From = $fm;
$mail->AddAddress($to);
$mail->AddReplyTo($custemail);
$mail->Subject = $subj;
$mail->Body     = $mesg;
$mail->WordWrap = 50;  
//
if(!$mail->Send()) {
echo 'Message was not sent.';
echo '<script>alert("ส่งข้อมูลไม่สำเร็จ");location.href="contact.php";</script>'. $mail->ErrorInfo;
exit;
} else {
echo '<script>alert("ส่งข้อมูลสำเร็จ");location.href="contact.php";</script>';
}
?>