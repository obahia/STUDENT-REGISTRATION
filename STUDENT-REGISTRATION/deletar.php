<?php
session_start();
require_once("ligarbd6.php");

if (isset($_GET['idaluno'])) {
    $id = intval($_GET['idaluno']);
    
    // Deletar o aluno
    $sql = "DELETE FROM aluno WHERE idaluno = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    
    header("Location: visualizar.php");
    exit();
}
?>
