<?php

// ---------------------------------------------------------------------------------------------------------------------------------
//Purpose: 	To allow users to set the thresholds for elements with a graphical interface - this version merely allows 
//					you to set the global thresholds across all elements, or for a specific element you select in the list.
//					This version is not intended to integrate into the security model, the purpose is to get the client requirements met
//					This version is not intended to integrate seamlessly into the uptime GUI
//					A supportable fully integrated version of this module should be built by PM/DEV to meet future client requirements
//
//					THIS IS PROOF OF CONCEPT AND CURRENTLY IS ONLY WRITTEN FOR A MYSQL backend
//
//Author: Kenneth Cheung - ken.cheung@uptimesoftware.com
//Date: 07.28.2008
// ---------------------------------------------------------------------------------------------------------------------------------

//CONFIG - set these 
$db_host="localhost";
$db_name="uptime_v4";
$db_user="uptime";
$db_password="uptime";
$db_port="3308";

if (isset($_GET['ezimg'])) ezimg::showImg($_GET['ezimg']);

//*********** Example of Use *********//
echo ezimg::genImageTag('uptimelogo-sm.jpg'); 
  // generates:  <img src='?ezimg=uptimelogo-sm.jpg' alt='' width='250' height='50' />  
//*********** End of Example *********//

class ezimg {

 function genImageTag($name){
  $image = ezimg::getImgData($name);     
  $result = "<img src='?ezimg={$name}' alt='' width='{$image['width']}' height='{$image['height']}' />";
  return $result;
 }
 
 function showImg($name){ 
  $image = ezimg::getImgData($name); 
  header("Content-type: image/{$image['type']}");
  echo gzuncompress(base64_decode(str_replace(' ', '', $image['code'])));
  exit;	  
 }

 function getImgData($name){
  $images = array(
   'blank.gif' => array( 
     'type'=>'gif', width=>'1', height=>'1',
     'code'=>"eJxz93SzsExkZGBkaGCAAsWfLIwgWgdEgGQYmJhcGBmsAXIBA/w="
    ),
   'uptimelogo-sm.jpg' => array( 
     'type'=>'jpeg', width=>'250', height=>'50',
     'code'=>"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
              UjezokZdOhFYPg4alRD6labTyX8Ao8NOUw=="
    )
  );
  if (isset($images[$name])) return $images[$name]; 
   else return $images['blank.gif'];
 }
}


$header="
<head>
<style type='text/css'>
.button {
 font: 11px Verdana, Geneva, Arial, Helvetica, sans-serif;
 background-color: #D7E5F2;
 color: #102132;
 margin-left: 2px;
 margin-top: 3px;
 margin-bottom: 2px;
}
table {
	border-collapse:collapse;
	background-color:#022B59;
	font:11px Verdana,Arial;
	color: #90B0D2;
	word-spacing: -1px;
	width: 640px;
}

caption {
	padding: 10px 0 19px 0;
	text-align: left;
	font-size: 63px;
	font-weight: normal;
	text-transform: uppercase;
	font-family: Georgia ,'Times New Roman';
	text-transform: capitalize;
	word-spacing: -3px;
	letter-spacing: -3px;
	color: #022B59;
	background-color: transparent;
	margin-bottom: -23px;
	line-height: 63px;
}

/* Linkz-------------------------------------------- */

table a {
	color:#ffffff;
	text-decoration:none;
}

table a:link {
	font-family: Georgia ,'Times New Roman';
	text-transform: uppercase;
	font-weight: normal;
	color: #90C000;
	font-size: 12px;
	word-spacing: 0px;
	letter-spacing: 0px;
}

table a:visited {
	font-weight:normal;
	color:#666;
	text-decoration: line-through;
}

table a:hover {
		color: #C3E858;
}

/* Header Footer-------------------------------------- */
thead  {

	border-bottom: solid 1px #064600;
	border-top: solid 1px #C3E858;
}

