<?php
    /**
     * 销毁session、退出登录
     * @Author NullP0
     */
    session_start();
    if (!isset($_SESSION['username'])) {
        die('<script>document.location.href = "html/login.html"</script>');
    } else {
        // 销毁Session
        unset($_SESSION['username']);
        $_SESSION = array();
        setCookie("PHPSESSID","",time()-1,"/");
        session_destroy();
        die('<script>document.location.href = "index.php"</script>');
    }
?>
