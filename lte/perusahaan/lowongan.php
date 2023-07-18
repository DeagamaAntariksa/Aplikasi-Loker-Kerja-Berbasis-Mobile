<?php 
session_start();
if (!isset($_SESSION['id_user'])) {
  header("location:../login.php");
}
require '../../koneksi.php';
$loker=mysqli_query($koneksi,"SELECT * FROM perusahaan WHERE id_user='$_SESSION[id_user]'");
$cek=mysqli_fetch_assoc($loker);
if (isset($_POST['tambah'])) {
  if (addloker($_POST)>0) {
    echo "<script>
    alert('Lowongan berhasil di Tambahkan')
    document.location.href='lowongan.php'
    </script>";
  }
}
if (isset($_POST['update'])) {
  if (editloker($_POST)>0) {
    echo "<script>
    alert('Lowongan berhasil di Update')
    document.location.href='lowongan.php'
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
              <h3 class="card-title">Data Table Lowongan Kerja
                <?php if (!isset($cek)): ?>
                   <button type="button" class="btn btn-sm btn-primary pull-right" data-toggle="modal" data-target="#exampleModal">
                        + Tambah Loker
                  </button>
                <?php endif ?>
              </h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>No. </th>
                  <th>Nama Perusahaan</th>
                  <th>Posisi</th>
                  <th>Provinsi</th>
                  <th>Email</th>
                  <th>Telepon</th>
                  <th>Gambar</th>
                  <th>Deskripsi</th>
                </tr>
                </thead>
                <tbody>
                  <?php $no=1; ?>
                <?php foreach ($loker as $usr): ?>
                <tr>
                  <td><?php echo $no ?></td>
                  <td><?php echo $usr['nama_perusahaan'] ?></td>
                  <td><?php echo $usr['posisi']; ?></td>
                  <td><?php echo $usr['provinsi'] ?></td>
                  <td><?php echo $usr['email'] ?></td>
                  <td><?php echo $usr['no_telepon'] ?></td>
                  <td><img src="../gambar/<?php echo $usr['gambar'] ?>" width="100"></td>
                  <td><textarea class="form-control" rows="10"><?php echo $usr['deskripsi'] ?></textarea></td>
                  <td>
                      <button type="button" class="btn btn-sm btn-primary form-control" data-toggle="modal" data-target="#edit<?php echo $usr['id_perusahaan'] ?>">
                        Edit
                      </button>
                      <form method="post">
                        <input type="hidden" value="<?php echo $usr['id_perusahaan'] ?>" name="id_perusahaan">
                        <button class="btn btn-sm btn-danger"><i class="fa fa-trash"></i> Delete</button>
                      </form>
                  </td>
                </tr>
                <?php $no++ ?>
                  <div class="modal fade" id="edit<?php echo $usr['id_perusahaan'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambah data Lowongan Kerja</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="post" enctype="multipart/form-data">
          <div class="row">
            <div class="col-lg-6">
              <div class="form-group">
                <input type="hidden" value="<?php echo $usr['id_perusahaan'] ?>" name="id_perusahaan">
                <label>Nama Perusahaan</label>
                <input type="text" class="form-control" value="<?php echo $usr['nama_perusahaan'] ?>" name="nama_perusahaan">
              </div>
            </div>
            <div class="col-lg-6">
              <div class="form-group">
                <label>Posisi</label>
                <input type="text" class="form-control" value="<?php echo $usr['posisi'] ?>" name="posisi">
              </div>
            </div>
            <div class="col-lg-6">
              <div class="form-group">
                <label>Provinsi</label>
                <input type="text" class="form-control" value="<?php echo $usr['provinsi'] ?>" name="provinsi">
              </div>
            </div>
            <div class="col-lg-6">
              <div class="form-group">
                <label>Email</label>
                <input type="text" class="form-control" value="<?php echo $usr['email'] ?>" name="email">
              </div>
            </div>
            <div class="col-lg-5">
              <div class="form-group">
                <label>No Telepon</label>
                <input type="number" class="form-control" value="<?php echo $usr['no_telepon'] ?>" name="no_telepon">
              </div>
            </div>
            <div class="col-lg-7">
              <div class="form-group">
                <label>Deskripsi</label>
                <textarea class="form-control" rows="9" name="deskripsi"><?php echo $usr['deskripsi'] ?>"</textarea>
              </div>
            </div>
            <div class="col-12">
              <div class="form-group">
                <label>Gambar/Foto</label>
                <input type="file" class="form-control" name="gambar">
              </div>
            </div>
            <img src="../gambar/<?php echo $usr['gambar'] ?>" width="400">
            <input type="hidden" value="<?php echo $usr['gambar'] ?>" name="gambarLama">
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" name="update" class="btn btn-primary">Save changes</button>
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

  <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambah data Lowongan Kerja</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="post" enctype="multipart/form-data">
          <div class="row">
            <div class="col-lg-6">
              <div class="form-group">
                <input type="hidden" value="<?php echo $_SESSION['id_user'] ?>" name="id_user">
                <label>Nama Perusahaan</label>
                <input type="text" class="form-control"  name="nama_perusahaan">
              </div>
            </div>
            <div class="col-lg-6">
              <div class="form-group">
                <label>Posisi</label>
                <input type="text" class="form-control" name="posisi">
              </div>
            </div>
            <div class="col-lg-6">
              <div class="form-group">
                <label>Provinsi</label>
                <input type="text" class="form-control" name="provinsi">
              </div>
            </div>
            <div class="col-lg-6">
              <div class="form-group">
                <label>Email</label>
                <input type="text" class="form-control" name="email">
              </div>
            </div>
            <div class="col-lg-5">
              <div class="form-group">
                <label>No Telepon</label>
                <input type="number" class="form-control" name="no_telepon">
              </div>
            </div>
            <div class="col-lg-7">
              <div class="form-group">
                <label>Deskripsi</label>
                <textarea class="form-control" rows="9" name="deskripsi"></textarea>
              </div>
            </div>
            <div class="col-12">
              <div class="form-group">
                <label>Gambar/Foto</label>
                <input type="file" class="form-control" name="gambar">
              </div>
            </div>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" name="tambah" class="btn btn-primary">Save changes</button>
      </div>
      </form>
    </div>
  </div>
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
