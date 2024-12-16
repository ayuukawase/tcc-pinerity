<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro do doador físico</title>
    <link rel="stylesheet" href="../css/cadastro.css">
    <link rel="icon" alt="icon" href="../img/menulogo.png">
</head>
<body>
    <div class="wrapper">
    <form method="post" action="../core/doadorfisicocadastro_repositorio.php">
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
                            ['nome', 'dt_nasc', 'telefone', 'email', 'cep', 'numero'],
                            $criterio
                        );

                        $entidade = $retorno[0];
                    }
                ?>
                <form method="post" action="../core/doadorfisicocadastro_repositorio.php">
                    <input type="hidden" name="acao" value="<?php echo empty($id) ? 'insert' : 'update' ?>">
                    <input type="hidden" name="id" value="<?php echo $entidade['id'] ?? '' ?>">
                    <h2>Cadastro do doador físico</h2>
                    <div class="input-field">
                        <input class="form-control" type="text" require="required" id="nome" name="nome" value="<?php echo $entidade['nome'] ?? '' ?>">
                        <label for="nome">Nome</label>
                    </div>
                    <div class="input-field">
                        <input class="form-control" type="number" require="required" id="cpf" name="cpf" title="Digite seu CPF sem pontuação ou traço" value="<?php echo $entidade['cpf'] ?? '' ?>">
                        <label for="cpf">CPF</label>
                    </div>
                    <div class="input-field">
                        <input class="form-control" type="date" require="required" id="dt_nasc" name="dt_nasc" value="<?php echo $entidade['dt_nasc'] ?? '' ?>">
                        <label for="dt_nasc">Data de Nascimento</label>
                    </div>
                    <div class="input-field">
                        <input class="form-control" type="tel" require="required" id="telefone" name="telefone" pattern="(\([0-9]{2}\))\s([0-9]{5})-([0-9]{4})" title="Digite um telefone no formato: (xx) xxxxx-xxxx" value="<?php echo $entidade['telefone'] ?? '' ?>">
                        <label for="telefone">Telefone</label>
                    </div>
                    <div class="input-field">
                        <input class="form-control" type="email" require="required" id="email" name="email" value="<?php echo $entidade['email'] ?? '' ?>">
                        <label for="email">E-mail</label>
                    </div>
                    <div class="input-field">
                        <input class="form-control" type="text" require="required" id="cep" name="cep" pattern="[0-9]{5}-[0-9]{3}" title="Digite um CEP no formato: xxxxx-xx" value="<?php echo $entidade['cep'] ?? '' ?>">
                        <label for="cep">CEP</label>
                    </div>
                    <div class="input-field">
                        <input class="form-control" type="number" require="required" id="numero" name="numero" value="<?php echo $entidade['numero'] ?? '' ?>">
                        <label for="numero">Número da casa/apartamento</label>
                    </div>
                    <?php if(!isset($_SESSION['login'])): ?>
                    <div class="input-field">
                        <input class="form-control" type="password" require="required" id="senha" name="senha">
                        <label for="senha">Senha</label>
                    </div>
                    <?php endif;?>
                    <div class="text-right">
                    <button type="submit">Cadastrar</button>
                    <div class="register">
                        <p>Já tem uma conta? <a href="logindoadorfisico.php">Entrar</a></p>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>