<?php 
    include('../banco/conexao.php');

    $nome = $_REQUEST['nome'];
    $email = $_REQUEST['email'];
    $senha = $_REQUEST['senha'];
    $senha = sha1($senha);


    $stmt = $pdo-> prepare("INSERT INTO tbUsuario (nomeUsuario, emailUsuario, senhaUsuario) VALUES ('$nome', '$email', '$senha')");

    $stmt-> execute();
    header("location: ../index.php");
    exit;
?>