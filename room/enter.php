<?php
require "../incl/dbconn.php";
require "../incl/functions.php";
require_once '../vendor/autoload.php';

use sanduhrs\BigBlueButton;

$url = 'http://test-install.blindsidenetworks.com/bigbluebutton/api';
$secret = '8cd8ef52e8e101574e400365b55e11a6';
$endpoint = '/';
//$url = "http://online.codynick.com/bigbluebutton/";
//$secret = "CajUEKwHW2oHP5uVhcTxR0LGVBSSIscJbcWXExTnlqA";
//$endpoint = 'api/';
//auth
if($_POST['logtype'] == 'pastsession' && isset($_SESSION['login'])) {
  $uid = mysqli_real_escape_string($conn, $_SESSION['login']);
  $rid = mysqli_real_escape_string($conn, $_POST['id']);
  $sql = "SELECT * FROM admins WHERE id=$uid";
  $result = $conn->query($sql);
  if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
      $userdt = $row;
    }
  } else {
    //unset($_SESSION['login']);
    //unset($_SESSION['mainrole']);
    redirect('login.php?id='.$_POST['id'].'&mas=2');
  }
  $sql = "SELECT * FROM rooms WHERE id={$rid}";
  $result = $conn->query($sql);
  
  if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
      if($row['visible'] != 1) {
        redirect('../404.php');
      }
      if($row['owner_id'] == $uid) {
        $skipcheck = 1;
        $role1 = 3;
      }
      else {
        $skipcheck = 0;
      }
      $roomdt = $row;
    }
  } else {
    redirect('../404.php');
  }  
  if($skipcheck != 1) {
    $sql = "SELECT * FROM access WHERE admin_id={$uid} AND room_id={$rid}";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
      // output data of each row
      while($row = $result->fetch_assoc()) {
        $role1 = $row['role'];
      }
    } else {
      redirect('login.php?id='.$_POST['id'].'&mas=1');
    }  
  }

}
else if($_POST['logtype'] == 'guest') {
  $rid = mysqli_real_escape_string($conn, $_POST['id']);
  $sql = "SELECT * FROM rooms WHERE id=$rid";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
    if($row['visible'] != 1) {
      redirect('../404.php');
    }
    else if($row['guest_access'] != 1) {
      redirect('../404.php');
    }
    else {
      $roomdt = $row;
      $userdt = array('name' => $_POST['guestname'], 'fname' => '');
    }
  }
} else {
  redirect('../404.php');
}
}

// Initialize a BigBlueButton object.

//final
$bbb = new BigBlueButton($url, $secret, $endpoint);

$meeting = $bbb->server->addMeeting([
  'id' => $roomdt['room_id'],
  'attendeePW' => 'Guphei4i',
  'moderatorPW' => 'ioy9Xep9',
  'name' => $roomdt['name'],
  'welcome' => $roomdt['description'],
  'logoutURL' => $roomdt['lurl'],
  'lockSettingsDisableCam' => tf10($roomdt['lockc']),
  'lockSettingsDisableMic' => tf10($roomdt['lockM']),
  'lockSettingsDisablePublicChat' => tf10($roomdt['lockk']),
  'lockSettingsDisablePrivateChat' => tf10($roomdt['locPV']),
  'lockSettingsDisableNote' => tf10($roomdt['lockN']),
  'record' => false,
  ]);
  if($role1 == 0) {
    $option = ['guest' => true];
      $url = $meeting->join($userdt['name'].'&nbsp;'.$userdt['fname'], false, $option);
      redirect($url);
  }
  else if($role1 == 1) {
      //$option = ['guest' => true];
      $url = $meeting->join($userdt['name'].'&nbsp;'.$userdt['fname']);
      redirect($url);
  }
  else if($role1 == 2 || $role1 == 3) {
    $url = $meeting->join($userdt['name'].'&nbsp;'.$userdt['fname'],true);
    redirect($url);
  }
?>