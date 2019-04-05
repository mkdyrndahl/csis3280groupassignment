<?php
require_once('inc/config.inc.php');
require_once('inc/Entities/Customer.class.php');
require_once('inc/Entities/Item.class.php');
require_once('inc/Entities/Order.class.php');
require_once('inc/Entities/OrdersItems.class.php');
require_once('inc/Entities/Payment.class.php');
require_once('inc/Utilities/CustomerMapper.class.php');
require_once('inc/Utilities/ItemMapper.class.php');
require_once('inc/Utilities/OrderMapper.class.php');
require_once('inc/Utilities/OrdersItemsMapper.class.php');
require_once('inc/Utilities/PaymentMapper.class.php');
require_once('inc/Utilities/PDOAgent.class.php');
require_once('inc/Utilities/Page.class.php');
require_once('inc/Utilities/LoginManager.class.php');
require_once('inc/Utilities/Validation.class.php');

LoginManager::verifyLogin();

PaymentMapper::initialize("Payment");
Page::$title = "Welcome " .$_SESSION['loggedin']->getfirstName() . " " . $_SESSION['loggedin']->getLastName();
Page::header();


if (!empty($_POST)) {
    if (isset($_POST['action']) && $_POST['action'] == "editPayment") {
        $errors = Validation::validate();
        if (!empty($errors)) {
            foreach($errors as $error) {
                echo $error;
            }
        }
        else {
            
    // function getPaymentID() : int {
    //     return $this->PaymentID;
    // }

    // function getCustomerID() : int {
    //     return $this->CustomerID;
    // }

    // function getPaymentName() : string {
    //     return $this->PaymentName;
    // }

    // function getPaymentNumber() : int {
    //     return $this->PaymentNumber;
    // }

            $ep = new Payment();
            $ep->setCustomerID($_POST["customerID"]);
            $ep->setPaymentName($_POST["paymentName"]);
            $ep->setPaymentNumber($_POST["paymentNumber"]);
            PaymentMapper::updatePayment($ep, $_POST["paymentID"]);
        }
    }
}

if(!empty($_POST))  {
    if($_POST['action'] == 'add'){
        $np = new Payment();
        $np->setCustomerID($_SESSION["loggedin"]->getCustomerID());
        $np->setPaymentName($_POST['paymentName']); 
        $np->setPaymentNumber($_POST['paymentNumber']);
        PaymentMapper::createPayment($np);
    }
}

if (!empty($_GET)) {
    if ($_GET['action'] == "delete") {
        PaymentMapper::deletePayment($_GET['id']);
    }
    if ($_GET['action'] == "edit") {
        $payment = PaymentMapper::getPayment($_GET['id']);
        Page::showEditPaymentForm($payment);
    }
    if ($_GET['action'] == "add")   {
        Page::showAddPaymentForm();
    }
}
$payments = PaymentMapper::getCustomerPayment($_SESSION["loggedin"]->getCustomerID());
Page::listPayment($payments);
Page::footer();
?>
