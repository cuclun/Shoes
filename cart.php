<?php
   include 'include/header.php';
   // include 'include/slider.php';
 ?>
<?php
   if (isset($_GET['catid'])){
	$catid = $_GET['catid'];
	$delcat = $ct->del_product_cart($catid);
}
   if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
     $catId = $_POST['catId'];
     $quantity = $_POST['quantity'];
     $update_quantity_cart= $ct->update_quantity_cart($quantity, $catId);
	 if($quantity<=0){
		$delcat = $ct->del_product_cart($catId);
	 }
  }
  ?>
    <div class="main">
    <div class="content">
    	<div class="cartoption">		
			<div class="cartpage">
			    	<h2>Giỏ hàng:</h2>
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
								<th width="20%">Tên sản phẩm</th>
								<th width="10%">Hình ảnh</th>
								<th width="15%">Giá</th>
								<th width="25%">Số lượng</th>
								<th width="20%">Tổng giá</th>
								<th width="10%">Tình trạng</th>
							</tr>
							<?php 
							 $get_product_cart = $ct->get_product_cart();
							 if($get_product_cart){
								$subtotal = 0;
								$qty = 0;
								while($result = $get_product_cart->fetch_assoc()){
							 ?>
							<tr>
								<td><?php echo $result['productName']?></td>
								<td><img src="admin/uploads/<?php echo $result['image']?>" alt=""/></td>
								<td><?php echo $fm->format_currency($result['price'])." "."VND"?></td>
								<td>
									<form action="" method="post">
										<input type="hidden" name="catId" value="<?php echo $result['catId'] ?>"/>
										<input type="number" name="quantity" min =	"0" value="<?php echo $result['quantity'] ?>"/>
										<input type="submit" name="submit" value="Update"/>
									</form>
								</td>
								<td><?php    
								 $total = $result['price'] * $result['quantity'];
								 echo $fm->format_currency($total)." "."VND";	
								?></td>
								<td><a onclick ="return confirm('Bạn muốn xóa sản phẩm này');"href="?catid=<?php echo $result['catId'] ?>">Xóa</a></td>
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
						<table style="float:right;text-align:left;" width="40%">
							<tr>
								<th>Tổng tất cả : </th>
								<td><?php 		
								 echo $fm->format_currency($subtotal)." "."VND";
                                 Session::set('sum',$subtotal);
								?></td>
							</tr>
							<tr>
								<th>Thuế: </th>
								<td>10%</td>
							</tr>
							<tr>
								<th>Tổng cộng :</th>
								<td><?php
								 $vat = $subtotal * 0.1;
								 $gtotal = $subtotal + $vat;
								 echo $fm->format_currency($gtotal)." "."VND";
								?></td>
							</tr>
					   </table>
						<?php
       				}else{
						   echo 'Giỏ hàng của bạn đang trống ! ';	
					   }
						?>

					</div>
					<div class="shopping">
						<div class="shopleft">
							<a href="index.php"> <img src="images/shop.png" alt="" /></a>
						</div>
						<div class="shopright">
							<a href="payment.php"> <img src="images/check.png" alt="" /></a>
						</div>
					</div>
    	</div>  	
       <div class="clear"></div>
    </div>
 </div>

 <?php
   include 'include/footer.php';
 ?>


