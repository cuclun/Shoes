
<?php
    include 'include/header.php';

   $name = $_POST['name'];
   $email = $_POST['email'];
   $message = $_POST['message'];

  $connection = new mysqli ("localhost", "root",  "", "shoes");
  $save = "INSERT INTO tbl_contact (`name`,`email`,`message`) VALUES ('$name','$email','$message')";
  if ($connection->query($save) === true){
    echo 'Chúng tôi đã nhận được lời nhắn của bạn,
    cảm ơn đã sử dụng dịch vụ của chúng tôi.';
  } else{
    echo 'Lỗi không nhận được tin nhắn, vui lòng thử lại' .
    $connection->error;
  }

?>

  <a href="index.php"><h2>QUAY VỀ TRANG CHỦ</h2> </a>
<?php
   include 'include/footer.php';
 ?>
