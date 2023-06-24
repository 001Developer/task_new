<?php
@session_start();
include("../../common/config.php");
include("../../common/app_function.php");

$id= $_GET[id];
$rid= $_GET[rid];

$table_name = $tblpref."gallery";
$condition = sprintf("img_id='%d'",$rid);
delete_record($connection,$table_name,$condition,__FILE__,__LINE__);

header("Location:add.php?flag=imgdel&id=".$id);
exit;