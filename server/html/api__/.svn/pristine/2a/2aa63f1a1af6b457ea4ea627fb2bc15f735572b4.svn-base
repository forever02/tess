<?php
$require_params = array("pin", "vehicle_id", "mileage", "lat", "lng");//, "report_text", "defects");
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
$current_time = get_time();
$date = date("Y-m-d", strtotime($current_time));
$time = date("H:i", strtotime($current_time));
$date_text = date("l j F Y", strtotime($current_time));

$vehicle_id = $data['vehicle_id'];
$vehicle = get_one("select * from fl_vehicles where vehicle_id=$vehicle_id");
$vehicle_reg = $vehicle['registration_number'];

sql("INSERT INTO fl_drivers_defects_reports VALUES (
	'',
	'".$date."',
	'".$time."',
	'".$driver['driver_id']."',
	'".$data['vehicle_id']."',
	'".$data['mileage']."',
	'".mysql_real_escape_string($data['report_text'])."',
	'',
	'end'
)");
$last_report = get_one("select * from fl_drivers_defects_reports where driver_id=" . $driver['driver_id'] . " order by report_id desc");

$defects_text = '';
foreach ($data['defects'] as $defect) {
	foreach($defect as $key => $value)
	{
		if ($yesno == 'no') {
			$defects_text .= '<br />'.$key;
			sql("INSERT INTO fl_drivers_defects_reports_items VALUES ('".$last_report['report_id']."','".$key."')");
		}
	}
}

//add log entry
sql("INSERT INTO fl_drivers_logs VALUES (
	'',
	'".$driver['driver_id']."',
	'".$data['vehicle_id']."',
	'".$data['mileage']."',
	'".$data['lat']."',
	'".$data['lng']."',
	'".get_time()."',
	'end'
)");

$mail_headers  = "MIME-Version: 1.0 \r \n";
$mail_headers .= "Content-type: text/html; charset=iso-8859-1 \r \n";
$mail_headers .= "From: Flightlink Wales <info@flightlinkwales.com> \r \n";
$mail_headers .= "Reply-To: info@flightlinkwales.com\r\n";
$mail_headers .= "Return-Path: info@flightlinkwales.com\r\n";

$email_message	= "<html lang='en-GB'>
					<body bgcolor='#ffffff' text='#484848' link='#0000d0' vlink='#0000d0' alink='#0000f0' topmargin='0' leftmargin='0'  marginheight='0' marginwidth='0' style='background-color:#ffffff; font-size:9pt; color:#707070; width:500px;'>";
				   
$email_message .= "<table style='width:665px;' cellpadding='0' cellspacing='0'>
					<tr>
						<td colspan='4'>
							<a href='http://www.flightlinkwales.com'><img src='http://www.flightlinkwales.com/_images/fl_logo.gif' alt='Flight Link' style='border:0' /></a><br/>
							<a href='http://www.flightlinkwales.com' style='color:#909090; font-size:8pt; text-decoration:none; font-family:sans-serif, arial, hevetica, verdana;'>flightlinkwales.com</a><br/>
							<br/>
							
							<span style='color:#555555; font-size:12pt;'>
								Hi ".$driver['driver_name'].",
								<br/><br/>
								Thank you for your efforts today.
								<br /><br/>
								Your 9 hour break takes you to ".date("l j F H:i", strtotime(get_time()) + (9*3600))."
								<br /><br/>
								Your 11 hour break takes you to ".date("l j F H:i", strtotime(get_time()) + (11*3600))."
								<br /><br/>
								Your 24 hour break takes you to ".date("l j F H:i", strtotime(get_time()) + (24*3600))."
								<br /><br/>
								Your 45 hour break takes you to ".date("l j F H:i", strtotime(get_time()) + (45*3600))."
								<br/><br/>
								<strong>Defect report for ".$vehicle_reg."</strong>
								<br/><br/>
								Date: ".$date_text."<br />
								Time: ".$time."<br />
								Driver: ".$driver['driver_name']."<br />
								Mileage: ".$data['mileage']."<br />";
								if ($defects_text != '') {
									$email_message .= "<br />Defects: ".$defects_text."<br />";
								}
$email_message .= "				<br />Report: ".nl2br($data['report_text'])."<br />
							</span>
						</td>
					</tr>
				</table>
			</body>
		</html>";

mail($driver['driver_email'], 'Shift ended for '.$driver_name, stripslashes($email_message), $mail_headers);
mail('info@flightlinkwales.com', 'Shift ended for '.$driver_name, stripslashes($email_message), $mail_headers);	

#mail('istanley42@gmail.com', 'Shift ended for '.$driver_name, stripslashes($email_message), $mail_headers);

$res = array("res" => 200, "msg" => "Success");
?>