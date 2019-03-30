<?php

class Gallery extends Database{

    public $userId;
    private $connection;

    function __construct(){
        $this->connection = $this->connect();
    }

    // Get images for Gallery
    public function showImages(){
        $sql = 'SELECT i.id, i.uploaded_by, i.name, u.id AS userid, u.username, u.email
        FROM images i
        LEFT JOIN users u
        ON u.id=i.uploaded_by';
        $stmt = $this->connection->prepare($sql);
        $stmt->execute();

        $images = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $images;
    }

    // Upload image to database
    public function dbUpload($userId, $imageName){
        $sql = 'INSERT INTO images (uploaded_by, name) VALUES(:uploaded_by, :name)';
        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam('uploaded_by', $userId);
        $stmt->bindParam('name', $imageName);
        $stmt->execute();
    }

    // Delete image from database
    public function dbDelete($userId, $imageName){
        $sql = 'DELETE FROM images WHERE uploaded_by=:uploaded_by AND name=:name';
        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam('uploaded_by', $userId);
        $stmt->bindParam('name', $imageName);
        $stmt->execute();
    }

    // Get latest image
    public function getLastImage($userId){
        $sql = 'SELECT * FROM images WHERE uploaded_by=:uploaded_by ORDER BY name DESC LIMIT 1';
        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam('uploaded_by', $userId);
        $stmt->execute();

        $image = $stmt->fetch(PDO::FETCH_ASSOC);
        return $image;
    }

    // Count images in database
    public function countImages(){
        $sql = 'SELECT COUNT(*) FROM images';
        $stmt = $this->connection->prepare($sql);
        $stmt->execute();

        $imagesCounted = $stmt->fetchColumn();

        return $imagesCounted;
    }
}