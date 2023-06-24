<?php @session_start();
function index_header($title) 
{
	@session_start();
	include("config.php");
	
}
function index_footer() 
{ 
	include("config.php");

}
function admin_header($path2,$title,$tblpref,$db,$sitepath,$siteurl,$path1,$ckpath,$row_admin)
{
	@session_start();
	include("config.php");?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Welcome To Admin Panel :: <?=$title?></title>
<script type="text/javascript" src="<?=$path2?>cal_js/jquery-1.3.1.min.js"></script>
<link href="<?=$path2?>css/admin.css" rel="stylesheet" type="text/css" />
<!-- <script type="text/javascript" src="<?=$path2?>js/curvy.js"></script> -->
<script type="text/javascript" src="<?=$path2?>js/admin-validations.js"></script>
</head>
<body>
<div class="header">
<?if($_SESSION[username]==""){?>
	<img src="<?=$path2?>images/weblogic-logo.jpg" alt="Site Logo" />
<?}
else
{?>
<img src="<?=$path2?>images/weblogic-logo.jpg" alt="Site Logo" />
    <div class="logout">
    	<div class="admin">
        <div class="admnimg"><a href="<?=$path2.'cplo/'?>admin-info.php"><img src="<?=$path2?>images/admin.png" alt="Edit Info" title="Edit Info"/></a> </div>
		<?=stripslashes(ucfirst($_SESSION[user_type]));?><? 
		switch(stripslashes($_SESSION[user_type]))
		{
			case "superadmin":
								echo "Super Administrator";
								break;
			case "reporter":
								echo "Reporter";
								break;
			case "subeditor":
								echo "Sub Editor";
								break;
			case "editor":
								echo "Editor";
								break;
		}?><br/>
        <p class="nameAdm"><a href="<?=$path2.'cplo/'?>admin-info.php" alt="Edit Info" title="Edit Info"><?=stripslashes(ucfirst($row_admin[admin_name]))?></a></p>
    </div>
    <a href="<?=$path2.'cplo/'?>changepassword.php"><img src="<?=$path2?>images/lock.png" alt="change password" title="change password" /></a>     
    <a href="<?=$path2.'cplo/'?>home.php"><img src="<?=$path2?>images/gohome.png" alt="Home" title="Home" /></a>
    <a href="<?=$path2.'cplo/'?>logout.php" onclick='if(confirm("Do You Really Want To Logoff ?")){return true;}else{return false;}'><img src="<?=$path2?>images/exit.png" alt="Logout" title="Logout" /></a> 
	<!-- <a href="<?=$path2?>help/index.html" target="_blank"><img src="<?=$path2?>images/help.png" alt="Help" title="Help" /></a>  -->
    <p class="welcome">Welcome to the Admin Section of <br/><?=$path1."cplo/"?></p>
    </div>
    <div class="clear"></div>
<?}?>
</div>
<?}
function admin_footer()
{?>
		<div class="footer">
	<p class="flt">Copyright &copy; 2012. All Rights Reserved </p>
	<p class="frt" style="padding-right:25px;"><a href="http://www.weblogic.co.bw/">Designed &amp; Developed by Weblogic</a></p>
    <div class="clear"></div>
</div>    

</body>
</html>
<?}

