<?php
require "../../incl/dbconn.php";
require "../../incl/functions.php";
require "../../incl/mustlogdeep.php";
if(!isset($_GET['id'])) {
    redirect('../../404.php');
}

$rid = mysqli_real_escape_string($conn, $_GET['id']);
$sql = "SELECT * FROM rooms WHERE id=$rid";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
    $roominfo = $row;
  }
} else {
    redirect('../../404.php');
}

require_once '../../vendor/autoload.php';

use sanduhrs\BigBlueButton;

//$url = 'http://test-install.blindsidenetworks.com/bigbluebutton/api';
//$secret = '8cd8ef52e8e101574e400365b55e11a6';
//$endpoint = '/';
//$url = "http://online.codynick.com/bigbluebutton/";
//$secret = "CajUEKwHW2oHP5uVhcTxR0LGVBSSIscJbcWXExTnlqA";
//$endpoint = 'api/';

$bbb = new BigBlueButton($url, $secret, $endpoint);
$meeting = $bbb->server->addMeeting([
    'id' => $roominfo['room_id'],
    'name' => $roominfo['name'],
    'welcome' => $roominfo['description'],
    'logoutURL' => $roominfo['lurl'],
    'lockSettingsDisableCam' => $roominfo['lockc'],
    'lockSettingsDisablemic' => $roominfo['lockM'],
    'lockSettingsDisablePublicChat' => $roominfo['lockk'],
    'lockSettingsDisablePrivateChat' => $roominfo['lockPV'],
    'lockSettingsDisableNote' => $roominfo['lockN'],
    'record' => 'false',
    'guestPolicy' => 'ASK_MODERATOR',
    ]);
        $url = $meeting->join('مدیر سیستم', true);
        redirect($url);