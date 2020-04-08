<?php

// load database connection script
require_once ('req/config.php');

class ShopingCart
{
    protected $db;

    function __construct()
    {
        $this->db = DB();
    }

    /*get item list */
    public function getProducts($table)
    {
        $this->table=$table;
        $query = "SELECT *  FROM $this->table";
        if (!$result = mysqli_query($this->db, $query)) {
            exit(mysqli_error($this->db));
        }
        
        $data = [];
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $data[] = $row;
            }
        }

        return $data;
    }
    public function getProductDetails($id,$itemqty)
    {
        $id = mysqli_real_escape_string($this->db, $id);
        $query = "SELECT *  FROM item_tab WHERE item_id = '$id'";
        if (!$result = mysqli_query($this->db, $query)) {
            exit(mysqli_error($this->db));
        }
        $data = [];
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $data['id'] = $row['item_id'];
                $data['name'] = $row['item_name'];
                $data['price'] = $row['item_price'];
               // $data['quantity'] = 1;
                $data['quantity'] = $itemqty;
            }
        }
 
        return $data;
    }
 
    /* Add to cart*/
    public function addToCart($id,$itemqty)
    {
        $this->itemqty=$itemqty;
        $product = $this->getProductDetails($id,$this->itemqty);
 
        $isFound = false;
        $i = 0;
        
        if (!isset($_SESSION['shopping_cart']) || count($_SESSION['shopping_cart']) < 1)
        {
            $_SESSION['shopping_cart'] = array(0 => $product);
        } else {
 
            foreach ($_SESSION['shopping_cart'] as $item) {
                $i++;
                foreach ($item as $key => $value) {
                    if ($key == "id" && $value == $id) {
                        array_splice($_SESSION['shopping_cart'], $i - 1, 1, array([
                            'id' => $item['id'],
                            'name' => $item['name'],
                            'price' => $item['price'],
                            //'quantity' => $item['quantity'] + 1,
                            'quantity' => $item['quantity'] + $this->itemqty,
                        ]));
                        $isFound = true;
                    }
                }
 
            }
            if ($isFound == false) {
                array_push($_SESSION['shopping_cart'], $product);
            }
        }	
        
    }
    public function saveTotal($sesis,$tot,$shipamount)
    {
        $sesid =  mysqli_real_escape_string($this->db, $_POST['sesid']);
        $tot = mysqli_real_escape_string($this->db, $_POST['tot']);
        $shipamount = mysqli_real_escape_string($this->db, $_POST['picktype']);
        $tot=$tot+$shipamount;
        $sl="INSERT INTO bal_tab (ses_id,total) VALUE('$sesid','$tot')";
            $resl = mysqli_query($this->db, $sl);
            if($resl===TRUE)
            {
                $response['status'] = 'success';  
                $response['message'] = 'Balance Updated';  
                header('Content-type: application/json'); 						
                echo json_encode($response);
                unset($_SESSION['shopping_cart']);
            }else
            {
                die(mysqli_error($konet));
            }
    }
    public function getTot($sesid)
    {
        $query = "SELECT SUM(total) as total  FROM bal_tab WHERE ses_id = '$sesid'";
        if (!$result = mysqli_query($this->db, $query)) {
            exit(mysqli_error($this->db));
        }
        //$data = [];
        if (mysqli_num_rows($result) > 0)
        {
            while ($row = mysqli_fetch_assoc($result)) 
            {
                
               $_SESSION['total'] = $row['total'];
                echo (100-$_SESSION['total']);
                
            }
            
        }
        else
        {
            echo $_SESSION['total']=100;
        }
 
        
    }
    /*Rating*/
    public function rateAve($sesis,$rate,$itemid)
    {
        $sesid =  mysqli_real_escape_string($this->db, $_POST['sesid']);
        $rate = mysqli_real_escape_string($this->db, $_POST['rate']);
        $itemid = mysqli_real_escape_string($this->db, $_POST['itemid']);
        $sl="INSERT INTO rating (ses_id,item_id,item_rating) VALUE('$sesid','$itemid','$rate')";
            $resl = mysqli_query($this->db, $sl);
            if($resl===TRUE)
            {
                $response['status'] = 'success';  
                $response['message'] = 'Rated';  
                header('Content-type: application/json'); 							
                echo json_encode($response);
            }else
            {
                die(mysqli_error($konet));
            }
    }
 
    /* remove existing product from the cart*/
    public function removeProductFromCart($id)
    {           
        if((count($_SESSION['shopping_cart']) == 1)) 
        {
            unset($_SESSION['shopping_cart']);
        }
        else
        {
           unset($_SESSION['shopping_cart'][$id]);
        }
    }
    /*Clear cart after payment*/
    public function clearCart()
    {
        unset($_SESSION['shopping_cart']);
    }
    /*Update Cart*/
    public function updateCart($id,$itemqty)
    {
       $i=0;
         $this->itemqty=$itemqty;
       // echo $id;
        $_SESSION['shopping_cart'][$id]['quantity']=$this->itemqty;
        //echo 'done';
      
    }
    
    
    /*Show Each Product Rate*/
   
    public function showRate($table,$itemid)
    {
        $this->table=$table;
        $this->itemid=$itemid;
        $query = "SELECT *  FROM $this->table WHERE item_id='.$this->itemid.'";
        if (!$result = mysqli_query($this->db, $query)) {
            exit(mysqli_error($this->db));
        }
        
        $data = [];
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $data[] = $row;
            }
        }

        return $data;
    }
}
class rateItem
{
    protected $db;

