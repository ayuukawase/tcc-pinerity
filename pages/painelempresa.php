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
            <a href="painelbeneficiario"><i class="bi bi-house"></i>Início</a>
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
        <section class="projetos">
          <h2>Projetos das ONGs</h2>
          <div>
            <div class="card">
              <div class="barra"></div>
              <div class="conteudo">
                <h3>Projeto de Natal</h3>
                <p>
                  Lorem ipsum dolor sit amet consectetur adipisicing elit. Hic
                  qui magni libero sunt quisquam quia!
                </p>
                <div class="acoes">
                  <button title="Favoritar"><i class="bi bi-star"></i></button>
                  <button title="Visualizar"><i class="bi bi-eye"></i></button>
                  <button title="Compartilhar">
                    <i class="bi bi-share"></i>
                  </button>
                </div>
              </div>
            </div>
            <div class="card">
              <div class="barra"></div>
              <div class="conteudo">
                <h3>Projeto de páscoa</h3>
                <p>
                  Lorem ipsum dolor sit, amet consectetur adipisicing elit.
                  Eveniet adipisci incidunt nulla. Dolorem repellat error alias
                  corporis cupiditate, dolorum natus iusto eveniet aliquid
                  temporibus nam quaerat.
                </p>
                <div class="acoes">
                  <button title="Favoritar"><i class="bi bi-star"></i></button>
                  <button title="Visualizar"><i class="bi bi-eye"></i></button>
                  <button title="Compartilhar">
                    <i class="bi bi-share"></i>
                  </button>
                </div>
              </div>
            </div>
            <div class="card">
              <div class="barra"></div>
              <div class="conteudo">
                <h3>Projeto de Ano Novo</h3>
                <p>
                  Lorem ipsum dolor sit amet consectetur adipisicing elit. Ea
                  culpa unde non voluptas ut!
                </p>
                <div class="acoes">
                  <button title="Favoritar"><i class="bi bi-star"></i></button>
                  <button title="Visualizar"><i class="bi bi-eye"></i></button>
                  <button title="Compartilhar">
                    <i class="bi bi-share"></i>
                  </button>
                </div>
              </div>
            </div>
            <div class="card">
              <div class="barra"></div>
              <div class="conteudo">
                <h3>Projeto inverno</h3>
                <p>
                  Lorem ipsum dolor sit amet consectetur adipisicing elit. Esse
                  reiciendis quam quis vitae amet, numquam expedita, in ratione,
                  repellendus facilis ea architecto!
                </p>
                <div class="acoes">
                  <button title="Favoritar"><i class="bi bi-star"></i></button>
                  <button title="Visualizar"><i class="bi bi-eye"></i></button>
                  <button title="Compartilhar">
                    <i class="bi bi-share"></i>
                  </button>
                </div>
              </div>
            </div>
          </div>
        </section>
        <section class="anuncios">
          <h2>Anúncios</h2>
          <div class="card">
            <div>
              <h4>Manutenção do site</h4>
              <p>
                Lorem ipsum, dolor sit amet consectetur adipisicing elit. Esse
                recusandae assumenda alias dolores?
              </p>
            </div>
            <div>
              <h4>Dia do compartilhamento</h4>
              <p>
                Lorem, ipsum dolor sit amet consectetur adipisicing elit.
                Placeat suscipit ad omnis.
              </p>
            </div>
            <div>
              <h4>Política de privacidade atualizada</h4>
              <p>
                Lorem ipsum, dolor sit amet consectetur adipisicing elit.
                Dignissimos, minus voluptatem fugit adipisci facere nulla
                officia.
              </p>
            </div>
          </div>
        </section>
      </main>
    </div>

    <script>
      const footer = document.getElementById("texto-footer");
      footer.innerText = `Pinerity, ${new Date().getFullYear()}`;
    </script>
  </body>
</html>
