# Desafio Técnico
Crie um sistema de gestão bancária por meio de uma API, composta por dois endpoints:

1. "/conta" 
   -  endpoint "/conta" deve criar e fornecer informações sobre o número da conta. 

2. "/transacao". 
   - endpoint "/transacao" será responsável por realizar diversas operações
   financeiras.
   
- Os endpoints devem ter o seguintes padrões de entrada e saída no formato json:

- Use as seguintes siglas para as formas de pagamento:
1. P => Pix
2. C => Cartão de Crédito
3. D => Cartão de Débito


POST /conta
input => JSON { "numero_conta": 234, "saldo":180.37}
output => HTTP STATUS 201 / JSON {"numero_conta": 234, “saldo”: 180.37}

POST /transacao
input => JSON {"forma_pagamento":"D", "numero_conta": 234, "valor":10}
output => HTTP STATUS 201 / JSON {“numero_conta”: 234, “saldo”: 170.07}
HTTP STATUS 404 (Caso não tenha saldo disponível)

GET /conta?numero_conta=234
output => Caso não exista a conta deve retornar HTTP STATUS 404.
Caso exista a conta retorna HTTP STATUS 200 e um JSON:
{“numero_conta”: 234, “saldo”: 170.07}


Aqui estão as etapas do desafio:
1. Crie um endpoint na API que permita a criação de uma nova conta com um saldo inicial de
valor float.
2. Há três formas de transação disponíveis: débito, crédito e Pix, cada uma com taxas
diferentes. As taxas são acrescidas nas transações, ou seja, é descontado o valor + taxa. Por
exemplo, uma transação de R$ 10 no débito, deverá ser descontado R$ 10,30.
Taxa de débito: 3% sobre a operação
Taxa de crédito: 5% sobre a operação
Taxa do Pix: Sem custo

3. Implementar a validação caso a conta já existe (POST);
4. Importante lembrar que todas as contas não possuem limite de cheque especial, o que
significa que não é permitido ter saldo negativo. Portanto, implementar as validações
necessárias para garantir que as transações não excedam o saldo disponível.

5. As chamadas devem interferir no saldo da conta para as próximas operações. Fica facultativo
a persistência dos dados.

6. Após realizar o teste, disponibilize o código no github, deixe o repositório privado e adicione
como colaborador os usuários informados pelo recrutamento.

7. Adicione um readme de como executar sua aplicação.

Diferenciais:
● Realize commits bem escritos;
● Realize os testes necessários;
● Mantenha um código limpo;
● Utilização de design patterns;
● Persistência de dados.
