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
                'nome'          => $nome,
                'NIS'           => $NIS,
                'cpf'           => $cpf,
                'telefone'      => $telefone,
                'email'         => $email,
                'cep'           => $cep,
                'numero'        => $numero,
                'folha_resumo'  => $folha_resumo,
                'n_integrantes' => $n_integrantes,
                'senha'         => crypt($senha, $salt)
            ];

            insere(
                'beneficiario',
                $dados
            );

            break;
        
        case 'login':
            $criterio = [
                ['NIS', '=', $NIS]
            ];
            $retorno = buscar(
                'beneficiario',
                [ 'id', 'nome', 'NIS', 'cpf', 'telefone', 'email', 'cep', 'numero', 'folha_resumo', 'n_integrantes'],
                $criterio
            );

            if(count($retorno)> 0){
                if(crypt($senha,$salt) == $retorno[0]['senha']){
                    $_SESSION['login']['beneficiario'] = $retorno[0];
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
                    'beneficiario',
                    $criterio
                );
                break;
    

            case 'logout':
                session_destroy();
                break;
                
    }
    header('Location: ../pages/loginbeneficiario.php');
?>