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
            'numerocestas'      => $numerocestas,
            'tipoentrega'       => $tipoentrega,
            'id_distribuidora'  => $id_distribuidora,
            'beneficiario_id'   => $_SESSION['login']['beneficiario']['id']
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