<?php

/**
 * Class for user
 */
class User extends Database{

    private $_connection;

    function __construct()
    {
        $this->_connection = Database::getInstance();
    }

    /**
     * User login
     *
     * @param mixed $data form data
     *
     * @return mixed
     */
    public function login($data)
    {
        $sql = 'SELECT * FROM users WHERE email=:email';
        $stmt = $this->_connection->prepare($sql);
        $stmt->bindParam('email', $data['email']);
        $stmt->execute();

        // Store user from db
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        return $user;
    }

    /**
     * User registration
     *
     * @param mixed $data form data
     *
     * @return void
     */
    public function register($data)
    {
        $sql = 'INSERT INTO users (username, email, password)
        VALUES (:username, :email, :password)';

        $stmt = $this->_connection->prepare($sql);
        $stmt->bindParam('username', $data['username']);
        $stmt->bindParam('email', $data['email']);
        $stmt->bindParam(
            'password', password_hash($data['password'], PASSWORD_ARGON2I)
        );
        $stmt->execute();
    }

    /**
     * Connect to database for unique email
     *
     * @return mixed
     */
    public function getEmails()
    {
        $sql = 'SELECT email FROM users';
        $stmt = $this->_connection->prepare($sql);
        $stmt->execute();

        // Get emails from DB
        $emails = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $emails;
    }


}