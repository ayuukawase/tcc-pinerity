<?php
    session_start();
    require_once '../includes/funcoes.php';
    require_once 'conexao_mysql.php';
    require_once 'sql.php';
    require_once 'mysql.php';
    $salt = '$exemplosaltifsp';

    foreach($_POST as $indice => $dado){
        $$indice = limparDados($dado);
    }

    foreach($_GET as $indice => $dado){
        $$indice = limparDados($dado);
    }

    //verificar no banco de dados se funcionou
    switch($acao){
        case 'update':
            $id = (int)$id;
            $dados = [
                'telefone'      => $telefone,
                'cep'           => $cep,
                'num'           => $num,
            ];

            $criterio = [
                ['id', '=', $id]
            ];

            atualiza(
                'doadorfisico',
                $dados,
                $criterio
            );

            break;

        case 'login':
            $criterio = [
                ['cpf', '=', $cpf],
                ['AND', 'ativo', '=', 1]
            ];
            $retorno = buscar(
                'doador',
                ['id', 'nome', 'cpf', 'email', 'senha'],
                $criterio
            );

            if(count($retorno)> 0){
                if(crypt($senha,$salt) == $retorno[0]['senha']){
                    $_SESSION['login']['doadorfisico'] = $retorno[0];
                    if(!empty($_SESSION['url_retorno'])){
                        header('Location: '. $_SESSION['url_retorno']);
                        $_SESSION['url_retorno'] = '';
                        exit;
                    }
                }
            }

            break;

        case 'logout':
            session_destroy();
            break;
            
    }
    header('Location: ../pages/paineldoador.php');
?>