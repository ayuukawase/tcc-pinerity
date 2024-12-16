<?php
    require_once '../core/conexao_mysql.php';
    require_once '../core/sql.php';
    require_once '../core/mysql.php';

    //é o teste mostrado na tela
    insert_teste('Nicoli', '12345678910', '(18) 98809-6264', 'niii@ifsp.edu.br', '12345-678', '1393', '', '13', '1393');
    buscar_teste();

    //teste da inserção no banco de dados
    function insert_teste($nome, $NIS, $cpf, $telefone, $email, $cep, $numero, $folha_resumo, $n_integrantes, $senha) : void
    {
        $dados = ['nome' => $nome, 'NIS' => $NIS, 'cpf' => $cpf, 'telefone' => $telefone, 'email' => $email, 'cep' => $cep, 'numero' => $numero, 'folha_resumo' => $folha_resumo, 'n_integrantes' => $n_integrantes, 'senha' => $senha];
        insere('beneficiario', $dados);
    }

    //teste do select no banco de dados
    function buscar_teste() : void 
    {
        $beneficiario = buscar('beneficiario', [$nome, $NIS, $cpf, $telefone, $email, $cep, $numero, $folha_resumo, $n_integrantes, $senha], [],'');
        print_r($beneficiario);
    }

    //teste do update no banco de dados
    function update_teste($id, $nome, $email) : void 
    {
        $dados = ['nome' => $nome, 'email' => $email];
        $criterio = [['id', '=', '$id']];
        atualiza('beneficiario', $dados, $criterio);
    }

    function delete_teste($id) : void 
    {
        $criterio = [['id', '=', '$id']];
        atualiza('beneficiario', $criterio);
    }
?>