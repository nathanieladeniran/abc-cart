<?php    
    session_start();
    class ItemSelect
    {
        public function showItem($table)
        {
            require_once('req/config.php');
            $this->table=$table;
            $selecquery = "SELECT * FROM $this->table ORDER by item_id ASC ";
            $result = $konet->query($selecquery);
            while ($row = $result->fetch_assoc())
            {
               // echo $row['item_name'];
               echo '
                            <div class="col-md-3">
                               <div class="cardsect" align="center">
                               <form method="post" enctype="" action="process/cartprocess.php">
                                  <img class="card-img-top" src="'.$row['item_image'].'" alt="product image" height="230px">
                                  <div class="card-body">
                                    <h5 class="card-title">'.$row['item_name'].'</h5>
                                    <p class="card-text">'.$row['item_description'].'</p>
                                    <div class="form-group mx-sm-3 mb-2">
                                        <input type="hidden" name="itemname" id="itemname" value="'.$row['item_name'].'">
                                        <input type="hidden" name="itemid" id="itemid" value="'.$row['item_id'].'">
                                        <input type="hidden" name="itemprice" id="itemprice" value="'.$row['item_price'].'">
                                        <input type="text" name="itemid" id="itemid" value="'.$row['item_id'].'">
                                        <input type="hidden" name="action" id="action" value="add">
                                        <input type="number" class="qtytxt" name="itemqty" id="itemqty" min="1" value="1">
                                        <input type="submit" name="add_to_cart"" class="btn btn-success" value="Add To Cart" />
 
                                    </div>
                                  </form>  
                                  </div>
                                </div>
                        </div>';

            }    
        }
    }
?>