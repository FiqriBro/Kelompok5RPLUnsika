<?php 
session_start();

if(!isset($_SESSION['username'])){
  header('Location: index.php');
  exit;
}
else{
  $username_cookie = $_SESSION['username'];
  setcookie('permission', $username_cookie, time()+604800);
}
require 'functions.php';
$datauser = query($_SESSION['username']);

$namadepan = $datauser['col_firstname_user'];
$namabelakang = $datauser['col_lastname_user'];

$_SESSION['namadepan'] = $namadepan;
$_SESSION['namabelakang'] = $namabelakang;

// TOMBOL SIMPAN DI KLIK
if(isset($_POST['submit'])) {
  $result = inputaktivitas($_POST, $_SESSION['username']);
}

if(isset($_GET['hapus'])) {
  $result = hapus($_GET['hapus'], $_SESSION['username']);
  
}
// MENGAMBIL DATA AKTIVITAS MILIK USER
$dataaktivitas = aktivitas($_SESSION['username']);

// TOMBOL EDIT DI KLIK
if(isset($_POST['edit'])){
  $result = editdata($_GET['id'],$_SESSION['username'],$_POST);
}



 ?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
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
    </style>
    <title>ToDO - Activity</title>
  </head>
  <body>
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
                <a class="dropdown-item" href="changepass.php" >Ganti Password</a>
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
    <div class="container mt-5 pt-4">
      <div class="row">
        <div class="col-lg-7 mb-5">
          <h1 class="ml-2 mb-2">Hi, <?= $namadepan ?> !</h1>

          <!-- LIST AKTIVITAS -->
          <?php if (empty($dataaktivitas)): ?>

            <div class="list-group shadow-drop-center swing-in-top-fwd">

              <a href="todo.php?" class="list-group-item list-group-item-action">
                <div class="d-flex w-100 justify-content-between">
                  <h5 class="mb-1">Belum ada aktivitas nih</h5>
                  <small>-</small>
                </div>
                <div class="d-flex w-100 justify-content-between">
                  <p class="mb-1">Coba masukan aktivitas kamu</p>
                </div>
                <small>Semoga makin produktif!</small>
              </a>
          
          </div>

          <?php endif ?>
          <div class="list-group shadow-drop-center swing-in-top-fwd">
            <?php foreach($dataaktivitas as $aktivitas): ?>

              <a href="todo.php?id=<?=$aktivitas['col_id_activity']?>" class="list-group-item list-group-item-action">
                <div class="d-flex w-100 justify-content-between">
                  <h5 class="mb-1"><?= $aktivitas['col_name_activity'] ?></h5>
                  <small> <?= date('d F Y',strtotime($aktivitas['col_date_activity'])) ?></small>
                </div>
                <div class="d-flex w-100 justify-content-between">
                  <p class="mb-1"><?= $aktivitas['col_description_activity'] ?></p>

                  <form action="" method="get">
                  <button type="submit" class="btn btn-outline-info btn-sm ml-auto mxh" name="hapus" value=<?= $aktivitas['col_id_activity'] ?>>Selesai</button>
                  </form>
                </div>
                <small>Klik untuk edit.</small>
              </a>
          <?php endforeach; ?>
          </div>
           <!-- PENUTUP LIST -->
        </div>
        <div class="col">
          <h1 class="ml-2 mb-2">Mau ngapain?</h1>
          <div class="border rounded p-3 shadow-drop-center" style="background-color: white">



            <!-- EDIT TIDAK DI TEKAN -->
            <?php if (!isset($_GET['id'])): ?>
              <form action="" method="post">
                <div class="form-group">
                  <label for="namaaktivitas">Nama aktivitas</label>
                  <input type="text" class="form-control" id="namaaktivitas"  name="namaaktivitas" required="required">
                </div>
                <div class="form-group">
                  <label for="deskripsi">Deskrpisi</label>
                  <textarea class="form-control" id="deskripsi" name="deskripsi" rows="6"> </textarea>
                </div>
                <div class="form-group">
                  <label for="waktupelaksanaan">Waktu pelaksanaan</label>
                  <input type="date" class="form-control" name="waktupelaksanaan" required>
                  <small class="form-text text-muted">Siap jadi rajin ya !</small>
                </div>
                <button type="submit" class="btn btn-primary btn-md btn-block" name="submit">Simpan</button>
              </form>

            <!-- EDIT DITEKAN -->
            <?php else : ?>
              <?php $entrydata = edit($_GET['id'], $_SESSION['username']) ?>
              <form action="" method="post">
                <div class="form-group">
                  <label for="namaaktivitas">Nama aktivitas</label>
                  <input type="text" class="form-control" id="namaaktivitas"  name="namaaktivitas" required="required" value="<?= $entrydata['col_name_activity'] ?>" autofocus>
                </div>
                <div class="form-group">
                  <label for="deskripsi">Deskrpisi</label>
                  <textarea class="form-control" id="deskripsi" name="deskripsi" rows="6"><?= $entrydata['col_description_activity'] ?></textarea>
                </div>
                <div class="form-group">
                  <label for="waktupelaksanaan">Waktu pelaksanaan</label>
                  <input type="date" class="form-control" name="waktupelaksanaan" value="<?= $entrydata['col_date_activity'] ?>" required>
                  <small class="form-text text-muted">Siap jadi rajin ya !</small>
                </div>
                <a href="index.php" class="btn btn-danger btn-md btn-block">Batal</a>
                <button type="submit" class="btn btn-primary btn-md btn-block" name="edit">Ubah</button>
              </form>
            <?php endif ?>

            
          </div>
        </div>
      </div>
    </div>
    <br><br>
    <div class="copyright" align="center">
        <script>
            document.write('&copy;' );
            document.write(' 2021 - ');
            document.write(new Date().getFullYear());
            document.write(' KevFiq - All Rights Reserved.');
        </script>
        <br>
        <a href="https://www.instagram.com/kevinzmi/">Our Instagram</a>
    </div>
    <br>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>