

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
  <script src="assets/js/main.js"></script>

</body>

</html>

