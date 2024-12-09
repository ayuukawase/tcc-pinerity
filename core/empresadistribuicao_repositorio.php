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
        
        case 'update':
            $cnpj = (int)$cnpj;
            $dados = [
                'telefone'      => $telefone,
                'cep'           => $cep,
                'num'           => $num,
                'descricaoitensestoque' => $descricaoitensestoque
            ];

            $criterio = [
                ['cnpj', '=', $cnpj]
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
                ['AND', 'ativo', '=', 1]
            ];
            /*$retorno = buscar(
                'usuario',
                ['id', 'nome', 'email', 'senha', 'adm'],
                $criterio
            );*/

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
        
        case 'logout':
            session_destroy();
            break;
    
    }
    header('Location: ../pages/painelempresadistribuicao.html');
?>