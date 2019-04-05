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
OrdersItemsMapper::initialize("OrdersItems");
OrderMapper::initialize("Order");
ItemMapper::initialize("Item");
Page::$title = "Welcome " .$_SESSION['loggedin']->getfirstName() . " " . $_SESSION['loggedin']->getLastName();
Page::header();


if (!empty($_POST)) {
    if (isset($_POST['action']) && $_POST['action'] == "editOrderItems") {
        $errors = Validation::validate();
        if (!empty($errors)) {
            foreach($errors as $error) {
                echo $error;
            }
        }
        else {
            $eoi = new OrdersItems();
            $eoi->setOrdersID($_POST['orderID']);
            $eoi->setItemID($_POST['itemID']);
            $eoi->setItemQty($_POST['itemQty']);
    
            $itemPrice = ItemMapper::getItemPrice($_POST['itemID']);

            $eo = new Order();
            $eo->setCustomerID($_SESSION['loggedin']->getCustomerID());
            $eo->setAmount($itemPrice->getItemPrice()*$_POST['itemQty']);
            $eo->setDate(date("Y-m-d"));

            OrderMapper::updateOrder($eo, $_POST['orderID']);
            if (OrdersItemsMapper::updateOrder($eoi, $_POST['itemID'])) {
                echo "Order has been updated.";
            }
        }
    }
}

if (!empty($_GET)) {
    if ($_GET['action'] == "delete") {
        OrderMapper::deleteOrder($_GET['id']);
        echo "Your order has been deleted.";
    }
    if($_GET['action'] == "showItems")  {
        $orderItems = OrdersItemsMapper::selectOrdersId($_GET["id"]);
        Page::listOrdersItems($orderItems);
    }
    if ($_GET['action'] == "edit") {
        $orderItems = OrdersItemsMapper::selectOrdersId($_GET["orderid"]);
        Page::listOrdersItems($orderItems);
        $orderItems = OrdersItemsMapper::selectItemID($_GET["orderid"],$_GET["itemid"]);
        Page::showEditOrderItemsForm($orderItems);
    }
    if ($_GET['action'] == 'deleteItem')    {
        OrderMapper::deleteOrder($_GET["orderid"]);
        echo "Your item has been deleted.";
    }
}
$orders = OrderMapper::getCustomerOrders($_SESSION["loggedin"]->getCustomerID());
Page::listOrder($orders);
Page::footer();
?>