# Projeto de Fórum

Este é o README para o projeto Fórum, uma plataforma de discussão online desenvolvida com base nas tecnologias Docker e Laravel 10. O projeto inclui recursos como autenticação de login, criação de novos posts, um sistema de respostas, envio de e-mails para notificações e autenticação via Sanctum.

## Tecnologias Utilizadas

- **Docker**: Utilizado para facilitar o ambiente de desenvolvimento e implantação.

- **Laravel 10**: Framework PHP moderno e poderoso para construir aplicativos web eficientes.

## Recursos Principais

- **API REST**: O projeto é construído como uma API REST para fácil integração com outros sistemas e aplicativos.

- **Email Sender**: Implementação de envio de e-mails para notificações, incluindo notificações de novas respostas a posts.

- **DTO e Repository Patterns**: Utilizamos Data Transfer Objects (DTO) e Repository Patterns para manter o código organizado e separar a lógica de negócios da camada de acesso a dados.

- **eNums**: Enums são utilizados para manter o código limpo e legível ao definir estados e tipos.

- **Scaffolding Authentication com Sanctum**: Autenticação pronta para uso, com suporte ao Sanctum para autenticação via token.

- **Eloquents ORM**: O Laravel Eloquent é usado para interagir com o banco de dados de forma elegante e eficiente.

- **Service Layer**: Lógica de negócios é separada em serviços para manter o código limpo e modular.

- **Uuid**: Utilização de UUIDs (Universally Unique Identifiers) para identificação única de recursos.

- **Observer Patterns**: Observadores são utilizados para monitorar e reagir a eventos específicos.

- **Tailwind CSS**: O estilo da aplicação é construído com Tailwind CSS, proporcionando uma experiência visual moderna e responsiva.

## Funcionalidades Principais

O projeto de Fórum inclui as seguintes funcionalidades:

- **Autenticação de Usuário com Sanctum**: Os usuários podem se registrar e fazer login em suas contas, utilizando o Sanctum para autenticação via token. Isso fornece um método seguro e flexível para autenticar os usuários.

- **Criação de Posts**: Os usuários podem criar novos posts para iniciar discussões.

- **Sistema de Respostas**: Os usuários podem responder aos posts existentes, recebendo notificações por e-mail quando novas respostas são adicionadas aos seus posts.

- **Controle de Acesso**: Os proprietários dos posts podem apagá-los, assim como suas próprias respostas. Os usuários regulares podem comentar e apagar apenas seus próprios comentários.

## Configuração e Implantação

Para configurar e implantar este projeto, siga as instruções abaixo:

1. **Clonar o Repositório**: Clone o repositório do projeto para o seu ambiente de desenvolvimento.

2. **Configurar Variáveis de Ambiente**: Configure as variáveis de ambiente necessárias, como configurações de banco de dados e envio de e-mail.

3. **Executar Migrations**: Execute as migrações para criar as tabelas do banco de dados.

4. **Iniciar o Servidor**: Inicie o servidor da aplicação para que os usuários possam acessá-lo.

5. **Desenvolvimento e Implantação**: Continue desenvolvendo e, quando estiver pronto, implante o projeto em um servidor web adequado.

## Licença

Este projeto é distribuído sob a licença [MIT](LICENSE), o que significa que você pode usá-lo livremente, modificar e distribuir conforme suas necessidades.

## Contato

Para dúvidas, sugestões ou suporte, entre em contato com o desenvolvedor principal:

**Nome do Desenvolvedor**: [Marcos Antonio de Lima Claudino]
**E-mail**: [marcos.antoniodm039@gmail.com]
**GitHub**: [https://github.com/marcosantdm]
**Instagram**: [https://www.instagram.com/marcos_antoniodm/]

Obrigado por usar o Projeto de Fórum! Esperamos que seja útil e atenda às suas necessidades de discussão online com recursos avançados de envio de e-mails e autenticação via Sanctum.
