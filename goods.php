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


<!doctype html>
<html lang="zh-TW">

<head>
    <!-- 引入網頁head -->
    <?php require_once("headfile.php"); ?>
    <link rel="stylesheet" href="fancybox-2.1.7/source/jquery.fancybox.css">
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
                    <!-- 引入類別分項 -->
                    <?php require_once("breadcrumb.php"); ?>
                    <!-- 引入產品詳細資訊 -->
                    <?php require_once("goods_content.php");
                    ?>
                </div>
            </div>
        </div>
    </section>
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
    <script type="text/javascript" src="fancybox-2.1.7/source/jquery.fancybox.js"></script>
    <script type="text/javascript">
        $(function() {
            // 滑鼠滑過圖片檔名填入主圖src中
            $(".card .row.mt-2 .col-md-4 a").mouseover(function() {
                var imgsrc = $(this).children("img").attr("src");
                $("#showGoods").attr({
                    "src": imgsrc
                });
            });
            // 將子圖片放到lightbox展示
            $(".fancybox").fancybox();
        });
    </script>
</body>

</html>