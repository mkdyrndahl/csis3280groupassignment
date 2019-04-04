<?php


class Item{
  

    private $ItemID;
    private $itemDesc;
    private $itemName;
    private $itemPrice;
    private $itemAvail;

    // Getters
    function getItemId() {
        return $this->ItemID;
    }

    function getItemDesc() {
        return $this->itemDesc;
    }

    function getItemName() {
        return $this->itemName;
    }

    function getItemPrice() {
        return $this->itemPrice;
    }

    function getItemAvail() {
        return $this->itemAvail;
    }

    // Setters
    function setItemID(int $newItemID) {
        $this->ItemID = $newItemID;
    }

    function setItemDesc(string $newItemDesc) {
        $this->itemDesc = $newItemDesc;
    }

    function setItemName(string $newItemName) {
        $this->itemName = $newItemName;
    }

    function setItemPrice(float $newItemPrice) {
        $this->itemPrice = $newItemPrice;
    }

    function setItemAvail(bool $newItemAvail) {
        $this->itemAvail = $newItemAvail;
    }

    function jsonSerialize()    {

        

        //Make a standard class
        $obj = new StdClass;
        $obj->ItemID = $this->getItemID();
        $obj->itemDesc = $this->getItemDesc();
        $obj->itemName = $this->getItemName();
        $obj->itemPrice = $this->getItemPrice();
        $obj->itemAvail = $this->getItemAvail();
        //Return the standard class
        return $obj;
    }


}
?>