thead th, tfoot th, tfoot td {
	background-color: #8FBF00;
	background-image:url(http://www.marvmerchants.com/images/navi_left_verlauf.gif);
	background-repeat:repeat-y;
	padding: 5px 10px 5px 10px;
	font-weight: normal;
	text-transform: uppercase;
	font-family:Georgia, 'Times New Roman';
	font-size: 17px;
	letter-spacing: -1px;
	word-spacing: 2px;
	color: #ffffff;
}

tfoot td {
	text-align:right
}

/* Body------------------------------------------ */

tbody th, tbody td {
	border-bottom: solid 1px #254D7A;
	line-height: 12px;
	padding: 5px 10px 5px 10px;
}

tbody th {
	white-space: nowrap;
}

tbody th a {
	color:#fff;
}

.odd {}

tbody tr:hover {
	background:#0C3563; 
}

</style>

</head>
";

//CREATE DATABASE CONNECTION
//create connection
$db=mysql_connect($db_host.":".$db_port, $db_user, $db_password) or die('<br><br><font face=arial color=red>Could not connect to the MySQL server, please ensure you have configured the configuration section of thresholdManager.php as described in the documentation. ERROR: </font>'.mysql_error());
mysql_select_db("uptime_v4", $db);

//CREATE BASIC QUERY
$query_entities = " 
  SELECT 
  	`entity`.`entity_id`,
  	`entity`.`name`,
  	`entity`.`display_name`,
  	`entity`.`description`,
  	`entity`.`gs_cpu_warn`,
  	`entity`.`gs_diskbusy_warn`,
  	`entity`.`gs_cpu_crit`,
 	 	`entity`.`gs_diskbusy_crit`,
  	`entity`.`gs_diskfull_warn`,
  	`entity`.`gs_swap_warn`,
  	`entity`.`gs_diskfull_crit`,
  	`entity`.`gs_swap_crit`
	FROM
  	`entity`
	WHERE
  	(`entity`.`entity_type_id` <> 3)

";

$query_result = mysql_query($query_entities,$db);
$num_entities = mysql_num_rows($query_result);

echo $header."<font face='arial'><font size=-2><br><br>";

echo $num_entities." entities found in uptime database. Please select the row(s) you want to modify and then click the commit button.</font><br>";



echo "<form name='thresholdForm'>";
echo "<table border=1 ><tr><td><font size='-5'>SELECTION</font></td><td><font size='-5'>ENTITY NAME</font></td><td><font size='-5'>CPU WARN</td><td><font size='-5'>CPU CRIT</td><td><font size='-5'>MEM WARN</td><td><font size='-5'>MEM CRIT</td><td><font size='-5'>CAP WARN</td><td><font size='-5'>CAP CRIT</td><td><font size='-5'>I/O WARN</td><td><font size='-5'>I/O CRIT</td></tr>";

$rowCounter=0;

while($row = mysql_fetch_array($query_result, MYSQL_ASSOC))
{
	
		echo "<tr>";
    echo "<td><center><input type='checkbox' name='".$rowCounter."' value='".$row['entity_id']."'></center></td>".
    			"<td><font size='-5'>".$row['display_name']."</font></td>".
    			"<td><input type='text' size='3' name='".$rowCounter."_gs_cpu_warn' value='".$row['gs_cpu_warn']."' /></td>".
    			"<td><input type='text' size='3' name='".$rowCounter."_gs_cpu_crit' value='".$row['gs_cpu_crit']."' /></td>".
    			"<td><input type='text' size='3' name='".$rowCounter."_gs_swap_warn' value='".$row['gs_swap_warn']."' /></td>".
    			"<td><input type='text' size='3' name='".$rowCounter."_gs_swap_crit' value='".$row['gs_swap_crit']."' /></td>".
					"<td><input type='text' size='3' name='".$rowCounter."_gs_diskfull_warn' value='".$row['gs_diskfull_warn']."' /></td>".
					"<td><input type='text' size='3' name='".$rowCounter."_gs_diskfull_crit' value='".$row['gs_diskfull_crit']."' /></td>".
    			"<td><input type='text' size='3' name='".$rowCounter."_gs_diskbusy_warn' value='".$row['gs_diskbusy_warn']."' /></td>".
    			"<td><input type='text' size='3' name='".$rowCounter."_gs_diskbusy_crit' value='".$row['gs_diskbusy_crit']."' /></td>".
    			"";
    echo "<tr>";    
    $rowCounter++; 
} 


if($_GET['Commit']){ 
	
	//echo "you pressed commit!";
	$commitCounter=0;
	
		for ( $commitCounter=0; $commitCounter < $num_entities; $commitCounter++) {
	
			if($_GET[$commitCounter]){
				$commitQuery=	"update entity set gs_cpu_warn=".$_GET[$commitCounter."_gs_cpu_warn"]
											.",gs_cpu_crit=".$_GET[$commitCounter."_gs_cpu_crit"]
											.",gs_swap_warn=".$_GET[$commitCounter."_gs_swap_warn"]
											.",gs_swap_crit=".$_GET[$commitCounter."_gs_swap_crit"]
											.",gs_diskfull_warn=".$_GET[$commitCounter."_gs_diskfull_warn"]
											.",gs_diskfull_crit=".$_GET[$commitCounter."_gs_diskfull_crit"]
											.",gs_diskbusy_warn=".$_GET[$commitCounter."_gs_diskbusy_warn"]
											.",gs_diskbusy_crit=".$_GET[$commitCounter."_gs_diskbusy_crit"]
											." where entity_id=".$_GET[$commitCounter]."";
				echo $commitQuery."<br>";
				
				mysql_query($commitQuery,$db);
				echo "<meta http-equiv='Refresh' content='0; url=thresholdManager.php'>";


				
			}
		}
	}


echo "</table>";
echo "<br>";
echo "<INPUT type='submit' name='Commit' value='Commit' class='button'>"; //submission button
echo "<INPUT type='submit' name='Cancel' value='Cancel' class='button'>"; //submission button

echo "</form>";
echo "</font>";


?>

