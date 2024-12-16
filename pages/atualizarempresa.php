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
  <?php
    if (!isset($_SESSION['login'])) 
    { 
      header('Location: login.php'); 
      exit(); 
    } 
    $beneficiario = $_SESSION['login']['empresadistribuicao']; 
    ?>
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

            <form method="post" action="../core/empresadistribuicao_repositorio.php?acao=update">
              <input type="hidden" name="id" value="<?php echo $entidade['id'] ?? '' ?>">
              <h2>Atualizar</h2>
              <div class="input-field">
                <label for="telefone">Telefone</label>
                <input class="form-control" type="tel" require="required" id="telefone" name="telefone" pattern="(\([0-9]{2}\))\s([0-9]{5})-([0-9]{4})" title="Digite um telefone no formato: (xx) xxxxx-xxxx" value="<?php echo $entidade['telefone'] ?? '' ?>">
              </div>
              <div class="input-field">
                <label for="cep">CEP</label>
                <input class="form-control" type="text" require="required" id="cep" name="cep" pattern="[0-9]{5}-[0-9]{3}" title="Digite um CEP no formato: xxxxx-xx" value="<?php echo $entidade['cep'] ?? '' ?>">
              </div>
              <div class="input-field">
                <label for="numero">Número da empresa</label>
                <input class="form-control" type="number" require="required" id="numero" name="numero" value="<?php echo $entidade['numero'] ?? '' ?>">
              </div>
                  <div class="form-group">
                    <label for="descricaoitensestoque">Descrição dos itens que estão em estoque</label>
                    <textarea require="required" id="descricaoitensestoque" name="descricaoitensestoque" placeholder="Digite os itens no estoque" minlength="20" value="<?php echo $entidade['descricaoitensestoque'] ?? '' ?>"></textarea>
                  </div>
                  <button type="submit">Atualizar</button>
              </form>
          </div>
        </section>
      </main>
    </div>
  </body>
</html>