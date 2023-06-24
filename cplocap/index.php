<?php
@session_start();
include("../common/config.php");
if($_SESSION['username']!="")
{
	$_SESSION['username']="";
}
include("../common/app_function.php");

/*$alltables = mysqli_query($connection,"SHOW TABLES");
while ($table = mysqli_fetch_assoc($alltables))
{
   foreach ($table as $db => $tablename)
   {
			$qry_optimize = "OPTIMIZE TABLE ".$tablename."";
			if(!($res_optimize = mysqli_query($connection,$qry_optimize)))
			{
				echo $qry_optimize.mysqli_error();
				exit();
			}
			$qry_repair = "REPAIR TABLE ".$tablename."";
			if(!($res_repair = mysqli_query($connection,$qry_repair)))
			{
				echo $qry_repair.mysqli_error();
				exit();
			}
	}
}*/


if($_GET['flag']=="blank")
{
	$msg="<div class='alert alert-danger' role='alert'>Please enter Username/Email Id.</div>";
}
if($_GET['flag']=="invalid")
{
	$msg="<div class='alert alert-danger' role='alert'>Username OR Email Id Invalid.</div>";
}
if($_GET['flag']=="sent")
{
	$msg="<div class='alert alert-danger' role='alert'>Your credentials has been sent to your Email-id.</div>";
}
if($_GET['flag']=="captcha")
{
	$msg="<div class='alert alert-danger' role='alert'>Please show you are human.</div>";
}
admin_header("../",$title,$tblpref,$db,$sitepath,$siteurl,$path1,$ckpath,$row_admin); ?>
<div class="container">
	<div class="row">
	
		<div class="col-sm-8 col-sm-offset-2 col-md-4 col-md-offset-4">
			<div class="login-panel panel panel-default">
				<div class="panel-heading"> Log in</div>
				
				
				
				<div class="panel-body">
					<form METHOD="POST" ACTION="submit-login.php" name="login" onsubmit="return log()">
						<fieldset>
						    <?php 
							if($_GET['flag']!="")
							{ ?>
								<?php echo $msg; ?>
							<?php } ?>
							<div class="form-group">
								<input class="form-control" placeholder="Username" name="username" type="text" autofocus="" onBlur="notnulls(this.id);">
							</div>
							<div class="form-group">
								<input class="form-control" placeholder="Password" name="password" type="password" value="" onBlur="notnulls(this.id);">
							</div>
                       <div class="form-group">
			                   <script src='https://www.google.com/recaptcha/api.js'></script>
							   <div class="g-recaptcha" data-sitekey="<?php echo $recaptcha_site?>"></div><br/>
							</div>

							<input type="hidden" name="userval" id="userval" value="<?php echo $userval;?>">
							<button class="btn btn-primary" type="submit">Login</button>
							<a href="forgotpass.php" class="btn btn-default">Forgot Password</a>
						</fieldset>
					</form>
				</div>
			</div>
		</div><!-- /.col-->
	</div><!-- /.row -->
</div>
	<SCRIPT LANGUAGE="JavaScript">
<!--

function log() {
	var result = new Array();
	result[0] = notnulls('username');
	result[1] = notnulls('password');
	//result[2] = notnulls('captcha');


	var count = 0;
	while(count < 2) {
		if(result[count++] == false) {
			return false;
			break;
		}
	}
	return true;	
}
function notnulls(id) {
	var result = document.getElementById(id).value;
	if(result == "") {
		document.getElementById(id).style.padding = "5px 4px 5px 3px";
		document.getElementById(id).style.border  = "1px solid #ff0000";
		//document.getElementById(id).style.backgroundColor  = "#ff0000";
		return false;
	}
	else {
		document.getElementById(id).style.padding = "5px 4px 5px 3px";
		document.getElementById(id).style.border  = "1px solid #0D2C52";
		return true;
	}
}
//-->
</SCRIPT>
<?php admin_footer('../'); ?>