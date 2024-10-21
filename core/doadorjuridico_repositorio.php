<?php
    session_start();
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
                'cnpj'              => $cnpj,
                'nome_fantasia'     => $nome_fantasia,
                'nome_empresarial'  => $nome_empresarial,
                'cep'               => $cep,
                'num'               => $num,
                'telefone'          => $telefone,
                'email'             => $email,
                'senha'             => crypt($senha, $salt)
            ];

            insere(
                'usuario',
                $dados
            );

            break;
        
        case 'update':
            $id = (int)$id;
            $dados = [
                'telefone'      => $telefone,
                'CEP'           => $cep,
                'num'           => $num,
            ];

            $criterio = [
                ['id', '=', $id]
            ];

            atualiza(
                'usuario',
                $dados,
                $criterio
            );

            break;

        case 'login':
            $criterio = [
                ['cnpj', '=', $cnpj],
                ['AND', 'ativo', '=', 1]
            ];
            /*$retorno = buscar(
                'usuario',
                ['id', 'nome', 'email', 'senha', 'adm'],
                $criterio
            );*/

            if(count($retorno)> 0){
                if(crypt($senha,$salt) == $retorno[0]['senha']){
                    $_SESSION['login']['usuario'] = $retorno[0];
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
                'usuario',
                $dados,
                $criterio
            );

            exit;
            break;
            
    }
    header('Location: ../index.php');
?>