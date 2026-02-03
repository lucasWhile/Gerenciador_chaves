<?php
session_start();
include_once '../../model/usuario.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $telefone = $_POST['telefone'];
    $nivel_acesso = $_POST['nivel_acesso'];
    $cpf = $_POST['cpf'];

    $usuario = new Usuario($nome, $email, $senha, $telefone, $nivel_acesso, $cpf);

    if ($usuario->cadastrarUsuario()) {
        echo "Usuario cadastrado com sucesso";
    } else {
        header("Location: ../../view/usuario/index.php");
    }

    // header("Location: index.php");
    // exit();
}
