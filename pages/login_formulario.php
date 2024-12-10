<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Projeto para Web com PHP</title>

    <link rel = "stylesheet" href="lib/bootstrap-4.2.1-dist/css/bootstrap.min.css">

</head>
<body>
    <div class="container">
        <div class="row" style="min-height: 500px;">
            <div class="col-md-10" style="padding-top: 50px;">
                <div class="card-header">Login</div>
                <div class="card-body">
                    <form method="post" action="../core/usuario_repositorio.php">
                        <input type="hidden" name="acao" value="login">
                        <div class="form-group">
                            <label for="email">E-mail</label>
                            <input class="form-control" type="text" require="required" id="email" name="email">
                        </div>
                        <div class="form-group">
                            <label for="senha">Senha</label>
                            <input class="form-control" type="password" require="required" id="senha" name="senha">
                        </div>
                        <div class="text-right">
                            <button class="btn btn-success" type="submit">Acessar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="lib/bootstrap-4.2.1-dist/js/bootstrap.min.js"></script>
</body>
</html>