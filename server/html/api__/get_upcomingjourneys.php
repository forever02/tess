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

$driver_id = $users[0]['driver_id'];

$drivers_bookings_qry = "	SELECT fb.*, fba.driver_pay, fdba.accepted
							FROM fl_bookings_admin fba
							LEFT JOIN fl_bookings fb
							ON fba.bid = fb.bid
							AND fba.direction = fb.direction
							LEFT JOIN fl_bookings_cancelled fbc
							ON fbc.bid = fb.bid
							AND fbc.direction = fb.direction
							LEFT JOIN fl_drivers_bookings_accepted fdba
							ON fdba.bid = fb.bid
							AND fdba.direction = fb.direction
							AND fdba.driver_id = '".$driver_id."'
							WHERE CAST(concat(right(fb.dep_date,4),substring(fb.dep_date,4,2),left(fb.dep_date,2)) AS DATE) >= CURDATE()
							AND fbc.cancel_time IS NULL
							AND fba.driver_id  = '".$driver_id."'
							ORDER BY CAST(concat(right(fb.dep_date,4),substring(fb.dep_date,4,2),left(fb.dep_date,2)) AS DATE) ASC
							";
$drivers_bookings_result = sql_get($drivers_bookings_qry);
$bookings_array = array();
foreach($drivers_bookings_result as $drivers_bookings) {
	$booking_id = $drivers_bookings['bid'];
	$direction = $drivers_bookings['direction'];
	$travel_opt = $drivers_bookings['travel_opt'];
	$accepted = $drivers_bookings['accepted'];
	$dep_date = $drivers_bookings['dep_date'];
	$split_date = explode("/", $dep_date);
	$dep_date_sql = $split_date[2].'-'.$split_date[1].'-'.$split_date[0];
	$driver_pay = $drivers_bookings['driver_pay'];
	if ($travel_opt == 'blue' && $drivers_bookings['will_share'] == '1') {
		$travel_opt = 'green';
	}
	switch ($travel_opt) {
		case 'silver':
			$travel_opt = '1silver';
		break;
		case 'blue':
			$travel_opt = '2blue';
		break;
		case 'green':
			$travel_opt = '3green';
		break;
		default:
			$travel_opt = '3green';
		break;	
	}
	
	if ($direction == 'out') {
		$pickup_time 	= $drivers_bookings['ob_pickup'];
		$airport_query = get_airport($db, $drivers_bookings['lcn_deliver'], NULL);
		$terminal_query = get_airport_terminal_abbr($airport_query);
		$airport		= $airport_query['placename'].$terminal_query;
		$distance_out	= $drivers_bookings['journey_distance'];
		$distance_in	= NULL;
	} else {
		$pickup_time = $drivers_bookings['dep_time'];
		$airport_query = get_airport($db, $drivers_bookings['lcn_collect'], NULL);
		$terminal_query = get_airport_terminal_abbr($airport_query);
		$airport		= $airport_query['placename'].$terminal_query;
		$distance_out	= NULL;
		$distance_in	= $drivers_bookings['journey_distance'];
	}

	$bookings_array[] = array('dep_date' => $dep_date_sql, 'pickup_time' => $pickup_time, 'direction' => $direction, 'airport' => $airport, 'travel_opt' => $travel_opt, 'distance_out' => $distance_out, 'distance_in' => $distance_in, 'bid' => $booking_id, 'driver_pay' => $driver_pay, 'accepted' => $accepted);
	$dep_date_array[] = $dep_date_sql;
	$pickup_time_array[] = $pickup_time;
	$direction_array[] = $direction;
	$airport_array[] = $airport;
	$travel_opt_array[] = $travel_opt;
	$distance_out_array[] = $distance_out;
	$distance_in_array[] = $distance_in;
	$bid[] = $booking_id;
}

