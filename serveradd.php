<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- <meta http-equiv="refresh" content="<?PHP
// echo $refresh;
?>"> -->
    <title>PStatus</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  <style>
  .progress {
    margin-bottom: 0 !important;
    background-color: #DA2A2A;
    -webkit-box-shadow: none;
    box-shadow: none;
}

</style>
    </head>

  <body>

    <?PHP
include "navbar.php";
?>


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script type="text/javascript">

$(document).ready(function(){
    $("#status td.on_off:contains('offline')").css('background-color','#E05667');
    $("#status td.on_off:contains('online')").css('background-color','#56E08E');
});

</script>
<center>
<div class="container">
<?PHP
include "config.inc.php";
$updateresult = "";
$updateresult2 = "";
$db_handle = mysqli_connect($DBServer, $DBUser, $DBPassword);
$db_found  = mysqli_select_db($db_handle, $DBName);
if (isset($_POST['addserver'])) {
    $device  = mysqli_real_escape_string($db_handle,$_POST['device']);
    $ip      = mysqli_real_escape_string($db_handle,$_POST['ip']);
    $type    = mysqli_real_escape_string($db_handle,$_POST['type']);
    $info    = mysqli_real_escape_string($db_handle,$_POST['info']);
    $purpose = mysqli_real_escape_string($db_handle,$_POST['purpose']);
    $sql     = "INSERT INTO servers (device, ip, type, info, purpose, count) VALUES ('$device', '$ip', '$type', '$info', '$purpose', '0')";
   
    if (mysqli_query($db_handle, $sql)) {
        $updateresult = "New record created successfully";
    } else {
        $updateresult = "Error: " . $sql . "<br>" . mysqli_error($db_handle);
    }
}

if (isset($_POST['addservice'])) {
    $name   = mysqli_real_escape_string($db_handle,$_POST['name']);
    $port   = mysqli_real_escape_string($db_handle,$_POST['port']);
    $parent = mysqli_real_escape_string($db_handle,$_POST['parent']);
    $sql    = "INSERT INTO services (name, port, parent) VALUES ('$name', '$port', '$parent')";

    if (mysqli_query($db_handle, $sql)) {
        $updateresult2 = "New record created successfully";
    } else {
        $updateresult2 = "Error: " . $sql . "<br>" . mysqli_error($db_handle);
    }
}

?>

 <!-- ADD SERVER FORM -->
<form method="POST" action="serveradd.php">
<input type="hidden" value="addserver" name="addserver">
<table class="table" cellpadding="4" cellspacing="4" border="1">
<thead>
<tr><th colspan="5"><center><img src="icons/005-computer-screen.png">&nbsp;Add Server</th></tr>
</thead>
  <tr><td>Name</td><td>IP Address</td><td>Type</td><td>Info</td><td>Purpose</td></tr>
<tr><td><input type="text" size="20" name="device"></td><td><input type="text" size="20" name="ip"></td><td><input type="text" size="20" name="type"></td><td><input type="text" size="20" name="info"></td><td><input type="text" size="20" name="purpose"></td></tr>
<tr><td colspan="5"><center><input type="submit" value="submit" class="btn btn-success"></td></tr>
<tr><td colspan="5"><center><?PHP
echo $updateresult;
?></td></tr>
</table>
  </form>
<br>
<!-- ADD SERVICE FORM -->
<form method="POST" action="serveradd.php">
<input type="hidden" value="addservice" name="addservice">
<table class="table" cellpadding="3" cellspacing="4" border="1">
<thead>
<tr><th colspan="4"><center><img src="icons/001-window.png">&nbsp;Add Service</th></tr>
</thead>
  <tr><td>Name</td><td>Port</td><td>Parent</td></tr>
<tr><td><input type="text" size="20" name="name"></td><td><input type="text" size="20" name="port"></td><td>
<select name="parent">

<?PHP
$SQL    = "select * from servers";
$serverresult = mysqli_query($db_handle, $SQL);
while ($db_field = mysqli_fetch_assoc($serverresult)) {
    $parentid   = $db_field['id'];
    $parentname = $db_field['device'];
    $number_servers = mysqli_num_rows($serverresult);
    echo "<option value='" . $parentid . "'>" . $parentname . "</option>";
}
?>
 
</td></tr>
<tr><td colspan="4"><center>
  
  <input type="submit" value="submit" class="btn btn-success<?PHP if ($number_servers < 1) { echo "disabled\" disabled=\"disabled\""; } ?>">
  
  
  </td></tr>
<tr><td colspan="4"><center><?PHP
echo $updateresult2;
?></td></tr>
</table>
</form>
  <br>

  <br>
  <?PHP
include "footer.php";
?>
   <?PHP
include "aboutmodal.php";
?>
</body>
</html>
