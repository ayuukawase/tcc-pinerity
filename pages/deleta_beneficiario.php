<?php

    if(!empty($_GET['id']))
    {
        include_once('../conexao_mysql.php');

        $id = $_GET['id'];

        $sqlSelect = "SELECT *  FROM beneficiario WHERE id=$id";

        $result = $conexao->query($sqlSelect);

        if($result->num_rows > 0)
        {
            $sqlDelete = "DELETE FROM beneficiario WHERE id=$id";
            $resultDelete = $conexao->query($sqlDelete);
        }
    }
    header('Location: ../index.html');
   
?>