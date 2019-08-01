<?php
    /**
    * 用户删除页面
    * @Author NullP0
    */
    session_start();

    include_once 'connect.php';

    if ($_SESSION['username'] !== 'admin') {
        die('<script>document.location.href = "index.php"</script>');
    }

    mysqli_select_db($con, 'message');      // 选择数据库
    mysqli_set_charset($con, 'utf-8');   // 选择字符集

    // 判断数据的合法性
    if (is_numeric($_GET['id'])) {
        $id = (int) $_GET['id'];
    } else {
        die('数据不合法');
    }

    $sql = "delete from message where id in($id)";

    $result = mysqli_query($con, $sql);

    if ($result) {
        die('<script>alert("删除成功！"); document.location.href = "admin.php"</script>');
    } else {
        die('<script>alert("删除失败！"); document.location.href = "admin.php"</script>');
    }

?>

