CREATE TABLE IF NOT EXISTS categoria_gasto (
    id_categoria_gasto INT PRIMARY KEY AUTO_INCREMENT,
    nome_categoria_gasto VARCHAR(100) NOT NULL
);

CREATE TABLE IF NOT EXISTS forma_pagamento (
    id_forma_pagamento INT PRIMARY KEY AUTO_INCREMENT,
    nome_forma_pagamento VARCHAR(100) NOT NULL
);

CREATE TABLE IF NOT EXISTS gasto (
    id_gasto INT PRIMARY KEY AUTO_INCREMENT,
    produto VARCHAR(255) NOT NULL,
    valor DECIMAL(10,2) NOT NULL,
    categoria_id INT NOT NULL,
    forma_pagamento_id INT NOT NULL,
    total_parcelas INT DEFAULT NULL,
    parcelas_pagas INT DEFAULT NULL,
    vencimento DATE DEFAULT NULL,
    data_pagamento DATE DEFAULT NULL,

    FOREIGN KEY (categoria_id) REFERENCES categoria_gasto(id_categoria_gasto),
    FOREIGN KEY (forma_pagamento_id) REFERENCES forma_pagamento(id_forma_pagamento)
);

CREATE TABLE IF NOT EXISTS parcela (
    id_parcela INT PRIMARY KEY AUTO_INCREMENT,
    gasto_id INT NOT NULL,
    numero_parcela INT NOT NULL,
    valor DECIMAL(10,2) NOT NULL,
    vencimento DATE NOT NULL,
    data_pagamento DATE DEFAULT NULL,
    
    FOREIGN KEY (gasto_id) REFERENCES gasto(id_gasto)
);

INSERT INTO categoria_gasto (nome_categoria_gasto) VALUES
('Moradia'),
('Vestimenta'),
('Contas e Serviços'),
('Impostos'),
('Gastos Domésticos'),
('Viagem');

INSERT INTO forma_pagamento (nome_forma_pagamento) VALUES 
('Dinheiro'),
('Cartão de Crédito'),
('Cartão de Débito'),
('PIX'),
('Boleto');

ALTER TABLE gasto MODIFY vencimento DATE NULL;