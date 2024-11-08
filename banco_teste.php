<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teste de PHP com MySQL</title>
</head>

<body>
    <h1>Cadastro de pessoas</h1>
    <form method="post">
        <label for="nome">Nome:</label>
        <input type="text" id="nome" name="nome" required>
        <br><br>
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>
        <br><br>
        <button type="submit" name="inserir">Cadastrar</button>
        <button type="submit" name="limpar">Limpar Registros</button>
    </form>   

    <?php
        // Configuração de conexão com o banco de dados
        $host = "localhost";
        $usuario = "root";
        $senha = "";
        $banco = "exemplo_php_mysql";

        // Conectando ao MySQL
        $conexao = new mysqli($host, $usuario, $senha, $banco);

        // Verifica se há erros na conexão
        if ($conexao->connect_error) {
            die("Falha na conexão: " . $conexao->connect_error);
        }
        if (isset($_POST["inserir"])) {// Inserir dados no banco de dados
            $nome = $_POST["nome"];
            $email = $_POST["email"];
            $sql = "INSERT INTO pessoas (nome, email) VALUES ('$nome', '$email')";
            if ($conexao->query($sql) === TRUE) {
                echo "<p>Registro inserido com sucesso!</p>";
            } else {
                echo "<p>Erro: " . $conexao->error . "</p>";
            }
        }
        if (isset($_POST["limpar"])) {// Limpar todos os registros
            $sql = "DELETE FROM pessoas";
            if ($conexao->query($sql) === TRUE) {
                echo "<p>Todos os registros foram limpos!</p>";
            } else {
                echo "<p>Erro ao limpar registros: " . $conexao->error . "</p>";
            }
        }
        // Exibir dados da tabela
        $sql = "SELECT * FROM pessoas";
        $resultado = $conexao->query($sql);
        if ($resultado->num_rows > 0) {
            echo "<h2>Registros:</h2><ul>";
            while ($linha = $resultado->fetch_assoc()) {
                echo "<li>ID: ".$linha["id"] . " - Nome: ".$linha["nome"]." - Email: ".$linha["email"]."</li>";
            }   
            echo "</ul>";
        } else {
            echo "<p>Nenhum registro encontrado.</p>";
        }
        
        // Fechar conexão
        $conexao->close();
    ?>
</body>
</html>