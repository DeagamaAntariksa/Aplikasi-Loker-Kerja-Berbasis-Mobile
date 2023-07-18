<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="" class="brand-link">
     <!--  <img src="../dist/img/AdminLTELogo.png"
           alt="AdminLTE Logo"
           class="brand-image img-circle elevation-3"
           style="opacity: .8"> -->
      <!-- <span class="brand-text font-weight-light"><?php echo $_SESSION['nama'] ?></span> -->
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="../2perusahaan.png" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block"><?php echo $_SESSION['username'] ?></a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fa fa-dashboard"></i>
              <p>
                Data User
                <i class="right fa fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="index.php" class="nav-link">
                  <i class="fa fa-circle-o nav-icon"></i>
                  <p>Profile Anda</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="lowongan.php" class="nav-link">
                  <i class="fa fa-circle-o nav-icon"></i>
                  <p>Data Lowongan Anda</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="logout.php" class="nav-link">
                  <i class="fa fa-circle-o nav-icon"></i>
                  <p>Logout</p>
                </a>
              </li>
            </ul>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>