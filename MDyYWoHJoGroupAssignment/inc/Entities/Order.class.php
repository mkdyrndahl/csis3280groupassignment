<?php


class Order{
    private $OrdersID;
    private $CustomerID;
    private $Amt;
    private $Dates;

    // Getters
    function getOrderID(){
        return $this->OrdersID;
    }
    function getCustomerID(){
        return $this->CustomerID;
    }
    function getAmount(){
        return $this->Amt;    
    }
    function getDate(){
        return $this->Dates;  
    }
    // Setters
    function setOrderID(int $newOrderID){
        $this->OrderID = $newOrderID;
    }
    function setCustomerID(int $newCustomerID){
        $this->CustomerID = $newCustomerID;
    }
  
    function setAmount(float $newAmount){
        $this->Amt = $newAmount;
    }
    function setDate(string $newDate){
        $this->Dates = $newDate;
    }


    function jsonSerialize()    {


        //Make a standard class
        $obj = new StdClass;
        $obj->OrderID = $this->getOrderID();
        $obj->CustomerID = $this->getCustomerID();
        $obj->Amt = $this->getAmount();
        $obj->Dates = $this->getDate();

        //Return the standard class
        return $obj;
    }

}


?>