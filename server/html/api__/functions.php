<?php
define('DEBUG', true);

if (!function_exists('debug')) {
	function debug($obj)
	{
		if (!DEBUG)
			return;
		$fp = fopen("debug.txt", "a");
		fputs($fp, print_r($obj, true) . "\n");
		fclose($fp);
	}
}

include_once("JSON.php");

// Future-friendly json_encode
if( !function_exists('json_encode') ) {
    function json_encode($data) {
        $json = new Services_JSON();
        return( $json->encode($data) );
    }
}
// Future-friendly json_decode
if( !function_exists('json_decode') ) {
    function json_decode($data) {
        $json = new Services_JSON();
        return( $json->decode($data) );
    }
}

function json_clean_decode($json, $assoc = false, $depth = 512, $options = 0) {
    // search and remove comments like /* */ and //
    $json = preg_replace("#(/\*([^*]|[\r\n]|(\*+([^*/]|[\r\n])))*\*+/)|([\s\t]//.*)|(^//.*)#", '', $json);
    $json = str_replace("\\", '', $json);
    
    if(version_compare(phpversion(), '5.4.0', '>=')) {
        $json = json_decode($json, $assoc, $depth, $options);
    }
    elseif(version_compare(phpversion(), '5.3.0', '>=')) {
        $json = json_decode($json, $assoc, $depth);
    }
    else {
        $json = json_decode($json, $assoc);
    }

    return $json;
}

function get_time() {

	setlocale(LC_TIME, 'en_UK');
	// declare some start variables
	$ThisYear = (date("Y"));
	$MarStartDate = ($ThisYear."-03-25");
	$OctStartDate = ($ThisYear."-10-25");
	$MarEndDate = ($ThisYear."-03-31");
	$OctEndDate = ($ThisYear."-10-31");
	
	//work out the Unix timestamp for 1:00am GMT on the last Sunday of March, when BST starts
	while ($MarStartDate <= $MarEndDate)
	{
		$day = date("l", strtotime($MarStartDate));
		if ($day == "Sunday"){
			$BSTStartDate = ($MarStartDate);
		}
		$MarStartDate++;
	}
	$BSTStartDate = (date("U", strtotime($BSTStartDate))+(60*60));
	//echo "BST this year starts at 1:00am GMT on ";
	//echo date("l, dS M", $BSTStartDate);
	//echo "<br>";
	
	//work out the Unix timestamp for 1:00am GMT on the last Sunday of October, when BST ends
	while ($OctStartDate <= $OctEndDate)
	{
		$day = date("l", strtotime($OctStartDate));
		if ($day == "Sunday"){
			$BSTEndDate = ($OctStartDate);
		}
		$OctStartDate++;
	}
	$BSTEndDate = (date("U", strtotime($BSTEndDate))+(60*60));
	//echo "BST this year ends at 1:00am GMT on ";
	//echo date("l, dS M", $BSTEndDate);
	//echo "<br>";
	
	//Check to see if we are now in BST
	$now = time();
	if (($now >= $BSTStartDate) && ($now <= $BSTEndDate)){
	//echo "We are now in BST";
		$timestamp	= gmstrftime("%Y-%m-%d %T", ($now+3600));
	}
	else {
	//echo "We are now in GMT";
		$timestamp	= gmstrftime("%Y-%m-%d %T", $now);
	}
	return $timestamp;
}

function get_airport($ref, $post_code) {
	$where_ref = "";
	$w = 0;
	$where_post_code = "";
	$and_where_post_code = "";
	if ($ref) {$where_ref = "ref='$ref'"; $w=1;}
	if ($post_code) {$where_post_code = "post_code='$post_code'"; if ($w) {$and_where_post_code='AND';} $w=1;}
	if ($w) {$where = "WHERE $where_ref $and_where_post_code $where_post_code";}
	
	return get_one("SELECT * FROM fl_locations_airports $where");
}

