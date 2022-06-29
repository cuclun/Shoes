<?php
   include 'include/header.php';
 
 ?>

<?php
     	$login_check = Session::get('cuslogin');
	 	if($login_check==false){
		  header('Location:login.php');
		}
		?>

<?php

?>
<style> 
  h3.payment{
      text-align: center;
      font-size: 20px;
      font-weight: bold;
      text-decoration: underline;
  }
  .wrapper_method {
     text-align: center;
     width: 550px;
     margin: 0 auto;
     border: 1px solid #666;
     padding: 20px;
     background: cornsilk;
  }
 .wrapper_method a {
    padding: 10px;
    background: green;
    color: #fff;
  }
 .wrapper_method h3{
   margin-bottom: 20px;
  }
 

</style>
 <div class="main">
    <div class="content">
    	<div class="section group">
            <div class="content_top">
                <div class="heading">
                <h3>Thanh toán</h3>
                </div>

                <div class="clear"></div>
                <div class="wrapper_method">
                    <h3 class ="payment">Xác nhận đơn hàng đã đặt</h3>
                   <a href ="offlinepayment.php">Xác nhận</a> 
                    <a style ="background:red" href="cart.php"> Quay lại<Previous></a>
                    </div>
            </div>

 	</div>
 </div>
<?php
   include 'include/footer.php';
 ?>