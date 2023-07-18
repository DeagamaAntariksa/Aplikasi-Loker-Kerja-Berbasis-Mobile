<?php 
session_start();
if (!isset($_SESSION['id_user'])) {
  header("location:lte/login.php");
}
require 'koneksi.php';

$loker=mysqli_query($koneksi,"SELECT * FROM perusahaan"); 

if (isset($_GET["cariloker"])) {
  $loker = search($_GET["keyword"]);
  if (empty($loker)) {
  echo "<script>alert('NO')</script>";
}
}

?>
<!DOCTYPE html>
<html>
<head>
    <title>HOME</title>
    <link rel="stylesheet" type="text/css" href="style1.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
</head>
<body>
    <div class="container">
       <header>
        <div class="logo">
           <div class="header">
            <i><h1>SELAMAT DATANG</h1></i>
            <i><h1>LOKER 19</h1></i>
           </div>

       </header>
       <nav>
            <ul>
                <li><a href="home.php">HOME</a></li>
                <li><a href="about.html">ABOUT US</a></li>
                <li><a href="my_profile_pekerja.php">MY PROFILE</a></li>
                <li><a href="logout.php">LOGOUT</a></li>
                <body>         
                    <form method="GET">               
                    <p style="text-align: right;"><input name="keyword" type="text" placeholder="Search...">               
                    <input type="submit" name="cariloker" value="Search"></p>       
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
                <h1><p style="text-align: center;" >
                  <?php if (isset($nul)): ?>
                    LOWONGAN KERJA TERBARU
                  <?php endif ?>
                </p></h1>
            </div>
        </nav>
       <article>
        <?php foreach ($loker as $lk): ?>
           <div class="konten">
            <a><img src="lte/gambar/<?php echo $lk['gambar']; ?>" width="200"></a>
            <div class="judul">
                <p style="text-align: center;"><?php echo $lk['nama_perusahaan'] ?></p>
            </div>
            <p>Provinsi : <?php echo $lk['provinsi'] ?></p>
           <p>Posisi yang di Butuhkan : <?php echo $lk['posisi'] ?></p>
           <p>Telepon : <?php echo $lk['no_telepon'] ?></p>
           <p><?php echo $lk['deskripsi'] ?></p>
           <p>
             Kirim Lamaran Anda: <a target="_blank" href="http://mailto:<?php echo $lk['email'] ?>"><?php echo $lk['email'] ?></a>
           </p>
           </div>
           <?php endforeach ?>
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