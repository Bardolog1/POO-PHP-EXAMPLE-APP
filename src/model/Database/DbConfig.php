<?php

namespace Database;
class DbConfig {
    protected $host = 'localhost';
    protected $dbname = 'parcialFinal';
    protected $username = 'root';
    protected $password = '';
    
    public function __construct($host, $username, $password, $dbname) {
        $this->host = $host;
        $this->dbname = $dbname;
        $this->username = $username;
        $this->password = $password;
    }

    public function getHost() {
        return $this->host;
    }

    public function getDbName() {
        return $this->dbname;
    }

    public function getUsername() {
        return $this->username;
    }

    public function getPassword() {
        return $this->password;
    }
}

