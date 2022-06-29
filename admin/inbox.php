<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>

<?php
		$filepath = realpath(dirname(__FILE__));
		// dùng để import một file PHP a  vào một file bvới mục đích giúp file b  có thể sử dụng được các thư viện trong file PHP.
		require_once ($filepath.'/../classes/cart.php');  
		require_once ($filepath.'/../helpers/format.php');
?>
<?php
        // khai báo $ct từ trong class cart
        $ct = new cart();
		if(isset($_GET['shiftid'])){			
		$id = $_GET['shiftid'];		
		$price = $_GET['price'];  
		$shifted = $ct->shifted($id,$price);
}
?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Hộp thư đến</h2>
                <div class="block">    
					<?php
					if(isset($shifted)){
						echo $shifted;
					}
					?>    
                    <table class="data display datatable" id="example">
					<thead>
						<tr>
							<th> No.</th>
							<th>Thời gian đặt hàng</th>
							<th>Sản phẩm</th>
							<th>Số lượng</th>
							<th>Giá</th>
							<!-- <th>Địa chỉ</th> -->
							<th>Tình trạng</th>	
														
						</tr>
					</thead>
					<tbody>
						<?php
								$ct = new cart();
								$fm = new Format();
								$get_inbox_cart = $ct->get_inbox_cart();
								if($get_inbox_cart){
									$i = 0;
									while($result = $get_inbox_cart->fetch_assoc()){
										$i++;												
						?>
						<tr class="odd gradeX">
							<td><?php echo $i; ?></td>
							<td><?php echo $fm->formatDate($result['date_order']) ?></td> 
							<td><?php echo $result['productName'] ?></td>
							<td><?php echo $result['quantity'] ?></td>
							<td><?php echo $result['price'].' '.'VND' ?></td>
					
							<td>
								
							<?php
								if($result['status']==0){	
							?>
						    	<a href="?shiftid=<?php echo $result['id']?> &price=<?php echo $result['price']?> &time<?php echo $result['date_order']?>">Giao Hàng</a>
							<?php
							}else{
							 ?>
							 <a href="?shiftid=<?php echo $result['id']?> &price=<?php echo $result['price']?> &time<?php echo $result['date_order']?>">Đang Giao Hàng</a>
							<?php
							}	
							?>
							</td>	
						</tr>
						<?php
 								}	
							}
						?>
					</tbody>
				</table>
               </div>
            </div>
        </div>
<script type="text/javascript">
    $(document).ready(function () {
        setupLeftMenu();

        $('.datatable').dataTable();
        setSidebarHeight();
    });
</script>
<?php include 'inc/footer.php';?>
