<?php

require_once('inc/config.inc.php');
require_once('inc/Entities/Customer.class.php');
require_once('inc/Utilities/PDOAgent.class.php');
require_once('inc/Utilities/CustomerMapper.class.php');

CustomerMapper::initialize("Customer");

//Pull the request data from the input stream
parse_str(file_get_contents('php://input'), $requestData);

switch($_SERVER["REQUEST_METHOD"])  {
    //GET READ GET READ GET READ GET
    case "GET":

        if(isset($requestData['Username']))   {
            
            $customer = CustomerMapper::selectCustomer($requestData['Username']);
            $jCustomer = $customer->jsonSerialize();
            header('Content-Type: application/json');
            echo json_encode($jCustomer);

        } else {

        //Retreive customers
        $customers = CustomerMapper::selectAll();

        //Array to hold the serialized customers
        $serializedCustomers = array();

        foreach ($customers as $cust)   {
            $serializedCustomers[] = $cust->jsonSerialize();
        }

        header('Content-Type: application/json');
        echo json_encode($serializedCustomers);

    }
    break;
    // POST REQUEST, INSERT!
    case "POST":
          if(isset($requestData['Username']) && !isset($requestData['add'])) {
             $customer = CustomerMapper::selectCustomer($requestData['Username']);
             $jCustomer = $customer->jsonSerialize();
             header('Content-Type: application/json');
             echo json_encode($jCustomer);
          } else {
            //new customer
            $nc = new Customer();
            $nc->setFirstName($requestData['FirstName']);
            $nc->setLastName($requestData['LastName']);
            $nc->setCity($requestData['City']);
            $nc->setCountry($requestData['Country']);
            $nc->setProvince($requestData['Province']);
            $nc->setUsername($requestData['Username2']);
            $nc->setPassword($requestData['Password2']);

            // add to the db
            $result = CustomerMapper::createCustomer($nc);
            // return
            header('Content-Type: application/json');
            echo json_encode($result);

          }
    break;
    // PUT REQUEST TIME TO UPDATE
    case "PUT":
    $nc = new Customer();
    $nc->setFirstName($requestData['firstname']);
    $nc->setLastName($requestData['lastname']);
    $nc->setCity($requestData['city']);
    $nc->setCountry($requestData['country']);
    $nc->setProvince($requestData['province']);
    $nc->setUsername($requestData['username']);
    $nc->setPassword($requestData['password']);

    $result = CustomerMapper::updateCustomer($nc, $requestData['customerID']);

    header('Content-Type: application/json');

    echo json_encode($result);
    break;
    // DELETE REQUEST TIME TO DELETE    
    case "DELETE":

        $result = CustomerMapper::deleteCustomer($requestData['customerID']);
        header('Content-Type: application/json');
        echo json_encode($result);

    break;

    default:
        echo json_encode(array("message"=>"Please enter a proper HTTP request."));
    break;
}