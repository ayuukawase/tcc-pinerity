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
            $dadosfisico = [
                'cpf'           => $cpf,
                'nome'          => $nome,
                'dt_nasc'       => $dt_nasc,
            ];

            insere(
                'doadorfisico',
                $dadosfisico
            );

            
            $dadosdoador = [
                'telefone'      => $telefone,
                'email'         => $email,
                'cep'           => $cep,
                'numero'        => $numero,
                'senha'         => crypt($senha, $salt)  
            ];

            insere(
                'doador',
                $dadosdoador
            );

            break;
        
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
            /*$retorno = buscar(
                'usuario',
                ['id', 'nome', 'email', 'senha', 'adm'],
                $criterio
            );*/

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

        case 'status':
            $id = (int)$id;
            $valor = (int)$valor;

            $dados = [
                'ativo' => $valor
            ];

            $criterio = [
                ['id', '=', $id]
            ];

            atualiza(
                'doadorfisico',
                $dados,
                $criterio
            );

            exit;
            break;
            
    }
    header('Location: ../pages/paineldoador.html');
?>