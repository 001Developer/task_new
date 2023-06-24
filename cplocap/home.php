<?php
@session_start();
include("../common/config.php");
include("../common/app_function.php");

if($_SESSION['username']=="")
{
	displayerror("Login Error.","","For security of your account,we have expired your session.<br>&nbsp;Please login to your account again.", "Login,index.php", 0);
	exit();
}

$flag = $_GET['flag'];
$cur_moduel = basename(__DIR__);

$files = glob($directory . "*");




admin_header('../',$mod_tit." List",$tblpref,$db,$sitepath,$siteurl,$path1,$ckpath,$row_admin);

	admin_nav('../',$mod_tit.' list',$tblpref,$db,$sitepath,$siteurl,$path1,$ckpath,$row_admin,$connection); ?>
	<div class="col-sm-9 col-md-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">	
<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header">Dashboard</h1>
	</div>
</div><!--/.row-->

<div class="row">
	<div class="col-xs-12 col-md-6 col-lg-4">
		<div class="panel panel-blue">
			<div class="panel-heading dark-overlay"><i class="fa fas fa-map fa-fw" aria-hidden="true"></i>&nbsp;&nbsp;Descriptions</div>
			<div class="panel-body">
				<ul class="todo-list">
				<?php 
				$array=array();
					$table_name = $tblpref."device";
					$column_set = "id,device_id,description";
					$order_by = "id";

					$res_query = select_multiple_records($connection,$table_name,$column_set,$condition_prod,$order_by,__FILE__,__LINE__);
					while($row_city=mysqli_fetch_array($res_query))
					{ 
						$array[]=$row_city['description'];
					}
						 
						 ?>
							
						<?php 
					

						$array = array_unique($array);
						

							foreach ($array as $value) {
								?>
								 <li class="todo-list-item">							
								<div class="checkbox">
									<label for="checkbox"><?php echo stripslashes($value); ?></label>
								</div>
								<div class="pull-right action-buttons"> 
							</div>
							</li> 
								<?php

               }
					 ?>
				 </ul>
			
			</div>
		</div>
	</div> 

	<div class="row">
	<div class="col-xs-12 col-md-6 col-lg-4">
		<div class="panel panel-blue">
			<div class="panel-heading dark-overlay"><i class="fa fas fa-map fa-fw" aria-hidden="true"></i>&nbsp;&nbsp;Total Device Execution</div>
			<div class="panel-body">
				<ul class="todo-list">
				<?php 
				$array1=array();
					$table_name = $tblpref."device";
					$column_set = "id,device_id";
					$order_by = "id";

					$res_query = select_multiple_records($connection,$table_name,$column_set,$condition_prod,$order_by,__FILE__,__LINE__);
					while($row_city=mysqli_fetch_array($res_query))
					{ 
						$array1[]=$row_city['device_id'];
					}
						 
						 ?>
						  
							
						<?php 
					

						$array1 = array_unique($array1);
						

							foreach ($array1 as $values) {
							
					       $condition_ord = sprintf("device_id='%s'",$values);
					  
					       $rowCount_ord  = count_table_record($connection,$table_name,$condition_ord,__FILE__,__LINE__); 

					     
					    
					 
								?>
								 <li class="todo-list-item">							
								<div class="checkbox">
									<label for="checkbox"><?php echo stripslashes($values); ?></label>
								</div>
								<div class="pull-right action-buttons"> 
										<span class="badge"><?php echo $rowCount_ord; ?></span>
							</div>
							</li> 
								<?php

               }
					 ?>
				 </ul>
			
			</div>
		</div>
	</div> 

	
	<div class="row">
	<div class="col-xs-12 col-md-6 col-lg-4">
		<div class="panel panel-blue">
			<div class="panel-heading dark-overlay"><i class="fa fas fa-map fa-fw" aria-hidden="true"></i>&nbsp;&nbsp;Crashed Device Ananlysis</div>
			<div class="panel-body">
				<ul class="todo-list">
				<?php 
				$array1=array();
					$table_name = $tblpref."device";
					$column_set = "id,device_id,event_date";
					$order_by = "id";

					$res_query = select_multiple_records($connection,$table_name,$column_set,null,$order_by,__FILE__,__LINE__);
					while($row_city=mysqli_fetch_array($res_query))
					{ 
						$array1[]=$row_city['device_id'];
						
					}
						 
						 ?>
						  
							
						<?php 
					

						$array1 = array_unique($array1);

			
					

					 
							
								foreach ($array1 as $values) {
							
					       			$table_name1 = $tblpref."device";
					$column_set1 = "id,device_id,event_date,description";
					$order_by1 = "id";
					$condition_ord1 = sprintf("device_id='%s' AND description='Unexpected shutdown'",$values);

					$res_query_new = select_multiple_records($connection,$table_name1,$column_set1,$condition_ord1,$order_by1,__FILE__,__LINE__);
					
					$rowCount_ord1  = count_table_record($connection,$table_name1,$condition_ord1,__FILE__,__LINE__); 
					    if($rowCount_ord1!=0)
					    {
					 
								?>
							
								 <li class="todo-list-item">							
								<div class="checkbox">
									<label for="checkbox"><?php echo stripslashes($values); ?></label>
								</div>
								<div class="pull-right action-buttons"> 
										<span class="badge"><?php echo $rowCount_ord1; ?></span>
					
							</div>
							</li> 
								<?php
							}

               }
					 ?>
				 </ul>
			
			</div>
		</div>
	</div> 
	<!-- <div class="col-xs-12 col-md-6 col-lg-4">
		<div class="panel panel-blue panel-widget ">
			<div class="row no-padding">
				<div class="col-sm-3 col-lg-5 widget-left">
					<svg class="glyph stroked bag"><use xlink:href="#stroked-bag"></use></svg>
					<i class="fa fa-product-hunt fa-4x" aria-hidden="true"></i>

				</div>
				<div class="col-sm-9 col-lg-7 widget-right">
					<div class="large countnumber"> -->
						<?php 
							// $table_name_prod = $tblpref."fruites";
							// $condition_prod = '';
							// $rowCount  = count_table_record($connection,$table_name_prod,$condition_prod,__FILE__,__LINE__); 
							// echo $rowCount; ?>
					<!-- </div>
					<div class="text-muted">Total Fruits</div>
				</div>
			</div>
		</div> -->

		<!-- <div class="panel panel-blue panel-widget ">
			<div class="row no-padding">
				<div class="col-sm-3 col-lg-5 widget-left"> -->
					<!-- <svg class="glyph stroked bag"><use xlink:href="#stroked-bag"></use></svg> -->
					<!-- <i class="fa fa-shopping-cart fa-4x" aria-hidden="true"></i>

				</div>
				<div class="col-sm-9 col-lg-7 widget-right">
					<div class="large countnumber"> -->
						<?php 
							// $table_name_ord = $tblpref."order";
							// $condition_ord = 'MONTH(ord_date)=MONTH(NOW()) AND YEAR(ord_date)=YEAR(NOW())';
							// $rowCount_ord  = count_table_record($connection,$table_name_ord,$condition_ord,__FILE__,__LINE__); 
							// $column_set_ord = "SUM(ord_total) AS total_cost";
							// $row1 = select_single_record($connection,$table_name_ord,$column_set_ord,$condition_ord,__FILE__,__LINE__);

							// echo $rowCount_ord; ?>
					<!-- </div>
					<div class="text-muted">Total Enquiry in this Month</div>
				</div>
			</div>
		</div>
	</div> -->


	<!-- <div class="col-xs-12 col-md-6 col-lg-4">
		<div class="panel panel-blue">
			<div class="panel-heading dark-overlay"><i class="fa fas fa-map fa-fw" aria-hidden="true"></i>&nbsp;&nbsp;Todays Orders</div>
			<div class="panel-body">
				<ul class="todo-list">
				<?php 

				//if($_SESSION[user_type]=="subadmin")
				//{
					//$condition_branch = sprintf("br_id='%d'",$row_admin[admin_branch]);
				//}
				//else
				//{
					//$condition_branch = "";
				//}

					// $table_name = $tblpref."branch";
					// $column_set = "*";
					// $order_by = "br_title";
					// $res_query = select_multiple_records($connection,$table_name,$column_set,$condition_branch,$order_by,__FILE__,__LINE__);
					// while($row_city=mysqli_fetch_array($res_query))
					// {  ?>
							<li class="todo-list-item">							
								<div class="checkbox">
									<label for="checkbox"><?php //echo stripslashes($row_city[br_title]); ?></label>
								</div>
								<div class="pull-right action-buttons">
								<?php
									// $table_name_prod = $tblpref."order";
									// $condition_prod = sprintf("ord_distribution='%d' AND ord_date=CURDATE()",$row_city[br_id]);
									
									// $rowCount_prod = count_table_record($connection,$table_name_prod,$condition_prod,__FILE__,__LINE__); ?>
									<span class="badge"><?php //echo $rowCount_prod; ?></span></div>
							</li>
						<?php 
						
					//} ?>
				</ul>
			
			</div>
		</div>
	</div> -->

