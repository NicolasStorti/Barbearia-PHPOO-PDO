<?php

try {
    $dbPath = __DIR__ . '/banco.sqlite';
    $pdo = new PDO("sqlite:$dbPath");

    $pdo->exec('CREATE TABLE usuarios (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        nome TEXT NOT NULL,
        dataNascimento DATE NOT NULL,
        telefone TEXT NOT NULL,
        email TEXT NOT NULL,
        senha TEXT NOT NULL
    )');
    $pdo->exec('CREATE TABLE barbeiros (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        nome TEXT NOT NULL,
        telefone TEXT NOT NULL,
        endereco TEXT NOT NULL,
        email TEXT NOT NULL,
        senha TEXT NOT NULL
    )');

    $pdo->exec('CREATE TABLE servicos (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        nome TEXT NOT NULL,
        descricao TEXT NOT NULL,
        preco DECIMAL(10, 2) NOT NULL,
        barbeiroId INTEGER NOT NULL,
        FOREIGN KEY (barbeiroId) REFERENCES barbeiros(id)
    )');
    $pdo->exec('CREATE TABLE agenda (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        data DATE NOT NULL,
        hora TIME NOT NULL,
        usuario_id INTEGER NOT NULL,
        barbeiro_id INTEGER NOT NULL,
        servico_id INTEGER NOT NULL,
        FOREIGN KEY (usuario_id) REFERENCES usuarios (id),
        FOREIGN KEY (barbeiro_id) REFERENCES barbeiros (id),
        FOREIGN KEY (servico_id) REFERENCES servicos (id)
    )');

    echo "Tabelas criadas com sucesso!";
} catch (PDOException $e) {
    echo "Erro ao criar a tabela: " . $e->getMessage();
}
