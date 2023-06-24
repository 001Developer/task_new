<?php @session_start();

//error_reporting(E_ALL);

function index_header($title,$rewritepath,$tblpref,$db,$row_admin, $uploadpath)



{

//echo $title;exit();

	// @session_start();



	 include("config.php");
 // //include("../url_redirect.php");



	 $session_time = fileatime(session_save_path()."/sess_".session_id());



	if($_COOKIE['city']!="")



	{



		$_SESSION['city']=$_COOKIE['city'];



	}



	if($_COOKIE['branch']!="")



	{



		$_SESSION['branch']=$_COOKIE['branch'];



	}



	if(basename($_SERVER['PHP_SELF']) != "error.php")



	{



	//check if javascript is enabled or not



	//include("checkjs.php");



	}	



	//generate rendom value



	$str = str_rand();



	$table_name = $tblpref."userval";



	if(isset($_SESSION['userval']))



	{



		$userval = preg_chk($_SESSION['userval']);



		$feald_set = "*";



		$condition = sprintf("session_val='%s'",$userval);



		$rowCount  = count_table_record($connection,$table_name,$condition,__FILE__,__LINE__);



		if($rowCount < 1)



		{



			$hashval = md5($userval);



			$feals_set = sprintf("session_val='%s', session_date=CURDATE(), hash_val='%s'", $userval, $hashval);



			$id = add_record($connection,$table_name,$feals_set,__FILE__,__LINE__);



		}



	}



	else



	{



		$_SESSION['userval'] = $str;



		$userval = $_SESSION['userval'];



		$hashval = md5($userval);



		$feals_set = sprintf("session_val='%s', session_date=CURDATE(), hash_val='%s'", $userval, $hashval);



		$id = add_record($connection,$table_name,$feals_set,__FILE__,__LINE__);



	}



	// $condition = sprintf("session_date < CURDATE() OR session_date='0000-00-00'");



	// delete_record($connection,$table_name,$condition,__FILE__,__LINE__);



	// $shop_branch=$_SESSION['branch'];



	



	






	$get_url = $_SERVER["REQUEST_URI"];


	$url_parameters = explode('/',$get_url);



	$para=3;


	$function_is = $url_parameters[$para];//exit();



	?>



<!doctype html>

<html lang="en">

<head>

<meta charset="utf-8">

<meta http-equiv="X-UA-Compatible" content="IE=edge">

<meta name="viewport" content="width=device-width, initial-scale=1">

<title>Krushi</title>

<link rel="shortcut icon" href="<?php echo $rewritepath; ?>images/favicon.png">





<link href="<?php echo $rewritepath; ?>css/bootstrap.min.css" rel="stylesheet">



<!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" integrity="sha512-HK5fgLBL+xu6dm/Ii3z4xhlSUyZgTT9tuc/hSrtw6uzJOvgRr2a9jyxxT1ely+B+xFAmJKVSTbpM/CuL7qxO8w==" crossorigin="anonymous" referrerpolicy="no-referrer" /> -->



<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css">





<link href="<?php echo $rewritepath; ?>css/animate.min.css" rel="stylesheet">

<link rel="stylesheet" type="text/css" href="<?php echo $rewritepath; ?>source/jquery.fancybox.css?v=2.1.5" media="screen" /><!-- Fancy Box Popup -->

<link rel="stylesheet" type="text/css" href="<?php echo $rewritepath; ?>css/menu-styles.css" /> <!--Navigation menu-->



<!-- carousel -->

<link rel="stylesheet" type="text/css" href="<?php echo $rewritepath; ?>css/owl.carousel.min.css">

<link rel="stylesheet" type="text/css" href="<?php echo $rewritepath; ?>css/owl.theme.default.min.css">

<!-- <link rel="stylesheet" type="text/css" href="<?php //echo $rewritepath; ?>css/owl.theme.green.min.css"> -->

 <!-- carousel -->





<link href="<?php echo $rewritepath; ?>css/style-main.css" rel="stylesheet">

  </head>

  <body>



  	<!-- <div class="se-pre-con"></div> -->



  





<header id="top">

    <div class="header">

      <div class="container">

        <div class="clearfix">

        

        <div id="logo"><img src="<?php echo $rewritepath; ?>images/logo.png" alt="logo"></div>







    <!--Navigation-->

            <div id='cssmenu' class="navigation">

            <ul>

               <li <?php //if($function_is=="" || $function_is=="home") { ?> class="active" <?php //} ?>><a href='<?php echo $rewritepath; ?>home.php'>Home</a></li>

               <li <?php //if($function_is=="about") { ?> class="active" <?php //} ?>><a href='<?php echo $rewritepath; ?>about.php'>About</a></li>


               
            


                <li <?php //if($function_is=="contact-us") { ?> class="active" <?php //} ?>><a href='<?php echo $rewritepath; ?>contact-us.php'>Contact Us</a></li>

                <li <?php if($function_is=="farmer") { ?> class="active" <?php } ?>><a href='<?php echo $rewritepath; ?>farmer.php'>Farmer List</a></li> 


                <li <?php if($function_is=="PeasantRegister") { ?> class="active" <?php } ?>><a href='<?php echo $rewritepath; ?>register.php'>New Farmer Registration</a></li>
              <!--  <li><a href='#'>Registration</a> -->
               	<!-- <ul>
                 
               		<li><a onclick="register();">New Peasant Registration</a></li>
               		<li><a onclick="vender();">New Workholder Registration</a></li>
               	</ul> -->

               <!-- </li> -->

          

               <?php 

        if($_SESSION['farmer_id']=="")

        	{ ?>

        		<li class="bg-log" <?php if($function_is=="login") { ?> class="active" <?php } ?>><a href="<?php echo $rewritepath; ?>login.php"  title="Sign In" style="background: #678A0D !important; "><img src="<?php echo $rewritepath; ?>images/user.png" alt="user" class="smicon"></a></li>

        		<?php

        	}

        	elseif($_SESSION['farmer_id']!=="")

        	{ 

        		?>

	            <li class="bg-dash" <?php if($function_is=="dashboard") { ?> class="active" <?php } ?>><a href='<?php echo $rewritepath; ?>index.php/dashboard/' title="Dashboard" style="background: #678A0D !important;padding-top:none !important; "><img src="<?php echo $rewritepath; ?>images/dashboard.png" alt="Dashboard" class="smicon"></a></li>
        		<!-- <li class="bg-log"><a href="#"  title="<?php //echo $_SESSION['customer_name']; ?>"><img src="<?php //echo $rewritepath; ?>images/user.png" alt="user" class="smicon" > </a></li>  -->



        		



        		

        	<!-- <li class="bg-info"><a href="<?php //echo $rewritepath; ?>index.php/dashboard"  title="Dashboard"><img src="<?php //echo $rewritepath; ?>images/dashboard.png" alt="Dashboard" class="smicon"></a></li> -->

        

        	<?php 

        } ?>





        	<?php 

        	if($_SESSION['farmer_id']=="")

        	{ 

        	}

        	else

        	{  ?>

        		<li class="bg-logout"><a href="<?php echo $rewritepath; ?>logout.php" style="background: #678A0D !important;margin-left:20px; "><img src="<?php echo $rewritepath; ?>images/logout1.png" title="Sign Out" alt="Sign Out" 

        			class="smicon"></a></li>

        		<?php 

        	} ?>

   

            </ul>

            </div>

    

        </div>

      </div>

    </div>

</header>          



          



	







<?php



}



function index_footer($rewritepath, $tblpref, $db, $row_admin, $connection,$siteuploadpath)



{ 



include("common/config.php"); ?>


<br><br>
<footer>

  <div class="footer">

  <div class="container">

      

      <div class="footerlogo">

        <img src="<?php echo $rewritepath; ?>images/logo.png" alt="logo" class="img-fluid d-block mx-auto">

      </div>



      <div class="footer-inforight">

        <div class="social-icons">

          <a href="#" target="_blank" class="fa fa-facebook fa-1x" title="facebook"></a>

          <a href="#" target="_blank" class="fa fa-twitter fa-1x" title="twitter"></a>

          <a href="#" target="_blank" class="fa fa-linkedin fa-1x" title="linkedin"></a>

          <a href="#" target="_blank" class="fa fa-youtube-play fa-1x" title="youtube"></a>

        </div>

      </div>



      <ul class="footlist">

          <li><a href="<?php echo $rewritepath; ?>index.php/home/">Home</a> |</li>

         <li><a href='<?php echo $rewritepath; ?>index.php/home/about.php'>About</a> |</li>

           <li> <a href='<?php echo $rewritepath; ?>index.php/home/farmer.php'>Farmer List</a></li> 

         <li><a href='<?php echo $rewritepath; ?>Contact.php'>Contact Us</a></li>

        </ul>


<div class="footend">
      <div class="footlt">Copyright &copy; 2022 All Rights Reserved</div>

      <div class="footrt">Designed &amp; Developed by Project Team For Mini Project</div>

      <div class="clear"></div>
</div>




    </div>

  </div>

</footer>






<!-- 

<div id="back-top"><a href="#top"><span></span></a> </div> -->



    <script src="<?php echo $rewritepath; ?>js/jquery-2.2.4.min.js"></script>

    <script src="<?php echo $rewritepath; ?>js/self.js?v=1"></script>

    <!-- <script src="js/jquery-3.6.0.min.js"></script> -->


<script src="<?php echo $rewritepath; ?>js/jquery.preloaders.js"></script>




    <!--Bootstrap Bundle with Popper -->

    <script src="<?php echo $rewritepath; ?>js/bootstrap.bundle.min.js"></script>




    <script src="<?php echo $rewritepath; ?>js/topscroll.js"></script>


    <script type="text/javascript" src="<?php echo $rewritepath; ?>js/jquery.mousewheel-3.0.6.pack.js"></script>


    <script src="<?php echo $rewritepath; ?>source/jquery.fancybox.js?v=2.1.5"></script><!-- Fancy Box Popup -->

    <script src="<?php echo $rewritepath; ?>js/scrolla.jquery.min.js"></script><!--Animate JS-->

    <script src="<?php echo $rewritepath; ?>js/menu-script.js"></script><!--Navigation menu-->

    <script src="<?php echo $rewritepath; ?>js/wow.min.js"></script>



    <script src="<?php echo $rewritepath; ?>js/owl.carousel.min.js"></script>





    <!-- loading -->

<script>



  //$(document).ready(function() { /*when js&css load*/



  $(window).load(function() { 

    // Animate loader off screen

    $(".se-pre-con").fadeOut("slow");

  });

</script>











    <script src="<?php echo $rewritepath; ?>js/main.js"></script>

    <!-- <script src="http://code.jquery.com/jquery-latest.js"></script> -->


    



  </body>

</html>





<?php



mysqli_close($connection);



}



function admin_header($path2,$title,$tblpref,$db,$sitepath,$siteurl,$path1,$ckpath,$row_admin)