//////START generation of paging code
function pagination($strsql_pag, $current_page=0, $link_pag=null, $more_querystr=null,
$page_size=0)
{
		global $sitefont,$sitefontweight ;

	if (($page_size+0)==0)
		$page_size=10;
	if ($link_pag == null or $link_pag == "")
		$link_pag=$PHP_SELF ;

	if ($more_querystr != null or $more_querystr != "")
		$more_querystr="&" . $more_querystr ;

	// COUNT
	if (!($result_pag = mysql_query($strsql_pag))){echo "SQL: ".$strsql_pag."<br>ERROR: ".mysql_error();exit;}

	$row_pag = mysql_fetch_array($result_pag);
	$ex_count=mysql_num_rows($result_pag);

	$no_page=ceil($ex_count/$page_size);

	if ($current_page>0)
		$show_from=($current_page-1)*$page_size;
	else
		$show_from=0;
	

	if( $ex_count>$page_size )
	{
		$diplay_string = "<TABLE cellPadding=0 cellspacing=0 width=30% size=0 align=center ><form Name='frmGotoPage'  id='frmGotoPage' method ='post' action ='". $link_pag ."?wew=qwq".$more_querystr ."' onsubmit='return validate();'><TR bgcolor=>";

		if(($current_page + 0)<=0)
			$current_page=1;
		else if (($current_page + 0)>$no_page)
			$current_page=$no_page + 0;
		else
			$current_page=ceil($current_page) + 0;

		if ($current_page  != 1 )
			$diplay_string = $diplay_string . "        <TD width='10%' align=middle bgcolor=>        <A title='Go to the first page' class=Link-TableHeader target=_self href='". "". $link_pag ."?page=1".$more_querystr ."'><b>First</b></A></TD>";
		else
			$diplay_string = $diplay_string . "        <TD width='10%' align=middle bgcolor=><b>First</b></TD>";


		if ($current_page  !=1 )
			$diplay_string = $diplay_string . "        <TD align=middle width='10%' bgcolor=>        <A title='Go to the previous page' target=_self href='". "". $link_pag ."?page=".($current_page -1).$more_querystr ."'><b>Prev</b></A></TD>";
		else
			$diplay_string = $diplay_string . "        <TD width='10%' align=middle bgcolor=><b>Prev</b></font></TD>";


		if ($no_page == $current_page)
			$diplay_string = $diplay_string . "	<TD width='10%' align=middle bgcolor=''><b>Next</b></TD>";
		else
			$diplay_string=$diplay_string. "<TD width='10%' align=middle bgcolor=>$no_pages	<A title='Go to the next page' target=_self href='". $link_pag ."?page=" .($current_page + 1) . $more_querystr. "'><b>Next</b></A></TD>";


		if ($no_page == $current_page)
			$diplay_string = $diplay_string . "	<TD width='10%' align=middle bgcolor=''><b>Last</b></TD>";
		else
			$diplay_string=$diplay_string. "<TD align=middle width='10%' bgcolor=> 	<A title='Go to the last page' target=_self href='". $link_pag ."?page=" .$no_page . $more_querystr. "'><b>Last</b></A></TD>";

		$diplay_string=$diplay_string . "	</TR></form></TABLE>	";

	}

	// make string eg. [1-20 OF 290]
	if ($ex_count > 0)
	{
		$last_record_no = $show_from + $page_size;
		if ($last_record_no > $ex_count)
			$last_record_no = $ex_count;

		$first_record_no = ($show_from+1);
	}
	else
	{
		$last_record_no = 0;
		$first_record_no = 0;
	}


	$return_this = $show_from .",". $page_size ."~". $diplay_string ."~ [ ". $first_record_no . "-". $last_record_no ." OF ". $ex_count ." ] ";

	return  $return_this;

}
function imageresize($width, $height, $target) 
{ 
	//takes the larger size of the width and height and applies the  
	//formula accordingly...this is so this script will work  
	//dynamically with any size image 

	if ( ($width < $target) && ($height < $target) ) { 
		$percentage = 1; 
	} else if ($width > $height) { 
		$percentage = ($target / $width); 
	} else { 
		$percentage = ($target / $height); 
	} 

	//gets the new value and applies the percentage, then rounds the value 
	$width = round($width * $percentage); 
	$height = round($height * $percentage); 

	//returns the new sizes in html image tag format...this is so you 
	//can plug this function inside an image tag and just get the 
	return "width=\"$width\" height=\"$height\""; 
}
//////END generation of pageing code

////// start function to display error

function displayerror($title,$errorno,$errordesc,$links,$reporterror)

