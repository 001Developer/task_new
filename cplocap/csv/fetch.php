<?php
@session_start();
include("../../common/app_function.php");
include("../../common/config.php");


// if($_GET[srcarea]!="")
// {
// 	$srcarea = $_GET[srcarea];
// 	$condition[]="fruite_name='$srcarea'";	
// }	

if($_GET[sub]!="")
{
	$sub = $_GET[sub];
	$condition[]="worker_fname =$sub";
}

if($_GET[subnum]!="")

{

	$srcdiscent = $_GET[subnum];

	$condition[]="worker_ad = '$srcdiscent'";	

}

if($_GET[contry]!="")

{

	$srcdiscent1 = $_GET[contry];

	$condition[]="worker_state = '$srcdiscent1'";	

}

if($_GET[city]!="")

{

	$city = $_GET[city];

	$condition[]="worker_city = '$city'";	

}

//$condition[] = "cat_title !=''";

if(is_array($condition))
{
	$condition= implode(" AND ",$condition);
}

$table_name = $tblpref."worker";
$rowCount  = count_table_record($connection,$table_name,$condition,__FILE__,__LINE__);

$column_set = "worker_id,worker_fname,worker_lname,worker_city,	worker_state,worker_adby,worker_ad,worker_tel,worker_address";
$order_by = "worker_fname ASC";
$page_res = select_multiple_records($connection,$table_name,$column_set,$condition,$order_by,__FILE__,__LINE__);

$array = array();
$arr=array(); 
$count=1;
if($rowCount>0){
while($row_user=mysqli_fetch_array($page_res))
{ 
	$arr[id]=$row_user[worker_id];
	$arr[count] = $count;
	$arr[title] = $row_user[worker_fname]." ".$row_user[worker_lname];
	$table_name1 = $tblpref."farmer";
	$condition1 = sprintf("farmer_id='%d'",$row_user[worker_adby]);

	$feald_set1 = "*";

	$row1 = select_single_record($connection,$table_name1,$feald_set1,$condition1,__FILE__,__LINE__);


	$arr[name] =$row1[farmer_fname]." ".$row1[farmer_lname];

	$arr[cellno] =$row_user[worker_tel];

	$arr[state] =$row_user[worker_state];

	$arr[city] =$row_user[worker_city];

	$arr[adnum] =$row_user[worker_ad];

	

	

	$arr[address] =$row_user[worker_address];

	$arr[status] =$row_user[worker_status];
	$array[] = $arr;
    $count=$count+1;
	
}echo json_encode($array);
}
else
{
  echo json_encode($arr);
}