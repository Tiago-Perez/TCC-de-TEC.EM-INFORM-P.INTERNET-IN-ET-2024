<!DOCTYPE html>
<html lang="pt-br">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <!-- Link para carregar os ícones da biblioteca Remix Icons -->
   <link href="https://cdn.jsdelivr.net/npm/remixicon@3.2.0/fonts/remixicon.css" rel="stylesheet">

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

   <!-- Link para o arquivo de estilos CSS -->
   <link rel="stylesheet" href="../index.css">
   <link rel="stylesheet" href="sobre.css">
   <link rel="icon" href="../Icone.png">
   <title>Chefe em Casa</title>
</head>
<body>
   <header class="header">
      <nav class="nav container">
         <div class="nav__data">
            <!-- Logotipo da empresa com um ícone -->
            <a href="../index.php" class="nav__logo">
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
               <li><a href="../index.php" class="nav__link">Início</a></li>
               <li><a href="sobre.php" class="nav__link">Sobre</a></li>
               <li><a href="../login/login.php" class="nav__link">Adicionar Receita</a></li>
               <!-- Menu suspenso 2 -->
               <li class="dropdown__item">
                  <div class="nav__link">Usuário <i class="ri-arrow-down-s-line dropdown__arrow"></i></div>
                  <ul class="dropdown__menu">
                     <!-- Subitens do menu suspenso 2 -->
                     <li><a href="../login/login.php" class="dropdown__link"><i class="ri-star-line"></i> Favoritos</a></li>
                     <li><a href="#" class="dropdown__link" id="open-modal"><i class="ri-lock-line"></i> Política e Privacidade</a></li>
                     <li><a href="../login/login.php" class="dropdown__link"><i class="ri-user-line"></i> Login</a></li>
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
   <br>

    <!---Sobre Nós--->
    <section class="about" id="about">
        <div class="about-img">
            <img src="../sonic.jpg">
        </div>
        <div class="about-text">
            <h2>Chefe em Casa</h2>
            <p>No <strong>Chefe em Casa</strong>, acreditamos que cozinhar deve ser acessível e prazeroso para todos. Oferecemos receitas práticas, dicas e truques para transformar qualquer um em um chef na própria cozinha. Nossa missão é inspirar e facilitar a criação de pratos deliciosos, tornando cada refeição um momento especial.
            </p>
        </div>
    </section>

         <!--Botão de Voltar-->
  <br>
  <div class="container_botao">
   <a href="../index.php">
      <button class="ver_mais"  >VOLTAR</button>
   </a>
  </div>

   <!-- Script principal -->
   <script src="sobre.js"></script>
</body>
</html>
