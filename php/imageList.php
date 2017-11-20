<?php

header('Content-Type: text/html; charset=utf-8'); //网页编码
//获取页面数据

$page = isset($_GET["page"]) ? $_GET["page"] : 1;
//获取每页调取的条数
$num = 12;

$con = mysqli_connect("localhost", "root", "111444le", "douban");
$arr = array();
$data = array("countpage" => 1, "list" => $arr, "page" => $page);
if (!$con) {
    echo json_encode($data);
    exit();
}
mysqli_set_charset($con, "utf8");
$start = ($page - 1) * $num;
$sql = "select * from movie where is_hot='1' limit {$start},{$num}";
$result = mysqli_query($con, $sql);
if (!$result) {
    echo json_encode($data);
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
//总页数
$sql = "select count(*) as num from movie";
$result = mysqli_query($con, $sql);
$row = mysqli_fetch_assoc($result);
$count = $row["num"];

$countpage = ceil($count / $num);

$data = array("countpage" => $countpage, "list" => $arr, "page" => $page);
echo json_encode($data);
//var_dump($data);
