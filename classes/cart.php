<?php
$filepath = realpath(dirname(__FILE__));
include_once ($filepath.'/../lib/database.php');
include_once ($filepath.'/../helpers/format.php');
?>

  
<?php

   class cart
   {
    private $db;
    private $fm;
    
    public function __construct()
    {
       $this->db = new Database();
       $this->fm = new Format();
    }
   
    public function dem() 
    { 
       $result = $this->db->select('select sum_cart()');
      //  foreach ($result->fetchAll() as $item) {
      //     return $item['sum_cart()'];
      //  }
      return $result;
    }

    public function add_to_cart($quantity, $id){
      $quantity = $this->fm->validation($quantity);
      $quantity = mysqli_real_escape_string($this->db->link, $quantity);
      $Id      = mysqli_real_escape_string($this->db->link, $id);
      $sId = session_id();

      $query = "SELECT * FROM tbl_product WHERE productId = '$id'";
      $result = $this->db->select($query)->fetch_assoc();

      $image = $result["image"];
      $price = $result["price"];
      $productName = $result["productName"];

      $check_cart = "SELECT * FROM tbl_cart WHERE productId = '$id' AND sId = '$sId'";
      $check_cart = $this->db->select($check_cart);
      if($check_cart){
         $alert = "<span>product already added</span>";
         return $alert;
      }else{
      $query_insert = "INSERT INTO tbl_cart(productId,quantity,sId,image,price,productName) VALUES ('$id','$quantity','$sId','$image','$price','$productName')";
      $insert_cart = $this->db->insert($query_insert);

      if($result){
         header('Location:cart.php');
      } else{
         header('Location:404.php');
          }
         }
   }

      public function get_product_cart(){
         $sId = session_id();
         $query = "SELECT * FROM tbl_cart WHERE sId = '$sId'";
         $result = $this->db->select($query);
         return $result;
      }
      public function update_quantity_cart($quantity, $catId){
         $quantity = mysqli_real_escape_string($this->db->link, $quantity);
         $catId    = mysqli_real_escape_string($this->db->link, $catId);
         $query =  "UPDATE tbl_cart SET quantity = '$quantity' WHERE catId = '$catId'";
         $result = $this->db->update($query);
         if( $result){
            $msg = "<span class='success'>Update thành công</span>";
            return $msg;
         }else{
            $msg = "<span class='error'>Update không thành công</span>";
            return $msg;
         }
         }
         public function del_product_cart($catid){
            $catid = mysqli_real_escape_string($this->db->link, $catid);
            $query = "DELETE FROM tbl_cart WHERE catId = '$catid'";
            $result = $this->db->delete($query);
            if( $result){  
               header('Location:cart.php');
            }else{
               $msg = "<span class='error'>Update không thành công</span>";
               return $msg;
            }
      }
         public function check_cart(){
         $sId = session_id();
         $query = "SELECT * FROM tbl_cart WHERE sId = '$sId'";
         $result = $this->db->select($query);
         return $result;
      }
      public function check_order($customer_id){
         $sId = session_id();
         $query = "SELECT * FROM tbl_order WHERE customer_id = '$customer_id'";
         $result = $this->db->select($query);
         return $result;
      }

      public function del_all_data_cart(){
         $sId = session_id();
         $query = "DELETE FROM tbl_cart WHERE sId = '$sId'";
         $result = $this->db->select($query);
         return $result;
      }
     public function insertOrder($customer_id){
         $sId = session_id();
         $query = "SELECT * FROM tbl_cart WHERE sId = '$sId'";
         $result = $this->db->select($query);
         $get_product = $this->db->select($query);
         if($get_product){
            while($result = $get_product->fetch_assoc()){
               $productId = $result['productId'];
               $productName = $result['productName'];
               $quantity = $result['quantity'] ;
               $price = $result['price'] *  $quantity;
               $image = $result['image'];
               $customer_id = $customer_id;
               $query_order = "INSERT INTO tbl_order(productId,productName,quantity,price,image,customer_id) VALUES ('$productId','$productName','$quantity','$price','$image','$customer_id')";
               $insert_order = $this->db->insert($query_order);
            }
         }
     }
     public function getAmountPrice($customer_id){

         $query = "SELECT price FROM tbl_order WHERE customer_id = '$customer_id'";
         $get_price = $this->db->select($query);
         return $get_price;
     }

     public function get_cart_ordered($customer_id){
        // $query = "SELECT * FROM tbl_order WHERE customer_id = '$customer_id'";
        $query = "CALL GetListDataOrder()";
        $get_cart_ordered = $this->db->select($query);
        return $get_cart_ordered;
     }
     public function get_inbox_cart(){
      $query = "SELECT * FROM tbl_order ORDER BY date_order";
      $get_inbox_cart = $this->db->select($query);
      return $get_inbox_cart;
     }
     
     public function shifted($id,$price){
      $id = mysqli_real_escape_string($this->db->link, $id);
    /*   $time = mysqli_real_escape_string($this->db->link,$time); */
      $price = mysqli_real_escape_string($this->db->link, $price);
      $query =  "UPDATE tbl_order SET status = '1' WHERE id = '$id' AND price ='$price'";
         $result = $this->db->update($query);
         if($result){
            $msg = "<span class='success'>Xử lý đơn hàng thành công</span>";
            return $msg;
         }else{
            $msg = "<span class='error'>Xử lý đơn hàng không thành công</span>";
            return $msg;
         }

     }

  
}

 
?>