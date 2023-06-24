<?php
include('common/config.php');
include('common/app_function.php');
$title = "Dashboard";
index_header($title,$rewritepath,$tblpref,$db,$row_admin, $siteuploadpath);
if($_SESSION[cust_id]=="")
{ ?>
	<body onload="document.frm.submit();">
	<form name="frm" method="POST" action="<?php echo $rewritepath;?>error/">
	</form>
	</body>
	<?php
	exit;
}
$cust_id = $_SESSION[cust_id];
$query=sprintf("select * from ".$tblpref."customer where cust_id ='%s'",$cust_id);
if(!($result=mysql_query($query))){echo $query.mysql_error(); exit;}
$row_cus=mysql_fetch_array($result);
$userval = preg_chk($_SESSION['userval']);

$flag=$_POST[flag];

//search orders 
$sel_orders = sprintf("SELECT * FROM ".$tblpref."order WHERE ord_cus_id='%d' AND ord_status!='deliverd' AND ord_pay_status='paid' ORDER BY ord_id DESC",$cust_id);
if(!($res_orders=mysql_query($sel_orders))){echo $sel_orders.mysql_error(); exit;}
$num_orders = mysql_num_rows($res_orders);

//running orders 
$sel_running_orders = sprintf("SELECT * FROM ".$tblpref."order WHERE ord_cus_id='%d' AND ord_status!='deliverd' AND ord_status!='cancelled' AND ord_pay_status='paid' ORDER BY ord_id DESC",$cust_id);
if(!($res_running_orders=mysql_query($sel_running_orders))){echo $sel_running_orders.mysql_error(); exit;}
$num_running_orders = mysql_num_rows($res_running_orders);

?>
<main>
	<div class="main">
    	<div class="container">
        	<section class="title-section">
                <ol class="breadcrumb">
                  <li><a href="<?php echo $rewritepath; ?>home/">Home</a></li>
				  <li><a href="<?php echo $rewritepath; ?>dashboard/">Dashboard</a></li>
                  <li class="active">Update Profile</li>
                </ol> 
            </section>
			<h1>Update Profile</h1>
            
            
            	    <form role="form">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>First Name:</label>
                                <input type="text" placeholder="First Name" id="" class="form-control" value="Amit">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Last Name:</label>
                                <input type="text" placeholder="Last Name" id="" class="form-control" value="Pise">
                            </div>
                        </div>
                        
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Customer Number:</label>
                                <input type="text" placeholder="Customer No." id="" class="form-control" value="012345">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Utility Contract Number:</label>
                                <input type="text" placeholder="Utility Contract Number" id="" class="form-control" value="00000">
                            </div>
                        </div>
                       
                        
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Identity Document type:</label>
                                <input type="text" placeholder="Identity Document type" id="" class="form-control" value="Passport">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Identity Number:</label>
                                <input type="text" placeholder="Identity Number" id="" class="form-control" value="012345678">
                            </div>
                        </div>
                        
                     </div> <!--/row-->
                     <div class="row">  
                         
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Physical Address:</label>
                                <textarea required placeholder="Address" id="" rows="4" class="form-control" >Lorem ipsum dolor sit amet, &#10;consectetur adipiscing elit &#10;Gaborone, Botswana</textarea>
                            </div>
                            <div class="form-group">
                                <label>City:</label>
                                <input type="text" placeholder="City" id="" class="form-control" value="Gaborone">
                            </div>
                        </div>
                        
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Tel:</label>
                                <input type="text" placeholder="Telephone No." id="" class="form-control" value="0123456789">
                            </div>
                            <div class="form-group">
                                <label>Cell:</label>
                                <input type="text" placeholder="Cell No." id="" class="form-control" value="0123456789">
                            </div>
                            <div class="form-group">
                                <label>E-mail:</label>
                                <input type="text" placeholder="E-mail ID" id="" class="form-control" value="amit@weblogic.co.bw">
                            </div>
                        </div>
                      
                      </div><!--/row-->
                      <div class="row">  

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Username:</label>
                                <input type="text" placeholder="Username" id="" class="form-control" value="amit123">
                            </div>
                        </div>

                    </div><!--/row-->
                    
                    <div class="form-group">
                    <button class="btn btn-default" type="submit">Update</button>
                    </div>
                    
                  </form>

				
            
            
           
        </div>
    </div>
</main>
<?php admin_footer('../'); ?>