<?php
$require_params = array("pin", "bid", "direction", "dep_date");
foreach($require_params as $rp)
{
	if (!isset($data[$rp]) || trim($data[$rp]) == "")
		die(json_encode(array("res" => 301, "msg" => "Require Parameters!!!")));
}

$pin = $data['pin'];

$users = get_all("select * from fl_drivers where pass='$pin'");
if (count($users) == 0)
	die(json_encode(array("res" => 311, "msg" => "Not found pass.")));

$bid = $data['bid'];
$direction = $data['direction'];
$dep_date = $data['dep_date'];

// query the fl_bookings_link table
$fl_bookings_link_sql = "SELECT DISTINCT fl_users.surname, fl_bookings_link.bid, fl_bookings_link.sid, fl_bookings_link.btime, fl_bookings_payments.*, fl_bookings.*, fl_bookings_admin.driver_id, fl_bookings_admin.vehicle_id, fl_bookings_admin.driver_pay, fl_bookings_admin.flight_confirmation, fl_bookings_admin.booking_confirmation, fl_admin_bookings_payments.driver_paid
							FROM fl_bookings_link
								JOIN (fl_bookings_payments, 
								 fl_bookings,
								 fl_users) 
							ON (fl_bookings_payments.bid = fl_bookings_link.bid 
								AND fl_bookings_payments.bid = fl_bookings.bid 
								AND fl_bookings_link.bid = fl_bookings.bid
								AND fl_users.uid = fl_bookings_link.uid)
							LEFT JOIN fl_bookings_admin
							ON fl_bookings.bid = fl_bookings_admin.bid
							AND fl_bookings.direction = fl_bookings_admin.direction
							LEFT JOIN fl_admin_bookings_payments
							ON fl_bookings.bid = fl_admin_bookings_payments.bid
							AND fl_admin_bookings_payments.method = 'Payment to Driver'
							AND fl_admin_bookings_payments.payment_date = '".$dep_date."'
							WHERE fl_bookings_link.bid = '".$bid."'
							AND fl_bookings.direction = '".$direction."'
							GROUP BY fl_bookings_link.sid
							ORDER BY fl_bookings_link.btime DESC
						  ";

$fl_bookings_link = get_one($fl_bookings_link_sql);

$vehicle_id = $fl_bookings_link['vehicle_id'];
$booking_confirmation = $fl_bookings_link['booking_confirmation'];
if ($booking_confirmation == '') $booking_confirmation = 'Not Confirmed';
$flight_confirmation = $fl_bookings_link['flight_confirmation'];
if ($flight_confirmation == '') $flight_confirmation = 0;
$driver_pay = $fl_bookings_link['driver_pay'];

$booking_date_created = date('d-M-y', strtotime($fl_bookings_link['btime']));		
$booking_time_created = date('H:i', strtotime($fl_bookings_link['btime']));		

$fl_charges = get_one("SELECT * FROM fl_bookings_charges WHERE bid = '".$bid."'");
if (count($fl_charges) > 0) { 
	$booking_fee = $fl_charges['booking_fee'];
	$vdiscount =  $fl_charges['discount'];
} else { 
	$booking_fee = 0;
	$vdiscount =  0;
}

$driver_name = '';
$this_driver_id = $fl_bookings_link['driver_id'];
if ($this_driver_id) {
	$fl_drivers = get_drivers($this_driver_id, NULL, NULL, NULL);
	$driver_name = $fl_drivers['firstname'].' '.$fl_drivers['surname'];
}

//driver paid?
$driver_paid = ($fl_bookings_link['driver_paid'] == '1') ? true : false;

$has_return = false;
$confirmed_return = false;
$journey_type = $fl_bookings_link['journey'];

