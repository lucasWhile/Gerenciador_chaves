<?php

include '../../conexaobanco/conexao.php';

class Usuario
{
    private $nome;
    private $email;
    private $senha;
    private $telefone;
    private $nivel_acesso;
    private $cpf;

    public function __construct($nome, $email, $senha, $telefone, $nivel_acesso, $cpf)
    {

        $this->nome = $nome;
        $this->email = $email;
        $this->senha = $senha;
        $this->telefone = $telefone;
        $this->nivel_acesso = $nivel_acesso;
        $this->cpf = $cpf;
    }

    public function cadastrarUsuario()
    {
        $conexao = new conexao();
        $pdo = $conexao->conectar();

        $stmt = $pdo->prepare("INSERT INTO usuario (nome_usuario, email_usuario, telefone_usuario, nivel_acesso, senha_usuario, cpf_usuario) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssss", $this->nome, $this->email, $this->telefone, $this->nivel_acesso, $this->senha, $this->cpf);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }

        $stmt->close();
        $pdo->close();
    }

    public function authUsuario($cpf, $senha)
    {
        $conexao = new conexao();
        $mysqli = $conexao->conectar();

        $sql = "SELECT * FROM usuario WHERE cpf_usuario = ? AND senha_usuario = ?";
        $stmt = $mysqli->prepare($sql);

        $stmt->bind_param("ss", $cpf, $senha);
        $stmt->execute();

        $resultado = $stmt->get_result();

        if ($resultado->num_rows > 0) {
            return true;
        }

        return false;
    }



    public function getUsuario($cpf)
    {
        $conexao = new conexao();
        $pdo = $conexao->conectar();

        $stmt = $pdo->prepare("SELECT * FROM usuario WHERE cpf_usuario = ?");
        $stmt->bind_param("s", $cpf);

        if ($stmt->execute()) {
            return $stmt->get_result()->fetch_assoc();
        } else {
            return false;
        }

        $stmt->close();
        $pdo->close();
    }
}
