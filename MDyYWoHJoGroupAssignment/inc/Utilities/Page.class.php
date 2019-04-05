<?php
class Page  {

    public static $title = "Please set your title!";

    static function header($logoff = null)   { ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>

        <!-- Basic Page Needs
        –––––––––––––––––––––––––––––––––––––––––––––––––– -->
        <meta charset="utf-8">
        <title><?php echo self::$title; ?></title>
        <meta name="description" content="">
        <meta name="author" content="">

        <?php if (!is_null($logoff))  {
                echo '<meta http-equiv="refresh" content="5; url=MDyYWoHJologin.php">';
            } ?>
        <!-- Mobile Specific Metas
        –––––––––––––––––––––––––––––––––––––––––––––––––– -->
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- FONT
        –––––––––––––––––––––––––––––––––––––––––––––––––– -->
        <link href="//fonts.googleapis.com/css?family=Raleway:400,300,600" rel="stylesheet" type="text/css">

        <!-- CSS
        –––––––––––––––––––––––––––––––––––––––––––––––––– -->
        <link rel="stylesheet" href="css/normalize.css">
        <link rel="stylesheet" href="css/skeleton.css">

        <!-- Favicon
        –––––––––––––––––––––––––––––––––––––––––––––––––– -->
        <link rel="icon" type="image/png" href="images/favicon.png">

        </head>
        <body>

        <!-- Primary Page Layout
        –––––––––––––––––––––––––––––––––––––––––––––––––– -->
        <div class="container">
            <div class="row">
            <div class="one-half column" style="margin-top: 25%">
                <h4><?php echo self::$title; ?></h4>
    <?php }

    static function footer()   { ?>
            </div>
            </div>
        </div>

        <!-- End Document
        –––––––––––––––––––––––––––––––––––––––––––––––––– -->
        </body>
        </html>

    <?php }

    static function listItems($itemData)    {
        echo '<table class="u-full-width">
        <thead>
          <tr>
            <th>Name</th>
            <th>Description</th>
            <th>Price</th>
            <th>Availability</th>
          </tr>
        </thead>
        <tbody>';

        foreach ($itemData as $item)    {
            echo '  <tr>
            <td>'.$item->getItemName().'</td>
            <td>'.$item->getItemDesc().'</td>
            <td>'.$item->getItemPrice().'</td>
            <td>'.$item->getItemAvail().'</td>
            <td><A HREF="'.$_SERVER["PHP_SELF"].'?action=delete&id='.$item->getItemID().'
            ">Delete</A></td>
            <td><A HREF="'.$_SERVER["PHP_SELF"].'?action=edit&id='.$item->getItemID().'
            ">Edit</A></td>
            <td><A HREF="'.$_SERVER["PHP_SELF"].'?action=add&id='.$item->getItemID().'
            ">Add to Order</A></td>
            </tr>';
        }
        
        echo '</tbody>
        </table>';

        echo 'Click '.'<A HREF="'.$_SERVER["PHP_SELF"].'?action=addItem">here to Add an Item</A><BR>';
        echo '<A HREF = MDyYWoHJoWelcome.php>Home</A><BR>';
        echo '<A HREF = MDyYWoHJoOrders.php>Orders</A><BR>';
        echo '<A HREF = MDyYWoHJoPayment.php>Payment</A><BR>';

    }

    static function listUsers($userData)    {
        echo '<table class="u-full-width">
        <thead>
          <tr>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Address</th>
            <th>City</th>
            <th>Province</th>
            <th>Country</th>
            <th>Username</th>
            <th>Password</th>
          </tr>
        </thead>
        <tbody>';

        foreach ($userData as $user)    {
            echo '  <tr>
            <td>'.$user->getFirstName().'</td>
            <td>'.$user->getLastName().'</td>
            <td>'.$user->getAddress().'</td>
            <td>'.$user->getCity().'</td>
            <td>'.$user->getProvince().'</td>
            <td>'.$user->getCountry().'</td>
            <td>'.$user->getUsername().'</td>
            <td>'.$user->getPassword().'</td>
            <td><A HREF="'.$_SERVER["PHP_SELF"].'?action=delete&id='.$user->getCustomerID().'
            ">Delete</A></td>
            <td><A HREF="'.$_SERVER["PHP_SELF"].'?action=edit&id='.$user->getCustomerID().'
            ">Edit</A></td>
            </tr>';
        }
        
        echo '</tbody>
        </table>';
  
    }

