<?php

namespace Model;

use Pavlyshyn\Model;

/**
 * @tableName users
 */
class Users extends Model {

    /**
     * @var integer
     */
    protected $id;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var string
     */
    protected $mail;

    /**
     * @var string
     */
    protected $password;

    /**
     * @param integer $id
     * @return integer $id
     */
    public function setId($id) {
        return $this->id = $id;
    }

    /**
     * @return integer $id
     */
    public function getId() {
        return $this->id;
    }

    /**
     * @param string $name
     * @return string $name
     */
    public function setName($name) {
        return $this->name = $name;
    }
    
    /**
     * @return string $name
     */
    public function getName() {
        return $this->name;
    }

    /**
     * @param string $mail
     * @return string $mail
     */
    public function setMail($mail) {
        return $this->mail = $mail;
    }
    
    /**
     * @return string $mail
     */
    public function getMail() {
        return $this->mail;
    }

    /**
     * @param string $password
     * @return string $password
     */
    public function setPassword($password) {
        return $this->password = $password;
    }
    
    /**
     * @return string $password
     */
    public function getPassword() {
        return $this->password;
    }

}
