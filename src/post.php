<?php
session_start();

if (!isset($_SESSION['email']) and !isset($_GET['id'])) {
    echo "<meta http-equiv='refresh' content='0;url=index.php'>";
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


    <div class="modal fade" id="Modal" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ModalLabel">Responder</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- formulario de responder a pergunta -->


                    <form action="php/responder.php" method="POST" enctype="multipart/form-data">
                        <label>Resposta</label>
                        <textarea class="form-control" rows="3" name="resposta" required></textarea>
                        <br>
                        <div class="form-group">
                            <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>">
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                    <button type="submit" name="submit" class="btn btn-primary">Responder</button>
                </div>
                </form>
            </div>
        </div>
    </div>


    <?php
    if (isset($_GET['id'])) {

        $id = $_GET['id'];

        include 'php/conexao.php';
        include 'php/header.php';

        mysqli_set_charset($conn, "utf8");


        $sql = "SELECT * FROM forum WHERE id = $id";
        $result = $conn->query($sql);
        $row = mysqli_fetch_assoc($result);
        $titulo = $row['titulo'];
        $assunto = $row['assunto'];
        $imagem = $row['imagem'];
        $id_usuario = $row['id_usuario'];

        $sql = "SELECT * FROM usuarios WHERE id = $id_usuario";
        $result = $conn->query($sql);
        $row = mysqli_fetch_assoc($result);
        $nome = $row['nickname'];
        $turma = $row['turma'];
        $foto = $row['foto'];

        echo ' 
                    <div class="container">
                    <div class="row">
                        <div class="col-md-12 order-md-1">
                            <div class="secao">
                                <div class="box__user">
                                        <img src="' . $foto . '" class="img__profile">
                                        <div class="box__user--profile">
                                            <p class="box__user--nickname">' . $nome . '</p>
                                            <p class="box__user--turma">' . $turma . '</p>
                                        </div>
                                    </div>
                                    <h2>' . $titulo . '</h1>
                                        <div class="box__text">
                                            <p>' . $assunto . '</p>';
        if ($imagem != "") {
            echo '<img src="' . $imagem . '" ><br>';
        }
        echo '
                                        </div>
                                        <div>
                                            <button type="button"  data-toggle="modal" data-target="#Modal" class="btn btn-grad-orange radius">Responder</button>
                                        </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>';


        echo '
            <div class="container">
                <div class="row">
                    <div class="col-md-12 order-md-1">
                        <div class="secao_title">
                            <h1>Respostas</h1>
                        </div>
                    </div>
                </div>
            </div>
            
            ';


        $sql = "SELECT * FROM respostas WHERE id_forum = $id  ORDER BY id DESC";
        $result = $conn->query($sql);


        while ($row = mysqli_fetch_assoc($result)) {

            $id_usuario = $row['id_usuario'];
            $resposta = $row['resposta'];

            $sql2 = "SELECT * FROM usuarios WHERE id = $id_usuario ORDER BY id DESC";
            $result2 = $conn->query($sql2);
            $row2 = mysqli_fetch_assoc($result2);
            $nome = $row2['name'];
            $turma = $row2['turma'];
            $foto = $row2['foto'];

            echo ' 
                <div class="container">
                    <div class="row">
                        <div class="col-md-12 order-md-1">
                            <div class="secao_resp">
                                <div class="box__resp">
                                    <img src="' . $foto . '" class="img__profile">
                                    <div class="box__user--profile">
                                        <p class="box__user--nickname">' . $nome . '</p>
                                        <p class="box__user--turma">' . $turma . '</p>
                                    </div>
                                </div>
                                <div class="box__text">
                                    <p>' . $resposta . '</p>';
            echo '
                                </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>';
        };
    }
    ?>

</body>

</html>