    static function listPayment($payData)    {

        echo '<table class="u-full-width">
        <thead>
          <tr>
            <th>Payment Type</th>
            <th>Payment Number</th>
          </tr>
        </thead>
        <tbody>';

        foreach ($payData as $pay)    {
            echo '  <tr>
            <td>'.$pay->getPaymentName().'</td>
            <td>'.$pay->getPaymentNumber().'</td>
            <td><A HREF="'.$_SERVER["PHP_SELF"].'?action=delete&id='.$pay->getPaymentID().'
            ">Delete</A></td>
            <td><A HREF="'.$_SERVER["PHP_SELF"].'?action=edit&id='.$pay->getPaymentID().'
            ">Edit</A></td>
            </tr>';
        }
        echo '<A HREF="'.$_SERVER["PHP_SELF"].'?action=add">Add</A>';
        echo '</tbody>
        </table>';
        echo '<A HREF = MDyYWoHJoWelcome.php>Home</A><BR>';
        echo '<A HREF = MDyYWoHJoOrders.php>Orders</A><BR>';
        echo '<A HREF = MDyYWoHJoPayment.php>Payment</A><BR>';
        echo '<p>Click <A HREF="MDyYWoHJoLogout.php">here to logout</A>.</p>';
    }

    static function listOrdersItems($orderItemData)    {

        echo '<table class="u-full-width">
        <thead>
          <tr>
            <th>Order ID</th>
            <th>Item ID</th>
            <th>Quantity</th>
          </tr>
        </thead>
        <tbody>';

        foreach ($orderItemData as $order)    {
            echo '  <tr>
            <td>'.$order->getOrdersID().'</td>
            <td>'.$order->getItemID().'</td>
            <td>'.$order->getItemQty().'</td>
            <td><A HREF="'.$_SERVER["PHP_SELF"].'?action=delete&itemid='.$order->getItemID().'&orderid='.$order->getOrdersID().'
            ">Delete</A></td>
            <td><A HREF="'.$_SERVER["PHP_SELF"].'?action=edit&itemid='.$order->getItemID().'&orderid='.$order->getOrdersID().'
            ">Edit</A></td>
            </tr>';
        }
        
        echo '</tbody>
        </table>';
  
    }

    static function listOrder($orderData)    {

        echo '<table class="u-full-width">
        <thead>
          <tr>
            <th>Customer ID</th>
            <th>Order ID</th>
            <th>Amount</th>
            <th>Date</th>
          </tr>
        </thead>
        <tbody>';

        foreach ($orderData as $order)    {
            echo '  <tr>
            <td>'.$order->getCustomerID().'</td>
            <td>'.$order->getOrderID().'</td>
            <td>'.$order->getAmount().'</td>
            <td>'.$order->getDate().'</td>
            <td><A HREF="'.$_SERVER["PHP_SELF"].'?action=delete&id='.$order->getOrderID().'
            ">Delete</A></td>
            <td><A HREF="'.$_SERVER["PHP_SELF"].'?action=showItems&id='.$order->getOrderID().'
            ">Show Items</A></td>
            </tr>';
        }

        echo '</tbody>
        </table>';
        echo '<A HREF = MDyYWoHJoWelcome.php>Home</A><BR>';
        echo '<A HREF = MDyYWoHJoOrders.php>Orders</A><BR>';
        echo '<A HREF = MDyYWoHJoPayment.php>Payment</A><BR>';
        echo '<p>Click <A HREF="MDyYWoHJoLogout.php">here to logout</A>.</p>';
    }

    static function showEditOrderItemsForm($orderData)  {  ?>
        <form method="POST" ACTION="<?php echo $_SERVER["PHP_SELF"]; ?>">
        <input type="hidden" name="action" value="editOrderItems">
        <div class="row">
        <!-- private $OrdersID;
    private $CustomerID;
    private $Amt;
    private $Dates; -->

            <div class="eight columns">

            <label for="itemID">Item ID</label>
            <input class="u-full-width" type="text" VALUE="<?php echo $orderData->getItemID();?>" id="itemID" name="itemID">
            
            <label for="itemQty">Item Qty</label>
            <input class="u-full-width" type="text" VALUE="<?php echo $orderData->getItemQty();?>" id="itemQty" name="itemQty">

            <input class="u-full-width" type="hidden" VALUE="<?php echo $orderData->getOrdersID();?>" id="orderID" name="orderID">
            <input class="button-primary" type="submit" value="Submit">
            </div> <?php
    }
    
    static function showAddOrderForm()   { ?>

        <form method="POST" ACTION="<?php echo $_SERVER["PHP_SELF"]; ?>">
        <input type="hidden" name="action" value="addOrder">
        <div class="row">


            <div class="eight columns">
            <label for="customerID">Customer ID</label>
            <input class="u-full-width" type="text" placeholder="1, 2, 3" id="customerID" name="customerID">
            
            <label for="amount">Amount</label>
            <input class="u-full-width" type="text" placeholder="Order Dollar Amount" id="amount" name="amount">

            <label for="date">Date</label>
            <input class="u-full-width" type="text" placeholder="Order Date" id="date" name="date">

            <input class="button-primary" type="submit" value="Submit">
            </div>
          

        </div>
        
        </form>

        

    <?php }


