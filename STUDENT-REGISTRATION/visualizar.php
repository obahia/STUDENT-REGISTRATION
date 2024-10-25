<?php
session_start();
require_once("ligarbd6.php");

// Consultar todos os alunos
$sql = "SELECT * FROM aluno";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Visualizar Alunos</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f3f4f6;
            margin: 0;
            padding: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #007bff;
            color: white;
        }
        button {
            background-color: #007bff;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 5px;
            font-size: 0.9em;
            cursor: pointer;
            transition: background-color 0.3s ease;
            margin-top: 13px;
        }
    </style>
</head>

<body>
    <h1>Lista de Alunos</h1>
    <table>
        <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>Idade</th> 
            <th>Ano</th>
            <th>Turma</th>
            <th>E-mail</th>
            <th>Username</th>
            <th>Ações</th>
        </tr>
        <?php if ($result->num_rows > 0): ?>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $row['idaluno']; ?></td>
                    <td><?php echo $row['nome']; ?></td>
                    <td><?php echo $row['idade']; ?></td>  
                    <td><?php echo $row['ano']; ?></td>
                    <td><?php echo $row['turma']; ?></td>
                    <td><?php echo $row['email']; ?></td>
                    <td><?php echo $row['username']; ?></td>
                    <td>
                        <a href="atualizar.php?idaluno=<?php echo $row['idaluno']; ?>">Atualizar</a>
                        <a href="deletar.php?idaluno=<?php echo $row['idaluno']; ?>">Deletar</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        <?php else: ?>
            <tr>
                <td colspan="8">Nenhum aluno encontrado.</td>
            </tr>
        <?php endif; ?>
    </table>

    <br>
    
    <a href="inserir.html">  <button type="button">Voltar</button></a>
</body>

</html>

<?php
$conn->close();
?>
