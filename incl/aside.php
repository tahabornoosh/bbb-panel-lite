
<aside class="main-sidebar sidebar-dark-primary elevation-4">
<script src='https://kit.fontawesome.com/a076d05399.js'></script>
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
      <!--<img src="..//dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8">-->
      <span class="brand-text font-weight-light">پنل مدیریت <?php echo('<small>('.givemainroll($_SESSION['mainrole']).')</small>')?></span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <div>
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
          <div class="image">
            <img src="<?php echo($surl.'incl/f2.png');?>" class="img-circle elevation-2" alt="User Image">
          </div>
          <div class="info">
            <a href=<?php echo($surl.'logout.php')?> class="d-block">
            <?php
            $sql = "SELECT name,fname FROM admins WHERE id='{$_SESSION['login']}'";
            $result = $conn->query($sql);
            
            if ($result->num_rows > 0) {
              // output data of each row
              while($row = $result->fetch_assoc()) {
                echo $row['name'].' '.$row['fname'].'(خروج)';
              }
            } else {
              //echo "0 results";
            }
            ?>
            </a>
          </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
                 with font-awesome or any other icon font library -->
            <li class="nav-item has-treeview">
            <?php
            $sql = "SELECT * FROM adminnav WHERE role=0";
            $result = $conn->query($sql);
            
            if ($result->num_rows > 0) {
              // output data of each row
              while($row = $result->fetch_assoc()) {
                if(gcpu() == $surl.$row['url']) {
                  $selectd = 'active';
                }
                else {
                  $selectd = '';
                }
                echo('<li class="nav-item">');
                echo('      <a href="'.$surl.$row['url'].'" class="nav-link '.$selectd.'">
                <i class="'.$row['icon'].'"></i>
                <p>'.$row['name'].'</p>
              </a>
            </li>');
              }
            } else {
              //echo "0 results";
            }
            if($_SESSION['mainrole'] == 1 || $_SESSION['mainrole'] == 2) {
              echo('<li class="nav-header">امکانات برگزار کننده</li>');
              $sql = "SELECT * FROM adminnav WHERE role=1";
              $result = $conn->query($sql);
              
              if ($result->num_rows > 0) {
                // output data of each row
                while($row = $result->fetch_assoc()) {
                  if(gcpu() == $surl.$row['url']) {
                    $selectd = 'active';
                  }
                  else {
                    $selectd = '';
                  }
                  echo('<li class="nav-item">');
                  echo('      <a href="'.$surl.$row['url'].'" class="nav-link '.$selectd.'">
                  <i class="'.$row['icon'].'"></i>
                  <p>'.$row['name'].'</p>
                </a>
              </li>');
                }
              } else {
                //echo "0 results";
              }
            }
            if($_SESSION['mainrole'] == 2) {
              echo('<li class="nav-header">بخش مدیریت</li>');
              $sql = "SELECT * FROM adminnav WHERE role=2";
              $result = $conn->query($sql);
              
              if ($result->num_rows > 0) {
                // output data of each row
                while($row = $result->fetch_assoc()) {
                  if(gcpu() == $surl.$row['url']) {
                    $selectd = 'active';
                  }
                  else {
                    $selectd = '';
                  }
                  echo('<li class="nav-item">');
                  echo('      <a href="'.$surl.$row['url'].'" class="nav-link '.$selectd.'">
                  <i class="'.$row['icon'].'"></i>
                  <p>'.$row['name'].'</p>
                </a>
              </li>');
                }
              } else {
                //echo "0 results";
              }
            }
            ?>
            
          </ul>
        </nav>
        <!-- /.sidebar-menu -->
      </div>
    </div>
    <!-- /.sidebar -->
  </aside>