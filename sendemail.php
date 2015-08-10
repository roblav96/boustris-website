<?php
    require 'phpmailer/PHPMailerAutoload.php';

    function errorMe() {
        header("Location: http://boustrisandsons.com/sent-error.html");
        // header("Location: /sent-error.html");
        // echo "error";
        die;
    }

    function validatez($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        $data = substr($data, 0, 2048);
        if( strlen($data) == 0 ) {
            errorMe();
        }
        return $data;
    }

    $radio = validatez($_POST['radioOptions']);
    $name = validatez($_POST['name']);
    $email = validatez($_POST['email']);
    $company = validatez($_POST['company']);
    $title = validatez($_POST['title']);
    $phone = validatez($_POST['phone']);
    $phonetype = validatez($_POST['phoneOptions']);
    $msg = validatez($_POST['msg']);

    $captcha;
    if(isset($_POST['g-recaptcha-response'])){
      $captcha=$_POST['g-recaptcha-response'];
    }
    if(!$captcha){
      errorMe();
    }
    
    $response=file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=6LdtdgoTAAAAAHRSsAgAtqZXuCCknZIMjrlwGaeL&response=".$captcha."&remoteip=".$_SERVER['REMOTE_ADDR']);
    // echo $response;
    if($response.success==false)
    {
      errorMe();
    }

    $mail = new PHPMailer;
    $mail->isSMTP();
    $mail->Host = 'relay-hosting.secureserver.net';

    // $mail->From = 'robboustris@gmail.com';
    $mail->FromName = 'Boustris Request Form';
    $mail->addAddress('rob@boustrisandsons.com');

    $mail->addCC('bob@boustrisandsons.com');
    $mail->addCC('jim@boustrisandsons.com');
    $mail->addCC('heather@boustrisandsons.com');
    $mail->addCC('henry@boustrisandsons.com');
    $mail->addCC('mike@boustrisandsons.com');
    $mail->addCC('nicole@boustrisandsons.com');


    $mail->isHTML(true);

    $mail->Subject = $company . " - " . $radio;

    // echo $company . " - " . $radio;



    $mail->Body = "Name: " . $name . "<br>Title: " . $title . "<br>Company: " . $company . "<br>Email: " . $email . "<br>Phone: " . $phone . "<br>Type: " . $phonetype . "<br><br>" . $msg;
    // $mail->Body = 'Name: ' . $name . "<br>" . 'Title: ' . $title . "<br>" . 'Company: ' . $company . "<br>" . 'Email: ' . $email . "<br><br>" . $msg;
    // echo $msg;

    // echo "Name: " . $name . "<br>Title: " . $title . "<br>Company: " . $company . "<br>Email: " . $email . "<br>Phone: " . $phone . "<br>Type: " . $phonetype . "<br><br>" . $msg;



    if(!$mail->send()) {
        errorMe();
    } else {
        header("Location: http://boustrisandsons.com/sent.html");
        die;
        // header("Location: /sent.html");
    }

    die;
?>
