<?php
session_start();

if(isset($_SESSION['username'])){
  header('Location: todo.php');
  exit;
}

require 'functions.php';
 ?>
<!doctype html>
<html lang="en">
  <head>
    
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <style type="text/css">
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
        .card{
            min-width: 30vw;
        }
        .container{
            display: flex;
            justify-content: center;
        }
        .circle {
          width: 90px;
          height: 90px;
          background-image: url("./media/icon.png");
          background-size: contain;
          background-color:white;
          border-radius: 50%
        }
        .shadow-drop-center {
        -webkit-animation: shadow-drop-center 0.4s cubic-bezier(0.250, 0.460, 0.450, 0.940) both;
        animation: shadow-drop-center 0.4s cubic-bezier(0.250, 0.460, 0.450, 0.940) both;
        }
    </style>

    <title>ToDo! - Daftar</title>
  </head>
  <body>
    <div class="container mt-5">
        <div class="circle border shadow-drop-center">
                    
        </div>
    </div>
    <!-- END OF CONTAINER -->

    <div class="container">

        <div class="row">
            <div class="col">
            <div class="main">
                <div class="card mt-5 mb-3 p-4 shadow-drop-center">
                    <div class="form-group  pt-2">
                        <label><h4>Daftar</h4></label>
                    </div>
                    

                    <!-- Kalautombol submit sudah dipencet -->
                    <?php 
                    
                    if(isset($_POST['submit'])){
                        $result = daftar($_POST);
                    }




                     ?>
                    
                    <form action="" method="post">
                      <!-- USERNAME -->
                      <div class="form-group">
                        <label for="inputusername">Username</label>
                        <input type="text" class="form-control" id="inputusername"  name="username" required="required" autocomplete="off" autofocus>
                      </div>
                      <!-- NAMADEPAN BELAKANG -->
                      <div class="form-group">
                        <table>
                          <tr>
                            <td><label for="namadepan">Nama Depan</label>
                            <input type="text" class="form-control" id="namadepan" name="namadepan" required="required"></td>
                            <td><label for="namabelakang">Nama Belakang</label>
                            <input type="text" class="form-control" id="namabelakang" name="namabelakang" required="required"></td>
                          </tr>
                        </table>
                      </div>
                      <!-- PASSWORD -->
                      <div class="form-group">
                        <label for="Password1">Password</label>
                        <input type="password" class="form-control" id="Password1" name="password1" aria-describedby="passwordHelp" required="required" minlength="8">
                      </div>
                      <div class="form-group">
                        <label for="Password2">Konfirmasi Password</label>
                        <input type="password" class="form-control" id="Password2" name="password2" aria-describedby="passwordHelp" required="required">
                        <small id="passwordHelp" class="form-text text-muted">Rahasiakan password kamu ya :)</small>
                      </div>
                      <!-- SIAP JADI PRODUKTIF -->
                      <div class="form-group form-check">
                        <input type="checkbox" class="form-check-input" checked required>
                        <label class="form-check-label">Saya siap jadi produktif!</label>
                      </div>
                      <!-- THEBUTTON -->
                      <button type="submit" class="btn btn-primary btn-md btn-block" name="submit">Daftar</button>
                      <div class="text-center mt-4">
                        <!-- UDAH PUNYA AKUN -->
                        <label>Sudah punya akun?</label>
                        <a href="index.php" class="text-primary">Masuk</a>
                      </div>

                    </form>
                </div><!-- END OF CARD -->
            </div>   
            </div>
        </div>
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

