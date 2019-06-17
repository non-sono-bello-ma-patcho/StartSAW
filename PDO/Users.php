<?php


namespace PDO;


class Users{
    private $conn;
    private $tableName = "users";

    private $username;
    private $name;
    private $surname;
    private $email;
    private $password;
    private $img;
    private $description;
    private $location;
    private $admin;

    public function __construct(Database $db){
        $this->conn = $db->getConnection();
    }

    function create(){
        // insert query
        $query = "INSERT INTO users values (:name, :surname, :username, :email, :pswd, :img, :description, :location, :admin)";

        // prepare the query
        $stmt = $this->conn->prepare($query);

        // sanitize
        $this->name=htmlspecialchars(strip_tags($this->name));
        $this->surname=htmlspecialchars(strip_tags($this->surname));
        $this->username=htmlspecialchars(strip_tags($this->username));
        $this->email=htmlspecialchars(strip_tags($this->email));
        $this->password=htmlspecialchars(strip_tags($this->password));
        $this->img=htmlspecialchars(strip_tags($this->img));
        $this->description=htmlspecialchars(strip_tags($this->description));
        $this->location=htmlspecialchars(strip_tags($this->location));
        $this->admin=htmlspecialchars(strip_tags($this->admin));

        // bind the values
        $stmt->bindParam(':name', $this->name);
        $stmt->bindParam(':surname', $this->surname);
        $stmt->bindParam(':username', $this->username);
        $stmt->bindParam(':email', $this->email);
        $stmt->bindParam(':pswd', $this->password);
        $stmt->bindParam(':img', $this->img);
        $stmt->bindParam(':description', $this->description);
        $stmt->bindParam(':location', $this->location);
        $stmt->bindParam(':admin', $this->admin);

        // hash the password before saving to database
        $password_hash = password_hash($this->password, PASSWORD_BCRYPT);
        $stmt->bindParam(':password', $password_hash);

        // execute the query, also check if query was successful
        if($stmt->execute()){
            return true;
        }

        return false;
    }
}