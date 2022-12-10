<?php



if (isset($_POST['submit'])) {
    
    include 'conexao.php';
    mysqli_set_charset($conn, "utf8");
    
    session_start();


    $id = $_POST['id']; //id do forum
    $id_usuario = $_SESSION['id']; //id do usuario
    $resposta = $_POST['resposta'];

        $sql = "INSERT INTO respostas (id_usuario, id_forum, resposta) VALUES ('$id_usuario', '$id', '$resposta')";
        $result = mysqli_query($conn, $sql);

        if ($result) {
            header("Location: ../post.php?id=$id");
            
        } else {
            header("Location: ../post.php?id=$id");
        }
    }