    static function showAddItemForm()   { ?>

        <form method="POST" ACTION="<?php echo $_SERVER["PHP_SELF"]; ?>">
        <input type="hidden" name="action" value="addItem">
        <div class="row">


            <div class="eight columns">
            <label for="Name">Name</label>
            <input class="u-full-width" type="text" placeholder="Item Name" id="name" name="name">
            
            <label for="desc">Description</label>
            <input class="u-full-width" type="text" placeholder="Item Description" id="desc" name="desc">

            <label for="title">Price</label>
            <input class="u-full-width" type="text" placeholder="Item Price" id="price" name="price">
 
            <label for="title">Availability</label>
            <input class="u-full-width" type="text" placeholder="Item Availability" id="avail" name="avail">
  
            <input class="button-primary" type="submit" value="Submit">
            </div>
          

        </div>
        
        </form>

        

    <?php }

static function showEditItemForm($itemData)   { ?>

    <form method="POST" ACTION="<?php echo $_SERVER["PHP_SELF"]; ?>">
    <input type="hidden" name="action" value="editItem">
    <div class="row">


        <div class="eight columns">
        <label for="Name">Name</label>
        <input class="u-full-width" type="text" VALUE="<?php echo $itemData->getItemName();?>" id="name" name="name">
        
        <label for="desc">Description</label>
        <input class="u-full-width" type="text" VALUE="<?php echo $itemData->getItemDesc();?>" id="desc" name="desc">

        <label for="title">Price</label>
        <input class="u-full-width" type="text" VALUE="<?php echo $itemData->getItemPrice();?>" id="price" name="price">

        <label for="title">Availability</label>
        <input class="u-full-width" type="text" VALUE="<?php echo $itemData->getItemAvail();?>" id="avail" name="avail">
        <input class="u-full-width" type="hidden" VALUE="<?php echo $itemData->getItemID();?>" id="itemID" name="itemID">
        <input class="button-primary" type="submit" value="Submit">
        </div>
      

    </div>
    
    </form>

    

<?php }

static function showAddUserForm()   { ?>

    <form method="POST" ACTION="<?php echo $_SERVER["PHP_SELF"]; ?>">
    <input type="hidden" name="action" value="add">
    <div class="row">
    <!-- private $CustomerID;
    private $FirstName;
    private $LastName;
    private $Address;
    private $City;
    private $Province;
    private $Country;
    private $Username;
    private $Password; -->
        <div class="eight columns">
        <label for="FirstName">First Name</label>
        <input class="u-full-width" type="text" placeholder="First Name" id="FirstName" name="FirstName">
        
        <label for="LastName">Last Name</label>
        <input class="u-full-width" type="text" placeholder="Last Name" id="LastName" name="LastName">

        <label for="Address">Address</label>
        <input class="u-full-width" type="text" placeholder="Address" id="Address" name="Address">

        <label for="City">City</label>
        <input class="u-full-width" type="text" placeholder="City" id="City" name="City">

        <label for="Province">Province</label>
        <input class="u-full-width" type="text" placeholder="Province" id="Province" name="Province">

        <label for="Country">Country</label>
        <input class="u-full-width" type="text" placeholder="Country" id="Country" name="Country">

        <label for="Username">Username</label>
        <input class="u-full-width" type="text" placeholder="Username" id="Username" name="Username">

        <label for="Password">Password</label>
        <input class="u-full-width" type="text" placeholder="Password" id="Password" name="Password">

        <input class="button-primary" type="submit" value="Submit">
        </div>
      

    </div>
    
    </form>

<?php }

static function showAddPaymentForm()   { ?>

    <form method="POST" ACTION="<?php echo $_SERVER["PHP_SELF"]; ?>">
    <input type="hidden" name = "action" value = "add">
    <div class="row">
    <!-- private $PaymentID;
    private $CustomerID;
    private $PaymentName;
    private $PaymentNumber; -->

        <div class="eight columns">

        <label for="Name">Payment</label>
        <input class="u-full-width" type="text" placeholder="Payment Method" id=paymentName name="paymentName">
        
        <label for="desc">Payment Number</label>
        <input class="u-full-width" type="text" placeholder="XXX-XXX-XXX" id="paymentNum" name="paymentNumber">

        <input class="button-primary" type="submit" value="Submit">
        </div>
      

    </div>
    
    </form>

<?php }

static function showEditPaymentForm($payData)   { ?>

    <form method="POST" ACTION="<?php echo $_SERVER["PHP_SELF"]; ?>">
    <input type="hidden" name="action" value="editPayment">
    <div class="row">
    <!-- $ep = new Payment();
            $ep->setPaymentID($_POST["paymentID"]);
            $ep->setCustomerID($_POST["loggedin"]->getCustomerID);
            $ep->setPaymentName($_POST["paymentName"]);
            $ep->setPaymentNumber($_POST["paymentNumber"]);
            PaymentMapper::updatePayment($eo, $_POST['paymentID']); -->

        <div class="eight columns">

        <label for="paymentName">Payment Type</label>
        <input class="u-full-width" type="text" VALUE="<?php echo $payData->getPaymentName();?>" id="paymentName" name="paymentName">
        
        <label for="paymentNumber">Payment Number</label>
        <input class="u-full-width" type="text" VALUE="<?php echo $payData->getPaymentNumber();?>" id="paymentNumber" name="paymentNumber">

        <input class="u-full-width" type="hidden" VALUE="<?php echo $payData->getCustomerID();?>" id="customerID" name="customerID">

        <input class="u-full-width" type="hidden" VALUE="<?php echo $payData->getPaymentID();?>" id="paymentID" name="paymentID">
        <input class="button-primary" type="submit" value="Submit">
        </div>
      

    </div>
    
    </form>

    

<?php }

static function showEditUserForm($userData)   { ?>

    <form method="POST" ACTION="<?php echo $_SERVER["PHP_SELF"]; ?>">
    <input type="hidden" name="action" value="editUser">
    <div class="row">
    <!-- private $CustomerID;
    private $FirstName;
    private $LastName;
    private $Address;
    private $City;
    private $Province;
    private $Country;
    private $Username;
    private $Password; -->
        <div class="eight columns">
        <label for="fName">First Name</label>
        <input class="u-full-width" type="text" VALUE="<?php echo $userData->getFirstName(); ?>" id="FirstName" name="FirstName">
        
        <label for="lName">Last Name</label>
        <input class="u-full-width" type="text" VALUE="<?php echo $userData->getLastName(); ?>" id="LastName" name="LastName">

        <label for="address">Address</label>
        <input class="u-full-width" type="text" VALUE="<?php echo $userData->getAddress(); ?>" id="Address" name="Address">

        <label for="city">City</label>
        <input class="u-full-width" type="text" VALUE="<?php echo $userData->getCity(); ?>" id="City" name="City">

        <label for="province">Province</label>
        <input class="u-full-width" type="text" VALUE="<?php echo $userData->getProvince(); ?>" id="Province" name="Province">

        <label for="country">Country</label>
        <input class="u-full-width" type="text" VALUE="<?php echo $userData->getCountry(); ?>" id="Country" name="Country">

        <label for="username">Username</label>
        <input class="u-full-width" type="text" VALUE="<?php echo $userData->getUsername(); ?>" id="Username" name="Username">

        <label for="password">Password</label>
        <input class="u-full-width" type="text" VALUE="" id="Password" name="Password">

        <input class="u-full-width" type="hidden" VALUE="<?php echo $userData->getCustomerID();?>" id="customerID" name="customerID">
        <input class="button-primary" type="submit" value="Submit">
        </div>
      

    </div>
    
    </form>

<?php }

static function showLogin()    { ?>

    <h4>Please Login</h4>
    <!-- The above form looks like this -->
    <form method="POST" ACTION="<?php echo $_SERVER["PHP_SELF"]; ?>">
        <input type="hidden" name="action" value="login">

        <div class="row">

            <div class="six columns">
            <label for="username">Username</label>
            <input class="u-full-width" type="TEXT" placeholder="Username" id="Username" NAME="Username">
            </div>

            <div class="six columns">
            <label for="name">Password</label>
            <input class="u-full-width" type="PASSWORD" id="Password" NAME="Password">
            </div>            
        </div>
        <input class="button-primary" type="submit" value="Login">
        </form>
        <A HREF="?link=1"> Create User </A>
    <?php }

    //This function takes information from the header and welcomes the user.

    static function welcome()   { 
        $currentUser = $_SESSION["loggedin"];
        ?>

        <p>Hello <?php echo $currentUser->getFirstName(); ?>, <?php echo $currentUser->getLastName(); ?>.</p>
        <p>Click the button below to change the information on your account.</p>
        <form method="POST" ACTION="<?php echo $_SERVER["PHP_SELF"]; ?>">
            <input type="submit" NAME="edituser" value="edit">
        </form>

        <p>Click <A HREF="MDyYWoHJoLogout.php">here to logout</A>.</p>

    <?php }

    static function goodBye()  { ?>

       <p>Thanks for stopping by.</p>

    <?php   }
}


