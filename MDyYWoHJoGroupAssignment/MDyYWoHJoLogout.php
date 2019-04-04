<?php

//Include the page and the login manager
require_once("inc/Utilities/Page.class.php");
require_once("inc/Utilities/LoginManager.class.php");

//Verify if the user is logged in
if (LoginManager::verifyLogin())    {

    Page::$title = "Good Bye!";
    //Call the Page goodbye
    Page::header($logout="");
    Page::goodBye();
    Page::footer();

}
    //Unset the session or destroy the session
    unset($_SESSION);
    session_destroy();

?>