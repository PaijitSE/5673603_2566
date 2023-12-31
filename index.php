<!DOCTYPE html>
<html lang="en">
<?php
require_once('scripts/Myscript.php');
$db_handle = new myDBControl();

$x = '';
// ตรวจสอบการส่ง คำค้น
if (isset($_POST['searvh'])) {
    $x = "WHERE (Product_name LIKE '%".$_POST['searvh']."%')";    
}

//ตรวจสอบการส่ง ประเภทสินค้า
if (isset($_GET['Stype'])) {
    $x = "WHERE (Product_type = '".$_GET['Stype']."')";    
}

?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>5673603 Software Construction and Evolution</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" href="css/Style.css">
</head>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js" integrity="sha384-fbbOQedDUMZZ5KreZpsbe1LCZPVmfTnH7ois6mU1QK+m14rQ1l2bGBq41eYeM/fS" crossorigin="anonymous"></script>

<body>
    <!-- พี่ออมสิน -->
    <?php include('header.php'); ?>
    <div class="container">
        <!-- วราวุฒิ -->
        <header class="header">
            <div id="carouselExample" class="carousel slide">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="img/1.png" class="image_slice" alt=" ...">
                    </div>
                    <div class="carousel-item">
                        <img src="img/2.png" class="image_slice" alt="...">
                    </div>
                    <div class="carousel-item">
                        <img src="img/3.png" class="image_slice" alt="...">
                    </div>
                    <div class="carousel-item">
                        <img src="img/4.png" class="image_slice" alt="...">
                    </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </header>
        <!-- นราวิชญ์ -->
        <h4>Recommended Product</h4>
        <?php $productdetail = $db_handle->Textquery("SELECT PRODUCT.*, CONCAT(LEFT(Product_name, 10),'...') AS New_name, Type_name FROM PRODUCT INNER JOIN PRODUCT_TYPE ON (PRODUCT.Product_type=PRODUCT_TYPE.Type_no) WHERE Product_status = '1' LIMIT 5;") ?>
        <div class="product">
            <?php 
            if (empty($productdetail)) { ?>
                <p>ไม่มีสินค้าแนะนำ</p>
            <?php } else {
            foreach ($productdetail as $key => $value) {
            ?>
                <div class="productBox">
                    <img class="productImg" src="<?php echo $productdetail[$key]["Product_picture"]; ?>">
                    <div class="productTxt">
                        <p><?php echo $productdetail[$key]["New_name"]; ?></p>
                        <p>ประเภท<?php echo $productdetail[$key]["Type_name"]; ?></p>
                        <p>Price : <?php echo $productdetail[$key]["Product_price"]; ?></p>
                        <button><a href="#">Shop now</a></button>
                    </div>
                </div>
            <?php }
        } ?>
        </div>

        <h4>All Product</h4>
        <!-- พิชิตชัย -->
        <div class="row search">
            <div class="col-5">
                <form action= "index.php" Method="POST">
                    <input type="text" placeholder="Search" name="searvh" require>
                    <button type="submit" name="act" value="">ค้นหา</button>
                </form>
            </div>
            <div class="col-2"></div>
            <div class="col-5">
                <?php $Typedetail = $db_handle->Textquery("SELECT * FROM PRODUCT_TYPE;") ?>                
                <select aria-label="Default select example" name = "Stype" 
                onchange="window.location='index.php?Stype='+this.value+''">
                    <?php if (empty($Typedetail)) { ?>
                        <option selected>ไม่มีประเภทสินค้า</option>    
                    <?php } else { ?>
                        <option selected>ทุกประเภทสินค้า</option>
                        <?php foreach ($Typedetail as $key => $value) {?>
                             <option value="<?php echo $Typedetail[$key]["Type_no"]; ?>">
                             <?php echo $Typedetail[$key]["Type_name"]; ?></option>
                             <?php } 
                    } ?>
                </select>
            </div>
        </div>

        <!-- พี่จาตุรนต์ -->
        <?php $productAll = $db_handle->Textquery("SELECT PRODUCT.*, CONCAT(LEFT(Product_name, 20),'...') AS New_name, Type_name FROM PRODUCT INNER JOIN PRODUCT_TYPE ON (PRODUCT.Product_type=PRODUCT_TYPE.Type_no) ".$x.";"); 
        //echo "SELECT PRODUCT.*, CONCAT(LEFT(Product_name, 20),'...') AS New_name, Type_name FROM PRODUCT INNER JOIN PRODUCT_TYPE ON (PRODUCT.Product_type=PRODUCT_TYPE.Type_no) '$x'"; ?>

        <?php 
            if (empty($productAll)) { ?>
                <p>ไม่มีรายงานสินค้าในปัจจุบัน...</p>
            <?php } else { ?>
        <div class="col-1">
            <?php  foreach ($productAll as $key => $value) { ?>
                <div class="crad">
                    <div class="crad-img">
                        <img src="<?php echo $productAll[$key]["Product_picture"];?>" alt="" class="img-1">
                    </div>
                    <div class="conent">
                        <p><strong><?php echo $productAll[$key]["New_name"]; ?></strong></p>
                        <p>Price :<?php echo $productAll[$key]["Product_price"]; ?></p>
                        <p>Stock in : <?php echo $productAll[$key]["Product_count"]; ?></p>
                        <button><a href="#">Shop now</a></button>
                    </div>
                </div>
            <?php } ?>
        </div> 
        <?php } ?>
    </div>
</body>

</html>