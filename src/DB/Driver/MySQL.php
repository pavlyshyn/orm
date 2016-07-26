<?php

namespace Pavlyshyn\DB\Driver;

use \PDO;

class MySQL extends \Pavlyshyn\DB\Driver\SQL {

    public function __construct($host, $db, $user, $password, $character = 'utf8') {
        try {
            $this->connection = new PDO('mysql:host=' . $host . ';dbname=' . $db . ';charset=' . $character, $user, $password);

            $this->connection->query('SET NAMES ' . $character . ';');
        } catch (Pavlyshyn\Exception $e) {
            echo 'Error MySQL connection (' . $e->getCode() . '): ', $e->getMessage(), "\n";
        }
    }

}
