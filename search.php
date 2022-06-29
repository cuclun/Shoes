<?php
   include 'include/header.php';
  // include 'include/slider.php';
 ?>
     

 <div class="main">
    <div class="content">
    <?php
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $tukhoa = $_POST['tukhoa'];
            $search_product= $product->search_product($tukhoa);
             }
        ?>

    	<div class="content_top">
	
    		<div class="heading">
    		<h3>Từ khóa tìm kiếm : <?php echo $tukhoa ?></h3>
    		</div>
    		<div class="clear"></div>
    	</div>
	      <div class="section group">
		  <?php			 
				if($search_product){
					while($result = $search_product->fetch_assoc()){    
				
  			?>
				<div class="grid_1_of_4 images_1_of_4">
					 <a href="details-3.php"><img src="admin/uploads/<?php echo $result['image']?>" alt="" /></a>
					 <h2><?php echo $result['productName']?></h2>
					 <p><?php echo $fm->textShorten($result['product_desc'], 50);?></p>
					 <p><span class="price"><?php echo $fm->format_currency($result['price'])." "."VND"?></span></p>
				     <div class="button"><span><a href="details.php?proid=<?php echo $result['productId'] ?>" class="details">Chi tiết</a></span></div>
				</div>	
		 <?php
						}
					}else{
						echo 'Không tìm thấy kết quả';
					}
				?>
			</div>
    </div>
 </div>

 <?php
   include 'include/footer.php';
 ?>