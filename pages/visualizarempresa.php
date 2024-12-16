<?php
session_start();
?>
<!DOCTYPE html>
<html lang="pt-BR">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="theme-color" content="#06b6d4" />
    <title>Painel da empresa</title>
    <link rel="icon" alt="icon" href="../img/menulogo.png">
    <!-- CSS -->
    <link rel="stylesheet" href="../css/painel.css" />

  </head>
  <body>
    <div id="content">
    <header>
        <div class="busca">
          <form action="">
            <input type="text" placeholder="Pesquisar" />
            <button type="submit" title="Buscar">
              <i class="bi bi-search"></i>
            </button>
          </form>
          <button title="Notificações"><i class="bi bi-bell"></i></button>
        </div>
        <br>
        <div class="saudacao">
          <div class="perfil">
            <img src="../img/fotousuario.png" alt="Sua foto de perfil" />
            <?php if(isset($_SESSION['login'])): ?>
              <div class = "card-body text-right"><br>
                Olá, <br> <?php echo $_SESSION['login']['empresadistribuicao']['nome_fantasia']?>!
              </div>
            <?php endif ?>
          </div>
          <div class="acoes">
            <button>Nova doação</button>
            <button>Enviar</button>
            <button>Compartilhar</button>
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
            <a href="painelbeneficiario.php"><i class="bi bi-house"></i>Início</a>
          </li>
          <li>
            <a href="#"><i class="bi bi-clock-history"></i>Recebimento e entrega de cestas</a>
          </li>
          <li>
            <a href="visualizarempresa.php"><i class="bi bi-eye"></i>Visualizar perfil</a>
          </li>
          <li>
            <a href="atualizarempresa.php"><i class="bi bi-pencil-square"></i>Atualizar perfil</a>
          </li>
          <li>
            <a href="deletarempresa.php"><i class="bi bi-x-lg"></i>Deletar perfil</a>
          </li>
        </ul>
        <ul class="menu">
          <li>
            <a href="sobre.html"><i class="bi bi-info-circle"></i>Ajuda</a>
          </li>
          <li>
            <a href="../core/empresadistribuicaocadastro_repositorio.php?acao=logout"><i class="bi bi-box-arrow-right"></i>Sair</a>
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
              ><i class="bi bi-instagram"></i></a> 
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
        <div class="row" style="min-height: 500px;">
          <div class="col-md-10" style="padding-top: 50px;">
            <h2>Meu perfil</h2>
            <?php
                  require_once '../includes/funcoes.php';
                  require_once '../core/conexao_mysql.php';
                  require_once '../core/sql.php';
                  require_once '../core/mysql.php';

                  if(isset($_SESSION['login'])){
                      $id = (int)$_SESSION['login']['empresadistribuicao']['id'];

                      $criterio = [
                          ['id', '=', $id]
                      ];
                      $retorno = buscar(
                          'empresadistribuicao',
                          [ 'id', 'nome_fantasia', 'nome_empresarial', 'cnpj', 'email', 'telefone', 'cep', 'numero', 'descricaoitensestoque'],
                          $criterio
                      );

                      $entidade = $retorno[0];
                  }
              ?>
              <table class="table table-bordered table-hover table-striped table-responsive{-sm|-md|-lg|-xl}">
                  <thead>
                    <tr>
                      <td>Nome fantasia</td>
                      <td>Nome empresarial</td>
                      <td>CNPJ</td>
                      <td>E-mail</td>
                      <td>Telefone</td>
                      <td>CEP</td>
                      <td>Número da casa/apartamento</td>
                      <td>Descrição dos itens do estoque</td>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                    <td><?php echo $entidade['nome_fantasia'] ?></td>
                      <td><?php echo $entidade['nome_empresarial'] ?></td>
                      <td><?php echo $entidade['cnpj'] ?></td>
                      <td><?php echo $entidade['email'] ?></td>
                      <td><?php echo $entidade['telefone'] ?></td>
                      <td><?php echo $entidade['cep'] ?></td>
                      <td><?php echo $entidade['numero'] ?></td>
                      <td><?php echo $entidade['descricaoitensestoque'] ?></td>                    </tr>
                  </tbody>
              </table>
            </div>
          </div>
        </section>
      </main>
    </div>
  </body>
</html>