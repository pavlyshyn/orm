<?php

namespace Pavlyshyn\DB\Driver;

class PostgreSQL extends \Pavlyshyn\DB\Driver\SQL {

    public function __construct($host, $db, $user, $password, $character = 'utf8') {
        try {
            $this->connection = new \PDO("pgsql:dbname=$db;host=$host", $user, $password);

            $this->connection->query('SET NAMES ' . $character . ';');
        } catch (Pavlyshyn\Exception $e) {
            echo 'Error PostgreSQL connection (' . $e->getCode() . '): ', $e->getMessage(), "\n";
        }
    }

}
