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

            if (isset($_POST['id']) && is_numeric($_POST['id'])) {
                $id = $_POST['id'];

                $sql = "DELETE FROM beneficiario WHERE id = ?";
                
                if ($stmt = mysqli_prepare($conexao, $sql)) {
                    mysqli_stmt_bind_param($stmt, "i", $id);

                    if (mysqli_stmt_execute($stmt)) {
                        echo "<h2>Dados deletados com sucesso!</h2>";
                    } else {
                        echo "<h2>Erro ao deletar!</h2>";
                        echo "<h2>" . mysqli_error($conexao) . "</h2>";
                    }

                    mysqli_stmt_close($stmt);
                } else {
                    echo "<h2>Erro ao preparar a consulta!</h2>";
                    echo "<h2>" . mysqli_error($conexao) . "</h2>";
                }
            } else {
                echo "<h2>ID inválido ou ausente!</h2>";
            }
            ?>
        </div>
    </section>
</body>

</html>