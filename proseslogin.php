<style type="text/css">
      .alert{
        width: 40%;
        margin: 0% auto;
        top: 10px
      }
      @media screen and (max-width: 768px) {
        .alert{
        width: 90%;
        }
      }

    </style>
<link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
<?php
   session_start();
   require_once("koneksi.php");
   $email = $_POST['email'];
   $pass = $_POST['password'];
   $username= $_POST['username'];
   $sql = "SELECT * FROM user WHERE email = '$email'";
   $query = $db->query($sql);
   $hasil = $query->fetch_assoc();
   if($query->num_rows == 0) {
     echo '<div class="alert alert-danger">*Username belum terdaftar <a href="login" >Kembali</a> </div>'; 
   } else {
     if($pass <> $hasil['password']) {
       echo '<div class="alert alert-danger">*Password Salah <a href="login" >Kembali</a></div>'; 
     } else {
       $_SESSION['email'] = $hasil['email'];
       header('location:halo/');
       $_SESSION['username'] = $hasil['username'];
       header('location:halo/');
     }
   }
?>