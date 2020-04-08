<?php
session_start();
require __DIR__ . '/lib/applib.php';
$app = new ShopingCart();

$add = $app->rateAve($_POST['sesid'],$_POST['tot'],$_POST['itemid']);
?>