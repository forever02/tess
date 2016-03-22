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

sql("insert into fl_drivers_at_airport_logs (driver_id, vehicle_id, lat, lng, log_time) values ($driver_id, $vehicle_id, '$lat', '$lng', now())");

$res = array("res" => 200, "msg" => "Success");
?>