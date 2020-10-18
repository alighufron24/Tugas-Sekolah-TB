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
    <div class="jumbotron jumbotron-fluid">
      <div class="container">
      </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-4">
                <div class="judullist rounded text-center text-white pt-2">List Items</div>

                <div class="listkeranjang" id="listkeranjang">
                  
                </div>

                  <table width="100%">
                      <tbody>
                          <tr>
                              <td>Discount (5%)</td>
                              <td>Rp. <span id="discount"></span></td>
                          </tr>
                          <tr>
                              <td>PPN (10%)</td>
                              <td>Rp. <span id="pajak"></span></td>
                          </tr>
                          <tr class="text-white" style="background-color: #34495e;">
                              <td>Total Bayar</td>
                              <td>Rp. <span id="totalbayar"></span></td>
                          </tr>
                      </tbody>
                  </table>

                  <button type="button" class="btn btn-primary mt-3 btn-block">Bayar</button>

            </div>

            <div class="col-8" id="listproduk">
              <!-- List Produk -->
                
            </div>
        </div>
    </div>
    <table class="container table table-sm mt-3 text-center">
      <thead>
        <tr style="background-color: #34495e; color: white;">
          <th scope="col">Nama Barang</th>
          <th scope="col">Harga</th>
          <th scope="col">Dikson</th>
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
      </thead>
      <tbody id="tampildata">
        
      </tbody>
    </table>


    <script>
      var namabarang = ['Redmi 8A Pro', 'Redmi Note 7', 'Redmi Note 8', 'Redmi 9A','Redmi Note 5','Redmi Note 9']
      var hargabarang = [1500000, 3000000, 2000000, 1000000, 2000000, 3000000]
      var gambarbarang = [
        "https://d2pa5gi5n2e1an.cloudfront.net/webp/global/images/product/mobilephones/Xiaomi_Redmi_8A_Dual/Xiaomi_Redmi_8A_Dual_L_1.jpg",
        "https://images-na.ssl-images-amazon.com/images/I/71-pqefjJRL._SL1500_.jpg",
        "https://lh3.googleusercontent.com/-LWy3oADGLc0/XaHzwCV4SSI/AAAAAAAAAqk/Ht-EqPeJ0z8OTdbaxNZcDs6fHIzm55gHACLcBGAsYHQ/s1600/harga-xiaomi-redmi-note-8-pro.jpg",
        "https://d2pa5gi5n2e1an.cloudfront.net/webp/global/images/product/mobilephones/Xiaomi_Redmi_9A_th/Xiaomi_Redmi_9A_th_L_4.jpg",
        "https://d2pa5gi5n2e1an.cloudfront.net/global/images/product/mobilephones/Xiaomi_Redmi_Note_5_Pro/Xiaomi_Redmi_Note_5_Pro_L_1.jpg",
        "https://d2pa5gi5n2e1an.cloudfront.net/webp/global/images/product/mobilephones/Xiaomi_Note_9_ph/Xiaomi_Note_9_ph_L_1.jpg"
      ]

      var listproduk = document.getElementById('listproduk')

      var listkeranjang = document.getElementById('listkeranjang')
      var tampilandiscount = document.getElementById('discount')
      var tampilanpajak = document.getElementById('pajak')
      var tampilantotalbayar = document.getElementById('totalbayar')

      var namabarang_keranjang = []
      var hargabarang_keranjang = []

      function showlistproduk() {
        listproduk.innerHTML = ''
          for (let i = 0; i < namabarang.length; i++) {
            listproduk.innerHTML +='<div class="card float-left mr-3 mb-3" style="width: 12rem;">'+
                    '<img src="'+gambarbarang[i]+'"class="card-img-top" alt="Gambar" style="height: 150px;">'+
                    '<div class="card-body">'+
                      '<h5 class="card-title">'+namabarang[i]+'</h5>'+
                      '<p class="card-text">Rp. '+hargabarang[i]+'</p>'+
                      '<a href="#" class="btn btn-primary" onclick="addlistitem('+i+')">Beli</a>'+
                    '</div>'+
                  '</div>'
            
          }
      }

      function addlistitem(id) {
        namabarang_keranjang.push(namabarang[id])
        hargabarang_keranjang.push(hargabarang[id])

          showlistkeranjang()


      }

      function showlistkeranjang() {
        listkeranjang.innerHTML = ''

        var discount = 0
        var pajak = 0
        var hargatotal = 0
        var totalbayar = 0
        for (let i = 0; i < namabarang_keranjang.length; i++) {
            listkeranjang.innerHTML +='<div class="card mt-3 mb-3" style="width: 22rem;">'+
                    '<div class="card-body">'+
                      '<h5 class="card-title">'+namabarang_keranjang[i]+'</h5>'+
                      '<p class="card-text">Rp. '+hargabarang_keranjang[i]+'</p>'+
                      '<p>Qty : 1</p>'+
                      '<a href="#" class="btn btn-danger float-right" onclick="deleteitem('+i+')">Hapus</a>'+
                    '</div>'+
                  '</div>'

                  hargatotal = hargabarang_keranjang[i]+hargatotal


                  if(totalbayar>5000000){
                    discount = totalbayar*0.05
                  }else{
                    discount = 0
                  }
                  totalbayar = hargatotal-discount

                  pajak = totalbayar*0.1
                  var totalbelanja = totalbayar-pajak
                  
                  tampilanpajak.innerHTML = pajak
                  tampilandiscount.innerHTML = discount
                  tampilantotalbayar.innerHTML = totalbelanja
          }
      }

      showlistproduk()

      function deleteitem(id) {
        namabarang_keranjang.splice(id,1)
        hargabarang_keranjang.splice(id,1)

        showlistkeranjang()
      }




    </script>



    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
  </body>
</html>