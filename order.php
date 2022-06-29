<?php
   include 'include/header.php';
   
 ?>

<?php
     		$login_check = Session::get('cuslogin');
	 		if($login_check==false){
				header('Location:login.php');
			 }
?>

<style>
    .order_page{
    font-size: 30px;
    font-weight: bold;     
    color: red;
}   
</style>
 <div class="main">
    <div class="content">
    	<div class="section group">
            <div class="order">
    		        <h2>Đăng nhập thành công, hãy quay về trang chủ để đặt hàng nhé.</h2>
    	        </div>
            </div>
        <div class="clear"></div>
    </div>
</div>

<?php
   include 'include/footer.php';
 ?>