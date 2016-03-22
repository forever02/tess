<?php
include("functions.php");
include("db.php");

$data = $_REQUEST;
$require_params = array("firstname", "lastname", "email", "mobile", "radius");
foreach($require_params as $rp)
{
	if (!isset($data[$rp]) || trim($data[$rp]) == "")
		die(json_encode(array("res" => 301, "msg" => "Require Parameters!!!")));
}

$firstname = $data['firstname'];
$lastname = $data['lastname'];
$email = $data['email'];
$mobile = $data['mobile'];
$radius = $data['radius'];

$sql = "select * from tbl_user ";
$sql .= " where firstname='$firstname' ";
$sql .= " and surname='$lastname' ";
$sql .= " and email='$email' ";
$sql .= " and mobile='$mobile' ";
$sql .= " and radius='$radius' ";
$sql .= " and active='1' ";

$users = get_all($sql);
if (count($users) > 0) { 
    $user_hash = $users[0]['verify_code'];
    $user_id = $users[0]['user_id'];
    $res = array("res" => 200, "msg" => "Success", "user_id" => "$user_id", "user_hash" => "$user_hash");
}
else 
    $res = array("res" => 301, "msg" => "Failure");

echo json_encode($res);
?>