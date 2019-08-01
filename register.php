<?php
    /**
     * 实现注册的页面，与register.html配合使用
     * @Author NullP0
     */
    include_once 'connect.php';

    // 检查非法字符
    function check($parm) {
        $patten = '[^A-Za-z0-9]';
        if (preg_match($patten, $parm)) {
            die('不能输入非法字符！');
        }
    }

    // 获取用户输入
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    $repassword = trim($_POST['repassword']);

    check($username);
    check($password);
    check($repassword);

    if ($username === '') {
        die("用户名不能为空！");
    } elseif ($password === '') {
        die("密码不能为空！");
    } elseif ($password !== $repassword) {
        die("两次输入的密码不一致！");
    } else {
        // 处理信息
        $password = md5($password);
        $time = time();
        $ip = $_SERVER['REMOTE_ADDR'];

        mysqli_select_db($con, 'bbs');      // 选择数据库
        mysqli_set_charset($con, 'utf-8');   // 选择字符集

        // 编写sql语句并向数据库中插入用户信息、返回结果
        $sql = "insert into user (username,password,createtime,createip) values('$username','$password', '$time' ,'$ip' )";
        $result = mysqli_query($con, $sql);

        if ($result) {
            echo '<script>alert("恭喜你注册成功！现在返回登录页面……"); document.location.href = "html/login.html";</script>';
            mysqli_close($con);
        } else {
            die('注册失败！');
        }
    }

?>