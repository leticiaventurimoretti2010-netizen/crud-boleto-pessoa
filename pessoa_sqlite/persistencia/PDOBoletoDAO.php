
<?php
include_once __DIR__ . "/BoletoDAO.php";

class PDOBoletoDAO extends BoletoDAO
{
    private static $instance = NULL;
    private $conn = NULL;

function __construct()
{
    $this->connect();
}

    public static function getInstance()
    {
        if (self::$instance == NULL)
            self::$instance = new PDOBoletoDAO();

        return self::$instance;
    }

    function connect()
    {
        try {
            $this->conn = new PDO(
                'sqlite:' . __DIR__ . '/pessoas.db'
            );

            $this->conn->setAttribute(
                PDO::ATTR_ERRMODE,
                PDO::ERRMODE_EXCEPTION
            );
        } catch (PDOException $e) {
            error_log('Error: ' . $e->getMessage());
        }
    }

    function inserir($objeto)
    {
        try {
            $stmt = $this->conn->prepare(
                'INSERT INTO boleto
                (data_vencimento, data_emissao, data_pagamento,
                valor, desconto, juros, multa, mora, valor_pago)
                VALUES
                (:data_vencimento, :data_emissao, :data_pagamento,
                :valor, :desconto, :juros, :multa, :mora, :valor_pago)'
            );

            $stmt->execute(array(
                ':data_vencimento' => $objeto->data_vencimento,
                ':data_emissao' => $objeto->data_emissao,
                ':data_pagamento' => $objeto->data_pagamento,
                ':valor' => $objeto->valor,
                ':desconto' => $objeto->desconto,
                ':juros' => $objeto->juros,
                ':multa' => $objeto->multa,
                ':mora' => $objeto->mora,
                ':valor_pago' => $objeto->valor_pago
            ));
        } catch (PDOException $e) {
            print 'Error: ' . $e->getMessage();
        }
    }

    function alterar($objeto)
    {
        try {
            $stmt = $this->conn->prepare(
                'UPDATE boleto SET
                data_vencimento = :data_vencimento,
                data_emissao = :data_emissao,
                data_pagamento = :data_pagamento,
                valor = :valor,
                desconto = :desconto,
                juros = :juros,
                multa = :multa,
                mora = :mora,
                valor_pago = :valor_pago
                WHERE id = :id'
            );

            $stmt->execute(array(
                ':id' => $objeto->id,
                ':data_vencimento' => $objeto->data_vencimento,
                ':data_emissao' => $objeto->data_emissao,
                ':data_pagamento' => $objeto->data_pagamento,
                ':valor' => $objeto->valor,
                ':desconto' => $objeto->desconto,
                ':juros' => $objeto->juros,
                ':multa' => $objeto->multa,
                ':mora' => $objeto->mora,
                ':valor_pago' => $objeto->valor_pago
            ));
        } catch (PDOException $e) {
            print 'Error: ' . $e->getMessage();
        }
    }

    function excluir($id)
    {
        try {
            $stmt = $this->conn->prepare(
                'DELETE FROM boleto WHERE id = :id'
            );

            $stmt->execute(array(':id' => $id));
        } catch (PDOException $e) {
            print 'Error: ' . $e->getMessage();
        }
    }

    function listar()
    {
        $dados = array();

        try {
            $result = $this->conn->query(
                'SELECT * FROM boleto'
            );

            while ($linha = $result->fetch(PDO::FETCH_ASSOC)) {
                $dados[] = $linha;
            }
        } catch (PDOException $e) {
            print 'Error: ' . $e->getMessage();
        }

        return $dados;
    }

    function listar_filtro($filtro)
    {
        $dados = array();

        try {
            $stmt = $this->conn->prepare(
                'SELECT * FROM boleto WHERE CAST(id AS TEXT) LIKE :filtro'
            );

            $stmt->execute(array(
                ':filtro' => '%' . $filtro . '%'
            ));

            while ($linha = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $dados[] = $linha;
            }
        } catch (PDOException $e) {
            print 'Error: ' . $e->getMessage();
        }

        return $dados;
    }

    function obter($id)
    {
        try {
            $stmt = $this->conn->prepare(
                'SELECT * FROM boleto WHERE id = :id'
            );

            $stmt->execute(array(':id' => $id));

            return $stmt->fetch(PDO::FETCH_ASSOC) ?: array();
        } catch (PDOException $e) {
            print 'Error: ' . $e->getMessage();
            return array();
        }
    }
}
?>