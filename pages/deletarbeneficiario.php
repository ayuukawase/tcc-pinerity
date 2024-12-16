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
    <title>Painel do beneficiário</title>
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
                Olá, <br> <?php echo $_SESSION['login']['beneficiario']['nome']?>!
              </div>
            <?php endif ?>
          </div>
          <div class="acoes">
            <a href="cadastropedido.php"><button>Novo pedido</button></a>
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
            <a href="#"><i class="bi bi-clock-history"></i>Histórico de pedidos de benefícios</a>
          </li>
          <li>
            <a href="visualizarbeneficiario.php"><i class="bi bi-eye"></i>Visualizar perfil</a>
          </li>
          <li>
            <a href="atualizarbeneficiario.php"><i class="bi bi-pencil-square"></i>Atualizar perfil</a>
          </li>
          <li>
            <a href="deletarbeneficiario.php"><i class="bi bi-x-lg"></i>Deletar perfil</a>
          </li>
        </ul>
        <ul class="menu">
          <li>
            <a href="sobre.html"><i class="bi bi-info-circle"></i>Ajuda</a>
          </li>
          <li>
            <a href="../core/beneficiariocadastro_repositorio.php?acao=logout"><i class="bi bi-box-arrow-right"></i>Sair</a>
          </li>
        </ul>
        <footer>
          <p id="texto-footer">Pinerity</p>
          <div class="links">
            <a href="https://www.instagram.com/pinerity.oficial/" target="_blank" rel="noopener noreferrer" title="Instagram">
              <i class="bi bi-instagram"></i>
            </a> 
            <a href="https://www.linkedin.com/in/pinerity/" target="_blank" rel="noopener noreferrer" title="LinkedIn">
              <i class="bi bi-linkedin"></i>
            </a>
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
              <form method="POST" action="../core/beneficiariocadastro_repositorio.php?acao=delete" onsubmit="return confirm('Você tem certeza que quer deletar sua conta?');">
                  <input type="hidden" name="id" value="<?php echo $entidade['id'] ?>">
                  <h2>Deletar</h2>
                  <button type="submit" value="delete">Deletar meu perfil</button>
              </form>
          </div>
        </section>
      </main>
    </div>
  </body>
</html>