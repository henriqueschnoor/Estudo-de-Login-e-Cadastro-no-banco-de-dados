<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Incluir o arquivo de conexão com o banco de dados
include('conexao.php');

if (isset($_POST['login']) && isset($_POST['senha'])) {
    $login = $_POST['login'];
    $senha = $_POST['senha'];

    // Preparar a consulta
    $sql = "SELECT cod_usuario, nome, senha FROM usuario WHERE email = ?";
    $stmt = $conexao->prepare($sql);
    
    if (!$stmt) {
        die("Erro na preparação da consulta: " . $conexao->error);
    }

    $stmt->bind_param("s", $login);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $senha_armazenada = $row['senha'];

        // Verificar se a senha está correta
        if (password_verify($senha, $senha_armazenada)) {
            // Criar a sessão e salvar o nome e id do usuário
            $_SESSION['cod_usuario'] = $row['cod_usuario'];
            $_SESSION['nome'] = $row['nome'];
            header("Location:Entrada.php"); 
            exit();
        } else {
            echo "Senha incorreta. Tente novamente.";
        }
    } else {
        echo "Login não encontrado. Verifique seu email.";
    }

    $stmt->close();
} else {
    echo "Por favor, preencha todos os campos.";
}

$conexao->close();
?>