<?php 
require "../incl/dbconn.php";
require "../incl/functions.php";
if($_GET['action'] == "logout") {
    unset($_SESSION['login']);
    redirect('login.php');
}
if(mnnv($_SESSION['login'])) {
    redirect('index.php');
}
if(mnnv($_POST['email']) && mnnv($_POST['password'])) {
    $mrese = mysqli_real_escape_string($conn, $_POST['email']);
    $mresp = mysqli_real_escape_string($conn, $_POST['password']);
    $sql = "SELECT * FROM admins WHERE email='{$mrese}'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
            if(md5($mresp) == $row['pass'] && $row['visible'] == 1) {
                $_SESSION['login'] = $row['id'];
                $_SESSION['mainrole'] = $row['role'];
                redirect('index.php');
            }
            else if($row['pass'] != md5($mresp)) {
                redirect('login.php?mas=Password is Wrong');
            }
            else if($row['visible'] != 1) {
                redirect('login.php?mas=Email not Found');
            }
        }
        } else {
            redirect('login.php?mas=Email not Found');
        }
}
else {
    redirect('login.php?mas=Email and password are reqired');
}
?>