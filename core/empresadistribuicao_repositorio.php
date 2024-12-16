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
                'numero'        => $numero,
                'descricaoitensestoque' => $descricaoitensestoque
            ];

            $criterio = [
                ['id', '=', $id]
            ];

            atualiza(
                'empresadistribuicao',
                $dados,
                $criterio
            );

            break;

        case 'login':
            $criterio = [
                ['cnpj', '=', $cnpj],
            ];
            
            $retorno = buscar(
                'empresadistribuicao',
                ['id', 'nome_fantasia', 'cnpj', 'senha'],
                $criterio
            );

            if(count($retorno)> 0){
                if(crypt($senha,$salt) == $retorno[0]['senha']){
                    $_SESSION['login']['empresadistribuicao'] = $retorno[0];
                    if(!empty($_SESSION['url_retorno'])){
                        header('Location: '. $_SESSION['url_retorno']);
                        $_SESSION['url_retorno'] = '';
                        exit;
                    }
                }
            }

            break;
    
    }
    header('Location: ../pages/painelempresa.php');
?>