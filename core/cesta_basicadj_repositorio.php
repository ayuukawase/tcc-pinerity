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
            'descricao_itens'   => $titulo,
            'DoadorJuridico_id'   => $_SESSION['login']['DoadorJuridico']['id']
        ];

        insere(
            'CestaBasica',
            $dados
        );

        break;

    case 'update':
        $dados = [
            'descricao_itens'   => $titulo,
            'DoadorJuridico_id'   => $_SESSION['login']['DoadorJuridico']['id']
        ];

        $criterio = [
            ['id', '=', $id]
        ];
        atualiza(
            'CestaBasica',
            $dados,
            $criterio
        );
        break;

    case 'delete':
        $criterio = [
            ['id', '=', $id]
        ];

        deleta(
            'CestaBasica',
            $criterio
        );
        break;
}

?>