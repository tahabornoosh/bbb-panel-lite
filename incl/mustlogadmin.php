<?php
if(!mnnv($_SESSION['login'])) {
    unset($_SESSION['login']);
    redirect($surl."admin/login.php");
}
else {
    $sql = "SELECT * FROM admins WHERE id='{$_SESSION['login']}'";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
      // output data of each row
      while($row = $result->fetch_assoc()) {
        if($row['visible'] != 1) {
            unset($_SESSION['login']);
            redirect($surl."admin/login.php");
        }
        if($row['role'] <= 0) {
            redirect($surl.'404.php');
        }
          $_SESSION['mainrole'] = $row['role'];
          //echo($_SESSION['role']);
      }
    } else {
      unset($_SESSION['login']);
        redirect($surl."admin/login.php");
    }    
}
?>