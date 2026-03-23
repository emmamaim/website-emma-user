<?php
// 跨網頁的變數儲存
(!isset($_SESSION)) ? session_start() : "";
?>

<?php
// require 遇到錯誤會停止 inclue則會繼續執行
// require_oner 只載入一次（資料庫）
require_once('Connections/conn_db.php');
?>
<!-- 載入共用php函數庫 -->
<?php require_once("php_lib.php"); ?>

<!-- 登入設定 -->
<?php
if (isset($_GET['sPath'])) {
    $sPath = $_GET['sPath'] . ".php";
} else {
    $sPath = "index.php";
}
if (isset($_SESSION['login'])) {
    header(sprintf("location: %s", $sPath));
}
?>

<!doctype html>
<html lang="zh-TW">

<head>
    <!-- 引入網頁head -->
    <?php require_once("headfile.php"); ?>
</head>

<body>
    <section id="header">
        <!-- 引入nav導航 -->
        <?php require_once("header.php"); ?>
    </section>
    <section id="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-2">
                    <!-- 引入側邊導航 -->
                    <?php require_once("sidebar.php"); ?>
                </div>
                <div class="col-md-10">
                    <!-- 引入登入模組 -->
                    <?php require_once("login_content.php"); ?>
                </div>
            </div>
        </div>
    </section>
    <hr>
    <!-- ================= links ================= -->
    <section id="divs" class="py-5">
        <!-- 導入links相關鏈接 -->
        <?php require_once('links.php'); ?>
    </section>

    <!-- ================= footer ================= -->
    <section id="footer" class="py-4 text-center bg-dark text-white">
        <!-- 導入底部 -->
        <?php require_once('footer.php'); ?>
    </section>


    <!-- 引入jsfile -->
    <?php require_once("jsfile.php"); ?>
    <div id="loading" name="loading" style="display: none;position:fixed; width:100%; height:100%; top:0; left:0; background-color:rgba(255,255,255,.5); z-index:9999;">
        <i class="fas fa-spinner fa-spin fa-5x fa-fw" style="position: absolute; top:50%; left:50%;">
        </i>
    </div>
    <script type="text/javascript" src="commlib.js
    "></script>
    <script type="text/javascript">
        $(function() {
            $("#form1").submit(function() {
                const inputAccount = $("#inputAccount").val();
                const inputPassword = MD5($("#inputPassword").val());
                $("#loading").show();
                // 呼叫auth_user驗證賬號密碼
                $.ajax({
                    url: 'auth_user.php',
                    type: 'post',
                    dataType: 'json',
                    data: {
                        inputAccount: inputAccount,
                        inputPassword: inputPassword,
                    },
                    success: function(data) {
                        if (data.c == true) {
                            alert(data.m);
                            window.location.href = "<?php echo $sPath; ?>";
                        } else {
                            alert(data.m);
                        }
                    },
                    error: function(data) {
                        alert("系統目前無法連接到後台資料庫");
                    }
                })
            })
        })
    </script>
</body>

</html>