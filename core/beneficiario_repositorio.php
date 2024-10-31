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
        
        case 'update':
            $id = (int)$id;
            $dados = [
                'telefone'      => $telefone,
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
                ['NIS', '=', $NIS],
                ['AND', 'ativo', '=', 1]
            ];
            $retorno = buscar(//descobrir o que faz
                'beneficiario',
                ['id', 'nome', 'email', 'senha', 'adm'],
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
        
        case 'logout':
            session_destroy();
            break;

        /*case 'status':
            $id = (int)$id;
            $valor = (int)$valor;

            $dados = [
                'ativo' => $valor
            ];

            $criterio = [
                ['id', '=', $id]
            ];

            atualiza(
                'Beneficiario',
                $dados,
                $criterio
            );*/
            exit;
            break;
            
    }
    header('Location: ../pages/painelbeneficiario.html');
?>