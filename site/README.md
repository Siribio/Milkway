# Integração do FileMaker com Azure Active Directory (Azure AD)

## Objetivo
Configurar a autenticação OAuth no FileMaker para que os usuários possam se autenticar usando suas credenciais do Azure AD, permitindo também a autenticação de grupos.

## Passos para Configurar a Integração

### 1. Configurar Azure AD para Suportar Autenticação de Grupos

#### 1.1. Registrar um Aplicativo no Azure AD

1. **Acessar o Portal do Azure**:
   - Vá para o [portal do Azure](https://portal.azure.com/).

2. **Registrar um Novo Aplicativo**:
   - Navegue até "Azure Active Directory".
   - Selecione "App registrations" e clique em "New registration".
   - Dê um nome ao seu aplicativo (por exemplo, "FileMaker Integration").
   - Selecione a opção "Accounts in this organizational directory only".
   - Em "Redirect URI", selecione "Web" e insira a URL de redirecionamento. A URL de redirecionamento geralmente é o URL do seu FileMaker Server seguido de `/oauth/callback`.

3. **Obter IDs de Aplicativo e Diretório**:
   - Após a criação, anote o "Application (client) ID" e o "Directory (tenant) ID". Você precisará dessas informações ao configurar o FileMaker.

#### 1.2. Configurar Certificados e Segredos

1. **Criar um Novo Segredo de Cliente**:
   - No aplicativo registrado, vá para "Certificates & secrets".
   - Clique em "New client secret", dê um nome ao segredo e defina a duração.
   - Anote o valor do segredo gerado, pois você precisará dele mais tarde.

#### 1.3. Habilitar Grupos na Manifestação

1. **Editar o Manifesto**:
   - No aplicativo registrado, vá para "Manifest".
   - Encontre a linha `"groupMembershipClaims": null,` e altere para `"groupMembershipClaims": "SecurityGroup",`.
   - Clique em "Save".

### 2. Adicionar Usuários e Grupos no Azure AD

1. **Adicionar Usuários ao Azure AD**:
   - Navegue até "Azure Active Directory" > "Users and Groups".
   - Adicione os usuários que você deseja autenticar via Azure AD. Os usuários receberão um e-mail contendo um link para aceitar o convite para o Azure AD.

2. **Criar e Adicionar Usuários a um Grupo**:
   - Crie um novo grupo e adicione os usuários ao grupo. Os usuários receberão outro e-mail contendo um link para aceitar o convite para o grupo.
   - Anote o Object ID do grupo.

### 3. Configurar FileMaker Server para OAuth

1. **Acessar a Admin Console do FileMaker Server**:
   - Abra a Admin Console do FileMaker Server.

2. **Configurar Provedor OAuth**:
   - Navegue até a seção "External Authentication".
   - Selecione "OAuth Providers".
   - Adicione o Azure AD como provedor OAuth.
   - Insira o "Client ID" (Application ID) e "Client Secret" que você obteve do Azure AD.
   - Configure a URL de autorização e token do Azure AD. As URLs geralmente são:
     - **URL de autorização**: `https://login.microsoftonline.com/{tenant-id}/oauth2/v2.0/authorize`
     - **URL do token**: `https://login.microsoftonline.com/{tenant-id}/oauth2/v2.0/token`
     - Substitua {tenant-id} pelo seu ID de diretório do Azure AD.


### 4. Adicionar Grupos no FileMaker

#### Abrir o Banco de Dados no FileMaker Pro:

Abra o arquivo de banco de dados no FileMaker Pro 16 ou superior.

#### Configurar a Segurança:

1. Vá para o menu "File" > "Manage" > "Security".
2. No dropdown "Authenticate via", selecione "Microsoft Azure AD".
3. Clique em "+New" e selecione "Group".
4. Para o nome do grupo, insira o Object ID do grupo do Azure AD.
5. Atribua um conjunto de privilégios apropriado.
6. Clique em "OK" e forneça as credenciais de acesso total para confirmar as mudanças.

#### Testar a Integração

1. **Acessar o FileMaker Pro**:
   - Tente acessar o banco de dados do FileMaker Pro usando as credenciais do Azure AD.
   - Verifique se você é redirecionado para a página de login do Azure AD e se, após a autenticação, você tem acesso ao banco de dados conforme esperado.

### Notas Adicionais

- **Certificados SSL**: Certifique-se de que seu FileMaker Server está configurado para usar HTTPS com certificados SSL válidos.
- **Sincronização de Grupos**: Pode ser necessário configurar a sincronização de grupos entre o Azure AD e o FileMaker para garantir que as permissões sejam aplicadas corretamente.
- **Documentação**: Consulte a documentação oficial do FileMaker e do Azure AD para obter informações mais detalhadas e específicas.

Essa configuração permitirá que os usuários do seu sistema FileMaker se autentiquem usando suas credenciais do Azure AD, sem necessidade de logins adicionais, e também permitirá a autenticação baseada em grupos.



Para hospedar uma aplicação Node.js com TypeScript e Express no IIS 10 do Windows Server 2019, siga estes passos:

Passo 1: Configurar o Projeto Node.js
Certifique-se de que seu projeto está configurado corretamente.
Seu arquivo package.json deve estar conforme a estrutura abaixo:

json
Copiar código
{
  "name": "testet",
  "version": "1.0.0",
  "main": "index.js",
  "scripts": {
    "start": "tsc && node dist/index.js",
    "test": "echo \"Error: no test specified\" && exit 1"
  },
  "keywords": [],
  "author": "",
  "license": "ISC",
  "dependencies": {
    "dotenv": "^16.4.5",
    "express": "^4.19.2",
    "foxit-esign-testlib": "file:../../TS_GENERIC_LIB"
  },
  "devDependencies": {
    "@types/express": "^4.17.21",
    "ts-node": "^10.9.2",
    "typescript": "^5.4.5"
  }
}
Certifique-se de que seu código TypeScript está compilando para JavaScript:
Execute o comando abaixo para compilar o TypeScript:

sh
Copiar código
npm run start
Isso deve compilar seu código TypeScript e criar os arquivos JavaScript na pasta dist.

Passo 2: Configurar o IIS para Hospedar a Aplicação Node.js
Instale o Node.js no Servidor Windows:
Baixe e instale o Node.js do site oficial nodejs.org.

Instale o IIS e o Módulo de Redirecionamento:
Abra o Gerenciador do Servidor.
Selecione "Adicionar funções e recursos".
Prossiga até "Funções de Servidor" e selecione "Servidor Web (IIS)".
Na seção "Funções de Serviço", selecione "Regras de redirecionamento HTTP".
Conclua a instalação.
Instale o iisnode:
Baixe e instale o iisnode do repositório do GitHub.

Configurar o Site no IIS:
Abra o Gerenciador do IIS.
Clique com o botão direito em "Sites" e selecione "Adicionar Site".
Configure as opções:
Nome do site: MeuSiteNode
Caminho físico: selecione a pasta onde está o seu projeto compilado.
Porta: 80 (ou outra porta disponível)
Selecione "Pool de Aplicativos" > "Adicionar Pool de Aplicativos" e configure:
Nome: MeuAppPoolNode
.NET CLR version: No Managed Code
No painel à direita, selecione "Configurações Básicas" e configure para usar o pool de aplicativos criado.
Configurar o Arquivo web.config:
Crie um arquivo web.config na pasta raiz do seu projeto (onde está dist), com o seguinte conteúdo:

xml
Copiar código
<configuration>
  <system.webServer>
    <handlers>
      <add name="iisnode" path="dist/index.js" verb="*" modules="iisnode" />
    </handlers>
    <rewrite>
      <rules>
        <rule name="NodeInspector" patternSyntax="ECMAScript" stopProcessing="true">
          <match url="^dist/index.js\/debug[\/]?" />
        </rule>
        <rule name="StaticContent">
          <action type="Rewrite" url="public{REQUEST_URI}" />
        </rule>
        <rule name="DynamicContent">
          <conditions>
            <add input="{REQUEST_FILENAME}" matchType="IsFile" negate="True" />
          </conditions>
          <action type="Rewrite" url="dist/index.js" />
        </rule>
      </rules>
    </rewrite>
    <defaultDocument>
      <files>
        <add value="dist/index.js" />
      </files>
    </defaultDocument>
    <directoryBrowse enabled="true" />
  </system.webServer>
</configuration>
Configurar Variáveis de Ambiente no IIS:
Se você usa variáveis de ambiente no seu arquivo .env, configure-as no IIS:

No Gerenciador do IIS, selecione seu site.
No painel à direita, clique em "Variáveis de Ambiente".
Adicione suas variáveis (CLIENT_ID, CLIENT_SECRET, etc.).
Passo 3: Testar a Aplicação
Abra um navegador e vá para http://localhost (ou a URL configurada).
Verifique se sua aplicação está funcionando conforme esperado.
Resumo
Este guia mostra como configurar um projeto Node.js com TypeScript e Express, e hospedar no IIS 10 no Windows Server 2019. Assegure-se de seguir cada passo cuidadosamente e verificar as configurações no IIS para garantir que tudo esteja correto. Se houver problemas, verifique os logs do IIS para diagnósticos adicionais.