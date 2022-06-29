<?php
   include 'include/header.php';
  // include 'include/slider.php';
 ?>
<?php
  if(isset($_GET['orderid']) && $_GET['orderid']=='order'){
        $customer_id = Session::get('customer_id');
        $insertOrder = $ct-> insertOrder($customer_id);
        $delCart = $ct->del_all_data_cart();
        header('Location:success.php');	
  }

  /*  $id = $_GET['proid'];
   if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
    $quantity = $_POST['quantity'];
	$AddtoCart= $ct->add_to_cart($quantity, $id);
} */
?>
<style type ="text/css">
    .box_left{
        width: 50%;
        border: 1px solid #666;
        float: left;
        padding: 4px;
    }
    .box_right{
        width: 47%;
        border: 1px solid #666;
        float: right;
        padding: 4px;
    }
    a.a_order{
        background: green;
        padding: 7px solid #666;
        color: #fff;
        font-size: 21px;
        
    }
</style>
<form action ="" method="POST">
 <div class="main">
    <div class="content">
    	<div class="section group">
             <div class="heading">
                <h3>Thanh toán Offline</h3>
            </div>
            <div class="clear"></div>
            <div class="box_left">
            <div class="cartpage">
			    	
					<?php
                      if(isset($update_quantity_cart)){
						  echo $update_quantity_cart;
					  }
					?>
					<?php
                      if(isset($delcat)){
						  echo $delcat;
					  }

					?>
						<table class="tblone">
							<tr>
                                <th width="5%">ID</th>
								<th width="15%">Tên sản phẩm</th>
								
								<th width="15%">Giá</th>
								<th width="25%">Số lượng</th>
								<th width="20%">Tổng giá</th>
							
							</tr>
							<?php 
							 $get_product_cart = $ct->get_product_cart();
							 if($get_product_cart){
								$subtotal = 0;
								$qty = 0;
                                $i = 0;
								while($result = $get_product_cart->fetch_assoc()){
                                    $i++;
							 ?>
							<tr>
                                <td><?php echo $i; ?></td>
								<td><?php echo $result['productName']?></td>
							
								<td><?php echo $result['price'].' '.'VND'?></td>
								<td>
									<form action="" method="post">									
                                        <?php echo $result['quantity']?></td>
									</form>
								</td>
								<td><?php    
								 $total = $result['price'] * $result['quantity'];
								 echo  $fm->format_currency($total) .' '.'VND';	
								?></td>
							
							</tr>
						   <?php
						   	 $subtotal += $total;	
								}
							}
						   ?>			
						</table>
						<?php
							$check_cart = $ct->check_cart();
							if($check_cart){
						?>
						<table style="float:right;text-align:left;margin:5px" width="40%">
							<tr>
								<th>Tổng tất cả : </th>
								<td><?php 		
								 echo $fm->format_currency($subtotal).' '.'VND';	
                                 Session::set('sum',$subtotal);
								?></td>
							</tr>
							<tr>
								<th>Thuế: </th>
								<td>10% </td>
							</tr>
							<tr>
								<th>Tổng cộng :</th>
								<td><?php
								 $vat = $subtotal * 0.1;
								 $gtotal = $subtotal + $vat;
								 echo $fm->format_currency($gtotal).' '.'VND';
								?></td>
							</tr>
                          
					   </table>
						<?php
       				}else{
						   echo 'Giỏ hàng của bạn đang trống ! Hãy mua hàng nhé.';	
					   }
						?>

					</div>
            </div>
            <div class="box_right">
            <table class ="tblone">
           <?php
           $id = Session::get('cmrId');
           $get_customers = $cs->show_customers($id);
           if ($get_customers){
               while($result = $get_customers->fetch_assoc()){
           ?>
           
           <tr>
               <td>Name</td>
               <td>:</td>
               <td><?php echo $result ['name']?></td>
           </tr>
           <tr>
               <td>City</td>
               <td>:</td>
               <td><?php echo $result ['city']?></td>
           </tr>
           <tr>
               <td>Phone</td>
               <td>:</td>
               <td><?php echo $result ['phone']?></td>
           </tr>
           <tr>
               <td>Zipcode</td>
               <td>:</td>
               <td><?php echo $result ['zipcode']?></td>
           </tr>
           <tr>
               <td>Email</td>
               <td>:</td>
               <td><?php echo $result ['email']?></td>
           </tr>
           <tr>
               <td>Address</td>
               <td>:</td>
               <td><?php echo $result ['address']?></td>
           </tr>
               <td colspan = "3"><a href ="editprofile.php">Update Profile</a></td>
           <?php
            }
        }
           ?>
       </table>
        </div>	
 	 </div>
  </div>
   <center><a href="?orderid=order" class= "a_order ">Đặt hàng</a></center>
</div>
</form>
<?php
   include 'include/footer.php';
 ?>