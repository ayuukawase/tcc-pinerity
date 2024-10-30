<!DOCTYPE html>
<!-- Coding By CodingNepal - www.codingnepalweb.com -->
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  <link rel="stylesheet" href="../css/login.css">
</head>
<body>
  <div class="wrapper">
    <form method="post" action="../core/doadorfisico_repositorio.php">
    <input type="hidden" name="acao" value="login">
      <h2>Login</h2>
        <div class="input-field">
        <input type="text" require="required" id="cpf" name="cpf">
        <label for="cpf">Coloque com seu CPF</label>
      </div>
      <div class="input-field">
        <input type="password" type="password" require="required" id="senha" name="senha">
        <label for="senha">Coloque sua senha</label>
      </div>
      <div class="forget">
        <label for="remember">
          <input type="checkbox" id="remember">
          <p>Lembre-se de mim</p>
        </label>
        <a href="#">Esqueceu a senha?</a>
      </div>
      <button type="submit">Entrar</button>
      <div class="register">
        <p>Não tem uma conta? <a href="cadastrodoadorfisico.php">Cadastrar</a></p>
      </div>
    </form>
  </div>
</body>
</html>