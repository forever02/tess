<?php
$require_params = array("pin", "active");
foreach($require_params as $rp)
{
	if (!isset($data[$rp]) || trim($data[$rp]) == "")
		die(json_encode(array("res" => 301, "msg" => "Require Parameters!!!")));
}

$pin = $data['pin'];
$isActive = $data['active'];
$users = get_all("select * from fl_drivers where pass='$pin'");
if (count($users) == 0)
	die(json_encode(array("res" => 311, "msg" => "Not found pass.")));

sql("update fl_drivers set active='". $isActive ."' where pass='$pin'");

$res = array("res" => 200, "msg" => "Success");
?>