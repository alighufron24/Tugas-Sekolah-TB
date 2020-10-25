<?php
include 'koneksi.php';

if(isset($_POST['simpan'])) {
$namabarang = $_POST['namabarang'];
$harga = $_POST['harga'];
$diskon = $_POST['diskon'];
$pajak = $_POST['pajak'];
$totalbayar = $_POST['totalbayar'];

$sql = "INSERT INTO detail_beli (namabarang, harga, diskon, pajak, totalbayar) VALUES ('$namabarang','$harga', '$diskon', '$pajak', '$totalbayar')";
$query = mysqli_query($connect,$sql);

if(query) {
    header('Location: tampil.php');
}else{
    header('Location: simpan.php?status=gagal');
}
}
?>