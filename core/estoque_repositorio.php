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
            'tipoentrega'   => $tipoentrega
            'beneficiario_id'   => $_SESSION['login']['beneficiario']['id']
        ];

        insere(
            'pedido',
            $dados
        );

        break;

    case 'update':
        $dados = [
            'tipoentrega'   => $tipoentrega
            'beneficiario_id'   => $_SESSION['login']['beneficiario']['id']
        ];

        $criterio = [
            ['id', '=', $id]
        ];
        atualiza(
            'pedido',
            $dados,
            $criterio
        );
        break;

    case 'delete':
        $criterio = [
            ['id', '=', $id]
        ];

        deleta(
            'pedido',
            $criterio
        );
        break;
}

?>