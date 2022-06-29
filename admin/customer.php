<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>

<?php
	$filepath = realpath(dirname(__FILE__));
    include_once ($filepath.'/../classes/customer.php');
    require_once ($filepath.'/../helpers/format.php'); 
?>
<?php 

  if(!isset($_GET['customerid']) || $_GET['customerid']== NULL){
        echo "<script>window.location = 'inbox.php';</script>";
    }else{
     $id = $_GET['customerid'];
}
     $cs = new customer();  
?>
<?php ?>
        <div class="grid_10">
            <div class="box round first grid">      
                <h2>Sửa danh mục</h2>
                <div class="block copyblock"> 
                <?php               
                 $getcust= $cs->show_customers($id);
                 if($getcust){
                    while($result = $getcust->fetch_assoc()){
                 ?>
                 <form action="" method="post">
                    <table class="form">					
                        <tr>
                            <td>Name</td>
                            <td>:</td>
                            <td>
                                <input type="type" readonly="readonly" value="<?php echo $result['name']; ?>" class="medium" />
                            </td>
                        </tr>
                    </table>    
                 </form>
              
                <?php
                    }} ?>

                </div>
            </div>
        </div>
<?php include 'inc/footer.php';?>