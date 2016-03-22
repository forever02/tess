﻿<?php if ($curapi == "signup") { ?>
	<h3>Signup API</h3>
	Discription:
	<div class="discription">
		<table width="100%">
		<tr><th>Url</th><td>http://www.flightlinkwales.com/api/api.php</td></tr>
		<tr><th>Request</th><td>{"action" : "signup", "data" : {"firstname" : "firstname", "lastname" : "lastname", "email" : "email", "mobile" : "mobile", "radius" : "4.5"}}</td></tr>
		<tr><th>Response</th><td>
			<table>
			<tr><td>Success</td><td>{"res" : 200, "msg" : "Success", "contents" : []}</td></tr>
			<tr><td>Dismiss</td><td>{"res" : 311, "msg" : "Already exist!"}</td></tr>
			<tr><td>Dismiss</td><td>{"res" : 301, "msg" : "Require Parameters!!!"}</td></tr>
			</table>
		</td></tr>
		</table>
	</div>
	Test form:
	<div class="testform">
		<form id="apifrm" action="#" onsubmit="return sendsignupfrm()">
			<table>
			<tr><td>action</td><td><input type=text name="action" value="signup" disabled></td></tr>
			<tr><td>firstname</td><td><input type=text name="firstname" value="firstname" required></td></tr>
			<tr><td>lastname</td><td><input type=text name="lastname" value="lastname"></td></tr>
			<tr><td>email</td><td><input type=text name="email" value="email"></td></tr>
			<tr><td>mobile</td><td><input type=text name="mobile" value="mobile"></td></tr>
			<tr><td>radius</td><td><input type=text name="radius" value="3.5"></td></tr>
			<tr><td></td><td><button>Submit</button></td></tr>
			</table>
		</form>
	</div>
	Test Result:
	<div id="result">
	</div>
<?php } else if ($curapi == "login") { ?>
	<h3>Login API</h3>
	Discription:
	<div class="discription">
		<table width="100%">
		<tr><th>Url</th><td>http://www.flightlinkwales.com/api/api.php</td></tr>
		<tr><th>Request</th><td>{"action" : "login", "data" : {"firstname" : "firstname", "lastname" : "lastname", "email" : "email", "mobile" : "mobile", "radius" : "4.5"}}</td></tr>
		<tr><th>Response</th><td>
			<table>
			<tr><td>Success</td><td>{"res" : 200, "msg" : "Success"}</td></tr>
			<tr><td>Dismiss</td><td>{"res" : 311, "msg" : "Not found user."}</td></tr>
			<tr><td>Dismiss</td><td>{"res" : 301, "msg" : "Require Parameters!!!"}</td></tr>
			</table>
		</td></tr>
		</table>
	</div>
	Test form:
	<div class="testform">
		<form id="apifrm" action="#" onsubmit="return sendloginfrm()">
			<table>
			<tr><td>action</td><td><input type=text name="action" value="login" disabled></td></tr>
			<tr><td>firstname</td><td><input type=text name="firstname" value="firstname" required></td></tr>
			<tr><td>lastname</td><td><input type=text name="lastname" value="lastname"></td></tr>
			<tr><td>email</td><td><input type=text name="email" value="email"></td></tr>
			<tr><td>mobile</td><td><input type=text name="mobile" value="mobile"></td></tr>
			<tr><td>radius</td><td><input type=text name="radius" value="3.5"></td></tr>
			<tr><td></td><td><button>Submit</button></td></tr>
			</table>
		</form>
	</div>
	Test Result:
	<div id="result">
	</div>
<?php } else if ($curapi == "get_userlist") { ?>
	<h3>Get_UserList API</h3>
	Discription:
	<div class="discription">
		<table width="100%">
		<tr><th>Url</th><td>http://www.flightlinkwales.com/api/api.php</td></tr>
		<tr><th>Request</th><td>{"action" : "get_userlist", "data" : {"id" : "user_id", "hash" : "user_hash"}}</td></tr>
		<tr><th>Response</th><td>
			<table>
			<tr><td>Success</td><td>{"res" : 200, "msg" : "Success"}</td></tr>
			<tr><td>Dismiss</td><td>{"res" : 311, "msg" : "Not found user."}</td></tr>
			<tr><td>Dismiss</td><td>{"res" : 301, "msg" : "Require Parameters!!!"}</td></tr>
			</table>
		</td></tr>
		</table>
	</div>
	Test form:
	<div class="testform">
		<form id="apifrm" action="#" onsubmit="return sendget_userlistfrm()">
			<table>
			<tr><td>action</td><td><input type=text name="action" value="get_userlist" disabled></td></tr>
			<tr><td>id</td><td><input type=text name="id" value="user_id" required></td></tr>
			<tr><td>hash</td><td><input type=text name="hash" value="user_hash"></td></tr>
			<tr><td></td><td><button>Submit</button></td></tr>
			</table>
		</form>
	</div>
	Test Result:
	<div id="result">
	</div>
<?php } else if ($curapi == "logout") { ?>
	<h3>Logout API</h3>
	Discription:
	<div class="discription">
		<table width="100%">
		<tr><th>Url</th><td>http://www.flightlinkwales.com/api/api.php</td></tr>
		<tr><th>Request</th><td>{"action" : "logout", "data" : {"pin" : "alex"}}</td></tr>
		<tr><th>Response</th><td>
			<table>
			<tr><td>Success</td><td>{"res" : 200, "msg" : "Success"}</td></tr>
			<tr><td>Dismiss</td><td>{"res" : 311, "msg" : "Not found pin."}</td></tr>
			<tr><td>Dismiss</td><td>{"res" : 301, "msg" : "Require Parameters!!!"}</td></tr>
			</table>
		</td></tr>
		</table>
	</div>
	Test form:
	<div class="testform">
		<form id="apifrm" action="#" onsubmit="return sendlogoutfrm()">
			<table>
			<tr><td>action</td><td><input type=text name="action" value="logout" disabled></td></tr>
			<tr><td>pin</td><td><input type=text name="pin" value="" required></td></tr>
			<tr><td></td><td><button>Submit</button></td></tr>
			</table>
		</form>
	</div>
	Test Result:
	<div id="result">
	</div>
<?php } else if ($curapi == "get_vehicles") { ?>
	<h3>Get Vehicles API</h3>
	Discription:
	<div class="discription">
		<table width="100%">
		<tr><th>Url</th><td>http://www.flightlinkwales.com/api/api.php</td></tr>
		<tr><th>Request</th><td>{"action" : "get_vehicles", "data" : {"pin" : "alex"}}</td></tr>
		<tr><th>Response</th><td>
			<table>
			<tr><td>Success</td><td>{"res" : 200, "msg" : "Success", "contents" : []}</td></tr>
			<tr><td>Dismiss</td><td>{"res" : 311, "msg" : "Not found pin."}</td></tr>
			<tr><td>Dismiss</td><td>{"res" : 301, "msg" : "Require Parameters!!!"}</td></tr>
			</table>
		</td></tr>
		</table>
	</div>
	Test form:
	<div class="testform">
		<form id="apifrm" action="#" onsubmit="return sendgetvehiclesfrm()">
			<table>
			<tr><td>action</td><td><input type=text name="action" value="get_vehicles" disabled></td></tr>
			<tr><td>pin</td><td><input type=text name="pin" value="" required></td></tr>
			<tr><td></td><td><button>Submit</button></td></tr>
			</table>
		</form>
	</div>
	Test Result:
	<div id="result">
	</div>
<?php } else if ($curapi == "set_airportstate") { ?>
	<h3>Set that driver is at the airport API</h3>
	Discription:
	<div class="discription">
		<table width="100%">
		<tr><th>Url</th><td>http://www.flightlinkwales.com/api/api.php</td></tr>
		<tr><th>Request</th><td>{"action" : "set_airportstate", "data" : {"pin" : "alex","date" : "2016/01/01","time" : "09:00:00","lat":"65.234","long":"34.7345"}}</td></tr>
		<tr><th>Response</th><td>
			<table>
			<tr><td>Success</td><td>{"res" : 200, "msg" : "Success", "contents" : []}</td></tr>
			<tr><td>Dismiss</td><td>{"res" : 311, "msg" : "Not found pin."}</td></tr>
			</table>
		</td></tr>
		</table>
	</div>
	Test form:
	<div class="testform">
		<form id="apifrm" action="#" onsubmit="return sendairportstatefrm()">
			<table>
			<tr><td>action</td><td><input type=text name="action" value="set_driverstate" disabled></td></tr>
			<tr><td>pin</td><td><input type=text name="pin" value="" required></td></tr>
			<tr><td>date</td><td><input type=text name="date" value="" required></td></tr>
			<tr><td>time</td><td><input type=text name="time" value="" required></td></tr>
			<tr><td>Lat</td><td><input type=text name="lat" value="" required></td></tr>
			<tr><td>Long</td><td><input type=text name="lng" value="" required></td></tr>
			<tr><td></td><td><button>Submit</button></td></tr>
			</table>
		</form>
	</div>
	Test Result:
	<div id="result">
	</div>	
<?php } else if ($curapi == "set_driverstate") { ?>
	<h3>Set to driver state API</h3>
	Discription:
	<div class="discription">
		<table width="100%">
		<tr><th>Url</th><td>http://www.flightlinkwales.com/api/api.php</td></tr>
		<tr><th>Request</th><td>{"action" : "set_driverstate", "data" : {"pin" : "alex", "vehicle_id" : "VEHICLE_ID", "state" : "stc/pob/clear"}}</td></tr>
		<tr><th>Response</th><td>
			<table>
			<tr><td>Success</td><td>{"res" : 200, "msg" : "Success"}</td></tr>
			<tr><td>Dismiss</td><td>{"res" : 311, "msg" : "Not found pin."}</td></tr>
			</table>
		</td></tr>
		</table>
	</div>
	Test form:
	<div class="testform">
		<form id="apifrm" action="#" onsubmit="return senddriverstatefrm()">
			<table>
			<tr><td>action</td><td><input type=text name="action" value="set_driverstate" disabled></td></tr>
			<tr><td>pin</td><td><input type=text name="pin" value="" required></td></tr>
			<tr><td>vehicle</td><td>
				<select id="vehicle_select" name="vehicle_id" required>
				</select>
			</td></tr>
			<tr><td>Driver State</td><td>
				<select name="dstate" required>
				<option value="stc">stc</option>
				<option value="pob">pob</option>
				<option value="clear">clear</option>
				</select>
			</td></tr>
			<tr><td></td><td><button>Submit</button></td></tr>
			</table>
		</form>
	</div>
	Test Result:
	<div id="result">
	</div>
	<script>
	$(document).ready(function(){
		get_vehicles();
	});
	</script>
<?php } else if ($curapi == "set_activestate") { ?>
	<h3>Set to break on/off API</h3>
	Discription:
	<div class="discription">
		<table width="100%">
		<tr><th>Url</th><td>http://www.flightlinkwales.com/api/api.php</td></tr>
		<tr><th>Request</th><td>{"action" : "set_activestate", "data" : {"pin" : "alex", "active" : "1/0"}}</td></tr>
		<tr><th>Response</th><td>
			<table>
			<tr><td>Success</td><td>{"res" : 200, "msg" : "Success"}</td></tr>
			<tr><td>Dismiss</td><td>{"res" : 311, "msg" : "Not found pin."}</td></tr>
			</table>
		</td></tr>
		</table>
	</div>
	Test form:
	<div class="testform">
		<form id="apifrm" action="#" onsubmit="return sendactivestatefrm()">
			<table>
			<tr><td>action</td><td><input type=text name="action" value="set_activestate" disabled></td></tr>
			<tr><td>pin</td><td><input type=text name="pin" value="" required></td></tr>
			<tr><td>On/Off break</td><td>
				<select name="active" required>
				<option value=1>On</option>
				<option value=0>Off</option>
				</select>
			</td></tr>
			<tr><td></td><td><button>Submit</button></td></tr>
			</table>
		</form>
	</div>
	Test Result:
	<div id="result">
	</div>
<?php } else if ($curapi == "set_GPSlocation") {?>
	<h3>Set GPSlocation API</h3>
	Discription:
	<div class="discription">
		<table width="100%">
		<tr><th>Url</th><td>http://www.flightlinkwales.com/api/api.php</td></tr>
		<tr><th>Request</th><td>{"action" : "set_GPSlocation", "data" : {"pin" : "alex", "vehicle_id":"VEHICLE_ID", "lat":"65.234", "lng":"34.7345"}}</td></tr>
		<tr><th>Response</th><td>
			<table>
			<tr><td>Success</td><td>{"res" : 200, "msg" : "Success"}</td></tr>
			<tr><td>Dismiss</td><td>{"res" : 311, "msg" : "Not found pin."}</td></tr>
			</table>
		</td></tr>
		</table>
	</div>
	Test form:
	<div class="testform">
		<form id="apifrm" action="#" onsubmit="return sendsetGPSlocationfrm()">
			<table>
			<tr><td>action</td><td><input type=text name="action" value="set_GPSlocation" disabled></td></tr>
			<tr><td>pin</td><td><input type=text name="pin" value="" required></td></tr>
			<tr><td>vehicle</td><td>
				<select id="vehicle_select" name="vehicle_id" required>
				</select>
			</td></tr>
			<tr><td>Lat</td><td><input type=text name="lat" value="" required></td></tr>
			<tr><td>Lng</td><td><input type=text name="lng" value="" required></td></tr>
			<tr><td></td><td><button>Submit</button></td></tr>
			</table>
		</form>
	</div>
	Test Result:
	<div id="result">
	</div>
	<script>
	$(document).ready(function(){
		get_vehicles();
	});
	</script>
<?php } else if ($curapi == "set_start_shift") { ?>
	<h3>Set Start Shift API</h3>
	Discription:
	<div class="discription">
		<table width="100%">
		<tr><th>Url</th><td>http://www.flightlinkwales.com/api/api.php</td></tr>
		<tr><th>Request</th><td>{"action": "set_start_shift", "data" : {"pin" : "alex", "vehicle_id" : "123", "mileage" : "12345", "lat" : "12.345", "lng" : "12.345", "report_text" : "REPORT_TEXT", "defects" : [{"Fuel/Oil/Waste leaks" : "yes"}, {"Wipers" : "no"}, ...]}}</td></tr>
		<tr><th>Response</th><td>
			<table>
			<tr><td>Success</td><td>{"res" : 200, "msg" : "Success"}</td></tr>
			<tr><td>Dismiss</td><td>{"res" : 311, "msg" : "Not found pin."}</td></tr>
			<tr><td>Dismiss</td><td>{"res" : 301, "msg" : "Require Parameters!!!"}</td></tr>
			</table>
		</td></tr>
		</table>
	</div>
	Test form:
	<div class="testform">
		<form id="apifrm" action="#" onsubmit="return sendsetstartshiftfrm()">
			<table>
			<tr><td>action</td><td><input type=text name="action" value="set_start_shift" disabled></td></tr>
			<tr><td>pin</td><td><input type=text name="pin" value="" required></td></tr>
			<tr><td>vehicle</td><td>
				<select id="vehicle_select" name="vehicle_id" required>
				</select>
			</td></tr>
			<tr><td>mileage</td><td><input type=text name="mileage" value="" required></td></tr>
			<tr><td>lat</td><td><input type=text name="lat" value="" required></td></tr>
			<tr><td>lng</td><td><input type=text name="lng" value="" required></td></tr>
			<tr><td>defects</td><td>
				<?php $defects = array("Fuel/Oil/Waste leaks", "Wipers", "Mirrors", "Battery (if accessible)", "Washers", "Steering", "Tyres and wheel fixing", "Horn", "Heating/Ventilation", "Brakes", "Glass", "Lights", "Doors and exits", "Reflectors", "Body Interior", "Indicators", "Body Exterior", "Excessive engine exhaust smoke", "Fire extinguisher", "First aid kit"); ?>
				<?php foreach($defects as $defect) { ?>
				<input type="checkbox" id="defects_<?php echo $defect; ?>" checked><?php echo $defect; ?><input type="text" id="report_text_<?php echo $defect; ?>"><br>
				<?php } ?>
			</td></tr>
			<tr><td></td><td><button>Submit</button></td></tr>
			</table>
		</form>
	</div>
	Test Result:
	<div id="result">
	</div>
	<script>
	$(document).ready(function(){
		get_vehicles();
	});
	</script>
<?php } else if ($curapi == "set_end_shift") { ?>
	<h3>Set End Shift API</h3>
	Discription:
	<div class="discription">
		<table width="100%">
		<tr><th>Url</th><td>http://www.flightlinkwales.com/api/api.php</td></tr>
		<tr><th>Request</th><td>{"action" : "set_end_shift", "data" : {"pin" : "alex", "vehicle_id" : "123", "mileage" : "12345", "lat" : "12.345", "lng" : "12.345", "report_text" : "REPORT_TEXT", "defects" : [{"Fuel/Oil/Waste leaks" : "yes"}, {"Wipers" : "no"}, ...]}}</td></tr>
		<tr><th>Response</th><td>
			<table>
			<tr><td>Success</td><td>{"res" : 200, "msg" : "Success"}</td></tr>
			<tr><td>Dismiss</td><td>{"res" : 311, "msg" : "Not found pin."}</td></tr>
			<tr><td>Dismiss</td><td>{"res" : 301, "msg" : "Require Parameters!!!"}</td></tr>
			</table>
		</td></tr>
		</table>
	</div>
	Test form:
	<div class="testform">
		<form id="apifrm" action="#" onsubmit="return sendsetendshiftfrm()">
			<table>
			<tr><td>action</td><td><input type=text name="action" value="set_end_shift" disabled></td></tr>
			<tr><td>pin</td><td><input type=text name="pin" value="" required></td></tr>
			<tr><td>vehicle</td><td>
				<select id="vehicle_select" name="vehicle_id" required>
				</select>
			</td></tr>
			<tr><td>mileage</td><td><input type=text name="mileage" value="" required></td></tr>
			<tr><td>lat</td><td><input type=text name="lat" value="" required></td></tr>
			<tr><td>lng</td><td><input type=text name="lng" value="" required></td></tr>
			<tr><td>defects</td><td>
				<?php $defects = array("Fuel/Oil/Waste leaks", "Wipers", "Mirrors", "Battery (if accessible)", "Washers", "Steering", "Tyres and wheel fixing", "Horn", "Heating/Ventilation", "Brakes", "Glass", "Lights", "Doors and exits", "Reflectors", "Body Interior", "Indicators", "Body Exterior", "Excessive engine exhaust smoke", "Fire extinguisher", "First aid kit"); ?>
				<?php foreach($defects as $defect) { ?>
				<input type="checkbox" id="defects_<?php echo $defect; ?>" checked><?php echo $defect; ?><input type="text" id="report_text_<?php echo $defect; ?>"><br>
				<?php } ?>
			</td></tr>
			<tr><td></td><td><button>Submit</button></td></tr>
			</table>
		</form>
	</div>
	Test Result:
	<div id="result">
	</div>
	<script>
	$(document).ready(function(){
		get_vehicles();
	});
	</script>
<?php } else if ($curapi == "my_daily_schedule") { ?>
	<h3>Get My Daily Schedule API</h3>
	Discription:
	<div class="discription">
		<table width="100%">
		<tr><th>Url</th><td>http://www.flightlinkwales.com/api/api.php</td></tr>
		<tr><th>Request</th><td>{"action" : "my_daily_schedule", "data" : {"pin" : "alex", "schedule" : "driver"}}</td></tr>
		<tr><th>Response</th><td>
			<table>
			<tr><td>Success</td><td>{"res" : 200, "msg" : "Success", "contents" : []}</td></tr>
			<tr><td>Dismiss</td><td>{"res" : 311, "msg" : "Not found pin."}</td></tr>
			<tr><td>Dismiss</td><td>{"res" : 301, "msg" : "Require Parameters!!!"}</td></tr>
			</table>
		</td></tr>
		</table>
	</div>
	Test form:
	<div class="testform">
		<form id="apifrm" action="#" onsubmit="return sendgetmydailyschedulefrm()">
			<table>
			<tr><td>action</td><td><input type=text name="action" value="my_daily_schedule" disabled></td></tr>
			<tr><td>pin</td><td><input type=text name="pin" value="" required></td></tr>
			<tr><td>schedule</td><td>
				<select name="schedule" required>
				<option value="driver">driver</option>
				</select>
			</td></tr>
			<tr><td></td><td><button>Submit</button></td></tr>
			</table>
		</form>
	</div>
	Test Result:
	<div id="result">
	</div>
<?php } else if ($curapi == "my_daily_schedule_pop_over") { ?>
	<h3>Get My Daily Schedule Pop Over API</h3>
	Discription:
	<div class="discription">
		<table width="100%">
		<tr><th>Url</th><td>http://www.flightlinkwales.com/api/api.php</td></tr>
		<tr><th>Request</th><td>{"action" : "my_daily_schedule_pop_over", "data" : {"pin" : "alex", "bid" : "123", "direction" : "in", "dep_date" : "2016-02-17"}}</td></tr>
		<tr><th>Response</th><td>
			<table>
			<tr><td>Success</td><td>{"res" : 200, "msg" : "Success", "contents" : {}}</td></tr>
			<tr><td>Dismiss</td><td>{"res" : 311, "msg" : "Not found pin."}</td></tr>
			<tr><td>Dismiss</td><td>{"res" : 301, "msg" : "Require Parameters!!!"}</td></tr>
			</table>
		</td></tr>
		</table>
	</div>
	Test form:
	<div class="testform">
		<form id="apifrm" action="#" onsubmit="return sendgetmydailyschedulepopoverfrm()">
			<table>
			<tr><td>action</td><td><input type=text name="action" value="my_daily_schedule_pop_over" disabled></td></tr>
			<tr><td>pin</td><td><input type=text name="pin" value="" required></td></tr>
			<tr><td>bid</td><td><input type=text name="bid" value="" required></td></tr>
			<tr><td>direction</td><td>
				<select name="direction" required>
				<option value="in">in</option>
				<option value="out">out</option>
				</select>
			</td></tr>
			<tr><td>dep_date</td><td><input type=text name="dep_date" value="" required placeholder='YYYY-MM-DD'></td></tr>
			<tr><td></td><td><button>Submit</button></td></tr>
			</table>
		</form>
	</div>
	Test Result:
	<div id="result">
	</div>
<?php } else if ($curapi == "full_daily_schedule") { ?>
	<h3>Get Full Daily Schedule API</h3>
	Discription:
	<div class="discription">
		<table width="100%">
		<tr><th>Url</th><td>http://www.flightlinkwales.com/api/api.php</td></tr>
		<tr><th>Request</th><td>{"action" : "full_daily_schedule", "data" : {"pin" : "alex", "schedule" : "driver"}}</td></tr>
		<tr><th>Response</th><td>
			<table>
			<tr><td>Success</td><td>{"res" : 200, "msg" : "Success", "contents" : []}</td></tr>
			<tr><td>Dismiss</td><td>{"res" : 311, "msg" : "Not found pin."}</td></tr>
			<tr><td>Dismiss</td><td>{"res" : 301, "msg" : "Require Parameters!!!"}</td></tr>
			</table>
		</td></tr>
		</table>
	</div>
	Test form:
	<div class="testform">
		<form id="apifrm" action="#" onsubmit="return sendgetfulldailyschedulefrm()">
			<table>
			<tr><td>action</td><td><input type=text name="action" value="full_daily_schedule" disabled></td></tr>
			<tr><td>pin</td><td><input type=text name="pin" value="" required></td></tr>
			<tr><td>schedule</td><td>
				<select name="schedule" required>
				<option value="all">all</option>
				</select>
			</td></tr>
			<tr><td></td><td><button>Submit</button></td></tr>
			</table>
		</form>
	</div>
	Test Result:
	<div id="result">
	</div>
<?php } else if ($curapi == "full_daily_schedule_pop_over") { ?>
	<h3>Get Full Daily Schedule Pop Over API</h3>
	Discription:
	<div class="discription">
		<table width="100%">
		<tr><th>Url</th><td>http://www.flightlinkwales.com/api/api.php</td></tr>
		<tr><th>Request</th><td>{"action" : "full_daily_schedule_pop_over", "data" : {"pin" : "alex", "bid" : "123", "direction" : "in", "dep_date" : "2016-02-17"}}</td></tr>
		<tr><th>Response</th><td>
			<table>
			<tr><td>Success</td><td>{"res" : 200, "msg" : "Success", "contents" : {}}</td></tr>
			<tr><td>Dismiss</td><td>{"res" : 311, "msg" : "Not found pin."}</td></tr>
			<tr><td>Dismiss</td><td>{"res" : 301, "msg" : "Require Parameters!!!"}</td></tr>
			</table>
		</td></tr>
		</table>
	</div>
	Test form:
	<div class="testform">
		<form id="apifrm" action="#" onsubmit="return sendgetfulldailyschedulepopoverfrm()">
			<table>
			<tr><td>action</td><td><input type=text name="action" value="full_daily_schedule_pop_over" disabled></td></tr>
			<tr><td>pin</td><td><input type=text name="pin" value="" required></td></tr>
			<tr><td>bid</td><td><input type=text name="bid" value="" required></td></tr>
			<tr><td>direction</td><td>
				<select name="direction" required>
				<option value="in">in</option>
				<option value="out">out</option>
				</select>
			</td></tr>
			<tr><td>dep_date</td><td><input type=text name="dep_date" value="" required placeholder='YYYY-MM-DD'></td></tr>
			<tr><td></td><td><button>Submit</button></td></tr>
			</table>
		</form>
	</div>
	Test Result:
	<div id="result">
	</div>
<?php } else if ($curapi == "get_fuel_type") { ?>
	<h3>Get Fuel Type API</h3>
	Discription:
	<div class="discription">
		<table width="100%">
		<tr><th>Url</th><td>http://www.flightlinkwales.com/api/api.php</td></tr>
		<tr><th>Request</th><td>{"action" : "get_fuel_type", "data" : {"pin" : "alex"}}</td></tr>
		<tr><th>Response</th><td>
			<table>
			<tr><td>Success</td><td>{"res" : 200, "msg" : "Success", "contents" : []}</td></tr>
			<tr><td>Dismiss</td><td>{"res" : 311, "msg" : "Not found pin."}</td></tr>
			<tr><td>Dismiss</td><td>{"res" : 301, "msg" : "Require Parameters!!!"}</td></tr>
			</table>
		</td></tr>
		</table>
	</div>
	Test form:
	<div class="testform">
		<form id="apifrm" action="#" onsubmit="return sendgetfueltypefrm()">
			<table>
			<tr><td>action</td><td><input type=text name="action" value="get_fuel_type" disabled></td></tr>
			<tr><td>pin</td><td><input type=text name="pin" value="" required></td></tr>
			<tr><td></td><td><button>Submit</button></td></tr>
			</table>
		</form>
	</div>
	Test Result:
	<div id="result">
	</div>
<?php } else if ($curapi == "set_refueling") { ?>
	<h3>Set Refueling API</h3>
	Discription:
	<div class="discription">
		<table width="100%">
		<tr><th>Url</th><td>http://www.flightlinkwales.com/api/api.php</td></tr>
		<tr><th>Request</th><td>{"action": "set_refueling", "data" : {"pin" : "alex", "vehicle_id" : "123", "fdate" : "2016-02-17", "ftime" : "12:34", "famount" : "12.34", "flitres" : "12", "ftype" : "FuelGenie", "mileage" : "12345"}}</td></tr>
		<tr><th>Response</th><td>
			<table>
			<tr><td>Success</td><td>{"res" : 200, "msg" : "Success"}</td></tr>
			<tr><td>Dismiss</td><td>{"res" : 311, "msg" : "Not found pin."}</td></tr>
			<tr><td>Dismiss</td><td>{"res" : 301, "msg" : "Require Parameters!!!"}</td></tr>
			</table>
		</td></tr>
		</table>
	</div>
	Test form:
	<div class="testform">
		<form id="apifrm" action="#" onsubmit="return sendsetrefuelingfrm()">
			<table>
			<tr><td>action</td><td><input type=text name="action" value="set_refueling" disabled></td></tr>
			<tr><td>pin</td><td><input type=text name="pin" value="" required></td></tr>
			<tr><td>date</td><td><input type=text name="fdate" value="" required placeholder="YYYY-MM-DD"></td></tr>
			<tr><td>time</td><td><input type=text name="ftime" value="" required placeholder="hh:mm"></td></tr>
			<tr><td>type</td><td>
				<select id="ftype_select" name="ftype" required>
				</select>
			</td></tr>
			<tr><td>amount</td><td><input type=text name="famount" value="" required></td></tr>
			<tr><td>litres</td><td><input type=text name="flitres" value="" required></td></tr>
			<tr><td>vehicle</td><td>
				<select id="vehicle_select" name="vehicle_id" required>
				</select>
			</td></tr>
			<tr><td>mileage</td><td><input type=text name="mileage" value="" required></td></tr>
			<tr><td></td><td><button>Submit</button></td></tr>
			</table>
		</form>
	</div>
	Test Result:
	<div id="result">
	</div>
	<script>
	$(document).ready(function(){
		get_fuel_type();
		get_vehicles();
	});
	</script>
<?php } else if ($curapi == "get_place") { ?>
	<h3>Get Place API</h3>
	Discription:
	<div class="discription">
		<table width="100%">
		<tr><th>Url</th><td>http://www.flightlinkwales.com/api/api.php</td></tr>
		<tr><th>Request</th><td>{"action" : "get_place", "data" : {"pin" : "alex"}}</td></tr>
		<tr><th>Response</th><td>
			<table>
			<tr><td>Success</td><td>{"res" : 200, "msg" : "Success", "contents" : []}</td></tr>
			<tr><td>Dismiss</td><td>{"res" : 311, "msg" : "Not found pin."}</td></tr>
			<tr><td>Dismiss</td><td>{"res" : 301, "msg" : "Require Parameters!!!"}</td></tr>
			</table>
		</td></tr>
		</table>
	</div>
	Test form:
	<div class="testform">
		<form id="apifrm" action="#" onsubmit="return sendgetplacefrm()">
			<table>
			<tr><td>action</td><td><input type=text name="action" value="get_place" disabled></td></tr>
			<tr><td>pin</td><td><input type=text name="pin" value="" required></td></tr>
			<tr><td></td><td><button>Submit</button></td></tr>
			</table>
		</form>
	</div>
	Test Result:
	<div id="result">
	</div>
<?php } else if ($curapi == "set_parking") { ?>
	<h3>Set Parking API</h3>
	Discription:
	<div class="discription">
		<table width="100%">
		<tr><th>Url</th><td>http://www.flightlinkwales.com/api/api.php</td></tr>
		<tr><th>Request</th><td>{"action": "set_parking", "data" : {"pin" : "alex", "pdate" : "2016-02-17", "ptime" : "12:34", "pamount" : "12.34", "pplace" : "Bristol Airport"}}</td></tr>
		<tr><th>Response</th><td>
			<table>
			<tr><td>Success</td><td>{"res" : 200, "msg" : "Success"}</td></tr>
			<tr><td>Dismiss</td><td>{"res" : 311, "msg" : "Not found pin."}</td></tr>
			<tr><td>Dismiss</td><td>{"res" : 301, "msg" : "Require Parameters!!!"}</td></tr>
			</table>
		</td></tr>
		</table>
	</div>
	Test form:
	<div class="testform">
		<form id="apifrm" action="#" onsubmit="return sendsetparkingfrm()">
			<table>
			<tr><td>action</td><td><input type=text name="action" value="set_parking" disabled></td></tr>
			<tr><td>pin</td><td><input type=text name="pin" value="" required></td></tr>
			<tr><td>date</td><td><input type=text name="pdate" value="" required placeholder="YYYY-MM-DD"></td></tr>
			<tr><td>time</td><td><input type=text name="ptime" value="" required placeholder="hh:mm"></td></tr>
			<tr><td>amount</td><td><input type=text name="pamount" value="" required></td></tr>
			<tr><td>place</td><td>
				<select id="place_select" name="pplace" required>
				</select>
			</td></tr>
			<tr><td></td><td><button>Submit</button></td></tr>
			</table>
		</form>
	</div>
	Test Result:
	<div id="result">
	</div>
	<script>
	$(document).ready(function(){
		get_place();
	});
	</script>
<?php } else if ($curapi == "get_invoices") { ?>
	<h3>Get Invoices API</h3>
	Discription:
	<div class="discription">
		<table width="100%">
		<tr><th>Url</th><td>http://www.flightlinkwales.com/api/api.php</td></tr>
		<tr><th>Request</th><td>{"action" : "get_invoices", "data" : {"pin" : "alex", "month" : "MM", "year" : "YYYY"}}</td></tr>
		<tr><th>Response</th><td>
			<table>
			<tr><td>Success</td><td>{"res" : 200, "msg" : "Success", "contents" : []}</td></tr>
			<tr><td>Dismiss</td><td>{"res" : 311, "msg" : "Not found pin."}</td></tr>
			<tr><td>Dismiss</td><td>{"res" : 301, "msg" : "Require Parameters!!!"}</td></tr>
			</table>
		</td></tr>
		</table>
	</div>
	Test form:
	<div class="testform">
		<form id="apifrm" action="#" onsubmit="return sendgetinvoicesfrm()">
			<table>
			<tr><td>action</td><td><input type=text name="action" value="get_invoices" disabled></td></tr>
			<tr><td>pin</td><td><input type=text name="pin" value="" required></td></tr>
			<tr><td>month</td><td><input type=text name="month" value=""></td></tr>
			<tr><td>year</td><td><input type=text name="year" value=""></td></tr>
			<tr><td></td><td><button>Submit</button></td></tr>
			</table>
		</form>
	</div>
	Test Result:
	<div id="result">
	</div>
<?php } else if ($curapi == "set_unavailability") { ?>
	<h3>Set Unavailability API</h3>
	Discription:
	<div class="discription">
		<table width="100%">
		<tr><th>Url</th><td>http://www.flightlinkwales.com/api/api.php</td></tr>
		<tr><th>Request</th><td>{"action": "set_unavailability", "data" : {"pin" : "alex", "fromdate" : "2016-02-17", "fromtime" : "12:34", "todate" : "2016-02-17", "totime" : "23:45"}}</td></tr>
		<tr><th>Response</th><td>
			<table>
			<tr><td>Success</td><td>{"res" : 200, "msg" : "Success"}</td></tr>
			<tr><td>Dismiss</td><td>{"res" : 311, "msg" : "Not found pin."}</td></tr>
			<tr><td>Dismiss</td><td>{"res" : 312, "msg" : "Datetime setting error."}</td></tr>
			<tr><td>Dismiss</td><td>{"res" : 301, "msg" : "Require Parameters!!!"}</td></tr>
			</table>
		</td></tr>
		</table>
	</div>
	Test form:
	<div class="testform">
		<form id="apifrm" action="#" onsubmit="return sendsetunavailabilityfrm()">
			<table>
			<tr><td>action</td><td><input type=text name="action" value="set_unavailability" disabled></td></tr>
			<tr><td>pin</td><td><input type=text name="pin" value="" required></td></tr>
			<tr><td>From date</td><td><input type=text name="fromdate" value="" required placeholder="YYYY-MM-DD"></td></tr>
			<tr><td>From time</td><td><input type=text name="fromtime" value="" required placeholder="hh:mm"></td></tr>
			<tr><td>To date</td><td><input type=text name="todate" value="" required placeholder="YYYY-MM-DD"></td></tr>
			<tr><td>To time</td><td><input type=text name="totime" value="" required placeholder="hh:mm"></td></tr>
			<tr><td></td><td><button>Submit</button></td></tr>
			</table>
		</form>
	</div>
	Test Result:
	<div id="result">
	</div>
<?php } else if ($curapi == "set_airportlog") {?>
	<h3>Set Airport Log API</h3>
	Discription:
	<div class="discription">
		<table width="100%">
		<tr><th>Url</th><td>http://www.flightlinkwales.com/api/api.php</td></tr>
		<tr><th>Request</th><td>{"action" : "set_airportlog", "data" : {"pin" : "alex", "vehicle_id":"VEHICLE_ID", "lat":"65.234", "lng":"34.7345"}}</td></tr>
		<tr><th>Response</th><td>
			<table>
			<tr><td>Success</td><td>{"res" : 200, "msg" : "Success"}</td></tr>
			<tr><td>Dismiss</td><td>{"res" : 311, "msg" : "Not found pin."}</td></tr>
			</table>
		</td></tr>
		</table>
	</div>
	Test form:
	<div class="testform">
		<form id="apifrm" action="#" onsubmit="return sendsetairportlogfrm()">
			<table>
			<tr><td>action</td><td><input type=text name="action" value="set_airportlog" disabled></td></tr>
			<tr><td>pin</td><td><input type=text name="pin" value="" required></td></tr>
			<tr><td>vehicle</td><td>
				<select id="vehicle_select" name="vehicle_id" required>
				</select>
			</td></tr>
			<tr><td>Lat</td><td><input type=text name="lat" value="" required></td></tr>
			<tr><td>Lng</td><td><input type=text name="lng" value="" required></td></tr>
			<tr><td></td><td><button>Submit</button></td></tr>
			</table>
		</form>
	</div>
	Test Result:
	<div id="result">
	</div>
	<script>
	$(document).ready(function(){
		get_vehicles();
	});
	</script>
<?php } else if ($curapi == "get_upcomingjourneys") {?>
	<h3>Get Upcoming Journeys API</h3>
	Discription:
	<div class="discription">
		<table width="100%">
		<tr><th>Url</th><td>http://www.flightlinkwales.com/api/api.php</td></tr>
		<tr><th>Request</th><td>{"action" : "get_upcomingjourneys", "data" : {"pin" : "alex"}}</td></tr>
		<tr><th>Response</th><td>
			<table>
			<tr><td>Success</td><td>{"res" : 200, "msg" : "Success", "contents":[]}</td></tr>
			<tr><td>Dismiss</td><td>{"res" : 311, "msg" : "Not found pin."}</td></tr>
			</table>
		</td></tr>
		</table>
	</div>
	Test form:
	<div class="testform">
		<form id="apifrm" action="#" onsubmit="return sendgetupcomingjourneysfrm()">
			<table>
			<tr><td>action</td><td><input type=text name="action" value="get_upcomingjourneys" disabled></td></tr>
			<tr><td>pin</td><td><input type=text name="pin" value="" required></td></tr>
			<tr><td></td><td><button>Submit</button></td></tr>
			</table>
		</form>
	</div>
	Test Result:
	<div id="result">
	</div>
<?php } else if ($curapi == "set_upcomingjourney") {?>
	<h3>Set Upcoming Journey API</h3>
	Discription:
	<div class="discription">
		<table width="100%">
		<tr><th>Url</th><td>http://www.flightlinkwales.com/api/api.php</td></tr>
		<tr><th>Request</th><td>{"action" : "set_upcomingjourney", "data" : {"pin" : "alex", "bid" : "123", "direction" : "in/out", "date" : "YYYY-MM-DD", "time" : "HH:MM", "accept" : "yes/no"}}</td></tr>
		<tr><th>Response</th><td>
			<table>
			<tr><td>Success</td><td>{"res" : 200, "msg" : "Success"}</td></tr>
			<tr><td>Dismiss</td><td>{"res" : 311, "msg" : "Not found pin."}</td></tr>
			</table>
		</td></tr>
		</table>
	</div>
	Test form:
	<div class="testform">
		<form id="apifrm" action="#" onsubmit="return sendsetupcomingjourneyfrm()">
			<table>
			<tr><td>action</td><td><input type=text name="action" value="set_upcomingjourney" disabled></td></tr>
			<tr><td>pin</td><td><input type=text name="pin" value="" required></td></tr>
			<tr><td>bid</td><td><input type=text name="bid" value="" required></td></tr>
			<tr><td>direction</td><td>
				<select name="direction" required>
				<option value="in">in</option>
				<option value="out">out</option>
				</select>
			</td></tr>
			<tr><td>date</td><td><input type=text name="date" value="" required placeholder="YYYY-MM-DD"></td></tr>
			<tr><td>time</td><td><input type=text name="time" value="" required placeholder="hh:mm"></td></tr>
			<tr><td>accept</td><td>
				<select name="accept" required>
				<option value="yes">yes</option>
				<option value="no">no</option>
				</select>
			</td></tr>
			<tr><td></td><td><button>Submit</button></td></tr>
			</table>
		</form>
	</div>
	Test Result:
	<div id="result">
	</div>
<?php } else if ($curapi == "set_invoice") {?>
	<h3>Set Invoice API</h3>
	Discription:
	<div class="discription">
		<table width="100%">
		<tr><th>Url</th><td>http://www.flightlinkwales.com/api/api.php</td></tr>
		<tr><th>Request</th><td>{"action" : "set_invoice", "data" : {"pin" : "alex", "month" : "02", "year" : "2016"}}</td></tr>
		<tr><th>Response</th><td>
			<table>
			<tr><td>Success</td><td>{"res" : 200, "msg" : "Success"}</td></tr>
			<tr><td>Dismiss</td><td>{"res" : 311, "msg" : "Not found pin."}</td></tr>
			</table>
		</td></tr>
		</table>
	</div>
	Test form:
	<div class="testform">
		<form id="apifrm" action="#" onsubmit="return sendsetinvoicefrm()">
			<table>
			<tr><td>action</td><td><input type=text name="action" value="set_invoice" disabled></td></tr>
			<tr><td>pin</td><td><input type=text name="pin" value="" required></td></tr>
			<tr><td>month</td><td><input type=text name="month" value="" placeholder="MM" required></td></tr>
			<tr><td>year</td><td><input type=text name="year" value="" placeholder="YYYY" required></td></tr>
			<tr><td></td><td><button>Submit</button></td></tr>
			</table>
		</form>
	</div>
	Test Result:
	<div id="result">
	</div>
<?php } ?>