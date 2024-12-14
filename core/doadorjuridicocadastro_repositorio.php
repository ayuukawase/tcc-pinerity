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
            $dadosjuridico = [
                'cnpj'              => $cnpj,
                'nome_fantasia'     => $nome_fantasia,
                'nome_empresarial'  => $nome_empresarial,
            ];

            insere(
                'doadorjuridico',
                $dadosjuridico
            );


            $dadosdoador = [
                'email'             => $email,
                'telefone'          => $telefone,
                'cep'               => $cep,
                'numero'            => $numero,
                'senha'             => crypt($senha, $salt)
            ];

            insere(
                'doador',
                $dadosdoador
            );

            break;

        case 'login':
            $criterio = [
                ['cnpj', '=', $cnpj],
                ['AND', 'ativo', '=', 1]
            ];
            $retorno = buscar(
                'doadorjuridico',
                ['id', 'nome', 'cnpj', 'senha'],
                $criterio
            );

            if(count($retorno)> 0){
                if(crypt($senha,$salt) == $retorno[0]['senha']){
                    $_SESSION['login']['doadorjuridico'] = $retorno[0];
                    if(!empty($_SESSION['url_retorno'])){
                        header('Location: '. $_SESSION['url_retorno']);
                        $_SESSION['url_retorno'] = '';
                        exit;
                    }
                }
            }

            break;
            
    }
    header('Location: ../pages/logindoadorjuridico.php');
?>