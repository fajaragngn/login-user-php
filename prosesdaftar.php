<?php
   require_once("koneksi.php");
   $email = $_POST['email'];
   $pass = $_POST['password'];
   $username = $_POST['username'];
   $sql = "SELECT * FROM user WHERE email = '$email' ";
   $query = $db->query($sql);
   if($query->num_rows != 0) {
     echo "<div align='center'>email Sudah Terdaftar! <a href='daftar.php'>Back</a></div>";
   } else {
     if(!$email || !$username || !$pass) {
       echo "<div align='center'>Masih ada data yang kosong! <a href='daftar.php'>Back</a>";
     } else {
       $data = "INSERT INTO user VALUES (NULL, '$email', '$username', '$pass')";
       $simpan = $db->query($data);
       if($simpan) {
         echo "<div align='center'>Pendaftaran Sukses, Silahkan <a href='index.php'>Login</a></div>";
       } else {
         echo "<div align='center'>Proses Gagal!</div>";
       }
     }
   }
?>