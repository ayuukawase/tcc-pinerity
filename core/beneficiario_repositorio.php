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
                'telefone'      => $telefone
            ];

            $criterio = [
                ['id', '=', $id]
            ];

            atualiza(
                'beneficiario',
                $dados,
                $criterio
            );

            break;

        case 'login':
            $criterio = [
                ['NIS', '=', $NIS]
            ];
            $retorno = buscar(
                'beneficiario',
                ['id', 'nome', 'NIS', 'senha'],
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
                $id = isset($_POST['id']) ? $_POST['id'] : null; 
                if ($id) 
                { 
                    $criterio = [ ['id', '=', $id] ]; 
                    deleta('beneficiario', $criterio); 
                } 
                else 
                { 
                    echo 'ID não fornecido.'; 
                } 
                break;
                /*$id = $_GET['id'];
                
                $criterio = [
                    ['id', '=', $id]
                ];
            
                deleta(
                    'beneficiario',
                    $criterio
                );*/
                break;
            
    }
    header('Location: ../pages/painelbeneficiario.php');
?>