<!-- </div> -->

<!-- <div class="row">
	<div class="col-lg-12">
		<div class="panel panel-default">
			
		</div>
	</div>
</div>/.row--> 


		
			
</div>
<?php
// for ($i =6; $i >= 0; $i--) {
//     $months[] = date("M Y", strtotime( date( 'Y-m-01' )." -$i months"));
// 	$monthdate = date("Y-m-d", strtotime( date( 'Y-m-01' )." -$i months"));
// 	//Curent month total transection amt
// 	$table_name_monthtrans = $tblpref."order";
// 	$column_set_monthtrans = "SUM(ord_total) AS crm_trans_amt";
// 	$condition_monthtrans = sprintf("MONTH(ord_date) = MONTH('%s') AND YEAR(ord_date) = YEAR('%s') ",$monthdate,$monthdate);
// 	$row_crm_monthtrans = select_single_record($connection,$table_name_monthtrans,$column_set_monthtrans,$condition_monthtrans,__FILE__,__LINE__);
// 	$js_data_arr[] = $row_crm_monthtrans[crm_trans_amt]+0;
// }


// //print_r($js_data_arr);
// $js_years = '["'.@implode('","',$months).'"]';
// //echo "abc";
// $js_data = '['.@implode(',',$js_data_arr).']';
?>
<script type="text/javascript">

