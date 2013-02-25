(HMVC) Codeigniter structure with some more features
==================
## To run this example, you need to: 

1. First you need to clone this repository: `git clone git@github.com:Stockholder/ci-hmvc-features.git`
* Create your scheme and required tables
* Then configure your database, in this file  `/path/your/project/application/config/database.php`

##Database snippet
```
#Use this snippet to create your schema and table, and replace 'your scheme' to your  scheme name prefer
CREATE SCHEMA IF NOT EXISTS yourscheme DEFAULT CHARACTER SET utf8 ;
  USE yourscheme ;
  -- -----------------------------------------------------
  -- Table yourscheme.usuarios
  -- -----------------------------------------------------
  CREATE  TABLE IF NOT EXISTS yourscheme.usuarios (
    id INT(11) NOT NULL AUTO_INCREMENT ,
    usuario VARCHAR(250) NOT NULL ,
    senha VARCHAR(250) NOT NULL ,
    PRIMARY KEY (id) )
  ENGINE = InnoDB
  AUTO_INCREMENT = 2
  DEFAULT CHARACTER SET = utf8;
```

##Configure database in your project
```
#/path/your/project/application/config/database.php
$db['default']['hostname'] = 'localhost';
$db['default']['username'] = 'yourdatabaseuser';
$db['default']['password'] = 'yourpassword';
$db['default']['database'] = 'yourscheme';
```

## Notes:
* You do not need to set a url in config.php file to run the project, this is optional.
