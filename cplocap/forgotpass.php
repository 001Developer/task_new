<?php
@session_start();
include("../common/config.php");
if($_SESSION[username]!="")
{
	$_SESSION[username]="";
}
include("../common/app_function.php");

if($_GET[flag]=="blank")
{
	$msg="<div class='alert alert-danger' role='alert'>Please enter Username/Email Id.</div>";
}
if($_GET[flag]=="invalid")
{
	$msg="<div class='alert alert-danger' role='alert'>Username OR Email Id Invalid.</div>";
}
if($_GET[flag]=="sent")
{
	$msg="<div class='alert alert-danger' role='alert'>Your credentials has been sent to your Email-id.</div>";
}
if($_GET[flag]=="captcha")
{
	$msg="<div class='alert alert-danger' role='alert'>Please show you are human.</div>";
}
admin_header("../",$title,$tblpref,$db,$sitepath,$siteurl,$path1,$ckpath,$row_admin); ?>
<div class="container">
		<div class="row">
	
		<div class="col-sm-8 col-sm-offset-2 col-md-4 col-md-offset-4">
			<div class="login-panel panel panel-default">
				
				<div class="panel-heading"> Forget Password</div>
				
				<div class="panel-body">
					<form METHOD=POST ACTION="submit-forgotpass.php" name="forgot" onsubmit="log()">
						<fieldset>
						    <?if($_GET[flag]!="")
							{?>
								<?=$msg?>
							<?php } ?>
							<div class="form-group">
								<input class="form-control" placeholder="Username" name="username" id="username" type="text"  onBlur="notnulls(this.id);">
							</div>
							<div style="margin-top:1px;color:#000;text-align:center;font-weight:bold;">OR</div>
							<div class="form-group">
								<input name="emailid" id="emailid" placeholder="Email Id" class="form-control" title="Email Id" value="" size="30" onBlur="validEmails(this.id);" />
							</div>

							 <div class="form-group">
								<a href="index.php" class="btn btn-default">Admin Login</a>
							</div> 

							<div class="form-group">
								<button class="btn btn-primary" type="submit">Submit</button>
							</div>
						</fieldset>
					</form>
				</div>
			</div>
		</div><!-- /.col-->
	</div><!-- /.row -->	
</div>
<SCRIPT LANGUAGE="JavaScript">
<!--
function log()
{
	var res = forgot();
	if(res==true)
	{
		document.forgot.submit();
	}
	else
	{
		return false;
	}
}
forgot = function () {
	var result = new Array();
	result[0] = notnulls('username');
	result[1] = validEmails('emailid');
	
	
	if(result[0]==false && result[1]==false)
	{
		return false;
	}
	else{return true;	}
}
notnulls = function (id) {
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
validEmails = function(id) {
	var email = document.getElementById(id).value;
	if(email == "") {
		document.getElementById(id).style.border="1px solid #FF0000";	
		//document.getElementById(id).style.backgroundColor  = "#ff0000";
		//document.getElementById(id).focus();
		return false;
	}
	
	if(email != "") { 
	
		var emailExp = /^[\w\-\.\+]+\@[a-zA-Z0-9\.\-]+\.[a-zA-z0-9]{2,4}$/;
		if(!(email.match(emailExp)))
		{
			document.getElementById(id).style.border="1px solid #FF0000";	
			//document.getElementById(id).style.backgroundColor  = "#ff0000";
			//document.getElementById(id).focus();
			return false;
		}
		else
		{
			document.getElementById(id).style.border="1px solid #0D2C52";
			return true;   
		}
	}
}
//-->
</SCRIPT>
	
</body>

</html>