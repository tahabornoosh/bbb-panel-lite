<?php 
require "../../incl/dbconn.php";
require "../../incl/functions.php";
require "../../incl/mustlog.php";
$get5 = mysqli_real_escape_string($conn, $_GET['id']);
if($_SESSION['mainrole'] != 2) {
  //echo('i,m in');
  $sql = "SELECT * FROM rooms WHERE owner_id='{$_SESSION['login']}' AND id='{$get5}'";
  $result = $conn->query($sql);
  
  if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
      $nextpart1 = 0;
      //echo('i,m in');
    }
  } else {
    $nextpart1 = 1;
    //echo('i,m ina');
  }
}
if($nextpart1 == 1) {
  $get5 = mysqli_real_escape_string($conn, $_GET['id']);
  $sql = "SELECT * FROM access WHERE room_id='{$get5}' AND admin_id='{$_SESSION['login']}' AND role=3";
  $result = $conn->query($sql);
  
  if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
      //echo('i,m in');
    }
  } else {
    redirect('../../404.php');
  }  
}
?>
<?php
$sql = "SELECT * FROM rooms WHERE id='{$get5}'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
    if($row['visible'] == 0) {
        $sql = "UPDATE rooms SET visible=1 WHERE id='{$get5}'";

        if ($conn->query($sql) === TRUE) {
          echo "Record updated successfully";
        } else {
          echo "Error updating record: " . $conn->error;
        }        
    }
    else {
        $sql = "UPDATE rooms SET visible=0 WHERE id='{$get5}'";

        if ($conn->query($sql) === TRUE) {
          echo "Record updated successfully";
        } else {
          echo "Error updating record: " . $conn->error;
        }        
    }
    redirect('../index.php'.$conn->error);
  }
} else {
  redirect('../../404.php');
}  
?>