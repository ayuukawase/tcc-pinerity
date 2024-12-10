<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Usuário | projeto para Web com PHP</title>

    <link rel="stylesheet" href="lib/bootstrap-4.2.1-dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <div class="row" style="min-height: 500px">
            <div class="col-md-10" style="padding-top: 50px;">
                <?php
                    require_once '../includes/funcoes.php';
                    require_once '../core/conexao_mysql.php';
                    require_once '../core/sql.php';
                    require_once '../core/mysql.php';

                    if(isset($_SESSION['login'])){
                        $id = (int)$_SESSION['login']['usuario']['id'];

                        $criterio = [
                            ['id', '=', $id]
                        ];
                        $retorno = buscar(
                            'usuario',
                            ['id', 'nome', 'email'],
                            $criterio
                        );

                        $entidade = $retorno[0];
                    }
                ?>
                <h2>Usuário</h2>
                <form method="post" action="../core/usuario_repositorio.php">
                    <input type="hidden" name="acao" value="<?php echo empty($id) ? 'insert' : 'update' ?>">
                    <input type="hidden" name="id" value="<?php echo $entidade['id'] ?? '' ?>">
                    <div class="form-group">
                        <label for="nome">Nome</label>
                        <input class="form-control" type="text" require="required" id="nome" name="nome" value="<?php echo $entidade['nome'] ?? '' ?>">
                    </div>
                    <div class="form-group">
                        <label for="emaild">E-mail</label>
                        <input class="form-control" type="text" require="required" id="email" name="email" value="<?php echo $entidade['email'] ?? '' ?>">
                    </div>
                    <?php if(!isset($_SESSION['login'])): ?>
                    <div class="form-group">
                        <label for="senha">Senha</label>
                        <input class="form-control" type="password" require="required" id="senha" name="senha">
                    </div>
                    <?php endif;?>
                    <div class="text-right">
                        <button class="btn btn-sucess" type="submit">Salvar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="lib/bootstrap-4.2.1-dist/js/bootstrap.min.js"></script>
</body>
</html>