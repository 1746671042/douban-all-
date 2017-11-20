<?php
header('Content-Type: text/html; charset=utf-8'); //网页编码
//获取页面数据   上映中
$con = mysqli_connect("localhost", "root", "111444le", "douban");
$arr = array();
if (!$con) {
    echo json_encode($arr);
    exit();
}
mysqli_set_charset($con, "utf8");
$sql = "select * from movie order by  click desc limit 12;";
$result = mysqli_query($con, $sql);
if (!$result) {
    echo json_encode($arr);
    exit();
}


//while($row = mysqli_fetch_assoc($result)){
//    $arr[]=$row;
//}  
//echo json_encode($arr);
while ($row = mysqli_fetch_assoc($result)) {
    $arr[$row["id"]] = $row;
}

$ids = array_keys($arr);
$sql = "select * from movie_type where movie_id in(" . implode(",", $ids) . ")";
$result = mysqli_query($con, $sql);
$movieType = array();
$typeIds = array();
while ($row = mysqli_fetch_assoc($result)) {
    $movieType[] = $row;
    $typeIds[] = $row["type_id"];
}



$sql = "select * from type where id in(" . implode(",", $typeIds) . ")";
$result = mysqli_query($con, $sql);
$type = array();
while ($row = mysqli_fetch_assoc($result)) {
    $type[$row["id"]] = $row["name"];
}

foreach ($movieType as $k => $v) {
    $arr[$v["movie_id"]]["typename"][] = $type[$v["type_id"]];
}
foreach ($arr as $ck => $cv) {
//    var_dump($cv["typename"]);
    $type = implode('/', $cv["typename"]);
    $arr[$ck]["typename"] = $type;
}
$arr = array_values($arr);
echo json_encode($arr);
//var_dump($arr);