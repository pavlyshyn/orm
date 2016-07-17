<?php

namespace Pavlyshyn\Examples;


/**
 * @tableName users
 */
class Users extends \Pavlyshyn\Model {

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
