
<?php
include_once "boleto.php";
include_once "persistencia/PDOBoletoDAO.php";

define("DESTINO", "boleto_list.php");

function tela2array()
{
    $dados = array();

    $dados['id'] = $_REQUEST['id'] ?? 0;
    $dados['data_vencimento'] = $_REQUEST['data_vencimento'] ?? '';
    $dados['data_emissao'] = $_REQUEST['data_emissao'] ?? '';
    $dados['data_pagamento'] = $_REQUEST['data_pagamento'] ?? '';
    $dados['valor'] = $_REQUEST['valor'] ?? 0;
    $dados['desconto'] = $_REQUEST['desconto'] ?? 0;
    $dados['juros'] = $_REQUEST['juros'] ?? 0;
    $dados['multa'] = $_REQUEST['multa'] ?? 0;
    $dados['mora'] = $_REQUEST['mora'] ?? 0;
    $dados['valor_pago'] = $_REQUEST['valor_pago'] ?? 0;

    return $dados;
}

function array2objeto($dados)
{
    $boleto = new Boleto();

    $boleto->id = $dados['id'];
    $boleto->data_vencimento = $dados['data_vencimento'];
    $boleto->data_emissao = $dados['data_emissao'];
    $boleto->data_pagamento = $dados['data_pagamento'];
    $boleto->valor = $dados['valor'];
    $boleto->desconto = $dados['desconto'];
    $boleto->juros = $dados['juros'];
    $boleto->multa = $dados['multa'];
    $boleto->mora = $dados['mora'];
    $boleto->valor_pago = $dados['valor_pago'];

    return $boleto;
}

function carregar($id)
{
    $dados = PDOBoletoDAO::getInstance()->obter($id);

    if (!empty($dados)) {
        return array2objeto($dados);
    }

    return new Boleto();
}

function salvar()
{
    $dados = tela2array();
    $boleto = array2objeto($dados);

    PDOBoletoDAO::getInstance()->inserir($boleto);

    header("Location: " . DESTINO);
    exit;
}

function alterar()
{
    $dados = tela2array();
    $boleto = array2objeto($dados);

    PDOBoletoDAO::getInstance()->alterar($boleto);

    header("Location: " . DESTINO);
    exit;
}

function excluir()
{
    $id = $_REQUEST['id'] ?? 0;

    if ($id != 0) {
        PDOBoletoDAO::getInstance()->excluir($id);
    }

    header("Location: " . DESTINO);
    exit;
}

if (isset($_REQUEST['acao'])) {
    switch ($_REQUEST['acao']) {
        case 'Salvar':
            salvar();
            break;

        case 'Alterar':
            alterar();
            break;

        case 'excluir':
            excluir();
            break;
    }
}
?>