var randomScalingFactor = function(){ return Math.round(Math.random()*1000)};

var lineChartData = {
			labels : <?php echo $js_years; ?>,
			datasets : [
				
				{
					label: "My Second dataset",
					fillColor : "rgba(48, 164, 255, 0.2)",
					strokeColor : "rgba(48, 164, 255, 1)",
					pointColor : "rgba(48, 164, 255, 1)",
					pointStrokeColor : "#fff",
					pointHighlightFill : "#fff",
					pointHighlightStroke : "rgba(48, 164, 255, 1)",
					//data : [200,250,260,0,0]
					data : <?php echo $js_data; ?>
				}
			]

		}

		window.onload = function(){
	var chart1 = document.getElementById("line-chart").getContext("2d");
	window.myLine = new Chart(chart1).Line(lineChartData, {
		responsive: true
	});
		};
</script>

<?php
	for ($i = 1; $i < 3; $i++) {
    //$js_years[] = date("F Y", strtotime( date( 'Y-m-01' )." -$i months"));
	$month_Name = date("F Y", strtotime( date( 'Y-m-01' )." -$i months"));

	$js_data = "200,200,200,200,200,200";

	$js_dataset = "{ label:".$month_Name.",fillColor : 'rgba(48, 164, 255, 0.2)',
					strokeColor : 'rgba(48, 164, 255, 1)',
					pointColor : 'rgba(48, 164, 255, 1)',
					pointStrokeColor : '#fff',
					pointHighlightFill : '#fff',
					pointHighlightStroke : 'rgba(48, 164, 255, 1)',
					data :data: ".$js_data."}";
}


?>

<script src="../js/chart.min.js"></script>
<!-- <script src="../js/chart-data.js"></script> -->

<?php admin_footer('../'); ?>
<script type="text/javascript">
$(".countnumber").each(function() {
  $(this)
    .prop("Counter", 0)
    .animate(
      {
        Counter: $(this).text()
      },
      {
        duration: 4000,
        easing: "swing",
        step: function(now) {
          $(this).text(Math.ceil(now));
        }
      }
    );
});
</script>
