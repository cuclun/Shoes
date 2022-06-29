<?php
   include 'include/header.php';
   // include 'include/slider.php';
 ?>
<?php
      $login_check = Session::get('cuslogin');
      if($login_check==false){
         header('Location:login.php');
      }
  ?>
    <div class="main">
    <div class="content">
    	<div class="cartoption">		
			<div class="cartpage">
			    	<h2>Chi tiết đơn hàng</h2>					
						<table class="tblone">
							<tr>
                                <th width="10%">ID</th>
								<th width="20%">Tên sản phẩm</th>
								<th width="10%">Hình ảnh</th>
								<th width="15%">Giá</th>
								<th width="15%">Số lượng</th>
                                <th width="10%">Ngày đặt</th>
						        <th width="10%">Trạng Thái</th>
								<th width="10%">Tình trạng</th>
							</tr>
							<?php 
                            $customer_id = Session::get('customer_id');
							 $get_cart_ordered = $ct->get_cart_ordered($customer_id);
							 if($get_cart_ordered){
                                $i = 0;
								$qty = 0;
								while($result = $get_cart_ordered->fetch_assoc()){
                                 $i++;
							 ?>
							<tr>
                                <td><?php echo $i; ?></td>
								<td><?php echo $result['productName']?></td>
								<td><img src="admin/uploads/<?php echo $result['image']?>" alt=""/></td>
								<td><?php echo $fm->format_currency($result['price']).' '.'VND'?></td>
								<td>											
                                        <?php echo $result['quantity']?>						
								</td>
                                <td><?php echo $fm->formatDate($result['date_order']) ?></td>
							 <td> 
                                <?php
                                        if($result['status']=='0'){
                                            echo 'Đang chờ xác nhận';
                                        }else{
                                            echo 'Đã Xử Lý';
                                        }

                                ?>
                             </td>
                             <?php
                                if($result['status']=='0'){
                             ?>
								<td><?php echo 'N/A'; ?></td>
                            <?php
                                }else{
                            ?>
                            <td><a>Đang giao hàng</a></td>
						   <?php
								}							
						   ?>	
                           </tr>
                           <?php
								}	
                            }   						
						   ?>			
						</table>												

					</div>
					<div class="shopping">
						<div class="shopleft">
							<a href="index.php"> <img src="images/shop.png" alt="" /></a>
						</div>					
					</div>
    	</div>  	
       <div class="clear"></div>
    </div>
 </div>

 <?php
   include 'include/footer.php';
 ?>


