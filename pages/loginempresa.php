<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  <link rel="stylesheet" href="../css/login.css">
  <link rel="icon" alt="icon" href="../img/menulogo.png">
</head>
<body>
  <div class="wrapper">
    <form action="#">
      <h2>Login</h2>
        <div class="input-field">
        <input type="text" required>
        <label>Coloque com seu CNPJ</label>
      </div>
      <div class="input-field">
        <input type="password" required>
        <label>Coloque sua senha</label>
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
        <p>Não tem uma conta? <a href="cadastroempresadistribuicao.php">Cadastrar</a></p>
      </div>
    </form>
  </div>
</body>
</html>