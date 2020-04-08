<?php

// Start Session
require __DIR__ . '/lib/applib.php';
session_start();
$sesid=session_id();
$app = new ShopingCart();


if(isset($_POST['add_to_cart']))
{
    $app->addToCart($_POST['product_id'],$_POST['itemqty']);
}

if (isset($_GET['id_to_remove']) && isset($_GET['id_to_remove']) != '') 
{
    $app->removeProductFromCart($_GET['id_to_remove']);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>My Cart</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
    
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light" style="background-color: #e3f2fd;">
                

                
         <div class="collapse navbar-collapse" id="navbarSupportedContent" style="float:right;">
                <ul class="navbar-nav mr-auto">
                  <li class="nav-item active">
                    <a class="nav-link" href="#">Store <span class="sr-only">(current)</span></a>
                  </li>              
                </ul>

            </div>  
         <a class="navbar-brand" href="cart.php"><span>Balance $</span><?php echo $app->getTot($sesid); ?><input type="hidden" name="userbal" id="userbal" value="<?php echo $app->getTot($sesid); ?>"></a>
          <a class="navbar-brand" href="cart.php"><img src="image/cart.png" width="30" height="30" class="d-inline-block align-top" alt="">
    View Cart</a>
          <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">Products</a>
                    </li>
                     
                    </ul>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
        </nav>

    <div class="container" id="shoplist">
       <div class="card">
           <form enctype="multipart/form-data" id="cart-form" action="update.php" method="post">
            <h5 class="card-header">My Cart</h5>
              <div class="card-body">

                <?php
                    if(isset($_SESSION['shopping_cart']) && count($_SESSION['shopping_cart']) > 0)
                    {
                        $products = $_SESSION['shopping_cart'];
                       

                        echo '
                                <table id="cart-table" class="table table-bordered">
                                <thead>
                                    <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Item</th>
                                    <th scope="col">Quantity</th>
                                    <th scope="col">Unit Price</th>
                                    <th scope="col" width="100">Action</th>
                                    </tr>
                                </thead>';

                                $item_number = 1; 
                                $item_to_remove = 0; 
                                $item_to_update = 0;
                                $total = 0;
                                foreach ($products as $product) {
                                echo '
                                <tbody>
                                    <tr>
                                    <th scope="row" id="itmno">'. $item_number .'</th>
                                    <td>' . $product['name'] . '</td>
                                    <td><input class="form-control" type="number" name="itemquantity" id="itemquantity" min="1" value="'.$product['quantity'].'" /><input type="hidden" name="itemtoupdate" id="itemtoupdate" value="'.$item_to_update.'" /></td>
                                    <td>$ '. $product['price']. '</td>
                                    <td>
                                        <a href="cart.php?id_to_remove=' . $item_to_remove . '" class="text-danger">Remove</a>
                                        <a href="#" class="btn btn-primary" id="updatecart">Update Cart</a>                                      
                                    </td>
                                    </tr>                                    
                                </tbody>
                             ';
                               
                               //$total += ($product['price'] * $product['quantity']);
                                $total += ($product['price'] * $product['quantity']);
                                $_SESSION['total']=$total;
                                $item_number++;
                                $item_to_remove++; 
                                $item_to_update++;
                            
                        }

                        echo '
                                <tr>
                                    <th colspan="4" align="right">
                                       Sub Total:
                                    </th>
                                    <td><input type="hidden" name="tot" id="tot" value="'. $_SESSION['total'] .'" /><input type="hidden" name="sesid" value="'. session_id() .'" />
                                        $ '. $_SESSION['total'] .'
                                    </td>
                                </tr>
                                <tr>
                                    <th colspan="2" align="right">
                                        Pick-Up Type:
                                    </th>
                                    <td colspan="2">
                                        <select name="picktype" id="picktype" class="form-control">
                                            <option value="">Select Transport Type</option>
                                            <option value="0">Pick-Up</option>
                                            <option value="5">UPS</option>
                                        </select>
                                    </td>
                                    <td colspan="1" align="">
                                    $<input type="text" value="" id="pickup" name="pickup" disabled style="background-color:#fff;border:none; width:50px;">
                                    </td>
                                </tr>
                                <tr>
                                    <th colspan="4" align="right">
                                        Total:
                                    </th>
                                    <td><input type="hidden" name="" id="" value="'. $_SESSION['total'] .'" /><input type="hidden" name="sesid" value="'. session_id() .'" />
                                        $ <input type="text" name="showtot" value="" id="showtot" disabled style="background-color:#fff;border:none;width:50px;">                                        
                                    </td>
                                </tr>
                                
                                </table>';
                                
                      
                    }
                    else {
                        echo '<div class="alert alert-primary" role="alert">
                              Shopping cart is empty, visit <a href="index.php" class="alert-link">products</a> page to add product into shopping cart.
                            </div>';
                         }
                ?>
                
            </div>
           
                 <div class="card-footer">                 
                     <button class="btn btn-primary float-right" type="button" id="pay">Make Payment</button>
                </div>
            </form>
        </div>

    </div>    

    <script src="jquery-1.11.2.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
    
    <script>
        $(document).on('click','#pay',function(e){  
            shiptype=$('#picktype').val();
            carttotal=parseFloat($('#showtot').val());
            userbal=parseFloat($('#userbal').val());
            //alert(userbal);
            if(userbal<=0 || userbal<=carttotal)
            {
                alert('You do not have enough balance to purchase this items');    
            }
            else
            {
                if(shiptype=='')
                {
                    alert('Transport Type Missing, Please Select An Option From The Drop Down');
                }
                else
                {
                    var $this = $(this);
                    var loadingText = '<i class="fa fa-circle-o-notch fa-spin"></i> Processing Payment...';
                    if ($(this).html() !== loadingText) {
                      $this.data('original-text', $(this).html());
                    $this.html(loadingText);}
                    var formData = new FormData($('#cart-form')[0]);             
                    $.ajax({
                  url: "makepay.php", 
                  type: "POST",             
                  data: formData, 
                  contentType: false,       
                  cache: false,   
                  dataType: "JSON",          
                  processData:false, 
                  success: function(responsedata)   
                  { 
                    if(responsedata.status=='success')
                    {
                     alert('Cart Paid');
                         setTimeout(function() {
                      $this.html($this.data('original-text'));
                    }, 200);
                        window.location.href='cart.php'
                    //$('#balrow').show();
                    }
                  },
                 error:function(responsendata)
                 {
                     alert('An Error Just Occured');
                     setTimeout(function() {
                      $this.html($this.data('original-text'));
                    }, 200);
                 }
                 });
                        return false;
                }
            }
            
        });
        
        $(document).on('change', '#picktype', function(ev)
        {
            let shipping='';
            let tfair=$(this).val();
            let tot=parseFloat($('#tot').val());
            if(tfair==='0')
            {
                shipping=0;
            }
            else if(tfair==='5')
            {
                shipping=5;
            }
            $('#pickup').val(shipping);
            $('#showtot').val(shipping+tot);
            
        });
        $(document).ready(function(){

            // code to read selected table row cell data (values).
            $("#cart-table").on('click','#updatecart',function(){
                 // get the current row
                 let currentRow=$(this).closest("tr");

                 let col1=currentRow.find("td:eq(0)").text(); // get current row 1st TD value
                 let col2=currentRow.find("td:eq(1)").text(); // get current row 2nd TD
                 let col3=currentRow.find('#itemquantity').val(); // get current row 3rd TD
                 let col4=currentRow.find('#itemtoupdate').val();
                // let data=col1+"\n"+col2+"\n"+col3+"\n"+col4;

                 //alert(data);
                // location.href='update.php?itemquantity='+col3+'&itemtoupdate='+col4;
                if(col3==0 || col3=='')
                {
                     alert('Quantity cant be less than 1');
                     currentRow.find('#itemquantity').val(1)    ;
                }
                else
                {
                     var formData = 'itemquantity='+col3+'&itemtoupdate='+col4;             
                     $.ajax({
                      url: "update.php", 
                      type: "POST",             
                      data: formData, 
                      dataType: "html",
                      success: function(responsedata)   
                      { 
                          alert(responsedata);
                          window.location.href='cart.php';
                        if(responsedata==='done')
                        {
                         alert('Item Updated');


                        }
                      },
                     error:function(responsendata)
                     {
                         alert('An Error Just Occured');
                         setTimeout(function() {
                          $this.html($this.data('original-text'));
                        }, 200);
                     }
                     });
                            return false;   
                }
                  
            });
         });
         $(document).ready(function() {			           
            //attach keypress to input
            $('[id*=itemquantity]').keydown(function(event) {
                // Allow special chars + arrows 
                if (event.keyCode == 46 || event.keyCode == 8 || event.keyCode == 9 
                    || event.keyCode == 27 || event.keyCode == 13 
                    || (event.keyCode == 65 && event.ctrlKey === true) 
                    || (event.keyCode >= 35 && event.keyCode <= 39)){
                        return;
                }else {
                    // If it's not a number stop the keypress
                    if (event.shiftKey || (event.keyCode < 48 || event.keyCode > 57) && (event.keyCode < 96 || event.keyCode > 105 )) {
                        event.preventDefault(); 
                    }   
                }
				
            });
			
			
        });
    </script>
</body>
</html>