<!DOCTYPE html>
<html lang="pt-BR">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="theme-color" content="#06b6d4" />
    <title>Painel do doador</title>
    <link rel="icon" alt="icon" href="../img/menulogo.png">
    <!-- CSS -->
    <link rel="stylesheet" href="../css/paineldoador.css" />

  </head>
  <body>
    <div id="content">
      <aside>
        <div class="logo">
          <i class="bi bi-speedometer2"></i>
          <h1>Pinerity</h1>
        </div>
        <ul class="menu">
          <li class="selecionado">
            <a href="#"><i class="bi bi-house"></i>Início</a>
          </li>
          <li>
            <a href="#"><i class="bi bi-chat"></i>Mensagens</a>
          </li>
          <li>
            <a href="#"><i class="bi bi-box2"></i>Histórico de doações</a>
          </li>
          <li>
            <a href="#"><i class="bi bi-journals"></i>Tarefas</a>
          </li>
          <li>
            <a href="#"><i class="bi bi-people"></i>Comunidades</a>
          </li>
          <li>
            <a href="#"><i class="bi bi-person"></i>Perfil</a>
          </li>
        </ul>
        <ul class="menu">
          <li>
            <a href="#"><i class="bi bi-gear"></i>Configurações</a>
          </li>
          <li>
            <a href="#"><i class="bi bi-info-circle"></i>Ajuda</a>
          </li>
          <li>
            <a href="core/beneficiario_repositorio.php?acao=logout"><i class="bi bi-box-arrow-right"></i>Sair</a>
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
          <h2>Cadastro da doação de cesta básica</h2>
          <div class="card">
          <div>

  <form>
    <fieldset class="grupo">
        <div class="campo">
        <label for="descricao_itens"><strong>Descrição dos itens da cesta básica</strong></label>
        <br>
        <textarea require="required" id="descricao_itens" name="descricao_itens" value="<?php echo $entidade['descricao_itens'] ?? '' ?>"></textarea>
        </div>
        <br>
        <div class="campo">
        <label for="doadorfisico_id"><strong>Doador</strong></label> <!--arrumar-->
        <br>
        <input type="text" name="doadorfisico_id" id="doadorfisico_id" require="required">
        </div>
        <br>
        <div>
            <label for="empresadistribuicao">Empresa que irá doar a cesta</label>
            <br>
            <select name="empresadistribuicao" id="empresadistribuicao">
                <?php
                    include('../includes/conexao.php');
                    $sql = "SELECT * FROM empresadistribuicao";
                    $result = mysqli_query($con, $sql);
                    while ($row = mysqli_fetch_array($result)) {
                        echo "<option value='" . $row['id'] . "'>" . $row['cnpj'] . "/" . $row['nome_empresarial'] . "</option>";
                    }
                ?>
            </select>
        </div>
        <button class="botao" type="submit">Cadastrar doação de cesta básica</button>
    </fieldset>
    <br>
    </form>
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