{	



include ("config.php");?>



<!DOCTYPE html>



<html>



<head>



<meta charset="utf-8">



<!-- <meta name="viewport" content="width=device-width, initial-scale=1"> -->
<meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">



<title>Welcome To Admin Panel ::<?php echo $title;?></title> 



<link href="<?php echo $path2;?>images/favicon_kisan.jpg" rel="shortcut icon"/>



<!-- <link href="<?php echo $path2;?>css/bootstrap.min.css" rel="stylesheet"> -->

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css" >



<link href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css" rel="stylesheet"/>



<link href="<?php echo $path2; ?>css/jquery-ui.css" rel="stylesheet" type="text/css"><!--/slider-->



<!-- <link href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css" rel="stylesheet">



-->



<link href="<?php echo $path2;?>css/datepicker3.css" rel="stylesheet">



<link href="<?php echo $path2;?>css/daterangepicker.css" rel="stylesheet">



<link href="<?php echo $path2;?>css/bootstrap-datepicker.css" rel="stylesheet">



<link href="<?php echo $path2;?>css/styles.css" rel="stylesheet">



<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.0/css/all.min.css" />



<link href="<?php echo $path2;?>font-awesome/css/font-awesome.min.css" rel="stylesheet"/> 



<link rel="stylesheet" type="text/css" href="<?php echo $path2;?>/source/jquery.fancybox.css?v=2.1.5" media="screen" /><!-- Fancy Box Popup -->



<!--Icons-->



<script src="<?php echo $path2;?>js/lumino.glyphs.js"></script>



<!--[if lt IE 9]>



<script src="js/html5shiv.js"></script>



<script src="js/respond.min.js"></script>



<![endif]-->



</head>



<body>



<nav class="navbar navbar-default navbar-fixed-top" role="navigation">



<div class="container-fluid">



<div class="navbar-header">



<!--<a class="navbar-brand" href="#"><span>Fours</span></a>-->



<div class="row">



<div class="col-sm-5 col-xs-12">



<div class="toplogo"><h5>Logo &nbsp; <span>Administration Panel</span></h5>



<?php



if($_SESSION['admin_name']!="")



{ 



?>



</div> 



<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#sidebar-collapse">



<span class="sr-only">Toggle navigation</span>



<span class="icon-bar"></span>



<span class="icon-bar"></span>



<span class="icon-bar"></span>



</button>



</div>



<div class="col-sm-3 col-xs-6">



<!--<div class="appbtn">



<a class="btn btn-primary cust-btn" href="<?php //echo $path2;?>demo_apps/FoursDelivery.apk""><img src="<?php //echo $path2;?>images/android-logo.png" width="40px" class=""><span>Delivery Agent App</span></a>



</div>-->



</div>



<div class="col-sm-4 col-xs-6">



<?php 



if($_SESSION['user_type']=="superadmin")



{



$type_of_user = "Superadmin";



}



else



if($_SESSION['user_type']=="whuser")



{



$type_of_user = "Warehouse Admin";



}



else



if($_SESSION['user_type']=="cwhuser")



{



$type_of_user = "Distribution Point Admin";



}



?>



<ul class="user-menu">



<li class="dropdown pull-right">



<a href="#" class="dropdown-toggle" data-toggle="dropdown"><svg class="glyph stroked male-user"><use xlink:href="#stroked-male-user"></use></svg> <? 



echo stripslashes(ucwords($_SESSION['admin_name']))." - ".stripslashes(ucwords($type_of_user)); ?> 



<span class="caret"></span></a>



<ul class="dropdown-menu" role="menu">



<li><a href="<?php echo $path2;?>cplocap/admin-info.php"><svg class="glyph stroked male-user"><use xlink:href="#stroked-male-user"></use></svg> Profile</a></li>



<li><a href="<?php echo $path2;?>cplocap/changepassword.php"><svg class="glyph stroked gear"><use xlink:href="#stroked-gear"></use></svg> Change Password</a></li>



<li><a href="<?php echo $path2;?>cplocap/logout.php" onclick='if(confirm("Do You Really Want To Logoff ?")){return true;}else{return false;}'><svg class="glyph stroked cancel"><use xlink:href="#stroked-cancel"></use></svg> Logout</a></li>



</ul>



</li>



</ul>



<?php



} ?>



</div>



</div>



<!-- <div style="display:inline-block; width:50% ; text-align:center ;padding: 4px 0 0 0;">



<a class="btn btn-primary cust-btn" href="#" style="padding: 5px 10px 5px 0px;"><img src="<?php //echo $path2;?>images/android-logo.png" width="40px" class=""><span>Delivery Agent App</span></a>



</div> -->



</div>



</div><!-- /.container-fluid -->



</nav>



<!--body start -->



<?php }



function admin_header_popup($path2,$title,$tblpref,$db,$sitepath,$siteurl,$path1,$ckpath,$row_admin)



{	



include ("config.php");?>



<!DOCTYPE html>



<html>



<head>



<meta charset="utf-8">



<meta name="viewport" content="width=device-width, initial-scale=1">



<title>Welcome To Admin Panel ::<?php echo $title;?></title> 



<link href="<?php echo $path2;?>images/favicon.png" />



<link href="<?php echo $path2;?>css/bootstrap.min.css" rel="stylesheet">



<link href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css" rel="stylesheet"/>



<!-- <link href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css" rel="stylesheet">



-->



<link href="<?php echo $path2;?>css/datepicker3.css" rel="stylesheet">



<link href="<?php echo $path2;?>css/daterangepicker.css" rel="stylesheet">



<link href="<?php echo $path2;?>css/styles.css" rel="stylesheet">



<link href="<?php echo $path2;?>font-awesome/css/font-awesome.min.css" rel="stylesheet"/>



<link rel="stylesheet" type="text/css" href="<?php echo $path2;?>source/jquery.fancybox.css?v=2.1.5" media="screen" /><!-- Fancy Box Popup -->



<!--Icons-->



<script src="<?php echo $path2;?>js/lumino.glyphs.js"></script>



<!--[if lt IE 9]>



<script src="js/html5shiv.js"></script>



<script src="js/respond.min.js"></script>



<![endif]-->



</head>



<body>



<!--body start -->



<?php } 



function admin_nav($path2,$title,$tblpref,$db,$sitepath,$siteurl,$path1,$ckpath,$row_admin,$connection, $curmoduel=null)



{   



include ("config.php");



$usertype=$_SESSION['user_type']; ?>	



<!--body start -->



<div id="sidebar-collapse" class="col-sm-2 col-lg-2 sidebar" style="background-color:#dde3de;">



<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">



<div class="panel panel-default">





<div class="panel-heading" role="tab" id="headingOne">


  <?php  

    $icom ='<i class="far fa-clone"></i>';

  ?>

<h4 class="panel-title">

 
 	<a href="<?php echo $path2;?>cplocap/csv/index.php"><?php echo $icom; ?>&nbsp;&nbsp;&nbsp;CSV Import</a> 


</h4>






</div>

<div class="panel-heading" role="tab" id="headingOne">

<h4 class="panel-title">

 
  <a href="<?php echo $path2;?>cplocap/devicelogs/index.php"><?php echo $icom; ?>&nbsp;&nbsp;&nbsp;Device Logs</a> 


</h4>






</div>








<?php /*if($usertype=="superadmin")



{*/



// $acc_arr = @explode(",",$row_admin['admin_mgmts']);



// $acc_arr[]="";



// $table_name = $tblpref."moduel";



// $column_set = "mod_id,mod_name,mod_title,mod_icon";



// $condition = sprintf("mod_panel=%d ",$row_panel['panel_id']);



// $order_by = "mod_pos";



// $page_res = select_multiple_records($connection,$table_name,$column_set,$condition,$order_by,__FILE__,__LINE__); 

// }


?>



<div id="collapse" class="panel-collapse collapse ">



<div class="panel-body">





<ul class="panel-ul">




</ul>



</div>



</div>






<div id="collapse" class="panel-collapse collapse " role="tabpanel" aria-labelledby="headingOne">



<div class="panel-body">



<ul class="panel-ul">






<li><i class="" aria-hidden="true"></i></li>





</ul>



</div>



</div>





</div>


</div><!-- panel-group -->



</div><!--/.sidebar-->



<?php }



function admin_footer($paath = "../../")



{?>



<script src="<?php echo $paath; ?>js/jquery-2.2.4.min.js"></script>



<script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>



<!-- <script src="<?php echo $paath; ?>js/jquery.1.11.1.min.js"></script> -->



<script src="<?php echo $paath; ?>js/jquery-ui.js"></script>



<script src="<?php echo $paath; ?>js/bootstrap.min.js"></script>



<script type="text/javascript" src="<?php echo $paath; ?>js/jquery.mousewheel-3.0.6.pack.js"></script>



<script type="text/javascript" src="<?php echo $paath; ?>source/jquery.fancybox.js?v=2.1.5"></script>



<script src="<?php echo $paath; ?>js/bootstrap-datepicker.js"></script>



<script src="<?php echo $paath; ?>js/bootstrap-table.js"></script>



<script src="<?php echo $paath; ?>js/moment.js"></script>



<script src="<?php echo $paath; ?>js/daterangepicker.js"></script>



<script src="<?php echo $paath; ?>js/bootstrap-datepicker.js"></script>



<script type="text/javascript">



function toggleIcon(e) {



$(e.target)



.prev('.panel-heading')



.find(".more-less")



.toggleClass('fa-plus-circle fa-minus-circle');



}



$('.panel-group').on('hidden.bs.collapse', toggleIcon);



$('.panel-group').on('shown.bs.collapse', toggleIcon);



</script>



<script type="text/javascript">



function fetch(val,target,file)



{



$.post(file, {"val" : val},



function(data) {



//alert(data);



$("#"+target).show('fast',function() {



$("#"+target).html(data);



});



$("#"+target).show('fast');



});



}



function showloading()



{



$("#loading").removeClass("hide");



}



function hideloading()



{



$("#loading").addClass("hide");



}



</script>



<script type="text/javascript">



// When the document is ready



$(document).ready(function () {



$('.datetimepicker').datepicker({



format: "dd-mm-yyyy"



});  



});



</script>



<script type="text/javascript">



function fetch(val,target,file)



{



$.post(file, {"val" : val},



function(data) {



//alert(data);



$("#"+target).show('fast',function() {



$("#"+target).html(data);



});



$("#"+target).show('fast');



});



}



</script>



<script type="text/javascript">



setTimeout(function(){



$('.alert').remove();



}, 10000);



</script>



<script>



!function ($) {



$(document).on("click","ul.nav li.parent > a > span.icon", function(){		  



$(this).find('em:first').toggleClass("glyphicon-minus");	  



}); 



$(".sidebar span.icon").find('em:first').addClass("glyphicon-plus");



}(window.jQuery);



$(window).on('resize', function () {



if ($(window).width() > 768) $('#sidebar-collapse').collapse('show')



})



$(window).on('resize', function () {



if ($(window).width() <= 767) $('#sidebar-collapse').collapse('hide')



})



</script>	



<script type="text/javascript"> // When the document is ready 



$(document).ready(function () { $('.datetimepicker').datepicker({  }); }); </script>



<script type="text/javascript">



$(function() {



$('input[name="daterange"]').daterangepicker({



autoUpdateInput: false,



locale: {



cancelLabel: 'Clear'



}



});



$('input[name="daterange"]').on('apply.daterangepicker', function(ev, picker) {



$(this).val(picker.startDate.format('DD-MM-YYYY') + ' TO ' + picker.endDate.format('DD-MM-YYYY'));



});



$('input[name="daterange"]').on('cancel.daterangepicker', function(ev, picker) {



$(this).val('');



});



});



</script>



<script>



//Fancybox Popup



$(document).ready(function() {



$('.fancybox').fancybox({



wrapCSS    : 'fancybox-custom',



closeClick : true,



'width':        625,



'height':       350,



openEffect : 'none',



helpers : {



title : {



type : 'inside'



},



overlay : {



css : {



'background' : 'rgba(238,238,238,0.85)'



}



}



}



});



});



</script>



</body>



</html>



<?php



}



