<?php

require_once __DIR__ . '/../../vendor/autoload.php';

use Pavlyshyn\Orm;
use Pavlyshyn\Examples\Users;
use Pavlyshyn\DB\MySQL;



$orm = new Orm(new MySQL('localhost', 'test_orm', 'root', 'password'));

// INSERT
///*
  $user = new Users();
  //$user->setId(1);
  $user->setName('Username5');
  $user->setMail('username@mail.com');
  $user->setPassword(sha1('password'));
  $orm->save($user);

 //*/

///*
$user = new Users();
echo $orm->count($user);
//*/