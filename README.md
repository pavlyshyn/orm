

```php
use Pavlyshyn\Orm;
use Pavlyshyn\Examples\Users;
use Pavlyshyn\DB\MySQL;

$orm = new Orm(new MySQL('localhost', 'test_orm', 'root', 'password'));


$orm = new Orm(new MongoDB('localhost', 'test_orm'));
```


```php
<?php

namespace Model;

use \Pavlyshyn\Model;

/**
 * @tableName users
 */
class Users extends Model {

    protected $id;
    protected $name;
    protected $mail;
    protected $password;

    public function setId($id) {
        return $this->id = $id;
    }

    public function getId() {
        return $this->id;
    }

    public function setName($name) {
        return $this->name = $name;
    }

    public function getName() {
        return $this->name;
    }

    public function setMail($mail) {
        return $this->mail = $mail;
    }

    public function getMail() {
        return $this->mail;
    }

    public function setPassword($password) {
        return $this->password = $password;
    }

    public function getPassword() {
        return $this->password;
    }

}
```


######INSERT
```php
$user = new Users();
$user->name = 'Username';
$user->mail = 'username@mail.com';
$user->password = sha1('password');
$orm->save($user);
```



######UPDATE
```php
//get user
$user = new Users();
$user->id = 1;
$user = $orm->get($user);

//update
$user->password = sha1('new password');
$orm->save($user);
```



######GET
```php
$users = new Users();
$tabUsers = $orm->getAll($users);

var_dump($tabUsers);

foreach($tabUsers as $user){
    echo 'Name : ' . $user->name . '<br>';
    echo 'Email : ' . $user->mail . '<br>';
    echo 'Password : ' . $user->password . '<br>';
}
```


######DELETE BY ID
```php
$users = new Users();
$user->id = 1;
$orm->deleteById($users);
```


######DELETE (PARAMETERS $OBJECT, $ROWNAME AND $VALUE)
```php
$users = new Users();
$orm->delete($users, 'name', 'Username');
```


######COUNT
```php
$users = new Users();
$count = $orm->count($users);
var_dump($count);
```


######EXIST (PARAMETERS $OBJECT, $ROWNAME AND $VALUE)
```php
$users = new Users();
$res = $orm->exist($users, 'name', 'Username');
var_dump($res);
```
