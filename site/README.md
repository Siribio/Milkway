# Delivery de sorvete (Milkway)

## Objetivo

 Projeto de site de delivery de sorvetes, utilizando as liguagens mais comuns para web (HTML, CSS, JavaScript e PHP) e com isso facilitar a venda de sorvetes customizados, principalmente em regiões quentes e no verão.

## Principais features (segurança)

### Signin

- Verifica se o email é valido.
- Verifica se o usuário já esta cadastrado.
- Verifica se a senha tem no mínimo dez caracteres.
- Verifica se tem no mínimo uma letra maiúscula.
- Verifica se tem no mínimo uma letra minusculoa.
- Verificase tem no mínimo um caractere especial .
- Verificase tem no mínimo um número.
- Senha criptografada em Hesh e salva no banco.
- Realisa **insert** no banco.

### Login

- Login verificado com usuário.
- Senha é devolvida com passwor verify.
- Senha não é descriptografada, apenas comparada Hash contra Hash
- Depois de validar e verificar se a senha está correta, token é setado na sessão e no banco.
- O token de sessão dura 1 hora, depois disso o user não tem mais acesso às funcionaliades do site, e, ao clicar em qualquer lugar ele retorna ao login.

## Navegação no site

1. Login

    - Na tela da login temos os campos de usuário e senha, entre com seu cadastro realizado anteriormente, se precisar de ajuda clique em "*esqueci a senha*" e caso não tenha cadastro clique em "*Cadastre-se*" para ser direcionado para a tela de cadastro.

2. Signin

    - Nessa secção, escolha um nome de usuário, insita seu e-mail principal, defina e confirme uma senha, depois clique em criar conta.

3. Home 

    - Essa é a primeira página que aparece após o login, ela serve como um hub pra você decidir seu próximo passo, pondendo escolher entre as guias "*sobre nós*", "*pedido*", "*localização*", "*usuário*".

4. Sobre nós

    - Página com informações sobre a empresa, história objetivos e etc.

5. Localização

    - Informações de onde nos encontrar para fazer o seu pedido de forma local.

6. Usuário

    - Página com informações do usuário e botão para ver histórico de pedidos.

7. Pedido

    - Area destinada à seleção de quantidade de sabores e acompanhamentos do pedido, com posterior direcionamento ao carrinho de compras que gera um registro do respectivo pedido no banco de dados (**INSERT**).

8. Carrinho

    - Após selecionar e confirmar seu pedido, ele é encaminhado para o carrinho. Lá você confere todos os pedidos podendo excluir (**DELETE**) e verificar o valor total da compra. Após a confirmação da compra o estoque sera atualizado (**UPDATE**) o pedido final sera gerado (**INSERT**) e os pedidos no carrinho serão deletados para realizar nova compra.
        
     ## Fluxograma da navegação

    ![Fluxograma](/assets/image.png)

    ## CRUD

        
     ## Fluxograma da navegação

    ![Fluxograma](/assets/image.png)

    ## CRUD

    
 
