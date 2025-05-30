<?php
    session_start();

    if(isset($_POST['submit']) && !empty($_POST['usuario']) && !empty($_POST['senha'])) {
        // acessar
        include_once('config.php');
        $usuario = $_POST['usuario'];
        $senha = $_POST['senha'];

        // Consulta SQL para verificar se o usuário e a senha estão corretos
        $sql = "SELECT * FROM usuarios WHERE usuario = '$usuario' AND senha = '$senha'";
        $result = $conexao->query($sql);

        if(mysqli_num_rows($result) < 1) {
            // Se o login falhar, limpa as sessões e redireciona para a página de login
            unset($_SESSION['usuario']);
            unset($_SESSION['senha']);
            header('Location: login/login.php');
        } else {
            // Captura o ID do usuário e armazena na sessão
            $row = mysqli_fetch_assoc($result);
            $_SESSION['usuario'] = $usuario;
            $_SESSION['senha'] = $senha;
            $_SESSION['user_id'] = $row['id']; // Armazena o ID do usuário na sessão
            
            // Redireciona para a página de início logado
            header('Location: indexlogado.php');
        }
    } else {
        // Se não foi enviado o formulário corretamente, redireciona para a página de login
        header('Location: login/login.php');
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Bem vindo</h1>
    <button>
        <a href="login/login.php">Deslogar</a>
    </button>
</body>
</html>