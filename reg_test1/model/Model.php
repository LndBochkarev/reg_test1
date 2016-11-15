<?php

class Model {

    private $registry;
    private $db;

    public function __construct($registry) {
        $this->registry = $registry;
        $this->connect();
    }
    
    public function getIpHistoryManager() {
        $this->includeModelClass('IpHistoryManager.php');
        return new IpHistoryManager($this->registry, $this->db);        
    }

    public function getUserDataHandler() {
        $this->includeModelClass('UserDataHandler.php');
        return new UserDataHandler($this->registry, $this->db);
    }
    
    public function getUserQueryHandler() {
        $this->includeModelClass('UserQueryHandler.php');
        return new UserQueryHandler($this->registry, $this->db);
    }

    
    /**
     * Includes file in model directory
     * 
     * @param string Actual name of the file
     */
    private function includeModelClass($fileName) {
        require_once $this->registry['site_root'] . 'model/' . $fileName;
    }

    /**
     * Connects to database
     */
    private function connect() {
        $dsn = "mysql:host=" . $this->registry['db_host'] .
                ";dbname=" . $this->registry['db_name'];

        $this->db = new PDO($dsn, $this->registry['db_username'], $this->registry['db_pass']);

        $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
}
