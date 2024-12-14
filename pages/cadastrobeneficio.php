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
                <form method="post" action="../core/beneficio_repositorio.php">
                    <input type="hidden" name="acao" value="insert">
                    <input type="hidden" name="id" value="<?php echo $entidade['id'] ?? '' ?>">
                    <h2>Fazer pedido de cesta básica</h2>
                    <div class="input-field">
                        <label for="qtd_cestas">Quantidade de Cestas</label>
                        <input class="form-control" type="text" require="required" id="qtd_cestas" name="qtd_cestas" value="<?php echo $entidade['qtd_cestas'] ?? '' ?>">
                    </div>
                    <div class="input-field">
                        <label for="pedido_id">Pedido Id</label>
                        <input class="form-control" type="text" require="required" id="pedido_id" name="pedido_id" value="<?php echo $entidade['pedido_id'] ?? '' ?>">
                    </div>                            
                    <br>
                    <button type="submit">Salvar</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>