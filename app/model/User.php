<?php

class User extends Database{

    private $connection;

    function __construct(){
        $this->connection = Database::getInstance();
    }

    // User login
    public function login($data){
        $sql = 'SELECT * FROM users WHERE email=:email';
        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam('email', $data['email']);
        $stmt->execute();

        // Store user from db
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        return $user;
    }

    // User registration
    public function register($data){
        $sql = 'INSERT INTO users (username, email, password)
        VALUES (:username, :email, :password)';

        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam('username', $data['username']);
        $stmt->bindParam('email', $data['email']);
        $stmt->bindParam('password', password_hash($data['password'], PASSWORD_ARGON2I));
        $stmt->execute();
    }

    // Connect to database for unique email
    public function getEmails(){
        $sql = 'SELECT email FROM users';
        $stmt = $this->connection->prepare($sql);
        $stmt->execute();

        // Get emails from DB
        $emails = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $emails;
    }


}