<?php
    include'conexao_mysql.php';
    $id = $_GET['id'];
    $sql = "SELECT * FROM cliente WHERE id=$id";
    $result = mysqli_query($con,$sql);
    $row = mysqli_fetch_array($result);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="styles.css">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alteração de Cliente</title>
    <?php
        include('menu.php');
    ?>
</head>
<body>
    <form action="AlteraClienteExe.php" method="post">
        <fieldset>
        <legend>Ateração de Cliente</legend>
        <div>
            <label for="nome">Nome</label>
            <input type="text" 
                   name="nome" 
                   id="nome"
                   value="<?php echo $row['nome']?>">
        </div>
        <div>
            <label for="email">E-mail</label>
            <input type="text" 
                   name="email" 
                   id="email"
                   value="<?php echo $row['email']?>">
        </div>
        <div>
            <label for="senha">Senha</label>
            <input type="password" 
                   name="senha" 
                   id="senha"
                   value="<?php echo $row['senha']?>">
        </div>
        <div>
            <label for="ativo">Situação</label>
            <input type="hidden" name="ativo" id="ativo" value="0">
            <input type="checkbox" name="ativo" id="ativo" value="1" <?php echo $row['ativo']==1? "checked" :"" ?> >Ativo <br><br>
        </div>        

        <div>
            <label for="cidade">Cidade</label>
            <select name="cidade" id="cidade">
                <?php
                    $sqlCidade = "SELECT * FROM cidade";
                    $result = mysqli_query($con, $sqlCidade);                    
                    while($row_cid = mysqli_fetch_array($result)){
                        $sel = $row_cid['id'] == $row['id_cidade']?"selected":"";
                        echo "<option value='".$row_cid['id']."'".$sel.">".$row_cid['nome']."/".$row_cid['estado']."</option>";
                    }
                    
                ?>
            </select>
        </div>
        <input type="hidden" name="id" 
               value="<?php echo $row['id']?>">
        <div>
            <button type="submit">Alterar</button>
        </div>        
        </fieldset>
    </form>
</body>
</html>