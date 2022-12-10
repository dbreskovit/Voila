<?php
session_start();

if (!isset($_SESSION['email'])) {
   echo "<meta http-equiv='refresh' content='0;url=index.php'>";
} else {
}
?>

<!doctype html>
<html lang="pt-br">

<head>
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <title>Voila | Início</title>
   <link rel="stylesheet" href="./css/style.css">
   <link rel="shortcut icon" href="./img/icon.png" type="image/x-icon">
   <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css" integrity="sha384-r4NyP46KrjDleawBgD5tp8Y7UzmLA05oM1iAEQ17CSuDqnUK2+k9luXQOfXJCJ4I" crossorigin="anonymous">
   <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
   <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.min.js" integrity="sha384-oesi62hOLfzrys4LxRF63OJCXdXDipiYWBnvTl9Y9/TRlw5xlKIEHpNyvvDShgf/" crossorigin="anonymous"></script>

</head>

<body class="bg-light">

   <?php include 'php/header.php'; ?>

   <main class="container">
      <?php
      include 'php/conexao.php';
      mysqli_set_charset($conn, "utf8");
      $sql = "SELECT * FROM forum;";
      $result = $conn->query($sql);
      while ($row = mysqli_fetch_assoc($result)) {

         $sql2 = 'SELECT foto FROM forum INNER JOIN usuarios ON usuarios.id = forum.id_usuario WHERE usuarios.id = ' . $row['id_usuario'] . ';';
         $result2 = $conn->query($sql2);
         $row2 = mysqli_fetch_assoc($result2);

         echo '
            <a href="post.php?id='. $row['id'] .'" class="responder"><div class="d-flex align-items-center p-3 my-3 text-white-50 bg-purple rounded shadow-sm">
            <div class="box"><img class="img__profile" src="' . $row2['foto'] . '" alt="" width="48" height="48"></div>
            <div>
               <h6 class="mb-0 text-white">' . $row['titulo'] . '</h6>
               <div class="assunto">
               <small>' . $row['assunto'] . '</small>
               </div>
               </div>
            </div>
            </a>
         ';

      }
      ?>
   </main>
</body>

</html>