<!DOCTYPE html>
<html lang="pt-BR">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="theme-color" content="#06b6d4" />
    <title>Painel do beneficiário</title>
    <link rel="icon" alt="icon" href="../img/menulogo.png">
    <!-- CSS -->
    <link rel="stylesheet" href="../css/painel.css" />

  </head>
  <body>
    <div id="content">
      <header>
        <div class="busca">
          <form action="" method="get">
          <input type="search" name="busca" class="form-control mr-sm-2" placeholder="Busca" aria-label="Busca">
            <button type="submit" title="Buscar">
              <i class="bi bi-search"></i>
            </button>
          </form>
          <button title="Notificações"><i class="bi bi-bell"></i></button>
        </div>
        <br>
        <div class="saudacao">
          <div class="perfil">
            <img src="../img/testebeneficiario.jpeg" alt="Sua foto de perfil" />
            <?php if(isset($_SESSION['login'])): ?>
              <div class = "card-body text-right">
                Olá, <?php echo $_SESSION['login']['beneficiario']['nome']?>!
              </div>
            <?php endif ?>
          </div>
          <div class="acoes">
            <button>Novo pedido</button>
            <button>Enviar</button>
          </div>
        </div>
      </header>
      <aside>
        <div class="logo">
          <i class="bi bi-tree"></i>
          <h1>Pinerity</h1>
        </div>
        <ul class="menu">
          <li class="selecionado">
            <a href="#"><i class="bi bi-house"></i>Início</a>
          </li>
          <li>
            <a href="#"><i class="bi bi-clock-history"></i>Histórico de pedidos de benefícios</a>
          </li>
          <li>
            <a href="#"><i class="bi bi-eye"></i>Visualizar perfil</a>
          </li>
          <li>
            <a href="atualizarbeneficiario.php"><i class="bi bi-pencil-square"></i>Atualizar perfil</a>
          </li>
          <li>
            <a href="#"><i class="bi bi-x-lg"></i>Deletar perfil</a>
          </li>
        </ul>
        <ul class="menu">
          <li>
            <a href="#"><i class="bi bi-info-circle"></i>Ajuda</a>
          </li>
          <li>
            <a href="../core/beneficiario_repositorio.php?acao=logout"><i class="bi bi-box-arrow-right"></i>Sair</a>
          </li>
        </ul>
        <footer>
          <p id="texto-footer">Pinerity</p>
          <div class="links">
            <a
              href="https://www.instagram.com/pinerity.oficial/"
              target="_blank"
              rel="noopener noreferrer"
              title="Instagram"
              ><i class="bi bi-instagram"></i
            ></a> 
            <a
              href="https://www.linkedin.com/in/pinerity/"
              target="_blank"
              rel="noopener noreferrer"
              title="LinkedIn"
              ><i class="bi bi-linkedin"></i
            ></a>
          </div>
        </footer>
      </aside>
      <main>
      <section class="anuncios">
        <div>
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
                          ['id', 'nome', 'NIS', 'cpf', 'telefone', 'email', 'cep', 'numero', 'folha_resumo', 'n_integrantes'],
                          $criterio
                      );

                      $entidade = $retorno[0];
                  }
              ?>
              <form method="post" action="../core/beneficiario_repositorio.php">
                  <input type="hidden" name="acao" value="<?php echo empty($id) ? 'update' : ?>">
                  <input type="hidden" name="id" value="<?php echo $entidade['id'] ?? '' ?>">
                  <h2>Cadastro</h2>
                  <div class="input-field">
                      <input class="form-control" type="text" require="required" id="nome" name="nome" value="<?php echo $entidade['nome'] ?? '' ?>">
                      <label for="nome">Nome</label>
                  </div>
                  <div class="input-field">
                      <input class="form-control" type="number" require="required" id="NIS" name="NIS" value="<?php echo $entidade['NIS'] ?? '' ?>">
                      <label for="NIS">NIS</label>
                  </div>
                  <div class="input-field">
                      <input class="form-control" type="number" require="required" id="cpf" name="cpf" title="Digite seu CPF sem pontuação ou traço" value="<?php echo $entidade['cpf'] ?? '' ?>">
                      <label for="cpf">CPF</label>
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
                      <input class="form-control" type="text" require="required" id="cep" name="cep" pattern="[0-9]{5}-[0-9]{3}" required value="<?php echo $entidade['cep'] ?? '' ?>">
                      <label for="cep">CEP</label>
                  </div>
                  <div class="input-field">
                      <input class="form-control" type="number" require="required" id="numero" name="numero" value="<?php echo $entidade['numero'] ?? '' ?>">
                      <label for="numero">Número da casa/apartamento</label>
                  </div>
                  <div class="input-field">
                      <input class="form-control" type="file" require="required" id="folha_resumo" name="folha_resumo" value="<?php echo $entidade['folha_resumo'] ?? '' ?>">
                      <label for="folha_resumo">Folha Resumo</label>
                  </div>
                  <div class="input-field">
                      <input class="form-control" type="number" require="required" id="n_integrantes" name="n_integrantes" min="1" value="<?php echo $entidade['n_integrantes'] ?? '' ?>">
                      <label for="n_integrantes">Número de pessoas na residência</label>
                  </div>
                  <?php if(!isset($_SESSION['login'])): ?>
                  <div class="input-field">
                      <input class="form-control" type="password" require="required" id="senha" name="senha">
                      <label for="senha">Senha</label>
                  </div>
                  <?php endif;?>
                  <button type="submit">Cadastrar</button>
                  <div class="register">
                      <p>Já tem uma conta? <a href="loginbeneficiario.php">Entrar</a></p>
                  </div>
              </form>
          </div>
        </section>
      </main>
    </div>
  </body>
</html>