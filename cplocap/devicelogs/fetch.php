<?php
@session_start();
include("../../common/app_function.php");
include("../../common/config.php");


if($_GET['deviceid']!="")
{
	$deviceid = $_GET['deviceid'];
	$condition[]="device_id='$deviceid'";	
}	



if(is_array($condition))
{
	$condition= implode(" AND ",$condition);
}

$table_name = $tblpref."device";
$rowCount  = count_table_record($connection,$table_name,$condition,__FILE__,__LINE__);

$column_set = "id,device_id,power_type,description,event_date,added_on";
$order_by = "id DESC";
$page_res = select_multiple_records($connection,$table_name,$column_set,$condition,$order_by,__FILE__,__LINE__);

$array = array();
$arr=array();
$count=1;
if($rowCount>0){
while($row_user=mysqli_fetch_array($page_res))
{ 

	$arr['deviceid']=$row_user['device_id'];

	$arr['count'] = $count;
	// $arr[location] = stripslashes($row_user[power_type]);
	//$arr[branch] = stripslashes($row1[br_title]);
	$arr['powertype'] = stripslashes($row_user['power_type']);
	$arr['description'] = stripslashes($row_user['description']);
	$arr['event'] = stripslashes($row_user['event_date']);
	$arr['added'] = stripslashes($row_user['added_on']);

	$array[] = $arr;
    $count=$count+1;
	
}echo json_encode($array);
}
else
{
  echo json_encode($arr);
}