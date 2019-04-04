<?php

class Validation {
    //Validate the input
    public static function validate(): Array   {

        //Initialize and empty array
        $messages = array();
        //Validate all the things
        if (isset($_POST['FirstName']) && empty($_POST["FirstName"])) {
            $messages[] = "You did not enter a First Name.";
        }

        if (isset($_POST['LastName']) && empty($_POST["LastName"])) {
            $messages[] = "You did not enter a Last Name.";
        }
        if (isset($_POST['Address']) && empty($_POST["Address"])) {
            $messages[] = "You did not enter an Address.";
        }
        if (isset($_POST['City']) && empty($_POST["City"])) {
            $messages[] = "You did not enter a city.";
        }
        if (isset($_POST['Province']) && empty($_POST["Province"])) {
            $messages[] = "You did not enter a province.";
        }

        if (isset($_POST['Country']) && empty($_POST["Country"])) {
            $messages[] = "You did not enter a Country.";
        }
        
        if (isset($_POST['Username']) && empty($_POST['Username'])) {
            $messages[] = "You did not enter a proper username.";
        }

        if (isset($_POST['password']) && empty($_POST['password'])) {
            $messages[] = "You did not enter a correct password.";
        }

        if (isset($_POST['name']) && empty($_POST['name'])) {
            $messages[] = "You did not enter an item name.";
        }

        if (isset($_POST['desc']) && empty($_POST['desc'])) {
            $messages[] = "You did not enter an item description.";
        }

        if (isset($_POST['price']) && empty($_POST['price'])) {
            $messages[] = "You did not enter an item price.";
        }

        if (isset($_POST['avail']) && empty($_POST['avail'])) {
            $messages[] = "You did not enter an item available.";
        }

        if(isset($_POST['UserName']) && isset($_POST['Password']) && $user == null){
            $messages[] = "You must enter a correct user name and password combination.";

        }
        
        return $messages;
        
    }
}

?>