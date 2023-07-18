<?php
$koneksi=mysqli_connect("localhost","root","","loker"); 

function addreg($data)
{
	global $koneksi;

	$username=$data['username'];
	$password=$data['password'];
	$role=$data['role'];

	$cek=mysqli_query($koneksi,"SELECT * FROM tb_user WHERE username='$username' AND role='$role'");
	if (mysqli_fetch_assoc($cek)) {
		 echo "<script>alert('Username Telah di Gunakan')
    </script>";
    return false;
	}

	$query=mysqli_query($koneksi,"INSERT INTO tb_user (username,password,role) VALUES ('$username','$password','$role')");
	return mysqli_affected_rows($koneksi);
}

function gambar(){

  $namaFile = $_FILES['gambar']['name'];
  $ukuranFile = $_FILES['gambar']['size'];
  $error = $_FILES['gambar']['error'];
  $tmpName = $_FILES['gambar']['tmp_name'];

$ekstensiGambarValid = ['jpg','jpeg','png'];
$ekstensiGambar = explode('.', $namaFile);
$ekstensiGambar = strtolower(end($ekstensiGambar));

if ($ukuranFile > 10000000000) {
   echo "<script>
      alert('Kapasitas Gambar terlalu besar');
    </script>" ;
    return false;
}

$namaFileBaru = uniqid();
$namaFileBaru .= '.';
$namaFileBaru .= $ekstensiGambar;

move_uploaded_file($tmpName, '../gambar/'. $namaFileBaru);

return $namaFileBaru;

}

function addloker($data)
{
	global $koneksi;

	$nama_perusahaan=$data['nama_perusahaan'];
	$posisi=$data['posisi'];
	$provinsi=$data['provinsi'];
	$email=$data['email'];
	$no_telepon=$data['no_telepon'];
	$deskripsi=$data['deskripsi'];
	$gambar=gambar();
	if (!$gambar) {
		echo "<script>
      alert('Tambahkan Gambar!');
    </script>" ;
		return false;
	}
	$id_user=$data['id_user'];

	$query=mysqli_query($koneksi,"INSERT INTO perusahaan VALUES ('','$nama_perusahaan','$posisi','$provinsi','$email','$no_telepon','$deskripsi','$gambar','$id_user')");

	return mysqli_affected_rows($koneksi);
}

function editloker($data){
  global $koneksi;

  	$id_perusahaan=$data['id_perusahaan'];
  	$nama_perusahaan=$data['nama_perusahaan'];
	$posisi=$data['posisi'];
	$provinsi=$data['provinsi'];
	$email=$data['email'];
	$no_telepon=$data['no_telepon'];
	$deskripsi=$data['deskripsi'];
  	$gambarLama = $data["gambarLama"];
// cek apakah user pilih gambar baru atau tidak
if ($_FILES['gambar']['error'] === 4) {
  $gambar = $gambarLama;
}else{
  $gambar = gambar();
}

$query=mysqli_query($koneksi,"UPDATE perusahaan SET 
		nama_perusahaan='$nama_perusahaan',
		posisi='$posisi',
		provinsi='$provinsi',
		email='$email',
		no_telepon='$no_telepon',
		deskripsi='$deskripsi',
		gambar='$gambar' WHERE id_perusahaan='$id_perusahaan'
	");
return mysqli_affected_rows($koneksi);
}


function foto(){

  $namaFile = $_FILES['gambar']['name'];
  $ukuranFile = $_FILES['gambar']['size'];
  $error = $_FILES['gambar']['error'];
  $tmpName = $_FILES['gambar']['tmp_name'];

$ekstensiGambarValid = ['jpg','jpeg','png'];
$ekstensiGambar = explode('.', $namaFile);
$ekstensiGambar = strtolower(end($ekstensiGambar));

if ($ukuranFile > 10000000000) {
   echo "<script>
      alert('Kapasitas Gambar terlalu besar');
    </script>" ;
    return false;
}

$namaFileBaru = uniqid();
$namaFileBaru .= '.';
$namaFileBaru .= $ekstensiGambar;

move_uploaded_file($tmpName, 'lte/gambar/'. $namaFileBaru);

return $namaFileBaru;

}

function addprofil($data)
{
	global $koneksi;

	$nama=$data['nama'];
	$jenis_kelamin=$data['jenis_kelamin'];
	$tempat_lahir=$data['tempat_lahir'];
	$tanggal_lahir=$data['tanggal_lahir'];
	$jurusan=$data['jurusan'];
	$instansi=$data['instansi'];
	$alamat=$data['alamat'];
	$pekerjaan=$data['pekerjaan'];
	$status_pencari=$data['status_pencari'];
	$foto=foto();
	if (!$foto) {
		echo "<script>
      alert('Tambahkan Gambar!');
    </script>" ;
		return false;
	}
	$id_user=$data['id_user'];

	$query=mysqli_query($koneksi,"INSERT INTO pencari VALUES ('','$nama','$jenis_kelamin','$tempat_lahir','$tanggal_lahir','$jurusan','$instansi','$alamat','$pekerjaan','$status_pencari','$foto','$id_user')");

	return mysqli_affected_rows($koneksi);
}

function editprofil($data)
{
	global $koneksi;

	$id_pencari=$data['id_pencari'];
	$nama=$data['nama'];
	$jenis_kelamin=$data['jenis_kelamin'];
	$tempat_lahir=$data['tempat_lahir'];
	$tanggal_lahir=$data['tanggal_lahir'];
	$jurusan=$data['jurusan'];
	$instansi=$data['instansi'];
	$alamat=$data['alamat'];
	$pekerjaan=$data['pekerjaan'];
	$status_pencari=$data['status_pencari'];
	$gambarLama = $data["gambarLama"];
	if ($_FILES['gambar']['error'] === 4) {
  $foto = $gambarLama;
}else{
  $foto = foto();
}
$id_user=$data['id_user'];
$query=mysqli_query($koneksi,"UPDATE pencari SET 
		nama='$nama',
		jenis_kelamin='$jenis_kelamin',
		tempat_lahir='$tempat_lahir',
		tanggal_lahir='$tanggal_lahir',
		jurusan='$jurusan',
		instansi='$instansi',
		alamat='$alamat',
		pekerjaan='$pekerjaan',
		status_pencari='$status_pencari',
		foto='$foto',
		id_user='$id_user' WHERE id_pencari='$id_pencari'
	");

}

function search($keyword)
{
	global $koneksi;

	$query="SELECT * FROM perusahaan WHERE nama_perusahaan 
			LIKE '%$keyword%' OR posisi LIKE '%$keyword%'
	";
	return mysqli_query($koneksi,$query);
}

?>