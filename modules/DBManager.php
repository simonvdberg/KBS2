<?php

namespace modules;

class DBManager {

    protected $username;
    protected $password;
    protected $datbase;
    protected $host;
    protected $port;
    private $db;
    private static $_instance;

    public function __construct($host, $username, $password, $dbname, $port) {
        $this->db = new \mysqli($host, $username, $password, $dbname, $port);
    }

    static function getInstance() {
        if (self::$_instance == null) {
            self::$_instance = new self("localhost", "root", "", "TZT", 3307);
        }
        return self::$_instance;
    }

    public function selectQuery($query) {
        $res = $this->db->query($query);
        $rows = [];
        while ($row = $res->fetch_assoc()) {
            $rows[] = $row;
        }
        return $rows;
    }   

    public function insertQuery($query) {
        $this->db->query($query);
        return $this->db->insert_id;
    }

    public function deleteQuery($query) {
        $this->db->query($query);
    }

    public function updateQuery($query) {
        $this->db->query($query);
    }

    public function escape_string($string){
        return $this->db->escape_string($string);
    }
    
}
