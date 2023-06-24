<?php
@session_start();
include("../common/config.php");
include("../common/app_function.php");
if($_SESSION[username]=="")
{
	displayerror("Login Error.","","For security of your account,we have expired your session.<br>&nbsp;Please login to your account again.", "Login,index.php", 0);
	exit();
}

if($_GET[flag]=="dn")
{
	$msg="<div class='alert alert-success' role='alert'>Password Edited Successfully!!</div>";
}
if($_GET[flag]=="invalid")
{
	$msg="<div class='alert alert-danger' role='alert'>Entered password is wrong!!</div>";
}

admin_header('../',"Change Password",$tblpref,$db,$sitepath,$siteurl,$path1,$ckpath,$row_admin);
admin_nav('../',"Edit Admin Info",$tblpref,$db,$sitepath,$siteurl,$path1,$ckpath,$row_admin,$connection); ?>
<div class="col-md-9 col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">	
<div class="row">
		<ol class="breadcrumb">
		<li><a href="home.php"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
		<li class="active">Change Password</li>
		</ol>
	</div><!--/.row-->
	<div class="row">
		<div class="col-lg-12">
			<h1 class="page-header">Change Password</h1>
		</div>
	</div><!--/.row-->
	<?=$msg;?>
	<div class="row">
		<div class="col-lg-12" >
			<div class="panel panel-default">
				<div class="panel-heading"><span class="glyphicon glyphicon-pencil"></span>Change Password<div class="pull-right">
				
				
				<a href="home.php"><button type="button" class="btn btn-default btn-sm">
				<span class="glyphicon glyphicon-circle-arrow-left"></span>Back 
				</button></a>
				</div></div>
					 
			   <div class="panel-body">
				<form action="submit-pass.php" method="POST" name="frmadmn" onSubmit="return validpass();">
				    
					<div class="col-md-6">
						 <div class="form-group">
							 <label>Old Password <font color="#ff0000">* </font> :</label>
							 <input type="password" name="old" id="old" class="form-control" required />
						 </div><!--form gorup--->
						 <div class="form-group">
							  <label>New Password <font color="#ff0000">* </font> :</label>
							  <input type="password" name="newpsw" id="newpsw" class="form-control"  required/>
						 </div>
						 <div class="form-group">
							  <label>Re-Enter New Password <font color="#ff0000">* </font> :</label>
							  <input type="password" name="rnew" id="rnew" class="form-control" required />
						 </div>
						 <div class="form-group">
							  <input type="submit" class="btn btn-primary" value="Change Password" name="submit">
						 </div>
					</div>				
				</form>			  
	</div><!--/.row-->	
</div><!-- /.col-->
		
<SCRIPT LANGUAGE="JavaScript">
<!--
function validpass()
{
	old = document.getElementById('old').value;
	psw = document.getElementById('newpsw').value;
	rpsw = document.getElementById('rnew').value;
	if(old == "")
	{
		document.getElementById('old').style.padding = "2px 3px";
		document.getElementById('old').style.border  = "1px solid #ff0000";
		window.setTimeout(function () { document.getElementById('old').focus();}, 0);
		return false;
	}
	
	if(psw == "")
	{
		document.getElementById('newpsw').style.padding = "2px 3px";
		document.getElementById('newpsw').style.border  = "1px solid #ff0000";
		window.setTimeout(function () { document.getElementById('newpsw').focus();}, 0);
		return false;
	}
	
	if(rpsw == "")
	{
		document.getElementById('rnew').style.padding = "2px 3px";
		document.getElementById('rnew').style.border  = "1px solid #ff0000";
		window.setTimeout(function () { document.getElementById('rnew').focus();}, 0);
		return false;
	}
	
	if(psw != "" && rpsw!="")
	{
		match();
	}
	
}
function match(id)
{
	psw = document.getElementById('newpsw').value;
	rpsw = document.getElementById('rnew').value;
	if(rpsw!="")
	{
		if(psw != rpsw)
		{
			document.getElementById('rnew').style.padding = "2px 3px";
			document.getElementById('rnew').style.border  = "1px solid #ff0000";
			alert("Password Mismatch");
			window.setTimeout(function () { document.getElementById('rnew').focus();}, 0);
			return false;
		}
		else
		{
			document.getElementById('rnew').style.padding = "2px 3px";
			document.getElementById('rnew').style.border  = "1px solid #A5ACB2";
			return true;
		}
	}
	else
	{
		document.getElementById('rnew').style.padding = "2px 3px";
		document.getElementById('rnew').style.border  = "1px solid #ff0000";
	}
}	
//-->
</SCRIPT>
	
<?php admin_footer('../'); ?>