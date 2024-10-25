<?php
session_start();
require_once("ligarbd6.php");


//Busco o id do aluno para entar fazer a select 

if (isset($_GET['idaluno'])) {
    $id = intval($_GET['idaluno']);
    $sql = "SELECT * FROM aluno WHERE idaluno = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $aluno = $result->fetch_assoc();
}
//aqui ao verifica o metodo de resquest do server for post ent atribuir as variaveis cada coluna da tabela 
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = mysqli_real_escape_string($conn, $_POST['nome']);
    $idade = intval($_POST['idade']);
    $turma = mysqli_real_escape_string($conn, $_POST['turma']);
    $ano = intval($_POST['ano']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $pass = intval($_POST['password']);
//aqui uso o UPDATE para atualizar aquela coluna
    $sql = "UPDATE aluno SET nome = ?, idade = ?, turma = ?, ano = ?, email = ?, username = ?  password = ? WHERE idaluno = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sissssi", $nome, $idade, $turma, $ano, $email, $username, $pass, $id);
    $stmt->execute();

    header("Location: visualizar.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Atualizar Aluno</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f3f4f6;
            margin: 0;
            padding: 20px;
        }

        h1 {
            color: #333;
            margin-bottom: 20px;
            margin-left:14cm;
        }

        form {
            background: #ffffff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            width: 400px;
            margin: 0 auto;
        }

        label {
            display: block;
            margin-bottom: 5px;
            font-size: 0.9em;
            color: #555;
        }

        input {
            width: 100%;
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 0.9em;
            transition: border-color 0.3s ease;
            margin-left: -8px;
        }

        input:focus {
            border-color: #007bff;
            outline: none;
        }

        button {
            background-color: #007bff;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 5px;
            font-size: 0.9em;
            cursor: pointer;
            width: 100%;
            transition: background-color 0.3s ease;
            margin-top:10px;
        }

        button:hover {
            background-color: #0056b3;
        }

        a {
            display: inline-block;
            margin-top: 20px;
            color: #007bff;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <h1>Atualizar Aluno</h1>
    <!--aqui utilizamos um form juntamnete com a variavel em php para entao atualizar os valores  -->
    <form method="post">
        <label>Nome:</label>
        <input type="text" name="nome" value="<?php echo $aluno['nome']; ?>" required>
        
        <label>Idade:</label>
        <input type="number" name="idade" value="<?php echo $aluno['idade']; ?>" required min="0">

        <label>Ano:</label>
        <input type="number" name="ano" value="<?php echo $aluno['ano']; ?>">

        <label>Turma:</label>
        <input type="text" name="turma" pattern="[A-Za-z]+" title="Insira apenas letras" value="<?php echo $aluno['turma'] ; ?>">
       
        <label>E-mail:</label>
        <input type="email" name="email" value="<?php echo $aluno['email']; ?>">

        <label>Username:</label>
        <input type="text" name="username" value="<?php echo $aluno['username']; ?>" required>

        <label>Password:</label>
        <input type="text" name="password" value="<?php echo $aluno['password']; ?>" required min="8">

        <button type="submit">Atualizar</button>
    </form>
    <a href="inserir.html">
        <button type="button">Voltar</button>
    </a>
</body>

</html>
