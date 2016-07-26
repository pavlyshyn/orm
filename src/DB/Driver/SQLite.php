<?php

namespace Pavlyshyn\DB\Driver;

use \PDO;

class SQLite extends \Pavlyshyn\DB\Driver\SQL {

    public function __construct($fileName) {
        try {
            $this->connection = new PDO('sqlite:' . $fileName);

            $this->connection->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

            // ERRMODE_WARNING | ERRMODE_EXCEPTION | ERRMODE_SILENT
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (Pavlyshyn\Exception $e) {
            echo 'Error SQLite connection (' . $e->getCode() . '): ', $e->getMessage(), "\n";
        }
    }

}
