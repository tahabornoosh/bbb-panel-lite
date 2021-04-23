<?php 
require "../../../incl/dbconn.php";
require "../../../incl/functions.php";
require "../../../incl/mustlogdeep.php";
?>
<?php
if(isset($_POST['name']) && isset($_POST['fname']) && isset($_POST['pass'])) {
    $uname = mysqli_real_escape_string($conn, $_POST['name']);
    $ufname = mysqli_real_escape_string($conn, $_POST['fname']);
    $uemail = mysqli_real_escape_string($conn, $_POST['email']);
    $upass = mysqli_real_escape_string($conn, md5($_POST['pass']));
    $uvisible = mysqli_real_escape_string($conn, $_POST['visible']);
    $urole = mysqli_real_escape_string($conn, $_POST['role']);
    $sql = "INSERT INTO admins (name, fname, email, pass, role, visible)
    VALUES ('$uname', '$ufname', '$uemail', '$upass', '$urole', '$uvisible')";
    
    if ($conn->query($sql) === TRUE) {
      redirect('../users.php#done');
    } else {
      redirect('new.php#email exist');
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
            <h1>ساخت کاربر</h1>
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
    <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">ساخت کاربر جدید</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form" method='post'>
                <div class="card-body">
                <div class="form-group">
                    <label for="exampleInputEmail1">نام</label>
                    <input name='name'  type="text" required class="form-control" id="exampleInputEmail1" placeholder="نام را وارد کنید">
                  </div>
                <div class="form-group">
                    <label for="exampleInputEmail2">نام خانوادگی</label>
                    <input name='fname' required type="text" class="form-control" id="exampleInputEmail2" placeholder="نام خانوادگی را وارد کنید">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail5">ایمیل</label>
                    <input required name='email'type="email" class="form-control" id="exampleInputEmail5" placeholder="ایمیل را وارد کنید">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail6">رمز عبور</label>
                    <input required name='pass'type="password" class="form-control" id="exampleInputEmail6" placeholder="رمز عبور را وارد کنید">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail7">کاربر فعال</label>
                    <input checked name='visible' type="checkbox" value='1' class="form-control" id="exampleInputEmail7">
                </div>
                  <div class="form-group">
                    <label for="exampleInputEmail3">نقش</label>
                    <select name='role' class="form-control" id="exampleInputEmail3">
                    <option value='0' style='color : green'>کاربر عادی</option>
                    <option value='1' style='color : blue'>برگزار کننده</option>
                    <option value='2' style='color : red'>مدیر سیستم</option>
                    <select>
                  </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">ذخیره</button>
                </div>
              </form>
            </div>
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
