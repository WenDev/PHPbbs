<?php
    /**
     * 连接数据库
     * @Author NullP0
     */
    header('content-type: text/html;charset=utf-8');
    // 数据库的信息
    $serverName = 'localhost';
    $dbName = 'bbs';
    $userName = 'root';
    $password = 'root';

    // 连接数据库
    $con = mysqli_connect($serverName, $userName, $password, $dbName);

    if (!$con) {
        die('数据库连接失败！'.mysqli_connect_error());
    }

    mysqli_query($con, 'set names utf-8');      // 使用utf-8编码
?>
