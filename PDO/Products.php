<?php


namespace PDO;


class Products{
    private $conn;


    private $code;
    private $name;
    private $description;
    private $price;
    private $img;
    private $relevance;
    private $level;
    private $location;
    private $admin;

    public function __construct(Database $db){
        $this->conn = $db->getConnection();
    }

    function create(){
        // insert query
        $query = "INSERT INTO users values (:name, :price, :code, :relevance, :pswd, :img, :description, :location, :admin)";

        // prepare the query
        $stmt = $this->conn->prepare($query);

        // sanitize
        $this->code=htmlspecialchars(strip_tags($this->code));
        $this->name=htmlspecialchars(strip_tags($this->name));
        $this->description=htmlspecialchars(strip_tags($this->description));
        $this->price=htmlspecialchars(strip_tags($this->price));
        $this->img=htmlspecialchars(strip_tags($this->img));
        $this->relevance=htmlspecialchars(strip_tags($this->relevance));
        $this->level=htmlspecialchars(strip_tags($this->level));
        $this->location=htmlspecialchars(strip_tags($this->location));
        $this->admin=htmlspecialchars(strip_tags($this->admin));

        // bind the values
        $stmt->bindParam(':code', $this->code);
        $stmt->bindParam(':name', $this->name);
        $stmt->bindParam(':description', $this->description);
        $stmt->bindParam(':price', $this->price);
        $stmt->bindParam(':img', $this->img);
        $stmt->bindParam(':relevance', $this->relevance);
        $stmt->bindParam(':level', $this->level);
        $stmt->bindParam(':location', $this->location);
        $stmt->bindParam(':admin', $this->admin);


        // execute the query, also check if query was successful
        if($stmt->execute()){
            return true;
        }

        return false;
    }
}