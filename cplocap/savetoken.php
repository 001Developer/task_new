<?php 
include('../common/config.php');
include('../common/app_function.php');
$token = $_POST['token'];
$agentid = $_POST['repid'];
//exit();
$cur_date=@date("Y-m-d");
$table_name = $tblpref."agent";
$feals_set = sprintf("agent_token='%s'",$token);
$condition = sprintf("agent_id='%d'",$agentid);
update_record($connection,$table_name,$feals_set,$condition,__FILE__,__LINE__);

$array = array('success'=>true , 'msg'=>'Token Saved');
//echo json_encode($array);

?>