<?php
session_start();
require __DIR__ . '/lib/applib.php';
$app = new ShopingCart();
//echo $_SESSION['shopping_cart'][$_GET['id_to_update']]['quantity'] 
if (isset($_POST['itemquantity']) && $_POST['itemquantity']!=0) 
{
    $app->updateCart($_POST['itemtoupdate'],$_POST['itemquantity']);
    echo 'Updated';
   // $app->updateCart(2,5);
}
?>
 