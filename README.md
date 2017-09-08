## Servidor cakePHP 3

 Entrar no projeto e pelo terminal digitar:

 ```bash
bin/cake server 
```

## todolist

Configurações de Banco de Dados:

config/app.php

	'host' => 'localhost',
	'username' => 'SEU_LOGIN',
	'password' => 'SUA_SENHA',
	'database' => 'todo',

CREATE DATABASE `todo` /*!40100 DEFAULT CHARACTER SET latin1 */;


CREATE TABLE `activities` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(45) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `excluido` tinyint(4) DEFAULT '0',
  `concluido` tinyint(4) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=latin1;





