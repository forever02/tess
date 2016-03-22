<?php
$require_params = array("pin", "vehicle_id", "dstate");
foreach($require_params as $rp)
{
	if (!isset($data[$rp]) || trim($data[$rp]) == "")
		die(json_encode(array("res" => 301, "msg" => "Require Parameters!!!")));
}

$pin = $data['pin'];
$dstate = $data['dstate'];
$users = get_all("select * from fl_drivers where pass='$pin'");
if (count($users) == 0)
	die(json_encode(array("res" => 311, "msg" => "Not found pass.")));

$driver = $users[0];

$driver_state = sql_get("select * from fl_drivers_state where driver_id=" . $driver['driver_id'] . " and vehicle_id=" . $data['vehicle_id']);

if (count($driver_state) > 0)
	sql("update fl_drivers_state set state='" . $data['dstate'] . "' where driver_id=" . $driver['driver_id'] . " and vehicle_id=" . $data['vehicle_id']);
else
	sql("insert into fl_drivers_state (driver_id, vehicle_id, state) values(" . $driver['driver_id'] . ", " . $data['vehicle_id'] . ", '" . $data['dstate'] . "')");

$res = array("res" => 200, "msg" => "Success");
?>