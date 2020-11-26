
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Edit profile</title>
  <!-- Template Main CSS File -->
  <link href="assets/css/ubah-pw.css" rel="stylesheet">
  <!-- Favicons -->
  <link href="favicon.ico" rel="icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/icofont/icofont.min.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="assets/vendor/owl.carousel/assets/owl.carousel.min.css" rel="stylesheet">
  <link href="assets/vendor/animate.css/animate.min.css" rel="stylesheet">
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">
  <link href="assets/css/app.css" rel="stylesheet">
  <link href="assets/css/style2.css" rel="stylesheet">
<head>
<body>
  
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
  <nav class="navbar navbar-expand-lg navbar-light fixed-top">
  <div  class="container h" >

  <a class="navbar-brand" href="index"><img width="60px" src="assets/img/front/logo.png" ></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarText">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item">
        <a class="nav-link" href="kelas">Kelas <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="blog">Blog</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="forum">Forum</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="podcast">Podcast</a>
      </li>
    </ul>

    <div id=theme>
              <div onclick=setDarkMode(true) id=darkBtn>Dark mode</div>
            <div onclick=setDarkMode(false) id=lightBtn class=is-hidden><a>Light mode</a>
            </div>
          </div>
    </div>
  <span class="navbar-text">
      <div class="nav-item dropdown">
        <a class="nav-link" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" >
          <img class="poppo drop-down" style="border-radius: 50%" width="45px" src="<?php echo $grav_url; ?>" >
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
              <a class="dropdown-item" href="edit">Edit profil</a>
              <a class="dropdown-item" href="logout">Logout</a>
          </div>
        </div>
    </span>
</nav>
<style type="text/css">
.navbar {
  background: #f9faf9;
  box-shadow: 0px 0 18px rgba(55, 66, 59, 0.08);
}
.darkmode .navbar{
  background: #2C2C2C;
  box-shadow: 0px 0 18px #2C2C2C;
}
.darkmode .nav-item .nav-link{
  color: #fff
}
.h{
  width: 75%
}
.darkmode .navbar-toggler{
  background: #353535
}

@media screen and (max-width: 768px) {
  .h{
    width: 100%
  }
}
</style>
  
  <!-- mulai form rubah password -->
  <div class="lebar">

  <main>
    <style type="text/css">
      .alert{
        width: 40%;
        margin: 0% auto;

        top: 100px

      }
    </style>
<br><br>
<div style="padding-left: 25px; padding-right: 25px;" class="container heroo">
    <section class="columns hero">
    <div class="judul-kelas" >
        <h3>
           <img style=" width: 90px" width="130px" src="<?php echo $grav_url; ?>" > &emsp;
           <?php echo $username;?>
           <br>
          <small>*Ubah avatar di <a href="">gravatar.com</a></small><br><br>
            
       </h3>
    </div>
  
    </section>
</div>


<!--div style="top: -40px" class="cards">
    <h2>Username</h2>
      <form class="form v-group-s mt10" method="POST" action="">
        <input type="hidden" name="_token" value="GpL52TtG0VYC0Co0J0m06qIJtyIrEZGMQC7lbaap">
        <input type="hidden" name="_method" value="PUT">
             
      <div class="input-wrapper ">
        <label for="password" class="label"> Username baru</label>
        <input class="input" type="password" name="password_lama" required>
                
      </div>
        <p id="warning_password" class="warning is-hidden"></p>                   
      
        <p id="warning_new_password" class="warning is-hidden"></p>
        <input class="button is-primary" type="submit" name="submit" value="Simpan">
      </form>     
    </div-->

  <div style="top: -40px" class="cards">
    <h2>Ubah Password</h2><br>
      <form class="form v-group-s mt10" method="POST" action="">
        <input type="hidden" name="_token" value="GpL52TtG0VYC0Co0J0m06qIJtyIrEZGMQC7lbaap">
        <input type="hidden" name="_method" value="PUT">
             
      <div class="input-wrapper ">
        <label for="password" class="label"> Password Lama</label>
        <input class="input" type="password" name="password_lama" required>
                
      </div>
        <p id="warning_password" class="warning is-hidden"></p>                   
      <div class="input-wrapper ">
        <label for="new_password" class="label"> Password baru </label>
        <input placeholder="5-20 characters long." class="input" type="password" name="password_baru" required>    
      </div>
      <div class="input-wrapper ">
        <label for="new_password" class="label">Konfirmasi password baru </label>
          <input class="input" type="password" name="konfirmasi_password" required>    
      </div>
        <p id="warning_new_password" class="warning is-hidden"></p>
        <input class="button is-primary" type="submit" name="submit" value="Simpan">
      </form>     
    </div>

  <!-- selesai form rubah password -->
  <script type="text/javascript">
  //check localstorage
  if(localStorage.getItem('preferredTheme') == 'dark') {
      setDarkMode(true)
  }

  function setDarkMode(isDark) {
      var darkBtn = document.getElementById('darkBtn')
      var lightBtn = document.getElementById('lightBtn')

      if(isDark) {
          lightBtn.style.display = "block"
          darkBtn.style.display = "none"
          localStorage.setItem('preferredTheme', 'dark');
      } else {
          lightBtn.style.display = "none"
          darkBtn.style.display = "block"
          localStorage.removeItem('preferredTheme');
      }

      document.body.classList.toggle("darkmode");
  }
</script>
<!-- Vendor JS Files -->
  <script src="assets/vendor/jquery/jquery.min.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/jquery.easing/jquery.easing.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>
  <script src="assets/vendor/waypoints/jquery.waypoints.min.js"></script>
  <script src="assets/vendor/counterup/counterup.min.js"></script>
  <script src="assets/vendor/owl.carousel/owl.carousel.min.js"></script>
  <script src="assets/vendor/aos/aos.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>
<br><br>
</body>
</html>