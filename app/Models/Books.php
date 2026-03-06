<?php

namespace App\Models;

use Config\Conf;

class Books
{
    private $conn;
    private $table = "books";

    public function __construct()
    {
        $db = new Conf();
        $this->conn = $db->connect();
    }

    public function getAll()
    {
        $query = mysqli_query($this->conn, "SELECT * FROM $this->table") or die(mysqli_error($this->conn));
        $res = array();

        while ($data = mysqli_fetch_assoc($query)) {
            $res[] = $data;
        } 

        return $res;
    }

    public function getById($id)
    {
        $query = mysqli_query($this->conn, "SELECT * FROM $this->table WHERE id=$id");
        $res =  mysqli_fetch_assoc($query);

        return $res;
    }

    public function insert($title, $author, $publisher, $year, $qty)
    {

        $query =    "INSERT INTO $this->table (title, author, publisher, year, qty)
                    VALUES('$title', '$author', '$publisher', $year, $qty)";
        $res = mysqli_query($this->conn, $query);

        if (mysqli_affected_rows($this->conn) == 0) {
            echo "Failed saving books " . mysqli_error($this->conn);
        } else {
            echo "Books saved successfully";
        }

        return $res;
    }

    public function update($id, $title, $author, $publisher, $year, $qty)
    {
        $query = "UPDATE $this->table 
                SET title='$title', 
                        author='$author', 
                        publisher='$publisher', 
                        year=$year, qty=$qty 
                    WHERE id=$id";
        $res = mysqli_query($this->conn, $query);

        if (mysqli_affected_rows($this->conn) == 0) {
            echo "Failed updating books " . mysqli_error($this->conn);
        } else {
            echo "Books updated successfully";
        }
            
        
        return $res;
}

    public function delete($id)
    {
        $query = "DELETE FROM $this->table WHERE id=$id";
        $res = mysqli_query($this->conn, $query);
        
        if (mysqli_affected_rows($this->conn) == 0) {
            echo "Failed deleting books " . mysqli_error($this->conn);
        } else {
            echo "Books deleted successfully";
        }
            
        return $res;
    }
}
