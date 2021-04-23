<?php 
require "../../../incl/dbconn.php";
require "../../../incl/functions.php";
require "../../../incl/mustlogdeep.php";
if(!mnnv($_GET['id']) && !mnnv($_POST['id'])) {
  redirect('../../../404.php');
}
?>
<?php
if(mnnv($_POST['id'])) {
  $uid = mysqli_real_escape_string($conn, $_POST['id']);
  $sql = "SELECT * FROM admins WHERE id=$uid";
  $result = $conn->query($sql);
  
  if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
      //
    }
  } else {
    redirect('../../../404.php');
  }  
  //next
  $sql = "SELECT * FROM rooms WHERE owner_id=$uid";
  $result = $conn->query($sql);
  
  if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
      $sql = "DELETE FROM access WHERE room_id={$row['id']}";

      if ($conn->query($sql) === TRUE) {
        //echo "Record deleted successfully";
      } else {
        //echo "Error deleting record: " . $conn->error;
      } 
      $sql = "DELETE FROM rooms WHERE id={$row['id']}";

      if ($conn->query($sql) === TRUE) {
        //echo "Record deleted successfully";
      } else {
        //echo "Error deleting record: " . $conn->error;
      }           
    }
  } else {
    //echo "0 results";
  }  
  $sql = "DELETE FROM access WHERE admin_id=$uid";

  if ($conn->query($sql) === TRUE) {
    //echo "Record deleted successfully";
  } else {
    //echo "Error deleting record: " . $conn->error;
  }  
  $sql = "DELETE FROM admins WHERE id=$uid";

  if ($conn->query($sql) === TRUE) {
    //echo "Record deleted successfully";
  } else {
    //echo "Error deleting record: " . $conn->error;
  }  
  redirect('../users.php#done');
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
  <link rel="stylesheet" href="../../..//plugins/datatables/dataTables.bootstrap4.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../../..//dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

  <!-- bootstrap rtl -->
  <link rel="stylesheet" href="../../..//dist/css/bootstrap-rtl.min.css">
  <!-- template rtl version -->
  <link rel="stylesheet" href="../../..//dist/css/custom-style.css">

</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
  <!-- Navbar -->
  <?php require "../../../incl/navbar.php"?>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
<?php require "../../../incl/aside.php"?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>حذف کاربر</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-left">
              <li class="breadcrumb-item"><a href="#">خانه</a></li>
              <li class="breadcrumb-item active">مدیریت کاربران</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
   <div class="card card-danger">
   <form method='post'>
              <div class="card-header">
                <h3 class="card-title">هشدار!</h3>
              </div>
              <div class="card-body">
                <input type='hidden' name='id' value='<?php echo($_GET['id'])?>'>
                <span>شما در حال حذف کردن دائمی این کاربر می باشید<br>
                این کار باعث می شود تمامی اطلاعات کاربر از جمله اتاق هایی که ساخته است، اتصالات به اتاق های دیگر و اطلاعات شخصی کاربر به صورت دائمی پاک شوند
                <br>آیا از ادامه عملیات اطمینان دارید؟<br></span>

              </div>
              <div class="card-footer">
                  <button type="submit" class="btn btn-danger">بله، کاربر را حذف کنید</button>
                  <a class='btn btn-primary float-left' style='text-align: left;' href='../users.php'>انصراف</a>
                </div>
                <form>
              <!-- /.card-body -->
            </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <?php require "../../../incl/footer.php"?>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="../../..//plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../../..//plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- DataTables -->
<script src="../../..//plugins/datatables/jquery.dataTables.js"></script>
<script src="../../..//plugins/datatables/dataTables.bootstrap4.js"></script>
<!-- SlimScroll -->
<script src="../../..//plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="../../..//plugins/fastclick/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="../../..//dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../../..//dist/js/demo.js"></script>
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
