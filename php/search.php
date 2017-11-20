<?php

header('Content-Type: text/html; charset=utf-8');
$con = mysqli_connect("localhost", "root", "111444le", "douban");
if (!$con) {
    echo "连接失败";
    die();
}
mysqli_set_charset($con, "utf8");

$search =$_GET["search"];
$sql = "select * from movie where name like '%{$search}%' limit 12";
$results = mysqli_query($con, $sql);
$arr = array();
while ($row = mysqli_fetch_assoc($results)) {
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

echo json_encode($arr);
