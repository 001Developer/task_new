<?php

@session_start();

include("../../common/config.php");

include("../../common/app_function.php");



if($_SESSION['username']=="")

{

	displayerror("Login Error.","","For security of your account,we have expired your session.<br>&nbsp;Please login to your account again.", "Login,../index.php", 0);

	exit();

}



$flag=$_GET['flag'];



admin_header('../../','CSV Import',$tblpref,$db,$sitepath,$siteurl,$path1,$ckpath,$row_admin);

admin_nav('../../','CSV Import',$tblpref,$db,$sitepath,$siteurl,$path1,$ckpath,$row_admin,$connection, $cur_moduel);



$directory = "../";

$files = glob($directory . "*");

foreach($files as $file)

{

	 if(is_dir($file))

	 {

			$modules[]=str_replace("../","",$file);

	 }

}

?>

<div class="col-md-9 col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main"  ng-app="sortApp" ng-controller="mainController" >			

<!--body start -->

	

	<div class="row">

		<a href="index.php" title="Back"><div class="frt"><i class="fa fa-arrow-circle-left fa-3x "></i></div></a>

		<ol class="breadcrumb">

			<li><a href="../home.php"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>

			<li class="active">CSV Import</li>

		</ol>

	</div><!--/.row-->

	<div class="row">

		<div class="col-lg-12">

			<h4 class="page-header">CSV Import</h4>

		</div>

	</div><!--/.row-->

	<?php
		if($flag=="add")
		{ ?>
			<div class="row">
				<div class="col-lg-2">&nbsp;</div>
				<div class="col-lg-8">
					<div class="alert bg-success" role="alert">
					<svg class="glyph stroked checkmark"><use xlink:href="#stroked-checkmark"></use></svg> CSV Imported Successfully</a>
				</div>
				<div class="col-lg-2"></div>
				</div>
			</div>
		<?php
		}
		if($flag=="del")
		{ ?>
			<div class="row">
				<div class="col-lg-2">&nbsp;</div>
				<div class="col-lg-8">
					<div class="alert bg-danger" role="alert">
					<svg class="glyph stroked cancel"><use xlink:href="#stroked-cancel"></use></svg> Error Occure !!</a>
				</div>
				<div class="col-lg-2"></div>
				</div>
			</div>
		<?php
		}
	?>







				<div class="clear"></div>

				<div class="row">
					<div class="col-md-4">&nbsp;</div>

					<div class="col-md-4 text-center pt-5">



					<form method="POST"  action="submit.php" enctype="multipart/form-data"> 	

						<div class="form-group">


								<input type="file" name="file" class="form-control"/>

						</div>
						<div class="form-group">  
                                <input type="submit" class="btn btn-primary" name="importSubmit" value="Import CSV">

						</div>	
									

								

							</div>  

				    </div>  

			</form>     

			

		</div>

		

	</div>

</div>

</div>

<?admin_footer()?>