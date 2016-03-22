<?php
$require_params = array("pin", "pdate", "ptime", "pamount", "pplace");
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
$parking_date = date("Y-m-d", strtotime($data['pdate']));
$parking_time = date("H:i", strtotime($data['ptime']));
$parking_amount = $data['pamount'];
$parking_place = $data['pplace'];

sql("INSERT INTO fl_drivers_parking VALUES (
	'',
	'".$driver_id."',
	'".$parking_date."',
	'".$parking_time."',
	'".$parking_amount."',
	'".$parking_place."',
	'0'
)");

$res = array("res" => 200, "msg" => "Success");
?>