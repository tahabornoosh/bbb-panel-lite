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
//postid check
$get6 = mysqli_real_escape_string($conn, $_POST['id']);
if($_SESSION['mainrole'] != 2) {
  //echo('i,m in');
  $sql = "SELECT * FROM rooms WHERE owner_id='{$_SESSION['login']}' AND id='{$get6}'";
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
  $get6 = mysqli_real_escape_string($conn, $_POST['id']);
  $sql = "SELECT * FROM access WHERE room_id='{$get6}' AND admin_id='{$_SESSION['login']}' AND role=3";
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
    $roomdt = $row;
  }
} else {
  redirect('../../404.php');
}
?>
<?php
if(isset($_POST['id'])) {
  $id1 = mysqli_real_escape_string($conn, $_POST['id']);
  $name1 = mysqli_real_escape_string($conn, $_POST['rname']);
  $description1 = mysqli_real_escape_string($conn, $_POST['rabout']);
  $type1 = mysqli_real_escape_string($conn, $_POST['rtype']);
  $guestac = mysqli_real_escape_string($conn, $_POST['guest_access']);
  //$isan1 = mysqli_real_escape_string($conn, $_POST['isAN']);
  $lurl = mysqli_real_escape_string($conn, $_POST['lurl']);
  $lockes = array(mysqli_real_escape_string($conn, $_POST['lockk']), mysqli_real_escape_string($conn, $_POST['lockPV']), mysqli_real_escape_string($conn, $_POST['lockN']), mysqli_real_escape_string($conn, $_POST['lockc']), mysqli_real_escape_string($conn, $_POST['lockM']));

  $sql = "UPDATE rooms SET name='{$name1}', description='{$description1}', type='{$type1}', guest_access='{$guestac}', lurl='{$lurl}', lockk='{$lockes[0]}', lockPV='$lockes[1]', lockN='{$lockes[2]}', lockc='{$lockes[3]}', lockM='{$lockes[4]}' WHERE id=$id1";

  if ($conn->query($sql) === TRUE) {
    redirect('../index.php#done');
  } else {
    //redirect('../index.php#error');
    echo "Error updating record: " . $conn->error;
  }
}
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>ویرایش اتاق</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="../..//plugins/datatables/dataTables.bootstrap4.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../..//dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

  <!-- bootstrap rtl -->
  <link rel="stylesheet" href="../..//dist/css/bootstrap-rtl.min.css">
  <!-- template rtl version -->
  <link rel="stylesheet" href="../..//dist/css/custom-style.css">

</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
  <!-- Navbar -->
  <?php require "../../incl/navbar.php"?>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
<?php require "../../incl/aside.php"?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>ویرایش اتاق</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-left">
              <li class="breadcrumb-item"><a href=<?php echo($surl."admin");?>>خانه</a></li>
              <li class="breadcrumb-item active">ویرایش اتاق</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
    <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">ویرایش اتاق</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form method="post" role="form">
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputEmail1">نام اتاق</label>
                    <input name='rname' type="text" class="form-control" id="exampleInputEmail1" placeholder="نام اتاق" value='<?php echo($roomdt['name'])?>'>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">درباره اتاق</label>
                    <textarea name='rabout' type="text" class="form-control" id="exampleInputEmail1" placeholder="درباره اتاق"><?php echo($roomdt['description'])?></textarea>
                  </div>
                  <div class="form-group">
                  <?php if($roomdt['type'] == 1) {
                    $pb = 'selected';
                    $pr = '';
                  }
                  else {
                    $pb = '';
                    $pr = 'selected';
                  }
                  ?>
                  <input type='hidden' name='id' value='<?php echo($_GET['id'])?>'>
                    <label for="exampleInputPassword1">نوع اتاق</label>
                    <select name='rtype' class='form-control'>
                    <option value='1' <?php echo($pb)?>>عمومی</option>
                    <option value='0' <?php echo($pr)?>>خصوصی</option>
                    </select>
                  </div>
                  <div class="form-group">
                  <?php if($roomdt['guest_access'] == 1) {
                    $pb2 = 'checked';
                  }
                  else {
                    $pb2 = '';
                  }
                  ?>
                        <label for="exampleInputEmail1">دسترسی میهمان</label>
                        <input name='guest_access' <?php echo($pb2)?> value='1' type="checkbox" class="form-control" id="exampleInputEmfail1" placeholder="لینک را وارد کنید">
                    </div>
                    
                    <div class="form-group">
                        <label for="exampleInputEmail1">قفل دسترسی ها</label><br>
                        <?php if($roomdt['lockM'] == 1) {
                    $pb3 = 'checked';
                  }
                  else {
                    $pb3 = '';
                  }
                  ?>
                            <input name='lockM' <?php echo($pb3)?> type='checkbox' value="1">میکروفون</option>
                            <?php if($roomdt['lockc'] == 1) {
                    $pb3 = 'checked';
                  }
                  else {
                    $pb3 = '';
                  }
                  ?>
                            <input name='lockc' <?php echo($pb3)?> type='checkbox' value="1">وب کم</option>
                            <?php if($roomdt['lockk'] == 1) {
                    $pb3 = 'checked';
                  }
                  else {
                    $pb3 = '';
                  }
                  ?>
                            <input name='lockk' <?php echo($pb3)?> type='checkbox' value="1">چت عمومی</option>
                            <?php if($roomdt['lockPV'] == 1) {
                    $pb3 = 'checked';
                  }
                  else {
                    $pb3 = '';
                  }
                  ?>
                            <input name='lockPV' <?php echo($pb3)?> type='checkbox' value="1">چت خصوصی</option>
                            <?php if($roomdt['lockN'] == 1) {
                    $pb3 = 'checked';
                  }
                  else {
                    $pb3 = '';
                  }
                  ?>
                            <input name='lockN' <?php echo($pb3)?> type='checkbox' value="1">یادداشت های اشتراکی</option>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">URL خروج</label>
                        <input name='lurl' value='<?php echo($roomdt['lurl'])?>' type="url" class="form-control" id="exampleInputEmfail1" placeholder="لینک را وارد کنید">
                    </div>
                  
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">ذخیره</button>
                </div>
              </form>
            </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <?php require "../../incl/footer.php"?>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="../..//plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../..//plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- DataTables -->
<script src="../..//plugins/datatables/jquery.dataTables.js"></script>
<script src="../..//plugins/datatables/dataTables.bootstrap4.js"></script>
<!-- SlimScroll -->
<script src="../..//plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="../..//plugins/fastclick/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="../..//dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../..//dist/js/demo.js"></script>
<!-- page script -->
<script>
  $(function () {
    $("#example1").DataTable({
        "language": {
            "paginate": {
                "next": "بعدی",
                "previous" : "قبلی"
            }
        },
        "info" : false,
    });
    $('#example2').DataTable({
        "language": {
            "paginate": {
                "next": "بعدی",
                "previous" : "قبلی"
            }
        },
      "info" : false,
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "autoWidth": false
    });
  });
</script>
</body>
</html>
