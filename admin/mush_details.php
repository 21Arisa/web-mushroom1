<?php 
session_start();
if(!isset($_SESSION['username'])){
    header("location: ../login/login.php");
    exit();
}
?>

<?php require("../help/connect.php"); ?>

<?php
$mushid=$_GET['mush_id'];
$sql1="SELECT * FROM mushroom 
JOIN region ON mushroom.region_id = region.region_id
JOIN phylum ON mushroom.phylum_id = phylum.phylum_id
JOIN category ON mushroom.cate_id = category.cate_id
JOIN family ON mushroom.family_id = family.family_id
JOIN common_name ON mushroom.com_id = common_name.com_id
JOIN cap ON mushroom.cap_id = cap.cap_id
JOIN cap_skin ON mushroom.skin_id = cap_skin.skin_id
JOIN gill ON mushroom.gill_id = gill.gill_id
JOIN stalk ON mushroom.stalk_id = stalk.stalk_id
where mush_id='$mushid'";
$hand=mysqli_query($connection,$sql1);
$row1=mysqli_fetch_array($hand);
$Phylum=$row1['phylum_id'];
$Region=$row1['region_id'];
$Cate=$row1['cate_id'];
$Family=$row1['family_id'];
$Cap=$row1['cap_id'];
$Skin=$row1['skin_id'];
$Gill=$row1['gill_id'];
$Stalk=$row1['stalk_id'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Mushroom</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link href="css/styles.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<style>
    .img-preview-wrapper { 
        position: relative;  
        display: inline-block;
        margin: 10px; 
    }
    .img-preview-wrapper img {
        max-width: 500px;
    }
    .img-preview-wrapper .remove-btn {
        position: absolute;
        top: 5px;
        right: 5px;
        background-color: rgba(255, 255, 255, 0.7);
        border: none;
        border-radius: 50%;
        cursor: pointer;
    }
    .img-preview-wrapper .remove-btn i {
        color: #a94442;
    }
</style>

<style>/* กรอบ ชื่อ วันที่ เป็นต้น*/
  .bordered-box {
    border: 1px solid #DCDCDC; /* เส้นกรอบ */
    padding: 15px;
    border-radius: 5px;
    background-color: #FFFAFA;
    margin-bottom: 15px;
  }
  .bordered-box p {
    margin-bottom: 10px; /* Adjust the space between lines if needed */
  }
</style>



<body class="sb-nav-fixed">
    <?php include 'me.php'; ?>

    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4">
                <h1 class="mt-4">รายละเอียดข้อมูลเห็ด</h1>

                <!-- แบ่งฝั่ง ที่1 -->
                <div class="row">
                    <div class="col-sm-6">
                        <div class="row"> <!-- id mush -->
                            <div class="col-sm-10">
                                <input type="hidden" name="mush_id" class="form-control" readonly value=<?=$row1['mush_id'] ?>  ><br>
                            </div>
                        </div>

                            <div class="row"> <!-- ชื่อเห็ด -->
                                <label class="col-sm-3 col-form-label">ชื่อเห็ด :</label>
                                <div class="col-sm-9">
                                    <div class="bordered-box">
                                        <p><?=$row1['mush_name'] ?></p>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">ชื่อสามัญ :</label>
                                <div class="col-sm-9">
                                    <div class="bordered-box">
                                        <p><?=$row1['com_name'] ?></p>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">ชื่อวิทยาศสตร์ :</label>
                                <div class="col-sm-9">
                                    <div class="bordered-box">
                                        <p><?=$row1['sci_name'] ?></p>
                                    </div>
                                </div>
                            </div>

                            <div class="row"> <!-- ชื่อเห็ด -->
  <label class="col-sm-3 col-form-label">หมวดหมู่ :</label>
  <div class="col-sm-9">
    <?php 

    $sql = "SELECT * FROM category WHERE cate_id = $Cate"; // ดึงข้อมูลจากตาราง category_survey ทั้งหมด
    $hand = mysqli_query($connection, $sql);
    while ($row = mysqli_fetch_array($hand)) { // ใช้ while loop เพื่อดึงข้อมูลทุกแถว
        ?>
          <img src="../image/<?=$row['imagecate'] ?>" class="img-thumbnail" alt="<?=$row['cate_id']?><?=$row['cate_thai']?>"><br>
           <!-- Display the category name as well -->
          <?=$row['cate_thai']?><br><br>
        <?php
        }
        ?>
      </div>
    </div>

    <div class="row mb-3"> <!-- ไฟลัม -->
  <label class="col-sm-3 col-form-label">ไฟลัม :</label>
  <div class="col-sm-9">
    <?php 
    $sql = "SELECT * FROM phylum WHERE phylum_id = $Phylum"; // เลือกข้อมูลภูมิภาคที่เลือกไว้
    $hand = mysqli_query($connection, $sql);
    if ($row = mysqli_fetch_array($hand)) { // เรียกใช้ข้อมูลแถวเดียว
    ?>
    <div class="bordered-box">
      <p><?= $row['phylum_eng'] ?></p> 
    </div>
    <?php
    }
    ?>
  </div>
</div>

<div class="row mb-3"> <!-- วงศ์ -->
  <label class="col-sm-3 col-form-label">วงศ์ :</label>
  <div class="col-sm-9">
    <?php 
    $sql = "SELECT * FROM family WHERE family_id = $Family"; // เลือกข้อมูลภูมิภาคที่เลือกไว้
    $hand = mysqli_query($connection, $sql);
    if ($row = mysqli_fetch_array($hand)) { // เรียกใช้ข้อมูลแถวเดียว
    ?>
    <div class="bordered-box">
      <p><?= $row['family_eng'] ?></p> 
    </div>
    <?php
    }
    ?>
  </div>
</div>

    
                        </div><!-- แบ่งฝั่ง1 end -->

                        <!-- แบ่งฝั่ง ที่2 -->
                        <div class="col-sm-6">

<div class="row mb-3"> <!-- หมวกเห็ด -->
  <label class="col-sm-3 col-form-label">หมวกเห็ด :</label>
  <div class="col-sm-9">
    <?php 
    $sql = "SELECT * FROM cap WHERE cap_id = $Cap"; // เลือกข้อมูลภูมิภาคที่เลือกไว้
    $hand = mysqli_query($connection, $sql);
    if ($row = mysqli_fetch_array($hand)) { // เรียกใช้ข้อมูลแถวเดียว
    ?>
    <div class="bordered-box">
      <p><?= $row['cap_description'] ?></p> 
    </div>
    <?php
    }
    ?>
  </div>
</div>

<div class="row mb-3"> <!-- ผิวของหมวกเห็ด -->
  <label class="col-sm-3 col-form-label">ผิวของหมวกเห็ด :</label>
  <div class="col-sm-9">
    <?php 
    $sql = "SELECT * FROM cap_skin WHERE skin_id = $Skin"; // เลือกข้อมูลภูมิภาคที่เลือกไว้
    $hand = mysqli_query($connection, $sql);
    if ($row = mysqli_fetch_array($hand)) { // เรียกใช้ข้อมูลแถวเดียว
    ?>
    <div class="bordered-box">
      <p><?= $row['skin_cap'] ?></p> 
    </div>
    <?php
    }
    ?>
  </div>
</div>

<div class="row mb-3"> <!-- ครีบ -->
  <label class="col-sm-3 col-form-label">ครีบ :</label>
  <div class="col-sm-9">
    <?php 
    $sql = "SELECT * FROM gill WHERE gill_id = $Gill"; // เลือกข้อมูลภูมิภาคที่เลือกไว้
    $hand = mysqli_query($connection, $sql);
    if ($row = mysqli_fetch_array($hand)) { // เรียกใช้ข้อมูลแถวเดียว
    ?>
    <div class="bordered-box">
      <p><?= $row['gill_description'] ?></p> 
    </div>
    <?php
    }
    ?>
  </div>
</div>

<div class="row mb-3"> <!-- ก้าน -->
  <label class="col-sm-3 col-form-label">ก้าน :</label>
  <div class="col-sm-9">
    <?php 
    $sql = "SELECT * FROM stalk WHERE stalk_id = $Stalk"; // เลือกข้อมูลภูมิภาคที่เลือกไว้
    $hand = mysqli_query($connection, $sql);
    if ($row = mysqli_fetch_array($hand)) { // เรียกใช้ข้อมูลแถวเดียว
    ?>
    <div class="bordered-box">
      <p><?= $row['stalk_description'] ?></p> 
    </div>
    <?php
    }
    ?>
  </div>
</div> 
                    
<div class="row mb-3"> <!-- ภูมิภาค -->
  <label class="col-sm-3 col-form-label">ภูมิภาค :</label>
  <div class="col-sm-9">
    <?php 
    $sql = "SELECT * FROM region WHERE region_id = $Region"; // เลือกข้อมูลภูมิภาคที่เลือกไว้
    $hand = mysqli_query($connection, $sql);
    if ($row = mysqli_fetch_array($hand)) { // เรียกใช้ข้อมูลแถวเดียว
    ?>
    <div class="bordered-box">
      <p><?= $row['region_name'] ?></p> 
    </div>
    <?php
    }
    ?>
  </div>
</div>
<!-- ภูมิภาค end -->

                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">รายละเอียด :</label>
                                <div class="col-sm-9">
                                    <div class="bordered-box">
                                        <p><?=$row1['mush_detail'] ?></p>
                                    </div>
                                </div>
                            </div>
                        </div><!-- แบ่งฝั่ง2 end -->
                        
        <div class="col-sm-12"><!-- แสดงรูป -->  
            <div class="form-group row">
            <label class="col-sm-1 col-form-label">รูปภาพ :</label>
            <image src="../image/<?=$row1["image"]?>"class="img-fluid" style="max-width: 50%; height: auto;" >

            <!-- แสดงรูป จบ-->
            </div><br>      
                            <a href="mush1.php" class="btn btn-secondary" role="button">ย้อนกลับ</a>
                            
                        </div>

                        

                    
                </div>
            </main>
        </div>



        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/chart-area-demo.js"></script>
        <script src="assets/demo/chart-bar-demo.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
        <script src="js/datatables-simple-demo.js"></script>
    </body>
</html>