////// start function to display error



function displayerror($title,$errorno,$errordesc,$links,$reporterror)



{



global $sitefont ,$sitefontweight;



//Dim arrlinks 'Array to stores hyperlink text and Url



//Dim intI 'Counter for For loop



print "<body>";



print "<center>";



print "<table border=1 cellspacing=0 cellpadding=1 width=90%> ";



print "  <tr bgcolor=#70b4eb>";



print "    <td><font color=#FFFFFF face='$sitefont' ><b>".$title."</b></font></td>";



print "  </tr>";



print "  <tr>";



print "    <td><br>";



print "<font face='$sitefont' size='$sitefontweight' ><b> &nbsp;An error occurred during this process.</b></font><br><br>";



print "<font face='$sitefont' size='$sitefontweight' >".$errorno."&nbsp;"."</font>";



print "<font face='$sitefont' size='$sitefontweight' >".$errordesc."</font>";



//$err.$clear;



$arrlinks=explode(",",$links);



//echo "<br>".$arrlinks[0]."<p>".$arrlinks[1]."<p>".$arrlinks[2]."<p>".$arrlinks[3];//exit;



print "<ul>";



//Loop to show all hyperlinks



for ($intI=0; ($intI<=count($arrlinks)-1);$intI=$intI+2){



print "<li><font face=$sitefont size=$sitefontweight><b><a href='".$arrlinks[$intI+1]."'>".$arrlinks[$intI]."</a></font></li>";



}



//Condition checks if reporterror is one then show "Report This error" hyperlink



//if cint(reporterror) = 1 then



//        Response.Write "<li><a href='#'>Report This error</a></li>"



//end if



print "</ul>";



print "</td>";



print "</tr>";



print "</table>";



print "</center>";



}//end sub



function dateformate($datefor='')



{



$date=$datefor;



$date1=explode("-",$date);



$txtdate=$date1[2]."-".$date1[1]."-".$date1[0];



return $txtdate;



}



function country($cntid, $curid=null)



{



include("common/config.php");



$query_country = sprintf("Select * from nnc_country where cnt_id='%d'", $cntid);



if(!($res_country = mysqli_query($connection,$query_country)))



{



echo $query_country.mysqli_error($connection)."<br>LINE".__LINE__."<br>FILE".__FILE__;



exit();



}



$row_country = mysqli_fetch_array($res_country);



$cnt_name = stripslashes($row_country[cnt_name]);



$cur_id = $row_country[cnt_cur_id];



if($curid==null)



{



return $cnt_name;



}



else



{



return $curname = currency($cur_id);



}



}



function currency($curid,$abb=null)



{



include("common/config.php");



$query_currency = sprintf("Select * from nnc_currency where cur_id='%d'", $curid);



if(!($res_currency = mysqli_query($connection,$query_currency)))



{



echo $query_currency.mysqli_error($connection)."<br>LINE".__LINE__."<br>FILE".__FILE__;



exit();



}



$row_currency = mysqli_fetch_array($res_currency);



$cur_name = stripslashes($row_currency[cur_name]);



$cur_abb = stripslashes($row_currency[cur_ab]);



if($abb==null)



{



return $cur_name;



}



else



{



return $cur_abb;



}



}



function log_entry($module,$modtitle,$action,$tblpref,$db,$adminid,$ip)



{



@session_start();



include("config.php");



$table_name = $tblpref."log";



$feals_set = sprintf("log_admin_id='%d', log_admin_module='%s', log_admin_rec_title='%s', log_admin_action='%s', log_admin_ip='%s', log_admin_date=CURDATE(), log_admin_time=CURTIME()",$adminid,$module,$modtitle,$action,$ip);



$id = add_record($connection,$table_name,$feals_set,__FILE__,__LINE__);



}



function str_rand($length = 8, $seeds = 'alphanum')



{



// Possible seeds



$seedings['alpha'] = 'abcdefghijklmnopqrstuvwqyz';



$seedings['numeric'] = '0123456789';



$seedings['alphanum'] = 'abcdefghijklmnopqrstuvwqyz0123456789';



$seedings['hexidec'] = '0123456789abcdef';



// Choose seed



if (isset($seedings[$seeds]))



{



$seeds = $seedings[$seeds];
//echo $seeds;


}



// Seed generator



list($usec, $sec) = explode(' ', microtime());



$seed = (float) $sec + ((float) $usec * 100000);



mt_srand($seed);



// Generate



$str = '';



$seeds_count = strlen($seeds);    



for ($i = 0; $length > $i; $i++)



{



$str .= $seeds[mt_rand(0 , $seeds_count- 1)];



}



return $str;



}



function preg_chk($data)



