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
            <h1>مدیریت اتاق ها</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-left">
              <li class="breadcrumb-item"><a href="#">خانه</a></li>
              <li class="breadcrumb-item active">مدیریت اتاق ها</li>
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
              <h3 class="card-title">مدیریت اتاق ها</h3>
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
                  <th>نوع</th>
                  <th>مالک</th>
                  <th>عملیات</th>
                </tr>
                </thead>
                <tbody>
                <?php
                $sql = "SELECT * FROM rooms";
                $result = $conn->query($sql);
                
                if ($result->num_rows > 0) {
                  // output data of each row
                  while($row = $result->fetch_assoc()) {
                    echo('<tr>
                    <td>'.$row['id'].'</td>
                    <td>'.$row['name'].'
                    </td>');
                    if($row['type'] == 1) {
                        echo('<td>عمومی</td>');
                    }
                    else {
                        echo("<td>خصوصی</td>");
                    }
                    if($row['visible'] == 1) {
                      $visible1 = 'visibility';
                    }
                    else {
                      $visible1 = 'visibility_off';
                    }
                    
                    $sql8 = "SELECT name, fname FROM admins WHERE id={$row['owner_id']}";
                    $result8 = mysqli_query($conn, $sql8);
                    
                    if (mysqli_num_rows($result8) > 0) {
                      // output data of each row
                      while($row8 = mysqli_fetch_assoc($result8)) {
                        echo "<td>".$row8['name']." ".$row8['fname']."</td>";
                      }
                    }   
                    echo('<td style="text-align : center;">
                    <a href=../rooms/edit.php?id='.$row['id'].'><i class="material-icons" style="color : blue;">edit</i></a>
                    <a href=../rooms/delete.php?id='.$row['id'].'><i class="material-icons" style="color : red;">delete</i></a>
                    <a href=../rooms/visible.php?id='.$row['id'].'><i class="material-icons" style="color : #4caf50;">'.$visible1.'</i></a>
                    <a href=../rooms/manageaccess.php?id='.$row['id'].'><i class="material-icons" style="color : purple;">perm_identity</i></a>
                    <a href=../../../room/login.php?id='.$row['id'].'><i class="material-icons" style="color : #f7e612;">login</i></a>
                    <a href=fastroom.php?id='.$row['id'].'><i class="material-icons" style="color : orange;">play_arrow</i></a>
                    </td>
                  </tr>');
                  }
                } else {
                  
                }
                //next part
                             
                ?>
                </tbody>
                <tfoot>
                <tr>
                  <th>ID</th>
                  <th>نام</th>
                  <th>نوع</th>
                  <th>مالک</th>
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
