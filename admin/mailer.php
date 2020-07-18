<?php

date_default_timezone_set('Etc/UTC');

// Edit this path if PHPMailer is in a different location.
require 'PHPMailerAutoload.php';

$mail = new PHPMailer;
$mail->isSMTP();

/*
 * Server Configuration
 */

$mail->Host = 'smtp.gmail.com'; // Which SMTP server to use.
$mail->Port = 587; // Which port to use, 587 is the default port for TLS security.
$mail->SMTPSecure = 'tls'; // Which security method to use. TLS is most secure.
$mail->SMTPAuth = true; // Whether you need to login. This is almost always required.
$mail->Username = "jaketuriacada@gmail.com"; // Your Gmail address.
$mail->Password = "ryokaobodo35"; // Your Gmail login password or App Specific Password.

/*
 * Message Configuration
 */

$mail->setFrom('jaketuriacada@gmail.com', 'Awesome Website'); // Set the sender of the message.
$mail->addAddress('emeka.obodomechine@yahoo.com', 'John Doe'); // Set the recipient of the message.
$mail->Subject = 'PHPMailer GMail SMTP test22'; // The subject of the message.

/*
 * Message Content - Choose simple text or HTML email
 */
 
// Choose to send either a simple text email...
$mail->Body =  "<html> 
 <p>

 Hello dear <b style='color:blue;'>$c_name</b> you have ordered some products on our website https://ecommerse-stage.000webhostapp.com, please find your order details, your order will be processed shortly. Thank you!</p>

     <table width='600' align='center' bgcolor='#FFCC99' border='2'>

         <tr align='center'><td colspan='6'><h2>Your Order Details from onlinetuting.com</h2></td></tr>
        
         <tr align='center'>
             <th><b>S.N</b></th>
             <th><b>Product Name</b></th>
             <th><b>Quantity</b></th>
             <th><b>Paid Amount</th></th>
             <th>Invoice No</th>
         </tr>
        
         <tr align='center'>
             <td>1</td>
             <td>test</td>
             <td>3</td>
             <td>3000</td>
             <td>8463877929092</td>
         </tr>

     </table>
    
     <h3>Please go to your account and see your order details!</h3>
    
     <h2> <a href='https://ecommerse-stage.000webhostapp.com'>Click here</a> to login to your account</h2>
    
     <h3> Thank you for your order @ - https://ecommerse-stage.000webhostapp.com</h3>
    
 </html>

"; // Set a plain text body.

// ... or send an email with HTML.
//$mail->msgHTML(file_get_contents('contents.html'));
// Optional when using HTML: Set an alternative plain text message for email clients who prefer that.
//$mail->AltBody = 'This is a plain-text message body'; 

// Optional: attach a file
$mail->addAttachment('images/phpmailer_mini.png');

if ($mail->send()) {
    echo "Your message was sent successfully!";
} else {
    echo "Mailer Error: " . $mail->ErrorInfo;
}
