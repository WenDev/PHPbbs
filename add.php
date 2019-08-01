<?php
    /**
     * 添加留言
     * @Author NullP0
     */
    session_start();
    include_once 'connect.php';

    function checkBlank($content) {
        if ($content === '') {
            die('输入的内容不能为空！');
        }
    }

    if (!isset($_SESSION['username'])) {
        die('<script>alert("请先登录！"); document.location.href = "./html/login.html"</script>');
    }

    // 用户的数据：用户名、标题、内容
    $user = $_SESSION['username'];
    $title = $_POST['title'];
    $content = $_POST['content'];
    $time = time();

    checkBlank($title);
    checkBlank($content);

    mysqli_select_db($con, 'message');      // 选择数据库
    mysqli_set_charset($con, 'utf-8');   // 选择字符集

    // 当用户点击提交按钮时，向数据库插入留言信息，并返回提示信息、回到首页
    if ($_POST['title'] && $_POST['content']) {
        $sql = "insert into message(user, title, content, time)values('$user', '$title', '$content', now())";
        $result = mysqli_query($con, $sql);

        if ($result) {
            echo '<script>alert("添加成功！"); document.location.href = "index.php"</script>';
            mysqli_close($con);
        } else {
            die('添加失败！');
        }
    }
?>
