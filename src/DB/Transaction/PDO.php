<?php

namespace Pavlyshyn\DB\Transaction;

use Pavlyshyn\DB\Transaction;

class PDO implements Transaction {

    private $tm;

    public function __construct(Transaction $tm) {
        $this->tm = $tm;
    }

    public function begin() {
        return $this->tm->beginTransaction();
    }

    public function commit() {
        return $this->tm->commit();
    }

    public function rollBack() {
        return $this->tm->rollBack();
    }

}
