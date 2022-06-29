  <div class="header_bottom">
		<div class="header_bottom_left">
			<div class="section group">
				
				
				<?php
                $getLastestNike = $product->getLastestNike();
				if($getLastestNike){
					while($resultnike = $getLastestNike->fetch_assoc()){
  				?>
				<div class="listview_1_of_2 images_1_of_2">
					<div class="listimg listimg_2_of_1">
						 <a href="details.php?proid=<?php echo $resultnike['productId']?>"> <img src="admin/uploads/<?php echo $resultnike['image'] ?>" alt="" /></a>
					</div>
				    <div class="text list_2_of_1">
						<h2>Nike</h2>
						<p><?php echo $resultnike['productName'] ?></p>
						<div class="button"><span><a href="details.php?proid=<?php echo $resultnike['productId']?>">Đặt hàng</a></span></div>
				   </div>
			   </div>
			   <?php
					}
				}
			   ?>


				<?php
					$getLastestAdidas = $product->getLastestAdidas();
					if($getLastestAdidas){
						while($resultadidas = $getLastestAdidas->fetch_assoc()){
					?>
					<div class="listview_1_of_2 images_1_of_2">
						<div class="listimg listimg_2_of_1">
							<a href="details.php?proid=<?php echo $resultadidas['productId']?>"><img src="admin/uploads/<?php echo $resultadidas['image'] ?>" alt="" /></a>
						</div>
						<div class="text list_2_of_1">
							<h2>Adidas</h2>
							<p><?php echo $resultadidas['productName'] ?></p>
							<div class="button"><span><a href="details.php?proid=<?php echo $resultadidas['productId']?>">Đặt hàng</a></span></div>
						</div>
					</div>
					<?php
						}
					}
				?>

		

			</div>
			<div class="section group">  
			<?php
					$getLastestAir = $product->getLastestAir();
					if($getLastestAir){
					while($resultair = $getLastestAir->fetch_assoc()){
			?>
				<div class="listview_1_of_2 images_1_of_2">
					<div class="listimg listimg_2_of_1">
						 <a href="details.php?proid=<?php echo $resultair['productId']?>"> <img src= "admin/uploads/<?php echo $resultair['image']?>"alt=""/></a>
					</div>
				    <div class="text list_2_of_1">
						<h2>Air</h2>
						<p><?php echo $resultair['productName']?></p>
						<div class="button"><span><a href="details.php?proid=<?php echo $resultair['productId']?>">Đặt hàng</a></span></div>
				   </div>
			   </div>
			   <?php
					}
				}
			   ?>               
			   <?php
					$getLastestVans = $product->getLastestVans();
					if($getLastestVans){
					while($resultvans = $getLastestVans->fetch_assoc()){
			?>
				<div class="listview_1_of_2 images_1_of_2">
					<div class="listimg listimg_2_of_1">
						  <a href="details.php?proid=<?php echo $resultvans['productId']?>"><img src="admin/uploads/<?php echo $resultvans['image']?>" alt="" /></a>
					</div>
					<div class="text list_2_of_1">
						  <h2>Vans</h2>
						  <p><?php echo $resultvans['productName']?></p>
						  <div class="button"><span><a href="details.php?proid=<?php echo $resultvans['productId']?>">Đặt hàng</a></span></div>
					</div>
				</div>
			<?php
					}
				}

			?>
			</div>
		  <div class="clear"></div>
		</div>
			 <div class="header_bottom_right_images">
		   <!-- FlexSlider -->
             
			<section class="slider">
				  <div class="flexslider">
					<ul class="slides">
						<?php
							$get_slider = $product->show_slider();
							if($get_slider){
								while($result_slider = $get_slider->fetch_assoc()){
						?>
						<li><img src="admin/uploads/<?php echo $result_slider['slider_image'] ?>" alt=""/></li>
						<?php
							}
						}
						?>
				    </ul>
				  </div>
	      </section>
<!-- FlexSlider -->
	    </div>
	  <div class="clear"></div>
  </div>	