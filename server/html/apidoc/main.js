﻿var url = "http://192.168.3.207/api/api.php";
function sendsignupfrm()
{
	var frm = document.getElementById('apifrm');
	$.ajax({
		type: 'POST',
		url: url,
		data: {"action": "signup", "data":{"firstname": frm.firstname.value, "lastname": frm.lastname.value, "email": frm.email.value, "radius": frm.radius.value, "mobile": frm.mobile.value}},
		success: function(data){
			document.getElementById("result").innerHTML = data;
		},
		error: function()
		{
			alert("Error");
		},
		dataType: "text"
	});
	
	return false;
}
function sendloginfrm()
{
	var frm = document.getElementById('apifrm');
	$.ajax({
		type: 'POST',
		url: url,
		data: {"action": "login", "data":{"firstname": frm.firstname.value, "lastname": frm.lastname.value, "email": frm.email.value, "radius": frm.radius.value, "mobile": frm.mobile.value}},
		success: function(data){
			document.getElementById("result").innerHTML = data;
		},
		error: function()
		{
			alert("Error");
		},
		dataType: "text"
	});
	
	return false;
}
function sendget_userlistfrm()
{
	var frm = document.getElementById('apifrm');
	$.ajax({
		type: 'POST',
		url: url,
		data: {"action": "get_userlist", "data":{"id": frm.id.value, "hash": frm.hash.value}},
		success: function(data){
			document.getElementById("result").innerHTML = data;
		},
		error: function()
		{
			alert("Error");
		},
		dataType: "text"
	});
	
	return false;
}
function sendlogoutfrm()
{
	var frm = document.getElementById('apifrm');
	$.ajax({
		type: 'POST',
		url: url,
		data: {"action": "logout", "data":{"pin": frm.pin.value}},
		success: function(data){
			document.getElementById("result").innerHTML = data;
		},
		error: function()
		{
			alert("Error");
		},
		dataType: "text"
	});
	
	return false;
}
function sendgetvehiclesfrm()
{
	var frm = document.getElementById('apifrm');
	$.ajax({
		type: 'POST',
		url: url,
		data: {"action": "get_vehicles", "data":{"pin": frm.pin.value}},
		success: function(data){
			document.getElementById("result").innerHTML = data;
		},
		error: function()
		{
			alert("Error");
		},
		dataType: "text"
	});
	
	return false;
}
function sendairportstatefrm()
{
	var frm = document.getElementById('apifrm');
	$.ajax({
		type: 'POST',
		url: url ,
		data: {"action": "set_airportstate", "data":{"pin": frm.pin.value,"date": frm.date.value,"time": frm.time.value, "lat": frm.lat.value, "lng": frm.lng.value}},
		success: function(data){
			document.getElementById("result").innerHTML = data;
		},
		error: function()
		{
			alert("Error");
		},
		dataType: "text"
	});
	
	return false;
}
function senddriverstatefrm()
{
	var frm = document.getElementById('apifrm');
	$.ajax({
		type: 'POST',
		url: url ,
		data: {"action": "set_driverstate", "data":{"pin": frm.pin.value, "vehicle_id": frm.vehicle_id.value, "dstate": frm.dstate.value}},
		success: function(data){
			document.getElementById("result").innerHTML = data;
		},
		error: function()
		{
			alert("Error");
		},
		dataType: "text"
	});
	
	return false;
}
function sendactivestatefrm()
{
	var frm = document.getElementById('apifrm');
	$.ajax({
		type: 'POST',
		url: url ,
		data: {"action": "set_activestate", "data":{"pin": frm.pin.value,"active": frm.active.value}},
		success: function(data){
			document.getElementById("result").innerHTML = data;
		},
		error: function()
		{
			alert("Error");
		},
		dataType: "text"
	});
	
	return false;
}
function sendsetGPSlocationfrm()
{
	var frm = document.getElementById('apifrm');
	$.ajax({
		type: 'POST',
		url: url ,
		data: {"action": "set_GPSlocation", "data":{"pin": frm.pin.value, "vehicle_id": frm.vehicle_id.value, "lat": frm.lat.value, "lng": frm.lng.value}},
		success: function(data){
			document.getElementById("result").innerHTML = data;
		},
		error: function()
		{
			alert("Error");
		},
		dataType: "text"
	});
	
	return false;
}
function sendsetairportlogfrm()
{
	var frm = document.getElementById('apifrm');
	$.ajax({
		type: 'POST',
		url: url ,
		data: {"action": "set_airportlog", "data":{"pin": frm.pin.value, "vehicle_id": frm.vehicle_id.value, "lat": frm.lat.value, "lng": frm.lng.value}},
		success: function(data){
			document.getElementById("result").innerHTML = data;
		},
		error: function()
		{
			alert("Error");
		},
		dataType: "text"
	});
	
	return false;
}
function get_vehicles()
{
	$.ajax({
		type: 'POST',
		url: url,
		data: {"action" : "get_vehicles", "data" : {"pin" : "alex"}},
		success: function(data)
		{
			var vehicles = data.contents;
			var html = "";
			for(var i = 0; i < vehicles.length; i++)
			{
				html += "<option value='" + vehicles[i].vehicle_id + "'>" + vehicles[i].registration_number + "</option>";
			}
			document.getElementById('vehicle_select').innerHTML = html;
		},
		error: function()
		{
			alert("Error");
		},
		dataType: "json"
	});
}
function sendsetstartshiftfrm()
{
	var frm = document.getElementById('apifrm');
	var report_text = "";
	var defects = [];
	var alldefects = ["Fuel/Oil/Waste leaks", "Wipers", "Mirrors", "Battery (if accessible)", "Washers", "Steering", "Tyres and wheel fixing", "Horn", "Heating/Ventilation", "Brakes", "Glass", "Lights", "Doors and exits", "Reflectors", "Body Interior", "Indicators", "Body Exterior", "Excessive engine exhaust smoke", "Fire extinguisher", "First aid kit"];
	for (var i = 0; i < alldefects.length; i++)
	{
		var defect = {};
		if (!document.getElementById("defects_" + alldefects[i]).checked)
		{
			defect[alldefects[i]] = "no";
			defects.push(defect);
			report_text += document.getElementById("report_text_" + alldefects[i]).value + "<br>";
		} else {
			defect[alldefects[i]] = "yes";
		}
	}
	$.ajax({
		type: 'POST',
		url: url,
		data: {"action": "set_start_shift", "data":{"pin": frm.pin.value, "vehicle_id" : frm.vehicle_id.value, "mileage" : frm.mileage.value, "lat" : frm.lat.value, "lng" : frm.lng.value, "report_text" : report_text, "defects" : defects}},
		success: function(data){
			document.getElementById("result").innerHTML = data;
		},
		error: function()
		{
			alert("Error");
		},
		dataType: "text"
	});
	
	return false;
}
function sendsetendshiftfrm()
{
	var frm = document.getElementById('apifrm');
	var report_text = "";
	var defects = [];
	var alldefects = ["Fuel/Oil/Waste leaks", "Wipers", "Mirrors", "Battery (if accessible)", "Washers", "Steering", "Tyres and wheel fixing", "Horn", "Heating/Ventilation", "Brakes", "Glass", "Lights", "Doors and exits", "Reflectors", "Body Interior", "Indicators", "Body Exterior", "Excessive engine exhaust smoke", "Fire extinguisher", "First aid kit"];
	for (var i = 0; i < alldefects.length; i++)
	{
		var defect = {};
		if (!document.getElementById("defects_" + alldefects[i]).checked)
		{
			defect[alldefects[i]] = "no";
			defects.push(defect);
			report_text += document.getElementById("report_text_" + alldefects[i]).value + "<br>";
		} else {
			defect[alldefects[i]] = "yes";
		}
	}
	$.ajax({
		type: 'POST',
		url: url,
		data: {"action": "set_end_shift", "data":{"pin": frm.pin.value, "vehicle_id" : frm.vehicle_id.value, "mileage" : frm.mileage.value, "lat" : frm.lat.value, "lng" : frm.lng.value, "report_text" : report_text, "defects" : defects}},
		success: function(data){
			document.getElementById("result").innerHTML = data;
		},
		error: function()
		{
			alert("Error");
		},
		dataType: "text"
	});
	
	return false;
}
function sendgetmydailyschedulefrm()
{
	var frm = document.getElementById('apifrm');
	$.ajax({
		type: 'POST',
		url: url,
		data: {"action": "my_daily_schedule", "data":{"pin": frm.pin.value, "schedule" : frm.schedule.value}},
		success: function(data){
			document.getElementById("result").innerHTML = data;
		},
		error: function()
		{
			alert("Error");
		},
		dataType: "text"
	});
	
	return false;
}
function sendgetmydailyschedulepopoverfrm()
{
	var frm = document.getElementById('apifrm');
	$.ajax({
		type: 'POST',
		url: url,
		data: {"action": "my_daily_schedule_pop_over", "data":{"pin": frm.pin.value, "bid" : frm.bid.value, "direction" : frm.direction.value, "dep_date" : frm.dep_date.value}},
		success: function(data){
			document.getElementById("result").innerHTML = data;
		},
		error: function()
		{
			alert("Error");
		},
		dataType: "text"
	});
	
	return false;
}
function sendgetfulldailyschedulefrm()
{
	var frm = document.getElementById('apifrm');
	$.ajax({
		type: 'POST',
		url: url,
		data: {"action": "full_daily_schedule", "data":{"pin": frm.pin.value, "schedule" : frm.schedule.value}},
		success: function(data){
			document.getElementById("result").innerHTML = data;
		},
		error: function()
		{
			alert("Error");
		},
		dataType: "text"
	});
	
	return false;
}
function sendgetfulldailyschedulepopoverfrm()
{
	var frm = document.getElementById('apifrm');
	$.ajax({
		type: 'POST',
		url: url,
		data: {"action": "full_daily_schedule_pop_over", "data":{"pin": frm.pin.value, "bid" : frm.bid.value, "direction" : frm.direction.value, "dep_date" : frm.dep_date.value}},
		success: function(data){
			document.getElementById("result").innerHTML = data;
		},
		error: function()
		{
			alert("Error");
		},
		dataType: "text"
	});
	
	return false;
}
function sendgetfueltypefrm()
{
	var frm = document.getElementById('apifrm');
	$.ajax({
		type: 'POST',
		url: url,
		data: {"action": "get_fuel_type", "data":{"pin": frm.pin.value}},
		success: function(data){
			document.getElementById("result").innerHTML = data;
		},
		error: function()
		{
			alert("Error");
		},
		dataType: "text"
	});
	
	return false;
}
function get_fuel_type()
{
	$.ajax({
		type: 'POST',
		url: url,
		data: {"action" : "get_fuel_type", "data" : {"pin" : "alex"}},
		success: function(data)
		{
			var fueltypes = data.contents;
			var html = "";
			for(var i = 0; i < fueltypes.length; i++)
			{
				html += "<option value='" + fueltypes[i] + "'>" + fueltypes[i] + "</option>";
			}
			document.getElementById('ftype_select').innerHTML = html;
		},
		error: function()
		{
			alert("Error");
		},
		dataType: "json"
	});
}
function sendsetrefuelingfrm()
{
	var frm = document.getElementById('apifrm');
	$.ajax({
		type: 'POST',
		url: url,
		data: {"action": "set_refueling", "data":{"pin": frm.pin.value, "fdate": frm.fdate.value, "ftime": frm.ftime.value, "ftype": frm.ftype.value, "famount": frm.famount.value, "flitres": frm.flitres.value, "vehicle_id": frm.vehicle_id.value, "mileage": frm.mileage.value}},
		success: function(data){
			document.getElementById("result").innerHTML = data;
		},
		error: function()
		{
			alert("Error");
		},
		dataType: "text"
	});
	
	return false;
}
function sendgetplacefrm()
{
	var frm = document.getElementById('apifrm');
	$.ajax({
		type: 'POST',
		url: url,
		data: {"action": "get_place", "data":{"pin": frm.pin.value}},
		success: function(data){
			document.getElementById("result").innerHTML = data;
		},
		error: function()
		{
			alert("Error");
		},
		dataType: "text"
	});
	
	return false;
}
function get_place()
{
	$.ajax({
		type: 'POST',
		url: url,
		data: {"action" : "get_place", "data" : {"pin" : "alex"}},
		success: function(data)
		{
			var places = data.contents;
			var html = "";
			for(var i = 0; i < places.length; i++)
			{
				html += "<option value='" + places[i] + "'>" + places[i] + "</option>";
			}
			document.getElementById('place_select').innerHTML = html;
		},
		error: function()
		{
			alert("Error");
		},
		dataType: "json"
	});
}
function sendsetparkingfrm()
{
	var frm = document.getElementById('apifrm');
	$.ajax({
		type: 'POST',
		url: url,
		data: {"action": "set_parking", "data":{"pin": frm.pin.value, "pdate": frm.pdate.value, "ptime": frm.ptime.value, "pamount": frm.pamount.value, "pplace": frm.pplace.value}},
		success: function(data){
			document.getElementById("result").innerHTML = data;
		},
		error: function()
		{
			alert("Error");
		},
		dataType: "text"
	});
	
	return false;
}
function sendgetinvoicesfrm()
{
	var frm = document.getElementById('apifrm');
	$.ajax({
		type: 'POST',
		url: url,
		data: {"action": "get_invoices", "data":{"pin": frm.pin.value, "month": frm.month.value, "year": frm.year.value}},
		success: function(data){
			document.getElementById("result").innerHTML = data;
		},
		error: function()
		{
			alert("Error");
		},
		dataType: "text"
	});
	
	return false;
}
function sendsetunavailabilityfrm()
{
	var frm = document.getElementById('apifrm');
	$.ajax({
		type: 'POST',
		url: url,
		data: {"action": "set_unavailability", "data":{"pin": frm.pin.value, "fromdate": frm.fromdate.value, "fromtime": frm.fromtime.value, "todate": frm.todate.value, "totime": frm.totime.value}},
		success: function(data){
			document.getElementById("result").innerHTML = data;
		},
		error: function()
		{
			alert("Error");
		},
		dataType: "text"
	});
	
	return false;
}
function sendgetupcomingjourneysfrm()
{
	var frm = document.getElementById('apifrm');
	$.ajax({
		type: 'POST',
		url: url,
		data: {"action": "get_upcomingjourneys", "data":{"pin": frm.pin.value}},
		success: function(data){
			document.getElementById("result").innerHTML = data;
		},
		error: function()
		{
			alert("Error");
		},
		dataType: "text"
	});
	
	return false;
}
function sendsetupcomingjourneyfrm()
{
	var frm = document.getElementById('apifrm');
	$.ajax({
		type: 'POST',
		url: url,
		data: {"action": "set_upcomingjourney", "data":{"pin": frm.pin.value, "bid": frm.bid.value, "direction": frm.direction.value, "date": frm.date.value, "time": frm.time.value, "accept": frm.accept.value}},
		success: function(data){
			document.getElementById("result").innerHTML = data;
		},
		error: function()
		{
			alert("Error");
		},
		dataType: "text"
	});
	
	return false;
}
function sendsetinvoicefrm()
{
	var frm = document.getElementById('apifrm');
	$.ajax({
		type: 'POST',
		url: url,
		data: {"action": "set_invoice", "data":{"pin": frm.pin.value, "year": frm.year.value, "month": frm.month.value}},
		success: function(data){
			document.getElementById("result").innerHTML = data;
		},
		error: function()
		{
			alert("Error");
		},
		dataType: "text"
	});
	
	return false;
}