{



$original_data=$data;



// 	$data = sprintf("%s", $data);



$data_arr = @explode('\\',$data);



/*for($i="0";$i<count($data_arr);$i++)



{



$data_val_arr[] = stristr($data_arr[$i], 'x');



}*/

// $data_val_arr

for($j="0";$j<count($data_arr);$j++)



{



$ser = "/".$data_val_arr[$j]."/i";



$data =  @preg_replace($ser , '', $data);



}



// Fix &entity\n;



$data = str_replace(array('&amp;','&lt;','&gt;'), array('&amp;amp;','&amp;lt;','&amp;gt;'), $data);



$data = @preg_replace('/(&#*\w+)[\x00-\x20]+;/u', '$1;', $data);



$data = @preg_replace('/(&#x*[0-9A-F]+);*/iu', '$1;', $data);



$data = @html_entity_decode($data, ENT_COMPAT, 'UTF-8');



// Remove any attribute starting with "on" or xmlns



$data = preg_replace('#(<[^>]+?[\x00-\x20"\'])(?:on|xmlns)[^>]*+>#iu', '', $data);



// Remove javascript: and vbscript: protocols



$data = preg_replace('#([a-z]*)[\x00-\x20]*=[\x00-\x20]*([`\'"]*)[\x00-\x20]*j[\x00-\x20]*a[\x00-\x20]*v[\x00-\x20]*a[\x00-\x20]*s[\x00-\x20]*c[\x00-\x20]*r[\x00-\x20]*i[\x00-\x20]*p[\x00-\x20]*t[\x00-\x20]*:#iu', '$2nojavascript...', $data);



$data = preg_replace('#([a-z]*)[\x00-\x20]*=([\'"]*)[\x00-\x20]*v[\x00-\x20]*b[\x00-\x20]*s[\x00-\x20]*c[\x00-\x20]*r[\x00-\x20]*i[\x00-\x20]*p[\x00-\x20]*t[\x00-\x20]*:#iu', '$2novbscript...', $data);



$data = preg_replace('#([a-z]*)[\x00-\x20]*=([\'"]*)[\x00-\x20]*-moz-binding[\x00-\x20]*:#u', '$2nomozbinding...', $data);



// Only works in IE: <span style="width: expression(alert('Ping!'));"></span>



$data = preg_replace('#(<[^>]+?)style[\x00-\x20]*=[\x00-\x20]*[`\'"]*.*?expression[\x00-\x20]*\([^>]*+>#i', '', $data);



$data = preg_replace('#(<[^>]+?)style[\x00-\x20]*=[\x00-\x20]*[`\'"]*.*?behaviour[\x00-\x20]*\([^>]*+>#i', '', $data);



$data = preg_replace('#(<[^>]+?)style[\x00-\x20]*=[\x00-\x20]*[`\'"]*.*?s[\x00-\x20]*c[\x00-\x20]*r[\x00-\x20]*i[\x00-\x20]*p[\x00-\x20]*t[\x00-\x20]*:*[^>]*+>#iu', '', $data);



// Remove namespaced elements (we do not need them)



$data = preg_replace('#</*\w+:\w[^>]*+>#i', '', $data);



$data = preg_replace('/javascript/i', '', $data);



$data = preg_replace('/onload/i', '', $data);	



$data = preg_replace('/onerror/i', '', $data);



$data = preg_replace('/alert/i', '', $data);



$data = preg_replace('/onmouseover/i', '', $data);



$data = preg_replace('/onmouserover/i', '', $data);



$data = preg_replace('/select/i', '', $data);



$data = preg_replace('/char\(/i', '', $data);



$data = preg_replace('/concat\(/i', '', $data);



$data = preg_replace('/<a/i', '', $data);



$data = preg_replace('/</i', '', $data);



$data = preg_replace('/>/i', '', $data);



$data = preg_replace('/href="/i', '', $data);



$data = str_replace("/'/i", '', $data);



$data = preg_replace("/%27/i", '', $data);



$data = preg_replace("/%22/i", '', $data);



$data = preg_replace("/x27/i", '', $data);



$data = preg_replace("/x22/i", '', $data);



$data = preg_replace("/x20/i", '', $data);



$data = preg_replace("/x3e/i", '', $data);



$data = preg_replace("/x3csfi000076v795107/i", '', $data);



$data = preg_replace("/x3csfi000342v460198/i", '', $data);



$data = str_replace('/"/i', '', $data);



$data = preg_replace('/FSCommand/i', '', $data);



$data = preg_replace('/onAbort/i', '', $data);



$data = preg_replace('/onActivate/i', '', $data);



$data = preg_replace('/onAfterPrint/i', '', $data);



$data = preg_replace('/onAfterUpdate/i', '', $data);



$data = preg_replace('/onBeforeActivate/i', '', $data);



$data = preg_replace('/onBeforeCopy/i', '', $data);



$data = preg_replace('/onBeforeCut/i', '', $data);



$data = preg_replace('/onBeforeDeactivate/i', '', $data);



$data = preg_replace('/onBeforeEditFocus/i', '', $data);



$data = preg_replace('/onBeforePaste/i', '', $data);



$data = preg_replace('/onBeforePrint/i', '', $data);



$data = preg_replace('/onBeforeUnload/i', '', $data);



$data = preg_replace('/onBeforeUpdate/i', '', $data);



$data = preg_replace('/onBegin/i', '', $data);



$data = preg_replace('/onBlur/i', '', $data);



$data = preg_replace('/onBounce/i', '', $data);



$data = preg_replace('/onCellChange/i', '', $data);



$data = preg_replace('/onChange/i', '', $data);



$data = preg_replace('/onClick/i', '', $data);



$data = preg_replace('/onContextMenu/i', '', $data);



$data = preg_replace('/onControlSelect/i', '', $data);



$data = preg_replace('/onCopy/i', '', $data);



$data = preg_replace('/onCut/i', '', $data);



$data = preg_replace('/onDataAvailable/i', '', $data);



$data = preg_replace('/onDataSetChanged/i', '', $data);



$data = preg_replace('/onDataSetComplete/i', '', $data);



$data = preg_replace('/onDblClick/i', '', $data);



$data = preg_replace('/onDeactivate/i', '', $data);



$data = preg_replace('/onDrag/i', '', $data);



$data = preg_replace('/onDragEnd/i', '', $data);



$data = preg_replace('/onDragLeave/i', '', $data);



$data = preg_replace('/onDragEnter/i', '', $data);



$data = preg_replace('/onDragOver/i', '', $data);



$data = preg_replace('/onDragDrop/i', '', $data);



$data = preg_replace('/onDragStart/i', '', $data);



$data = preg_replace('/onDrop/i', '', $data);



$data = preg_replace('/onEnd/i', '', $data);



$data = preg_replace('/onError/i', '', $data);



$data = preg_replace('/onErrorUpdate/i', '', $data);



$data = preg_replace('/onFilterChange/i', '', $data);



$data = preg_replace('/onFinish/i', '', $data);



$data = preg_replace('/onFocus/i', '', $data);



$data = preg_replace('/onFocusIn/i', '', $data);



$data = preg_replace('/onFocusOut/i', '', $data);



$data = preg_replace('/onHashChange/i', '', $data);



$data = preg_replace('/onHelp/i', '', $data);



$data = preg_replace('/onInput/i', '', $data);



$data = preg_replace('/onKeyDown/i', '', $data);



$data = preg_replace('/onKeyPress/i', '', $data);



$data = preg_replace('/onKeyUp/i', '', $data);



$data = preg_replace('/onLayoutComplete/i', '', $data);



$data = preg_replace('/onLoad/i', '', $data);



$data = preg_replace('/onLoseCapture/i', '', $data);



$data = preg_replace('/onMediaComplete/i', '', $data);



$data = preg_replace('/onMediaError/i', '', $data);



$data = preg_replace('/onMessage/i', '', $data);



$data = preg_replace('/onMouseDown/i', '', $data);



$data = preg_replace('/onMouseEnter/i', '', $data);



$data = preg_replace('/onMouseLeave/i', '', $data);



$data = preg_replace('/onMouseMove/i', '', $data);



$data = preg_replace('/onMouseOut/i', '', $data);



$data = preg_replace('/onMouseUp/i', '', $data);



$data = preg_replace('/onMouseWheel/i', '', $data);



$data = preg_replace('/onMove/i', '', $data);



$data = preg_replace('/onMoveEnd/i', '', $data);



$data = preg_replace('/onMoveStart/i', '', $data);



$data = preg_replace('/onOffline/i', '', $data);



$data = preg_replace('/onOnline/i', '', $data);



$data = preg_replace('/onOutOfSync/i', '', $data);



$data = preg_replace('/onPaste/i', '', $data);



$data = preg_replace('/onPause/i', '', $data);



$data = preg_replace('/onPopState/i', '', $data);



$data = preg_replace('/onProgress/i', '', $data);



$data = preg_replace('/onPropertyChange/i', '', $data);



$data = preg_replace('/onReadyStateChange/i', '', $data);



$data = preg_replace('/onRedo/i', '', $data);



$data = preg_replace('/onRepeat/i', '', $data);



$data = preg_replace('/onReset/i', '', $data);



$data = preg_replace('/onResize/i', '', $data);



$data = preg_replace('/onResizeEnd/i', '', $data);



$data = preg_replace('/onResizeStart/i', '', $data);



$data = preg_replace('/onResume/i', '', $data);



$data = preg_replace('/onReverse/i', '', $data);



$data = preg_replace('/onRowsEnter/i', '', $data);



$data = preg_replace('/onRowExit/i', '', $data);



$data = preg_replace('/onRowDelete/i', '', $data);



$data = preg_replace('/onRowInserted/i', '', $data);



$data = preg_replace('/onScroll/i', '', $data);



$data = preg_replace('/onSeek/i', '', $data);



$data = preg_replace('/onSelect/i', '', $data);



$data = preg_replace('/onSelectionChange/i', '', $data);



$data = preg_replace('/onSelectStart/i', '', $data);



$data = preg_replace('/onStart/i', '', $data);



$data = preg_replace('/onStop/i', '', $data);



$data = preg_replace('/onStorage/i', '', $data);



$data = preg_replace('/onStorage/i', '', $data);



$data = preg_replace('/onSubmit/i', '', $data);



$data = preg_replace('/onTimeError/i', '', $data);



$data = preg_replace('/onTrackChange/i', '', $data);



$data = preg_replace('/onUndo/i', '', $data);



$data = preg_replace('/onUnload/i', '', $data);



$data = preg_replace('/onURLFlip/i', '', $data);



$data = preg_replace('/seekSegmentTime/i', '', $data);



$data = str_replace('.../', '', $data);



$data = str_replace('../', '', $data);



$data = str_replace('./', '', $data);



$data = preg_replace('/-/i', '', $data);



$data = str_replace('...\\', '', $data);



$data = str_replace('..\\', '', $data);



$data = str_replace('.\\', '', $data);



$data = str_replace('\\', '', $data);	



$data = str_replace('_', '', $data);



$data = str_replace(';', '', $data);



$data = str_replace(';', '', $data);



$data = str_replace('(', '', $data);



$data = str_replace(')', '', $data);



do



{



// Remove really unwanted tags



$old_data = $data;



$data = preg_replace('#</*(?:applet|b(?:ase|gsound|link)|embed|frame(?:set)?|i(?:frame|layer)|l(?:ayer|ink)|meta|object|s(?:cript|tyle)|title|xml)[^>]*+>#i', '', $data);



}



while ($old_data !== $data);



// we are done...



if($original_data!=$data)



{



//header("location:error.php");



//exit;



}



return $data;



}



function date_chk($data)



