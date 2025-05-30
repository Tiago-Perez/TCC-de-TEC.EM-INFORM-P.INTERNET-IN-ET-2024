<?php
// Incluir o arquivo de conexão
@include 'config.php'; // Certifique-se de que o caminho para o arquivo de conexão está correto

// Verificar se os dados foram enviados pelo formulário
if (isset($_POST['user_id']) && isset($_POST['recipe_id'])) {
    $user_id = $_POST['user_id'];
    $recipe_id = $_POST['recipe_id'];

    // Verificar se a conexão com o banco de dados foi estabelecida
    if ($conn) {
        // Verificar se a receita já está nos favoritos do usuário
        $check_fav = "SELECT * FROM favoritos WHERE user_id = '$user_id' AND recipe_id = '$recipe_id'";
        $result = mysqli_query($conn, $check_fav);

        if (mysqli_num_rows($result) > 0) {
            // Se já está favoritado, remover dos favoritos
            $delete_fav = "DELETE FROM favoritos WHERE user_id = '$user_id' AND recipe_id = '$recipe_id'";
            mysqli_query($conn, $delete_fav);
            echo "Receita removida dos favoritos.";
        } else {
            // Se não está favoritado, adicionar aos favoritos
            $add_fav = "INSERT INTO favoritos (user_id, recipe_id) VALUES ('$user_id', '$recipe_id')";
            mysqli_query($conn, $add_fav);
            echo "Receita adicionada aos favoritos.";
        }
    } else {
        echo "Erro na conexão com o banco de dados.";
    }
} else {
    echo "Dados inválidos.";
}

// Fechar a conexão, se ela existir
if ($conn) {
    mysqli_close($conn);
}
?>
