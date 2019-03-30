<?php

class Account extends Database{

    private $connection;

    function __construct(){
        $this->connection = parent::__construct();
        $this->connection = $this->connect();
    }

    // Get users password
    public function getPassword($user){
        $sql = 'SELECT * FROM users WHERE id=:id AND email=:email';

        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam('id', $user['id']);
        $stmt->bindParam('email', $user['email']);
        $stmt->execute();

        // Store user from DB
        $dbUser = $stmt->fetch(PDO::FETCH_ASSOC);

        return $dbUser;
    }

    // Change users password
    public function changePassword($data, $account){
        $sql = 'UPDATE users SET password=:password WHERE id=:id AND email=:email';

        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam('password', password_hash($data['newPassword'], PASSWORD_ARGON2I));
        $stmt->bindParam('id', $account['id']);
        $stmt->bindParam('email', $account['email']);
        $stmt->execute();
    }

    // Delete account
    public function deleteAccount($user){
        $sql = 'DELETE FROM users WHERE id=:id AND email=:email';
        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam('id', $user['id']);
        $stmt->bindParam('email', $user['email']);
        $stmt->execute();
    }
}