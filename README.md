

```php
use Pavlyshyn\Orm;
use Pavlyshyn\Examples\Users;
use Pavlyshyn\DB\MySQL;

$orm = new Orm(new MySQL('localhost', 'test_orm', 'root', 'password'));
```


######INSERT
```php
$user = new Users();
$user->setName('Username');
$user->setMail('username@mail.com');
$user->setPassword(sha1('password'));
$orm->save($user);
```


######GET
```php
$users = new Users();
$tabUsers = $orm->getAll($users);

var_dump($tabUsers);

foreach($tabUsers as $user){
    echo 'Name : ' . $user->getName() . '<br>';
    echo 'Email : ' . $user->getMail() . '<br>';
    echo 'Password : ' . $user->getPassword() . '<br>';
}
```


######DELETE BY ID
```php
$users = new Users();
$users->setId('1');
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
