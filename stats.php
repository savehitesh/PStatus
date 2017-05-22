<?PHP
include "config.inc.php";
$db_handle = mysqli_connect($DBServer, $DBUser, $DBPassword);
$db_found = mysqli_select_db($db_handle, 'status');
if ($db_found) 
{
$SQL = "select * from servers"	;
$result = mysqli_query($db_handle, $SQL);
while ($db_field = mysqli_fetch_assoc($result))
{
	$device = $db_field['device'];
	$count = $db_field['count'];
	$ups = $db_field['ups'];
	$downs = $db_field['downs'];
  	$lastup = $db_field['lastup'];
  	$lastdown = $db_field['lastdown'];
	$value = $ups / $count;
	$value = $value * 100;
	$max = "100";
	
 }
}
 ?>
<html>
<head>
<title>
PStatus Statistics
</title>
</head>
<body>
<script src="raphael-2.1.4.min.js"></script>
<script src="justgage.js"></script>
<div id="gauge" class="200x160px"></div>
<script>
  var g = new JustGage({
    id: "gauge",
    value: <?PHP echo $value; ?>,
    min: 0,
    max: <?PHP echo $max; ?>,
    title: "<?PHP echo $device; ?>",
	  customSectors: {
        percents: true,
        ranges: [{
          color : "#ff3b30",
          lo : 0,
          hi : 50
        },{
          color : "#00ff00",
          lo : 51,
          hi : 100
        }]
      },
      });
</script>