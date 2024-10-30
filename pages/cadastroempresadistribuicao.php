<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro da empresa de distribuição de alimentos</title>
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
                        $id = (int)$_SESSION['login']['empresadistribuicaoo']['id'];

                        $criterio = [
                            ['id', '=', $id]
                        ];
                        $retorno = buscar(
                            'empresadistribuicao',
                            ['id', 'nome', 'email'],
                            $criterio
                        );

                        $entidade = $retorno[0];
                    }
                ?>
                <h2>Doador Jurídico</h2>
                <form method="post" action="../core/empresadistribuicao_repositorio.php">
                    <input type="hidden" name="acao" value="<?php echo empty($id) ? 'insert' : 'update' ?>">
                    <input type="hidden" name="id" value="<?php echo $entidade['id'] ?? '' ?>">
                    <div class="form-group">
                        <label for="nome_fantasia">Nome fantasia da empresa/Nome popular</label>
                        <input class="form-control" type="text" require="required" id="nome_fantasia" name="nome_fantasia" value="<?php echo $entidade['nome_fantasia'] ?? '' ?>">
                    </div>
                    <div class="form-group">
                        <label for="nome_empresarial">Nome empresarial da empresa/Nome oficial</label>
                        <input class="form-control" type="text" require="required" id="nome_empresarial" name="nome_empresarial" value="<?php echo $entidade['nome_empresarial'] ?? '' ?>">
                    </div>
                    <div class="form-group">
                        <label for="cnpj">CNPJ</label><!--arrumar-->
                        <input class="form-control" type="text" require="required" id="cnpj" name="cnpj" pattern="\d{2}\.\d{3}\.\d{3}\.\/\d{4}-\d{2}" title="Digite um CNPJ no formato: xx.xxx.xxx/xxxx-xx" value="<?php echo $entidade['cnpj'] ?? '' ?>">
                    </div>
                    <div class="form-group">
                        <label for="email">E-mail</label>
                        <input class="form-control" type="email" require="required" id="email" name="email" value="<?php echo $entidade['email'] ?? '' ?>">
                    </div>
                    <div class="form-group">
                        <label for="telefone">Telefone</label>
                        <input class="form-control" type="tel" require="required" id="telefone" name="telefone" pattern="(\([0-9]{2}\))\s([0-9]{5})-([0-9]{4})" title="Digite um telefone no formato: (xx) xxxxx-xxxx" value="<?php echo $entidade['telefone'] ?? '' ?>">
                    </div>
                    <div class="form-group">
                        <label for="cep">CEP</label>
                        <input class="form-control" type="text" require="required" id="cep" name="cep" pattern="[0-9]{5}-[0-9]{3}" title="Digite um CEP no formato: xxxxx-xx" value="<?php echo $entidade['cep'] ?? '' ?>">
                    </div>
                    <div class="form-group">
                        <label for="numero">Número da empresa</label>
                        <input class="form-control" type="number" require="required" id="numero" name="numero" value="<?php echo $entidade['numero'] ?? '' ?>">
                    </div>
                    <div class="form-group">
                        <label for="descricao_itens_estoque">Descrição dos itens que estão em estoque</label>
                        <textarea require="required" id="descricao_itens_estoque" name="descricao_itens_estoque" placeholder="Digite os itens no estoque" minlength="20" value="<?php echo $entidade['descricao_itens_estoque'] ?? '' ?>"></textarea>
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