<?php

session_start(); // Certifica-se de que a sessão foi iniciada

if((!isset($_SESSION['usuario']) == true) and (!isset($_SESSION['senha']) == true))
{
    unset($_SESSION['usuario']);
    unset($_SESSION['senha']); 
    header('Location: ../login/login.php');
}

    include_once('../config.php');

    if(isset($_POST['update']))
    {
        $nome = $_POST['nome'];
        $usuario = $_POST['usuario'];
        $id = $_POST['id'];
        $senha = $_POST['senha'];
        $adm = $_POST['adm'];

        $sqlUpdate = "UPDATE usuarios SET fullnome = '$nome', usuario = '$usuario', id = '$id', senha = '$senha', adm ='$adm'
        WHERE id = '$id'";

        $result = $conexao->query($sqlUpdate);
    }
    header('Location: ../sistema.php');
?>