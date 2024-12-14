<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultado</title>
</head>

<body>
    <section>
        <div class="principal">
            <h1>Deletar cidade</h1>
            <?php
            require_once 'conexao_mysql.php'; 
            $id = $_GET['id'];
            $sql = "DELETE FROM beneficiario WHERE id = $id";
            $result = mysqli_query($conexao, $sql);
            if ($result)
                echo "<h2>Dados deletados!</h2>";
            else {
                echo "<h2>Erro ao deletar!</h2>";
                echo "<h2>" . mysqli_error($conexao) . "</h2>";
            }
            ?>
        </div>
    </section>
</body>

</html>