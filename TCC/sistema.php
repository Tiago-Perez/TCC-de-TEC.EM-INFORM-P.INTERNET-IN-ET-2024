<?php
    session_start();
    include_once('config.php');
    // print_r($_SESSION);
    if((!isset($_SESSION['usuario']) == true) and (!isset($_SESSION['senha']) == true))
    {
      unset($_SESSION['usuario']);
      unset($_SESSION['senha']); 
        header('Location: login/login.php');
    }
    $logado = $_SESSION['usuario'];
    if(!empty($_GET['search']))
    {
      $data = $_GET['search'];
      $sql = "SELECT * FROM usuarios WHERE id LIKE '%$data%' or fullnome LIKE '%$data%' or usuario LIKE '%$data%' ORDER BY id DESC";
    }
    else
    {
      $sql = "SELECT * FROM usuarios ORDER BY id DESC";
    }

    // Usando $conexao, conforme definido no config.php
    $result = $conexao->query($sql);

    // Verifique se o 'id' foi passado na URL
    if(isset($_GET['id'])){
        $id = $_GET['id'];

        // Certifique-se de usar a mesma variável de conexão ($conexao)
        $query = "SELECT adm FROM usuarios WHERE id = '$id'";
        $result = mysqli_query($conexao, $query); // Alterado para $conexao

        if($result){
            $row = mysqli_fetch_assoc($result);
            $adm = $row['adm']; // Pegue o valor da coluna 'adm'

            if($adm == "Sim"){
                // Se o valor for "Sim", redireciona para a página desejada
                header('Location: sistema.php');
                exit(); // Sempre coloque exit() após um redirecionamento
            } else {
                // Caso contrário, redireciona de volta para a página anterior
                header('Location: indexlogado.php');
                exit();
            }
        } else {
            echo "Erro ao buscar o adm.";
        }
    } else {
        echo "ID não foi passado na URL.";
    }
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <!-- Link para carregar os ícones da biblioteca Remix Icons -->
   <link href="https://cdn.jsdelivr.net/npm/remixicon@3.2.0/fonts/remixicon.css" rel="stylesheet">

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

   <!-- Link para o arquivo de estilos CSS -->
   <link rel="icon" href="Icone.png">
   <title>Chefe em Casa</title>
    <link rel="stylesheet" href="sistema.css">
</head>
<body>
<header class="header">
      <nav class="nav container">
         <div class="nav__data">
            <!-- Logotipo da empresa com um ícone -->
            <a href="sistema.php" class="nav__logo">
                <i class="ri-cake-2-line"></i> 
                <span class="icon-text">Chefe em Casa</span>
            </a>
            <!-- Botão de alternância do menu -->
            <div class="nav__toggle" id="nav-toggle">
               <i class="ri-menu-line nav__burger"></i>
               <i class="ri-close-line nav__close"></i>
            </div>
         </div>
         <!-- Menu de navegação -->
         <div class="nav__menu" id="nav-menu">
            <ul class="nav__list">
               <!-- Itens do menu -->
               <li><a href="indexlogado.php" class="nav__link">Início</a></li>
               <li><a href="sobre/sobre-logado.php" class="nav__link">Sobre</a></li>
               <li><a href="adicionar-receita/admin_page.php" class="nav__link">Adicionar Receita</a></li>
               <!-- Menu suspenso 2 -->
               <li class="dropdown__item">
                  <div class="nav__link">Usuário <i class="ri-arrow-down-s-line dropdown__arrow"></i></div>
                  <ul class="dropdown__menu">
                     <!-- Subitens do menu suspenso 2 -->
                     <li><a href="favoritos.php" class="dropdown__link"><i class="ri-star-line"></i> Favoritos</a></li>
                     <li><a href="#" class="dropdown__link" id="open-modal"><i class="ri-lock-line"></i> Política e Privacidade</a></li>
                     <li><a href="sair.php" class="dropdown__link"><i class="ri-logout-box-line"></i> Sair</a></li>
                  </ul>
               </li>
            </ul>
         </div>
      </nav>
   </header>

   <!-- Modal -->
    <div id="privacy-modal" class="modal">
    <div class="modal-content">
        <span class="modal-close">&times;</span>
        <h2>Política de Privacidade</h2>
        <hr size="5">
        <br>
        <p>No <strong>Chefe em Casa</strong>, respeitamos sua privacidade e estamos comprometidos em proteger suas informações pessoais. Coletamos dados como nome e e-mail para melhorar sua experiência no site e enviar atualizações sobre novas receitas e ofertas. Não compartilhamos suas informações com terceiros, exceto quando necessário por lei ou para prestar serviços em nosso nome. Utilizamos medidas de segurança para proteger suas informações, mas nenhuma transmissão de dados é completamente segura. Você tem o direito de acessar e corrigir suas informações pessoais, e pode entrar em contato conosco pelo e-mail contato@chefeemcasa.com para quaisquer dúvidas ou solicitações. Esta política pode ser atualizada periodicamente e recomendamos que você a revise ocasionalmente.</p>

    </div>
    </div>

   <br>
   <br>
   <br>
   <br>
   <br>

   <div class="bem_vindo">
    <?php
    $nome_usuario = htmlspecialchars($logado); // Para segurança, use htmlspecialchars para escapar caracteres especiais
    echo "<h1>Olá, <span>$nome_usuario</span></h1>";
    ?>
</div>

      <!--Barra de Pesquisa-->

<div class="search-container">
   <input type="search" placeholder="Pesquisar Usuário" id="pesquisar">
   <button onclick="searchData()" class="search-button"><i class="fas fa-search"></i></button>
</div>

   <br>
   <br>
    
<div class="tabela">
    <table class="table">
         <thead>
            <tr>
               <th scope="col">Id</th>
               <th scope="col">Nome Completo</th>
               <th scope="col">Usuário</th>
               <th scope="col">Senha</th>
               <th scope="col">Admin</th>
               <th scope="col">...</th>
            </tr>
         </thead>
         <tbody>
            <?php
            while($user_data = mysqli_fetch_assoc($result))
            {
               echo "<tr>";
               echo "<td>".$user_data['id']."</td>";
               echo "<td>".$user_data['fullnome']."</td>";
               echo "<td>".$user_data['usuario']."</td>";
               echo "<td>".$user_data['senha']."</td>";
               echo "<td>".$user_data['adm']."</td>";
               echo "<td>
               <a href='edit/edit.php?id=$user_data[id]' class='btn btn-sm btn-primary'>
                  <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-pencil' viewBox='0 0 16 16'>
                     <path d='M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325'/>
                  </svg>
               </a>
               <a href='edit/delete.php?id=$user_data[id]' class='btn btn-sm btn-danger'>
                  <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-trash' viewBox='0 0 16 16'>
                   <path d='M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z'/>
                  <path d='M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z'/>
                  </svg>
               </a>

               </td>";
               echo "</tr>";
            }

            ?>
         </tbody>
      </table>
    </div>

   
   <!-- Script principal -->
   <script src="sistema.js"></script>
   </body>
<script>
    var search = document.getElementById('pesquisar');

    search.addEventListener("keydown", function(event) {
        if (event.key === "Enter")
        {
            searchData();
        }
    });

    function searchData()
    {
        window.location = 'sistema.php?search='+search.value;
    }
</script>
</html>