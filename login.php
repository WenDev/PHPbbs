<?php
    /**
     * 实现登录功能
     * @Author NullP0
     */
    session_start();
    include_once 'connect.php';

    function check($parm) {
        $patten = '[^A-Za-z0-9]';
        if (preg_match($patten, $parm)) {
            die('不能输入非法字符！');
        }
    }

    if ($_POST['username'] === '') {
        die('请输入用户名！');
    } elseif ($_POST['password'] === '') {
        die('请输入密码！');
    } else {
        $username = $_POST['username'];
        $password = $_POST['password'];
        mysqli_select_db($con, 'bbs');
        check($username);
        $sql = "select * from user where username = '$username' ";
        $res = mysqli_query($con, $sql);
        $row = mysqli_fetch_assoc($res);

        if ($row['password'] === md5(trim($password))) {
            // 使用session进行会话控制,把用户名存放到session中
            $_SESSION['username'] = $username;
            if ($username === 'admin') {
                die('<script>alert("欢迎，管理员。"); document.location.href = "admin.php"</script>');
            }
            echo '<script>alert("登录成功，现在回到主页。"); document.location.href = "index.php"</script>';
        } else {
            die('<script>alert("密码不正确！"); document.location.href = "html/login.html"</script>');
        }
    }

?>