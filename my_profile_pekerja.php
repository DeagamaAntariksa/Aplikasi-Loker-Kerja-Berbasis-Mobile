<?php 
session_start();
if (!isset($_SESSION['id_user'])) {
  header("location:lte/login.php");
}
require 'koneksi.php';

$profil=mysqli_query($koneksi,"SELECT * FROM pencari WHERE id_user='$_SESSION[id_user]'");
$cek=mysqli_fetch_assoc($profil);

if (isset($_POST['add'])) {
  if (addprofil($_POST)>0) {
    echo "<script>alert('Berhasil Edit Data')
    document.location.href='my_profile_pekerja.php'
    </script>";
  }
}
if (isset($_POST['edit'])) {
  if (editprofil($_POST)>0) {
    echo "<script>alert('Berhasil Edit Data')
    document.location.href='my_profile_pekerja.php'
    </script>";
  }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>MY PROFILE</title>
    <link rel="stylesheet" type="text/css" href="style2.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
</head>
<body>
    <div class="container">
       <header>
           <div class="logo">
            <div class="header">
                <i><h1>LOKER 19</h1></i>
                <i><h1>PROFILE</h1></i>
            </div>

       </header>
       <nav>
            <ul>
                <li><a href="home.php">HOME</a></li>
                <li><a href="about.html">ABOUT US</a></li>
                <li><a href="my_profile_pekerja.php">MY PROFILE</a></li>
                <li><a href="logout.php">LOGOUT</a></li>
                <body>         
                    <form>               
                    <p style="text-align: right;"><input class="search" type="search" placeholder="Search...">               
                    <input class="button" type="submit" value="Search"></p>       
                    </form>     
                    </body>
                    <!-- <ul id="myUL">
                        <li><a href="usaha.html">USAHA</a></li>
                        <li><a href="perusahaan.html">PERUSAHAAN</a></li>
                        <li><a href="autlet.html">OUTLET</a></li>
                        <li><a href="job.html">JOB</a></li>
                      </ul> -->
            </ul>
            <div class="headerbaru">
                <h1><p style="text-align: center;" >MY PROFILE</p></h1>
            </div>
        </nav>
       <article>
           <div class="konten">
            <a></a>
            <div class="judul"></div>
                <p>Nama</p>
            <p>Jenis Kelamin</p>
           <p>Tempat lahir</p>
           <p>Tanggal lahir</p>
           <p>Jurusan</p>
           <p>Instansi</p>
           <p>Alamat</p>
           <p>Pekerjaan</p>
           <p>Status</p>
           <p>Foto</p>
           </div>

           <div class="konten">
            <a></a>
            <div class="judul">
              <?php if (isset($cek)): ?>
                <?php foreach ($profil as $prf): ?>
            <form method="post" enctype="multipart/form-data">
              <input type="hidden" value="<?php echo $prf['foto'] ?>" name="gambarLama">
              <input type="hidden" value="<?php echo $prf['id_pencari'] ?>" name="id_pencari">
            <p><input type="text" style="border: none;" value="<?php echo $prf['nama'] ?>" name="nama"></p></div>
            <p><select name="jenis_kelamin" style="border: none;">
              <option>Laki-Laki</option>
              <option>Perempuan</option>
            </select></p>
            <p><input type="text" style="border: none;" value="<?php echo $prf['tempat_lahir'] ?>" name="tempat_lahir"></p>
            <p><input type="date" style="border: none;" value="<?php echo $prf['tanggal_lahir'] ?>" name="tanggal_lahir"></p>
            <p><input type="text" style="border: none;" value="<?php echo $prf['jurusan'] ?>" name="jurusan"></p>
            <p><input type="text" style="border: none;" value="<?php echo $prf['instansi'] ?>" name="instansi"></p>
            <p><input type="text" style="border: none;" value="<?php echo $prf['alamat'] ?>" name="alamat"></p>
            <p><input type="text" style="border: none;" value="<?php echo $prf['pekerjaan'] ?>" name="pekerjaan"></p>
            <p><input type="text" style="border: none;" value="<?php echo $prf['status_pencari'] ?>" name="status_pencari"></p>
            <p><input type="file" name="gambar"></p><input type="hidden" name="id_user" value="<?php echo $prf['id_user'] ?>">
            <p><button type="submit" name="edit">Tambahkan</button></p>
            </form>
           <?php endforeach ?>
              <?php endif ?>
              <?php if (!isset($cek)): ?>
                  <form method="post" enctype="multipart/form-data">
            <p><input type="text" name="nama"></p></div>
            <p><select name="jenis_kelamin">
              <option>Laki-Laki</option>
              <option>Perempuan</option>
            </select></p>
            <p><input type="text" name="tempat_lahir"></p>
            <p><input type="date" name="tanggal_lahir"></p>
            <p><input type="text" name="jurusan"></p>
            <p><input type="text" name="instansi"></p>
            <p><input type="text" name="alamat"></p>
            <p><input type="text" name="pekerjaan"></p>
            <p><input type="text" name="status_pencari"></p>
            <p><input type="file" name="gambar"></p><input type="hidden" name="id_user" value="<?php echo $_SESSION['id_user'] ?>">
            <p><button type="submit" name="add">Tambahkan</button></p>
            </form>
              <?php endif ?>
            </div>

            <?php if (!isset($cek)): ?>
              <div class="konten">
                <a><img src="Lalu Diky Febryan.jpg" ></a>
                <div class="judul">
                    <p style="text-align: center;"></p>
                </div>
            </div>
            <?php endif ?>
            <?php if (isset($cek)): ?>
              <div class="konten">
                <a><img src="lte/gambar/<?php echo $cek['foto'] ?>" ></a>
                <div class="judul">
                    <p style="text-align: center;"></p>
                </div>
            </div>
            <?php endif ?>
      </article>
  
       <footer>
        <p><u>copyright 2021 </u></p>

        <p>LOKER 19</p>
       </footer>
    </div>
</body>
<script>
    function toLocation(location){
        // alert(location)
        window.location.href=`${location}`
    }
</script>
</html>