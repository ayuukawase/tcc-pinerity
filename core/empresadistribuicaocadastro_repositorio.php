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
        case 'insert':
            $dados = [
                'nome_fantasia'         => $nome_fantasia,
                'nome_empresarial'      => $nome_empresarial,
                'cnpj'                  => $cnpj,
                'email'                 => $email,
                'telefone'              => $telefone,
                'cep'                   => $cep,
                'numero'                => $numero,
                'descricaoitensestoque' => $descricaoitensestoque,
                'senha'                 => crypt($senha, $salt)
            ];

            insere(
                'empresadistribuicao',
                $dados
            );

            break;
        
        case 'login':
            $criterio = [
                ['id', '=', $id],
                ['AND', 'ativo', '=', 1]
            ];
            $retorno = buscar(
                'empresadistribuicao',
                ['id', 'nome', 'CNPJ', 'senha'],
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

            case 'delete':
                $id = (int)$id;
                $criterio = [
                    ['id', '=', $id]
                ];
            
                deleta(
                    'empresadistribuicao',
                    $criterio
                );
                break;

            case 'logout':
                session_destroy();
                break;
        
    }
    header('Location: ../pages/loginempresa.php');
?>