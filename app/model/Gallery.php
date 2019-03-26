<?php

class Gallery extends Database{

    public $userId;

    function __construct(){
    }

    // Get images for Gallery
    public function showImages(){
        // Connect to database
        $connection = Database::connect();

        $sql = 'SELECT i.id, i.uploaded_by, i.name, u.id AS userid, u.username, u.email
        FROM images i
        LEFT JOIN users u
        ON u.id=i.uploaded_by';
        $stmt = $connection->prepare($sql);
        $stmt->execute();

        $images = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $images;
    }

    // Upload image to database
    public function dbUpload($userId, $imageName){
        // Connect to database
        $connection = Database::connect();

        $sql = 'INSERT INTO images (uploaded_by, name) VALUES(:uploaded_by, :name)';
        $stmt = $connection->prepare($sql);
        $stmt->bindParam('uploaded_by', $userId);
        $stmt->bindParam('name', $imageName);
        $stmt->execute();
    }

    // Delete image from database
    public function dbDelete($userId, $imageName){
        // Connect to database
        $connection = Database::connect();

        $sql = 'DELETE FROM images WHERE uploaded_by=:uploaded_by AND name=:name';
        $stmt = $connection->prepare($sql);
        $stmt->bindParam('uploaded_by', $userId);
        $stmt->bindParam('name', $imageName);
        $stmt->execute();
    }

    // Get latest image
    public function getLastImage(){
        // Connect to database
        $connection = Database::connect();

        $sql = 'SELECT * FROM images WHERE uploaded_by=:uploaded_by ORDER BY name DESC LIMIT 1';
        $stmt = $connection->prepare($sql);
        $stmt->bindParam('uploaded_by', $userId);
        $stmt->execute();

        $image = $stmt->fetch(PDO::FETCH_ASSOC);
        return $image;
    }
}