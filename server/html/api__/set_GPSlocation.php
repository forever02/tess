<?php
$require_params = array("pin", "vehicle_id", "lat", "lng");
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
$vehicle_id = $data['vehicle_id'];
$lat = $data['lat'];
$lng = $data['lng'];

$user_location = get_all("select * from fl_drivers_location where driver_id=$driver_id and vehicle_id=$vehicle_id");
if (count($user_location) > 0)
	sql("update fl_drivers_location set lat='$lat', lng='$lng' where driver_id=$driver_id and vehicle_id=$vehicle_id");
else
	sql("insert into fl_drivers_location (driver_id, vehicle_id, lat, lng) values ($driver_id, $vehicle_id, '$lat', '$lng')");

$res = array("res" => 200, "msg" => "Success");
?>