<?php

  if(isset($_POST['submit']))
  {
    include_once('../config.php');

    $nome = $_POST['nome'];
    $usuario = $_POST['usuario'];
    $senha = $_POST['senha'];
    $confirmsenha = $_POST['confirmSenha'];

    if ($senha == $confirmsenha){
      $result = mysqli_query($conexao, "INSERT INTO usuarios(fullnome,usuario,senha) VALUES ('$nome','$usuario','$senha')");
      header('Location: ../login/login.php');
    }
  }
?>


<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link
      rel="stylesheet"
      href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"
    />
    <link rel="icon" href="img/tenis.png">
    <link rel="stylesheet" href="cadastrar.css" />
    <title>Cadastro</title>

    <!---google fonts--->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

  </head>
  <body>
    <div class="container">
      <div class="card">

      <form action="cadastrar.php" method="POST">

        <h1>CADASTRAR</h1>

        <div id="msgError"></div>
        <div id="msgSuccess"></div>

        <div class="label-float">
          <input type="text" name="nome" id="nome" placeholder=" " required />
          <label id="labelNome" for="nome">Nome Completo</label>
        </div>

        <div class="label-float">
          <input type="text" name="usuario" id="usuario" placeholder=" " required />
          <label id="labelUsuario" for="usuario">Usuário</label>
        </div>

        <div class="label-float">
          <input type="password" name="senha" id="senha" placeholder=" " required />
          <label id="labelSenha" for="senha">Senha</label>
          <i id="verSenha" class="fa fa-eye" aria-hidden="true"></i>
        </div>

        <div class="label-float">
          <input type="password" name="confirmSenha" id="confirmSenha" placeholder=" " required />
          <label id="labelConfirmSenha" for="confirmSenha">Confirmar Senha</label>
          
          <i id="verConfirmSenha" class="fa fa-eye" aria-hidden="true"></i>
        </div>

        <div class="justify-center">
          <button onclick="voltar()">VOLTAR</button>
          <button onclick="cadastrar()" type="submit" name="submit" id="submit">CADASTAR</button>
        </div>
        <br>
        <p>
          Já tem uma conta?
          <a href="../login/login.php">
            Entre
          </a>
        </p>
        </form>
      </div>
    </div>

    <script src="cadastrar.js"></script>
  </body>
</html>