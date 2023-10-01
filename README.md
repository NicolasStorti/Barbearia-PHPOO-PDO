# Nic.DoCorte - Sistema de Agendamento para Barbearias

O Nic.DoCorte é um sistema web que permite aos usuários agendar horários em uma barbearia chamada Nic.DoCorte. Ele oferece funcionalidades de login e cadastro para usuários e barbeiros, permitindo que cada um acesse suas respectivas funcionalidades.

## Pré-requisitos

Antes de começar, certifique-se de ter os seguintes requisitos:

- [PHP](https://www.php.net/) instalado
- IDE (como o [PHPStorm](https://www.jetbrains.com/phpstorm/)) ou outra ferramenta de desenvolvimento
- Configurações do SQLite descomentadas no arquivo `php.ini`

## Instalação

Siga os passos abaixo para configurar e iniciar o projeto:

1. Clone o repositório:

   ```bash
   git clone https://github.com/NicolasStorti/Barbearia-PHPOO-PDO.git
   
2. Execute o script createBd.php para criar o banco de dados:
    ```bash
   php createBd.php

3. Inicie o servidor local:
    ```bash
   php -S localhost:8080 -t public

## Uso
## Usuários

- Após iniciar o servidor, acesse o site em http://localhost:8080.
- Faça o cadastro e o login como usuário.
- Você pode agendar um horário, visualizar seu perfil e os serviços oferecidos.

## Barbeiros

- Faça o cadastro e o login como barbeiro.
- Você pode visualizar os horários agendados, editar ou excluir horários, cadastrar serviços, visualizar os serviços cadastrados e ver os usuários cadastrados para fins de agendamento.



