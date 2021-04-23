<?php 
require "../../incl/dbconn.php";
require "../../incl/functions.php";
if($_GET['action'] == 'add') {
    require "../../incl/mustlogadmin.php";
}
else {
    require "../../incl/mustlog.php";
}
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
?>
<?php
if(isset($_GET['deleteuser'])) {
    $adminid = mysqli_real_escape_string($conn, $_GET['deleteuser']);
    $roomid2 = mysqli_real_escape_string($conn, $_GET['id']);
    // sql to delete a record
    $sql = "DELETE FROM access WHERE admin_id='{$adminid}' AND room_id='{$roomid2}'";

    if ($conn->query($sql) === TRUE) {
    redirect('manageaccess.php?id='.$_GET['id'].'#done');
    } else {
    redirect('manageaccess.php?id='.$_GET['id'].'#error');
    }    
}
else if(isset($_GET['updateuser']) && isset($_GET['role'])) {
    $role12 = mysqli_real_escape_string($conn, $_GET['role']);
    $adminid2 = mysqli_real_escape_string($conn, $_GET['updateuser']);
    $roomid3 = mysqli_real_escape_string($conn, $_GET['id']);
    $sql = "UPDATE access SET role='{$role12}' WHERE admin_id={$adminid2} AND room_id={$roomid3}";

    if ($conn->query($sql) === TRUE) {
        redirect('manageaccess.php?id='.$_GET['id'].'#done');
        } else {
        redirect('manageaccess.php?id='.$_GET['id'].'#error');
        }      
}
else if(isset($_GET['adduser']) && isset($_GET['role'])) {
    $role12 = mysqli_real_escape_string($conn, $_GET['role']);
    $adminid2 = mysqli_real_escape_string($conn, $_GET['adduser']);
    $roomid3 = mysqli_real_escape_string($conn, $_GET['id']);
    $sql = "SELECT * FROM rooms WHERE owner_id={$adminid2} AND id={$roomid3}";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
      // output data of each row
      while($row = $result->fetch_assoc()) {
        redirect('manageaccess.php?id='.$_GET['id'].'#can not add owner');
      }
    } else {
      //echo "0 results";
    }    
    $sql = "SELECT * FROM access WHERE room_id='{$roomid3}' AND admin_id='{$adminid2}'";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
      // output data of each row
      while($row = $result->fetch_assoc()) {
        redirect('manageaccess.php?id='.$_GET['id'].'#user already added');
      }
    } else {
        $sql = "INSERT INTO access (admin_id, room_id, role)
        VALUES ('{$adminid2}', '{$roomid3}', '{$role12}')";
        
        if ($conn->query($sql) === TRUE) {
            redirect('manageaccess.php?id='.$_GET['id'].'#done');
            } else {
            redirect('manageaccess.php?id='.$_GET['id'].'#error');
            }   
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
            <h1>مدیریت کاربران اتاق</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-left">
              <li class="breadcrumb-item"><a href="#">خانه</a></li>
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
              <h3 class="card-title">مدیریت کاربران اتاق</h3>
              <?php
              if($_GET['action'] != 'add' && $_SESSION['mainrole'] != 0) {
                  echo("<a href='manageaccess.php?id=".$get5."&action=add'>+ افزودن کاربر به اتاق</a>");
              }
              else if($_GET['action'] == 'add') {
                echo("<a href='manageaccess.php?id=".$get5."'>بازگشت به کاربران اتاق</a>");
              }
              ?>
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
                  <th>نام</th>
                  <th>نام خانوادگی</th>
                  <th>ایمیل</th>
                  <th>نقش</th>
                  <th>عملیات</th>
                </tr>
                </thead>
                <tbody>
                <?php
                if($_GET['action'] == 'add') {
                    $sql = "SELECT * FROM admins";
                    $result = $conn->query($sql);
                    
                    if ($result->num_rows > 0) {
                      // output data of each row
                      while($row = $result->fetch_assoc()) {
                        echo '
                        <tr>
                        <td>'.$row['name'].'</td>
                        <td>'.$row['fname'].'</td>
                        <td>'.$row['email'].'</td>
                        <td>'.givemainroll($row['role']).'</td>
                        <td>
                        <a style="color : yellow" href="manageaccess.php?adduser='.$row['id'].'&id='.$get5.'&role=0"><i class="material-icons">add_circle</i></a>
                        <a style="color : black" href="manageaccess.php?adduser='.$row['id'].'&id='.$get5.'&role=1"><i class="material-icons">add_circle</i></a>
                        <a style="color : blue" href="manageaccess.php?adduser='.$row['id'].'&id='.$get5.'&role=2"><i class="material-icons">add_circle</i></a>
                        <a style="color : red" href="manageaccess.php?adduser='.$row['id'].'&id='.$get5.'&role=3"><i class="material-icons">add_circle</i></a>
                        </td>
                        </tr>
                        ';
                      }
                    } else {
                      //echo "0 results";
                    }                    
                }
                else {
                    $roomid = mysqli_real_escape_string($conn, $_GET['id']);
                    $sql = "SELECT * FROM access WHERE room_id='{$roomid}'";
                    $result = mysqli_query($conn, $sql);
                    
                    if (mysqli_num_rows($result) > 0) {
                      // output data of each row
                      while($row = mysqli_fetch_assoc($result)) {
                        $sql2 = "SELECT * FROM admins WHERE id='{$row['admin_id']}'";
                        $result2 = mysqli_query($conn, $sql2);
                        
                        if (mysqli_num_rows($result2) > 0) {
                          // output data of each row
                          while($row2 = mysqli_fetch_assoc($result2)) {
                            echo('
                            <tr>
                            <td>'.$row2['name'].'</td>
                            <td>'.$row2['fname'].'</td>
                            <td>'.$row2['email'].'</td>
                            <td>'.giveroll($row['role']).'</td>
                            <td>
                            <a style="color : red" href="manageaccess.php?deleteuser='.$row2['id'].'&id='.$roomid.'"><i class="material-icons">remove_circle</i></a>
                            <span> </span>
                            <a style="color : yellow" href="manageaccess.php?updateuser='.$row2['id'].'&role=0&id='.$roomid.'"><i class="material-icons">update</i></a>
                            <a style="color : black" href="manageaccess.php?updateuser='.$row2['id'].'&role=1&id='.$roomid.'"><i class="material-icons">update</i></a>
                            <a style="color : blue" href="manageaccess.php?updateuser='.$row2['id'].'&role=2&id='.$roomid.'"><i class="material-icons">update</i></a>
                            <a style="color : red" href="manageaccess.php?updateuser='.$row2['id'].'&role=3&id='.$roomid.'"><i class="material-icons">update</i></a>
                            </td>
                            </tr>
                            ');
                          }
                        } else {
                          //echo "0 results";
                        }                  }
                    } else {
                      
                    } 
                }

                ?>
                </tbody>
                <tfoot>
                <tr>
                <th>نام</th>
                  <th>نام خانوادگی</th>
                  <th>ایمیل</th>
                  <th>نقش</th>
                  <th>عملیات</th>
                </tr>
                </tfoot>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
          <!--card 2-->
          
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
