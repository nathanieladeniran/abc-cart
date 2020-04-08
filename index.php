<?php

require __DIR__ . '/lib/applib.php';
session_start();
$tab='item_tab';
$table='rating';
$sesid=session_id();
$app = new ShopingCart();
$products = $app->getProducts($tab);



?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ABC SHOPPING MALL</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
    <link rel="stylesheet" href="http://netdna.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    
</head>
<body style="margin-top:0;">
     <nav class="navbar navbar-expand-lg navbar-light" style="background-color: #e3f2fd;">
                

                
         <div class="collapse navbar-collapse" id="navbarSupportedContent" style="float:right;">
                <ul class="navbar-nav mr-auto">
                  <li class="nav-item active">
                    <a class="nav-link" href="#">Store <span class="sr-only">(current)</span></a>
                  </li>              
                </ul>

            </div>     
         <a class="navbar-brand" href="cart.php"><span>Balance $</span><?php echo $app->getTot($sesid); ?></a>
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
        <div class="row">            

                <?php
                if(count($products) > 0)
                {
                    foreach ($products as $product) 
                    {
                        echo ' <div class="col-md-3">
                                <div class="card mb-3">
                                    <h5 class="card-header">
                                        '. $product['item_name'] . '
                                    </h5>
                                    <div class="card-body">
                                        <p class="card-text">
                                            ' . $product['item_description'] . '
                                        </p>
                                        <img src="'.$product['item_image'].'" height="150px" />
                                        <h4>Price: $ ' . $product['item_price'] . '</h4>
                                        <div class="float-right">
                                            <form method="post" action="cart.php" class="form-inline">
                                            <input type="hidden" value="' . $product['item_id'] . '" name="product_id">
                                            <input type="number" class="qtytxt" name="itemqty" id="itemqty" min="1" value="1">
                                            <input type="hidden" value="add_to_cart" name="add_to_cart">                                            
                                            <button type="submit" class="btn btn-primary">Add to Cart</button>
                                        </form>
                                        <div class="wrapper" align="center">
                                        <span id="rating_panel">Current Average Rating '.round($product['rate_avg']).'</span>';
                                        $color = '';
                                         $output = '';
                                         $rating=round($product['rate_avg']);
                                         $output .= '
                                         <ul class="list-inline" data-rating="'.$rating.'" title="Average Rating - '.$rating.'">
                                         ';
                                            for($count=1; $count<=5; $count++)
                                             {
                                              if($count <= $rating)
                                              {
                                               $color = 'color:#ffcc00;';
                                                  
                                              }
                                              else
                                              {
                                               $color = 'color:#ccc;';
                                                  
                                              }
                                              $output .= '<li title="'.$count.'" id="'.$product['item_id'].'-'.$count.'" data-index="'.$count.'"  data-item_id="'.$product['item_id'].'" data-rating="'.$rating.'" class="rating" style="cursor:pointer; '.$color.' font-size:16px; display:inline-block;">&#9733;</li>';
                                             }
                                             $output .= '
                                             </ul>';echo $output;
                                       echo ' </div>
                                        </div>    
                                         
                                   </div>                                    
                                  </div>
                                </div> ';
                                    
                    }
                }
                ?>
            </div>
        </div>


    <script src="jquery-1.11.2.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function(){
         
            $(document).on('click', '.rating', function()
            {
                
              var index = $(this).data("index");
              var item_id = $(this).data('item_id');
                
              $.ajax({
               url:"getrate.php",
               method:"POST",
               data:{rate:index, itemid:item_id},                            
               success:function(responsedata)
               {
                   alert(responsedata);
                   location.reload();
               }
              });

            });
        });
    </script>
    
</body>
</html>