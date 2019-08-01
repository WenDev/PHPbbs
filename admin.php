<html>
<head>
    <link rel="stylesheet" href="css/admin.css">
</head>
<body>
    <div class="topbar">
        <a href="index.php" class="indexbtn">首页</a>
        <a href="logout.php" class="loginOrLogoutLink">登出</a>
    </div>
    <div class="bigbox">
    <?php
    /**
     * 后台管理页面
     * @Author NullP0
     */
    session_start();
    error_reporting(0);
    include_once 'connect.php';

    // 如果不是管理员登录（登录的用户名不是admin），就没有权限访问此页面，于是跳转回主页
    if ($_SESSION['username'] !== 'admin') {
        die('<script>document.location.href = "index.php"</script>');
    }

    // 用户管理模块
    echo '<div class="title">用户管理</div>';

    mysqli_select_db($con, 'bbs');      // 选择数据库
    mysqli_set_charset($con, 'utf-8');   // 选择字符集

    $getCountSql = 'select count(id) as coun from user';
    $result = mysqli_query($con, $getCountSql);
    $data = mysqli_fetch_assoc($result);
    $count = $data['coun'];                     // 根据查询结果获得总用户数

    // 从数据库中查询用户信息
    $usrsql = 'select id, username, createtime, createip from user order by id';
    $result = mysqli_query($con, $usrsql);
    if ($result && mysqli_num_rows($result)) {
        // 将用户数据循环显示在表格里
        echo '<table class="mainTable" cellspacing="0">';
        echo '<tr>';
        echo '<td class="content">' . '用户名' . '</td>';
        echo '<td class="content">' . '注册时间' . '</td>';
        echo '<td class="content">' . 'ip' . '</td>';
        echo '<td class="content">' . '操作' . '</td>';
        echo '</tr>';
        while ($row = mysqli_fetch_assoc($result)) {
            echo '<tr>';
            echo '<td class="content">' . htmlspecialchars($row['username']) . '</td>';
            echo '<td class="content">' . date('Y-m-d H:i:s', $row['createtime']) . '</td>';
            echo '<td class="content">' . long2ip((int)$row['createip']) . '</td>';
            echo '<td class="content"><a href="deleteusr.php?id=' . $row['id'] . '">删除用户</a></td>';
            echo '</tr>';
        }
        echo '</table>';
    } else {
        echo '没有用户数据';
    }


    // 留言管理模块
    echo '<div class="title">留言管理</div>';

    mysqli_select_db($con, 'message');      // 选择数据库
    mysqli_set_charset($con, 'utf-8');   // 选择字符集


    $getMeaasgeSql = 'select count(id) as messageCount from user';
    $result = mysqli_query($con, $getMeaasgeSql);
    $data = mysqli_fetch_assoc($result);
    $messageCount = $data['messageCount'];                     // 根据查询结果获得总留言数

    // 从数据库中查询留言信息
    $msgsql = 'select id, user, title, content, time from message order by id';
    $result = mysqli_query($con, $msgsql);
    if ($result && mysqli_num_rows($result)) {
        // 将用户数据循环显示在表格里
        echo '<table class="mainTable" cellspacing="0">';
        echo '<tr>';
        echo '<td class="content">' . '用户名' . '</td>';
        echo '<td class="content">' . '标题' . '</td>';
        echo '<td class="content">' . '内容' . '</td>';
        echo '<td class="content">' . '添加时间' . '</td>';
        echo '<td class="content">' . '操作' . '</td>';
        echo '</tr>';
        while ($row = mysqli_fetch_assoc($result)) {
            echo '<tr>';
            echo '<td class="content">' . htmlspecialchars($row['user']) . '</td>';     // htmlspecialchars用来防止XSS
            echo '<td class="content">' . htmlspecialchars($row['title']) . '</td>';
            echo '<td class="content">' . htmlspecialchars($row['content']) . '</td>';
            echo '<td class="content">' . $row['time'] . '</td>';
            echo '<td class="content"><a href="deletemsg.php?id=' . $row['id'] . '">删除留言</a></td>';
            echo '</tr>';
        }
        echo '</table>';
    } else {
        echo '没有留言数据';
    }

    mysqli_close($con);

    ?>
    </div>
</body>
</html>
