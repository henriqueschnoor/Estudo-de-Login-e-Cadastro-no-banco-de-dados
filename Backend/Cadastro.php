<?php 
include('../Banco/dbbanco.php');

$nome = $_POST['nome'];
$login = $_POST['email']; // Certifique-se de que o nome do campo no formulário é 'login'
$senha = $_POST['senha'];
$confirmasenha = $_POST['ConfirmarSenha'];

// Verifica se as senhas coincidem
if ($senha !== $confirmasenha) {
    echo "<script>alert('As senhas não coincidem');</script>";
    echo "<script>window.location.href='Cadastro.php';</script>";
    exit();
}

// Hash da senha para maior segurança
$senhaHash = password_hash($senha, PASSWORD_DEFAULT);

// Insere os dados no banco de dados
$sql = "INSERT INTO usuario (nome, email, senha) VALUES ('$nome', '$login', '$senhaHash')";

if ($conexao->query($sql) === TRUE) {
    echo "<script>alert('Cadastro realizado com sucesso!'); window.location.href='Logalt.php';</script>";
    exit();
} else {
    echo "Erro: " . $sql . "<br>" . $conexao->error;
}

// Fecha a conexão
$conexao->close();
?>