<?php
    @include '../configproduto.php';

    if (isset($_GET['id'])) {
        $product_id = $_GET['id'];

        $query = "SELECT * FROM `products` WHERE id = $product_id";
        $result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result) > 0) {
            $fetch_product = mysqli_fetch_assoc($result);
        } else {
            echo "Produto não encontrado.";
            exit();
        }
    } else {
        echo "ID do produto não especificado.";
        exit();
    }
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.2.0/fonts/remixicon.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="receita.css">
    <link rel="icon" href="Icone.png">
    <title>Chefe em Casa</title>
</head>
<body>
    <header class="header">
        <nav class="nav container">
           <div class="nav__data">
              <a href="../index.php" class="nav__logo">
                  <i class="ri-cake-2-line"></i> 
                  <span class="icon-text">Chefe em Casa</span>
              </a>
              <div class="nav__toggle" id="nav-toggle">
                 <i class="ri-menu-line nav__burger"></i>
                 <i class="ri-close-line nav__close"></i>
              </div>
           </div>
           <div class="nav__menu" id="nav-menu">
              <ul class="nav__list">
                 <li><a href="../index.php" class="nav__link">Início</a></li>
                 <li><a href="../sobre/sobre.php" class="nav__link">Sobre</a></li>
                 <li><a href="../login/login.php" class="nav__link">Adicionar Receita</a></li>
                 <li class="dropdown__item">
                    <div class="nav__link">Usuário <i class="ri-arrow-down-s-line dropdown__arrow"></i></div>
                    <ul class="dropdown__menu">
                       <li><a href="../login/login.php" class="dropdown__link"><i class="ri-star-line"></i> Favoritos</a></li>
                       <li><a href="../login/login.php" class="dropdown__link"><i class="ri-user-line"></i> Login</a></li>
                       <li><a href="#" class="dropdown__link"><i class="ri-lock-line"></i> Política e Privacidade</a></li>
                    </ul>
                 </li>
              </ul>
           </div>
        </nav>
     </header>
     <br>
     <br>
     <br>
     <br>
     <br>

    <!-- TELA DA RECEITA -->
    <main class="page">
        <div class="recipe-page">
          <section class="recipe-hero">
          <img src="../uploaded_img/<?php echo $fetch_product['image']; ?>" class="img recipe-hero-img" alt="<?php echo $fetch_product['name']; ?>" />
            <article class="recipe-info">
              <h2><?php echo $fetch_product['name']; ?></h2>
              <p><?php echo $fetch_product['obs']; ?></p>
            </article>
          </section>
          <br>
          <div class="buttons-container">
            <button class="btn btn-favorite">
                <span class="icon-circle"><i class="ri-heart-line"></i></span>
                Favoritar
            </button>
            <button class="btn btn-share" id="copyLinkButton">
                <span class="icon-circle"><i class="ri-share-line"></i></span>
                <script src="script.js"></script>
                Compartilhar
            </button>
          </div>

          <section class="recipe-content">
            <article>
              <h4>Modo de preparo</h4>
              <div class="single-instruction">
                <p><?php echo $fetch_product['preparo']; ?></p>
              </div>
            </article>

            <article class="second-column">
              <div>
                <h4>Ingredientes</h4>
                  <p class="single-ingredient"><?php echo $fetch_product['ingredientes']; ?></p>
              </div>
            </article>
          </section>
        </div>
          <!--Botão de Voltar-->
          <br>
          <div class="container_botao">
          <a href="../index.php">
              <button class="ver_mais"  >VOLTAR</button>
          </a>
          </div>
      </main>
</body>
</html>