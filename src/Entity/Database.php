<?php

namespace App\Entity;

class Database {

    private $db_host;
    private $db_username;
    private $db_password;

    /**
     * @return mixed
     */
    public function getDbHost()
    {
        return $this->db_host;
    }

    /**
     * @param mixed $db_host
     */
    public function setDbHost($db_host): void
    {
        $this->db_host = $db_host;
    }

    /**
     * @return mixed
     */
    public function getDbUsername()
    {
        return $this->db_username;
    }

    /**
     * @param mixed $db_username
     */
    public function setDbUsername($db_username): void
    {
        $this->db_username = $db_username;
    }

    /**
     * @return mixed
     */
    public function getDbPassword()
    {
        return $this->db_password;
    }

    /**
     * @param mixed $db_password
     */
    public function setDbPassword($db_password): void
    {
        $this->db_password = $db_password;
    }

    /**
     * @return mixed
     */
    public function getDbName()
    {
        return $this->db_name;
    }

    /**
     * @param mixed $db_name
     */
    public function setDbName($db_name): void
    {
        $this->db_name = $db_name;
    }
    private $db_name;


}