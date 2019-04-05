<?php


// OrdersID INT AUTO_INCREMENT NOT NULL,
// ItemID INT NOT NULL, 
// ItemQty INT NOT NULL,
// PRIMARY KEY (OrdersID,ItemID),
// FOREIGN KEY (OrdersID) REFERENCES Orders (OrdersID),
// FOREIGN KEY (ItemID) REFERENCES Item (ItemID)


class OrdersItems {

    private $OrdersID;
    private $ItemID;
    private $ItemQty;
    private $itemName;

    // Getters
    function getOrdersID() : int {
        return $this->OrdersID;
    }

    function getItemID() : int {
        return $this->ItemID;
    }

    function getItemQty() : int {
        return $this->ItemQty;
    }

    function getItemName() : string {
        return $this->itemName;
    }
    // Setters
    function setOrdersID(int $oID) {
        $this->OrdersID = $oID;
    }

    function setItemID(int $itemID) {
        $this->ItemID = $itemID;
    }

    function setItemQty(int $itemQty) {
        $this->ItemQty = $itemQty;
    }

    function setItemName(string $newItemName) {
        $this->itemName = $newItemName;
    }

    function json_serialize() {
        // Make a new std class
        $obj = new StdClass();
        $obj->OrdersID = $this->getOrdersID();
        $obj->ItemID = $this->getItemID();
        $obj->ItemQty = $this->getItemQty();
        $obj->itemName = $this->getItemName();
        // Return it
        return $obj;
    }
}
?>