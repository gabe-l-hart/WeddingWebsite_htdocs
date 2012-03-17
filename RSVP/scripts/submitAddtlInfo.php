<?php
require '../../scripts/db.php';

// Pull in db variables
global $db_hostname;
global $db_user;
global $db_pw;
global $db_name;

// Connect to db
$success = true;
mysql_connect($db_hostname, $db_user, $db_pw) or die(mysql_error());
if (!mysql_select_db($db_name)) {
	$success = false;
}

// Gather post data
function checkPostField($field) {
	global $success;
	if (isset($_POST[$field])) {
		return $_POST[$field];
	} else {
		$success = false;
		return "";
	}
}
$nameField = checkPostField("nameField");
$song1 = checkPostField("song1");
$song2 = checkPostField("song2");
$song3 = checkPostField("song3");
$songs = $song1.";".$song2.";".$song3;
$travel_type = checkPostField("travel_type");

$airport = "";
$airport_other = "";
$airport_arrival_date = "";
$flying_arrival_time = "";
$airport_depart_date = "";
$flying_depart_time = "";
$driving_arrival = "";
$driving_extendedTravel = "";

function formatDateTime($date, $time) {
	$timeParts = explode(" ", $time);
	$timeStr = $timeParts[0];
	if ($timeParts[1] == "PM") {
		$timeSubParts = explode(":", $timeParts[0]);
		$h = intval($timeSubParts[0]);
		$timeStr = strval($h + 12).":".$timeSubParts[1];
	}
	$timeStr .= ":00";
	return $date." ".$timeStr;
}

// Set up query
$query = "";
if ($success && $travel_type == "flying") {
	$airport = checkPostField("airport");
	if ($airport == "Other") {
		$airport = checkPostField("airport_other");
	}
	$airport_arrival_date = checkPostField("airport_arrival_date");
	$flying_arrival_time = checkPostField("flying_arrival_time");
	$airport_depart_date = checkPostField("airport_depart_date");
	$flying_depart_time = checkPostField("flying_depart_time");

	$arriveDateTime = formatDateTime($airport_arrival_date, $flying_arrival_time);
	$departDateTime = formatDateTime($airport_depart_date, $flying_depart_time);

	$query = "REPLACE INTO  `".$db_name."`.`additional_info`
 		(  `name`, `songs`, `flying`, `airport`, `flying_arrive`, `flying_depart`, `driving`, `driving_arrive`, `driving_plans` )
  	VALUES ( '$nameField', '$songs', '1', '$airport', '$arriveDateTime', '$departDateTime', '0', '', '' )";
}
elseif($success && $travel_type == "driving") {
	$driving_arrival = checkPostField("driving_arrival");
	$driving_extendedTravel = checkPostField("driving_extendedTravel");

	$query = "REPLACE INTO  `".$db_name."`.`additional_info`
 		(  `name`, `songs`, `flying`, `airport`, `flying_arrive`, `flying_depart`, `driving`, `driving_arrive`, `driving_plans` )
  	VALUES ( '$nameField', '$songs', '0', 'None', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '1',
  	'".mysql_real_escape_string($driving_arrival)."', '".mysql_real_escape_string($driving_extendedTravel)."' )";
}
else {
	$success = false;
}

// Make db changes
if ($success) {
	if(!mysql_query($query)) {
		$success = false;
	}
}

//DEBUG
//echo "query: ".$query."<br><br>";
//echo "success: ".$success."<br>";

// Create dummy form
echo "<form id='redirect' action='..' method='post'>
  <input type='hidden' id='additionalInfoSuccess' name='additionalInfoSuccess' value='".strval($success)."'></input>
</form>";

// Submit form on load
echo "<script type='text/javascript'>
  function submit () {
    document.getElementById('redirect').submit();
  }
  window.onload = submit();
</script>";
?>