<?php

class ItemMapper {

    //Place to store the PDO Agent
    private static $db;

    static function initialize(string $className)   {
        // Initialize the pdo agent to return a object of classname
        self::$db = new PDOAgent($className);

    }


    static function createItem(Item $newItem) : int   {
        // function used to create an object of the parameter class and talk to the db 
        $sqlInsert = "INSERT INTO Item (ItemDesc, ItemName, ItemPrice, ItemAvail) 
        VALUES (:ItemDesc, :ItemName, :ItemPrice, :ItemAvail)";

        self::$db->query($sqlInsert);

     
        self::$db->bind(':ItemDesc', $newItem->getItemDesc());
        self::$db->bind(':ItemName', $newItem->getItemName());
        self::$db->bind(':ItemPrice', $newItem->getItemPrice());
        self::$db->bind(':ItemAvail', $newItem->getItemAvail());

        self::$db->execute();

        return self::$db->lastInsertId();

    }

    static function selectAll() : Array {
        // function used to return all objects meeting ther query from the db
        $selectAll = "SELECT * FROM Item;";

        self::$db->query($selectAll);
        self::$db->execute();
        return self::$db->resultSet();
    }

    static function deleteItem(int $ItemID) : bool {
        // function used to delete a single object from the db which meets the query
        $deleteSQLQuery = "DELETE FROM Item WHERE ItemID = :ItemID;";

        try {

            self::$db->query($deleteSQLQuery);
            self::$db->bind(':ItemID', $ItemID);
            self::$db->execute();

            if (self::$db->rowCount() != 1) {
                throw new Exception("Problem deleting item $ItemID");
            }
        } catch(Exception $ex) {
            echo $ex->getMessage();
            self::$db->debugDumpParams();
            return false;
            
        }

        return true;

    }

    static function getItem(int $ItemID)    {
        // function used to return a single object from the db which meets the query
        $sqlSelect = "SELECT * FROM Item WHERE ItemID = :ItemID";
        //Query
        self::$db->query($sqlSelect);
        //Bind
        self::$db->bind(':ItemID', $ItemID);
        //Execute
        self::$db->execute();
        //Return
        return self::$db->singleResult();
    }

    static function getItemPrice(int $ItemID) {
        // function used to return a single objects property from the db which meets the query
        $sqlSelect = "SELECT itemPrice FROM Item WHERE ItemID = :ItemID";
        //Query
        self::$db->query($sqlSelect);
        //Bind
        self::$db->bind(':ItemID', $ItemID);
        //Execute
        self::$db->execute();
        //Return
        return self::$db->singleResult();
    }

    // private $ItemID;
    // private $ItemDesc;
    // private $ItemName;
    // private $ItemPrice;
    // private $ItemAvail;


    static function updateItem(Item $newItem, int $ItemID) {
        // function used to update a single object from the db which meets the query
        $updateQuery = "UPDATE Item SET ItemDesc = :ItemDesc, ItemName=:ItemName,
        ItemPrice = :ItemPrice, ItemAvail = :ItemAvail WHERE ItemID = :ItemID";

        try{

            self::$db->query($updateQuery);

            self::$db->bind(':ItemID', $ItemID);
            self::$db->bind(':ItemDesc', $newItem->getItemDesc());
            self::$db->bind(':ItemName', $newItem->getItemName());
            self::$db->bind(':ItemPrice', $newItem->getItemPrice());
            self::$db->bind(':ItemAvail', $newItem->getItemAvail());

            self::$db->execute();

            if(self::$db->rowCount() !=1) {
                throw new Exception("Item has not been updated.");
            }
            echo "Item has been updated.";
        }
        catch(Exception $ex) {
            echo $ex->getMessage();
            return false;
        }
        return true;


    }
}

?>