
<?php

abstract class BoletoDAO {

    public abstract function connect();

    public abstract function inserir($objeto);

    public abstract function alterar($objeto);

    public abstract function excluir($id);

    public abstract function listar();

    public abstract function listar_filtro($filtro);

    public abstract function obter($id);
}

?>