{

		global $sitefont ,$sitefontweight;



    //Dim arrlinks 'Array to stores hyperlink text and Url

    //Dim intI 'Counter for For loop

    print "<body>";

    print "<center>";

    print "<table border=1 cellspacing=0 cellpadding=1 width=90%> ";

    print "  <tr bgcolor=#70b4eb>";

    print "    <td><font color=#FFFFFF face='$sitefont' ><b>".$title."</b></font></td>";

    print "  </tr>";

    print "  <tr>";

    print "    <td><br>";

    print "<font face='$sitefont' size='$sitefontweight' ><b> &nbsp;An error occurred during this process.</b></font><br><br>";

    print "<font face='$sitefont' size='$sitefontweight' >".$errorno."&nbsp;"."</font>";

    print "<font face='$sitefont' size='$sitefontweight' >".$errordesc."</font>";

    //$err.$clear;



    $arrlinks=explode(",",$links);

    //echo "<br>".$arrlinks[0]."<p>".$arrlinks[1]."<p>".$arrlinks[2]."<p>".$arrlinks[3];//exit;



    print "<ul>";



    //Loop to show all hyperlinks

    for ($intI=0; ($intI<=count($arrlinks)-1);$intI=$intI+2){

      print "<li><font face=$sitefont size=$sitefontweight><b><a href='".$arrlinks[$intI+1]."'>".$arrlinks[$intI]."</a></font></li>";

    }





    //Condition checks if reporterror is one then show "Report This error" hyperlink

    //if cint(reporterror) = 1 then

    //        Response.Write "<li><a href='#'>Report This error</a></li>"

    //end if

    print "</ul>";

    print "</td>";

    print "</tr>";

    print "</table>";

    print "</center>";

}//end sub


