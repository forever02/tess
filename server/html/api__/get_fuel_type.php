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

$fueltypes = get_all("SELECT * FROM `fl_drivers_fuel` WHERE 1 group by fuel_type order by fuel_id");

$contents = array();
foreach($fueltypes as $fueltype)
{
	if ($fueltype['fuel_type'])
		$contents[] = $fueltype['fuel_type'];
}

$res = array("res" => 200, "msg" => "Success", "contents" => $contents);
?>