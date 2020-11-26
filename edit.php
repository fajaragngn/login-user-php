
  <?php
session_start();
if(!isset($_SESSION['email'])) {
   header('location:index'); 
} else { 
   $email = $_SESSION['email'];
   $username = $_SESSION['username']; 
}
$hash = md5( strtolower( trim( $email ) ) );
        $grav_url = "https://www.gravatar.com/avatar/" . $hash . "?s=&d=mp";

  //mengatasi error notice dan warning
  //error ini biasa muncul jika dijalankan di localhost, jika online tidak ada masalah
  error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
  
  //koneksi ke database
  $conn = new mysqli("localhost", "root", "root", "latihan");
  if ($conn->connect_errno) {
    echo die("Failed to connect to MySQL: " . $conn->connect_error);
  }
  
  //proses jika tombol rubah di klik
  if($_POST['submit']){
    //membuat variabel untuk menyimpan data inputan yang di isikan di form
    $password_lama      = $_POST['password_lama'];
    $password_baru      = $_POST['password_baru'];
    $konfirmasi_password  = $_POST['konfirmasi_password'];
    
    //cek dahulu ke database dengan query SELECT
    //kondisi adalah WHERE (dimana) kolom password adalah $password_lama di encrypt m5
    //encrypt -> md5($password_lama)
    $password_lama  = ($password_lama);
    $cek      = $conn->query("SELECT password FROM user WHERE password='$password_lama'");
    
    if($cek->num_rows){
      //kondisi ini jika password lama yang dimasukkan sama dengan yang ada di database
      //membuat kondisi minimal password adalah 5 karakter
      if(strlen($password_baru) >= 5){
        //jika password baru sudah 5 atau lebih, maka lanjut ke bawah
        //membuat kondisi jika password baru harus sama dengan konfirmasi password
        if($password_baru == $konfirmasi_password){
          //jika semua kondisi sudah benar, maka melakukan update kedatabase
          //query UPDATE SET password = encrypt md5 password_baru
          //kondisi WHERE id user = session id pada saat login, maka yang di ubah hanya user dengan id tersebut
          $password_baru  = ($password_baru);
          $email   = $_SESSION['email']; //ini dari session saat login
          
          $update     = $conn->query("UPDATE user SET password='$password_baru' WHERE email='$email'");
          if($update){
            //kondisi jika proses query UPDATE berhasil
            echo '<div class="alert alert-success">*Ubah password berhasil! <a href="index" >Kembali</a></div>'; 
          }else{
            //kondisi jika proses query gagal
            echo '<div class="alert alert-danger">*Gagal merubah password</div>';
          }         
        }else{
          //kondisi jika password baru beda dengan konfirmasi password
          echo '<div class="alert alert-danger">*konfirmasi password tidak cocok</div>';
        }
      }else{
        //kondisi jika password baru yang dimasukkan kurang dari 5 karakter
        echo '<div class="alert alert-secondary">*Minimal 5 karakter</div>'; 
      }
    }else{
      //kondisi jika password lama tidak cocok dengan data yang ada di database
      echo '<div class="alert alert-danger">*Password lama tidak cocok</div>'; 
    }
  }
  ?>





<html lang="en">
<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Simple login php</title>
  <meta content="" name="descriptison">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="favicon.ico" rel="icon">

  <!-- Template Main CSS File -->
  <link href="assets/css/main.css" rel="stylesheet">

</head>
<body>

  <header>
  <div>
    <a href="/">/@fajar.agngn</a>
  </div>
  <div id=theme>
      <div onclick=setDarkMode(true) id=darkBtn>
          <a>dark/</a>
        </div>
      <div onclick=setDarkMode(false) id=lightBtn class=is-hidden>
          <a>/light</a>
      </div>
    </div>
</header><br>

<h1>Hi there.</h1>

<div style="padding-left: 25px; padding-right: 25px;" class="container heroo">
    <section class="columns hero">
    <div class="judul-kelas" >
        <h3>
           <img class="" style="border-radius: 50%" width="90px" src="<?php echo $grav_url; ?>" > <small>*Ubah avatar di <a href="">gravatar.com</a></small>
           <br><br>
           <?php echo $username;?>

       </h3>
    </div>
  
    </section>
</div>

<div style="top: -40px" class="cards">
    <h2>Ubah Password</h2><br>
      <form class="form v-group-s mt10" method="POST" action="">
        <input type="hidden" name="_token" value="GpL52TtG0VYC0Co0J0m06qIJtyIrEZGMQC7lbaap">
        <input type="hidden" name="_method" value="PUT">
             
      <div class="input-wrapper ">
        <label for="password" class="label"> Password Lama</label>
        <input class="input" type="password" name="password_lama" required>    
      </div>
      <br>
        <p id="warning_password" class="warning is-hidden"></p>                   
      <div class="input-wrapper ">
        <label for="new_password" class="label"> Password baru </label>
        <input placeholder="5-20 characters long." class="input" type="password" name="password_baru" required>    
      </div><br>
      <div class="input-wrapper ">
        <label for="new_password" class="label">Konfirmasi password baru </label>
          <input class="input" type="password" name="konfirmasi_password" required>    
      </div>
      <br>
        <p id="warning_new_password" class="warning is-hidden"></p>
        <input class="button is-primary" type="submit" name="submit" value="Simpan">
      </form>     
    </div>


<small><i>Catatan: untuk memunculkan gambar silahkan daftar di gravatar terlebih dahulu melalui email yang sudah terdaftar.</small></i>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>