function dateformate($datefor='')
{
$date=$datefor;
$date1=explode("-",$date);
$txtdate=$date1[2]."-".$date1[1]."-".$date1[0];
return $txtdate;
}
function country($cntid, $curid=null)
{
	include("common/config.php");
	$query_country = sprintf("Select * from nnc_country where cnt_id='%d'", $cntid);
	if(!($res_country = mysql_query($query_country)))
	{
		echo $query_country.mysql_error();
		exit();
	}
	$row_country = mysql_fetch_array($res_country);
	$cnt_name = stripslashes($row_country[cnt_name]);
	$cur_id = $row_country[cnt_cur_id];
	if($curid==null)
	{
		return $cnt_name;
	}
	else
	{
		return $curname = currency($cur_id);
	}
}
function currency($curid,$abb=null)
{
	include("common/config.php");
	$query_currency = sprintf("Select * from nnc_currency where cur_id='%d'", $curid);
	if(!($res_currency = mysql_query($query_currency)))
	{
		echo $query_currency.mysql_error();
		exit();
	}
	$row_currency = mysql_fetch_array($res_currency);
	$cur_name = stripslashes($row_currency[cur_name]);
	$cur_abb = stripslashes($row_currency[cur_ab]);
	if($abb==null)
	{
		return $cur_name;
	}
	else
	{
		return $cur_abb;
	}
	
}
function currencyid($cntid)
{
	include("common/config.php");
	$query_country = sprintf("Select * from nnc_country where cnt_id='%d'", $cntid);
	if(!($res_country = mysql_query($query_country)))
	{
		echo $query_country.mysql_error();
		exit();
	}
	$row_country = mysql_fetch_array($res_country);
	$cur_id = $row_country[cnt_cur_id];
	return $cur_id;
}
function previous_next($idnm, $mytable, $cond, $id, $order)
{
	include("common/config.php");
	//Previous ID:

	//SELECT id FROM $mytable WHERE id < $id ORDER BY ID DESC LIMIT 1;

	//Next ID:

	//SELECT id FROM $mytable WHERE id > $id ORDER BY ID ASC LIMIT 1;

	$query_prevnxt = sprintf("Select ".$idnm." from ".$tblpref.$mytable." where ".$idnm." ".$cond." ".$id." ORDER BY ".$idnm." ".$order." LIMIT 1");
	if(!($res_prevnxt = mysql_query($query_prevnxt)))
	{
		echo $query_prevnxt.mysql_error();
		exit();
	}
	$row_prevnxt = mysql_fetch_array($res_prevnxt);
	$cnt_prevnxt = mysql_num_rows($res_prevnxt);
	
	if($cnt_prevnxt > 0)
	{
		$prvnxtid = $row_prevnxt[$idnm];
		return $prvnxtid;
	}
	else
	{
		$prvnxtid=0;
		return $prvnxtid;
	}
}
function exchange_rate($from_Currency,$to_Currency,$amount,$flag=null) 
{
	$amount = urlencode($amount);
	$from_Currency = urlencode($from_Currency);
	$to_Currency = urlencode($to_Currency);
	$url = "http://www.google.com/ig/calculator?hl=en&q=$amount$from_Currency=?$to_Currency";
	$ch = curl_init();
	$timeout = 0;
	curl_setopt ($ch, CURLOPT_URL, $url);
	curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch,  CURLOPT_USERAGENT , "Mozilla/4.0 (compatible; MSIE 8.0; Windows NT 6.1)");
	curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
	$rawdata = curl_exec($ch);
	curl_close($ch);
	$str = $rawdata;
	$str = preg_replace('/(\w+):/', '"\\1":', $str);
	$curr = json_decode($str);
	if($curr)
	{
		if(!$curr->error)
		{
			if($flag==null)
			{
				return $curr->lhs.' = '.$curr->rhs;
			}
			else
			{
				$res = explode(" ", $curr->rhs);
				return $res[0];
			}
			
		}
	}


	/*$data = explode('"', $rawdata);
	$data = explode(' ', $data['3']);
	$var = $data['0'];
	return round($var,2);
	$result = exchange_rate("GBP","BWP",1);
	*/
}

 
function show_menu ($parent_id=0, $db, $connection, $tblpref, $count=0) {

				$querycms="select * from ".$tblpref."content_master where cms_id ='$parent_id' order by cms_id"; 
				if(!($resultcms=mysql_query($querycms))){ echo $querycms.mysql_error(); exit;}
				$num_row = mysql_num_rows($resultcms);
				$rowcms = mysql_fetch_array($resultcms);

				$querycms2="select * from ".$tblpref."content_master where cms_parent ='".$rowcms[cms_id]."' order by cms_id"; 
					if(!($resultcms2=mysql_query($querycms2))){ echo $querycms2.mysql_error(); exit;}
					$num_row2 = mysql_num_rows($resultcms2);

				

//				$count_id++;
?>					<li><a href="<?=$rowcms[cms_sitelink]?>?cid=<?=$rowcms[cms_id]?>"<?if($num_row2>0){?> rel="ddsubmenu<?=$rowcms[cms_id]?>"<?}?> <?if ($_GET[cid]==$rowcms[cms_id]) echo "class=selected"?>><?=stripslashes($rowcms[cms_title])?></a>
<?
					
				if($num_row2 >0){
						

?>						<ul id="ddsubmenu<?=$rowcms[cms_id]?>" class="ddsubmenustyle">
<?					while($rowcms2 = mysql_fetch_array($resultcms2))
					{
						show_menu($rowcms2[cms_id], $db, $connection, $tblpref, $count_id); 
					} 
?>						</ul>	 
<?				}
?>					</li>
<?
}
function log_entry($module,$modtitle,$action,$tblpref,$db,$adminid)
{
	@session_start();
	include("config.php");
	$perqury = sprintf("INSERT INTO ".$tblpref."log SET log_admin_id='%d', log_admin_module='%s',log_admin_rec_title='%s', log_admin_action='%s',log_admin_date=CURDATE(), log_admin_time=CURTIME()",$adminid,$module,$modtitle,$action);
	if(!($perresult=mysql_query($perqury)))
	{
		echo mysql_error();
	}
}
function str_rand($length = 8, $seeds = 'alphanum')
{
    // Possible seeds
    $seedings['alpha'] = 'abcdefghijklmnopqrstuvwqyz';
    $seedings['numeric'] = '0123456789';
    $seedings['alphanum'] = 'abcdefghijklmnopqrstuvwqyz0123456789';
    $seedings['hexidec'] = '0123456789abcdef';
    
    // Choose seed
    if (isset($seedings[$seeds]))
    {
        $seeds = $seedings[$seeds];
    }
    
    // Seed generator
    list($usec, $sec) = explode(' ', microtime());
    $seed = (float) $sec + ((float) $usec * 100000);
    mt_srand($seed);
    
    // Generate
    $str = '';
    $seeds_count = strlen($seeds);
    
    for ($i = 0; $length > $i; $i++)
    {
        $str .= $seeds{mt_rand(0, $seeds_count - 1)};
    }
    //echo  $str;
    return $str;
}
function show_subcat($parent_id, $db, $connection, $tblpref, $count,$prodcat) 
{
	$querycms="select * from ".$tblpref."category where cat_parent ='$parent_id' order by cat_id ASC"; 
	if(!($resultcms=mysql_query($querycms))){ echo $querycms.mysql_error(); exit;}
	$num_row = mysql_num_rows($resultcms);
	if($num_row>0)
	{
		$cnt = 1;
		while($rowcms = mysql_fetch_array($resultcms))
		{			
		?>
			<option value="<?=$rowcms[cat_id]?>" <?if($rowcms[cat_id]==$prodcat){?>selected<?}?>><?="&nbsp;&nbsp;&nbsp;&nbsp;".$count.".".$cnt." &nbsp;".stripslashes($rowcms[cat_title])?></option>
		<?			
			$count2="&nbsp;&nbsp;&nbsp;&nbsp;".$count. ".".$cnt;
			show_subcat($rowcms[cat_id], $db, $connection, $tblpref, $count2); 
			$cnt = $cnt+1;
		}
	}
	return;
}

