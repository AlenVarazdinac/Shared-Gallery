<?php

class Gallery extends Database{

    public $userId;

    // Set User ID
    function __construct($userId){
        $this->userId = $userId;
    }

    // Upload image to database
    public function dbUpload($imageName){
        // Connect to database
        $connection = Database::connect();
        $sql = 'INSERT INTO images (uploaded_by, name) VALUES(:uploaded_by, :name)';
        $stmt = $connection->prepare($sql);
        $stmt->bindParam('uploaded_by', $this->userId);
        $stmt->bindParam('name', $imageName);
        $stmt->execute();
    }

    // Get latest image
    public function getLastImage(){
        // Connect to database
        $connection = App::connect();

        $sql = 'SELECT * FROM images WHERE uploaded_by=:uploaded_by ORDER BY name DESC LIMIT 1';
        $stmt = $connection->prepare($sql);
        $stmt->bindParam('uploaded_by', $this->userId);
        $stmt->execute();

        $image = $stmt->fetch(PDO::FETCH_ASSOC);
        return $image;
    }
}