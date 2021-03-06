﻿<?php
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

$driver = $users[0];
$contents = array();

$driver_id = $driver['driver_id'];
$month = (isset($data['month']) && trim($data['month']) != "") ? $data['month'] : date("m", time());
$year = (isset($data['year']) && trim($data['year']) != "") ? $data['year'] : date("Y", time());
$month_text = date("F", strtotime($year.'-'.$month.'-01'));
$yyyymm = $year.'-'.$month;

$prev_month_time = strtotime("-1 month", strtotime($year.'-'.$month.'-01'));
$next_month_time = strtotime("+1 month", strtotime($year.'-'.$month.'-01'));
$prev_month = date("m", $prev_month_time);
$prev_months_year = date("Y", $prev_month_time);
$next_month = date("m", $next_month_time);
$next_months_year = date("Y", $next_month_time);
$lastday = date("t", strtotime($year.'-'.$month.'-01'));
$other_links = '';

//additional pays
$additonal = $taxi_link = $school_link = $feeder_link = $other = 0;
$result = get_one("SELECT * FROM fl_drivers_invoices_additional
					WHERE driver_id = '".$driver_id."'
					AND MONTH(invoice_date) = '".$month."'
					AND YEAR(invoice_date) = '".$year."'");
if (count($result) > 0) {
	$taxi_link = $result['taxi_link'];
	$school_link = $result['school_link'];
	$feeder_link = $result['feeder_link'];
	$other = $result['other'];
	$other_links = '';
	if ($taxi_link != 0)
		//$other_links .= '<tr><td>Taxi Link:</td><td>'.number_format($taxi_link, 2).'</td></tr>';
		$contents['taxilink'] = number_format($taxi_link, 2);
	if ($school_link != 0)
		//$other_links .= '<tr><td>School Link:</td><td>'.number_format($school_link, 2).'</td></tr>';
		$contents['schoollink'] = number_format($school_link, 2);
	if ($feeder_link != 0)
		//$other_links .= '<tr><td>Feeder Link:</td><td>'.number_format($feeder_link, 2).'</td></tr>';
		$contents['feederlink'] = number_format($feeder_link, 2);
	if ($other != 0)
		//$other_links .= '<tr><td>Other:</td><td>'.number_format($other, 2).'</td></tr>';
		$contents['otherlink'] = number_format($otherlink, 2);

}
else $taxi_link = $school_link = $feeder_link = $other = 0;
$additional = $taxi_link + $school_link + $feeder_link + $other;

//deductibles from admin
$deductibles = 0;
$result = get_one("SELECT * FROM fl_drivers_invoices_deductions 
					WHERE driver_id = '".$driver_id."'
					AND MONTH(invoice_date) = '".$month."'
					AND YEAR(invoice_date) = '".$year."'");
$invoice_history = array();
while (count($result) > 0) {
	$amount = $result['amount'];
	$advance = $result['advance'];
	$reason = $result['reason'];
	$d_date = date("d F", strtotime($result['item_date']));
	if ($advance) {
		$reason = 'Advance';
	}
	if ($amount > 0) {
		//$contents['d_reason'] = $reason;
		//$contents['d_date'] = $d_date;
		/*$deductibles_output .= '
			<tr>
				<td class="total-line">'.$reason.' - '.$d_date.':</td>
				<td class="total-value">-'.number_format($amount, 2).'</td>
			</tr>
			';*/
		$invoice_history[] = array("date" => $d_date, "reason" => $reason, "amount" => $amount);
		$deductibles += $amount;
	}
}
$contents['invoice_history'] = $invoice_history;
$contents['month_text'] = $month_text;
$contents['year'] = $year;
//driver pay query
$pay_query = "SELECT SUM(fba.driver_pay) AS day_pay, fb.dep_date, fba.driver_id
				FROM fl_bookings_admin fba
				LEFT JOIN fl_bookings fb
				ON fb.bid = fba.bid
				AND fb.direction = fba.direction
				LEFT JOIN fl_bookings_cancelled fbc
				ON fb.bid = fbc.bid
				WHERE fba.driver_id = ".$driver_id."
				AND right(fb.dep_date,4) = ".$year."
				AND substring(fb.dep_date,4,2) = ".$month."
				AND fbc.cancel_time IS NULL
				GROUP BY dep_date
				ORDER BY right(fb.dep_date,4), substring(fb.dep_date,4,2), left(fb.dep_date,2)
				";
$pay_result = get_all($pay_query);

$subtotal = 0;
$payresults = array();
if (count($pay_result) > 0) {
	//get totals
	foreach($pay_result as $day_pay) {
		$payresult = array();
		$dep_date_array = explode('/', $day_pay['dep_date']);
		$pay_date = date("l d F Y", strtotime($dep_date_array[2].'-'.$dep_date_array[1].'-'.$dep_date_array[0]));
		$amount = $day_pay['day_pay'];
		if ($amount > 0) {
			$payresult['pay_date'] = $pay_date;
			$payresult['amount'] = $amount;
			/*echo '
				<tr>
					<td>'.$pay_date.'</td>
					<td>'.$amount.'</td>
				</tr>';*/
			$subtotal += $amount;
		}
		$payresults[] = $payresult;
	}
}
$contents['payresults'] = $payresults;

/*$cash_deductions = get_drivers_deductions($db, $year, $month, $driver_id);
if ($cash_deductions > 0) {
$cash_deductions_output .= '
	<tr>
		<td>Payment received by cash:</td>
		<td>-'.number_format($cash_deductions, 2).'</td>
	</tr>
	';
}*/

$subtotal += $additional;
$overall_total = $subtotal - $cash_deductions - $deductibles;
$contents['subtotal'] = number_format($subtotal, 2);

#first, is date after invoice date?
if (time() > strtotime($year.'-'.$month.'-'.$lastday)) {
	#check whether button should be shown
	$showsubmitbutton = true;
	$showviewbutton = false;

	#check if invoice was submitted before
	$invoice_result = get_one("SELECT * 
								FROM fl_drivers_invoices
								WHERE MONTH(invoice_date) = '".$month."'
								AND YEAR (invoice_date) = '".$year."'
								AND driver_id = '".$driver_id."'");
	if (count($invoice_result) > 0) {
		$showsubmitbutton = false;
		$showviewbutton = true;
		$invoice_id = $invoice_result['invoice_id'];
		$contents['invoice_id'] = $invoice_id;
	}
	
	$contents['showsubmitbutton'] = $showsubmitbutton;
	$contents['showviewbutton'] = $showviewbutton;
}
$contents['yyyymm'] = $yyyymm;

$res = array("res" => 200, "msg" => "Success", "contents" => $contents);
?>