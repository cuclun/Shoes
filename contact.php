<?php
   include 'include/header.php';
   /* include 'include/slider.php'; */
 ?>
 

     <div class="main">
    <div class="content">
    	<div class="support">
  			<div class="support_desc">
  				<h3>Hỗ trợ trực tuyến</h3>
  				<p><span>24 Giờ | 7 Ngày | 365 ngày trong năm &nbsp;&nbsp; Hỗ trợ kỹ thuật</span></p>
  				<h2> Nếu bạn muốn hỗ trợ hay có khó khăn gì, hãy cho chúng tôi biết.</h2>
  			</div>
  				<img src="web/images/contact.png" alt="" />
  			<div class="clear"></div>
  		</div>
    	<div class="section group">
				<div class="col span_2_of_3">
				  <div class="contact-form">
				  	<h2>Liên hệ với chúng tôi</h2>
					    <form method ="post" action="process.php">
					    	<div>
						    	<span><label>Tên</label></span>
						    	<span><input type="text" id ="name" name="name"><label for ="name"></label>
						    </div>
						    <div>
						    	<span><label>E-MAIL</label></span>
						    	<span><input type="email"id ="email" name="email"> <label for ="email"></label>
						    </div>						  
						    <div>
						    	<span><label>Lời nhắn</label></span>
								<textarea type="message"id ="message" name="message"> </textarea> <label for ="message"></label>
						    </div>
						   <div>
						   		<input type="submit" value="GỬI">
						  </div>
					    </form>
				  </div>
  				</div>
				<div class="col span_1_of_3">
      			<div class="company_address">
				     	<h2>Thông tin công ty:</h2>
						    	<p>459 Tôn Đức Thắng</p>
						   		<p>Quận Liên chiểu,TP Đà Nẵng</p>
						   		<p>Việt Nam</p>
				   		<p>Phone:19001000 - 19001100 </p>
				 	 	<p>Email: <span>tuanstore@gmail.com</span></p>
				   		<p>Follow on: <span>Facebook</span>, <span>Twitter</span></p>
				   </div>
				 </div>
			  </div>    	
    </div>
 </div>  


 <?php
   include 'include/footer.php';
 ?>
