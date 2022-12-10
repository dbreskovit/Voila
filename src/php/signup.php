<?php
    if (isset($_POST['signup'])) {

        include_once 'conexao.php';
        mysqli_set_charset($conn, "utf8");

        $name = $_POST['name'];
        $nickname = $_POST['nickname'];
        $email = $_POST['email'];
        $turma = $_POST['turma'];
        $password = $_POST['password'];
        $foto = $_FILES['foto'];

        $extensao = strtolower(substr($_FILES['foto']['name'], -4));
        $novo_nome = md5(time()) . $extensao;
        $diretorio = './img/uploads/';
        $a = move_uploaded_file($_FILES['foto']['tmp_name'], "../".$diretorio . $novo_nome);
        $foto = $diretorio . $novo_nome;

        if ($a) {
            $sql = "INSERT INTO usuarios (id, name, nickname, email, turma, password, foto) VALUES (NULL, '$name', '$nickname', '$email', '$turma', '$password', '$foto')";
            $result = mysqli_query($conn, $sql);
            if ($result) {
                echo "<script>alert('Usuário cadastrado com sucesso!');</script>";
                header("Location: ../index.php");
            } else {
                echo "<script>alert('Erro ao cadastrar Usuário!');</script>";
            }
        } else {
            echo "<script>alert('Erro ao cadastrar Usuário!');</script>";
        }
    }
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Voila | Login</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css" integrity="sha384-r4NyP46KrjDleawBgD5tp8Y7UzmLA05oM1iAEQ17CSuDqnUK2+k9luXQOfXJCJ4I" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.min.js" integrity="sha384-oesi62hOLfzrys4LxRF63OJCXdXDipiYWBnvTl9Y9/TRlw5xlKIEHpNyvvDShgf/" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="shortcut icon" href="../img/icon.png" type="image/x-icon">
</head>
<body>
    <div class="sidenav">
        <div class="login-main-text">
            <img src="../img/logo_text_white.png" width="200px">
            <p>Faça login ou registre-se aqui para acessar.</p>
        </div>
    </div>
    <div class="main">
        <div class="col-md-6 col-sm-12">
            <div class="login-form">
                <form method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <label>Nome</label>
                        <input type="text" name="name" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Usuário</label>
                        <input type="text" name="nickname" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" name="email" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Turma</label>
                        <input type="text" name="turma" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Senha</label>
                        <input type="password" name="password" class="form-control" required>
                    </div>
                    <label>Foto de Perfil</label>
                    <input type="file" name="foto" id="upload-photo" required/>
                    <br>
                    <button type="submit" name="signup" class="btn btn-grad-orange">Registrar</button>
                    <button type="submit" name="back" class="btn btn-grad-orange">Voltar</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>


<?php
    if (isset($_POST['back'])) {
        header("Location: ../index.php");
    }