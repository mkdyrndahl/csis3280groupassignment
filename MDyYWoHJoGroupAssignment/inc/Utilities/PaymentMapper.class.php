<?php

class PaymentMapper {
    private static $db;

    static function initialize(string $className) {
        // Initialize the pdo agent to return a object of classname
        self::$db = new PDOAgent($className);
    }

    // private $PaymentID;
    // private $CustomerID;
    // private $PaymentName;
    // private $PaymentNumber;
    static function createPayment(Payment $np) : int {
        // function used to create an object of the parameter class and talk to the db 
        $insertQuery = "INSERT INTO Payments(CustomerID, PaymentName, PaymentNumber) VALUES (:custID, :payName, :payNum);";

        self::$db->query($insertQuery);
        self::$db->bind(':custID', $np->getCustomerID());
        self::$db->bind(':payName', $np->getPaymentName());
        self::$db->bind(':payNum', $np->getPaymentNumber());

        self::$db->execute();

        return self::$db->lastInsertId();
    }

    static function selectAll() : Array {
        $selectAll = "SELECT * FROM Payment;";

        self::$db->query($selectAll);
        self::$db->execute();

        return self::$db->resultSet();
    }

    static function getCustomerPayment(int $CustomerID)    {
        
        $sqlSelect = "SELECT * FROM payments WHERE CustomerID = :CustomerID";
        //Query
        self::$db->query($sqlSelect);
        //Bind
        self::$db->bind(':CustomerID', $CustomerID);
        //Execute
        self::$db->execute();
        //Return
        return self::$db->resultSet();
    } 

    static function getPayment(int $PaymentID)    {
        
        $sqlSelect = "SELECT * FROM Payments WHERE PaymentID = :PaymentID";
        //Query
        self::$db->query($sqlSelect);
        //Bind
        self::$db->bind(":PaymentID",$PaymentID);
        //Execute
        self::$db->execute();
        //Return
        return self::$db->singleResult();
    } 

    static function updatePayment(Payment $ep, int $payID) : bool {
        $updateQuery = "UPDATE Payments SET CustomerID = :custID, PaymentName = :payName, PaymentNumber = :payNum WHERE PaymentID = :payID;";

        try{
            self::$db->query($updateQuery);
            self::$db->bind(':custID', $ep->getCustomerID());
            self::$db->bind(':payName', $ep->getPaymentName());
            self::$db->bind(':payNum', $ep->getPaymentNumber());
            self::$db->bind(':payID', $payID);

            self::$db->execute();
            if (self::$db->rowCount() != 1) {
                throw new Exception ("Cannot update Payment $payID");    
            }
            echo "Your payment methods have been updated.";
        }
        catch (Exception $ue) {
            echo $ue->getMessage();
            return false;
        }
        return true;
    }

    static function deletePayment(int $payID) : bool {
        $deleteQuery = "DELETE FROM Payments WHERE PaymentID = :payID;";

        try{
            self::$db->query($deleteQuery);
            self::$db->bind(':payID', $payID);

            self::$db->execute();

            if(self::$db->rowCount()!= 1) {
                throw new Exception("Cannot delete Payment $payID");
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