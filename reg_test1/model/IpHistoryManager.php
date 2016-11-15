<?php

class IpHistoryManager extends AbstractQueryHandler {

    public function __construct($registry, $db) {
        parent::__construct($registry, $db);
    }

    /**
     * Saves client ip and time of the last call of this method
     * 
     * @throws Exception
     */
    public function successfulRegFrom() {
        $ip = $this->getClientIp();
        
        $datetime = date($this->registry['mysql_datetime']);
        
        $query = "INSERT INTO ip_history (ip, last_reg) " .
        "VALUES (:ip, :last_reg);";
        
        $statement = $this->db->prepare($query);        
        $statement->bindValue('ip', $ip);
        $statement->bindValue('last_reg', $datetime);
        
        if ($statement->execute()) {
            $array = $statement->fetchAll(PDO::FETCH_ASSOC);
        } else {
            throw new Exception('Last reg was not saved');
        }
    }

    /**
     * Determines the time difference between last call of 
     * successfulRegForm() method from this ip and the current time.
     * 
     * 
     * @return boolean Returns true if the time difference is less than
     * the time specified in configuration file
     */
    public function isNeedToWait() {
        $ip = $this->getClientIp();
        
        $query = "SELECT last_reg " .
                " FROM ip_history WHERE ip = :ip";

        $statement = $this->db->prepare($query);
        $statement->bindValue('ip', $ip);

        if ($statement->execute()) {
            $array = $statement->fetch(PDO::FETCH_ASSOC);
        } else {
            throw new Exception('...');
        }
        
        $storedTime = strtotime($array['last_reg']);        
        $timeDifference = time() - $storedTime;
        
        if ($timeDifference < $this->registry['min_reg_wait_time']) {
            return true;
        } else {
            return false;
        }
    }
    
    private function getClientIp() {        
        $ip = filter_input(INPUT_SERVER, 'REMOTE_ADDR', FILTER_VALIDATE_IP);
        
        if (!$ip) {
            //log can't determine client's ip?
        }
        
        return $ip;
    }
}