function show_subcat_add($parent_id, $db, $connection, $tblpref, $count, $dbval) 
{
	$querycms="select * from ".$tblpref."category where c_parent ='$parent_id' order by c_id ASC"; 
	if(!($resultcms=mysql_query($querycms))){ echo $querycms.mysql_error(); exit;}
	$num_row = mysql_num_rows($resultcms);
	//$rowcms = mysql_fetch_array($resultcms);

	
	if($num_row>0)
	{
		$cnt = 1;
		while($rowcms = mysql_fetch_array($resultcms))
		{ ?>
			<option value="<?=$rowcms[cat_hierarchy ]?>" <?if($rowcms[cat_hierarchy]==$dbval){?>selected<?}?>><?="&nbsp;&nbsp;&nbsp;&nbsp;".$count.".".$cnt." &nbsp;".stripslashes($rowcms[cat_title])?></option>
		<?			
			$count2="&nbsp;&nbsp;&nbsp;&nbsp;".$count. ".".$cnt;
			show_subcat_add($rowcms[c_id], $db, $connection, $tblpref, $count2, $dbval); 
			$cnt = $cnt+1;
		}
	}
	return;
}
function show($parent_id, $db, $connection, $tblpref, $count) 
{
	$querycms="select * from ".$tblpref."category where cat_id='$parent_id' order by cat_id ASC"; 
	if(!($resultcms=mysql_query($querycms))){ echo $querycms.mysql_error(); exit;}
	$num_row = mysql_num_rows($resultcms);
	$rowcms = mysql_fetch_array($resultcms);
	
	$querycms1="select * from ".$tblpref."category where cat_parent ='$rowcms[cat_id]' order by cat_id ASC"; 
	if(!($resultcms1=mysql_query($querycms1))){ echo $querycms1.mysql_error(); exit;}
	$num_row1 = mysql_num_rows($resultcms1);
	//$rowcms1 = mysql_fetch_array($resultcms1);
	if($count%2==0){$class="even";}else{$class="";}
	?>
	 <tr class="<?php echo $class;?>">
		<td><b><?php echo $count;?></b></td>
		<!-- <td align="left" class="tbborder" width="15%"> <?php echo $count; ?></td> -->
		<td><?php echo stripslashes($rowcms['cat_title']); ?></td>
		<!-- <td align="left" class="tbborder"><?php echo stripslashes($rowcms['cat_title']); ?> </td> -->
		<td class="center">
		<ul class="actions">
			<li><a title="edit" href="add.php?mode=edit&id=<?php echo $rowcms['cat_id'];?>" ><img alt="edit" src="../../../images/pencil.png"></a></li>
			<li><a href="submit.php?id=<?php echo $rowcms['cat_id'];?>&mode=del" onclick="if(confirm('Do You Want To Delete This ?')){return true;}else{return false;}"><img src="../../../images/delete.png" alt="delete"></a></li>
		</ul></td>



		<!-- <td align="center" class="tbborder" width="25%">
			
			   <a href="add.php?id=<?php echo $rowcms['cat_id'] ?>&mode=edit"> Edit </a>
			<?if($rowcms[c_parent] > 0 && $num_row1 == 0)
			{?>
				 | <a href="submit.php?id=<?php echo $rowcms['cat_id'] ?>&mode=del" onClick='if(confirm("Do You Want To Delete This ?")){return true;}else{return false;}'>Delete</a>
			<?
			}
			?>
		</td> -->
	</tr>
<?}
function show_subcat_index($parent_id, $db, $connection, $tblpref, $count) 
{
	$querycms="select * from ".$tblpref."category where cat_id='$parent_id' order by cat_id ASC"; 
	if(!($resultcms=mysql_query($querycms))){ echo $querycms.mysql_error(); exit;}
	$num_row = mysql_num_rows($resultcms);
	$rowcms = mysql_fetch_array($resultcms);
	
	$querycms1="select * from ".$tblpref."category where cat_parent ='$rowcms[cat_id]' order by cat_id ASC"; 
	if(!($resultcms1=mysql_query($querycms1))){ echo $querycms1.mysql_error(); exit;}
	$num_row1 = mysql_num_rows($resultcms1);
	if($count%2==0){$class="even";}else{$class="";}
	?>
	 <tr class="<?php echo $class;?>">
		<td><b><?php echo $count;?></b></td>
		<!-- <td align="left" class="tbborder" width="15%"> <?php echo $count; ?></td> -->
		<td><?php echo stripslashes($rowcms['cat_title']); ?></td>
		<!-- <td align="left" class="tbborder"><?php echo stripslashes($rowcms['cat_title']); ?> </td> -->
		<td class="center">
		<ul class="actions">
			<li><a title="edit" href="add.php?mode=edit&id=<?php echo $rowcms['cat_id'];?>" ><img alt="edit" src="../../../images/pencil.png"></a></li>
			<li><a href="submit.php?id=<?php echo $rowcms['cat_id'];?>&mode=del" onclick="if(confirm('Do You Want To Delete This ?')){return true;}else{return false;}"><img src="../../../images/delete.png" alt="delete"></a></li>
		</ul></td>
	</tr>
	<?		
	if($num_row1 > 0)
	{
		$cnt = 1;
		while($rowcms1 = mysql_fetch_array($resultcms1))
		{
			$count2="&nbsp;&nbsp;&nbsp;&nbsp;".$count. ".".$cnt;
			show_subcat_index($rowcms1[cat_id], $db, $connection, $tblpref, $count2);
			$cnt = $cnt+1;
		}
	}
	return;
}
?>
