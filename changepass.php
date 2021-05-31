<?php 
session_start();
$conn = mysqli_connect("localhost","root","","db_todo");
if(!isset($_SESSION['username'])){
	header('Location: index.php');
	exit;
}


require 'functions.php';
$username = $_SESSION['username']; 
$datauser = query($username);

// PROFILING
$namadepan = $datauser['col_firstname_user'];
$namabelakang = $datauser['col_lastname_user'];

if (isset($_POST['submit'])) {
  $password = $_POST['password'];
  $password1 = $_POST['password1'];
  $password2 = $_POST['password2'];
  
  if ($password1 != $password2) {
    echo "<div class='alert alert-danger role='alert'>Konfirmasikan password dengan benar!</div>";
  }else{
     $result = ambilpassword($username,$password);
  }
}

 ?>

<!doctype html>
<html lang="en">
  <head>
    
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <style type="text/css">
    	@-webkit-keyframes slide-in-left {
        0% {
          -webkit-transform: translateX(-1000px);
                  transform: translateX(-1000px);
          opacity: 0;
        }
        100% {
          -webkit-transform: translateX(0);
                  transform: translateX(0);
          opacity: 1;
        }
      }
      @keyframes slide-in-left {
        0% {
          -webkit-transform: translateX(-1000px);
                  transform: translateX(-1000px);
          opacity: 0;
        }
        100% {
          -webkit-transform: translateX(0);
                  transform: translateX(0);
          opacity: 1;
        }
      }

      @-webkit-keyframes slide-in-top {
        0% {
          -webkit-transform: translateY(-1000px);
                  transform: translateY(-1000px);
          opacity: 0;
        }
        100% {
          -webkit-transform: translateY(0);
                  transform: translateY(0);
          opacity: 1;
        }
      }
      @keyframes slide-in-top {
        0% {
          -webkit-transform: translateY(-1000px);
                  transform: translateY(-1000px);
          opacity: 0;
        }
        100% {
          -webkit-transform: translateY(0);
                  transform: translateY(0);
          opacity: 1;
        }
      }

      @-webkit-keyframes swing-in-top-fwd {
      0% {
        -webkit-transform: rotateX(-100deg);
                transform: rotateX(-100deg);
        -webkit-transform-origin: top;
                transform-origin: top;
        opacity: 0;
      }
      100% {
        -webkit-transform: rotateX(0deg);
                transform: rotateX(0deg);
        -webkit-transform-origin: top;
                transform-origin: top;
        opacity: 1;
      }
      }
      @keyframes swing-in-top-fwd {
      0% {
        -webkit-transform: rotateX(-100deg);
                transform: rotateX(-100deg);
        -webkit-transform-origin: top;
                transform-origin: top;
        opacity: 0;
      }
      100% {
        -webkit-transform: rotateX(0deg);
                transform: rotateX(0deg);
        -webkit-transform-origin: top;
                transform-origin: top;
        opacity: 1;
      }
      }

      @-webkit-keyframes shadow-drop-center {
        0% {
          -webkit-box-shadow: 0 0 0 0 rgba(0, 0, 0, 0);
                  box-shadow: 0 0 0 0 rgba(0, 0, 0, 0);
        }
        100% {
          -webkit-box-shadow: 0 0 20px 0px rgba(0, 0, 0, 0.35);
                  box-shadow: 0 0 20px 0px rgba(0, 0, 0, 0.35);
        }
        }
        @keyframes shadow-drop-center {
        0% {
          -webkit-box-shadow: 0 0 0 0 rgba(0, 0, 0, 0);
                  box-shadow: 0 0 0 0 rgba(0, 0, 0, 0);
        }
        100% {
          -webkit-box-shadow: 0 0 20px 0px rgba(0, 0, 0, 0.35);
                  box-shadow: 0 0 20px 0px rgba(0, 0, 0, 0.35);
        }
        }
      body{
        background-color: #fafafa;
        background-image: url("./media/background.svg");
        background-size: cover;
      }
      .circle {
          width: 40px;
          height: 40px;
          background-image: url("./media/icon.png");
          background-size: contain;
          background-color: white;
          border-radius: 50%
        }
        .mxh{
          max-height: 30px;
        }
        .kotak{
          border-radius: ;
        }
        .shadow-drop-center {
        -webkit-animation: shadow-drop-center 0.4s cubic-bezier(0.250, 0.460, 0.450, 0.940) both;
        animation: shadow-drop-center 0.4s cubic-bezier(0.250, 0.460, 0.450, 0.940) both;
        }
        .swing-in-top-fwd {
        -webkit-animation: swing-in-top-fwd 0.5s cubic-bezier(0.175, 0.885, 0.320, 1.275) 0.5s both;
              animation: swing-in-top-fwd 0.5s cubic-bezier(0.175, 0.885, 0.320, 1.275) 0.5s both;
        }
        .slide-in-top {
        -webkit-animation: slide-in-top 0.4s cubic-bezier(0.250, 0.460, 0.450, 0.940) both;
                animation: slide-in-top 0.4s cubic-bezier(0.250, 0.460, 0.450, 0.940) both;
        }
        .slide-in-left {
        -webkit-animation: slide-in-left 0.5s cubic-bezier(0.250, 0.460, 0.450, 0.940) both;
                animation: slide-in-left 0.5s cubic-bezier(0.250, 0.460, 0.450, 0.940) both;
      }
        .tengah{
            display: flex;
            justify-content: center;}
      .card{
        width: 350px;
      }

    </style>

    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">

    <title>Hello, world!</title>
  </head>
  <body>

  	<!-- NAVBAR -->
  	<nav class="navbar navbar-expand-lg navbar-dark bg-primary mb-5">
      <div class="container">
        <div class="circle ml-1 mr-2 slide-in-left"></div>
        <a class="navbar-brand slide-in-left" href="todo.php"><?= $namadepan . " " . $namabelakang ?></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item dropdown active mr-2">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Opsi Akun</a>
              <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                <a class="dropdown-item disabled" href="#" >Profil Saya</a>
                <a class="dropdown-item active" href="changepass.php" >Ganti Password</a>
                <a class="dropdown-item" href="logout.php">Keluar</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item disabled" href="#">Segera Datang!</a>
              </div>
            </li>
          </ul>
          <form class="form-inline my-2 my-lg-0">
            <input class="form-control mr-sm-2" type="search" placeholder="Segera Datang!" aria-label="Search" disabled>
            <button class="btn btn-outline-light my-2 my-sm-0" type="submit" disabled="">Cari!</button>
          </form>
        </div>
      </div>
    </nav>
    <!-- END NAVBAR -->


    <div class="tengah">

                <div class="card mt-5 mb-3 p-4 w-75 shadow-drop-center">
                  <div class="col" >
                    <div class="form-group  pt-2">
                        <label><h4>Ganti Password</h4></label>
                    </div>
                    <form action="" method="post">

                      <div class="form-group">
                        <label for="inputusername">Password sekarang</label>
                        <input type="password" class="form-control" id="inputusername"  name="password" required="required" autofocus>
                        
                      </div>
                      <div class="form-group">
                        <label for="InputPassword1">Password baru</label>
                        <input type="password" class="form-control" id="InputPassword1" name="password1" aria-describedby="passwordHelp" required="required" minlength="8">
                        
                      </div>
                      <div class="form-group">
                        <label for="InputPassword2">Konfirmasi password baru</label>
                        <input type="password" class="form-control" id="InputPassword2" name="password2" aria-describedby="passwordHelp" required="required" minlength="8">
                        <small id="passwordHelp" class="form-text text-muted">Rahasiakan password kamu ya :)</small>
                      </div>
                      <button type="submit" class="btn btn-primary btn-md btn-block" name="submit">Ganti</button>
                      <div class="text-center mt-4">
                        <label>Tidak jadi? </label>
                        <a href="index.php" class="text-primary">Ke halaman utama</a>
                      </div>
                    </form>
                  </div>
                </div><!-- END OF CARD -->
  

        <!-- END OF ROW 1 -->

    </div>
    <!-- END OF CONTAINER -->
    <br><br>
    <div class="copyright" align="center">
        <script>
            document.write('&copy;' );
            document.write(' 2021 - ');
            document.write(new Date().getFullYear());
            document.write(' KevFiq - All Rights Reserved.');
        </script>
    </div>
    <br>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>

   
  </body>
</html>