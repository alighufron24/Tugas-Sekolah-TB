<?php
include 'koneksi.php';
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">

    <title>Tugas Akhir</title>
    <style>
      .jumbotron{
        background-image: url(http://i01.appmifile.com/webfile/globalimg/Mandy/20200407145629.jpg);
        background-size: cover;
        height: 400px;
        background-position-y: -360px;

      }
      .judullist{
        background-color: #34495e;
        height: 50px;
        font-family: fantasy;
        font-size: 23px;
      }
    </style>

  </head>
  <body>
    
    <table class="container table table-sm mt-3 text-center">
        <tr style="background-color: #34495e; color: white;">
          <th scope="col">Nama Barang</th>
          <th scope="col">Harga</th>
          <th scope="col">Diskon</th>
          <th scope="col">Pajak</th>
          <th scope="col">Total Bayar</th>
        </tr>

        <?php

        $sql = "SELECT * FROM detail_beli";
        $query = mysqli_query($connect,$sql);

        while($detail_beli = mysqli_fetch_array($query)){
            echo "<tr>";

            echo "<td>".$detail_beli['namabarang']."</td>";
            echo "<td>".$detail_beli['harga']."</td>";
            echo "<td>".$detail_beli['diskon']."</td>";
            echo "<td>".$detail_beli['pajak']."</td>";
            echo "<td>".$detail_beli['totalbayar']."</td>";

            echo "</tr>";
        }
        ?>

    


    



    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
  </body>