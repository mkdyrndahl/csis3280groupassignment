<?php

class CustomerMapper {
    private static $db;

    static function initialize(string $className) {
        // Initialize the pdo agent to return a object of classname
        self::$db = new PDOAgent($className);
    }
    // CustomerID INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    // FirstName VARCHAR(20) NOT NULL,
    // LastName VARCHAR(20) NOT NULL,
    // Address VARCHAR(50) NOT NULL,
    // City VARCHAR(20) NOT NULL,
    // Country VARCHAR(20) NOT NULL,
    // Username VARCHAR(20) NOT NULL,
    // Password VARCHAR(50) NOT NULL,
    static function createCustomer(Customer $nc) : int {
        // function used to create an object of the parameter class and talk to the db 
        $insertQuery = "INSERT INTO Customer (FirstName, LastName, Address, City, Province, Country, Username, Password) 
                    VALUES (:firstName, :lastName, :address, :city, :province, :country, :username, :password);";

        self::$db->query($insertQuery);
        self::$db->bind(':firstName', $nc->getFirstName());
        self::$db->bind(':lastName', $nc->getLastName());
        self::$db->bind(':address', $nc->getAddress());
        self::$db->bind(':city', $nc->getCity());
        self::$db->bind(':province', $nc->getProvince());
        self::$db->bind(':country', $nc->getCountry());
        self::$db->bind(':username', $nc->getUsername());
        self::$db->bind(':password', $nc->getPassword());

        self::$db->execute();

        return self::$db->lastInsertId();

    }

    static function selectAll() : Array {
        // function used to return all objects meeting ther query from the db 
        $selectAll = "SELECT * FROM Customer;";

        self::$db->query($selectAll);

        self::$db->execute();

        return self::$db->resultSet();
    }

    static function selectCustomer(string $username) {
        // function used to return a single object from the db which meets the query
        $selectCustomer = "SELECT * FROM Customer WHERE Username = :username;";

        self::$db->query($selectCustomer);
        self::$db->bind(':username', $username);
        self::$db->execute();

        return self::$db->singleResult();
    }

    static function updateCustomer(Customer $ec, int $custID) : bool {
        // function used to update a single object from the db which meets the query
        $updateQuery = "UPDATE Customer SET FirstName = :firstName, LastName = :lastName, Address = :address, 
            City = :city, Province = :province, Country = :country, Username = :username, Password = :password 
            WHERE CustomerID = :custID;";

        try {
            self::$db->query($updateQuery);

            self::$db->bind(':firstName', $ec->getFirstName());
            self::$db->bind(':lastName', $ec->getLastName());
            self::$db->bind(':address', $ec->getAddress());
            self::$db->bind(':city', $ec->getCity());
            self::$db->bind(':province', $ec->getProvince());
            self::$db->bind(':country', $ec->getCountry());
            self::$db->bind(':username', $ec->getUsername());
            self::$db->bind(':password', $ec->getPassword());
            self::$db->bind(':custID', $custID);
    
            self::$db->execute();

            if (self::$db->rowCount() != 1) {
                throw new Exception ("Cannot update Customer $custID");
            }
        }
        catch (Exception $qe) {
            echo $qe->getMessage();
            echo self::$db->debugDumpParams();
            return false;
        }
        return true;
    }

    static function deleteCustomer(int $custID) : bool {
        // function used to delete a single object from the db which meets the query
        $deleteQuery = "DELETE FROM Customer WHERE CustomerID = :custID;";

        try {
            self::$db->query($deleteQuery);

            self::$db->bind(':custID', $custID);
            self::$db->execute();

            if (self::$db->rowCount() != 1) {
                throw new Exception ("Cannot delete Customer $custID");
            }
        }
        catch (Exception $de) {
            echo $de->getMessage();
            echo self::$db->debugDumpParams();
            return false;
        }
        return true;
    }
}

?>