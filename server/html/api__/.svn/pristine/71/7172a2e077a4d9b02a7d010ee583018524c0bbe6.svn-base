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

$places = get_all("SELECT * FROM fl_locations_airports GROUP BY placename ORDER BY placename ASC");

$contents = array();
foreach($places as $place)
{
	if ($place['placename'])
		$contents[] = $place['placename'];
}

$res = array("res" => 200, "msg" => "Success", "contents" => $contents);
?>