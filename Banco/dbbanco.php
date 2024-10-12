<?php 
$servidor = "localhost";
$usuario = "root"; // Nome de usuário do MySQL
$senha = ""; // Senha do MySQL (se houver, caso contrário, deixe em branco)
$dbname = "dbestudo";// nome da tabela

$charset = 'utf8';
// Conexão com o banco de dados
$conn = mysqli_connect($servidor, $usuario, $senha, $dbname);//conexao tem que ser o nome do arquivo

// Verificar conexão
if (!$conn) {
    die("Falha na conexão com o banco de dados, ERRO!: " . mysqli_connect_error());
}

?>