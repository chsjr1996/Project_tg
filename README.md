# Projeto de TG

[![Open Source Love](https://badges.frapsoft.com/os/v2/open-source.png?v=103)](https://github.com/ellerbrock/open-source-badges/) [![MIT Licence](https://badges.frapsoft.com/os/mit/mit.png?v=103)](https://opensource.org/licenses/mit-license.php)


## Introdução

Este projeto tem o objetivo de estabelecer uma **"ponte"** entre empresas de pequeno/médio porte com profissionais do **software livre**. Desta forma, caso a empresa necessite de suporte, treinamento ou algum serviço voltado para **software livre**, então terá **"um lugar"** para encontrar tais recursos.

<hr>

## Tipos de perfis

  * Usuário:
Este tipo de perfil está habilitado para criar um resumo de suas características, ou seja, poderá editar as seguintes seções:
      * Sobre
      * Experiência
      * Formação
      * Habilidades

&nbsp;&nbsp;Desta forma, o **usuário** irá expor seus conhecimentos, podendo ser mais **"atrativo** para as empresas.

* Empresa:
Este tipo de perfil também estará habilitado para criar um resumo, porém em um forma mais adequada para suas necessidades.

* Administrador
Semelhante ao **usuário**, porém com acesso ao paínel administrativo do projeto, onde será possível obter e editar informações diversas (seja sobre outros **usuários**, ou sobre páginas específicas, como **perguntas frequentes**, etc...)

## Instalação

1 - Usar o comando "git clone https://github.com/chsjr1996/project_tg.git";

2 - Entre na linha de comando dentro do diretório criado **"project_tg"**;

3 - Instale as dependências do projeto com **"composer install"**;

4 - Copie o arquivo **".env.example"** e altere o nome de sua cópia para **".env"**;

5 - Configure o arquivo ".env" definindo as variáveis de ambiente abaixo:

- DB_CONNECTION
- DB_HOST
- DB_PORT
- DB_DATABASE
- DB_USERNAME
- DB_PASSWORD

**OBS:** A configuração pode variar de acordo com o SGBD escolhido, sendo eles sqlite, mysql, pgsql ou sqlsrv.

6 - Gere a chave da aplicação com **"php artisan key:generate"** (será inserida dentro do arquivo ".env");

7 - Crie as tabelas no BD com **"php artisan migrate"**;

8 - No Linux, altere as permissões do diretório **"storage"**, usando **"chmod -R 777 storage"**;

9 - Por fim, semeie a table UserType com **"php artisan db:seed --class=UsersTypeTableSeeder"**;

Pronto, o projeto está configurado e pronto para ser usado. Lembre-se que para compilar os arquivos sass dentro de "resources", é necessário instalar o "node_modules", neste caso use **"npm install"** e execute o comando **"npm run watch"**.

---

## Em desenvolvimento

O projeto ainda está em fase de desenvolvimento, ainda restam mais módulos para serem inclusos, além de modificações visuais, criação de nome/logo entre outros. Em breve será criada uma lista para determinar as etapas necessárias para conclusão.



