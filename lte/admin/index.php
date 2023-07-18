<?php 
session_start();
if (!isset($_SESSION['id_user'])) {
  header("location:../login.php");
}
require '../../koneksi.php';
$user=mysqli_query($koneksi,"SELECT * FROM tb_user");
if (isset($_POST['edit'])) {
  $sql=mysqli_query($koneksi,"UPDATE tb_user SET nama='$_POST[nama]',username='$_POST[username]',password='$_POST[password]' WHERE id_user='$_POST[id_user]'");
  if ($sql) {
    echo "<script>
    document.location.href='index.php'
    </script>";
  }else{
    echo "<script>
    document.location.href='index.php'
    </script>";
  }
}

if (isset($_POST['hapus'])) {
  $sql=mysqli_query($koneksi,"DELETE FROM tb_user WHERE id_user='$_POST[id_user]'");
  if ($sql) {
    echo "<script>
    alert('Data Berhasil di Hapus')
    document.location.href='index.php'
    </script>";
  }
}
?> 
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>AdminLTE 3 | Data Tables</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="../plugins/datatables/dataTables.bootstrap4.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand bg-white navbar-light border-bottom">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fa fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="" class="nav-link">Home</a>
      </li>
    </ul>

    <!-- SEARCH FORM -->
   
    <!-- Right navbar links -->
    
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <?php include 'sidebar.php'; ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-12">
          <!-- /.card -->
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Data Table Halaman User</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>No. </th>
                  <th>Nama User</th>
                  <th>Username</th>
                  <th>Role</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                  <?php $no=1; ?>
                <?php foreach ($user as $usr): ?>
                <tr>
                  <td><?php echo $no ?></td>
                  <td><?php echo $usr['nama'] ?></td>
                  <td><?php echo $usr['username']; ?></td>
                  <td><?php echo $usr['role'] ?></td>
                  <td>
                    <?php if ($usr['role']=="admin"): ?>
                      <button type="button" class="btn btn-sm btn-primary form-control" data-toggle="modal" data-target="#exampleModal<?php echo $usr['id_user']; ?>">
                        Edit
                      </button>
                    <?php endif ?>
                    <?php if ($usr['role']!=="admin"): ?>
                      <form method="post">
                        <input type="hidden" value="<?php echo $usr['id_user'] ?>" name="id_user">
                      <button type="submit" onclick="return confirm('Yakin Hapus Data?');" class="btn btn-sm btn-danger form-control" name="hapus">
                        <i class="fa fa-trash"> Delete</i>
                      </button>
                      </form>
                    <?php endif ?>
                  </td>
                </tr>
                <?php $no++ ?>
                <!-- Modal -->
<div class="modal fade" id="exampleModal<?php echo $usr['id_user']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Admin Update</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="post">
        <div class="form-group">
          <input type="hidden" value="<?php echo $usr['id_user'] ?>" name="id_user">
          <label>Nama</label>
          <input type="text" class="form-control" value="<?php echo $usr['nama'] ?>" name="nama">
        </div>
        <div class="form-group">
          <label>Username</label>
          <input type="text" class="form-control" value="<?php echo $usr['username'] ?>" name="username">
        </div>
        <div class="form-group">
          <label>Password</label>
          <input type="text" class="form-control" required="" name="password">
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" name="edit" class="btn btn-primary">Save changes</button>
      </div>
      </form>
    </div>
  </div>
</div>
                <?php endforeach ?>
                </tbody>
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
  <footer class="main-footer">
    <div class="float-right d-none d-sm-block">
      <b>Version</b> 3.0.0-alpha
    </div>
    <strong>Copyright &copy; 2014-2018 <a href="http://adminlte.io">AdminLTE.io</a>.</strong> All rights
    reserved.
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- DataTables -->
<script src="../plugins/datatables/jquery.dataTables.min.js"></script>
<script src="../plugins/datatables/dataTables.bootstrap4.min.js"></script>
<!-- SlimScroll -->
<script src="../plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="../plugins/fastclick/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="../dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../dist/js/demo.js"></script>
<!-- page script -->
<script>
  $(function () {
    $("#example1").DataTable();
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false
    });
  });
</script>
</body>
</html>
