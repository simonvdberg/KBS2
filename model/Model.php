<?php

namespace model;

use ReflectionClass;
use modules\DBManager;

class Model {

    private $db;

    public function __construct() {
        $this->db = DBManager::getInstance();
    }

    public function saveToDatabase() {
        $rClass = new ReflectionClass($this);

        $className = explode("\\", $rClass->getName());
        $className = end($className);

        $properties = array();
        foreach ($rClass->getProperties() as $property) {
            if ($property->name != "db") {
                $properties[] = $property->name;
            }
        }

        $updateQuery = "";
        $valList = array();
        $count = count($properties);
        $i = 0;
        foreach ($properties as $property) {
            $i++;
            $updateQuery .= "`" . $this->db->escape_string($property) . "`='" . $this->db->escape_string($this->$property) . "'";
            $valList[] = $this->$property;
            if ($count != $i) {
                $updateQuery .= ", ";
            }
        }

        $query = "INSERT INTO `" . $this->db->escape_string($className) . "` (`" . implode("`,`", $properties) . "`) VALUES ('" . implode("','", $valList) . "')";
        $query .= " ON DUPLICATE KEY UPDATE " . $updateQuery;
        return $this->db->insertQuery($query);
    }

}