    function __construct()
    {
        $this->db = DB();
    }
    public function insertRate($sesid,$itemid,$rate)
    {
        $this->sesid=$sesid;
        $this->itemid=$itemid;
        $this->rate=$rate;
        $checkuser="SELECT ses_id,item_id FROM rating WHERE ses_id='$this->sesid' AND item_id='$this->itemid'";
        $checkresult=mysqli_query($this->db, $checkuser);
        if(mysqli_num_rows($checkresult)>0)
        {
            echo 'You have rated this product before';
        }
        else
        {
            // $ratequery="INSERT INTO rating (ses_id,item_id,item_rating) VALUES('e9s4c76q9imjmmlu3le0d5vfq4','1','5')";
        $ratequery="INSERT INTO rating (ses_id,item_id,item_rating) VALUES('$this->sesid','$this->itemid','$this->rate')";
        $resl = mysqli_query($this->db, $ratequery);
        if($resl===TRUE)
        {
                   /* $response['status'] = 'success';  
                    $response['message'] = 'Rated';  
                    header('Content-type: application/json'); 							
                    echo json_encode($response);*/                    
                    $sl="SELECT SUM(item_rating) AS rate, COUNT(item_rating) AS count FROM rating WHERE item_id='$this->itemid'";
                   // $sl="SELECT SUM(item_rating) AS rate, COUNT(item_rating) AS count FROM rating WHERE item_id=1 AND ses_id='e9s4c76q9imjmmlu3le0d5vfq4'";
                    $selresl = mysqli_query($this->db, $sl);
                    if($selresl)
                    {
                        while($rows=mysqli_fetch_assoc($selresl))
                        {
                            //echo $rows['rate'];
                            //echo $rows['count'];
                            $avg=($rows['rate']/(5*$rows['count']))*5;
                            $updaterate="UPDATE item_tab SET rate_avg='$avg' WHERE item_id='$this->itemid'";
                            $updateresult = mysqli_query($this->db, $updaterate);
                            if($updateresult===TRUE)
                            {
                                       
                                        echo 'rated';
                            }else
                            {
                                    die(mysqli_error($this->db));
                            }

                        }
                    }

        }
        else
        {
                die(mysqli_error($this->db));
        }
        }
      
    }
    


}

?>