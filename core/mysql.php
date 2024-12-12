<?php
    //insere
    function insere(string $entidade, array $dados) : bool
    {
        $retorno = false;

        foreach($dados as $campo => $dado){
            $coringa[$campo] = '?';
            $tipo[] = gettype($dado)[0];
            $$campo = $dado;
        }

        $instrucao = insert($entidade, $coringa);

        echo $instrucao;
        $conexao = conecta();

        //prepara para conectar com o sql
        $stmt = mysqli_prepare($conexao, $instrucao);

        eval('mysqli_stmt_bind_param($stmt, \''.implode('', $tipo). '\', $'.implode(', $', array_keys($dados)) . ');');

        mysqli_stmt_execute($stmt);

        $retorno = (boolean) mysqli_stmt_affected_rows($stmt);

        $_SESSION['errors'] = mysqli_stmt_error_list($stmt);

        mysqli_stmt_close($stmt);

        desconecta($conexao);

        return $retorno;
    }
    //atualiza
    function atualiza (string $entidade, array $dados, array $criterio = []): bool
    {
        $retorno = false;

        foreach ($dados as $campo => $dado) {
            $coringa_dados [$campo] = '?';
            $tipo[] = gettype($dado) [0]; 
            $$campo = $dado;
        }

        foreach ($criterio as $expressao){

            $dado = $expressao [count ($expressao) -1];

            $tipo[] = gettype($dado)[0];
            $expressao [count ($expressao) - 1] = '?';
            $coringa_criterio[] = $expressao;

            $nome_campo = (count($expressao) < 4) ? $expressao[0]: $expressao[1];
        
            if (isset($nome_campo)){

                $nome_campo = $nome_campo . '_'. rand();
            }
        
            $campos_criterio[] = $nome_campo;
            $$nome_campo = $dado;
        }

        $instrucao = update($entidade, $coringa_dados, $coringa_criterio);

        $conexao = conecta();

        $stmt = mysqli_prepare($conexao, $instrucao);

        if(isset($tipo)){
            $comando = 'mysqli_stmt_bind_param($stmt, ';
            $comando .= "'" . implode('', $tipo). "'";
            $comando .=  ', $' . implode(', $', array_keys ($dados)); 
            $comando .= ', $' . implode(', $', $campos_criterio);
            $comando .= ');';

            eval($comando);
        }

        mysqli_stmt_execute($stmt);

        $retorno = (boolean) mysqli_stmt_affected_rows($stmt);

        $_SESSION['errors'] =  mysqli_stmt_error_list($stmt);

        mysqli_stmt_close($stmt);

        desconecta ($conexao);

        return $retorno;
    }

    //deleta
    function deleta (string $entidade, array $criterio = []) : bool
    {
        $retorno = false;
        $coringa_criterio = [];

        foreach ($criterio as $expressao){
            $dado = $expressao[count($expressao)-1];

            $tipo[] = gettype($dado) [0];
            $expressao[count ($expressao) -1] = '?';
            $coringa_criterio[] = $expressao;
        
            $nome_campo = (count($xpressao) < 4) ? $expressao[0] : $expressao[1];

            $campos_criterio[] = $nome_campo;

            $$nome_campo = $dado;
        }

        $instrucao = delete($entidade, $coringa_criterio);

        $conexao = conecta();

        $stmt = mysqli_prepare($conexao, $instrucao);

        if(isset($tipo)){
            $comando = 'mysqli_stmt_bind_param($stmt, ';
            $comando .= "'" . implode('', $tipo). "'";
            $comando .= ', $' . implode(', $', $campos_criterio);
            $comando .= ');';

            eval($comando);
        }

        mysqli_stmt_execute($stmt);

        $retorno = (boolean) mysqli_stmt_affected_rows($stmt);
        
        $_SESSION['errors'] = mysqli_stmt_error_list($stmt);
        
        mysqli_stmt_close($stmt);
        
        desconecta ($conexao);
        
        return $retorno;
    }

    //buscar
    function selecionar(string $entidade, array $campos = ['*'], array $criterio = [], string $ordem = null) :  array 
    {
        $retorno = false;
        $coringa_criterio = [];

        foreach($criterio as $expressao) {
            $dado = $expressao[count($expressao) -1];

            $tipo[] = gettype($dado)[0];
            $expressao[count($expressao) - 1] = '?';
            $coringa_criterio[] = $expressao;

            $nome_campo = (count($expressao) < 4) ? $expressao[0] : $expressao[1];

            $campos_criterio[] = $nome_campo;
            
            $$nome_campo = $dado;
        }

        $instrucao = select($entidade, $campos, $coringa_criterio, $ordem);
        // para testar o banco = echo $instrucao;
        $conexao = conecta();

        $stmt = mysqli_prepare($conexao, $instrucao);

        if(isset($tipo)) {
            $comando = 'mysqli_stmt_bind_param($stmt, ';
            $comando .= "'" . implode('', $tipo). "'";
            $comando .= ', $' . implode(', $', $campos_criterio);
            $comando .= ');';

            eval($comando);
        }

        mysqli_stmt_execute($stmt);

        $retorno = (boolean) mysqli_stmt_affected_rows($stmt);

        $_SESSION['errors'] = mysqli_stmt_error_list($stmt);

        mysqli_stmt_close($stmt);

        desconecta($conexao);

        return $retorno;
    }
?>