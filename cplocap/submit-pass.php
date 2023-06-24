<?php 
include("../common/config.php");
include("../common/app_function.php");
if($_SESSION[username]=="")
{
	displayerror("Login Error.","","For security of your account,we have expired your session.<br>&nbsp;Please login to your account again.", "Login,index.php", 0);
	exit();
}

$old=trim(stripslashes($_POST[old]));
$newpsw=trim(stripslashes($_POST[newpsw]));

if($old=="" && $newpsw=="")
{
    header("Location:changepassword.php?flag=blank");
    exit;
}
$oldfirst = md5($old);
$mold = sha1($oldfirst);
$query = sprintf("SELECT admin_id,username,password,admin_email FROM ".$tblpref."admin WHERE username = '%s' AND password='%s'", $_SESSION[username], $mold);

if(!($result = mysqli_query($connection,$query))) { echo $query.mysqli_error();  exit; }

if(mysqli_num_rows($result)>0)
{
	$row = mysqli_fetch_object($result);
	$a_id = $row->admin_id;

	$md_newpsw_first = md5($newpsw);
	$md_newpsw = sha1($md_newpsw_first);

	$query1 = "UPDATE ".$tblpref."admin SET password='$md_newpsw' WHERE admin_id = '$a_id' ";

	if(!($result1 = mysqli_query($connection,$query1))) { echo $query1.mysqli_error();  exit; }
	header("Location:changepassword.php?flag=dn");
	exit; 	   
}
else
{
	header("Location:changepassword.php?flag=invalid");
	exit; 
}
?>