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
if(isset($_POST['id'])) {
    $get7 = mysqli_real_escape_string($conn, $_POST['id']);
    $sql = "DELETE FROM access WHERE room_id=$get7";

    if ($conn->query($sql) === TRUE) {
      $compelete = 1;
    } else {
        $compelete = 0;
    } 
    $sql = "DELETE FROM rooms WHERE id=$get7";

    if ($conn->query($sql) === TRUE) {
      $compelete =+ 1;
    } else {
        //error log
    }    
    if($compelete == 2) {
        redirect('../index.php#done');
    }   
    else {
        redirect('../index.php#done');
    }
}
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>پنل مدیریت</title>
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
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>حذف اتاق</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-left">
              <li class="breadcrumb-item"><a href="#">خانه</a></li>
              <li class="breadcrumb-item active">حذف اتاق</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <section class="content">
    <div class="card card-danger">
    <form method='post'>
              <div class="card-header">
                <h3 class="card-title">هشدار!</h3>
              </div>
              <div class="card-body">

                <span>شما در حال حذف کردن دائمی این اتاق می باشید، این کار باعث می شود این اتاق و تمام اتصالاتش برای همیشه پاک شوند<br>
                <br>آیا از ادامه عملیات اطمینان دارید؟<br></span>

              </div>
              <div class="card-footer">
              <input type='hidden' name='id' value='<?php echo($_GET['id'])?>'>
                  <button  type="submit" class="btn btn-danger">بله، اتاق را حذف کنید</button>
                  <a class='btn btn-primary float-left' style='text-align: left;' href='../index.php'>انصراف</a>
                </div>
                </form>
              <!-- /.card-body -->
            </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
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
