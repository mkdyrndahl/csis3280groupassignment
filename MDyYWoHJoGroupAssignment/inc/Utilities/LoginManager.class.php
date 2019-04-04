<?php


class LoginManager  {


    //This function checks if the user is logged in, if they are not they are redirected to the login page
    static function verifyLogin()   {

        //Check for a session_id or the $_SESSION variable
        if (empty($_SESSION)) {
            //Start it up
            session_start();

        //If te user is logged in
            if (!empty($_SESSION["loggedin"])) {

            //The user is loggedin
                return true;
            }
            //The user is not logged in
            else {
                //Destroy any session just in case
                unset($_SESSION);
                session_destroy();
                //Send them back to the login page
                //Redirect the user to the login page
                header('Location: MDyYWoHJoLogin.php');
                //Return false
                return false;
            }
        }
    }
}

?>