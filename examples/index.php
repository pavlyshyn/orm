<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Pavlyshyn\Orm;
use Pavlyshyn\DB\Driver\PostgreSQL;
use Pavlyshyn\DB\Driver\MySQL;
use Pavlyshyn\DB\Driver\SQLite;

use \Model\Users;



//$orm = new Orm(new PostgreSQL('localhost', 'test_orm', 'postgres', 'password'));

//$orm = new Orm(new MySQL('localhost', 'test_orm', 'root', 'password'));



// INSERT
///*
$user = new Users();
//$user->id = 3;
$user->name = 'Username4';
$user->mail = 'username@mail.com';
$user->password = sha1('password');
$orm->save($user);
 
//*/
 
$user = new Users();
echo $orm->count($user); 

//$user->setId(3);
//print_r($orm->deleteById($user));


print_r($orm->getAll($user));
