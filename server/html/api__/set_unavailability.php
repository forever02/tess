<?php
$require_params = array("pin", "fromdate", "fromtime", "todate", "totime");
foreach($require_params as $rp)
{
	if (!isset($data[$rp]) || trim($data[$rp]) == "")
		die(json_encode(array("res" => 301, "msg" => "Require Parameters!!!")));
}

$pin = $data['pin'];

$users = get_all("select * from fl_drivers where pass='$pin'");
if (count($users) == 0)
	die(json_encode(array("res" => 311, "msg" => "Not found pass.")));

$driver = $users[0];

$driver_id = $driver['driver_id'];
$from_date = $data['fromdate'];
$from_time = date("H:i", strtotime($data['fromtime']));
$to_date = $data['todate'];
$to_time = date("H:i", strtotime($data['totime']));
$from_datetime = strtotime($from_date.' '.$from_time.':00');
$to_datetime = strtotime($to_date.' '.$to_time.':00');

if ($to_datetime <= $from_datetime)
	die(json_encode(array("res" => 312, "msg" => "Datetime setting error.")));

sql("INSERT INTO fl_drivers_unavailability VALUES (
	'',
	'".$driver_id."',
	'".$from_date."',
	'".$from_time."',
	'".$to_date."',
	'".$to_time."'
)");

$res = array("res" => 200, "msg" => "Success");
?>