﻿<?php
$require_params = array("pin", "bid", "direction", "date", "time", "accept");
foreach($require_params as $rp)
{
	if (!isset($data[$rp]) || trim($data[$rp]) == "")
		die(json_encode(array("res" => 301, "msg" => "Require Parameters!!!")));
}

$pin = $data['pin'];

$users = get_all("select * from fl_drivers where pass='$pin'");
if (count($users) == 0)
	die(json_encode(array("res" => 311, "msg" => "Not found pass.")));

$driver = $user[0];
$driver_id = $driver['driver_id'];
$bid = $data['bid'];
$direction = $data['direction'];
$booking_date = date("l d F", strtotime($data['date']));
$pickup_time = date('H:i', strtotime($data['time']));

//get driver name
$driver_name = $driver['firstname'].' '.$driver['surname'];
$driver_email = $driver['email'];

$outcome = 'fail';
if ($data['accept'] == 'yes' || $data['accept'] == 'no') {
	$accept = ($data['accept'] == 'yes') ? '1' : '0';
	if (sql("REPLACE INTO fl_drivers_bookings_accepted VALUES ('".$bid."', '".$direction."', '".$driver_id."', '".$accept."')")) {
		$outcome = "success";
	}
}
if ($data['accept'] == 'no') {
	$mail_headers = "From: Flightlink Wales <info@flightlinkwales.com> \r \n";
	mail($driver_email, "Declined job from ".$driver_name, $driver_name." has declined booking ID ".$bid." on ".$booking_date.". Pick up time: ".$pickup_time, $mail_headers);
	mail("info@flightlinkwales.com", "Declined job from ".$driver_name, $driver_name." has declined booking ID ".$bid." on ".$booking_date.". Pick up time: ".$pickup_time, $mail_headers);
	mail("mohammed.islam@flightlinkwales.com", "Declined job from ".$driver_name, $driver_name." has declined booking ID ".$bid." on ".$booking_date.". Pick up time: ".$pickup_time, $mail_headers);
	#mail("istanley42@gmail.com", "Declined job from ".$driver_name, $driver_name." has declined booking ID ".$bid." on ".$booking_date.". Pick up time: ".$pickup_time.". Email copied to ".$driver_email, $mail_headers);
}

$res = array("res" => 200, "msg" => "Success");
?>