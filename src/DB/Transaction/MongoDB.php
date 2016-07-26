<?php

namespace Pavlyshyn\DB\Transaction;

use Pavlyshyn\DB\Transaction;

class MongoDB implements Transaction {

    private $tm;

    public function __construct(Transaction $tm) {
        $this->tm = $tm;
    }

    public function begin() {
        
    }

    public function commit() {
        return $this->dm->flush();
    }

    public function rollBack() {
        
    }

}
