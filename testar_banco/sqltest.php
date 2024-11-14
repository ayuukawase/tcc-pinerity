<?php
    require_once '../core/sql.php';

    $id = 1;
    $nome = 'mili';
    $email = 'mili@email.com';
    $senha = '2024haha';
    $dados = ['nome' => $nome,
              'email'=> $email,
              'senha' => $senha];

    $entidade = 'usuario';
    $criterio = [['id', '=', $id]];
    $campos = ['id', 'nome', 'email'];

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