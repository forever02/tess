﻿<?php
$curapi = isset($_REQUEST['curapi']) ? $_REQUEST['curapi'] : "login";
$apilist = array("get_userlist", "signup", "login"/*, "logout", "get_vehicles", "set_start_shift", "set_end_shift", "my_daily_schedule", "my_daily_schedule_pop_over", "full_daily_schedule", "full_daily_schedule_pop_over", "get_fuel_type", "set_refueling", "get_place", "set_parking", "get_invoices", "set_unavailability", "set_driverstate", "set_activestate", "set_GPSlocation", "set_airportlog", "set_invoice", "get_upcomingjourneys", "set_upcomingjourney"*/);
sort($apilist);
echo "<ul style='padding-left:0px;'>";
foreach($apilist as $api)
	echo "<li class='" . ($api == $curapi ? "curapi" : "") . "'><a href='index.php?curapi=$api'>$api</a></li>";
echo "</ul>";
?>