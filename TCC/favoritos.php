<?php
session_start();
include_once('config.php');

if((!isset($_SESSION['usuario']) == true) and (!isset($_SESSION['senha']) == true))
{
    unset($_SESSION['usuario']);
    unset($_SESSION['senha']); 
    header('Location: login/login.php');
}

$logado = $_SESSION['usuario'];

// Busca o ID do usuário logado
$user_query = "SELECT id FROM usuarios WHERE usuario = '$logado'";
$user_result = $conexao->query($user_query);
$user_data = $user_result->fetch_assoc();
$user_id = $user_data['id'];

if(!empty($_GET['search']))
{
    $data = $_GET['search'];
    // Modificando a consulta para buscar apenas as receitas favoritadas
    $sql = "SELECT p.* FROM products p
            JOIN favoritos f ON p.id = f.product_id
            WHERE f.user_id = '$user_id' AND (p.name LIKE '%$data%' OR p.obs LIKE '%$data%')
            ORDER BY p.name ASC";
}
else
{
    // Modificando a consulta para buscar apenas as receitas favoritadas
    $sql = "SELECT p.* FROM products p
            JOIN favoritos f ON p.id = f.product_id
            WHERE f.user_id = '$user_id'
            ORDER BY p.name ASC";
}

// Usando $conexao, conforme definido no config.php
$result = $conexao->query($sql);
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
    <link rel="stylesheet" href="favoritos.css">
</head>
<body>
<header class="header">
      <nav class="nav container">
         <div class="nav__data">
            <!-- Logotipo da empresa com um ícone -->
            <a href="favoritos.php" class="nav__logo">
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
    $nome_usuario = htmlspecialchars($logado); 
    echo "<h1>Seus <span>Favoritos</span></h1>";
    ?>
</div>

      <!--Barra de Pesquisa-->

<div class="search-container">
   <input type="search" placeholder="Pesquisar Receita" id="pesquisar">
   <button onclick="searchData()" class="search-button"><i class="fas fa-search"></i></button>
</div>

   <br>
   <br>
    
<div class="tabela">
    <table class="table">
         <thead>
            <tr>
               <th scope="col">Imagem</th>
               <th scope="col">Nome</th>
               <th scope="col">Observações</th>
               <th scope="col">Ingredientes</th>
               <th scope="col">Modo de Preparo</th>
               <th scope="col">Visualizar</th>
            </tr>
         </thead>
         <tbody>
<?php
    while($user_data = mysqli_fetch_assoc($result))
    {
        echo "<tr>";
        echo "<td><img src='uploaded_img/" . $user_data['image'] . "' alt='" . $user_data['name'] . "' width='100' height='100'></td>";
        echo "<td>".$user_data['name']."</td>";

        // Verificando se o texto é maior que 255 caracteres e cortando se necessário
        $obs = $user_data['obs'];
        if (strlen($obs) > 255) {
            $obs = substr($obs, 0, 252) . '...'; // Cortando para 252 caracteres e adicionando "..."
        }
        echo "<td>".$obs."</td>";

        // Verificando se o texto de ingredientes é maior que 255 caracteres e cortando se necessário
        $ingredientes = $user_data['ingredientes'];
        if (strlen($ingredientes) > 255) {
            $ingredientes = substr($ingredientes, 0, 252) . '...'; // Cortando para 252 caracteres e adicionando "..."
        }
        echo "<td>".$ingredientes."</td>";

        // Verificando se o texto de preparo é maior que 255 caracteres e cortando se necessário
        $preparo = $user_data['preparo'];
        if (strlen($preparo) > 255) {
            $preparo = substr($preparo, 0, 252) . '...'; // Cortando para 252 caracteres e adicionando "..."
        }
        echo "<td>".$preparo."</td>";

        echo "<td>
            <a href='receita/receitalogado.php?id=$user_data[id]' class='btn btn-sm btn-primary visualizar-btn'>
                <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-eye' viewBox='0 0 16 16'>
                    <path d='M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8M1.173 8a13 13 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5s3.879 1.168 5.168 2.457A13 13 0 0 1 14.828 8q-.086.13-.195.288c-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5s-3.879-1.168-5.168-2.457A13 13 0 0 1 1.172 8z'/>
                    <path d='M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5M4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0'/>
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
        window.location = 'favoritos.php?search='+search.value;
    }
</script>
</html>