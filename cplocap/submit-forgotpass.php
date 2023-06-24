<?php
include("../common/config.php");
include("../common/app_function.php");
require_once('../pjmail/pjmail.class.php'); 
 $struname=trim(stripslashes($_POST[username]));
 $stremail=trim(stripslashes($_POST[emailid]));


if($struname=="" and $stremail=="")
{
    header("Location:forgotpass.php?flag=blank");
    exit;
}
//admin_id 	username 	password 	admin_email
if($struname!="" && $stremail!="")   
{
	 $query = sprintf("SELECT username,admin_email FROM ".$tblpref."admin WHERE username = '%s' AND admin_email = '%s'", $struname, $stremail);exit;
 }
elseif($struname!="")   
{
		$query = sprintf("SELECT username,admin_email FROM ".$tblpref."admin WHERE username = '%s'", $struname);
}
elseif($stremail!="")
{
	  $query = sprintf("SELECT username,admin_email FROM ".$tblpref."admin WHERE admin_email = '%s'", $stremail);
}
if(!($result = mysqli_query($connection,$query))) { echo $query.mysqli_error();  exit; }

if(mysqli_num_rows($result)>0)
{
	$row=mysqli_fetch_object($result);
	
	$strmemail=$row->admin_email;	
	//$strpassword=$row->a_pass;
	$struname=$row->username;
	
	$nwpwd = str_rand();
	$nwpwdhsh_first = md5($nwpwd);
	$nwpwdhsh = sha1($nwpwdhsh_first);

	 $query_up = sprintf("UPDATE ".$tblpref."admin SET password='%s' WHERE admin_email = '%s'", $nwpwdhsh, $strmemail);
	if(!($result_up = mysqli_query($connection,$query_up))) { echo $query_up.mysqli_error();  exit; }

	$strmesstype="Password Found";
	$ouremail=$adminemail;

	$strdetail="Dear ".$struname.",<br/>";
	$strdetail .="We are pleased to inform that your Password had been found.<br/>";
	$strdetail .="Your Username is - ".$struname."<br/>";
	$strdetail .="Your Password is - ".$nwpwd."<br/><br/>";
	$strdetail .="Regards<br/>";
	$strdetail .="<br/>Site Admin<br/>Fours<br/>";	

	
	$fromEmail = "webmaster@fours.co.bw";
		$fromName = "Webmaster";


		$mail = new PJmail(); 
		$mail->setAllFrom($mail_from_email, $mail_from_name); 
		$mail->addrecipient($strmemail); 
		$mail->addsubject($strmesstype); 
		$mail->html = $strdetail; 
		$res = $mail->sendmail(); 
		
		/*$maill = new PHPMailer;
		$maill->isSMTP();
		$maill->SMTPDebug = 0;
		$maill->Debugoutput = 'html';
		$maill->Host = $smtp_host;
		$maill->SMTPAuth = true;
		$maill->Username = $smtp_username;
		$maill->Password = $smtp_password;
		$maill->setFrom($fromEmail, $fromName);
		$maill->addReplyTo($fromEmail, $fromName);
		$maill->addAddress($strmemail,'Admin');
		$maill->Subject = $strmesstype;
		$maill->msgHTML($strdetail);
		$maill->AltBody = '';
		if (!$maill->send()) {
		//echo "Mailer Error: " . $maill->ErrorInfo;
		} else {
		//echo "Message sent!";
		}*/

	header("Location:forgotpass.php?flag=sent");
	exit;
		   
}
else
{
	header("Location:forgotpass.php?flag=invalid");
	exit; 
}
?>