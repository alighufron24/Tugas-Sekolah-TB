<?php
include 'koneksi.php';

if(isset($_POST['simpan'])) {
$namabarang = $_POST['namabarang'];
$diskon = $_POST['diskon'];
$pajak = $_POST['pajak'];
$totalbayar = $_POST['totalbayar'];

$sql = "INSERT INTO detail_beli (namabarang, diskon, pajak, totalbayar) VALUES ('$namabarang', '$diskon', '$pajak', '$totalbayar')";
$query = mysqli_query($connect,$sql);

if(query) {
    header('Location: tampil.php');
}else{
    header('Location: simpan.php?status=gagal');
}
}
?>