<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Benefício</title>
    <link rel="stylesheet" href="../css/cadastro.css">
    <link rel="icon" alt="icon" href="../img/menulogo.png">
</head>
<body>
    <div class="wrapper">
            <div>
                <form method="post" action="../core/pedido_repositorio.php">
                <input type="hidden" name="acao" value="<?php echo empty($id) ? 'insert' : 'update'; ?>">
                    <input type="hidden" name="id" value="<?php echo $entidade['id'] ?? '' ?>">
                    <h2>Fazer pedido de cesta básica</h2>
                    <div class="input-field">
                        <label for="numerocestas">Número de cestas</label>
                        <input class="form-control" type="text" require="required" id="numerocestas" name="numerocestas" value="<?php echo $entidade['numerocestas'] ?? '' ?>">
                    </div>
                    <div class="input-field">
                        <input type="radio" name="tipoentrega" id="tipoentregaRetirar" value="Retirar" class="inline" /><label id="tipoentregaRetirar">Retirar</label>
                        <input type="radio" name="tipoentrega" id="tipoentregaEntregar" value="Entregar" class="inline" /><label id="tipoentregaEntregar">Entregar</label>
                        <label for="tipoentrega">Tipo de entrega</label>
                    </div>
                    <div class="input-field" >
                        <label for="id_distribuidora">Empresa de distribuição</label>
                        <select name="id_distribuidora" id="id_distribuidora" style="width: 500px;">
                        <?php
                        include('../core/conexao_mysql.php');
                        $sql = "SELECT * FROM empresadistribuicao";
                        $result = mysqli_query($conexao, $sql);
                        
                        if ($result) {
                            if (mysqli_num_rows($result) > 0) {
                                while ($row = mysqli_fetch_array($result)) {
                                    echo "<option value='" . $row['id'] . "'>" . $row['cnpj'] . "/" . $row['nome_fantasia'] . "</option>";
                                }
                            } else {
                                echo "<option value=''>Nenhuma empresa de distribuição encontrada</option>";
                            }
                        } else {
                            echo "Erro ao carregar as empresas de distribuição: " . mysqli_error($conexao);
                        }
                        ?>
                        </select>                   
                    </div>
                    <br>
                    <button type="submit">Salvar</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>