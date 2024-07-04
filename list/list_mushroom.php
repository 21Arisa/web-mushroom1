<?php require("../help/connect.php"); 
$list = $connection->query("SELECT mush_name, image 
FROM mushroom 
JOIN category ON mushroom.cate_id = category.cate_id
WHERE category.cate_id = 2
ORDER BY mush_id DESC");
$list1 = array();

while ($rowdata = $list->fetch_assoc()) {
    $list1[] = $rowdata;
}

echo json_encode($list1);
?>