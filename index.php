<!DOCTYPE html>
<?PHP
include "config.inc.php";
$show_modal    = 0;
if (isset($_GET['refresh'])) {
    $refresh = $_GET['refresh'];
}
else
{
    $refresh = $refresh . ";url=index.php";
}
if (isset($_GET['ShowDevice'])) {
    $DeviceID = $_GET['ShowDevice'];
    $db_handle = mysqli_connect($DBServer, $DBUser, $DBPassword);
    $db_found  = mysqli_select_db($db_handle, $DBName);
    $SQL    = "select * from servers where id ='" . $DeviceID . "'";
    $result = mysqli_query($db_handle, $SQL);
    
    while ($db_field = mysqli_fetch_assoc($result)) {
    $DeviceName = $db_field['device'];
    $LastUp = $db_field['lastup'];
    $LastDown = $db_field['lastdown'];
    $LastReset = $db_field['lastreset'];
    $DeviceUps = $db_field['ups'];
    $DeviceDowns = $db_field['downs'];
    $state = $db_field['state'];
    $show_modal    = true;
    $output = "Last seen online : " . $LastUp . "<Br>Last seen offline : " . $LastDown . "<br>Last uptime reset : " . $LastReset . "<br>";
    }
}

?>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.15/css/dataTables.bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.1.1/css/responsive.bootstrap.min.css">
    <style type="text/css" class="init">
    
    </style>
    <script type="text/javascript" src="/media/js/site.js?_=45ee69f7580387099dcc5163940d7394">
    </script>
    <script type="text/javascript" src="/media/js/dynamic.php?comments-page=extensions%2Fresponsive%2Fexamples%2Fstyling%2Fbootstrap.html" async>
    </script>
    <script type="text/javascript" language="javascript" src="//code.jquery.com/jquery-1.12.4.js">
    </script>
    <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js">
    </script>
    <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.10.15/js/dataTables.bootstrap.min.js">
    </script>
    <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/responsive/2.1.1/js/dataTables.responsive.min.js">
    </script>
    <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/responsive/2.1.1/js/responsive.bootstrap.min.js">
    </script>

    <script src="js/bootstrap.min.js"></script>     

    <script type="text/javascript" class="init">
    
$(document).ready(function() {
    $('#status').DataTable({  "pageLength": <?php echo $row_count; ?>, stateSave: true });
} );
    </script>
<meta http-equiv="refresh" content="<?PHP echo $refresh; ?>">
    <title>PStatus</title>

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
    <tr><th colspan="6"><center><b><img src="icons/005-computer-screen.png" width="16" height="16">&nbsp;Server Ping Status</th></tr>
        <tr><th><b>DEVICE</th><th><b>Type</th><th><b>INFO</th><th><b>PURPOSE</th><th><b>STATUS</th><th><b>UPTIME</th></tr>
    </thead>
    <tbody>
<?PHP

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
        // $port    = $db_field['port']; //Removed Mr Hitesh Save 08-03-22
        $info    = $db_field['info'];
        $purpose = $db_field['purpose'];
        $count   = $db_field['count'];
        $ups     = $db_field['ups'];
        $downs   = $db_field['downs'];
        $online   = $db_field['state'];
        if ($online == 'online') 
        {
            $state = "<td style=background-color:#56E08E><center>online</td>";
        }
        else
        {
            $state = "<td style=background-color:#E05667><center>offline</td>";
        }
        $value   = $ups;
        $max     = $count;
        $scale   = 1.0;
        if (!empty($max)) {
            $percent = ($value * 100) / $max;
        } else {
            $percent = 0;
        }
        if ($percent > 100) {
            $percent = 100;
        }
        print "<tr><td><a href='index.php?ShowDevice=" . $id . "'>" . $device . "</a></td><td>" . $type . "</td><td>" . $info . "</td><td><align='right'><a href='services.php?device=" . $device . "&parent=" . $id . "&ip=" . $ip . "' alt='" . $ip . "'><img src='icons/001-window.png'></a> - " . $purpose . "</td>" . $state . "</td><td><div class='progress'><div class='progress-bar progress-bar-success' role='progressbar' aria-valuenow='" . round($percent * $scale) . "' aria-valuemin='0' aria-valuemax='100' style='width:" . round($percent * $scale) . "%'>" . round($percent * $scale) . "%</div></div></td></tr>";
    }
    
    mysqli_close($db_handle);
    
}
?>
           </tbody>
    </table>
    </div>
    
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
        <h4 class="modal-title">PStatus - <?PHP echo $DeviceName; ?></h4>
      </div>
      <div class="modal-body">
        <p><?PHP
echo $output;
?></p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>

    <br>
    <?PHP
include "footer.php";
?>
   <?PHP
include "aboutmodal.php";
?>
 </body>
</html>
