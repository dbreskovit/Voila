<?php
session_start();

if (!isset($_SESSION['email'])) {
    echo "<meta http-equiv='refresh' content='0;url=index.php'>";
} 
?>
<!doctype html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Voila | Perguntar</title>
    <link rel="stylesheet" href="./css/style.css">
    <link rel="shortcut icon" href="./img/icon.png" type="image/x-icon">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css" integrity="sha384-r4NyP46KrjDleawBgD5tp8Y7UzmLA05oM1iAEQ17CSuDqnUK2+k9luXQOfXJCJ4I" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.min.js" integrity="sha384-oesi62hOLfzrys4LxRF63OJCXdXDipiYWBnvTl9Y9/TRlw5xlKIEHpNyvvDShgf/" crossorigin="anonymous"></script>

</head>

<body class="bg-light">

    <?php include 'php/header.php'; ?>

    <div class="container">
        <div class="py-5 text-center">
            <h2>Perguntar</h2>
            <p class="lead">Pergunte sobre qualquer coisa e <br> receba respostas de pessoas que sabem.</p>
        </div>
        <div class="row">
            <div class="col-md-12 order-md-1">
                <div class="perguntar__forms">
                    <form enctype="multipart/form-data" method="POST">
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <label for="titulo">Titulo</label>
                                <input name="titulo" type="text" class="form-control" id="titulo" placeholder="Titulo da pergunta" value="" required autocomplete="off">
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="assunto">Assunto</label>
                            <textarea class="form-control" name="assunto" id="assunto" placeholder="Escreva aqui sua pergunta" autocomplete="off"></textarea>
                        </div>

                        <div class="mb-3">
                            <label for="upload-photo">Imagem</label>
                            <input type="file" class="form-control" id="imagem" name="imagem" placeholder="Escolha uma imagem">
                        </div>

                        <hr class="mb-4">
                        <button class="btn btn-grad-orange btn-lg btn-block" type="submit" name="submit">Enviar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>


<?php
#cadastrar imagem do formulario no banco de dados
if (isset($_POST['submit'])) {

    include 'php/conexao.php';
    mysqli_set_charset($conn, "utf8");


    $titulo = $_POST['titulo'];
    $assunto = $_POST['assunto'];


    if (isset($_FILES['imagem']) && $_FILES['imagem']['error'] == 0) {
        $imagem = $_FILES['imagem'];
        $nome = $imagem['name'];
        $tmp = $imagem['tmp_name'];
        $extensao = pathinfo($nome, PATHINFO_EXTENSION);
        $novo_nome = md5(time()) . "." . $extensao;
        $diretorio = "img/uploads/";
        move_uploaded_file($tmp, $diretorio . $novo_nome);

        $sql = "INSERT INTO forum (id, titulo, assunto, imagem, id_usuario) VALUES (NULL, '$titulo', '$assunto', '$novo_nome', " . $_SESSION['id'] . ")";
        $query = mysqli_query($conn, $sql);
    } else {
        $sql = "INSERT INTO forum (id, titulo, assunto, id_usuario) VALUES (NULL, '$titulo', '$assunto', " . $_SESSION['id'] . ")";
        $query = mysqli_query($conn, $sql);
    }
    if ($query) {
        echo "<meta http-equiv='refresh' content='0;url=home.php?msg=1'>";
    } else {
        echo "<script>alert('Erro ao enviar pergunta!');</script>";
    }
}


?>