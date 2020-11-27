<?php
session_start();
if(!isset($_SESSION['email'])) {
   header('location:../index'); 
} else { 
   $email = $_SESSION['email'];
   $username = $_SESSION['username']; 
}
if(!isset($_SESSION['username'])) {
   header('location:../index'); 
} else { 
   $email = $_SESSION['email'];
   $username = $_SESSION['username']; 
}
$hash = md5( strtolower( trim( $email ) ) );
        $grav_url = "https://www.gravatar.com/avatar/" . $hash . "?s=&d=mp";
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
  <link href="../assets/css/main.css" rel="stylesheet">

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

<h1>Halo <?php echo $username; ?></h1>



<div class="user-button" >
    <img class="poppo drop-down" style="border-radius: 50%" width="90px" src="<?php echo $grav_url; ?>" >
    <br><br>
	<a class="user-button" href="../edit">Edit profil</a>
	<a class="user-button" href="../logout">Logout</a>
</div>

<br>

<small><i>Catatan: untuk memunculkan gambar silahkan daftar di gravatar terlebih dahulu melalui email yang sudah terdaftar.</small></i>

  <!-- Template Main JS File -->
  <script src="../assets/js/main.js"></script>

</body>

</html>