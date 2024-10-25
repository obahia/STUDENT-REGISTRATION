<?php
session_start(); // Inicie a sessão
require_once("ligarbd6.php");

if (isset($_POST['nome'])) {
    $nome = mysqli_real_escape_string($conn, $_POST['nome']);
    $idade = intval($_POST['idade']);
    $turma =  mysqli_real_escape_string($conn, $_POST['turma']);
    $ano = intval($_POST['ano']);
    $email =  mysqli_real_escape_string($conn, $_POST['email']);
    $username =   mysqli_real_escape_string($conn, $_POST['username']);
    $password =  mysqli_real_escape_string($conn, $_POST['password']);
    $cpassword =  mysqli_real_escape_string($conn, $_POST['confirmedpassword']);
    
    //comparacao de senhas 
    if ($password !== $cpassword) {
        echo "As senhas nao se coincidem, por favor tentar novamente.";
        $_SESSION['message'] = "As senhas nao se coincidem, por favor tentar novamente.";
        exit;
        
    }
 
    //verificar se user ja existe

    $sql = "SELECT * FROM aluno WHERE username = ?";
    $stmt = $conn ->prepare($sql);
    $stmt -> bind_param("s", $username);
    $stmt -> execute();
    $result = $stmt -> get_result();

    if ($result->num_rows > 0) {
        echo "ERRO: USERNAME JA UTILIZADO";
        exit();
    }

    $sql = "INSERT INTO aluno (nome, idade, turma, ano, email, username, password ) VALUES ('$nome', $idade, '$turma', $ano, '$email', '$username', '$password' );";
    if (mysqli_query($conn, $sql)) {
        echo "Aluno: $nome<br> Inserido com sucesso!";
    } else {
        $_SESSION['message'] = "Erro ao inserir os dados na tabela.";
    }
    
    mysqli_close($conn);
   
 
}
?>
