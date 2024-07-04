<?php require("../help/connect.php"); 
$list = $connection->query("SELECT title 
FROM ckeditor
ORDER BY id DESC");
$list1 = array();

while ($rowdata = $list->fetch_assoc()) {
    $list1[] = $rowdata;
}

echo json_encode($list1);
?>