<?php

$filepath = realpath(dirname(__FILE__));
include_once ($filepath.' /../lib/database.php');
include_once ($filepath.'/../helpers/format.php');
?>

  
<?php

   class product
   {
    private $db;
    private $fm;

    public function __construct()
    {
       $this->db = new Database();
       $this->fm = new Format();
    }
    public function search_product($tukhoa){
      $tukhoa = $this->fm->validation($tukhoa);
      $query = "SELECT *FROM tbl_product WHERE productName LIKE '%$tukhoa%'";
      $result = $this->db->select($query);
      return $result;
    }
    public function insert_product($data,$files){
      
        $productName = mysqli_real_escape_string($this->db->link, $data['productName']);
        $brand       = mysqli_real_escape_string($this->db->link, $data['brand']);
        $category    = mysqli_real_escape_string($this->db->link, $data['category']);
        $product_desc = mysqli_real_escape_string($this->db->link, $data['product_desc']);
        $price        = mysqli_real_escape_string($this->db->link, $data['price']);
        $type         = mysqli_real_escape_string($this->db->link, $data['type']);

        $permited = array('jpg', 'jpeg' , 'png' , 'gif');
        $file_name = $_FILES['image']['name'];
        $file_size = $_FILES['image']['size'];
        $file_temp = $_FILES['image']['tmp_name'];
       
        $div = explode('.', $file_name);
        $file_ext = strtolower(end($div));
        $unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
        $uploaded_image = "uploads/".$unique_image;
    
        if($productName =="" || $brand =="" || $category =="" ||$product_desc =="" || $price =="" || $type =="" || $file_name ==""){
            $alert = "<span class = 'error'>Fiels không được để trống</span>";
            return $alert;
         }else{ 
            move_uploaded_file($file_temp,$uploaded_image);
            $query = "INSERT INTO tbl_product(productName,brandId,catId,product_desc,price,type,image) VALUES ('$productName','$brand','$category','$product_desc','$price','$type','$unique_image')";
            $result = $this->db->insert($query);
            if($result){
                $alert = "<span class = 'success'>Thêm sản phẩm thành công </span>";
                return $alert;
            } else{
                 $alert = "<span class = 'error'>Thêm sản phẩm không thành công </span>";
                return $alert;
            }
          }
       }
         public function insert_slider($data,$files){
         /*  $sliderName = mysqli_real_escape_string($this->db->link, $data['sliderName']); */
          $type       = mysqli_real_escape_string($this->db->link, $data['type']);
          
          // kiem tra hinh anh va lay hinh anh cho vao folder uploads
          $permited = array('jpg', 'jpeg' , 'png' , 'gif');

          $file_name = $_FILES['image']['name'];
          $file_size = $_FILES['image']['size'];
          $file_temp = $_FILES['image']['tmp_name'];
         
          $div = explode('.', $file_name);
          $file_ext = strtolower(end($div));
          $unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
          $uploaded_image = "uploads/".$unique_image;
      
          if(/* $sliderName =="" || */ $type==""){
              $alert = "<span class = 'error'>Fiels không được để trống</span>";
              return $alert;
           }else{ 
             if(!empty($file_name)){
               // neu nguoi dung chon anh
               if($file_size > 2048000){
                $alert = "<span class = 'success'>Size ảnh không nên lớn hơn 2MB!</span>";
                return $alert;
               }
               elseif (in_array($file_ext, $permited) === false)
               {
                $alert = "<span class = 'success'>Bạn chỉ có thể upload:-".implode(',',$permited)."</span>";
                return $alert;
               }            
              move_uploaded_file($file_temp,$uploaded_image);
              $query = "INSERT INTO tbl_slider(type,slider_image) VALUES ('$type','$unique_image')";
              $result = $this->db->insert($query);
              if($result){
                  $alert = "<span class = 'success'>Thêm Slider thành công </span>";
                  return $alert;
              } else{
                   $alert = "<span class = 'error'>Thêm Slider không thành công </span>";
                  return $alert;
              }
            }
          }
        }
        public function show_slider(){
          $query = "SELECT *FROM tbl_slider order by sliderId desc";
          $result = $this->db->select($query);
          return $result;
        }
         public function show_product(){
            $query = " SELECT * FROM GetListDataProduct";
            $result = $this->db->select($query);
            return $result;
        }
     
        public function del_product($id){
            $query = "DELETE FROM tbl_product where productId  = '$id'";
            $result = $this->db->delete($query);
            if($result){
                $alert = "<span class = 'success'>Xóa sản phẩm thành công </span>";
                return $alert;
            } else{
                 $alert = "<span class = 'error'>Xóa sản phẩm không thành công </span>";
                return $alert;
            }
        }
        public function getproductbyId($id){
            $query = "SELECT * FROM tbl_product where productId  = '$id'";
            $result = $this->db->select($query);
            return $result;
        }
       
        //ket thuc BACKEND
          public function getproduct_feathered(){
           $query = "SELECT * FROM tbl_product where type='0'";
           //$query =  "CALL GetListItemByType(0)";
            $result = $this->db->select($query);  
            return $result;
          }
         
          public function  getproduct_new(){
            $sp_tungtrang = 4;
            if(!isset($_GET['trang'])){
              $trang = 1;            
            }else{
              $trang = $_GET['trang'];
            }
            $tung_trang = ($trang-1)*$sp_tungtrang;
            $query = "SELECT * FROM tbl_product order by productId desc LIMIT $tung_trang,$sp_tungtrang";
        
            $result = $this->db->select($query);
            return $result;
          }
          public function  get_all_product(){
            $query = " SELECT * FROM tbl_product ";
            $result = $this->db->select($query);
            return $result;
          }


          public function  get_details($id){
            $idProduct = $id == "" ? 0 : $id;
            $query = "CALL GetDetailProductById($idProduct)";
            //$query = "SELECT tbl_product. *, tbl_category.catName, tbl_brand.brandName 
           // FROM tbl_product INNER JOIN tbl_category ON tbl_product.catId = tbl_category.catId INNER JOIN tbl_brand ON tbl_product.brandId = tbl_brand.brandId WHERE tbl_product.productId = '$id'";

            $result = $this->db->select($query);
            return $result;
          }
          public function getLastestNike(){
            $query = "SELECT * FROM tbl_product WHERE brandId = '6' order by productId desc LIMIT 1";
            $result = $this->db->select($query);
            return $result;
          }
          public function getLastestAdidas(){
            $query = "SELECT * FROM tbl_product WHERE brandId = '5' order by productId desc LIMIT 1";
            $result = $this->db->select($query);
            return $result;
          }
          public function getLastestAir(){
            $query = "SELECT * FROM tbl_product WHERE brandId = '4' order by productId desc LIMIT 1";
            $result = $this->db->select($query);
            return $result;
          }
          public function getLastestVans(){
            $query = "SELECT * FROM tbl_product WHERE brandId = '3' order by productId desc LIMIT 1";
            $result = $this->db->select($query);
            return $result;
          }
          
        


      }


       
?>