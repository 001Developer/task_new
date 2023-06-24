<?php
	class Neccessary {
		
		var $uploaddir;
		var $imgs;
		var $today;
		
		public function __construct() {

			$this->today = date("Y-m-d");
			
			/*$this->imgs = array(
					0 => 'gif', 
					1 => 'jpg', 
					2 => 'jpeg', 
					3 => 'png',
					4 => 'bmp',
					5 => 'x-png'
			);*/
		}

		function Insert($arr, $tblpref, $tblname, $date='') {
			
			foreach($arr as $key => $value )
					$query .= $key . " = '" . $value . "', ";
			
			$query = "INSERT INTO " . $tblpref . $tblname . " SET " . $query .  $date . " = '$this->today'";
			if(!($result = mysql_query($query))) { echo "Query - " . $query . "<br />Error - " . mysql_error(); exit; }

			$txtid = mysql_insert_id();
			return $txtid;
		}
		
		
		function update($arr, $tblpref, $tblname, $txtid, $idField, $date) {
			
			foreach($arr as $key => $value )
					$query .= $key . " = '" . $value . "', ";
			
			if($date == "")
				$date = "r_date";
			
			$query = "UPDATE " . $tblpref . $tblname . " SET " . $query . $date . " = '$this->today' WHERE " . $idField . " = " . $txtid;
			if(!($result = mysql_query($query))) { echo "Query - " . $query . "<br />Error - " . mysql_error(); exit; }
			#$txtid = mysql_insert_id();
			return ;
		}

	

	}
?>