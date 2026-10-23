
<?php
/*
 * Página responsável pelo formulário de cadastro da entidade Boleto
 */
?>
<!DOCTYPE html>
<html lang="pt-BR" data-theme="ligth">

<?php include 'cabecalho.php'; ?>

<?php
include_once 'boleto_acao.php';

$id = isset($_GET['id']) ? $_GET['id'] : 0;

$boleto = new Boleto();

if ($id != 0) {
    $boleto = carregar($id);
}

function valorCampo($valor)
{
    return htmlspecialchars(
        (string)($valor ?? ''),
        ENT_QUOTES,
        'UTF-8'
    );
}
?>

<body>

    <header class="container">
        <?php include 'menu.php'; ?>
    </header>

    <main class="container">

        <form action="boleto_acao.php" method="post">

            <fieldset>
                <legend>
                    <?php
                    if ($id == 0)
                        echo "Cadastro de Boletos";
                    else
                        echo "Alteração de Boletos";
                    ?>
                </legend>

                <label for="id">Id</label>
                <input
                    type="text"
                    name="id"
                    id="id"
                    value="<?= valorCampo($boleto->id) ?>"
                    readonly
                ><br>

                <label for="data_vencimento">Data de Vencimento</label>
                <input
                    type="date"
                    name="data_vencimento"
                    id="data_vencimento"
                    value="<?= valorCampo($boleto->data_vencimento) ?>"
                    required
                ><br>

                <label for="data_emissao">Data de Emissão</label>
                <input
                    type="date"
                    name="data_emissao"
                    id="data_emissao"
                    value="<?= valorCampo($boleto->data_emissao) ?>"
                    required
                ><br>

                <label for="data_pagamento">Data de Pagamento</label>
                <input
                    type="date"
                    name="data_pagamento"
                    id="data_pagamento"
                    value="<?= valorCampo($boleto->data_pagamento) ?>"
                ><br>

                <label for="valor">Valor</label>
                <input
                    type="number"
                    name="valor"
                    id="valor"
                    step="0.01"
                    min="0"
                    value="<?= valorCampo($boleto->valor) ?>"
                    required
                ><br>

                <label for="desconto">Desconto</label>
                <input
                    type="number"
                    name="desconto"
                    id="desconto"
                    step="0.01"
                    min="0"
                    value="<?= valorCampo($boleto->desconto ?? 0) ?>"
                ><br>

                <label for="juros">Juros</label>
                <input
                    type="number"
                    name="juros"
                    id="juros"
                    step="0.01"
                    min="0"
                    value="<?= valorCampo($boleto->juros ?? 0) ?>"
                ><br>

                <label for="multa">Multa</label>
                <input
                    type="number"
                    name="multa"
                    id="multa"
                    step="0.01"
                    min="0"
                    value="<?= valorCampo($boleto->multa ?? 0) ?>"
                ><br>

                <label for="mora">Mora</label>
                <input
                    type="number"
                    name="mora"
                    id="mora"
                    step="0.01"
                    min="0"
                    value="<?= valorCampo($boleto->mora ?? 0) ?>"
                ><br>

                <label for="valor_pago">Valor Pago</label>
                <input
                    type="number"
                    name="valor_pago"
                    id="valor_pago"
                    step="0.01"
                    min="0"
                    value="<?= valorCampo($boleto->valor_pago ?? 0) ?>"
                ><br>

                <input
                    class="primary"
                    type="submit"
                    name="acao"
                    id="acao"
                    value="<?php
                        if ($id == 0)
                            echo 'Salvar';
                        else
                            echo 'Alterar';
                    ?>"
                >

                <input type="reset" value="Cancelar">

            </fieldset>

        </form>

    </main>

    <footer class="container"></footer>

</body>
</html>
