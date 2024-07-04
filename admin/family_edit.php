<?php 
session_start();
if(!isset($_SESSION['username'])){
    $show=header("location: ../login/login.php");
    
}
?>

<?php require("../help/connect.php"); 
$familyid = $_GET['family_id'];
$sql = "SELECT * FROM family WHERE family_id='$familyid'";
$result=mysqli_query($connection,$sql);
$row = mysqli_fetch_array($result);

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>mushroom</title>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    </head>

    <body class="sb-nav-fixed">
        
    <?php include 'meedit.php'; ?>

            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">แก้ไขไฟลัม</h1>

                        <!-- แบ่งฝั่ง ที่1 -->
<div class="row">
  <div class="col-sm-6">
 <form name="form1" method="post" action="family_up.php" enctype="multipart/form-data">

 <div class="row"> <!-- ชื่อเห็ด -->
    <div class="col-sm-10">
    <input type="hidden" name="family0" class="form-control" value=<?=$row['family_id'] ?>  ><br>
    </div>
  </div>

  <div class="row"> <!-- ชื่อเห็ด -->
 <label class="col-sm-3 col-form-label">ชื่อวงศ์อังกฤษ :</label>
    <div class="col-sm-9">
    <input type="text" name="family1" class="form-control" value=<?=$row['family_eng'] ?>  ><br>
    </div>
  </div>

  <div class="row"> <!-- ชื่อเห็ด -->
 <label class="col-sm-3 col-form-label">ชื่องวงศ์ไทย :</label>
    <div class="col-sm-9">
    <input type="text" name="family2" class="form-control" value=<?=$row['family_thai'] ?>  ><br>
    </div>
  </div>

  <!-- ปุ่ม -->
<button type="submit" value="Update" class="btn btn-success">บันทึก</button>
<a href="family_show.php" class="btn btn-danger" role="button">ยกเลิก</a>

</form>

</div> <!-- end edit -->

                    </div><br>
                    <a href="family_show.php" class="btn btn-secondary" role="button">ย้อนกลับ</a>
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
