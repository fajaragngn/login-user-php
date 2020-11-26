<?php
   session_start();
   if(isset($_SESSION['username'])) {
   header('location:halo/'); }
   require_once("koneksi.php");
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

        <!-- Login Form -->
    <form class="user-button" action="proseslogin.php" method="post">
      <input type="text" id="login" class="fadeIn second" name="email" placeholder="login"><br><br>
      <input type="text" id="password" class="fadeIn third" name="password" placeholder="password"><br><br>
      <input type="submit" class="fadeIn fourth" value="login">
    </form>
    <p class="user-button" >Belum punya akun? <a href="daftar">Daftar</a></p>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>