function get_airport_terminal_abbr($airport_array) { //terminal 1 = T1 etc
	if ($airport_array['terminal']) {
		$terminal=' ';
		if (strtolower($airport_array['terminal']) != 'tbc') {
			$words = explode(" ", $airport_array['terminal']);
			foreach ($words as $value) {
				$terminal .= substr($value, 0, 1);
			}
		}
		else $terminal .= 'TBC';
		
		return $terminal;
	}
	else return false;
}

function get_drivers($driver_id, $where_sql, $order_by, $limit) {

	$where = 'WHERE 1 '.$where_sql.' ';
	if ($driver_id) $where .= " AND driver_id = '$driver_id' ";
	if ($order_by) $order_by = " ORDER BY $order_by";
	
	return get_one("SELECT *
						FROM fl_drivers
						$where
						$order_by 
						$limit");
}

function get_booking_info($cart_id, $direction, $dep_date_from, $dep_date_to) {

	if ($direction) { $where_direction = " AND fl_bookings.direction = '$direction'"; }

	if ($dep_date_from) { $where_dep_date_from = " AND CAST(concat(right(fl_bookings.dep_date,4),substring(fl_bookings.dep_date,4,2),left(fl_bookings.dep_date,2)) AS DATE) >= CAST('".substr($dep_date_from, 6, 4)."-".substr($dep_date_from, 3, 2)."-".substr($dep_date_from, 0, 2)."' AS DATE)"; }
	if ($dep_date_to) 	{ $where_dep_date_to = " AND CAST(concat(right(fl_bookings.dep_date,4),substring(fl_bookings.dep_date,4,2),left(fl_bookings.dep_date,2)) AS DATE) <= CAST('".substr($dep_date_to, 6, 4)."-".substr($dep_date_to, 3, 2)."-".substr($dep_date_to, 0, 2)."' AS DATE)"; }
	$where_date = $where_dep_date_from . $where_dep_date_to;

	return get_one("SELECT fl_bookings.*, fl_bookings_share_blue.will_share
					FROM fl_bookings
					LEFT JOIN fl_bookings_share_blue ON (fl_bookings_share_blue.bid = fl_bookings.bid AND fl_bookings_share_blue.direction = fl_bookings.direction)
					WHERE fl_bookings.sid='$cart_id' $where_direction $where_date");
}

function get_bluelink_shared($bid, $direction, $will_share) {
	if ($bid) {$where_bid = "bid='$bid'"; $w=1;}
	if ($direction) {$where_direction = "direction='$direction'"; if ($w) {$and_where_direction='AND';} $w=1;}
	if ($will_share) {$will_share = "will_share='$will_share'"; if ($w) {$and_will_share='AND';} $w=1;}
	if ($w) {$where = "WHERE $where_bid $and_where_direction $where_direction $and_will_share $will_share";}
	
	$qry_blue_shared = get_one("SELECT * FROM fl_bookings_share_blue $where");
	
	if (count($qry_blue_shared) > 0) {
		$blue_shared['vars'] = $qry_blue_shared;
		$blue_shared['icon'] = '-shared';
		$blue_shared['icon_url'] = '/_images/icons/transport-blue-shared-link.png';
		$blue_shared['alt'] = ' - Willing to share';
		return $blue_shared;
	} else {
		return false;
	}
}

function get_pickup_dropoff_info($bid, $journey_opt) {
	global $conn;
	return mysql_query(" SELECT  fl_pickups.*, fl_bookings_link.*
						   FROM  fl_pickups
						   
						   JOIN (fl_bookings_link, fl_bookings_addr_link)
							 ON (fl_bookings_link.bid = fl_bookings_addr_link.bid
							AND  fl_bookings_addr_link.aid = fl_pickups.aid)
							
						  WHERE fl_bookings_link.bid = '$bid' AND fl_bookings_addr_link.journey_opt = '$journey_opt'
						  ORDER BY fl_bookings_addr_link.position ASC", $conn);
}

function calculate_name($forename, $surname, $title) {
	$title = isset($title) ? ucfirst($title)." " : NULL;
	return (!$forename) ? $title.ucwords($surname) : $title.ucwords("$forename $surname");
}
?>