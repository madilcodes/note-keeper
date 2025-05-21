<?php
include 'dbconnection.php';

if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}

$name = $_POST['name'];
$email = $_POST['email'];
$coffeeType = $_POST['coffeeType'];
$coffeePrice = getCoffeePrice($coffeeType);
$size = $_POST['size'];
$sugar = $_POST['sugar'];
$quantity = $_POST['quantity'];
 $sql = "INSERT INTO coffee_orders (coffee_type, price,size,sugar,Customer_name,email,quantity) VALUES ('$coffeeType', '$coffeePrice','$size','$sugar','$name','$email','$quantity')";

if ($con->query($sql) === TRUE) {
    echo "<div class='alert alert-warning alert-dismissible fade show' role='alert'>
  <strong>Your Order:- $coffeeType - Price : ₹ $coffeePrice Placed Sucessfully. Thank you Visit Again !</strong> 
  <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
    <span aria-hidden='true'>&times;</span>
  </button>
</div>";


} else {
    echo "Error: " . $sql . "<br>" . $con->error;
}


$con->close();

function getCoffeePrice($coffeeType)
{

    switch ($coffeeType) {
        case 'espresso':
            return 116;
        case 'latte':
            return 126;
        case 'cappuccino':
            return 350;
        case 'milk':
            return 142;
        case 'Classic Filter Coffee':
            return 163;
        case 'Macchiato':
            return 147;
        case 'Cafe Americano':
            return 186;
        case 'Toffee Cappuccino':
            return 144;
        case 'Vanilla Cappuccino':
            return 150;
        case 'Toffee Latte':
            return 178;
        case 'Devils Own Vanilla Cream':
            return 183;
        case 'Ethiopian Coffee':
            return 172;
        case 'Kadak Chai':
            return 79;
        case 'Green Tea':
            return 125;
        case 'Darjeeling Tea':
            return 144;
        case 'Masala Chai':
            return 155;
        case 'Tropical Iceberg':
            return 161;
        case 'Cold Toffee Coffee':
            return 172;
        case 'Cold Cafe Mocha':
            return 149;
        case 'Cold Coconut Milk Latte':
            return 161;
        case 'Cold Cocoa Latte':
            return 155;
        case 'Hot Gourmet Cocoa Cream':
            return 147;
        default:
            return 0.00;
    }
}
?>