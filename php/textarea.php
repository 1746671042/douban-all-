<?php
$text = isset($_POST["text"])?$_POST["text"]:"";
$time = date('m').'月'.date('d').'日';

if($text==""){
    $arr =array("status"=>2,"msg"=>"请输入评论内容！");
    echo json_encode($arr);
    exit();
}

//入库
$con = mysqli_connect("localhost", "root", "111444le", "douban");
if(!$con){
    $arr =array("status"=>2,"msg"=>"系统错误！");
    echo json_encode($arr);
    exit();
}
mysqli_set_charset($con, "utf8");
$sql = "insert into comment(content,add_time) values('{$text}','{$time}')";
$result = mysqli_query($con, $sql);

if($result){
    $arr =array("status"=>0,"data"=>array("content"=>$text,"add_time"=>$time));
    echo json_encode($arr);
    exit();
}else{
    $arr =array("status"=>2,"msg"=>"发表失败！");
    echo json_encode($arr);
    exit();
}