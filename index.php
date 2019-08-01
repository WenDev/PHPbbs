<!DOCTYPE html>
<?php
    session_start();
    error_reporting(0);
    include_once 'connect.php';
?>
<html lang="zh">
<head>
    <meta charset="UTF-8">
    <title>NullP0的留言板</title>
    <link rel="stylesheet" href="css/index.css">
</head>
<body>
    <div class="topbar">
        <div class="toptitle">NullP0的留言板</div>
        <div class="loginOrLogout">
            <?php
                if (!isset($_SESSION['username'])) {
                    echo '<a href="html/login.html" class="loginOrLogoutLink">登录</a>';
                } else {
                    if ($_SESSION['username'] === 'admin') {
                        echo '<a href="admin.php" class="loginOrLogoutLink">信息管理</a>';
                    }
                    echo '<a href="html/add.html" class="loginOrLogoutLink">添加留言</a>';
                    echo '<a href="logout.php" class="loginOrLogoutLink">登出</a>';
                }
            ?>
        </div>
    </div>
    <div class="bigbox">
        <?php
            mysqli_select_db($con, 'message');
            mysqli_set_charset($con, 'utf-8');

            $getMeaasgeSql = 'select count(id) as messageCount from user';
            $result = mysqli_query($con, $getMeaasgeSql);
            $data = mysqli_fetch_assoc($result);
            $messageCount = $data['messageCount'];                     // 根据查询结果获得总留言数

            // 从数据库中查询留言信息
            $msgsql = 'select id, user, title, content, time from message order by id';
            $result = mysqli_query($con, $msgsql);
            if ($result && mysqli_num_rows($result)) {
                // 将留言信息输出到页面上
                while ($row = mysqli_fetch_assoc($result)) {
                    echo '<div class="message">';
                        echo '<div class="msgtitle">';
                            echo '<div class="user">' . htmlspecialchars($row['user']) . '：' . '</div>';     // htmlspecialchars用来防止XSS
                            echo '<div class="title">' . htmlspecialchars($row['title']) . '</div>';
                            echo '<div class="time">' . ' at ' . $row['time'] .  '</div>';
                        echo '</div>';
                        echo '<div class="content">' . htmlspecialchars($row['content']) . '</div>';
                    echo '</div>';
                }
            } else {
                die('没有留言数据！');
            }
        ?>
</body>
</html>