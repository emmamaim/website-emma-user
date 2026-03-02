<?php
(!isset($_SESSION)) ? session_start() : "";
?>
<!-- 鏈接資料庫 -->
<?php
require_once('Connections/conn_db.php');
?>
<!-- 載入共用php函數庫 -->
<?php require_once("php_lib.php"); ?>
<!doctype html>
<html lang="zh-TW">

<head>
    <!-- 導入head鏈接 -->
    <?php require_once('headfile.php'); ?>
</head>

<body>
    <!-- ================= header ================= -->
    <section id="header">
        <!-- 導入導航條 -->
        <?php require_once('header.php'); ?>
    </section>

    <!-- ================= products ================= -->
    <section id="products" class="py-5 bg-light">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-2">
                    <!-- 引入側邊導航 -->
                    <?php require_once("sidebar.php"); ?>
                </div>
                <!-- 商品列表 -->
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

    <!-- 導入JS文檔 -->
    <?php require_once('jsfile.php'); ?>
    <script src="fancybox/fancybox.umd.js"></script>
    <script type="text/javascript">
        $(function() {
            // 滑鼠滑過圖片檔名填入主圖src中
            $(".card .row.mt-2 .col-md-4 a").mouseover(function() {
                var imgsrc = $(this).children("img").attr("src");
                $("#showGoods").attr({
                    "src": imgsrc
                });
            });
        });
        // 啟用 Fancybox v5 ：將子圖片放到lightbox展示
        Fancybox.bind("[data-fancybox]", {
            Carousel: {
                infinite: true
            }
        });
    </script>
</body>

</html>