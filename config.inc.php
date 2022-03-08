<?PHP

// Master Config Data
$company_name = "Compuage Infocom Limited";
$company_website = "https://www.compuageindia.com/";
// Asia/Kolkata is for INDIA
date_default_timezone_set('Asia/Kolkata');
/* MYSQL Configuration */
$DBServer	= 	'localhost';
$DBName     = 	'status';
$DBUser		= 	'root';
$DBPassword     = 	'hitesh@123';

$db_handle = mysqli_connect($DBServer, $DBUser, $DBPassword);
$db_found = mysqli_select_db($db_handle, $DBName);
if ($db_found) 
{
$config_sql = "select * from config where id = 1"	;
$config_result = mysqli_query($db_handle, $config_sql);
while ($db_field = mysqli_fetch_assoc($config_result))
{
/* Display Smart Devices */
$enable_smart = $db_field['enablesmart'];
/* Default refresh rate for index page */
$refresh = $db_field['refresh'];
/* SMTP Details for admin emails */
$smtp = $db_field['smtp'];
$smtp_port = $db_field['smtp_port'];
$smtp_username = $db_field['smtp_username'];
$smtp_password = $db_field['smtp_password'];
$admin_email = $db_field['admin_email'];
 /* Email Alert Down Limit */
$alert_limit = $db_field['alert_limit'];
$row_count = $db_field['rowcount'];
}
}

?>
