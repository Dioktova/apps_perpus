<?php

class Petugas{

    //koneksi databse dan nama table
    private $conn;
    private $table_name = "petugas";

    // property object penerbit
    public $ID;
    public $username;
    public $Email;
    public $Password;
    public $Role;

    public function __construct($db) {
        $this->conn = $db;
    }
    function create() {
        // insert
        $query = "INSERT INTO " . $this->table_name . " (username, Email, Password, Role)" .
                                  " VALUES (:username, :Email, :Password, :Role)";
        
        $result = $this->conn->prepare($query);
    
        $this->username = htmlspecialchars(strip_tags($this->username));
        $this->Email = htmlspecialchars(strip_tags($this->Email));
        $this->Password = htmlspecialchars(strip_tags($this->Password));
        $this->role = htmlspecialchars(strip_tags($this->Role));

        $result->bindParam(":username", $this->username);
        $result->bindParam(":Email", $this->Email);
        $result->bindParam(":Password", $this->Password);
        $result->bindParam(":Role", $this->Role);
        
        try {
            if ($result->execute()) {
                return true;
            } else {
                // Handle failure
                throw new Exception("Perintah SQL gagal dieksekusi.");
            }
        } catch (PDOException $e) {
            // Handle database error
            echo "Error: " . $e->getMessage();
            return false;
        } catch (Exception $e) {
            // Handle other exceptions
            echo "Error: " . $e->getMessage();
            return false;
        }
        
    }
    function update() {
        $query = "UPDATE " . $this->table_name . " SET
                                                    username = :username,
                                                    Email = :Email,
                                                    Password = :Password,
                                                    Role = :Role
                                                    WHERE 
                                                    ID = :ID";
        
        $result = $this->conn->prepare($query);

        $this->username = htmlspecialchars(strip_tags($this->username));
        $this->Email = htmlspecialchars(strip_tags($this->Email));
        $this->Password = htmlspecialchars(strip_tags($this->Password));
        $this->Role = htmlspecialchars(strip_tags($this->Role));
    
        // Bind parameters
        $result->bindParam(":username", $this->username);
        $result->bindParam(":Email", $this->Email);
        $result->bindParam(":Password", $this->Password);
        $result->bindParam(":Role", $this->Role);
        $result->bindParam(":ID", $this->ID);
    
        // Execute the query
        if ($result->execute()) {
            return true;
        } else {
            return false;
        }
    }

    function readAll() {
        // select
        $query = "SELECT * FROM " . $this->table_name;

        $result = $this->conn->prepare($query);
        $result->execute();

        return $result;
    }
    function readOne() {
        $query = "SELECT * FROM " . $this->table_name . " WHERE ID = ?";
        
        $result = $this->conn->prepare($query);
        $result->bindParam(1, $this->ID);
        $result->execute();

        $row = $result->fetch(PDO::FETCH_ASSOC);
        
        $this->username = $row["username"];
        $this->Email = $row["Email"];
        $this->Password = $row["Password"];
        $this->Role = $row["Role"];
        $this->ID = $row["ID"];
    }
    function delete() {
        $query = "DELETE FROM " . $this->table_name . " WHERE ID = ?";

        $result = $this->conn->prepare($query);
        $result->bindParam(1, $this->ID);

        if ($result->execute()) {
            return true;
        } else {
            return false;
        }
    }
    


    function authenticate() {
        $query = "SELECT * FROM " . $this->table_name . " WHERE Email = :Email AND Password = :Password";

        $result = $this->conn->prepare($query);

        $this->Email=htmlspecialchars(strip_tags($this->Email));
        $this->Password=htmlspecialchars(strip_tags($this->Password));

        $result->bindParam(":Email", $this->Email);
        $result->bindParam(":Password", $this->Password);
        
        $result->execute();

        if($result->rowCount() > 0) {
            $petugas = $result->fetch(PDO::FETCH_ASSOC);

            $_SESSION["usernamepetugas"] = $petugas["usernamepetugas"];
            $_SESSION["roletugas"] = $petugas["Role"];
            $_SESSION["idpetugas"] = $petugas["ID"];
            $_SESSION["emailpetugas"] = $petugas["Email"];
            
            return true;
        } else {
            return false;
        }
    }
}
?>