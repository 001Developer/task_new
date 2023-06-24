<?php
@session_start();
include("../../common/config.php");
include("../../common/app_function.php");

if(isset($_POST['importSubmit'])){
    
    // Allowed mime types
    $csvMimes = array('text/x-comma-separated-values', 'text/comma-separated-values', 'application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'text/plain');
    
    // Validate whether selected file is a CSV file
    if(!empty($_FILES['file']['name']) && in_array($_FILES['file']['type'], $csvMimes)){
    	
        
        // // If the file is uploaded
        if(is_uploaded_file($_FILES['file']['tmp_name'])){
            
            // Open uploaded CSV file with read-only mode
            $csvFile = fopen($_FILES['file']['tmp_name'], 'r');
            
            // Skip the first line
            fgetcsv($csvFile);
            
            // Parse data from CSV file line by line
            while(($line = fgetcsv($csvFile)) !== FALSE){
                // Get row data
                $device_id   = $line[1];
                $power_type  = $line[2];
                $description  = $line[3];
                $event_date = $line[4];
                $added_on = $line[5];

                // // Check whether member already exists in the database with the same power_type
                // $prevQuery = "SELECT id FROM members WHERE power_type = '".$line[1]."'";
                // $prevResult = $db->query($prevQuery);
                
                // if($prevResult->num_rows > 0){
                //     // Update member data in the database
                //     $db->query("UPDATE members SET device_id = '".$device_id."', description = '".$description."', event_date = '".$event_date."', modified = NOW() WHERE power_type = '".$power_type."'");
                // }else{
                //     // Insert member data in the database
                $table_name = $tblpref."device";
                $feals_set = sprintf("device_id='%s', power_type='%s', description='%s', event_date='%s', added_on='%s'",$device_id, $power_type, $description, $event_date, $added_on);
		        $id = add_record($connection,$table_name,$feals_set,__FILE__,__LINE__);

                 
            }
            
            // Close opened CSV file
            fclose($csvFile);
            
            header("Location:index.php?flag=add");
	exit;
        }else{
            header("Location:index.php?flag=del");
	exit;
        }
    }else{
        $qstring = '?status=invalid_file';
    }
}

?>