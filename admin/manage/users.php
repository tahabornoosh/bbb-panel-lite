<?php 
require "../../incl/dbconn.php";
require "../../incl/functions.php";
require "../../incl/mustlogdeep.php";
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
            <h1>مدیریت کاربران</h1>
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
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">مدیریت کاربران</h3>
              <a href='user/new.php'>+ کاربر جدید</a>
            </div>
            <!-- /.card-header -->
          <!-- /.card -->

          <div class="card">
            <div class="card-header">
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>ID</th>
                  <th>نام</th>
                  <th>نام خانوادگی</th>
                  <th>ایمیل</th>
                  <th>نقش</th>
                  <th>عملیات</th>
                </tr>
                </thead>
                <tbody>
                <?php
                $sql = "SELECT * FROM admins";
                $result = $conn->query($sql);
                
                if ($result->num_rows > 0) {
                  // output data of each row
                  while($row = $result->fetch_assoc()) {
                    echo('<tr>
                    <td>'.$row['id'].'</td>
                    <td>'.$row['name'].'
                    </td>
                    <td>'.$row['fname'].'</td>
                    <td>'.$row['email'].'</td>
                    ');
                    if($row['visible'] == 1) {
                        $visible1 = 'visibility';
                    }
                    else {
                        $visible1 = 'visibility_off';
                    }
                    echo('<td>'.givemainroll($row['role']).'</td>
                    <td style="text-align : center;">
                    <a href=user/edit.php?id='.$row['id'].'><i class="material-icons" style="color : blue;">edit</i></a>
                    <a href=user/delete.php?id='.$row['id'].'><i class="material-icons" style="color : red;">delete</i></a>
                    <a href=user/visible.php?id='.$row['id'].'><i class="material-icons" style="color : #4caf50;">'.$visible1.'</i></a>
                    </td>
                  </tr>');
                  }
                } else {
                  
                }         
                ?>
                </tbody>
                <tfoot>
                <tr>
                  <th>ID</th>
                  <th>نام</th>
                  <th>نوع</th>
                  <th>مالک</th>
                  <th>نقش</th>
                  <th>عملیات</th>
                </tr>
                </tfoot>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
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
