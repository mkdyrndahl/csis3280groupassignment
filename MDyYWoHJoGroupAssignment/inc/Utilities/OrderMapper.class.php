<?php

class OrderMapper {

    //Place to store the PDO Agent
    private static $db;

    static function initialize(string $className)   {
        // Initialize the pdo agent to return a object of classname
        self::$db = new PDOAgent($className);

    }

    static function createOrder(Order $newOrder) : int   {
        // function used to create an object of the parameter class and talk to the db 
        $sqlInsert = "INSERT INTO Orders (CustomerID, Amt, Dates) 
        VALUES (:CustomerID, :Amount, :Date) ";

        self::$db->query($sqlInsert);

        self::$db->bind(':CustomerID', $newOrder->getCustomerID());
        self::$db->bind(':Amount', $newOrder->getAmount());
        self::$db->bind(':Date', $newOrder->getDate());
       

        self::$db->execute();

        return self::$db->lastInsertId();

    }

    static function selectAll() : Array {
        // function used to return all objects meeting ther query from the db
        $selectAll = "SELECT * FROM Orders;";

        self::$db->query($selectAll);
        self::$db->execute();
        return self::$db->resultSet();
    }

    static function deleteOrder(int $OrderID) : bool {
        $deleteSQLQuery = "DELETE FROM Orders WHERE OrdersID = :OrderID;";

        try {

            self::$db->query($deleteSQLQuery);
            self::$db->bind(':OrderID', $OrderID);
            self::$db->execute();

            if (self::$db->rowCount() != 1) {
                throw new Exception("Problem deleting order $OrderID");
            }
        } catch(Exception $ex) {
            echo $ex->getMessage();
            self::$db->debugDumpParams();
            return false;
            
        }

        return true;

    }


    static function getCustomerOrders(int $CustomerID)    {
        // function used to return a objects from the db which meets the query
        $sqlSelect = "SELECT * FROM Orders WHERE CustomerID = :CustomerID";
        //Query
        self::$db->query($sqlSelect);
        //Bind
        self::$db->bind(':CustomerID', $CustomerID);
        //Execute
        self::$db->execute();
        //Return
        return self::$db->resultSet();
    } 

    static function getOrder(int $OrderID)    {
        // function used to return a single object from the db which meets the query
        $sqlSelect = "SELECT * FROM Orders WHERE OrderID = :OrderID";
        //Query
        self::$db->query($sqlSelect);
        //Bind
        self::$db->bind(':OrderID', $OrderID);
        //Execute
        self::$db->execute();
        //Return
        return self::$db->singleResult();
    } 

    static function updateOrder(Order $newOrder, int $OrderID): bool {
        // function used to  update a objects from the db which meets the query
        $updateQuery = "UPDATE Orders SET CustomerID = :CustomerID, Amt = :Amount, Dates=:Date 
        WHERE OrdersID = :OrderID;";

        try{
        self::$db->query($updateQuery);
        
        self::$db->bind(':OrderID', $OrderID);
        self::$db->bind(':CustomerID', $newOrder->getCustomerID());
        self::$db->bind(':Amount', $newOrder->getAmount());
        self::$db->bind(':Date', $newOrder->getDate());

        self::$db->execute();

        if(self::$db->rowCount() != 1) {
            throw new Exception("Problem updating order $OrderID");
        }

        }
        catch(Exception $ex) {
            echo $ex->getMessage();
            self::$db->debugDumpParams();
            return false;
        }
        
        return true;

    }

    
}

?>