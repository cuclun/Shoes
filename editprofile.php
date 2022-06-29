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
    $id = Session::get('cmrId');
   if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['save'])) {
	$UpdateCustomers = $cs->update_customers($_POST, $id);
}
?>

 <div class="main">
    <div class="content">
    	<div class="section group">
            <div class="content_top">
                <div class="heading">
                <h3>Cập nhật hồ sơ</h3>
                </div>
                <div class="clear"></div>
            </div>
         <form action ="" method ="post">    
       <table class ="tblone">
           <tr>
                   <?php
                   if(isset($UpdateCustomers)){
                       echo '<td colspan="3">'.$UpdateCustomers.'</td>';
                   }
                   ?>
           </tr>
           <?php
           $id = Session::get('cmrId');
           $get_customers = $cs->show_customers($id);
           if ($get_customers){
               while($result = $get_customers->fetch_assoc()){
           ?>
           
           <tr>
               <td>Name</td>
               <td>:</td>
               <td><input type="text" name ="name" value ="<?php echo $result['name']?>"></td>
           </tr>
        
           <tr>
               <td>Phone</td>
               <td>:</td>
               <td><input type="text" name ="phone" value ="<?php echo $result ['phone']?>"></td>
           </tr>
           <tr>
               <td>Zipcode</td>
               <td>:</td>
               <td><input type="text" name ="zipcode" value ="<?php echo $result ['zipcode']?> "></td>
           </tr>
           <tr>
               <td>Email</td>
               <td>:</td>
               <td><input type="text" name ="email" value ="<?php echo $result ['email']?> "></td>
           </tr>
           <tr>
               <td>Address</td>
               <td>:</td>
               <td><input type="text" name ="address" value ="<?php echo $result ['address']?> "></td>
           </tr>
               <td colspan ="3"><input type ="submit" name ="save" value ="LƯU" class = "grey"></input></td>
           <?php
            }
        }
           ?>
       </table>
    </form>
 	</div>
 </div>
<?php
   include 'include/footer.php';
 ?>