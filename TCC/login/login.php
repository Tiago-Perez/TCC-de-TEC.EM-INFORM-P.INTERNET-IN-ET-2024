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
    <link rel="stylesheet" href="login.css" />
    <title>Login</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
  </head>
  <body>
    <div class="container">
      <div class="card">
        <h1>ENTRAR</h1>
        
        <form action="../index2.php" method="post">

          <div id="msgError"></div>

          <div class="label-float">
            <input type="text" id="usuario" name="usuario" required />
            <label id="userLabel" for="usuario">Usuário</label>
          </div>

          <div class="label-float">
            <input type="password" id="senha" name="senha" required />
            <label id="senhaLabel" for="senha">Senha</label>
            <i class="fa fa-eye" aria-hidden="true"></i>
          </div>

          <div class="justify-center">
            <button type="button" onclick="voltar()">VOLTAR</button>
            <button onclick="entrar()" type="submit" name="submit" id="send">ENTRAR</button>
          </div>

        </form>

        <div class="justify-center">
          <hr />
        </div>

        <p>
          Não tem uma conta?
          <a href="../cadastro/cadastrar.php">
            Cadastre-se
          </a>
        </p>
      </div>
    </div>
    
    <script src="login.js"></script>
  </body>
</html>
