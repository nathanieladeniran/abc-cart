<?php
session_start();
require __DIR__ . '/lib/applib.php';
$newrate=new rateItem();
$sesid=session_id();
//echo $_POST['rate'];
if (isset($_POST['itemid']) && isset($_POST['itemid']) != '') 
{
    $newrate->insertRate($sesid,$_POST['itemid'],$_POST['rate']);
}
else
{
    echo 'data not posted';
}
        
?>