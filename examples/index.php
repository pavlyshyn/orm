<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Pavlyshyn\Orm;
use Pavlyshyn\DB\Driver\MySQL;
use Pavlyshyn\Mapping\Driver\Annotation;

use \Model\Users;

$orm = new Orm(new MySQL('localhost', 'test_orm', 'root', 'password'), new Annotation());



// INSERT
///*
$user = new Users();
//$user->id = 4;
$user->name = 'Username11';
$user->mail = 'username@mail.com';
$user->password = sha1('password');
$orm->save($user);
 
//*/
 
$user = new Users();
echo $orm->count($user); 

$user->setId(3);
print_r($orm->get($user));


//print_r($orm->getAll($user));