if (substr($journey_type, 0, 3) == 'rtn') {
	//return journey type
	if ($journey_type == 'rtn_to_air' && $direction == 'out') {
		if ($fl_booking_ib 	= get_booking_info($fl_bookings_link['sid'], 'in', '', '')) {
			$has_return = true;
			$check_direction = 'in';
		}
	} else if ($journey_type == 'rtn_from_air' && $direction == 'in') {
		if ($fl_booking_ob 	= get_booking_info($fl_bookings_link['sid'], 'out', '', '')) {
			$has_return = true;
			$check_direction = 'out';
		}
	}
	if ($has_return) {
		$confirmed_result = get_one("SELECT booking_confirmation 
								FROM fl_bookings_admin
								WHERE bid = '".$bid."'
								AND direction = '".$check_direction."'");
		if (count($confirmed_result) > 0) {
			$confirmed = $confirmed_result['booking_confirmation'];
			if ($confirmed != '' && $confirmed != 'Not Confirmed') {
				$confirmed_return = true;
			}
		}
	}
}

$flying_urls = array(
	'Cardiff Airport' => "http://www.cardiff-airport.com/live-flight-information/",
	'Bristol Airport' => "http://www.bristolairport.co.uk/arrivals-and-departures/arrivals",
	'Gatwick Airport' => "http://www.gatwickairport.com/flights/",
	'Heathrow Airport' => "http://www.heathrowairport.com/flight-information/live-flight-arrivals",
	'Birmingham Airport' => "https://birminghamairport.co.uk/arrivals-and-departures/",
	'Stansted Airport' => "http://www.stanstedairport.com/flight-information/flight-arrivals/",
	'Manchester Airport' => "http://www.manchesterairport.co.uk/flight-information/",
	'East Midlands Airport' => "http://www.eastmidlandsairport.com/flightinformation/"
);

if ($direction == 'out') {
	$fl_booking_ob = get_booking_info($fl_bookings_link['sid'], 'out', '', '');
	$pickup_time = $fl_booking_ob['ob_pickup'];
	$shutt_time = $fl_booking_ob['sht_arr_time'];
	// out-bound booking variables 	
	//============================
	$ob_pickup_charge = $fl_booking_ob['pickup_charge'];
	$ob_pax_price 	= $fl_booking_ob['price'];
	$travel_opt_ob = ucfirst($fl_booking_ob['travel_opt']);
	$flying_from = get_airport($fl_booking_ob['lcn_deliver'], NULL);
	$terminal_from=get_airport_terminal_abbr($flying_from);
	$flight_no_ob = (stristr($fl_booking_ob['flight_no'], 'confirmed')) ? 'TBC' : $fl_booking_ob['flight_no'];

	$total_outbound_payable = floatval($ob_pax_price + $ob_pickup_charge);
	
	$blue_shared_ob = get_bluelink_shared($fl_booking_ob['bid'], $fl_booking_ob['direction'], 1);
	$journey_distance_ob = $fl_booking_ob['journey_distance'];
	$pickup_addresses_ob_links = '';
	$pickup_addresses_ob_links_url = '';
	$pickup_address_ob_query = get_pickup_dropoff_info($bid, 'pick');
	$notfirst = false;
	while ($pickup_array_ob = mysql_fetch_array($dropoff_address_ib_query)) {
		if (!$notfirst) {
			$notfirst = true;
			//get 1st passenger name and telephone
			$pass_name = calculate_name($pickup_array_ob['firstname'], $pickup_array_ob['surname'], $pickup_array_ob['title']);
			$telephone = explode('_', $pickup_array_ob['telephone1']);
			$use_telephone1 = ($pickup_array_ob['telephone1']) ? trim($telephone[0].' '.$telephone[1]) : NULL;
			#$mob_no = explode('_', $fl_billing['telephone2']);
			#$use_telephone2 = ($fl_billing['telephone2']) ? trim($mob_no[0].' '.$mob_no[1]) : NULL;	
		}
		$pickup_addresses_ob = $pickup_array_ob['house_no'].' '.$pickup_array_ob['address1'].'<br />';
		if (trim($pickup_array_ob['address2'])) $pickup_addresses_ob .= $pickup_array_ob['address2'].'<br />';
		if (trim($pickup_array_ob['address3'])) $pickup_addresses_ob .= $pickup_array_ob['address3'].'<br />';
		if (trim($pickup_array_ob['address4'])) $pickup_addresses_ob .= $pickup_array_ob['address4'].'<br />';
		$pickup_addresses_ob .= $pickup_array_ob['city'].'<br />'.str_replace('_', ' ', $pickup_array_ob['postcode']).'<br />';
		$pickup_addresses_ob_links .= $pickup_addresses_ob . ',';
		$pickup_addresses_ob_links_url .= 'http://maps.google.com/maps?saddr=Current+Location&daddr=' . $pickup_array_ob['house_no'] . ' ' . $pickup_array_ob['address1'] . ' ' . $pickup_array_ob['city'] . ' ' . $pickup_array_ob['postcode'] . ',';
	}
	if ($pickup_addresses_ob_links != "")
		$pickup_addresses_ob_links = preg_replace("/,$/", "", $pickup_addresses_ob_links);
	if ($pickup_addresses_ob_links_url != "")
		$pickup_addresses_ob_links_url = preg_replace("/,$/", "", $pickup_addresses_ob_links_url);
	
	if (isset($flying_urls[$flying_from['placename']]))
	{
		$dropoff_addresses_ob = $flying_from['placename'];
		$dropoff_addresses_ob_url = $flying_urls[$flying_from['placename']];
	} else {
		$dropoff_addresses_ob = $flying_from['placename'] . $terminal_from;
		$dropoff_addresses_ob_url = "";
	}
	
	//get notes
	$res = get_one("SELECT notes FROM fl_bookings_notes WHERE bid = '".$bid."' AND direction = 'out'");
	$ob_notes = htmlentities($res['notes']);
} else {
	$fl_booking_ob = '';
	$fl_booking_ib 	= get_booking_info($fl_bookings_link['sid'], 'in', '', '');
	$pickup_time = $fl_booking_ib['ob_pickup'];
	$shutt_time = $fl_booking_ib['sht_arr_time'];
	// in-bound booking variables
	//===========================
	$ib_pickup_charge = $fl_booking_ib['pickup_charge'];
	$ib_pax_price 	= $fl_booking_ib['price'];
	$travel_opt_ib 	= ucfirst($fl_booking_ib['travel_opt']);
	$flying_to = get_airport($fl_booking_ib['lcn_collect'], NULL);
	$terminal_to=get_airport_terminal_abbr($flying_to);
	$flight_no_ib = (stristr($fl_booking_ib['flight_no'], 'confirmed')) ? 'TBC' : $fl_booking_ib['flight_no'];

	$total_inbound_payable = floatval($ib_pax_price + $ib_pickup_charge);
	
	$blue_shared_ib = get_bluelink_shared($fl_booking_ib['bid'], $fl_booking_ib['direction'], 1);
	$journey_distance_ib = $fl_booking_ib['journey_distance'];
	$dropoff_addresses_ib_links = '';
	$dropoff_addresses_ib_links_url = '';
	$dropoff_address_ib_query = get_pickup_dropoff_info($bid, 'drop');
	$notfirst = false;
	while ($dropoff_array_ib = mysql_fetch_array($dropoff_address_ib_query)) {
		if (!$notfirst) {
			$notfirst = true;
			//get 1st passenger name and telephone
			$pass_name = calculate_name($dropoff_array_ib['firstname'], $dropoff_array_ib['surname'], $dropoff_array_ib['title']);
			$telephone = explode('_', $dropoff_array_ib['telephone1']);
			$use_telephone1 = ($dropoff_array_ib['telephone1']) ? trim($telephone[0].' '.$telephone[1]) : NULL;
			#$mob_no = explode('_', $fl_billing['telephone2']);
			#$use_telephone2 = ($fl_billing['telephone2']) ? trim($mob_no[0].' '.$mob_no[1]) : NULL;
		}
		$dropoff_addresses_ib = $dropoff_array_ib['house_no'].' '.$dropoff_array_ib['address1'].'<br />';
		if (trim($dropoff_array_ib['address2'])) $dropoff_addresses_ib .= $dropoff_array_ib['address2'].'<br />';
		if (trim($dropoff_array_ib['address3'])) $dropoff_addresses_ib .= $dropoff_array_ib['address3'].'<br />';
		if (trim($dropoff_array_ib['address4'])) $dropoff_addresses_ib .= $dropoff_array_ib['address4'].'<br />';
		$dropoff_addresses_ib .= $dropoff_array_ib['city'].'<br />'.str_replace('_', ' ', $dropoff_array_ib['postcode']).'<br />';
		$dropoff_addresses_ib_links .= $dropoff_addresses_ib . ',';
		$dropoff_addresses_ib_links_url .= 'http://maps.google.com/maps?saddr=Current+Location&daddr=' . $dropoff_array_ib['house_no'] . ' ' . $dropoff_array_ib['address1'] . ' ' . $dropoff_array_ib['city'] . ' ' . $dropoff_array_ib['postcode'] . ',';
	}
	if ($dropoff_addresses_ib_links != '')
		$dropoff_addresses_ib_links = preg_replace("/,$/", "", $dropoff_addresses_ib_links);
	if ($dropoff_addresses_ib_links_url != '')
		$dropoff_addresses_ib_links_url = preg_replace("/,$/", "", $dropoff_addresses_ib_links_url);
	
	if (isset($flying_urls[$flying_to['placename']]))
	{
		$pickup_addresses_ib = $flying_to['placename'];
		$pickup_addresses_ib_url = $flying_urls[$flying_to['placename']];
	} else {
		$pickup_addresses_ib = $flying_to['placename'].$terminal_to;
		$pickup_addresses_ib_url = "";
	}
	
	//get notes
	$res = get_one("SELECT notes FROM fl_bookings_notes WHERE bid = '".$bid."' AND direction = 'in'");
	$ib_notes = htmlentities($res['notes']);
}
//get any payment due to driver
$fl_payments_sql = "	SELECT *
						FROM fl_admin_bookings_payments
						WHERE bid = '".$bid."'
						AND payment_date = '".$dep_date."'
						AND method = 'Payment to Driver'";
$fl_payments = get_one($fl_payments_sql);
if (count($fl_payments) > 0) {
	$payment_due = $fl_payments['amount'];
	$payment_due_text = '&pound;'.$payment_due;
}
else {
	$payment_due = 0;
	$payment_due_text = '&pound;0.00';
}

$contents = array();
$contents['bid'] = $bid;
$contents['dep_date'] = $dep_date;
if ($direction == 'out') {
	$contents['direction'] = 'out';
	$contents['linkimg'] = strtolower($travel_opt_ob).$blue_shared_ob['icon'];
	$contents['linkimgtitle'] = $travel_opt_ob . " Link " . $blue_shared_ob['alt'];
	$contents['income'] = $driver_pay;
	$contents['name'] = $pass_name;
	$contents['telephone'] = $use_telephone1;
	if ($use_telephone2 !='' && $use_telephone1 !='') $contents['telephone2'] = $use_telephone2;
	$contents['pickup_time'] = $pickup_time;
	$contents['shutt_time'] = $shutt_time;
	$contents['from'] = $pickup_addresses_ob_links;
	$contents['from_url'] = $pickup_addresses_ob_links_url;
	$contents['to'] = $dropoff_addresses_ob;
	$contents['to_url'] = $dropoff_addresses_ob_url;
	$contents['no_pax'] = $fl_booking_ob['adults'] . (($fl_booking_ob['babies'] > 0) ? '+' . $fl_booking_ob['babies'] : '');
	$contents['notes'] = $ob_notes;
	$contents['payment_due'] = $payment_due_text;
	$contents['confirmed'] = $booking_confirmation;
} else {
	$contents['direction'] = 'in';
	$contents['linkimg'] = strtolower($travel_opt_ib).$blue_shared_ib['icon'];
	$contents['linkimgtitle'] = $travel_opt_ib . " Link " . $blue_shared_ib['alt'];
	$contents['income'] = $driver_pay;
	$contents['name'] = $pass_name;
	$contents['telephone'] = $use_telephone1;
	if ($use_telephone2 !='' && $use_telephone1 !='') $contents['telephone2'] = $use_telephone2;
	$contents['flight_time'] = $fl_booking_ib['dep_time'];
	$contents['flight_no'] = $flight_no_ib.'<br />'.$fl_booking_ib['port_origin'];
	$contents['from'] = $pickup_addresses_ib;
	$contents['from_url'] = $pickup_addresses_ib_url;
	$contents['to'] = $dropoff_addresses_ib_links;
	$contents['to_url'] = $dropoff_addresses_ib_links_url;
	$contents['no_pax'] = $fl_booking_ib['adults'] . (($fl_booking_ib['babies'] > 0) ? '+' . $fl_booking_ib['babies'] : '');
	$contents['notes'] = $ib_notes;
	$contents['payment_due'] = $payment_due_text;
	$contents['confirmed'] = $booking_confirmation;
}
$contents['has_return'] = $has_return;
$contents['confirmed_return'] = $confirmed_return;
$contents['driver_paid'] = $driver_paid;

$res = array("res" => 200, "msg" => "Success", "contents" => $contents);
?>