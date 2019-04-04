<?php
// We had trouble implementing the REST Api within the allotted time so we used a combination of
// PDO and REST in order to have a functioning application to submit.
//Require the config
require_once('inc\config.inc.php');

//Require entities
require_once('inc\Entities\Customer.class.php');

//Require Utilities
require_once('inc\Utilities\LoginManager.class.php');
require_once('inc\Utilities\Page.class.php');
require_once('inc\Utilities\Validation.class.php');
require_once('inc\Utilities\RestClientCustomers.class.php');
require_once('inc\Utilities\CustomerMapper.class.php');
require_once('inc\Utilities\PDOAgent.class.php');
//Set title
Page::$title = "Group Assignment 01";
//header
Page::header();
CustomerMapper::initialize("Customer");
//If they not continue
//Check the login
if (!empty($_POST) )  {
    
    if ($_POST["action"] == "login") {
    //Initialize the user mapper
    
    // //Check the vlaidation
    $errors = Validation::validate();
    if (!empty(Validation::validate())) {
        foreach ($errors as $error) {
            echo $error;
        }
    } else {
    //Get the user by username (because thats all we have in the form)
    try{
        $jBarf = RestClientCustomers::call("POST",array('Username'=>$_POST["Username"]));
                           
        $jUser = json_decode($jBarf);
        $user = new Customer();
        $user->setCustomerID($jUser->CustomerID);
        $user->setFirstName($jUser->FirstName);
        $user->setLastName($jUser->LastName);
        $user->setAddress($jUser->Address);
        $user->setCity($jUser->City);
        $user->setCountry($jUser->Country);
        $user->setUsername($jUser->Username);
        $user->setUnhashedPass($jUser->Password);
        if($jUser == null)
        throw new Exception("You must enter a valid username and password combination.");
        } catch (Exception $ex){
            $ex->getMessage();
        } 
    }
    //Check the mapper returned an object and the object is a user (in case the username is invalid)
    if (!empty($user)) {
            //Verify that users password against the password in the form
            if ($user->verifyPassword($_POST["Password"])) {
                
            //If true log them in by starting a sesssion and forwarding them to the main page
            session_start();
            //Set the logged in to true
            $_SESSION['loggedin'] = $user;
            //Send the user to the user managment page
            header('Location: MDyYWoHJoWelcome.php');
            }
             else if (!empty($_POST["Password"])) {
                 echo "You did not enter a correct username or password";
             }
       }
    }
    if ($_POST["action"] == "add") {
        $errors = Validation::validate();
        if (!empty($errors)) {
            foreach ($errors as $error) {
                echo $error;
            }
        }
        else {
            $nc = new Customer();
            $nc->setFirstName($_POST["FirstName"]);
            $nc->setLastName($_POST["LastName"]);
            $nc->setAddress($_POST["Address"]);
            $nc->setCity($_POST["City"]);
            $nc->setProvince($_POST["Province"]);
            $nc->setCountry($_POST["Country"]);
            $nc->setUsername($_POST["Username"]);
            $nc->setPassword($_POST["Password"]);

            CustomerMapper::createCustomer($nc);
            // Attempted to use REST but were unable to properly create a 
            // new customer and add to the database
        }
}  
}

// if(!empty($_GET)) {
//     if ($_GET["action"] == "delete") {
//         RestClientCustomers::call("DELETE",$_GET["id"]);
//     }

//     if ($_GET['action'] == "editItem") {
        
//     }
// }

if (isset($_GET['link'])) {
    Page::showAddUserForm();
    
}

Page::showLogin();

//footer
Page::footer();