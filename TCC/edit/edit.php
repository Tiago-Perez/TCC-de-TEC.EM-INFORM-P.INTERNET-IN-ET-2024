<?php

session_start(); // Certifica-se de que a sessão foi iniciada

if((!isset($_SESSION['usuario']) == true) and (!isset($_SESSION['senha']) == true))
{
    unset($_SESSION['usuario']);
    unset($_SESSION['senha']); 
    header('Location: ../login/login.php');
}

  if(!empty($_GET['id']))
  {

    include_once('../config.php');


    $id = $_GET['id'];
    $sqlSelect = "SELECT * FROM usuarios WHERE id=$id";
    $result = $conexao->query($sqlSelect);
    if($result->num_rows > 0)
    {
      while($user_data = mysqli_fetch_assoc($result))
      {
        $nome = $user_data['fullnome'];
        $usuario = $user_data['usuario'];
        $senha = $user_data['senha'];
        $adm = $user_data['adm'];
      }
    }
    else
    {
      header('Location: ../sistema.php');
    }

  }
  else{
    header('Location: ../sistema.php');
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
    <link rel="stylesheet" href="edit.css" />
    <title>Editar Perfil</title>

    <!---google fonts--->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

  </head>
  <body>
    <div class="container">
      <div class="card">

      <form action="saveEdit.php" method="POST">
        <fieldset>

          <h1>MEU PERFIL</h1>

        <div id="msgError"></div>
        <div id="msgSuccess"></div>

        <div class="label-float">
          <input type="text" name="nome" id="nome" placeholder=" " value="<?php echo $nome ?>" required />
          <label id="labelNome" for="nome">Nome Completo</label>
        </div>

        <div class="label-float">
          <input type="text" name="usuario" id="usuario" placeholder=" " value="<?php echo $usuario ?>" required />
          <label id="labelUsuario" for="usuario">Usuário</label>
        </div>

        <div class="label-float">
          <input type="password" name="senha" id="senha" placeholder=" " value="<?php echo $senha ?>" required />
          <label id="labelSenha" for="senha">Senha</label>
          <i id="verSenha" class="fa fa-eye" aria-hidden="true"></i>
        </div>

        <div class="label-float">
          <label id="labelAdm" for="Sim">Admin:</label>
          <input type="radio" name="adm" id="Sim" placeholder=" " value="Sim" <?php echo ($adm == 'Sim') ? 'checked' : '' ?> required />
        </div>
        <div class="label-float">
          <label id="labelAdm" for="Não">Usuário:</label>
          <input type="radio" name="adm" id="Não" placeholder=" " value="Não" <?php echo ($adm == 'Não') ? 'checked' : '' ?>  required />
        </div>

        <div class="justify-center">
          <button onclick="voltar()">VOLTAR</button>
          <button onclick="cadastrar()" type="submit" name="update" id="update">CONFIRMAR</button>
        </div>

        <input type="hidden" name="id" value="<?php echo $id ?>">
        </fieldset>

        </form>
      </div>
    </div>

    <script src="edit.js"></script>
  </body>
</html>