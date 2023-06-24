<?php 
@session_start();
include("../common/config.php");
include("../common/app_function.php");
require_once "../common/recaptchalib.php";
if($_POST["g-recaptcha-response"]=="")
{?>
	<body onload="document.frm.submit();">
		<form name="frm" method="GET" action="index.php">
			<input type="hidden" name="flag" value="captcha">
		</form>
	</body>
	<?php
	exit;
}
/*$response = null;
$recaptcha = new ReCaptcha($recaptcha_secret);
if ($_POST["g-recaptcha-response"]) 
{
	$response = $recaptcha->verifyResponse(
		$_SERVER["REMOTE_ADDR"],
		$_POST["g-recaptcha-response"]
	);
}
if ($response->success!=1) { ?>
	<body onload="document.frm.submit();">
		<form name="frm" method="GET" action="index.php">
			<input type="hidden" name="flag" value="captcha">
		</form>
	</body>
	<?php
	exit();
 }*/

	$username= $_POST['username'];
	$password= $_POST['password'];
	
		// Your code here to handle a successful verification

		$nwpsw_first = md5($password);
		$nwpsw = sha1($nwpsw_first);
		$table_name = $tblpref."admin";
		$condition = sprintf("username='%s' AND password='%s'",$username, $nwpsw);
		$rowcount  = count_table_record($connection,$table_name,$condition,$orderby="",__FILE__,__LINE__);
		if($rowcount > 0)
		{
			$column_set = "*";
			$table_name = $tblpref."admin";
			$row  = select_single_record($connection,$table_name,$column_set,$condition,__FILE__,__LINE__);
			if(($username!=$row['username']) || ($nwpsw!=$row['password']))
			{
				$n=$row['logincount'];
				$n=$n+1;

				if($row['logincount']< 5)
				{
					$upd_fealds = sprintf("logincount='%d'",$n);
					$condition = sprintf("username='%s'",$username);
					$table_name = $tblpref."admin";
					update_record($connection,$table_name,$upd_fealds,$condition,__FILE__,__LINE__);
					header("Location:index.php?flag=invalid");
					exit;
				}
				else
				{
					$condition = sprintf("username='%s'",$username);
					$table_name = $tblpref."admin";
					$count  = count_table_record($connection,$table_name,$condition,$orderby="",__FILE__,__LINE__);
					
					if($count>0)
					{
						$column_set = "username,admin_email";
						$table_name = $tblpref."admin";
						$row = select_single_record($connection,$table_name,$column_set,$condition,__FILE__,__LINE__);
						$strmemail=$row['admin_email'];
						$struname=$row['username'];
						
						$nwpwd = rand(5,10);
						$nwpwdhsh = md5($nwpwd);
						$nwpwdhsh = sha1($nwpwdhsh);

						$upd_fealds = "password='$nwpwdhsh'";
						$condition = sprintf("admin_email='%s'",$row['admin_email']);
						$table_name = $tblpref."admin";
						update_record($connection,$table_name,$upd_fealds,$condition,__FILE__,__LINE__);

						$strmesstype="Password Found";
						$ouremail="$sitename";

						$strdetail="Dear $struname,\r\nWe are pleased to inform that your Password had been changed.\r\n\nYour Username is - $struname\r\nYour Password is - $nwpwd\r\n\nRegards\r\nSite Admin\r\$sitename\r\n";	
						@mail($strmemail,"$strmesstype-$HTTP_HOST",$strdetail,"from:$ouremail\nmime-version: 1.0\ncontent-type: text/plain");
					}
					header("Location:index.php?flag=failed");
					exit;
				}		
			}
			else
			{
				
				$_SESSION['user_type']=stripslashes($row['user_type']);
				$_SESSION['admin_name']=stripslashes($row['admin_name']);
				$_SESSION['admin_type']=stripslashes($row['admin_type']);
				$_SESSION['admin_id']=stripslashes($row['admin_id']);

				$upd_fealds = "logincount='0'";
				$condition = sprintf("admin_id='%d'",$row['admin_id']);
				$table_name = $tblpref."admin";
				update_record($connection,$table_name,$upd_fealds,$condition,__FILE__,__LINE__);

				$ins_fealds = sprintf("log_uid='%d', log_date=CURDATE(), log_time=CURTIME()",$row['admin_id']);
				$table_name = $tblpref."login_log";
				$inserted_id = add_record($connection,$table_name,$ins_fealds,__FILE__,__LINE__);

				
					$_SESSION['username']=stripslashes($row['username']);
					header("Location:home.php");


					?>
					<body onload="document.frm.submit();">
						<form name="frm" method="GET" action="home.php">
						</form>
					</body>
					<?php
					exit();
				
			}
		}
		else
		{
			$condition = sprintf("username='%s'",$username);
			$column_set = "*";
			$table_name = $tblpref."admin";
			$row = select_single_record($connection,$table_name,$column_set,$condition,__FILE__,__LINE__);

			$n=$row['logincount'];
			$n=$n+1;

			if($row['logincount']< 5)
			{
				$upd_fealds = sprintf("logincount='%d'",$n);
				$condition = sprintf("admin_id='%s'",$row['admin_id']);
				$table_name = $tblpref."admin";
				update_record($connection,$table_name,$upd_fealds,$condition,__FILE__,__LINE__);

				@ header("Location:index.php?flag=invalid");
				exit;
			}
			else
			{
				$condition = sprintf("username='%s'",$username);
				$table_name = $tblpref."admin";
				$count  = count_table_record($connection,$table_name,$condition,$orderby="",__FILE__,__LINE__);
				if($count>0)
				{
					$column_set = "username,admin_email,admin_id";
					$table_name = $tblpref."admin";
					$row = select_single_record($connection,$table_name,$column_set,$condition,__FILE__,__LINE__);
					
					$strmemail=$row['admin_email'];	
					$struname=$row['username'];
					
					$nwpwd = str_rand();
					$nwpwdhsh = md5($nwpwd);
					$nwpwdhsh = sha1($nwpwdhsh);

					$upd_fealds = "password='$nwpwdhsh'";
					$condition = "admin_id='$row[admin_id]'";
					$table_name = $tblpref."admin";
					update_record($connection,$table_name,$upd_fealds,$condition,__FILE__,__LINE__);

					$strmesstype="Password Found";
					$ouremail="$sitename";

					$strdetail="Dear $struname,\r\nWe are pleased to inform that your Password had been changed.\r\n\nYour Username is - $struname\r\nYour Password is - $nwpwd\r\n\nRegards\r\nSite Admin\r\$sitename\r\n";	
					@mail($strmemail,"$strmesstype-$HTTP_HOST",$strdetail,"from:$ouremail\nmime-version: 1.0\ncontent-type: text/plain");
				}
				header("Location:index.php?flag=failed");
				exit;
			}
		}
	

?>