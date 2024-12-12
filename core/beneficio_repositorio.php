<?php
session_start();
require_once '../includes/valida_login.php';
require_once '../includes/funcoes.php';
require_once 'conexao_mysql.php';
require_once 'sql.php';
require_once 'mysql.php';

foreach($_POST as $indice => $dado){
    $$indice = limparDados($dado);
}

foreach($_GET as $indice => $dado){
    $$indice = limparDados($dado);
}

$id = (int)$id;

switch($acao){
    case 'insert':
        $dados = [
            'qtd_cestas'      => $qtd_cestas,
            'pedido_id'       => $pedido_id ,
               ];

        insere(
            'beneficio',
            $dados
        );

        break;

    case 'delete':
        $criterio = [
            ['id', '=', $id]
        ];

        deleta(
            'beneficio',
            $criterio
        );
        break;
}
header('Location: ../pages/painelbeneficiario.html');
?>