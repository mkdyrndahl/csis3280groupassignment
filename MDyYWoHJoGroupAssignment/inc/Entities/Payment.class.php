<?php

class Payment {
    private $PaymentID;
    private $CustomerID;
    private $PaymentName;
    private $PaymentNumber;

    // Getters
    function getPaymentID() : int {
        return $this->PaymentID;
    }

    function getCustomerID() : int {
        return $this->CustomerID;
    }

    function getPaymentName() : string {
        return $this->PaymentName;
    }

    function getPaymentNumber() : string {
        return $this->PaymentNumber;
    }
    // Setters
    function setPaymentID(int $pid) {
        $this->PaymentID = $pid;
    }

    function setCustomerID(int $cid) {
        $this->CustomerID = $cid;
    }

    function setPaymentName(string $pname) {
        $this->PaymentName = $pname;
    }

    function setPaymentNumber(string $pNum) {
        $this->PaymentNumber = $pNum;
    }

    function json_serialize() {
        $obj = new StdClass();
        // make a new std class
        $obj->PaymentID = $this->getPaymentID();
        $obj->CustomerID = $this->getCustomerID();
        $obj->PaymentName = $this->getPaymentName();
        $obj->PaymentNumber = $this->getPaymentNumber();
        // Return it 
        return $obj;
    }
}


?>