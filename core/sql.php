<?php
    function insert(string $entidade, array $dados) : string
    {
        $instrucao = "INSERT INTO {$entidade}";

        $campos = implode(', ', array_keys($dados));
        $valores = implode(', ', array_values($dados));

        $instrucao .= " ({$campos})";
        $instrucao .= "  VALUES ({$valores})";

        return $instrucao;
    }
    function update(string $entidade, array $dados, array $criterio = []) : string
    {
        $instrucao = "UPDATE {$entidade}";

        foreach ($dados as $campo => $dado){
            $set[] = "{$campo} = {$dado}";
        }

        $instrucao .= ' SET ' . implode(',', $set);

        if(!empty($criterio)){
            $instrucao .= ' WHERE ';

            foreach($criterio as $expressao){
                $instrucao .= ' ' . implode(' ', $expressao);
            }
        }

        return $instrucao;
    }

    function delete(string $entidade, array $criterio = []) : string
    {
        $instrucao = "DELETE {$entidade}";

        if(!empty($criterio)){
            $instrucao .= ' WHERE ';

            foreach($criterio as $expressao){
                $instrucao .= ' ' . implode(' ', $expressao);
            }
        }

        return $instrucao;
    }

    function select(string $entidade, array $campos, array $criterio = [], string $ordem = null) : string
    {
        $instrucao = " SELECT " . implode(', ', $campos);
        $instrucao .= " FROM {$entidade}";

        if(!empty($criterio)){
            $instrucao .= ' WHERE ';

            foreach($criterio as $expressao){
                $instrucao .= ' ' . implode(' ', $expressao);
            }
        }

        if(!empty($ordem)){
            $instrucao .= " ORDER BY $ordem ";
        }

        return $instrucao;
    }
    
    function buscar(string $entidade, array $campos = ['*'], array $criterio = [], string $ordem = null) :  array 
    {
        $retorno = false;
        $coringa_criterio = [];

        foreach($criterio as $expressao) {
            $dado = $expressao[count($expressao) -1];

            $tipo[] = gettype($dado)[0];
            $expressao[count($expressao) - 1] = '?';
            $coringa_criterio[] = $expressao;

            $nome_campo = (count($expressao) < 4) ? $expressao[0] : $expressao[1];

            if(isset($$nome_campo)) {
                $nome_campo = $nome_campo . '_' . rand();
            }

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

        if($result = mysqli_stmt_get_result($stmt)) {
            $retorno = mysqli_fetch_all($result, MYSQLI_ASSOC);

            mysqli_free_result($result);
        }

        $_SESSION['errors'] = mysqli_stmt_error_list($stmt);

        mysqli_stmt_close($stmt);

        desconecta($conexao);

        $retorno = $retorno;

        return $retorno;
    }
?>