# CRUD com PHP

## Orientado a objetos, PDO e MySQL

*`CRUD`* Feito para fins de estudos e para o portifolio.

### Preview

### Features

- [x] Criacao do banco de dados
- [x] Instalacao do autoload via Composer
- [x] Criacao das paginas *`header/footer`*
- [x] Front end 
- [x] Criacao das paginas *`Index/Formulario/Listagem`* 
- [ ] .... Em construcao

## Getting started

### 1. Clone este repositorio

```bash
git clone ---
```

### 2. Criacao do banco de dados

Aplicacao utilizada foi MAMP(MacOS), mas pode ser utilizado 
qualquer aplicacao.

Criar um banco dados com o nome que preferir seguindo os dados abaixo.

5 Colunas

* id -> int(11) AUTO_INCREMENT
* titulo -> varchar(255)
* descricao -> text
* ativo -> enum ('s', 'n')
* data -> timestamp, CURRENT_TIME


*MySQL*
```
CREATE TABLE `vagas` (
`id` int(11) NOT NULL,
`titulo` varchar(255) NOT NULL,
`descricao` text NOT NULL,
`ativo` enum('s','n') NOT NULL,
`data` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
```

### 3. Dados de conexao para o banco de dados

Alterar os dados de conexao do banco de dados no arquivo *`Database.php`*

Alterar os dados nas *`const`* por padrao preenchi os dados da aplicacao MAMP(MacOS)<br>

 * HOST = *`localhost`*
 * NAME = *`nome do banco de dados`*
 * USER = *`root`*
 * PASS = *`senha do root`*

### 4. Executar o projeto
....



