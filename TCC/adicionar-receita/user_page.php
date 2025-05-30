<?php

@include 'configproduto.php';
session_start(); // Certifica-se de que a sessão foi iniciada

if((!isset($_SESSION['usuario']) == true) and (!isset($_SESSION['senha']) == true))
{
    unset($_SESSION['usuario']);
    unset($_SESSION['senha']); 
    header('Location: ../login/login.php');
}

// Verifica se o usuário está logado
if(!isset($_SESSION['user_id'])){
   // Redireciona para a página de login se não estiver logado
   header('location:login.php');
   exit;
}

// Captura o ID do usuário logado
$user_id = $_SESSION['user_id'];

if(isset($_POST['add_product'])){

   $product_name = $_POST['product_name'];
   $product_ingredientes = $_POST['product_ingredientes'];
   $product_preparo = $_POST['product_preparo'];
   $product_obs = $_POST['product_obs'];
   $product_image = $_FILES['product_image']['name'];
   $product_image_tmp_name = $_FILES['product_image']['tmp_name'];
   $product_image_folder = '../uploaded_img/'.$product_image;

   if(empty($product_name) || empty($product_ingredientes) || empty($product_preparo) || empty($product_obs) || empty($product_image)){
      $message[] = 'Por favor preencha todos os campos!';
   }else{
      // Insere o produto incluindo o ID do usuário logado (user_id)
      $insert = "INSERT INTO products(name, ingredientes, preparo, obs, image, user_id) 
                 VALUES('$product_name', '$product_ingredientes', '$product_preparo', '$product_obs', '$product_image', '$user_id')";
      $upload = mysqli_query($conn, $insert);
      if($upload){
         move_uploaded_file($product_image_tmp_name, $product_image_folder);
         $message[] = 'Novo produto adicionado com sucesso!';
      }else{
         $message[] = 'Não foi possível adicionar o produto';
      }
   }

};

// Lógica para deletar um produto
if(isset($_GET['delete'])){
   $id = $_GET['delete'];
   mysqli_query($conn, "DELETE FROM products WHERE id = $id AND user_id = '$user_id'"); // Confirma que o produto pertence ao usuário
   header('location:user_page.php');
   exit; // Adicione exit após header para garantir que o script não continue
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Administração de Receitas</title>

   <!-- Link para o Font Awesome -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

   <!-- Link para o arquivo de estilo personalizado -->
   <link rel="stylesheet" href="style.css">

</head>
<body>

<?php

if(isset($message)){
   foreach($message as $message){
      echo '<span class="message">'.$message.'</span>';
   }
}

?>

<div class="container">

   <div class="admin-product-form-container">

      <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post" enctype="multipart/form-data">
         <h3>Adicionar uma nova receita</h3>
         <input type="text" placeholder="Nome" name="product_name" class="box">
         <input type="text" placeholder="Ingredientes" name="product_ingredientes" class="box">
         <input type="text" placeholder="Modo de Preparo" name="product_preparo" class="box">
         <input type="text" placeholder="Observações" name="product_obs" class="box">
         <input type="file" accept="image/png, image/jpeg, image/jpg" name="product_image" class="box">
         <input type="submit" class="btn" name="add_product" value="Adicionar Receita">
      </form>

   </div>

   <!-- BOTÃO DE VOLTAR -->
   <div class="container_botao">
   <a href="../indexlogado.php">
      <button class="ver_mais">VOLTAR</button>
   </a>
   </div>

   <?php
   // Seleciona apenas os produtos que foram criados pelo usuário logado
   $select = mysqli_query($conn, "SELECT * FROM products WHERE user_id = '$user_id'");
   ?>
   <div class="product-display">
      <table class="product-display-table">
         <thead>
         <tr>
            <th>Imagem</th>
            <th>Nome</th>
            <th>Ingredientes</th>
            <th>Modo de Preparo</th>
            <th>Observações</th>
            <th>Editar</th>
         </tr>
         </thead>
         <?php while($row = mysqli_fetch_assoc($select)){ ?>
         <tr>
            <td><img src="../uploaded_img/<?php echo $row['image']; ?>" height="100" alt=""></td>
            <td><?php echo $row['name']; ?></td>
            <td><?php echo $row['ingredientes']; ?></td>
            <td><?php echo $row['preparo']; ?></td>
            <td><?php echo $row['obs']; ?></td>
            <td>
               <a href="user_update.php?edit=<?php echo $row['id']; ?>" class="btn"> <i class="fas fa-edit"></i> Editar </a>
               <a href="user_page.php?delete=<?php echo $row['id']; ?>" class="btn"> <i class="fas fa-trash"></i> Excluir </a>
            </td>
         </tr>
         <?php } ?>
      </table>
   </div>

</div>

</body>
</html>