{



$original_data=$data;



// Fix &entity\n;



// 	$data = sprintf("%s", $data);



$data_arr = @explode('\\',$data);



for($i="0";$i<count($data_arr);$i++)



{



$data_val_arr[] = stristr($data_arr[$i], 'x');



}



for($j="0";$j<count($data_val_arr);$j++)



{



$ser = "/".$data_val_arr[$j]."/i";



$data =  preg_replace($ser , '', $data);



}



// Fix &entity\n;



$data = str_replace(array('&amp;','&lt;','&gt;'), array('&amp;amp;','&amp;lt;','&amp;gt;'), $data);



$data = preg_replace('/(&#*\w+)[\x00-\x20]+;/u', '$1;', $data);



$data = preg_replace('/(&#x*[0-9A-F]+);*/iu', '$1;', $data);



$data = @html_entity_decode($data, ENT_COMPAT, 'UTF-8');



// Remove any attribute starting with "on" or xmlns



$data = preg_replace('#(<[^>]+?[\x00-\x20"\'])(?:on|xmlns)[^>]*+>#iu', '', $data);



// Remove javascript: and vbscript: protocols



$data = preg_replace('#([a-z]*)[\x00-\x20]*=[\x00-\x20]*([`\'"]*)[\x00-\x20]*j[\x00-\x20]*a[\x00-\x20]*v[\x00-\x20]*a[\x00-\x20]*s[\x00-\x20]*c[\x00-\x20]*r[\x00-\x20]*i[\x00-\x20]*p[\x00-\x20]*t[\x00-\x20]*:#iu', '$2nojavascript...', $data);



$data = preg_replace('#([a-z]*)[\x00-\x20]*=([\'"]*)[\x00-\x20]*v[\x00-\x20]*b[\x00-\x20]*s[\x00-\x20]*c[\x00-\x20]*r[\x00-\x20]*i[\x00-\x20]*p[\x00-\x20]*t[\x00-\x20]*:#iu', '$2novbscript...', $data);



$data = preg_replace('#([a-z]*)[\x00-\x20]*=([\'"]*)[\x00-\x20]*-moz-binding[\x00-\x20]*:#u', '$2nomozbinding...', $data);



// Only works in IE: <span style="width: expression(alert('Ping!'));"></span>



$data = preg_replace('#(<[^>]+?)style[\x00-\x20]*=[\x00-\x20]*[`\'"]*.*?expression[\x00-\x20]*\([^>]*+>#i', '', $data);



$data = preg_replace('#(<[^>]+?)style[\x00-\x20]*=[\x00-\x20]*[`\'"]*.*?behaviour[\x00-\x20]*\([^>]*+>#i', '', $data);



$data = preg_replace('#(<[^>]+?)style[\x00-\x20]*=[\x00-\x20]*[`\'"]*.*?s[\x00-\x20]*c[\x00-\x20]*r[\x00-\x20]*i[\x00-\x20]*p[\x00-\x20]*t[\x00-\x20]*:*[^>]*+>#iu', '', $data);



// Remove namespaced elements (we do not need them)



$data = preg_replace('#</*\w+:\w[^>]*+>#i', '', $data);



$data = preg_replace('/javascript/i', '', $data);



$data = preg_replace('/onload/i', '', $data);	



$data = preg_replace('/onerror/i', '', $data);



$data = preg_replace('/alert/i', '', $data);



$data = preg_replace('/onmouseover/i', '', $data);



$data = preg_replace('/onmouserover/i', '', $data);



$data = preg_replace('/select/i', '', $data);



$data = preg_replace('/char\(/i', '', $data);



$data = preg_replace('/concat\(/i', '', $data);



$data = preg_replace('/<a/i', '', $data);



$data = preg_replace('/</i', '', $data);



$data = preg_replace('/>/i', '', $data);



$data = preg_replace('/href="/i', '', $data);



$data = str_replace("/'/i", '', $data);



$data = preg_replace("/%27/i", '', $data);



$data = preg_replace("/%22/i", '', $data);



$data = preg_replace("/x27/i", '', $data);



$data = preg_replace("/x22/i", '', $data);



$data = preg_replace("/x20/i", '', $data);



$data = preg_replace("/x3e/i", '', $data);



$data = preg_replace("/x3csfi000076v795107/i", '', $data);



$data = preg_replace("/x3csfi000342v460198/i", '', $data);



$data = str_replace('/"/i', '', $data);



$data = preg_replace('/FSCommand/i', '', $data);



$data = preg_replace('/onAbort/i', '', $data);



$data = preg_replace('/onActivate/i', '', $data);



$data = preg_replace('/onAfterPrint/i', '', $data);



$data = preg_replace('/onAfterUpdate/i', '', $data);



$data = preg_replace('/onBeforeActivate/i', '', $data);



$data = preg_replace('/onBeforeCopy/i', '', $data);



$data = preg_replace('/onBeforeCut/i', '', $data);



$data = preg_replace('/onBeforeDeactivate/i', '', $data);



$data = preg_replace('/onBeforeEditFocus/i', '', $data);



$data = preg_replace('/onBeforePaste/i', '', $data);



$data = preg_replace('/onBeforePrint/i', '', $data);



$data = preg_replace('/onBeforeUnload/i', '', $data);



$data = preg_replace('/onBeforeUpdate/i', '', $data);



$data = preg_replace('/onBegin/i', '', $data);



$data = preg_replace('/onBlur/i', '', $data);



$data = preg_replace('/onBounce/i', '', $data);



$data = preg_replace('/onCellChange/i', '', $data);



$data = preg_replace('/onChange/i', '', $data);



$data = preg_replace('/onClick/i', '', $data);



$data = preg_replace('/onContextMenu/i', '', $data);



$data = preg_replace('/onControlSelect/i', '', $data);



$data = preg_replace('/onCopy/i', '', $data);



$data = preg_replace('/onCut/i', '', $data);



$data = preg_replace('/onDataAvailable/i', '', $data);



$data = preg_replace('/onDataSetChanged/i', '', $data);



$data = preg_replace('/onDataSetComplete/i', '', $data);



$data = preg_replace('/onDblClick/i', '', $data);



$data = preg_replace('/onDeactivate/i', '', $data);



$data = preg_replace('/onDrag/i', '', $data);



$data = preg_replace('/onDragEnd/i', '', $data);



$data = preg_replace('/onDragLeave/i', '', $data);



$data = preg_replace('/onDragEnter/i', '', $data);



$data = preg_replace('/onDragOver/i', '', $data);



$data = preg_replace('/onDragDrop/i', '', $data);



$data = preg_replace('/onDragStart/i', '', $data);



$data = preg_replace('/onDrop/i', '', $data);



$data = preg_replace('/onEnd/i', '', $data);



$data = preg_replace('/onError/i', '', $data);



$data = preg_replace('/onErrorUpdate/i', '', $data);



$data = preg_replace('/onFilterChange/i', '', $data);



$data = preg_replace('/onFinish/i', '', $data);



$data = preg_replace('/onFocus/i', '', $data);



$data = preg_replace('/onFocusIn/i', '', $data);



$data = preg_replace('/onFocusOut/i', '', $data);



$data = preg_replace('/onHashChange/i', '', $data);



$data = preg_replace('/onHelp/i', '', $data);



$data = preg_replace('/onInput/i', '', $data);



$data = preg_replace('/onKeyDown/i', '', $data);



$data = preg_replace('/onKeyPress/i', '', $data);



$data = preg_replace('/onKeyUp/i', '', $data);



$data = preg_replace('/onLayoutComplete/i', '', $data);



$data = preg_replace('/onLoad/i', '', $data);



$data = preg_replace('/onLoseCapture/i', '', $data);



$data = preg_replace('/onMediaComplete/i', '', $data);



$data = preg_replace('/onMediaError/i', '', $data);



$data = preg_replace('/onMessage/i', '', $data);



$data = preg_replace('/onMouseDown/i', '', $data);



$data = preg_replace('/onMouseEnter/i', '', $data);



$data = preg_replace('/onMouseLeave/i', '', $data);



$data = preg_replace('/onMouseMove/i', '', $data);



$data = preg_replace('/onMouseOut/i', '', $data);



$data = preg_replace('/onMouseUp/i', '', $data);



$data = preg_replace('/onMouseWheel/i', '', $data);



$data = preg_replace('/onMove/i', '', $data);



$data = preg_replace('/onMoveEnd/i', '', $data);



$data = preg_replace('/onMoveStart/i', '', $data);



$data = preg_replace('/onOffline/i', '', $data);



$data = preg_replace('/onOnline/i', '', $data);



$data = preg_replace('/onOutOfSync/i', '', $data);



$data = preg_replace('/onPaste/i', '', $data);



$data = preg_replace('/onPause/i', '', $data);



$data = preg_replace('/onPopState/i', '', $data);



$data = preg_replace('/onProgress/i', '', $data);



$data = preg_replace('/onPropertyChange/i', '', $data);



$data = preg_replace('/onReadyStateChange/i', '', $data);



$data = preg_replace('/onRedo/i', '', $data);



$data = preg_replace('/onRepeat/i', '', $data);



$data = preg_replace('/onReset/i', '', $data);



$data = preg_replace('/onResize/i', '', $data);



$data = preg_replace('/onResizeEnd/i', '', $data);



$data = preg_replace('/onResizeStart/i', '', $data);



$data = preg_replace('/onResume/i', '', $data);



$data = preg_replace('/onReverse/i', '', $data);



$data = preg_replace('/onRowsEnter/i', '', $data);



$data = preg_replace('/onRowExit/i', '', $data);



$data = preg_replace('/onRowDelete/i', '', $data);



$data = preg_replace('/onRowInserted/i', '', $data);



$data = preg_replace('/onScroll/i', '', $data);



$data = preg_replace('/onSeek/i', '', $data);



$data = preg_replace('/onSelect/i', '', $data);



$data = preg_replace('/onSelectionChange/i', '', $data);



$data = preg_replace('/onSelectStart/i', '', $data);



$data = preg_replace('/onStart/i', '', $data);



$data = preg_replace('/onStop/i', '', $data);



$data = preg_replace('/onStorage/i', '', $data);



$data = preg_replace('/onStorage/i', '', $data);



$data = preg_replace('/onSubmit/i', '', $data);



$data = preg_replace('/onTimeError/i', '', $data);



$data = preg_replace('/onTrackChange/i', '', $data);



$data = preg_replace('/onUndo/i', '', $data);



$data = preg_replace('/onUnload/i', '', $data);



$data = preg_replace('/onURLFlip/i', '', $data);



$data = preg_replace('/seekSegmentTime/i', '', $data);



$data = str_replace('.../', '', $data);



$data = str_replace('../', '', $data);



$data = str_replace('./', '', $data);



$data = str_replace('...\\', '', $data);



$data = str_replace('..\\', '', $data);



$data = str_replace('.\\', '', $data);



$data = str_replace('\\', '', $data);



$data = str_replace('_', '', $data);



$data = str_replace(';', '', $data);



$data = str_replace(':', '', $data);



$data = str_replace('(', '', $data);



$data = str_replace(')', '', $data);



do



{



// Remove really unwanted tags



$old_data = $data;



$data = preg_replace('#</*(?:applet|b(?:ase|gsound|link)|embed|frame(?:set)?|i(?:frame|layer)|l(?:ayer|ink)|meta|object|s(?:cript|tyle)|title|xml)[^>]*+>#i', '', $data);



}



while ($old_data !== $data);



// we are done...



if($original_data!=$data)



{



header("location:error.php");



exit;



}



return $data;



}



function url_chk($data)



