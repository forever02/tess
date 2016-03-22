<?php
$require_params = array("pin", "month", "year");
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

$driver = $users[0];
$driver_id = $driver['driver_id'];
$month = $data['month'];
$year = $data['year'];
$lastday = date("t", strtotime($year.'-'.$month.'-01'));
$month_text = date("F", strtotime($year.'-'.$month.'-01'));
$invoice_date = date("d F Y", strtotime($year.'-'.$month.'-'.$lastday));

#add entry to database (blank invoice number first)
sql("INSERT INTO fl_drivers_invoices 
	VALUES ('', 
	'".$driver_id."', 
	'', 
	'".$year."-".$month."-".$lastday."')");
$lastinvoice = get_one("select * from fl_drivers_invoices where driver_id=$driver_id");
$invoice_id = $lastinvoice['invoice_id'];
//create invoice number from auto increment
$invoice_number = $driver_id.str_pad($invoice_id, 6, '0', STR_PAD_LEFT);
sql("UPDATE fl_drivers_invoices 
	SET invoice_number = '".$invoice_number."'
	WHERE invoice_id = '".$invoice_id."'");

//get driver name
$driver_name = $driver['firstname'].' '.$driver['surname'];

$mail_headers = "From: Flightlink Wales <info@flightlinkwales.com> \r \n";
mail("info@flightlinkwales.com", $month_text." invoice from ".$driver_name, $driver_name." has submitted their Flightlink invoice for ".$month_text, $mail_headers);
#mail("istanley42@gmail.com", $month_text." invoice from ".$driver_name, $driver_name." has submitted their Flightlink invoice for ".$month_text, $mail_headers);

$res = array("res" => 200, "msg" => "Success");
?>