<?php
require '../../../incl/functions.php';
require '../../../incl/dbconn.php';
$get5 = mysqli_real_escape_string($conn, $_GET['id']);
$sql = "SELECT * FROM admins WHERE id='{$get5}'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
    if($row['visible'] == 0) {
        $sql = "UPDATE admins SET visible=1 WHERE id='{$get5}'";

        if ($conn->query($sql) === TRUE) {
          echo "Record updated successfully";
        } else {
          echo "Error updating record: " . $conn->error;
        }        
    }
    else {
        $sql = "UPDATE admins SET visible=0 WHERE id='{$get5}'";

        if ($conn->query($sql) === TRUE) {
          echo "Record updated successfully";
        } else {
          echo "Error updating record: " . $conn->error;
        }        
    }
    redirect('../users.php#'.$conn->error);
  }
} else {
  redirect('../../404.php');
}  
?>