<?php

namespace Database;




use Database\DbConfig;


class Database extends DbConfig {
     
    private $conn;
    private $table;

    public function __construct($host, $user, $password, $dbname, $table) {
        parent::__construct($host, $user, $password, $dbname);
        $this->table = $table;
        $this->connect();
    }

    private function connect()
    {
        $this->conn = new \mysqli($this->getHost(), $this->getUsername(), $this->getPassword(), $this->getDbName());

        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }

    public function guardarTabla($multiplicador, $multiplicando, $resultado) {
    
        $stmt = $this->conn->prepare("
            iNSERT INTO 
                $this->table
                (multiplicador, multiplicando, resultado) 
                VALUES 
                (?, ?, ?)"
        );

        if ($stmt === false) {
            die("Error al preparar la consulta: " . $this->conn->error);
        }

        $stmt->bind_param('iii', $multiplicador, $multiplicando, $resultado);

        if ($stmt->execute() === false) {
            die("Error al ejecutar la consulta: " . $stmt->error);
        }

        $stmt->close();
    }

    public function __destruct() {
        if ($this->conn) {
            $this->conn->close();
        }
    }
}


