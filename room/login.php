<?php 
require "../incl/dbconn.php";
require "../incl/functions.php";
if(!mnnv($_GET['id'])) {
  redirect("../404.php");
}
$roominfo = array();
$sql = "SELECT * FROM rooms WHERE id='{$_GET['id']}'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
    $roominfo = $row;
  }
} else {
  redirect('../404.php');
}
$user_name = 0;
$sql = "SELECT * FROM admins WHERE id='{$_SESSION['login']}'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
    $user_name = $row['name'];
    $user_fname = $row['fname'];
  }
} else {
}
if($roominfo['guest_access'] == 1) {
  $guestallow = '<a href=login.php?id='.$_GET['id'].'&logtype=guest><button style="display : inline-block; width : 100%;margin : 5px" type="button" class="btn btn-block btn-warning float-right">میهمان</button></a>';
}
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>پنل مدیریت | صفحه ورود</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/adminlte.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="../plugins/iCheck/square/blue.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

  <!-- bootstrap rtl -->
  <link rel="stylesheet" href="../dist/css/bootstrap-rtl.min.css">
  <!-- template rtl version -->
  <link rel="stylesheet" href="../dist/css/custom-style.css">
</head>
<?php
if($roominfo['visible'] != 1) {
  echo('<body class="hold-transition lockscreen">
  <!-- Automatic element centering -->
  <div class="lockscreen-wrapper">
    <div class="lockscreen-logo">
      <a href="#"><b>'.$roominfo['name'].'</b></a>
    </div>
    <!-- User name -->
    <p>با عرض پوزش، این اتاق توسط مدیر آن موقتا غیرفعال شده است</p>
    <!-- /.lockscreen-item -->
    <div class="help-block text-center">
    </div>
    <div class="text-center">
      <a href="login.html"></a>
    </div>
    <div class="lockscreen-footer text-center mt-4">
      
    </div>
  </div>
  <!-- /.center -->
  
  <!-- jQuery -->
  <script src="../../plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  </body>');
}
else if(!mnnv($_SESSION['login']) && $_GET['logtype'] != 'guest') {
    echo('<body class="hold-transition login-page">
    <div class="login-box">
      <div class="login-logo">
        <a href="#"><b>'.$roominfo['name'].'</b></a>
      </div>
      <!-- /.login-logo -->
      <div class="card">
        <div class="card-body login-card-body">
          <p class="login-box-msg">ورود به اتاق</p>
          <small style="color : red">'.$_GET['mas'].'</small>
          ');

    
         echo(' <form action="enterpass.php" method="post">
            <div class="input-group mb-3">
              <input name="email" type="email" class="form-control" placeholder="ایمیل">
              <input type="hidden" name="type" value="lup">
              <input type="hidden" name="roid" value='.$_GET['id'].'>
              <div class="input-group-append">
                <span class="fa fa-envelope input-group-text"></span>
              </div>
            </div>
            <div class="input-group mb-3">
              <input name="password" type="password" class="form-control" placeholder="رمز عبور">
              <div class="input-group-append">
                <span class="fa fa-lock input-group-text"></span>
              </div>
            </div>
            <div class="row">
              <div class="col-8">
              </div>
              <!-- /.col -->
              <div class="col-4">
                <button type="submit" class="btn btn-primary btn-block btn-flat">ورود</button>
                '.$guestallow.'
              </div>
              <!-- /.col -->
            </div>
          </form>
          
    
        <!-- /.login-card-body -->
      </div>
    </div>
    <!-- /.login-box -->
    
    <!-- jQuery -->
    <script src="../plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- iCheck -->
    <script src="../plugins/iCheck/icheck.min.js"></script>
    <script>
      $(function () {
        $("input").iCheck({
          checkboxClass: "icheckbox_square-blue",
          radioClass   : "iradio_square-blue",
          increaseArea : "20%" // optional
        })
      })
    </script>
    </body>');
}
else if(isset($_SESSION['login'])) {
  $mixname = $user_name.'&nbsp;'.$user_fname;
  if($_GET['mas'] == 1) {
    $mas='شما دسترسی لازم برای ورود به اتاق را ندارید';
  }
    echo('<body class="hold-transition lockscreen">
    <!-- Automatic element centering -->
    <div class="lockscreen-wrapper">
      <div class="lockscreen-logo">
        <a href="#"><b>'.$roominfo['name'].'</b></a>');
        if($_GET['mas'] == 1) {
          echo('<br>');
          echo('<small style="color : red">خطا، شما دسترسی لازم برای ورود به اتاق را ندارید، میتوانید خارج شوید و با اطلاعات دیگری وارد شوید</small>');
        }
      echo('</div>
      <!-- User name -->
      <div class="lockscreen-name">'.$user_name.'</div>
    
      <!-- START LOCK SCREEN ITEM -->
      <div class="lockscreen-item">
        <!-- lockscreen image -->
        <div class="lockscreen-image">
          <img src="../dist/img/user1-128x128.jpg" alt="User Image">
        </div>
        <!-- /.lockscreen-image -->
    
        <!-- lockscreen credentials (contains the form) -->
        <form action="enter.php" method="post" class="lockscreen-credentials">
          <div class="input-group">
          <input type="hidden" name="logtype" value="pastsession">
          <input type="hidden" name="id" value="'.$_GET['id'].'">
            <input type="text" disabled class="form-control" placeholder="نام" value='.$mixname.'>
    
            <div class="input-group-append">
              <button type="submit" class="btn"><i class="fa fa-arrow-right text-muted"></i></button>
            </div>
          </div>
        </form>
        <!-- /.lockscreen credentials -->
    
      </div>
      <!-- /.lockscreen-item -->
      <div class="help-block text-center">
      </div>
      <div class="text-center">
        <a href="login.html"></a>
      </div>
      <div class="lockscreen-footer text-center mt-4">
        
      </div>
    </div>
    <!-- /.center -->
    
    <!-- jQuery -->
    <script src="../../plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    </body>');
}
else if($_GET['logtype'] == 'guest') {
  if($roominfo['guest_access'] != 1) {
    redirect($surl.'room/login.php?id='.$roominfo['id']);
  }
  echo('<body class="hold-transition lockscreen">
  <!-- Automatic element centering -->
  <div class="lockscreen-wrapper">
    <div class="lockscreen-logo">
      <a href="#"><b>'.$roominfo['name'].'</b></a>
    </div>
    <!-- User name -->
    <div class="lockscreen-name">ورود به عنوان میهمان</div>
  
    <!-- START LOCK SCREEN ITEM -->
    <div class="lockscreen-item">
      <!-- lockscreen image -->
      <div class="lockscreen-image">
        <img src="../dist/img/user1-128x128.jpg" alt="User Image">
      </div>
      <!-- /.lockscreen-image -->
  
      <!-- lockscreen credentials (contains the form) -->
      <form action="enter.php" method="post" class="lockscreen-credentials">
        <div class="input-group">
        <input type="hidden" name="logtype" value="guest">
        <input type="hidden" name="id" value="'.$_GET['id'].'">
          <input type="text" name="guestname" class="form-control" placeholder="نام" value="میهمان">
  
          <div class="input-group-append">
            <button type="submit" class="btn"><i class="fa fa-arrow-right text-muted"></i></button>
          </div>
        </div>
      </form>
      <!-- /.lockscreen credentials -->
  
    </div>
    <!-- /.lockscreen-item -->
    <div class="help-block text-center">
    </div>
    <div class="text-center">
      <a href="login.html"></a>
    </div>
    <div class="lockscreen-footer text-center mt-4">
      
    </div>
  </div>
  <!-- /.center -->
  
  <!-- jQuery -->
  <script src="../../plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  </body>');
}
?>
</html>
