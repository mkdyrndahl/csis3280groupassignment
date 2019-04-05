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
require_once('inc/Utilities/RestClientItems.class.php');

LoginManager::verifyLogin();

CustomerMapper::initialize("Customer");
//ItemMapper::initialize("Item");
OrderMapper::initialize("Order");
OrdersItemsMapper::initialize("OrdersItems");
Page::$title = "Welcome " .$_SESSION['loggedin']->getfirstName() . " " . $_SESSION['loggedin']->getLastName();
Page::header();

if (isset($_POST['edituser'])) {
        Page::showEditUserForm($_SESSION['loggedin']);
}

if (!empty($_POST)) {
    if (isset($_POST['action']) && $_POST['action'] == "editUser") {
        $errors = Validation::validate();
        if (!empty($errors)) {
            foreach($errors as $error) {
                echo $error;
            }
        }
        else {
            $ec = new Customer();
            $ec->setFirstName($_POST["FirstName"]);
            $ec->setLastName($_POST["LastName"]);
            $ec->setAddress($_POST["Address"]);
            $ec->setCity($_POST["City"]);
            $ec->setProvince($_POST["Province"]);
            $ec->setCountry($_POST["Country"]);
            $ec->setUsername($_POST["Username"]);
            $ec->setPassword($_POST["Password"]);

            CustomerMapper::updateCustomer($ec, $_POST['CustomerID']);
            $user = CustomerMapper::selectCustomer($_POST["Username"]);
            $_SESSION['loggedin'] = $user;
        }
    }
    if (isset($_POST['action']) && $_POST['action'] == "addItem") {
        $errors = Validation::validate();
        if (!empty($errors)) {
            foreach($errors as $error) {
                echo $error;
            }
        }
        else {
            // $ni = new Item();
            // $ni->setItemName($_POST['name']);
            // $ni->setItemDesc($_POST['desc']);
            // $ni->setItemPrice((int)$_POST['price']);
            // $ni->setItemAvail($_POST['avail']);

            // ItemMapper::createItem($ni);

            RestClientItems::call("POST", $_POST);
        }
    }
    if (isset($_POST['action']) && $_POST['action'] == "editItem") {
        $errors = Validation::validate();
        if (!empty($errors)) {
            foreach($errors as $error) {
                echo $error;
            }
        }
        else {
            // $ei = new Item();
            // $ei->setItemName($_POST['name']);
            // $ei->setItemDesc($_POST['desc']);
            // $ei->setItemPrice((int)$_POST['price']);
            // $ei->setItemAvail($_POST['avail']);

            // ItemMapper::updateItem($ei, $_POST['itemID']);

            RestClientItems::call("PUT", array('name' => $_POST['name'],
                                    'desc' => $_POST['desc'],
                                    'price' => $_POST['price'],
                                    'avail' => $_POST['avail'],
                                    'itemID' => $_POST['itemID']
                                    
            )
        );
        }
    }
}



// ItemMapper::Initialize("Item");
// $items = ItemMapper::selectAll();
$result = RestClientItems::call("GET", array());
$jitems = json_decode($result);
$items = array();

foreach($jitems as $i) {
    $ni = new Item();
    $ni->setItemID($i->ItemID);
    $ni->setItemDesc($i->itemDesc);
    $ni->setItemName($i->itemName);
    $ni->setItemPrice($i->itemPrice);
    $ni->setItemAvail($i->itemAvail);

    $items[] = $ni;
}

if (!empty($_GET)) {
    if ($_GET['action'] == "delete") {
        //ItemMapper::deleteItem($_GET['id']);
        RestClientItems::call("DELETE", array('id' =>$_GET['id']));
    }
    if ($_GET['action'] == "edit") {
        //$item = ItemMapper::getItem($_GET['id']);
        $item = RestClientItems::call("GET", array('id'=>$_GET['id']));
        $jitem = json_decode($item);
        $ei = new Item();
        $ei->setItemID($jitem->ItemID);
        $ei->setItemDesc($jitem->itemDesc);
        $ei->setItemName($jitem->itemName);
        $ei->setItemPrice($jitem->itemPrice);
        $ei->setItemAvail($jitem->itemAvail);
        Page::showEditItemForm($ei);
    }
    if ($_GET['action'] == "addItem") {
        Page::showAddItemForm();
    }
    if ($_GET['action'] == "add") {

        $item = RestClientItems::call("GET", array('id'=>$_GET['id']));
        $jitem = json_decode($item);
        $ei = new Item();
        $ei->setItemID($jitem->ItemID);
        $ei->setItemDesc($jitem->itemDesc);
        $ei->setItemName($jitem->itemName);
        $ei->setItemPrice($jitem->itemPrice);
        $ei->setItemAvail($jitem->itemAvail);
        $no = new Order();
        $no->setCustomerID($_SESSION['loggedin']->getCustomerID());
        $no->setAmount($ei->getItemPrice());
        $no->setDate(date("Y-m-d"));
        $orderID = OrderMapper::createOrder($no);

        $oi = new OrdersItems();
        $oi->setOrdersID($orderID);
        $oi->setItemName($ei->getItemName());
        $oi->setItemID($_GET['id']);
        $oi->setItemQty(1);
        OrdersItemsMapper::createOrderItems($oi);
        echo "Item has been added to the order.";
    }
}
Page::welcome();
Page::listItems($items);
Page::footer();
?>