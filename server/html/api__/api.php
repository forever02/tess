<?php
if (!session_id()) session_start();
include("functions.php");

$action = isset($_REQUEST['action']) ? $_REQUEST['action'] : "";
$data = isset($_REQUEST['data']) ? $_REQUEST['data'] : "";

if (trim($action) == "")
	die(json_encode(array("res" => 301, "msg" => "Require Action!!!")));

if (is_file("$action.php"))
{
	if (is_object($data))
		$data = get_object_vars($data);
	else if (!is_array($data))
		$data = json_clean_decode(str_replace("\\", '', $data));

debug(__LINE__);
	include("db.php");
debug(__LINE__);
	include("$action.php");
debug(__LINE__);
}

echo json_encode($res);
?>
