
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

  <script src="assets/js/main.js"></script>

</body>

</html>

