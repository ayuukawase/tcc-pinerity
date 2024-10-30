<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Usuário | projeto para Web com PHP</title>
</head>
<body>
    <div class="container">
            <div class="col-md-10" style="padding-top: 50px;">
                <?php
                    require_once '../includes/funcoes.php';
                    require_once '../core/conexao_mysql.php';
                    require_once '../core/sql.php';
                    require_once '../core/mysql.php';

                    if(isset($_SESSION['login'])){
                        $id = (int)$_SESSION['login']['beneficiario']['id'];

                        $criterio = [
                            ['id', '=', $id]
                        ];
                        $retorno = buscar(
                            'beneficiario',
                            ['id', 'nome', 'email'],
                            $criterio
                        );

                        $entidade = $retorno[0];
                    }
                ?>
                <h2>Usuário</h2>
                <form method="post" action="../core/beneficiario_repositorio.php">
                    <input type="hidden" name="acao" value="<?php echo empty($id) ? 'insert' : 'update' ?>">
                    <input type="hidden" name="id" value="<?php echo $entidade['id'] ?? '' ?>">
                    <div class="form-group">
                        <label for="nome">Nome</label>
                        <input class="form-control" type="text" require="required" id="nome" name="nome" value="<?php echo $entidade['nome'] ?? '' ?>">
                    </div>
                    <div class="form-group">
                        <label for="NIS">NIS</label>
                        <input class="form-control" type="text" require="required" id="NIS" name="NIS" value="<?php echo $entidade['NIS'] ?? '' ?>">
                    </div>
                    <div class="form-group">
                        <label for="cpf">CPF</label>
                        <input class="form-control" type="text" require="required" id="cpf" name="cpf" pattern="\[0-9]{3}\.\[0-9]{3}\.\[0-9]{3}-\[0-9]{2}" title="Digite um CPF no formato: xxx.xxx.xxx-xx" value="<?php echo $entidade['cpf'] ?? '' ?>">
                    </div>
                    <div class="form-group">
                        <label for="telefone">Telefone</label>
                        <input class="form-control" type="tel" require="required" id="telefone" name="telefone" pattern="(\([0-9]{2}\))\s([0-9]{5})-([0-9]{4})" title="Digite um telefone no formato: (xx) xxxxx-xxxx" value="<?php echo $entidade['telefone'] ?? '' ?>">
                    </div>
                    <div class="form-group">
                        <label for="email">E-mail</label>
                        <input class="form-control" type="text" require="required" id="email" name="email" value="<?php echo $entidade['email'] ?? '' ?>">
                    </div>
                    <div class="form-group">
                        <label for="cep">CEP</label>
                        <input class="form-control" type="text" require="required" id="cep" name="cep" pattern="[0-9]{5}-[0-9]{3}" required value="<?php echo $entidade['cep'] ?? '' ?>">
                    </div>
                    <div class="form-group"><!--arrumar no banco-->
                        <label for="folha_resumo">Folha Resumo</label>
                        <input class="form-control" type="file" require="required" id="folha_resumo" name="folha_resumo" value="<?php echo $entidade['folha_resumo'] ?? '' ?>">
                    </div>
                    <div class="form-group">
                        <label for="n_integrantes">Número de pessoas na residência</label>
                        <input class="form-control" type="number" require="required" id="n_integrantes" name="n_integrantes" value="<?php echo $entidade['n_integrantes'] ?? '' ?>">
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
</body>
</html>