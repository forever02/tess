<?php
$host = "localhost";
$user = "root";
$pass = "";
$dbname = "apitest_db";

debug(__LINE__);
$conn = @mysql_connect($host, $user, $pass);

debug(__LINE__);
if (!$conn) {
    echo "Unable to connect to DB: " . mysql_error();
    exit;
}

debug(__LINE__);
if (!mysql_select_db($dbname, $conn)) {
    echo "Unable to select '$dbname': " . mysql_error();
    exit;
}

debug(__LINE__);
function sql($sql, $opt = "set")
{
	global $conn;
	global $dbname;
	mysql_select_db($dbname, $conn);
	$res = array();
	if ($opt == "set")
	{
		mysql_query($sql, $conn);
	} else if ($opt == "get") {
		$result = mysql_query($sql, $conn);
		if ($result)
		{
			while ($row = mysql_fetch_assoc($result)) {
				$res[] = $row;
			}
			mysql_free_result($result);
		}
	}
	
	return $res;
}

function sql_get($sql)
{
	return sql($sql, "get");
}

function sql_row($sql)
{
	$res = sql($sql, "get");
	return count($res) > 0 ? $res[0] : array();
}
function get_all($sql)
{
	return sql_get($sql);
}
function get_one($sql)
{
	return sql_row($sql);
}
?>
