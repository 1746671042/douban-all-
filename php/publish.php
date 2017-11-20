<?php
$name = isset($_POST["name"])?$_POST["name"]:"";
$performer = isset($_POST["performer"])?$_POST["performer"]:"";
$year = isset($_POST["year"])?$_POST["year"]:"";
$score = isset($_POST["score"])?$_POST["score"]:0;
$is_show = isset($_POST["is_show"])?$_POST["is_show"]:"";
$is_hot = isset($_POST["is_hot"])?$_POST["is_hot"]:"";
$introduce = isset($_POST["introduce"])?$_POST["introduce"]:"";
if($name =="" || $introduce=="" || $performer==""){
    $arr =array("status"=>1,"msg"=>"输入内容不能为空");
    echo json_encode($arr);
    exit();
}


//入库
header('Content-type:text/html; charset=utf-8');
$con = mysqli_connect("localhost", "root", "111444le", "douban");
if(!$con){
    $arr =array("status"=>2,"msg"=>"系统错误");
    echo json_encode($arr);
    exit();
}
mysqli_set_charset($con, "utf8");
//$sql = "insert into movie(name,performer,year,score,introduce) values('$name','$performer','$year',$score,'$introduce')";
$sql = "insert into movie(name,image,performer,year,score,introduce,add_time) values('$name','./images/p2502311890.webp','$performer','$year','$score','$introduce',now())";
$result = mysqli_query($con, $sql);
if($result){
    $arr =array("status"=>0,"msg"=>"发表成功");
    echo json_encode($arr);
    exit();
}else{
    $arr =array("status"=>2,"msg"=>"发表失败");
    echo json_encode($arr);
    exit();
}