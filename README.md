

###INSERT

```php
$user = new Users();
$user->setName('Username');
$user->setMail('username@mail.com');
$user->setPassword(sha1('password'));
$orm->save($user);
```

###GET
```php
$orm = new Orm();
$users = new Users();
$tabUsers = $orm->getAll($users);

var_dump($tabUsers);

foreach($tabUsers as $user){
    echo 'Nom : ' . $user['name'] . '<br>';
    echo 'Email : ' . $user['mail'] . '<br>';
    echo 'Password : ' . $user['password'] . '<br>';
}
```


###DELETE BY ID

```php
$orm = new Orm();
$users = new Users();
$users->setId('1');
$orm->deleteById($users);
```


###DELETE (PARAMETERS $OBJECT, $ROWNAME AND $VALUE)

```php
$users = new Users();
$orm->delete($users, 'name', 'Username');
```

###COUNT

```php
$users = new Users();
$count = $orm->count($users);
var_dump($count);
```

###EXIST (PARAMETERS $OBJECT, $ROWNAME AND $VALUE)

```php
$users = new Users();
$res = $orm->exist($users, 'name', 'Username');
var_dump($res);
```
