//Count Records
$condition = sprintf("city_id='%d'",$id);
$table_name = $tblpref."city";
$rowCount  = count_table_record($connection,$table_name,$condition,__FILE__,__LINE__);


//fetch single record

$condition = sprintf("city_id='%d'",$id);
$column_set = "city_id,city_name";
$table_name = $tblpref."city";
$row1 = select_single_record($connection,$table_name,$column_set,$condition,__FILE__,__LINE__);

//fetch multiple record
$condition = sprintf("city_id='%d'",$id);
$column_set = "city_id,city_name";
$table_name = $tblpref."city";
$order_by = "city_id";
$page_res = select_multiple_records($connection,$table_name,$column_set,$condition,$order_by,__FILE__,__LINE__);

//add new record
$feals_set = sprintf("city_name='%s'",$sname);
$id = add_record($connection,$table_name,$feals_set,__FILE__,__LINE__);

//Update Record
$feals_set = sprintf("city_name='%s'",$sname);
$condition = sprintf("city_id='%d'",$id);
update_record($connection,$table_name,$feals_set,$condition,__FILE__,__LINE__);

//Delete Record
$condition = sprintf("city_id='%d'",$id);
delete_record($connection,$table_name,$condition,__FILE__,__LINE__);