{



$original_data=$data;	



// 	$data = sprintf("%s", $data);



$data_arr = @explode('\\',$data);



for($i="0";$i<count($data_arr);$i++)



{



$data_val_arr[] = stristr($data_arr[$i], 'x');



}



for($j="0";$j<count($data_val_arr);$j++)



{



$ser = "/".$data_val_arr[$j]."/i";



$data =  preg_replace($ser , '', $data);



}



// Fix &entity\n;



$data = str_replace(array('&amp;','&lt;','&gt;'), array('&amp;amp;','&amp;lt;','&amp;gt;'), $data);



$data = preg_replace('/(&#*\w+)[\x00-\x20]+;/u', '$1;', $data);



$data = preg_replace('/(&#x*[0-9A-F]+);*/iu', '$1;', $data);



$data = @html_entity_decode($data, ENT_COMPAT, 'UTF-8');



// Remove any attribute starting with "on" or xmlns



$data = preg_replace('#(<[^>]+?[\x00-\x20"\'])(?:on|xmlns)[^>]*+>#iu', '', $data);



// Remove javascript: and vbscript: protocols



$data = preg_replace('#([a-z]*)[\x00-\x20]*=[\x00-\x20]*([`\'"]*)[\x00-\x20]*j[\x00-\x20]*a[\x00-\x20]*v[\x00-\x20]*a[\x00-\x20]*s[\x00-\x20]*c[\x00-\x20]*r[\x00-\x20]*i[\x00-\x20]*p[\x00-\x20]*t[\x00-\x20]*:#iu', '$2nojavascript...', $data);



$data = preg_replace('#([a-z]*)[\x00-\x20]*=([\'"]*)[\x00-\x20]*v[\x00-\x20]*b[\x00-\x20]*s[\x00-\x20]*c[\x00-\x20]*r[\x00-\x20]*i[\x00-\x20]*p[\x00-\x20]*t[\x00-\x20]*:#iu', '$2novbscript...', $data);



$data = preg_replace('#([a-z]*)[\x00-\x20]*=([\'"]*)[\x00-\x20]*-moz-binding[\x00-\x20]*:#u', '$2nomozbinding...', $data);



// Only works in IE: <span style="width: expression(alert('Ping!'));"></span>



$data = preg_replace('#(<[^>]+?)style[\x00-\x20]*=[\x00-\x20]*[`\'"]*.*?expression[\x00-\x20]*\([^>]*+>#i', '', $data);



$data = preg_replace('#(<[^>]+?)style[\x00-\x20]*=[\x00-\x20]*[`\'"]*.*?behaviour[\x00-\x20]*\([^>]*+>#i', '', $data);



$data = preg_replace('#(<[^>]+?)style[\x00-\x20]*=[\x00-\x20]*[`\'"]*.*?s[\x00-\x20]*c[\x00-\x20]*r[\x00-\x20]*i[\x00-\x20]*p[\x00-\x20]*t[\x00-\x20]*:*[^>]*+>#iu', '', $data);



// Remove namespaced elements (we do not need them)



$data = preg_replace('#</*\w+:\w[^>]*+>#i', '', $data);



$data = preg_replace('/javascript/i', '', $data);



$data = preg_replace('/onload/i', '', $data);	



$data = preg_replace('/onerror/i', '', $data);



$data = preg_replace('/alert/i', '', $data);



$data = preg_replace('/onmouseover/i', '', $data);



$data = preg_replace('/onmouserover/i', '', $data);



$data = preg_replace('/select/i', '', $data);



$data = preg_replace('/char\(/i', '', $data);



$data = preg_replace('/concat\(/i', '', $data);



$data = preg_replace('/<a/i', '', $data);



$data = preg_replace('/</i', '', $data);



$data = preg_replace('/>/i', '', $data);



$data = preg_replace('/href="/i', '', $data);



$data = str_replace("/'/i", '', $data);



$data = preg_replace("/%27/i", '', $data);



$data = preg_replace("/%22/i", '', $data);



$data = preg_replace("/x27/i", '', $data);



$data = preg_replace("/x22/i", '', $data);



$data = preg_replace("/x20/i", '', $data);



$data = preg_replace("/x3e/i", '', $data);



$data = preg_replace("/x3csfi000076v795107/i", '', $data);



$data = preg_replace("/x3csfi000342v460198/i", '', $data);



$data = str_replace('/"/i', '', $data);



$data = preg_replace('/FSCommand/i', '', $data);



$data = preg_replace('/onAbort/i', '', $data);



$data = preg_replace('/onActivate/i', '', $data);



$data = preg_replace('/onAfterPrint/i', '', $data);



$data = preg_replace('/onAfterUpdate/i', '', $data);



$data = preg_replace('/onBeforeActivate/i', '', $data);



$data = preg_replace('/onBeforeCopy/i', '', $data);



$data = preg_replace('/onBeforeCut/i', '', $data);



$data = preg_replace('/onBeforeDeactivate/i', '', $data);



$data = preg_replace('/onBeforeEditFocus/i', '', $data);



$data = preg_replace('/onBeforePaste/i', '', $data);



$data = preg_replace('/onBeforePrint/i', '', $data);



$data = preg_replace('/onBeforeUnload/i', '', $data);



$data = preg_replace('/onBeforeUpdate/i', '', $data);



$data = preg_replace('/onBegin/i', '', $data);



$data = preg_replace('/onBlur/i', '', $data);



$data = preg_replace('/onBounce/i', '', $data);



$data = preg_replace('/onCellChange/i', '', $data);



$data = preg_replace('/onChange/i', '', $data);



$data = preg_replace('/onClick/i', '', $data);



$data = preg_replace('/onContextMenu/i', '', $data);



$data = preg_replace('/onControlSelect/i', '', $data);



$data = preg_replace('/onCopy/i', '', $data);



$data = preg_replace('/onCut/i', '', $data);



$data = preg_replace('/onDataAvailable/i', '', $data);



$data = preg_replace('/onDataSetChanged/i', '', $data);



$data = preg_replace('/onDataSetComplete/i', '', $data);



$data = preg_replace('/onDblClick/i', '', $data);



$data = preg_replace('/onDeactivate/i', '', $data);



$data = preg_replace('/onDrag/i', '', $data);



$data = preg_replace('/onDragEnd/i', '', $data);



$data = preg_replace('/onDragLeave/i', '', $data);



$data = preg_replace('/onDragEnter/i', '', $data);



$data = preg_replace('/onDragOver/i', '', $data);



$data = preg_replace('/onDragDrop/i', '', $data);



$data = preg_replace('/onDragStart/i', '', $data);



$data = preg_replace('/onDrop/i', '', $data);



$data = preg_replace('/onEnd/i', '', $data);



$data = preg_replace('/onError/i', '', $data);



$data = preg_replace('/onErrorUpdate/i', '', $data);



$data = preg_replace('/onFilterChange/i', '', $data);



$data = preg_replace('/onFinish/i', '', $data);



$data = preg_replace('/onFocus/i', '', $data);



$data = preg_replace('/onFocusIn/i', '', $data);



$data = preg_replace('/onFocusOut/i', '', $data);



$data = preg_replace('/onHashChange/i', '', $data);



$data = preg_replace('/onHelp/i', '', $data);



$data = preg_replace('/onInput/i', '', $data);



$data = preg_replace('/onKeyDown/i', '', $data);



$data = preg_replace('/onKeyPress/i', '', $data);



$data = preg_replace('/onKeyUp/i', '', $data);



$data = preg_replace('/onLayoutComplete/i', '', $data);



$data = preg_replace('/onLoad/i', '', $data);



$data = preg_replace('/onLoseCapture/i', '', $data);



$data = preg_replace('/onMediaComplete/i', '', $data);



$data = preg_replace('/onMediaError/i', '', $data);



$data = preg_replace('/onMessage/i', '', $data);



$data = preg_replace('/onMouseDown/i', '', $data);



$data = preg_replace('/onMouseEnter/i', '', $data);



$data = preg_replace('/onMouseLeave/i', '', $data);



$data = preg_replace('/onMouseMove/i', '', $data);



$data = preg_replace('/onMouseOut/i', '', $data);



$data = preg_replace('/onMouseUp/i', '', $data);



$data = preg_replace('/onMouseWheel/i', '', $data);



$data = preg_replace('/onMove/i', '', $data);



$data = preg_replace('/onMoveEnd/i', '', $data);



$data = preg_replace('/onMoveStart/i', '', $data);



$data = preg_replace('/onOffline/i', '', $data);



$data = preg_replace('/onOnline/i', '', $data);



$data = preg_replace('/onOutOfSync/i', '', $data);



$data = preg_replace('/onPaste/i', '', $data);



$data = preg_replace('/onPause/i', '', $data);



$data = preg_replace('/onPopState/i', '', $data);



$data = preg_replace('/onProgress/i', '', $data);



$data = preg_replace('/onPropertyChange/i', '', $data);



$data = preg_replace('/onReadyStateChange/i', '', $data);



$data = preg_replace('/onRedo/i', '', $data);



$data = preg_replace('/onRepeat/i', '', $data);



$data = preg_replace('/onReset/i', '', $data);



$data = preg_replace('/onResize/i', '', $data);



$data = preg_replace('/onResizeEnd/i', '', $data);



$data = preg_replace('/onResizeStart/i', '', $data);



$data = preg_replace('/onResume/i', '', $data);



$data = preg_replace('/onReverse/i', '', $data);



$data = preg_replace('/onRowsEnter/i', '', $data);



$data = preg_replace('/onRowExit/i', '', $data);



$data = preg_replace('/onRowDelete/i', '', $data);



$data = preg_replace('/onRowInserted/i', '', $data);



$data = preg_replace('/onScroll/i', '', $data);



$data = preg_replace('/onSeek/i', '', $data);



$data = preg_replace('/onSelect/i', '', $data);



$data = preg_replace('/onSelectionChange/i', '', $data);



$data = preg_replace('/onSelectStart/i', '', $data);



$data = preg_replace('/onStart/i', '', $data);



$data = preg_replace('/onStop/i', '', $data);



$data = preg_replace('/onStorage/i', '', $data);



$data = preg_replace('/onStorage/i', '', $data);



$data = preg_replace('/onSubmit/i', '', $data);



$data = preg_replace('/onTimeError/i', '', $data);



$data = preg_replace('/onTrackChange/i', '', $data);



$data = preg_replace('/onUndo/i', '', $data);



$data = preg_replace('/onUnload/i', '', $data);



$data = preg_replace('/onURLFlip/i', '', $data);



$data = preg_replace('/seekSegmentTime/i', '', $data);



$data = str_replace('.../', '', $data);



$data = str_replace('../', '', $data);



$data = str_replace('./', '', $data);



$data = str_replace('...\\', '', $data);



$data = str_replace('..\\', '', $data);



$data = str_replace('.\\', '', $data);



$data = str_replace('_', '', $data);



$data = str_replace(';', '', $data);



$data = str_replace('(', '', $data);



$data = str_replace(')', '', $data);



do



{



// Remove really unwanted tags



$old_data = $data;



$data = preg_replace('#</*(?:applet|b(?:ase|gsound|link)|embed|frame(?:set)?|i(?:frame|layer)|l(?:ayer|ink)|meta|object|s(?:cript|tyle)|title|xml)[^>]*+>#i', '', $data);



}



while ($old_data !== $data);



// we are done...



//echo $data."<br/>";



return $data;



}



function backup_tables($host,$user,$pass,$name,$tables = '*')



{	



include("config.php");



$link = mysqli_connect($host,$user,$pass);



@mysqli_select_db($name,$link);



//get all of the tables



if($tables == '*')



{



$tables = array();



$result = mysqli_query($connection,'SHOW TABLES');



while($row = mysqli_fetch_row($result))



{



$tables[] = $row[0];



}



}



else



{



$tables = is_array($tables) ? $tables : explode(',',$tables);



}



//cycle through



foreach($tables as $table)



{



$result = mysqli_query($connection,'SELECT * FROM '.$table);



$num_fields = mysqli_num_fields($result);



$return.= 'DROP TABLE '.$table.';';



$row2 = mysqli_fetch_row(mysqli_query($connection,'SHOW CREATE TABLE '.$table));



$return.= "\n\n".$row2[1].";\n\n";



for ($i = 0; $i < $num_fields; $i++) 



{



while($row = mysqli_fetch_row($result))



{



$return.= 'INSERT INTO '.$table.' VALUES(';



for($j=0; $j<$num_fields; $j++) 



{



$row[$j] = addslashes($row[$j]);



$row[$j] = ereg_replace("\n","\\n",$row[$j]);



if (isset($row[$j])) { $return.= '"'.$row[$j].'"' ; } else { $return.= '""'; }



if ($j<($num_fields-1)) { $return.= ','; }



}



$return.= ");\n";



}



}



$return.="\n\n\n";



}



//save file



$handle = fopen('db-backup-'.@date('dmy').'-'.@date('Gis').'-'.(md5(implode(',',$tables))).'.sql','w+');



fwrite($handle,$return);



fclose($handle);



}



function show_header_menu($parent,$connection,$db,$table, $cms_file,$rewritepath)



{ 



global $rewritepath, $connection, $db, $tblpref, $uploadpath;



$column_set = "*";



$condition = sprintf("cms_id=%d AND cms_type='cms' ",$parent);



$order_by = "cms_id";



$page_res = select_multiple_records($connection,$table,$column_set,$condition,$order_by,__FILE__,__LINE__);



while($row_menu = mysqli_fetch_array($page_res))



{



$condition = sprintf("cms_parent='%s'",$row_menu[cms_id]);



$rowCount  = count_table_record($connection,$table,$condition,__FILE__,__LINE__);



$column_set = "*";



$condition = sprintf("cms_parent=%d ",$row_menu[cms_id]);



$page_res2 = select_multiple_records($connection,$table,$column_set,$condition,$order_by,__FILE__,__LINE__);



if($row_menu[cms_id]== "45454545454")



{  ?>



<li><a href="<?=$rewritepath?>index.php/content/"  ><?php echo $row_menu[cms_title]?></a>



<?php			



}



else



if($row_menu[cms_id]!= "3000")



{  ?>



<li <?php if($rowCount > 0 ){?>class='<?php if($_GET[cid]==$row_menu[cms_id] || $_GET[cid]==$row_menu[cms_id]){?>active<?php }?>'<?php } ?>



<?php if($_GET[cid]==$row_menu[cms_id] || $_GET[cid]==$row_menu[cms_id]){?>class="active"<?php }?>><a href="<?=$cms_file?>cid/<?php echo $row_menu[cms_id]?>/<?php echo str_replace(" ","-",preg_replace('/\s\s+/', ' ', strtolower(trim(stripslashes($row_menu[cms_title])))))?>/"  ><?php echo $row_menu[cms_title]?></a>



<?php			



}



else				



{	?>



<li <?php if($_GET[cid]==$row_menu[cms_id] || $_GET[pid]==$row_menu[cms_id]){?>class="active"<?php }?> ><a href="#" <?php if($rowCount > 0 && $row_menu[cms_id]!="12" && $row_menu[cms_id]!="13"){?>rel="submenu1<?=$row_menu[cms_id]?>"<?php } ?>><?php echo $row_menu[cms_title]?></a>



<?php			}



if ($rowCount>0)



{	



?>



<ul class="sub-menu">



<?php				while($row_menuchild = mysqli_fetch_array($page_res2))						



{



show_header_menu($row_menuchild[cms_id],$connection,$db,$table, $cms_file, $rewritepath);



}



?>



</ul>				



</li>



<?php



}



}



}



