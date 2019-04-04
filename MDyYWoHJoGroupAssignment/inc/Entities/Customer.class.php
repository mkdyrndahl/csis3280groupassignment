<?php

class Customer {
    // CustomerID INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    // FirstName VARCHAR(20) NOT NULL,
    // LastName VARCHAR(20) NOT NULL,
    // Address VARCHAR(50) NOT NULL,
    // City VARCHAR(20) NOT NULL,
    // Country VARCHAR(20) NOT NULL,
    // Username VARCHAR(20) NOT NULL,
    // Password VARCHAR(50) NOT NULL,

    private $CustomerID;
    private $FirstName;
    private $LastName;
    private $Address;
    private $City;
    private $Province;
    private $Country;
    private $Username;
    private $Password;
    
    // getters
    function getCustomerID() : int {
        return $this->CustomerID;
    }
    function getFirstName() : string {
        return $this->FirstName;
    }

    function getLastName() : string {
        return $this->LastName;
    }

    function getAddress() : string {
        return $this->Address;
    }

    function getCity() : string {
        return $this->City;
    }

    function getCountry() : string {
        return $this->Country;
    }

    function getProvince() : string {
        return $this->Province;
    }

    function getUsername() : string {
        return $this->Username;
    }

    function getPassword() : string {
        return $this->Password;
    }

    // setters
    function setCustomerID(int $id) {
        $this->CustomerID = $id;
    }

    function setFirstName(string $fn) {
        $this->FirstName = $fn;
    }

    function setLastName(string $ln) {
        $this->LastName = $ln;
    }

    function setAddress(string $add) {
        $this->Address = $add;
    }
    
    function setCity(string $city) {
        $this->City = $city;
    }

    function setCountry(string $country) {
        $this->Country = $country;
    }

    function setProvince(string $province) {
        $this->Province = $province;
    }

    function setUsername(string $user) {
        $this->Username = $user;
    } 

    function setPassword(string $pw) {
        $hash = password_hash($pw, PASSWORD_DEFAULT);

        $this->Password = $hash;
    }

    function setUnhashedPass(string $pw){
        $this->Password = $pw;
    }
    
    //function to serialize json data
    function jsonSerialize() {

        $obj = new StdClass();
        $obj->CustomerID = $this->getCustomerID();
        $obj->FirstName = $this->getFirstName();
        $obj->LastName = $this->getLastName();
        $obj->Address = $this->getAddress();
        $obj->City = $this->getCity();
        $obj->Province = $this->getProvince();
        $obj->Country = $this->getCountry();
        $obj->Username = $this->getUsername();
        $obj->Password = $this->getPassword();

        return $obj;
    }

    function verifyPassword($verify) {
        return password_verify($verify,$this->Password);
    }
}

?>