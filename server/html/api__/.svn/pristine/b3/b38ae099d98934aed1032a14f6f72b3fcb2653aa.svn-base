<?php
$require_params = array("pin");
foreach($require_params as $rp)
{
	if (!isset($data[$rp]) || trim($data[$rp]) == "")
		die(json_encode(array("res" => 301, "msg" => "Require Parameters!!!")));
}

$pin = $data['pin'];

$users = get_all("select * from fl_drivers where pass='$pin'");
if (count($users) == 0)
	die(json_encode(array("res" => 311, "msg" => "Not found pass.")));

$vehicles = get_all("select * from fl_vehicles where owner_driver=0 order by registration_number");

$contents = array();
foreach($vehicles as $vehicle)
{
	$content = array();
	$content['vehicle_id'] = $vehicle['vehicle_id'];
	$content['registration_number'] = $vehicle['registration_number'];
	$contents[] = $content;
}

$res = array("res" => 200, "msg" => "Success", "contents" => $contents);
?>