<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="refresh" content="20">
    <title>PStatus</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
          <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
          <script src="js/bootstrap.min.js"></script>     
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


<center>
  
<div class="container">
<table class="table table-striped table-bordered" id="status">
    <thead>
        <tr><th colspan="8"><center><img src="icons/005-computer-screen.png">&nbsp;Edit Servers</th></tr>
      <tr><th><b>DEVICE</th><th><b>IP</th><th><b>TYPE</th><th><b>INFO</th><th><b>PURPOSE</th><th><b>UPDATE</th><th>RESET</th><th>DELETE</th></tr>
</thead>
        <tbody>
<?PHP
include "config.inc.php";
$show_modal = 0;
if (isset($_POST['reset'])) {
    $resetid    = mysqli_real_escape_string($db_handle,$_POST['reset']);
    $show_modal = true;
    $date       = date("Y-m-d H:i:s");
    $db_handle  = mysqli_connect($DBServer, $DBUser, $DBPassword);
    $db_found   = mysqli_select_db($db_handle, $DBName);
    $SQLRESET   = "UPDATE servers SET count = '0', ups = '0', downs='0', lastreset = '" . $date . "' WHERE id = '" . $resetid . "'";
    if (mysqli_query($db_handle, $SQLRESET)) {
        $OUTPUT = "Uptime Count reset to 0";
    } else {
        $OUTPUT = "Error resetting Uptime Count: " . mysqli_error($db_handle);
    }
}

if (isset($_POST['delete'])) {
    $deleteid   = mysqli_real_escape_string($db_handle,$_POST['delete']);
    $device     = mysqli_real_escape_string($db_handle,$_POST['device']);
    $show_modal = true;
    $db_handle  = mysqli_connect($DBServer, $DBUser, $DBPassword);
    $db_found   = mysqli_select_db($db_handle, $DBName);
    $SQLDELETE  = "delete from servers where id = '$deleteid'";
    $SQLDELETE2 = "delete from services where parent = '$deleteid'";
    
    if (mysqli_query($db_handle, $SQLDELETE)) {
        $OUTPUT = $device . " deleted";
        if (mysqli_query($db_handle, $SQLDELETE2)) {
            $OUTPUT = $OUTPUT . "<br>Services for " . $device . " deleted.";
        }
    } else {
        $OUTPUT = "Error deleting  " . $device . " : " . mysqli_error($db_handle);
    }
}

if (isset($_POST['updateserver'])) {
    $updateid   = mysqli_real_escape_string($db_handle,$_POST['updateserver']);
    $device     = mysqli_real_escape_string($db_handle,$_POST['device']);
    $ip         = mysqli_real_escape_string($db_handle,$_POST['ip']);
    $type       = mysqli_real_escape_string($db_handle,$_POST['type']);
    $info       = mysqli_real_escape_string($db_handle,$_POST['info']);
    $purpose    = mysqli_real_escape_string($db_handle,$_POST['purpose']);
    $show_modal = true;
    $db_handle  = mysqli_connect($DBServer, $DBUser, $DBPassword);
    $db_found   = mysqli_select_db($db_handle, $DBName);
    $SQLUPDATE  = "UPDATE servers SET device = '" . $device . "', ip = '" . $ip . "', type='" . $type . "', info='" . $info . "', purpose = '" . $purpose . "' WHERE id = '" . $updateid . "'";
    if (mysqli_query($db_handle, $SQLUPDATE)) {
        $OUTPUT = $device . " information updated";
    } else {
        $OUTPUT = "Error updating information for  " . $device . " : " . mysqli_error($db_handle);
    }
}


$db_handle = mysqli_connect($DBServer, $DBUser, $DBPassword);
$db_found  = mysqli_select_db($db_handle, $DBName);
if ($db_found) {
    $SQL    = "select * from servers order by device desc";
    $result = mysqli_query($db_handle, $SQL);
    while ($db_field = mysqli_fetch_assoc($result)) {
        $device  = $db_field['device'];
        $ip      = $db_field['ip'];
        $type    = $db_field['type'];
        $id      = $db_field['id'];
        // $port    = $db_field['port'];
        $info    = $db_field['info'];
        $purpose = $db_field['purpose'];
?>

<form method="POST" action="serveredit.php">
<input type="hidden" value="<?PHP
        echo $id;
?>" name="updateserver">
<tr><td><input type="text" size="20" name="device" value="<?PHP
        echo $device;
?>"</td><td><input type="text" size="20" name="ip" value="<?PHP
        echo $ip;
?>"</td><td><input type="text" size="20" name="type" value="<?PHP
        echo $type;
?>"</td><td><input type="text" size="20" name="info" value="<?PHP
        echo $info;
?>"</td><td><input type="text" size="20" name="purpose" value="<?PHP
        echo $purpose;
?>"</td><td><input type="submit" value="update" class="btn btn-success"></form></td><td><form method="POST" action="serveredit.php"><input type="hidden" name="reset" value="<?PHP
        echo $id;
?>"><input type="submit" value="Reset" class="btn btn-warning"></form></td><td><form method="POST" action="serveredit.php"><input type="hidden" name="delete" value="<?PHP
        echo $id;
?>"><input type="hidden" name="device" value="<?PHP
        echo $device;
?>"><input type="submit" value="delete" class="btn btn-danger"></form></td></tr>

<?PHP
    }
}
?>
   </table>
        <?PHP
include "aboutmodal.php";
?>
   <?PHP
include "footer.php";
?>
<?php
if ($show_modal):
?>
   <script type='text/javascript'>
    $(document).ready(function(){
    $('#myModal').modal('show');
    });
    </script>
<?php
endif;
?>
   
<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">PStatus - Action Result</h4>
      </div>
      <div class="modal-body">
        <p><?PHP
echo $OUTPUT;
?></p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>

    </body>
    </html>
