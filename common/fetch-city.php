<?php 

    //include("config.php");
    include('app_function.php');
			//$ent = $_POST[cntry];
			 $val = $_POST[cntry];
$table_name = $tblpref."cities";
$condition = sprintf("city_country='%s'",$val);
$column_set = "city_id,city_name";
$order_by = "city_name ASC";
$page_res = select_multiple_records($connection,$table_name,$column_set,$condition,$order_by,__FILE__,__LINE__);
?>
 
 	<div id="subcontainercity">
 	  <label for="" class="bluetxt">City:<em>*</em></label>
<select id="city" name="city" class="form-control" onchange="dropdown(this.id);">
 <option value="">Select</option>
<?php
while($row_user=mysqli_fetch_array($page_res))
{ 
	if($row_user[city_name]!="")
	{ ?>
		<option value="<?php echo $row_user[city_id]; ?>"><?php echo stripslashes($row_user[city_name]); ?></option>
		<?php
	}
}

?>
 </select> 

 </div>



<!--    <?php 

   //  require("common/config.php");
			// $ent = $_POST[cat];
			// $querysubcat = sprintf("SELECT * FROM " . $tblpref . "anc_subcat WHERE anc_subcat_parent='%s' ORDER BY anc_subcat_id ASC",$ent);
			// if(!($resultsubcat = mysql_query($querysubcat))) { echo "Query - " . $querysubcat . "<br />Error - " . mysql_error(); exit; }
			// $cnt_subcat = mysql_num_rows($resultsubcat);
?>

                  <div class="form-group" id="sub1">
                    <label for="scat" >SubCategory:</label>
<select class="form-control" name="subcategory" id="subcat" class="smlslct" onchange="dropdown(this.id);">
				<option value="">Please Select </option>
							<?php
								
								// if($cnt_subcat > 0)
								// {
								// 	$cnt = 1;
								// 	while($rowssubcat = mysql_fetch_array($resultsubcat)) 
								// 	{
								// 	?>
								// 			<option value="<?//=$rowssubcat['anc_subcat_name'];?>" ><?//=$rowssubcat['anc_subcat_name'];?></option>
								// 	<?php
								// 		$cnt = $cnt+1;
								// 	}
								// }
							?>
				
			</select>

			 </div> -->

                 