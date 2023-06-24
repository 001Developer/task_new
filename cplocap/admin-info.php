<?php
@session_start();
include("../common/config.php");
include("../common/app_function.php");
if($_SESSION[username]=="")
{
	displayerror("Login Error.","","For security of your account,we have expired your session.<br>&nbsp;Please login to your account again.", "Login,index.php", 0);
	exit();
}

$query=sprintf("SELECT * FROM ".$tblpref."admin WHERE username='%s'", $_SESSION[username]); 
if(!($result=mysqli_query($connection,$query))){ echo $query.mysqli_error(); exit;}
$row_add=mysqli_fetch_array($result);


if($_GET[flag]=="edit")
{
	$msg="<div class='alert alert-success' role='alert'>Admin Info Edited Successfully!!</div>";
}

admin_header('../',"Edit Admin Info",$tblpref,$db,$sitepath,$siteurl,$path1,$ckpath,$row_admin);

admin_nav('../',"Edit Admin Info",$tblpref,$db,$sitepath,$siteurl,$path1,$ckpath,$row_admin,$connection); ?>
<div class="col-md-9 col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">	

<div class="row">
		<ol class="breadcrumb">
		<li><a href="home.php"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
		<li class="active">Admin Info</li>
		</ol>
	</div><!--/.row-->
	<div class="row">
		<div class="col-lg-12">
			<h1 class="page-header">Admin Info</h1>
		</div>
	</div><!--/.row-->
	<?=$msg;?>
	<div class="row">
		<div class="col-lg-12" >
			<div class="panel panel-default">
				<div class="panel-heading"><span class="glyphicon glyphicon-user"></span>Edit <div class="pull-right">
				
				
				<a href="home.php"><button type="button" class="btn btn-default btn-sm">
				<span class="glyphicon glyphicon-circle-arrow-left"></span>Back 
				</button></a>
				</div></div>
					 
			   <div class="panel-body">
				<form action="submit-admininfo.php" method="POST" name="frmadmn" onSubmit="return admninfo();">
				    
					<div class="col-md-6">
						 <div class="form-group">
							 <label>Username <font color="#ff0000">* </font> :</label>
							 <input type="text" name="username" id="username" value="<?php echo stripslashes($row_add[username])?>" class="form-control" required />
						 </div><!--form gorup--->
						 <div class="form-group">
							  <label>Email Id <font color="#ff0000">* </font> :</label>
							  <input type="text" name="emailid" id="emailid" value="<?php echo stripslashes($row_add[admin_email])?>" class="form-control" required />
						 </div>
						 <div class="form-group">
							  <label>Admin Name <font color="#ff0000">* </font> :</label>
							  <input type="text" name="name" id="name" value="<?php echo stripslashes($row_add[admin_name])?>" class="form-control" required />
						 </div>
						 <div class="form-group">
							  <input type="hidden" name="aid" value="<?php echo $row_add[admin_id]?>">
							  <input type="submit" class="btn btn-primary"  name="submit">
						 </div>
					</div>				
				</form>			  
	</div><!--/.row-->	
</div><!-- /.col-->
		

	
</body>

</html>
<script src="../js/jquery-1.11.1.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
<script type="text/javascript" src="../js/jquery.mousewheel-3.0.6.pack.js"></script>
<script type="text/javascript" src="../source/jquery.fancybox.js?v=2.1.5"></script>
<script src="../js/bootstrap-datepicker.js"></script>
<script src="../js/bootstrap-table.js"></script>
<script src="../js/chart.min.js"></script>
<script src="../js/chart-data.js"></script>
<script src="../js/easypiechart.js"></script>
<script src="../js/easypiechart-data.js"></script>