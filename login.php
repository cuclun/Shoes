
<?php
   include 'include/header.php';

 ?>

<?php
     		$login_check = Session::get('cuslogin');
	 		if($login_check){
				header('Location:order.php');
			 }
?>


<?php 

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['login'])) {
	$custLogin= $cs->customerLogin($_POST);
}
?>
 
<?php 

  if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
	  $insertCustomers= $cs->insert_customers($_POST);
  }
?>


 <div class="main">
    <div class="content">
    	 <div class="login_panel">
			 <?php
			 	if(isset($custLogin)){
					echo $custLogin;
				}
			?>	
        	<h3>Khách hàng hiện tại</h3>
        	<p>Đăng nhập tài khoản và mật khẩu của bạn.</p>	
        	<form action="" method="POST" >
                	<input  name="email" class="field"  placeholder=" Nhập Email.." type="text"  />
                    <input  name="password" class="field" placeholder=" Nhập Password.." type="password"/>
               
                    <div class="buttons"><div><input type="submit" name="login" class="grey" value="Sign In"></div></div>
					</form>
            </div>


    	<div class="register_account">
    		<h3>Đăng ký tài khoản mới</h3>
			<?php
			if(isset($insertCustomers)){
				echo $insertCustomers;
			}
			?>
    		<form action="" method ="POST">
		   			 <table>
		   				<tbody>
						<tr>
						<td>
							<div>
							<input type="text" name="name" placeholder ="Nhập Tên..." >
							</div>
							
							<div>
							   <input type="text" name="city"  placeholder ="Nhập Thành phố...">
							</div>
							
							<div>
								<input type="text" name="zipcode"  placeholder ="Nhập Zip-Code..." >
							</div>
							<div>
								<input type="text" name="email"  placeholder ="Nhập E-Mail...">
							</div>
		    			 </td>
		    			<td>
						<div>
							<input type="text" name="address"  placeholder ="Nhập địa chỉ...">
						</div>
		    		<div>
						<select id="country" name="country" onchange="change_country(this.value)" class="frm-field required">
							<option value="null">Lựa Chọn Quốc gia</option>         
							<option value="hcm">Việt Nam</option>
													
		         </select>
				 </div>		        
		           <div>
		          <input type="text" name="phone" placeholder ="Nhập số điện thoại...">
		          </div>
				  
				  <div>
				 <input type="text" name="password" placeholder ="Nhập password...">
				</div>
		    	</td>
		    </tr> 
		    </tbody></table> 
		   <div class="search"><div><input type ="submit" name ="submit" class="grey" value = "Tạo tài khoản"></div></div>
		    <p class="terms">Bằng cách nhấp vào 'Tạo tài khoản', bạn đồng ý với <a href="#">Điều khoản &amp;Điều kiện.</a>.</p>
		    <div class="clear"></div>
		    </form>
    	</div>  	
       <div class="clear"></div>
    </div>
 </div>

 <?php
   include 'include/footer.php';
 ?>