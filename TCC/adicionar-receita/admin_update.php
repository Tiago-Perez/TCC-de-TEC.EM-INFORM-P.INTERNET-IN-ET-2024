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

$id = $_GET['edit'];

if(isset($_POST['update_product'])){

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

      $update_data = "UPDATE products SET name='$product_name', ingredientes='$product_ingredientes', preparo='$product_preparo', obs='$product_obs', image='$product_image'  WHERE id = '$id'";
      $upload = mysqli_query($conn, $update_data);

      if($upload){
         move_uploaded_file($product_image_tmp_name, $product_image_folder);
         header('location:admin_page.php');
      }else{
         $message[] = 'Erro ao atualizar!'; 
      }

   }
};

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link rel="stylesheet" href="adicionar.css">
</head>
<body>

<?php
   if(isset($message)){
      foreach($message as $msg){
         echo '<span class="message">'.$msg.'</span>';
      }
   }
?>

<div class="container">

<div class="card">
   
   <div class="admin-product-form-container centered">

      <?php
         
         $select = mysqli_query($conn, "SELECT * FROM products WHERE id = '$id'");
         while($row = mysqli_fetch_assoc($select)){

      ?>
      
      <form action="" method="post" enctype="multipart/form-data">

         <h1>ALTERAR RECEITA</h1>

         <div class="label-float">
            <input type="text" name="product_name" value="<?php echo $row['name']; ?>" placeholder="">
            <label id="labelNome" for="nome">Nome do produto</label>
         </div>

         <div class="label-float">
            <input type="text" name="product_ingredientes" value="<?php echo $row['ingredientes']; ?>" placeholder=" ">
            <label id="labelNome" for="nome">Ingredientes</label>
         </div>

         <div class="label-float">
            <input type="text" name="product_preparo" value="<?php echo $row['preparo']; ?>" placeholder=" ">
            <label id="labelNome" for="nome">Modo de preparo</label>
         </div>

         <div class="label-float">
            <input type="text" name="product_obs" value="<?php echo $row['obs']; ?>" placeholder=" ">
            <label id="labelNome" for="nome">Observações</label>
         </div>

         <div class="label-float">
            <input type="file" class="box" name="product_image" accept="image/png, image/jpeg, image/jpg">
         </div>

         <div class="justify-center">
            <button type="submit" name="update_product" class="btn">ALTERAR</button>
            <button><a href="admin_page.php" class="btn">VOLTAR</a></button>
         </div>

      </form>
      <?php }; ?>

   </div>

</div>

</div>

</body>
</html>
