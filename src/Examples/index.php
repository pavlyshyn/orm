<?php

require_once __DIR__ . '/../../vendor/autoload.php';

use Pavlyshyn\Orm;
use Pavlyshyn\Examples\Users;

$initialisation = Orm::init('localhost', 'test_orm', 'root', 'password');


$orm = new Orm();

// INSERT
///*
$user = new Users();
$user->setName('Username');
$user->setMail('username@mail.com');
$user->setPassword(sha1('password'));
$orm->save($user);
//*/
