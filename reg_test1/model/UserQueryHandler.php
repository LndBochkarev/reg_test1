<?php

class UserQueryHandler extends AbstractQueryHandler {

    public function __construct($registry, $db) {
        parent::__construct($registry, $db);
    }

    /**
     * Inserting data from incoming array to database
     * Data should be already sanitized and validated
     * 
     * @return int Id of created user
     * @throws Exception
     */
    public function insertUser($data) {

        if (!$data['is_valid']) {
            throw new Exception('Data is not valid');
        }

        try {
            $query = "INSERT INTO users (" .
                    "first_name, last_name, password, email, bio) " .
                    "VALUES (:first_name, :last_name, :password, :email, :bio);";

            $statement = $this->db->prepare($query);
            $values = array(
                'first_name' => $data['first_name'],
                'last_name' => $data['last_name'],
                'password' => $data['password'],
                'email' => $data['email'],
                'bio' => $data['bio'],
            );
            $statement->execute($values);

            $user_id = $this->db->lastInsertId();
        } catch (PDOException $ex) {
            /**
             * @todo log $ex
             */
            throw new Exception('User was not created');
        }

        return $user_id;
    }

    /**
     * @param type $user_id
     * @return array $array
     */
    public function getUserByID($user_id) {

        $query = "SELECT id, first_name, last_name, email, bio " .
                " FROM users WHERE id = :id";

        $statement = $this->db->prepare($query);
        $statement->bindValue('id', $user_id);
        
        if ($statement->execute()) {
            $array = $statement->fetchAll(PDO::FETCH_ASSOC);
        } else {
            throw new Exception('User not found');
        }

        return $array[0];
    }

    /**
     * @param type $email
     * @return array $array
     */
    public function getPasswordByEmail($email) {
        $query = "SELECT id, password " .
                " FROM users WHERE email = :email";

        $statement = $this->db->prepare($query);
        $statement->bindValue('email', $email);
        
        if ($statement->execute()) {
            $array = $statement->fetchAll(PDO::FETCH_ASSOC);
        } else {
            throw new Exception('User not found');
        }

        return $array[0];
    }

}
