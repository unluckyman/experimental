# UWA

Projeto para facilitar a construção de sites dinâmicos pela Update Soluções.

## Instalação

1. git clone git@bitbucket.org:updatesolucoes/uwa.git NOME-DO-SITE
2. Criar arquivo config/app.php usando o modelo app.default.php
3. Fazer as modificações necessárias no arquivo app.php (banco de dados, salt etc.)
4. chmod 777 para tmp, logs e uploads


## Dependências
1. [CakePHP v3.0.9](http://cakephp.org)
2. [jQuery v1.11.3](https://jquery.com)
3. [CKEditor v4.4.7](http://ckeditor.com)
4. [Twitter Bootstrap v3.3.5](http://getbootstrap.com)
5. [Plugin Bootstrap3 Helpers](https://holt59.github.io/cakephp3-bootstrap3-helpers)

## Changelog

### v.0.2
- Adiciona método separado para publicar e despublicar notícia
- Modifica a rota de acesso ao backend para /uwa
- Renomeia o projeto para UWA
- Adiciona validação JS aos campos obrigatórios dos formulários
- Desabilita o status (atributo active) do usuário
- Adiciona AppFrontController somente para a parte de FrontController (que não precisa de AuthComponent)
- Atualiza versão do Twitter Bootstrap (3.3.5)
- Adiciona flag __CLIENTE__ para substituição de valores relacionados ao cliente
- Adiciona atributo name a Users
- Adiciona o método findSlug a SluggableBehavior
- Corrige os arquivos de internacionalização
- Pré-configura envio de email usando o Smtp da Update Soluções no arquivo app.default.php (backup@updatesolucoes.com.br)
- Adiciona formulário básico de contato
- Relaciona Articles e Articles_Images diretamente (1-n)
- Remove o módulo Article_Galleries
- Atualiza as dependências

### v.0.1
- Mantem flag __SALT__ a ser preenchida por um hash bcrypt quando o arquivo app.php for criado através do app.default.php
- Inicia o projeto com requisitos mínimos e módulos de Users, Pages, Articles, Article_Galleries e Article_Images