function check_moduel_name($cur_moduel,$tblpref,$db,$sitepath,$siteurl,$path1,$ckpath,$row_admin)



{



global $rewritepath, $connection, $db, $tblpref, $uploadpath;



$table_name = $tblpref."moduel";



$column_set = "mod_title,mod_name";



$condition = sprintf("mod_name='%s'",$cur_moduel);



$row1 = select_single_record($connection,$table_name,$column_set,$condition,__FILE__,__LINE__);



if($row1[mod_title] == NULL)



{



return $mod_tit = $row1[mod_name];



}



else



{



return $mod_tit = $row1[mod_title];



}



}



function check_moduel_add_permission($cur_moduel,$tblpref,$db,$sitepath,$siteurl,$path1,$ckpath,$row_admin)



{



global $rewritepath, $connection, $db, $tblpref, $uploadpath;



$table_name = $tblpref."moduel";



$column_set = "mod_id";



$condition = sprintf("mod_name=%d ",$cur_moduel);



$row1 = select_single_record($connection,$table,$column_set,$condition,__FILE__,__LINE__);



$table_name2 = $tblpref."admin_access";



$condition = sprintf("acc_user='%d' AND acc_moduel='%d' AND acc_per='1'",$row_admin[admin_id], $row1[mod_id]);



return $rowCount  = count_table_record($connection,$table_name2,$condition,__FILE__,__LINE__);



}



function check_moduel_edit_permission($cur_moduel,$tblpref,$db,$sitepath,$siteurl,$path1,$ckpath,$row_admin)



{	



$table_name = $tblpref."moduel";



$column_set = "mod_id";



$condition = sprintf("mod_name=%d ",$cur_moduel);



$row1 = select_single_record($connection,$table,$column_set,$condition,__FILE__,__LINE__);



$table_name2 = $tblpref."admin_access";



$condition = sprintf("acc_user='%d' AND acc_moduel='%d' AND acc_per='2'",$row_admin[admin_id], $row1[mod_id]);



return $rowCount  = count_table_record($connection,$table_name2,$condition,__FILE__,__LINE__);



}



function check_moduel_del_permission($cur_moduel,$tblpref,$db,$sitepath,$siteurl,$path1,$ckpath,$row_admin)



{



$table_name = $tblpref."moduel";



$column_set = "mod_id";



$condition = sprintf("mod_name=%d ",$cur_moduel);



$row1 = select_single_record($connection,$table,$column_set,$condition,__FILE__,__LINE__);



$table_name2 = $tblpref."admin_access";



$condition = sprintf("acc_user='%d' AND acc_moduel='%d' AND acc_per='3'",$row_admin[admin_id], $row1[mod_id]);



return $rowCount  = count_table_record($connection,$table_name2,$condition,__FILE__,__LINE__);



}



//count records



function count_table_record($connection,$table,$condition=null,$file,$line)



{	

//echo $condition;exit();
//print_r($connection);
if($condition==null)



{

$cond="";

}



else



{



$cond = " WHERE ".$condition;



}



$query = "SELECT * FROM ".$table.$cond.$orderby;


//echo $query;exit();
if(!($res_query=mysqli_query($connection,$query)))



{



echo "ERROR : ".mysqli_error($connection)."<br/>".$query.".<br>LINE : ".$line."<br>FILE : ".$file;



}



$row_count = mysqli_num_rows($res_query);

// print_r($row_count);
//echo $query;

return $row_count;



}



function count_table_record_show($connection,$table,$condition=null,$file,$line)



{	



if($condition==null)



{



}



else



{



$cond = " WHERE ".$condition;



}



return $query = "SELECT * FROM ".$table.$cond.$orderby;



if(!($res_query=mysqli_query($connection,$query)))



{



echo "ERROR : ".mysqli_error($connection)."<br/>".$query.".<br>LINE : ".$line."<br>FILE : ".$file;



}



$row_count = mysqli_num_rows($res_query);



$row_count;



}



function count_table_record_short($connection,$table,$condition=null,$file,$line)



{	



if($condition==null)



{



}



else



{



$cond = " WHERE ".$condition;



}



$query = sprintf("SELECT * FROM ".$table.$cond.$orderby);



if(!($res_query=mysqli_query($connection,$query)))



{



echo "ERROR : in parameters";



}



$row_count = mysqli_num_rows($res_query);



return $row_count;



}



//count Condision Distinct



function count_table_record_dis($connection,$table,$fealds,$condition=null,$file,$line)



{	



if($condition==null)



{



}



else



{



$cond = " WHERE ".$condition;



}



$query = sprintf("SELECT * FROM ".$table.$cond.$orderby);



if(!($res_query=mysqli_query($connection,$query)))



{



echo "ERROR : ".mysqli_error($connection)."<br/>".$query.".<br>LINE : ".$line."<br>FILE : ".$file;



}



$row_count = mysqli_num_rows($res_query);



return $row_count;



}



//count Condision Distinct



function count_table_record_dis_short($connection,$table,$fealds,$condition=null,$file,$line)



{	



if($condition==null)



{



}



else



{



$cond = " WHERE ".$condition;



}



$query = sprintf("SELECT * FROM ".$table.$cond.$orderby);



if(!($res_query=mysqli_query($connection,$query)))



{



echo "ERROR : in parameters";



}



$row_count = mysqli_num_rows($res_query);



return $row_count;



}



//select records



function select_single_record($connection,$table,$fealds,$condition=null,$file,$line)



{



if($condition==null)



{



}



else



{



$cond = " WHERE ".$condition;



}



$query = "SELECT ".$fealds." FROM ".$table.$cond;



if(!($res_query=mysqli_query($connection,$query)))



{



echo "ERROR : ".mysqli_error($connection)."<br/>".$query.".<br>LINE : ".$line."<br>FILE : ".$file;



}



$row = mysqli_fetch_array($res_query);



return $row;



}



//select records



function select_single_record_short($connection,$table,$fealds,$condition=null,$file,$line)



{



if($condition==null)



{



}



else



{



$cond = " WHERE ".$condition;



}



$query = "SELECT ".$fealds." FROM ".$table.$cond;



if(!($res_query=mysqli_query($connection,$query)))



{



echo "ERROR : in parameters";



}



$row = mysqli_fetch_array($res_query);



return $row;



}



function select_single_record_show($connection,$table,$fealds,$condition=null,$file,$line)



{



if($condition==null)



{



}



else



{



$cond = " WHERE ".$condition;



}



echo $query = "SELECT ".$fealds." FROM ".$table.$cond;



if(!($res_query=mysqli_query($connection,$query)))



{



echo "ERROR : in parameters";



}



$row = mysqli_fetch_array($res_query);



return $row;



}



function select_multiple_records($connection,$table,$fealds,$condition=null,$orderby="",$file,$line,$test=0)



{



if($condition==null)



{



}



else



{



$cond = " WHERE ".$condition;



}



if($orderby!="")



{



$orderby = " ORDER BY ".$orderby;



}



$query = "SELECT ".$fealds." FROM ".$table." ".$cond.$orderby;



if($test==1){



echo $query;exit;



}



if(!($res_query=mysqli_query($connection,$query)))



{



echo "ERROR : ".mysqli_error($connection)."<br/>".$query.".<br>LINE : ".$line."<br>FILE : ".$file;



}



return $res_query;



}



function select_multiple_records_show($connection,$table,$fealds,$condition=null,$orderby="",$file,$line)



{



if($condition==null)



{



}



else



{



$cond = " WHERE ".$condition;



}



if($orderby!="")



{



$orderby = " ORDER BY ".$orderby;



}



echo $query = "SELECT ".$fealds." FROM ".$table." ".$cond.$orderby;



if(!($res_query=mysqli_query($connection,$query)))



{



echo "ERROR : ".mysqli_error($connection)."<br/>".$query.".<br>LINE : ".$line."<br>FILE : ".$file;



}



return $res_query;



}



function select_multiple_records_group($connection,$table,$fealds,$condition=null,$groupby="",$orderby="",$file,$line)



{



if($condition==null)



{



}



else



{



$cond = " WHERE ".$condition;



}



if($orderby!="")



{



$orderby = " ORDER BY ".$orderby;



}



if($groupby!="")



{



$groupby = " GROUP BY ".$groupby;



}



$query = "SELECT ".$fealds." FROM ".$table." ".$cond.$groupby.$orderby;



if(!($res_query=mysqli_query($connection,$query)))



{



echo "ERROR : ".mysqli_error($connection)."<br/>".$query.".<br>LINE : ".$line."<br>FILE : ".$file;



}



return $res_query;



}



function select_multiple_records_group_show($connection,$table,$fealds,$condition=null,$groupby="",$orderby="",$file,$line)



{



if($condition==null)



{



}



else



{



$cond = " WHERE ".$condition;



}



if($orderby!="")



{



$orderby = " ORDER BY ".$orderby;



}



if($groupby!="")



{



$groupby = " ORDER BY ".$groupby;



}



echo $query = "SELECT ".$fealds." FROM ".$table." ".$cond.$groupby.$orderby;



if(!($res_query=mysqli_query($connection,$query)))



{



echo "ERROR : ".mysqli_error($connection)."<br/>".$query.".<br>LINE : ".$line."<br>FILE : ".$file;



}



return $res_query;



}



function select_multiple_records_short($connection,$table,$fealds,$condition=null,$orderby="",$file,$line)



{



if($condition==null)



{



}



else



{



$cond = " WHERE ".$condition;



}



if($orderby!="")



{



$orderby = " ORDER BY ".$orderby;



}



$query = sprintf("SELECT ".$fealds." FROM ".$table." ".$cond.$orderby);



if(!($res_query=mysqli_query($connection,$query)))



{



echo "ERROR : in parameters";



}



return $res_query;



}



// update



function add_record($connection,$table,$fealds,$file,$line,$test='')



