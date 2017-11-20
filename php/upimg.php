<?php
/**
 * Created by PhpStorm.
 * User: LiXiang
 * Date: 2017/8/16
 * Time: 10:10
 */
$upFile = $_FILES['file'];


//判断文件是否为空或者出错
if ($upFile['error'] == 0 && !empty($upFile)) {
    $dirpath = "./";
    $filename = $_FILES['file']['name'];
    
    $nameCur = explode('.', $filename);
    
    $filename = "php/" . time() . '.' . $nameCur['1'];
//    var_dump($filename);
//    $filename = time() .
    $queryPath = '../' . $filename;
//    echo $queryPath;
    //move_uploaded_file将浏览器缓存file转移到服务器文件夹
    if (move_uploaded_file($_FILES['file']['tmp_name'], $queryPath)) {
        echo json_encode(array("status"=>true,"url"=>$filename));
    }else{
        echo json_encode(array("status"=>false,"msg"=>"上传失败"));
    }
}else{
    echo json_encode(array("status"=>false,"msg"=>"上传失败"));
}

