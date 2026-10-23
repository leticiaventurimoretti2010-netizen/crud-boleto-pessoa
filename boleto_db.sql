
CREATE TABLE boleto (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    data_vencimento DATE,
    data_emissao DATE,
    data_pagamento DATE,
    valor FLOAT,
    desconto FLOAT,
    juros FLOAT,
    multa FLOAT,
    mora FLOAT,
    valor_pago FLOAT
);
