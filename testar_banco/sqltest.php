<?php
    require_once '../core/sql.php';

    $id = 1;
    $nome = 'Nicoli';
    $NIS = '12345678910';
    $cpf = '51330461894';
    $telefone = '(18) 98809-6264';
    $email = 'bianewlife@gmail.com';
    $cep = '12345-065';
    $numero = '1393';
    $folha_resumo = '1';
    $n_integrantes = '13';
    $senha = '1393';
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
        'senha'         => $senha];

    $entidade = 'beneficiario';
    $criterio = [['id', '=', $id]];
    $campos = ['nome', 'NIS', 'cpf', 'telefone', 'email', 'cep', 'numero', 'folha_resumo', 'n_integrantes', 'senha'];

    print_r($dados);
    echo '<br>';
    print_r($campos);
    echo '<br>';
    print_r($criterio);
    echo '<br>';

    //teste geração do insert
    $instrucao = insert($entidade, $dados);
    echo $instrucao.'<br>';

    //teste geração do update
    $instrucao = update($entidade, $dados, $criterio);
    echo $instrucao.'<br>';

    //teste geração do select
    $instrucao = select($entidade, $campos, $criterio);
    echo $instrucao.'<br>';

    //teste geração do delete
    $instrucao = delete($entidade, $criterio);
    echo $instrucao.'<br>';
?>