$schoollink_array = array();
$routes_qry = get_all("	SELECT ds.route_date, ds.route_id, rd.vehicle_id_am, rd.driver_id_am
							FROM sl_daily_schedule ds
							LEFT JOIN sl_route_drivers rd
							ON rd.route_id = ds.route_id
							AND rd.route_date = ds.route_date
							WHERE ds.route_date >= CURDATE()
							AND ds.am_pm = 'am'
							and rd.school_open_am = 'Yes'
							AND rd.driver_id_am = '".$driver_id."'
							GROUP BY ds.route_date, rd.route_id
							");
foreach($routes_qry as $routes_res) {
	$route_id = $routes_res['route_id'];
	$driver_id_am = $routes_res['driver_id_am'];
	$vehicle_id_am = $routes_res['vehicle_id_am'];
	$dep_date = $routes_res['route_date'];
	$d_res = get_one("SELECT flightlink 
						FROM fl_drivers 
						WHERE driver_id = '".$driver_id_am."'");
	$flightlink = $d_res['flightlink'];
	$v_res = get_one("SELECT owner_driver 
						FROM fl_vehicles 
						WHERE vehicle_id = '".$vehicle_id_am."'");
	$owner_driver = $v_res['owner_driver'];
	
	if ($flightlink == '1' && $owner_driver == '0') {
		$times_res = get_one("SELECT ds_pickup_time, ds_id
									FROM sl_daily_schedule ds
									WHERE route_id = '".$route_id."'
									AND route_date = '".$dep_date."'
									AND am_pm = 'am'
									ORDER BY ds_pickup_time ASC
									");
		$ds_pickup = substr($times_res['ds_pickup_time'],0,5);
		$ds_id = $times_res['ds_id'];
		$bookings_array[] = array('dep_date' => $dep_date, 'pickup_time' => $ds_pickup, 'direction' => 'sl_out', 'airport' => 'school', 'travel_opt' => '', 'distance_out' => '', 'distance_in' => '', 'bid' => $ds_id, 'driver_pay' => '', 'accepted' => '');
		$dep_date_array[] = $dep_date;
		$pickup_time_array[] = $ds_pickup;
		$direction_array[] = 'sl_out';
		$airport_array[] = 'school';
		$travel_opt_array[] = '';
		$distance_out_array[] = '';
		$distance_in_array[] = '';
		$bid[] = $ds_id;
	}
}

$routes_qry = get_all("	SELECT ds.route_date, ds.route_id, rd.vehicle_id_pm, rd.driver_id_pm
							FROM sl_daily_schedule ds
							LEFT JOIN sl_route_drivers rd
							ON rd.route_id = ds.route_id
							AND rd.route_date = ds.route_date
							WHERE ds.route_date >= CURDATE()
							AND ds.am_pm = 'pm'
							and rd.school_open_pm = 'Yes'
							AND rd.driver_id_pm = '".$driver_id."'
							GROUP BY ds.route_date, rd.route_id
							");
foreach($routes_qry as $routes_res) {
	$route_id = $routes_res['route_id'];
	$driver_id_pm = $routes_res['driver_id_pm'];
	$vehicle_id_pm = $routes_res['vehicle_id_pm'];
	$dep_date = $routes_res['route_date'];
	$d_res = get_one("SELECT flightlink 
						FROM fl_drivers 
						WHERE driver_id = '".$driver_id_pm."'");
	$flightlink = $d_res['flightlink'];
	$v_res = get_one("SELECT owner_driver 
						FROM fl_vehicles 
						WHERE vehicle_id = '".$vehicle_id_pm."'");
	$owner_driver = $v_res['owner_driver'];
	
	if ($flightlink == '1' && $owner_driver == '0') {
		$times_res = get_one("SELECT ds_pickup_time, ds_id
									FROM sl_daily_schedule ds
									WHERE route_id = '".$route_id."'
									AND route_date = '".$dep_date."'
									AND am_pm = 'pm'
									ORDER BY ds_pickup_time ASC
									");
		$ds_pickup = substr($times_res['ds_pickup_time'],0,5);
		$ds_id = $times_res['ds_id'];
		$bookings_array[] = array('dep_date' => $dep_date, 'pickup_time' => $ds_pickup, 'direction' => 'sl_in', 'airport' => 'school', 'travel_opt' => '', 'distance_out' => '', 'distance_in' => '', 'bid' => $ds_id, 'driver_pay' => '', 'accepted' => '');
		$dep_date_array[] = $dep_date;
		$pickup_time_array[] = $ds_pickup;
		$direction_array[] = 'sl_in';
		$airport_array[] = 'school';
		$travel_opt_array[] = '';
		$distance_out_array[] = '';
		$distance_in_array[] = '';
		$bid[] = $ds_id;
	}
}

if ($pickup_time_array) {
	array_multisort($dep_date_array, SORT_ASC, $pickup_time_array, SORT_ASC, $direction_array, SORT_ASC, $airport_array, SORT_ASC, $travel_opt_array, SORT_ASC, $distance_out_array, SORT_DESC, $distance_in_array, SORT_ASC, $bookings_array);
}
unset($dep_date);

$contents = array();
foreach ($bookings_array as $key => $booking_details) {
	unset($accepted);
	$content = array();
	$bid = $booking_details['bid'];
	$direction = $booking_details['direction'];
	$dep_date_sql = $booking_details['dep_date'];
	$dep_day = date('l', strtotime($dep_date_sql));
	
	$content['direction'] = $direction;
	if ($direction == 'sl_out' || $direction == 'sl_in') {
		$sl_res = get_one("SELECT ds.*, r.route_code, s.school_name, s.".$dep_day."_start_time start_time, rd.*
			FROM sl_daily_schedule ds
			LEFT JOIN sl_routes r
			ON r.route_id = ds.route_id
			LEFT JOIN sl_route_drivers rd
			ON r.route_id = rd.route_id
			AND rd.route_date = '".$dep_date_sql."'
			LEFT JOIN sl_schools s
			ON r.school_id = s.school_id
			WHERE ds_id = '".$bid."'");
		$route_code = $sl_res['route_code'];
		$sl_pickup = date("l j F", strtotime($sl_res['route_date'])) . '<br>' . substr($sl_res['ds_pickup_time'], 0, 5);
		$school_start = substr($sl_res['start_time'],0,5);
		$school_name = $sl_res['school_name'];
		if ($direction == 'sl_out') {
			$sl_driver_id = $sl_res['driver_id_am'];
			$sl_vehicle_id = $sl_res['vehicle_id_am'];
		} else {
			$sl_driver_id = $sl_res['driver_id_pm'];
			$sl_vehicle_id = $sl_res['vehicle_id_pm'];
		}
		$sl_child = $sl_res['ds_firstname'].' '.$sl_res['ds_surname'];
		$sl_address = '';
		if ($sl_res['ds_address1']) $sl_address .= $sl_res['ds_address1'].'<br />';
		if ($sl_res['ds_city']) $sl_address .= $sl_res['ds_city'].'<br />';
		$driver_res = get_one("SELECT *	FROM fl_drivers	WHERE driver_id='" . $sl_driver_id . "'");
		$sl_driver = $driver_res['firstname'].' '.$driver_res['surname'];
		$this_driver_id = $driver_res['driver_id'];
		$vehicle_res = get_one("SELECT * FROM fl_vehicles WHERE vehicle_id = '".$sl_vehicle_id."'");
		$sl_vehicle = $vehicle_res['registration_number'];
		$showthisrow = true;
		if ($schedule == 'driver' && $driver_id != $this_driver_id) {
			$showthisrow = false;
		}
		$content['showthisrow'] = $showthisrow;
		if ($showthisrow) {
			$content['sl_pickup'] = $sl_pickup;
			$content['route_code'] = $route_code;
			$content['sl_address'] = $sl_address;
			$content['school_name'] = $school_name;
		}
	} else {
		$travel_opt = $booking_details['travel_opt'];
		$accepted = $booking_details['accepted'];
		$blue_shared = get_bluelink_shared($bid, $direction, 1);
		$pickup_time = $booking_details['pickup_time'];
		$driver_pay = $booking_details['driver_pay'];
		$airport = $booking_details['airport'];
		$airport_colour="#000";
		if ($airport != "Cardiff Airport")
			$airport_colour="#F00";
		
		if ($direction == 'out') {
			$content['travel_opt'] = $travel_opt;
			$content['blue_shared_icon'] = $blue_shared['icon'];
			$content['blue_shared_alt'] = $blue_shared['alt'];
			$pickup_addresses = '';
			$pickup_address_ob_query = get_pickup_dropoff_info($bid, 'pick');
			$pickup_array_ob = mysql_fetch_array($pickup_address_ob_query);
			if (trim($pickup_array_ob['address4']))
				$pickup_addresses .= $pickup_array_ob['address4'];
			else if (trim($pickup_array_ob['address3']))
				$pickup_addresses .= $pickup_array_ob['address3'];
			else if (trim($pickup_array_ob['address2']))
				$pickup_addresses .= $pickup_array_ob['address2'];
			$content['dropoff_addresses'] = $dropoff_addresses;
			$content['dropoff_addresses_city'] = $dropoff_array_ob['city'];
			$content['airport_colour'] = $airport_colour;
			$content['airport'] = $airport;
		} else {
			$content['travel_opt'] = $travel_opt;
			$content['blue_shared_icon'] = $blue_shared['icon'];
			$content['blue_shared_alt'] = $blue_shared['alt'];
			$dropoff_addresses = '';
			$dropoff_address_ib_query = get_pickup_dropoff_info($bid, 'drop');
			$dropoff_array_ib = mysql_fetch_array($dropoff_address_ib_query);
			if (trim($dropoff_array_ib['address4']))
				$dropoff_addresses .= $dropoff_array_ib['address4'];
			else if (trim($dropoff_array_ib['address3']))
				$dropoff_addresses .= $dropoff_array_ib['address3'];
			else if (trim($dropoff_array_ib['address2']))
				$dropoff_addresses .= $dropoff_array_ib['address2'];
			$content['dropoff_addresses'] = $dropoff_addresses;
			$content['dropoff_addresses_city'] = $dropoff_array_ib['city'];
			$content['airport_colour'] = $airport_colour;
			$content['airport'] = $airport;
		}
		$content['bid'] = $bid;
		$content['direction'] = $direction;
		$content['driver_id'] = $driver_id;
		$content['dep_date_sql'] = date("l j F", strtotime($dep_date_sql));
		$content['pickup_time'] = date('H:i', strtotime($pickup_time));
		$content['driver_pay'] = $driver_pay;
		$content['accepted'] = $accepted;
	}
	$contents[] = $content;
}

$res = array("res" => 200, "msg" => "Success", "contents" => $contents);
?>