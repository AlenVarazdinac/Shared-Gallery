<?php

/**
 * Account class
 */
class Account extends Database
{

    private $_connection;

    /**
     * Database connection
     */
    function __construct()
    {
        $this->_connection = Database::getInstance();
    }

    /**
     * Get users password
     *
     * @param mixed $user user data
     *
     * @return mixed
     */
    public function getPassword($user)
    {
        $sql = 'SELECT * FROM users WHERE id=:id AND email=:email';

        $stmt = $this->_connection->prepare($sql);
        $stmt->bindParam('id', $user['id']);
        $stmt->bindParam('email', $user['email']);
        $stmt->execute();

        // Store user from DB
        $dbUser = $stmt->fetch(PDO::FETCH_ASSOC);

        return $dbUser;
    }

    /**
     * Change users password
     *
     * @param mixed $data    form data
     * @param mixed $account current account data
     *
     * @return void
     */
    public function changePassword($data, $account)
    {
        $sql = 'UPDATE users SET password=:password WHERE id=:id AND email=:email';

        $stmt = $this->_connection->prepare($sql);
        $stmt->bindParam(
            'password', password_hash($data['newPassword'], PASSWORD_ARGON2I)
        );
        $stmt->bindParam('id', $account['id']);
        $stmt->bindParam('email', $account['email']);
        $stmt->execute();
    }

    /**
     * Delete account
     *
     * @param mixed $user user data
     *
     * @return void
     */
    public function deleteAccount($user)
    {
        $sql = 'DELETE FROM users WHERE id=:id AND email=:email';
        $stmt = $this->_connection->prepare($sql);
        $stmt->bindParam('id', $user['id']);
        $stmt->bindParam('email', $user['email']);
        $stmt->execute();
    }
}