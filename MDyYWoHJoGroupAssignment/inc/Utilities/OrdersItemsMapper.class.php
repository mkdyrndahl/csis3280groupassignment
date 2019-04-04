<?php

class OrdersItemsMapper {
    private static $db;

    static function initialize(string $className) {
        // Initialize the pdo agent to return a object of classname
        self::$db = new PDOAgent($className);
    }

    // private $PaymentID;
    // private $CustomerID;
    // private $PaymentName;
    // private $PaymentNumber;
    static function createOrderItems(OrdersItems $no) : int {
        // function used to create an object of the parameter class and talk to the db 
        $insertQuery = "INSERT INTO OrdersItems(OrdersID, ItemID, ItemQty) VALUES (:ordersID, :itemID, :itemQty);";

        self::$db->query($insertQuery);
        self::$db->bind(':ordersID',$no->getOrdersID());
        self::$db->bind(':itemID', $no->getItemID());
        self::$db->bind(':itemQty', $no->getItemQty());

        self::$db->execute();

        return self::$db->lastInsertId();
    }

    static function selectAll() : Array {
        // function used to return all objects meeting ther query from the db
        $selectAll = "SELECT * FROM OrdersItems;";

        self::$db->query($selectAll);
        self::$db->execute();

        return self::$db->resultSet();
    }

    static function selectOrdersId($ordersID) : Array {
        // function used to return all  objects from the db which meets the query
        $selectOrder = "SELECT * FROM OrdersItems WHERE OrdersID = :ordersID;";

        self::$db->query($selectOrder);
        self::$db->bind(":ordersID",$ordersID);
        self::$db->execute();

        return self::$db->resultSet();
    }

    static function selectItemID($orderID,$itemID) {
        // function used to return a single object from the db which meets the query
        $selectItem = "SELECT * FROM OrdersItems WHERE ItemID = :itemID and OrdersID = :orderID";

        self::$db->query($selectItem);
        self::$db->bind(":itemID",$itemID);
        self::$db->bind(":orderID",$orderID);
        self::$db->execute();

        return self::$db->singleResult();
    }

    static function updateOrder(OrdersItems $eo, int $itemID) : bool {
        // function used to update a single object from the db which meets the query
        $updateQuery = "UPDATE OrdersItems SET ItemQty = :itemQty WHERE itemID = :itemsID and OrdersID = :orderID;";

        try{
            self::$db->query($updateQuery);
            self::$db->bind('orderID', $eo->getOrdersID());

            self::$db->bind(':itemQty', $eo->getItemQty());
            self::$db->bind(':itemsID', $itemID);

            self::$db->execute();
            if (self::$db->rowCount() != 1) {
                throw new Exception ("Cannot update Order.");
            }
        }
        catch (Exception $ue) {
            echo $ue->getMessage();
            echo self::$db->debugDumpParams();
            return false;
        }
        return true;
    }

    static function deleteOrder(int $ordersID) : bool {
        // function used to delete a single object from the db which meets the query
        $deleteQuery = "DELETE FROM OrdersItems WHERE OrdersID = :ordersID;";

        try{
            self::$db->query($deleteQuery);
            self::$db->bind(':ordersID', $ordersID);

            self::$db->execute();

            if(self::$db->rowCount()!= 1) {
                throw new Exception("Cannot delete Order $ordersID");
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