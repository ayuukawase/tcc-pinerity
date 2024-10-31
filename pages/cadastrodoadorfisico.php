<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro do doador físico</title>
</head>
<body>
    <div class="wrapper">
    <form method="post" action="../core/beneficiario_repositorio.php">
    <input type="hidden" name="acao" value="login">
            <div>
                <?php
                    require_once '../includes/funcoes.php';
                    require_once '../core/conexao_mysql.php';
                    require_once '../core/sql.php';
                    require_once '../core/mysql.php';

                    if(isset($_SESSION['login'])){
                        $id = (int)$_SESSION['login']['doadorfisico']['id'];

                        $criterio = [
                            ['id', '=', $id]
                        ];
                        $retorno = buscar(
                            'doadorfisico',
                            ['id', 'nome', 'email'],
                            $criterio
                        );

                        $entidade = $retorno[0];
                    }
                ?>
                <h2>Usuário</h2>
                <form method="post" action="core/doadorfisico_repositorio.php">
                    <input type="hidden" name="acao" value="<?php echo empty($id) ? 'insert' : 'update' ?>">
                    <input type="hidden" name="id" value="<?php echo $entidade['id'] ?? '' ?>">
                    <h2>Cadastro</h2>
                    <div class="input-field">
                        <label for="nome">Nome</label>
                        <input class="form-control" type="text" require="required" id="nome" name="nome" value="<?php echo $entidade['nome'] ?? '' ?>">
                    </div>
                    <div class="input-field">
                        <label for="cpf">CPF</label>
                        <input class="form-control" type="number" require="required" id="cpf" name="cpf" title="Digite seu CPF sem pontuação ou traço" value="<?php echo $entidade['cpf'] ?? '' ?>">
                    </div>
                    <div class="input-field">
                        <label for="dt_nasc">Data de Nascimento</label>
                        <input class="form-control" type="date" require="required" id="dt_nasc" name="dt_nasc" value="<?php echo $entidade['dt_nasc'] ?? '' ?>">
                    </div>
                    <div class="input-field">
                        <label for="telefone">Telefone</label>
                        <input class="form-control" type="tel" require="required" id="telefone" name="telefone" pattern="(\([0-9]{2}\))\s([0-9]{5})-([0-9]{4})" title="Digite um telefone no formato: (xx) xxxxx-xxxx" value="<?php echo $entidade['telefone'] ?? '' ?>">
                    </div>
                    <div class="input-field">
                        <label for="email">E-mail</label>
                        <input class="form-control" type="email" require="required" id="email" name="email" value="<?php echo $entidade['email'] ?? '' ?>">
                    </div>
                    <div class="input-field">
                        <label for="cep">CEP</label>
                        <input class="form-control" type="text" require="required" id="cep" name="cep" pattern="[0-9]{5}-[0-9]{3}" title="Digite um CEP no formato: xxxxx-xx" value="<?php echo $entidade['cep'] ?? '' ?>">
                    </div>
                    <div class="input-field">
                        <label for="numero">Número da casa/apartamento</label>
                        <input class="form-control" type="number" require="required" id="numero" name="numero" value="<?php echo $entidade['numero'] ?? '' ?>">
                    </div>
                    <?php if(!isset($_SESSION['login'])): ?>
                    <div class="input-field">
                        <label for="senha">Senha</label>
                        <input class="form-control" type="password" require="required" id="senha" name="senha">
                    </div>
                    <?php endif;?>
                    <div class="text-right">
                    <button type="submit">Cadastrar</button>
                    <div class="register">
                        <p>Já tem uma conta? <a href="loginbeneficiario.php">Entrar</a></p>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>