{



$query = sprintf("INSERT INTO ".$table." SET ".$fealds);



if($test==1) {echo $query;exit;}



if(!($res_query=mysqli_query($connection,$query)))



{



echo "ERROR : ".mysqli_error($connection)."<br/>".$query.".<br>LINE : ".$line."<br>FILE : ".$file;



}



$inserted_id = mysqli_insert_id($connection);



return $inserted_id;



}



// update



function add_record_short($connection,$table,$fealds,$file,$line)



{



$query = sprintf("INSERT INTO ".$table." SET ".$fealds);



if(!($res_query=mysqli_query($connection,$query)))



{



echo "ERROR : in parameters";



}



$inserted_id = mysqli_insert_id($connection);



return $query;



}



// update



function update_record($connection,$table,$fealds,$condition=null,$file,$line,$test=0)



{



if($condition==null)



{



}



else



{



$cond = " WHERE ".$condition;



}



$query = sprintf("UPDATE ".$table." SET ".$fealds." ".$cond);



if($test==1) { echo $query;exit;}



if(!($res_query=mysqli_query($connection,$query)))



{



echo "ERROR : ".mysqli_error($connection)."<br/>".$query.".<br>LINE : ".$line."<br>FILE : ".$file;



}



}



function update_record_show($connection,$table,$fealds,$condition=null,$file,$line)



{



if($condition==null)



{



}



else



{



$cond = " WHERE ".$condition;



}



echo $query = sprintf("UPDATE ".$table." SET ".$fealds." ".$cond);



if(!($res_query=mysqli_query($connection,$query)))



{



echo "ERROR : ".mysqli_error($connection)."<br/>".$query.".<br>LINE : ".$line."<br>FILE : ".$file;



}



}



// update



function update_record_short($connection,$table,$fealds,$condition=null,$file,$line)



{



if($condition==null)



{



}



else



{



$cond = " WHERE ".$condition;



}



$query = sprintf("UPDATE ".$table." SET ".$fealds." ".$cond);



if(!($res_query=mysqli_query($connection,$query)))



{



echo "ERROR : in parameters";



}



}



// Delete



function delete_record($connection,$table,$condition,$file,$line)



{



$cond = " WHERE ".$condition;



$query = sprintf("DELETE FROM ".$table." ".$cond);



if(!($res_query=mysqli_query($connection,$query)))



{



echo "ERROR : ".mysqli_error($connection)."<br/>".$query.".<br>LINE : ".$line."<br>FILE : ".$file;



}



}



// Delete



function delete_record_short($connection,$table,$condition,$file,$line)



{



$cond = " WHERE ".$condition;



$query = sprintf("DELETE FROM ".$table." ".$cond);



if(!($res_query=mysqli_query($connection,$query)))



{



echo "ERROR : in parameters";



}



}



function create_table($connection,$table,$fealds,$file,$line)



{



$query = sprintf("CREATE TABLE IF NOT EXISTS ".$table." ( ".$fealds." ) ENGINE = MYISAM");



if(!($res_query=mysqli_query($connection,$query)))



{



echo "ERROR : ".mysqli_error($connection)."<br/>".$query.".<br>LINE : ".$line."<br>FILE : ".$file;



}



}



function get_product_price($connection,$tblpref,$prod)



{



$table_name_prod = $tblpref."products";



$feald_set_prod = "prod_special,prod_spc_price,prod_std_price,prod_promotion_id,prod_promo_price";



$condition_prod = sprintf("prod_id='%d'",$prod);



$row_prod = select_single_record($connection,$table_name_prod,$feald_set_prod,$condition_prod,__FILE__,__LINE__);



if($row_prod[prod_promotion_id] != NULL)



{



$table_name_promo = $tblpref."promotions";



$column_set_promo = "*";



$condition_promo = sprintf("promo_id='%d'",$row_prod[prod_promotion_id]);



$row_promo = select_single_record($connection,$table_name_promo,$column_set_promo,$condition_promo,__FILE__,__LINE__);



$todaysDate = date('Y-m-d');



$startDate = $row_promo[promo_date_from];



$endDate  = $row_promo[promo_date_to];



if(($todaysDate >= $startDate) AND ($todaysDate <= $endDate))



{ 



return $sell_price = $row_prod[prod_promo_price];



}



else



{ 



if($row_prod[prod_special]=='1')



{ 



return $sell_price = $row_prod[prod_spc_price];



}



else



{ 



return $sell_price = $row_prod[prod_std_price];



}    		



}



}



else



{ 



if($row_prod[prod_special]=='1')



{ 



return $sell_price = $row_prod[prod_spc_price];



}



else



{ 



return $sell_price = $row_prod[prod_std_price];



}



}



//$row_prod[prod_special];



/*if($row_prod[prod_special]=="1")



{ 



return $sell_price = $row_prod[prod_spc_price];



}



else



{ 



return $sell_price = $row_prod[prod_std_price];



}	*/



}



function get_product_price_admin($connection,$tblpref,$prod,$custid)



{



$table_name_cust = $tblpref."customers";



$feald_set_cust = "cust_pick_store";



$condition_cust = sprintf("cust_id='%d'",$custid);



$row_cust = select_single_record($connection,$table_name_cust,$feald_set_cust,$condition_cust,__FILE__,__LINE__);



$table_name_ctype = $tblpref."cust_typ";



$feald_set_ctype = "typ_stat,typ_id";



$condition_ctype = sprintf("typ_id='%d'",$row_cust[cust_type]);



$row_ctype = select_single_record($connection,$table_name_ctype,$feald_set_ctype,$condition_ctype,__FILE__,__LINE__);



if($row_ctype[typ_stat]=="1")



{



return "enqonly";



}



else



{



$table_name_prod = $tblpref."prod";



$feald_set_prod = "prod_id,prod_name,prod_code,prod_cost, prod_type,prod_dalow";



$condition_prod = sprintf("prod_id='%d'",$prod);



$row_prod = select_single_record($connection,$table_name_prod,$feald_set_prod,$condition_prod,__FILE__,__LINE__);



if($row_prod[prod_dalow]=="1")



{



return "enqonly";



}



else



{



//sel cat margin



$table_name_cat_mar = $tblpref."cat_margin";



$feald_set_cat_mar = "mar_value";



$condition_cat_mar = sprintf("mar_ctyp='%d' AND mar_cat='%d'",$row_ctype[typ_id],$row_prod[prod_type]);



$row_cat_mar = select_single_record($connection,$table_name_cat_mar,$feald_set_cat_mar,$condition_cat_mar,__FILE__,__LINE__); 



//sel cat disc



$table_name_cat_dis = $tblpref."cat_discount";



$feald_set_cat_dis = "dis_value";



$condition_cat_dis = sprintf("dis_ctyp='%d' AND dis_cat='%d'",$row_ctype[typ_id],$row_prod[prod_type]);



$row_cat_dis = select_single_record($connection,$table_name_cat_dis,$feald_set_cat_dis,$condition_cat_dis,__FILE__,__LINE__); 



//prod disc														



$table_name_prod_disc = $tblpref."prod_discount";



$feald_set_prod_disc = "dis_value";



$condition_prod_disc = sprintf("dis_ctyp='%d' AND dis_cat='%d'",$row_ctype[typ_id],$row_prod[prod_id]);



$row_prod_disc = select_single_record($connection,$table_name_prod_disc,$feald_set_prod_disc,$condition_prod_disc,__FILE__,__LINE__); 



//prod spec price														



$table_name_spec_prc = $tblpref."prod_special_price";



$feald_set_spec_prc = "dis_value";



$condition_spec_prc = sprintf("dis_ctyp='%d' AND dis_cat='%d'",$row_ctype[typ_id],$row_prod[prod_id]);



$row_spec_prc = select_single_record($connection,$table_name_spec_prc,$feald_set_spec_prc,$condition_spec_prc,__FILE__,__LINE__); 



if($row_spec_prc[dis_value]>0)



{



$sell_price = $row_spec_prc[dis_value];



$table_name_ctop = $tblpref."cat_topup";



$condition_ctop = sprintf("top_cat='%d' AND top_pickstor='%d'",$row_prod[prod_cat],$row_cust[cust_pick_store]);



$column_set_ctop = "top_val";



$row_ctop = select_single_record($connection,$table_name_ctop,$column_set_ctop,$condition_ctop,__FILE__,__LINE__);



if($row_ctop[top_val]>0)



{



$sell_price = $sell_price + (($sell_price/100)*$row_ctop[top_val]);



}



else



{



$sell_price;



}



}



else



if($row_prod_disc[dis_value]>0)



{



$pr_marg = $row_cat_mar[mar_value]+0;



$sell_price = $row_prod[prod_cost];



$table_name_ctop = $tblpref."cat_topup";



$condition_ctop = sprintf("top_cat='%d' AND top_pickstor='%d'",$row_prod[prod_cat],$row_cust[cust_pick_store]);



$column_set_ctop = "top_val";



$row_ctop = select_single_record($connection,$table_name_ctop,$column_set_ctop,$condition_ctop,__FILE__,__LINE__);



$pr_cost = $sell_price + (($sell_price/100)*$row_ctop[top_val]);



$dis_val = $row_prod_disc[dis_value];



$cost_with_marg = $pr_cost + (($pr_cost/100)*$pr_marg);



$sell_price = $cost_with_marg - (($cost_with_marg/100)*$dis_val);



}



else



if($row_cat_dis[dis_value]>0)



{



$pr_marg = $row_cat_mar[mar_value]+0;



$sell_price = $row_prod[prod_cost];



$table_name_ctop = $tblpref."cat_topup";



$condition_ctop = sprintf("top_cat='%d' AND top_pickstor='%d'",$row_prod[prod_cat],$row_cust[cust_pick_store]);



$column_set_ctop = "top_val";



$row_ctop = select_single_record($connection,$table_name_ctop,$column_set_ctop,$condition_ctop,__FILE__,__LINE__);



$pr_cost = $sell_price + (($sell_price/100)*$row_ctop[top_val]);



$dis_val = $row_cat_dis[dis_value];



$cost_with_marg = $pr_cost + (($pr_cost/100)*$pr_marg);



$sell_price = $cost_with_marg - (($cost_with_marg/100)*$dis_val);



}



else



{



$sell_price = $row_prod[prod_cost];



$table_name_ctop = $tblpref."cat_topup";



$condition_ctop = sprintf("top_cat='%d' AND top_pickstor='%d'",$row_prod[prod_cat],$row_cust[cust_pick_store]);



$column_set_ctop = "top_val";



$row_ctop = select_single_record($connection,$table_name_ctop,$column_set_ctop,$condition_ctop,__FILE__,__LINE__);



$pr_cost = $sell_price + (($sell_price/100)*$row_ctop[top_val]);



$sell_price = $pr_cost;



}



return $sell_price;



}



}



}



function count_digit($number)



{



//$number = var_dump((int)($number));



return strlen((string) $number);



}