<?php 
require "../incl/dbconn.php";
require "../incl/functions.php";
require "../incl/mustlog.php";

$sql = "SELECT * FROM admins WHERE id='{$_SESSION['login']}'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
    $userinfo = $row;
  }
} else {
  //echo "0 results";
}
?>
<?php
if(isset($_POST['passwd'])) {
    $passwd = mysqli_real_escape_string($conn, md5($_POST['passwd']));
    $sql = "UPDATE admins SET pass='{$passwd}' WHERE id={$_SESSION['login']}";

    if ($conn->query($sql) === TRUE) {
      redirect('profile.php#done');
    } else {
        redirect('profile.php#error');
    }
}
else if(isset($_POST['name']) && isset($_POST['fname'])) {
    $name1 = mysqli_real_escape_string($conn, $_POST['name']);
    $fname1 = mysqli_real_escape_string($conn, $_POST['fname']);
    $sql = "UPDATE admins SET name='{$name1}', fname='{$fname1}' WHERE id={$_SESSION['login']}";

    if ($conn->query($sql) === TRUE) {
      redirect('profile.php#done');
    } else {
        redirect('profile.php#error');
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
  <link rel="stylesheet" href="..//plugins/datatables/dataTables.bootstrap4.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="..//dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

  <!-- bootstrap rtl -->
  <link rel="stylesheet" href="..//dist/css/bootstrap-rtl.min.css">
  <!-- template rtl version -->
  <link rel="stylesheet" href="..//dist/css/custom-style.css">

</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
  <!-- Navbar -->
  <?php require "../incl/navbar.php"?>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
<?php require "../incl/aside.php"?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>پروفایل</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-left">
              <li class="breadcrumb-item"><a href="#">خانه</a></li>
              <li class="breadcrumb-item active">پروفایل</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
    <div class="container-fluid">
        <div class="row">
          <div class="col-md-3">

            <!-- Profile Image -->
            <div class="card card-primary card-outline">
              <div class="card-body box-profile">
                <div class="text-center">
                  <img class="profile-user-img img-fluid img-circle" src="../incl/f2.png" alt="User profile picture">
                </div>

                <h3 class="profile-username text-center"><?php echo($userinfo['name'].' '.$userinfo['fname'])?></h3>

                <p class="text-muted text-center"><?php echo($userinfo['email'])?></p>

              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

            <!-- /.card -->
          </div>
          <!-- /.col -->
          <div class="col-md-9">
            <div class="card">
              <div class="card-header p-2">
                <ul class="nav nav-pills">
                  <li class="nav-item"><a class="nav-link active" href="#activity" data-toggle="tab">اتاق ها</a></li>
                  <li class="nav-item"><a class="nav-link" href="#timeline" data-toggle="tab">تغییر رمز عبور</a></li>
                  <li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab">اطلاعات شخصی</a></li>
                </ul>
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content">
                  <div class="active tab-pane" id="activity">
                  <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>ID</th>
                  <th>نام</th>
                  <th>نوع</th>
                  <th>مالک</th>
                  <th>نقش</th>
                  <th>عملیات</th>
                </tr>
                </thead>
                <tbody>
                <?php
                $sql = "SELECT * FROM rooms WHERE owner_id='{$_SESSION['login']}'";
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
                    echo('<td>شما</td>
                    <td>-</td>
                    <td style="text-align : center;">
                    <a href=rooms/edit.php?id='.$row['id'].'><i class="material-icons" style="color : blue;">edit</i></a>
                    <a href=rooms/delete.php?id='.$row['id'].'><i class="material-icons" style="color : red;">delete</i></a>
                    <a href=rooms/visible.php?id='.$row['id'].'><i class="material-icons" style="color : #4caf50;">'.$visible1.'</i></a>
                    <a href=rooms/manageaccess.php?id='.$row['id'].'><i class="material-icons" style="color : purple;">perm_identity</i></a>
                    <a href=../room/login.php?id='.$row['id'].'><i class="material-icons" style="color : #f7e612;">login</i></a>
                    </td>
                  </tr>');
                  }
                } else {
                  
                }
                //next part
                $sql = "SELECT * FROM access WHERE admin_id={$_SESSION['login']}";
                $result = $conn->query($sql);
                
                if ($result->num_rows > 0) {
                  // output data of each row
                  while($row = $result->fetch_assoc()) {
                    //start
                    $sql2 = "SELECT * FROM rooms WHERE id='{$row['room_id']}'";
                    $result2 = mysqli_query($conn, $sql2);
                    
                    if (mysqli_num_rows($result2) > 0) {
                      // output data of each row
                      while($row2 = mysqli_fetch_assoc($result2)) {
                        echo('<tr>
                        <td>'.$row2['id'].'</td>
                        <td>'.$row2['name'].'</td>');
                        if($row2['type'] == 1) {
                            echo('<td>عمومی</td>');
                        }
                        else {
                            echo("<td>خصوصی</td>");
                        }
                            //ownerFind
                            $sql8 = "SELECT name, fname FROM admins WHERE id={$row2['owner_id']}";
                            $result8 = mysqli_query($conn, $sql8);
                            
                            if (mysqli_num_rows($result8) > 0) {
                              // output data of each row
                              while($row8 = mysqli_fetch_assoc($result8)) {
                                echo "<td>".$row8['name']." ".$row8['fname']."</td>";
                              }
                            }                            
                            //ownerFindend
                            echo("<td>".giveroll($row['role'])."</td>");
                            if($row['role'] == 3) {
                              if($row2['visible'] == 1) {
                                $visible1 = 'visibility';
                              }
                              else {
                                $visible1 = 'visibility_off';
                              }
                              echo('                    <td style="text-align : center;">
                              <a href=rooms/edit.php?id='.$row2['id'].'><i class="material-icons" style="color : blue;">edit</i></a>
                              <a href=rooms/delete.php?id='.$row2['id'].'><i class="material-icons" style="color : red;">delete</i></a>
                              <a href=rooms/visible.php?id='.$row2['id'].'><i class="material-icons" style="color : #4caf50;">'.$visible1.'</i></a>
                              <a href=rooms/manageaccess.php?id='.$row2['id'].'><i class="material-icons" style="color : purple;">perm_identity</i></a>
                              <a href=../room/login.php?id='.$row2['id'].'><i class="material-icons" style="color : #f7e612;">login</i></a>
                              </td>');
                            }
                            else {
                              echo('<td style="text-align : center;"><a href=../room/login.php?id='.$row2['id'].'><i class="material-icons" style="color : red;">login</i></a></td>');
                            }
                      }
                    } else {
                      //echo "0 results";
                    }                   
                    //end
                  }
                } else {
                  //echo "0 results";
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
                  </div>
                  <!-- /.tab-pane -->
                  <div class="tab-pane" id="timeline">
                  <form method='post' class="form-horizontal">
                  <div class="form-group">
                        <label for="inputName" class="col-sm-2 control-label">رمز عبور</label>

                        <div class="col-sm-10">
                          <input name='passwd' type="password" class="form-control" id="inputName" placeholder="رمز عبور جدید را وارد کنید">
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                          <button type="submit" class="btn btn-danger">ذخیره</button>
                        </div>
                      </div>
                    </form>

                  </div>
                  <!-- /.tab-pane -->

                  <div class="tab-pane" id="settings">
                    <form method='post' class="form-horizontal">
                    <div class="form-group">
                        <label for="inputName" class="col-sm-2 control-label">نام</label>

                        <div class="col-sm-10">
                          <input name='name' value='<?php echo($userinfo['name'])?>' type="text" class="form-control" id="inputName" placeholder="نام را وارد کنید">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="inputfName" class="col-sm-2 control-label">نام خانوادگی</label>

                        <div class="col-sm-10">
                          <input value='<?php echo($userinfo['fname'])?>' name='fname' type="text" class="form-control" id="inputfName" placeholder="نام خانوادگی را وارد کنید">
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                          <button type="submit" class="btn btn-primary">ذخیره</button>
                        </div>
                      </div>
                    </form>
                  </div>
                  <!-- /.tab-pane -->
                </div>
                <!-- /.tab-content -->
              </div><!-- /.card-body -->
            </div>
            <!-- /.nav-tabs-custom -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <?php require "../incl/footer.php"?>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="..//plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="..//plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- DataTables -->
<script src="..//plugins/datatables/jquery.dataTables.js"></script>
<script src="..//plugins/datatables/dataTables.bootstrap4.js"></script>
<!-- SlimScroll -->
<script src="..//plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="..//plugins/fastclick/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="..//dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="..//dist/js/demo.js"></script>
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
