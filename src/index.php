<?php
session_start();

if (isset($_SESSION['email'])) {
    echo "<meta http-equiv='refresh' content='0;url=home.php'>";
} else {
   echo '
   
      
<!DOCTYPE html>
<html lang="pt-br">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Voila | Login</title>
   <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css" integrity="sha384-r4NyP46KrjDleawBgD5tp8Y7UzmLA05oM1iAEQ17CSuDqnUK2+k9luXQOfXJCJ4I" crossorigin="anonymous">
   <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
   <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.min.js" integrity="sha384-oesi62hOLfzrys4LxRF63OJCXdXDipiYWBnvTl9Y9/TRlw5xlKIEHpNyvvDShgf/" crossorigin="anonymous"></script>
   <link rel="stylesheet" href="./css/style.css">
   <link rel="shortcut icon" href="./img/icon.png" type="image/x-icon">
</head>
<body>
   <div class="sidenav">
      <div class="login-main-text">
         <img src="./img/logo_text_white.png" width="200px">
         <p>Faça login ou registre-se aqui para acessar.</p>
      </div>
   </div>
   <div class="main">
      <div class="col-md-6 col-sm-12">
         <div class="login-form">
            <form method="POST">
               <div class="form-group">
                  <label>Email</label>
                  <input type="email" name="email" class="form-control">
               </div>
               <div class="form-group">
                  <label>Password</label>
                  <input type="password" name="password" class="form-control">
               </div>
               <br>
               <button type="submit" name="login" class="btn btn-grad-orange">Login</button>
               <button type="submit" name="signup" class="btn btn-grad-orange">Register</button>
            </form>
         </div>
      </div>
   </div>
</body>
</html>
   ';
}
?>

<?php

if (isset($_POST["login"])) {

   if (session_status() !== PHP_SESSION_ACTIVE) {
      session_start();
   }

   include './php/conexao.php';

   if (isset($_POST['email'], $_POST['password'])) {
      if (!empty($_POST['email']) && !empty($_POST['password'])) {

         $email = $_POST['email'];
         $password = $_POST['password'];

         $sql = "SELECT * FROM usuarios WHERE email = '$email' AND password = '$password'";
         $result = mysqli_query($conn, $sql);
         $row = mysqli_fetch_assoc($result);

         if ($row['email'] == $email && $row['password'] == $password) {
            $_SESSION['email'] = $email;
            $_SESSION['password'] = $password;
            $_SESSION['id'] = $row['id'];
            $_SESSION['name'] = $row['name'];
            $_SESSION['foto'] = $row['foto'];

            header("Location: home.php");
         } else {
            echo "<script>alert('Login ou senha incorretos!');</script>";
         }
      } else {
         echo "<script>alert('Preencha todos os campos!');</script>";
      }
   } else {
      echo "<script>alert('Preencha todos os campos!');</script>";
   }
}

if (isset($_POST["signup"])) {
   header("Location: ./php/signup.php");
}

?>
